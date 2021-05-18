<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'libraries/vendor/autoload.php';
use Dompdf\Dompdf;

class RSSController extends CI_Controller {

	public function __construct(){
		
        parent::__construct();

		$this->load->model("Reports");
	}


	public function rssTest(){

		// $details = getStudyDetails('https://clinicaltrials.gov/ct2/show/NCT00936936?term=d&amp;cond=Testis+Cancer&amp;cntry=US');

		// $details = getStudyDetails('https://clinicaltrials.gov/ct2/show/NCT02660229?cond=Cancer+Pain&draw=2&rank=3');
		$details = getStudyDetails('https://clinicaltrials.gov/ct2/show/NCT04175639?cond=Cancer+Pain&draw=2&rank=89');
		
		$details['link'] = 'https://clinicaltrials.gov/show/NCT04844645';
		$details['title'] = 'Using Mini Program for Selfmanagement VS Conventional Pharmaceutical Care for Cancer Pain';
		// echo $details['phase'];
		// print_r($details);die();

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$data = array(
			'clinics' => array(),
			'title' => "ClinicalTrials.gov: d | Testis Cancer | United States | Last update posted in the last 7 days"
		);
		$data['clinics'][] = $details;

		$clinic_html = $this->load->view('admin/template/clinic-table', $data, TRUE);
		echo $clinic_html;die();
		$dompdf->loadHtml($clinic_html);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A3', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream("test.pdf");

		die();

		$rss_url = 'https://clinicaltrials.gov/ct2/results/rss.xml?rcv_d=&lup_d=7&sel_rss=mod7&term=d&cond=Testis+Cancer&cntry=US&count=10000';
		$rss_url = 'https://clinicaltrials.gov/ct2/results/rss.xml?rcv_d=&lup_d=1&sel_rss=mod1&term=d&cond=Testis+Cancer&cntry=US&count=10000';
		if(isset($_GET['url'])){
			$rss_url = $_GET['url'];
		}

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
		
		echo count($xml->channel->item);die();
		foreach ($xml->channel->item as $item) {
			echo $item->title."<br><br>";
		}
	}

	public function rssDownload(){
		set_time_limit(0);

		if(!isset($_GET['report_id'])){
			echo("Not find report id");
			die();
		}

		$reports = $this->Reports->getByID($_GET['report_id']);
		if(count($reports) == 0){
			echo("Not find report");
			die();
		}

		$report = $reports[0];

		// create rss url
		$rss_url = "https://clinicaltrials.gov/ct2/results/rss.xml?rcv_d=&lup_d=7&sel_rss=mod7&term=".str_replace(" ", "+", $report['terms'])."&type=".$report['study']."&cond=".str_replace(" ", "+", $report['conditions'])."&cntry=".$report['country']."&count=10";

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
		$dompdf->stream("SearchResults.pdf");

		echo "PDF Downloading...";
		die();
	}

}
