<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminAPIController extends CI_Controller {

    public function __construct(){
		
        parent::__construct();

        $this->load->model("Users");
        $this->load->model("Reports");
    }
    
    public function login(){
        $response = array(
            'success' => false
        );

        $users = $this->Users->exist($_POST['email'], $_POST['password']);
        if(count($users) > 0){
            $response = array(
                'success' => true
            );

            $_SESSION['user_id'] = $users[0]['id'];
            $_SESSION['email'] = $users[0]['email'];
        }

        echo json_encode($response);
    }

    public function register(){
        $response = array(
            'success' => true
        );

        $user_id = $this->Users->add(array(
            'username' => isset($_POST['username']) ? $_POST['username'] : '', 
            'email' => isset($_POST['email']) ? $_POST['email'] : '', 
            'password' => isset($_POST['password']) ? $_POST['password'] : '',
            'first_name' => isset($_POST['first_name']) ? $_POST['first_name'] : '',
            'last_name' => isset($_POST['last_name']) ? $_POST['last_name'] : ''
        ));
        
        if(!$user_id){
            $response = array(
                'success' => false
            );  
        }
        echo json_encode($response);
    }

    public function reportAdd(){
        $response = array(
            'success' => false
        );

        $report_id = $this->Reports->add(array(
            'title' => isset($_POST['title']) ? $_POST['title'] : '',
            'conditions' => isset($_POST['conditions']) ? $_POST['conditions'] : '',
            'study' => isset($_POST['study']) ? $_POST['study'] : '',
            'country' => isset($_POST['country']) ? $_POST['country'] : '',
            'terms' => isset($_POST['terms']) ? $_POST['terms'] : '',
            'user_id' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '',
        ));

        if($report_id){
            $response['report_id'] = $report_id;
            $response['success'] = true;

            $reports = $this->Reports->getByID($report_id);
            
            if(count($reports)){
                $data = array();
                $data['report'] = $reports[0];
                $data['report']['status'] = '';
                $data['report']['status_str'] = 'No Updates';
                $data['studies'] = getAllStudies();
		        $data['countries'] = getAllCountries();

                $report_html = $this->load->view('admin/template/report-template', $data, TRUE);
            }
            
            $response['report'] = $report_html;
        }

        echo json_encode($response);
    }

    public function reportUpdate(){
        $response = array(
            'success' => false
        );

        $report_update = $this->Reports->update(array(
            'id' => isset($_POST['id']) ? $_POST['id'] : '',
            'title' => isset($_POST['title']) ? $_POST['title'] : '',
            'conditions' => isset($_POST['conditions']) ? $_POST['conditions'] : '',
            'study' => isset($_POST['study']) ? $_POST['study'] : '',
            'country' => isset($_POST['country']) ? $_POST['country'] : '',
            'terms' => isset($_POST['terms']) ? $_POST['terms'] : ''
        ));

        $reports = $this->Reports->getByID(isset($_POST['id']) ? $_POST['id'] : '');
            
        if(count($reports)){
            $report = $reports[0];
        }
        else{
            $report = null;
        }

        if($report){
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
                'id' => isset($_POST['id']) ? $_POST['id'] : '',
                'status' => $status
            ));
    
            if($report_update){
                $response['success'] = true;
            }
    
            $response['status'] = $status;
            $response['status_str'] = getStatusString($status);
        }
        else if($report_update){
            $response['success'] = true;
        }

        echo json_encode($response);
    }

    public function reportDelete(){
        $response = array(
            'success' => false
        );

        $report_delete = $this->Reports->deleteByID(isset($_POST['id']) ? $_POST['id'] : null);

        if($report_delete){
            $response['success'] = true;
        }

        echo json_encode($response);
    }

    public function reportDuplicate(){
        $response = array(
            'success' => false
        );

        $report_id = $this->Reports->duplicateByID(isset($_POST['id']) ? $_POST['id'] : null);

        if($report_id){
            $response['success'] = true;
            $response['report_id'] = $report_id;

            $response['success'] = true;

            $reports = $this->Reports->getByID($report_id);
            
            if(count($reports)){
                $data = array();
                $data['report'] = $reports[0];
                $data['studies'] = getAllStudies();
		        $data['countries'] = getAllCountries();

                $report_html = $this->load->view('admin/template/report-template', $data, TRUE);
            }
            
            $response['report'] = $report_html;

        }

        echo json_encode($response);
    }

    public function reportReporting(){
        $response = array(
            'success' => false
        );

        $reports = $this->Reports->getByID($_POST['id']);
            
        if(count($reports)){
            $report = $reports[0];   
        }
        else{
            $report = null;
            echo json_encode($response);
            die();
        }

        if(isset($_POST['reporting']) && $_POST['reporting'] == '1'){           

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
            'id' => isset($_POST['id']) ? $_POST['id'] : '',
            'reporting' => isset($_POST['reporting']) ? $_POST['reporting'] : '',
            'status' => $status
        ));

        if($report_update){
            $response['success'] = true;
        }

        $response['status'] = $status;
        $response['status_str'] = getStatusString($status);

        echo json_encode($response);
    }

    public function reportSearch(){
        $response = array(
            'success' => false
        );

        $reports = $this->Reports->search(isset($_POST['keyword']) ? $_POST['keyword'] : '', isset($_POST['sort']) ? $_POST['sort'] : 'ASC', isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '');

        if(count($reports) > 0){
            $response['success'] = true;
            $html = '';
            
            foreach($reports as $report){
                
                $data = array();
                $data['report'] = $report;
                $data['studies'] = getAllStudies();
                $data['countries'] = getAllCountries();
                
                $html .= $this->load->view('admin/template/report-template', $data, TRUE);
            }

            $response['reports'] = $html;
        }

        echo json_encode($response);
    }
}
