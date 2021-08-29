<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_direksi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('helperku');
		$this->load->library(array('libraryku','dompdf_gen'));
		$this->load->model('M_master');

	}

	// function untuk relasi pilihan filter "Final Approved By"
	// public function ambil_data(){

	// 	$modul=$this->input->post('modul');
	// 	$departemen=$this->input->post('id');

	// 	if($modul=="nama_approved"){
	// 		echo $this->M_master->ambil_final_approved($departemen);
	// 	}
	// }


	public function report_rekap(){
		$tanggal_from = $this->input->post('tanggal_from');
		$tanggal_to = $this->input->post('tanggal_to');
		$departemen = $this->input->post('departemen');

		$this->load->view('v_report_dir_rekap2',array(
			'tanggal_from' => $tanggal_from,
			'tanggal_to' => $tanggal_to,
			'departemen' => $departemen
		));
	}


	public function report_rinci(){
		$tanggal_from = $this->input->post('tanggal_from');
		$tanggal_to = $this->input->post('tanggal_to');
		$departemen = $this->input->post('departemen');
		$final_approved_by = $this->input->post("final_approved_by");

		if($departemen == 'all'){ // jika yang dipilih semua departemen

			if($final_approved_by == 'all'){ // jika yang dipilih all final approved

				$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
						(tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='dept head pic' OR

						(tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='division head' OR

						(tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director' OR

						(tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director finance' OR
						(tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='president director'")->result_array();

			}else{ // jika yang dipilih final approved tertentu saja

				$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
						(tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='dept head pic' AND nama_pengapprove='$final_approved_by' OR

						(tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='division head' AND nama_pengapprove='$final_approved_by' OR

						(tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director' AND nama_pengapprove='$final_approved_by' OR

						(tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director finance' AND nama_pengapprove='$final_approved_by' OR

						(tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='president director' AND nama_pengapprove='$final_approved_by'")->result_array();

			}
			
		}else{ // jika yang dipilih departemen tertentu saja

			if($final_approved_by == 'all'){ // jika yang dipilih all final approved

				$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='dept head pic' OR

						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='division head' OR

						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director' OR

						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director finance' OR
						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='president director'")->result_array();

			}else{ // jika yang dipilih final approved tertentu saja
				
				$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='dept head pic' OR

						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='division head' OR

						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director' OR

						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director finance' OR
						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='president director'")->result_array();

			}

			$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='dept head pic' AND nama_pengapprove='$final_approved_by' OR

						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='division head' AND nama_pengapprove='$final_approved_by' OR

						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director' AND nama_pengapprove='$final_approved_by' OR

						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director finance' AND nama_pengapprove='$final_approved_by' OR

						dept_tujuan='$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='president director' AND nama_pengapprove='$final_approved_by'")->result_array();

		}

		

		$this->load->view('v_report_dir_rinci',array(
			'tanggal_from' => $tanggal_from,
			'tanggal_to' => $tanggal_to,
			'departemen' => $departemen,
			'data_pengajuan' => $data_pengajuan
		));
	}


}
