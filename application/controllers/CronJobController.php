<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'libraries/vendor/autoload.php';

require_once APPPATH."libraries/PHPMailer/Exception.php";
require_once APPPATH."libraries/PHPMailer/PHPMailer.php";
require_once APPPATH."libraries/PHPMailer/SMTP.php";

use Dompdf\Dompdf;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CronJobController extends CI_Controller {

	public function __construct(){
		
        parent::__construct();

		$this->load->model("Reports");
		$this->load->model("Users");

		$this->load->library('mailer');
	}

	public function test(){
		writeLog('Test Log');

		$this->mailer->sendTestMail();
		die();
		$mail = new PHPMailer();

		$mail->IsSMTP();
		$mail->Host = 'mail.clinicalrss.orangelinelab.com';
		$mail->Port = 465;
		$mail->SMTPAuth = true;
		$mail->Username = 'smtp@clinicalrss.orangelinelab.com';
		$mail->Password = 'hX_$6*zA0;Cn';
		$mail->SMTPSecure = 'ssl';
		$mail->SMTPDebug  = 1;  
		$mail->SMTPAuth   = TRUE;

		$mail->From = 'smtp@clinicalrss.orangelinelab.com';
		$mail->FromName = 'Clinic';

		$mail->Subject = "Message from contact form";
    	$mail->Body    = "This is test email";
		$mail->AddAddress('jaygangkun@hotmail.com');

		$mail->addAttachment('searchresults/Test Attachment.pdf');

		if(!$mail->Send()) {
			echo $mail->ErrorInfo;
		}

		echo "success";
	}

	public function run(){
		set_time_limit(0);
		writeLog('Cron Job Start >>>>>>>>>>');

		// get active reports
		$reports = $this->Reports->allActiveReports();

		foreach($reports as $report){
			writeLog('---Start the report:'.$report['id']);
			$days = 7;
			if($report['status'] == 'new'){
				$days = 7;
			}
			else if($report['status'] == 'recent'){
				$days = 31;
			}
			else if($report['status'] == 'old'){
				$days = 31 * 3;
			}
			
			$rss_url = getRssLink(array(
				'days' => $days,
				'terms' => $report['terms'],
				'study' => $report['study'],
				'conditions' => $report['conditions'],
				'country' => $report['country'],
				'count' => 10
			));
			// echo $rss_url; die();
			
			$curl = curl_init();
	
			curl_setopt_array($curl, array(
				CURLOPT_URL => $rss_url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HTTPHEADER => array(
					'Cookie: CTOpts=Qihzm6CLC74Psi1HjyUgzw-R98Fz3R4gQC-w; Psid=vihzm6CLC74Psi1Hjyz3FQ7V9gCkkKC8-BC8Eg0jF64VSgzqSB78SB0gCD8V'
				),
			));
	
			$response = curl_exec($curl);
	
			curl_close($curl);
			
			$xml = new SimpleXMLElement($response);
			
			$data = array(
				'clinics' => array(),
				'title' => $xml->channel->title
			);
	
			foreach ($xml->channel->item as $item) {
				$details = getStudyDetails($item->link);
				$details['link'] = $item->link;
				$details['title'] = $item->title;
				$details['description'] = $item->description;
	
				$data['clinics'][] = $details;
			}
	
			$dompdf = new Dompdf();
			
			$clinic_html = $this->load->view('admin/template/clinic-table', $data, TRUE);
			// echo $clinic_html;die();
			$dompdf->loadHtml($clinic_html);
	
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('A3', 'landscape');
	
			// Render the HTML as PDF
			$dompdf->render();
	
			// Output the generated PDF to Browser

			// $dompdf->stream("SearchResults.pdf");
			$output = $dompdf->output();
			$filepath = 'searchresults/Search Results_'.$report['id']."_".time().'.pdf';
			file_put_contents($filepath, $output);
	

			$users = $this->Users->getByID($report['user_id']);

			if(count($users) > 0){
				$user = $users[0];

				// sending email
				$mail = new PHPMailer();

				$mail->IsSMTP();
				$mail->Host = 'mail.clinicalrss.orangelinelab.com';
				$mail->Port = 465;
				$mail->SMTPAuth = true;
				$mail->Username = 'smtp@clinicalrss.orangelinelab.com';
				$mail->Password = 'hX_$6*zA0;Cn';
				$mail->SMTPSecure = 'ssl';
				$mail->SMTPDebug  = 1;  
				$mail->SMTPAuth   = TRUE;

				$mail->From = 'smtp@clinicalrss.orangelinelab.com';
				$mail->FromName = 'ClinicRSS';

				$mail->Subject = "message from clinic rss";
				$mail->Body    = $xml->channel->title;

				$mail->AddAddress($user['email']);

				$mail->addAttachment($filepath);

				if(!$mail->Send()) {
					writeLog($mail->ErrorInfo);
				}

				writeLog('---Sent Email to '.$user['email']);
			}
			
			writeLog('---Complete the report:'.$report['id']);
		}

		writeLog('Cron Job End <<<<<<<<<<');
		echo "Successfully!";
	}

	public function check(){
		set_time_limit(0);
		writeLog('Cron Job Check Start >>>>>>>>>>');

		// get active reports
		$reports = $this->Reports->allActiveReports();

		foreach($reports as $report){
			writeLog('---Start Check:'.$report['id']);
			
			if($report['reporting'] == '1'){
                $terms = $report['terms'];
                $study = $report['study'];
                $conditions = $report['conditions'];
                $country = $report['country'];
    
                $rss_link = getRssLink(array(
                    'days' => 7,
                    'terms' => $terms,
                    'study' => $study,
                    'conditions' => $conditions,
                    'country' => $country,
                    'count' => 10
                ));
        
                if(getRssCount($rss_link) == 0){
                    $rss_link = getRssLink(array(
                        'days' => 31,
                        'terms' => $terms,
                        'study' => $study,
                        'conditions' => $conditions,
                        'country' => $country,
                        'count' => 10
                    )); 
                    if(getRssCount($rss_link) == 0){
                        $rss_link = getRssLink(array(
                            'days' => 31 * 3,
                            'terms' => $terms,
                            'study' => $study,
                            'conditions' => $conditions,
                            'country' => $country,
                            'count' => 10
                        )); 
    
                        if(getRssCount($rss_link) == 0){
                            $status = 'no';
                        }
                        else{
                            $status = 'old';
                        }
                    }
                    else{
                        $status = 'recent';
                    }
                }
                else{
                    $status = 'new';
                }
            }
            else{
                $status = 'no';
            }
			
			$report_update = $this->Reports->updateField(array(
                'id' => $report['id'],
                'status' => $status
            ));

			if($report_update){
				writeLog('---Update Status:'.$status);	
			}
			writeLog('---Complete Check:'.$report['id']);
		}

		writeLog('Cron Job Check End <<<<<<<<<<');
		echo "Successfully!";
	}
}
