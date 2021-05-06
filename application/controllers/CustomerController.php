<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerController extends CI_Controller {

	public function __construct(){
		
        parent::__construct();

		$this->load->model("Customers");
        
	}
	
	public function customerPage($url_tag){
		if($url_tag != ''){
			$customers = $this->Customers->getByTag($url_tag);
			if(count($customers) == 0){
				echo "Not found Customer";
			}
			else{
				$data = array();
				$data['customer'] = $customers[0];
				$this->load->view('customer/view', $data);
			}
		}
	}
}
