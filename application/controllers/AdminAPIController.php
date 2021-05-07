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
            'terms' => isset($_POST['terms']) ? $_POST['terms'] : ''
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

        if($report_update){
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
        }

        echo json_encode($response);
    }
}
