<?php 

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	
Class Reports extends CI_Model
{
	public function add($data){
		$query = "INSERT INTO reports(`title`, `conditions`, `study`, `country`, `terms`, `created_at`, `status`, `user_id`) VALUES('".$data['title']."', '".$data['conditions']."', '".$data['study']."', '".$data['country']."', '".$data['terms']."', NOW(), 'no', ".$data['user_id'].")";
        $this->db->query($query);

		return $this->db->insert_id();
	}

	public function load($user_id){
		$query = "SELECT * FROM reports WHERE user_id='".$user_id."' ORDER BY title ASC";
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
			$query = "INSERT INTO reports(`title`, `conditions`, `study`, `country`, `terms`, `created_at`) VALUES('".$report['title']."', '".$report['conditions']."', '".$report['study']."', '".$report['country']."', '".$report['terms']."', NOW())";
			$this->db->query($query);

			return $this->db->insert_id();
		}

		return null;
	}

	public function updateField($data){
		$update_set = '' ;
		if(isset($data['reporting'])){
			if($update_set == ''){
				$update_set = "reporting='".$data['reporting']."'";
			}
		}

		if(isset($data['status'])){
			if($update_set == ''){
				$update_set = "status='".$data['status']."'";
			}
			else{
				$update_set .= ", status='".$data['status']."'";
			}
		}
		$query = "UPDATE reports SET ".$update_set." WHERE id='".$data['id']."'";		

		return $this->db->query($query);
	}

	public function search($keyword, $sort, $user_id){
		
		$query = '';
		if($keyword == ''){
			$query = "SELECT * FROM reports WHERE user_id='".$user_id."' ORDER BY title ".$sort;
		}
		else{
			$query = "SELECT * FROM reports WHERE (title LIKE '%".$keyword."%' OR conditions LIKE '%".$keyword."%' OR study LIKE '%".$keyword."%' OR country LIKE '%".$keyword."%' OR terms LIKE '%".$keyword."%') AND user_id='".$user_id."' ORDER BY title ".$sort;
		}

		$query_result = $this->db->query($query)->result_array();
		return $query_result;
	}

	public function allActiveReports(){
		$query = "SELECT * FROM reports WHERE reporting='1' AND user_id IS NOT NULL AND user_id <> ''";
		$query_result = $this->db->query($query)->result_array();
		return $query_result;
	}
}