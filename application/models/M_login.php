<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function proses($tbl,$data){
		$result = $this->db->get_where($tbl,$data);
		return $result;
	}

	// Data Untuk Library - Libraryku
	public function ambil_user($id=null){
		$this->db->from('tbl_user');
		if($id != null){
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

}
