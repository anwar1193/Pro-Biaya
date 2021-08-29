<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Header extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('libraryku');
		$this->load->helper('helperku');
		$this->load->model('M_header');
	}

	public function get_totMahasiswa(){
		$total = $this->M_header->jumlah_mhs();
		$result['total'] = $total;
		$result['pesan'] = "Berhasil Direfresh Secara Realtime";
		echo json_encode($result);
	}

}
