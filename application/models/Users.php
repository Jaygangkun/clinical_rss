<?php 

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	
Class Users extends CI_Model
{
	
	public function exist($email, $password){
		$query = "SELECT * FROM users WHERE email='".$email."' AND password=PASSWORD('".$password."')";
		$query_result = $this->db->query($query)->result_array();
		
		return $query_result;
	}

	public function add($full_name, $email, $password){
		$query = "INSERT INTO users(`email`, `password`) VALUES('".$email."', PASSWORD('".$password."'))";
		$query_result = $this->db->query($query);
		
		return $this->db->insert_id();
	}
}