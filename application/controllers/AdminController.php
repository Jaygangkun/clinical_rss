<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __construct(){
		
        parent::__construct();

		$this->load->model("Reports");
	}

	public function login(){
		unset($_SESSION['user_id']);
		$this->load->view('admin/login');
	}

	public function register(){
		$this->load->view('admin/register');
	}

	public function resetPassword(){
		$this->load->view('admin/reset-password');
	}

	public function dashboard(){
		if(!isset($_SESSION['user_id'])){
			redirect('/login');
		}

		$data = array();
		$data['studies'] = getAllStudies();
		$data['countries'] = getAllCountries();
		$data['reports'] = $this->Reports->load($_SESSION['user_id']);

		$this->load->view('admin/dashboard', $data);
	}
}
