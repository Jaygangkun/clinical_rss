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

	public function add($data){
		$query = "INSERT INTO users(`email`, `password`, `username`, `first_name`, `last_name`) VALUES('".$data['email']."', PASSWORD('".$data['password']."'), '".$data['username']."', '".$data['first_name']."', '".$data['last_name']."')";
		$query_result = $this->db->query($query);
		
		return $this->db->insert_id();
	}

	public function getByID($id){
		$query = "SELECT * FROM users WHERE id='".$id."'";
		$query_result = $this->db->query($query)->result_array();
		
		return $query_result;
	}
}