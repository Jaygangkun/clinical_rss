<?php 

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	
Class Reports extends CI_Model
{
	public function add($data){
		$query = "INSERT INTO reports(`title`, `conditions`, `study`, `country`, `terms`) VALUES('".$data['title']."', '".$data['conditions']."', '".$data['study']."', '".$data['country']."', '".$data['terms']."')";
        $this->db->query($query);

		return $this->db->insert_id();
	}

	public function load(){
		$query = "SELECT * FROM reports";
		$query_result = $this->db->query($query)->result_array();
		
		return $query_result;
	}

	public function getByID($id){
		$query = "SELECT * FROM reports WHERE id='".$id."'";
		$query_result = $this->db->query($query)->result_array();
		
		return $query_result;
	}

	public function update($data){

		$query = "UPDATE reports SET title='".$data['title']."', conditions='".$data['conditions']."', study='".$data['study']."', country='".$data['country']."', terms='".$data['terms']."' WHERE id='".$data['id']."'";

        return $this->db->query($query);
	}

	public function deleteByID($id){
		$query = "DELETE FROM reports WHERE id='".$id."'";
		return $this->db->query($query);
	}

	public function duplicateByID($id){
		
		$query_get = "SELECT * FROM reports WHERE id='".$id."'";
		$results_get = $this->db->query($query_get)->result_array();

		if(count($results_get) > 0){
			$report = $results_get[0];

			// clone
			$query = "INSERT INTO reports(`title`, `conditions`, `study`, `country`, `terms`) VALUES('".$report['title']."', '".$report['conditions']."', '".$report['study']."', '".$report['country']."', '".$report['terms']."')";
			$this->db->query($query);

			return $this->db->insert_id();
		}

		return null;
	}
}