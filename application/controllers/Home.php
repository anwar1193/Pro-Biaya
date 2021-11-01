<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('helperku');
		$this->load->library('libraryku');
		$this->load->model('M_master');
	}

	public function index()
	{
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			// Dashboard Utama
			$data_onproccess = $this->M_master->tampil_onproccessHO($departemen)->num_rows();
			$data_approved = $this->M_master->tampil_approvedHO($departemen)->num_rows();
			$data_rejected = $this->M_master->tampil_rejectedHO($departemen)->num_rows();
			$data_revisi = $this->M_master->tampil_revisiHO($departemen)->num_rows();
			$data_cancel = $this->M_master->tampil_cancelHO($departemen)->num_rows();

			// Dashboard Kedua
			$data_cek_pic = $this->M_master->tampil_approvedHO_lv1($departemen)->num_rows();
			$data_pending_pic = $this->M_master->tampil_approvedHO_lv2($departemen)->num_rows();
			$data_cek_finance = $this->M_master->tampil_approvedHO_lv3($departemen)->num_rows();
			$data_proses_bayar = $this->M_master->tampil_approvedHO_lv4($departemen)->num_rows();
			$data_proses_bayar2 = $this->M_master->tampil_proses_bayar_penyelesaianHO($departemen)->num_rows();

			// Dashboard Ketiga
			$data_pendok = $this->M_master->tampil_pendokHO($departemen)->num_rows();
			$data_lendok = $this->M_master->tampil_lendokHO($departemen)->num_rows();
			$data_accdok = $this->M_master->tampil_accdokHO($departemen)->num_rows();
			$data_telbay = $this->M_master->tampil_telbayHO($departemen)->num_rows();
			$data_telbay2 = $this->M_master->tampil_telbayHO2($departemen)->num_rows();
			$identitas = $departemen;

			// Dashboard Penyelesaian
			$data_onproccess2 = $this->M_master->tampil_onproccessHO2($departemen)->num_rows();
			$data_approved2 = $this->M_master->tampil_approvedHO2($departemen)->num_rows();
			$data_rejected2 = $this->M_master->tampil_rejectedHO2($departemen)->num_rows();
			$data_revisi2 = $this->M_master->tampil_revisiHO2($departemen)->num_rows();
			$data_pending_pic2 = $this->M_master->tampil_pending_penyelesaianHO($departemen)->num_rows();
			$data_pending_pic3 = $this->M_master->tampil_pending_penyelesaianHO2($departemen)->num_rows();
			$data_verified = $this->M_master->tampil_verified_penyelesaianHO($departemen)->num_rows();
			$data_verified2 = $this->M_master->tampil_verified_penyelesaianHO2($departemen)->num_rows();
			$data_verified_acc = $this->M_master->tampil_verified_acc_penyelesaianHO($departemen)->num_rows();
			$data_verified_acc2 = $this->M_master->tampil_verified_acc_penyelesaianHO2($departemen)->num_rows();
		}else{
			// Dashboard Utama
			$data_onproccess = $this->M_master->tampil_onproccess($cabang, $level)->num_rows();
			$data_approved = $this->M_master->tampil_approved($cabang, $level)->num_rows();
			$data_rejected = $this->M_master->tampil_rejected($cabang, $level)->num_rows();
			$data_revisi = $this->M_master->tampil_revisi($cabang, $level)->num_rows();
			$data_cancel = $this->M_master->tampil_cancel($cabang, $level)->num_rows();

			// Dashboard Kedua
			$data_cek_pic = $this->M_master->tampil_approved_lv1($cabang, $level)->num_rows();
			$data_pending_pic = $this->M_master->tampil_approved_lv2($cabang, $level)->num_rows();
			$data_cek_finance = $this->M_master->tampil_approved_lv3($cabang, $level)->num_rows();
			$data_proses_bayar = $this->M_master->tampil_approved_lv4($cabang, $level)->num_rows();
			$data_proses_bayar2 = $this->M_master->tampil_proses_bayar_penyelesaian($cabang, $level)->num_rows();

			// Dashboard Ketiga
			$data_pendok = $this->M_master->tampil_pendok($cabang, $level)->num_rows();
			$data_lendok = $this->M_master->tampil_lendok($cabang, $level)->num_rows();
			$data_accdok = $this->M_master->tampil_accdok($cabang, $level)->num_rows();
			$data_telbay = $this->M_master->tampil_telbay($cabang, $level)->num_rows();
			$data_telbay2 = $this->M_master->tampil_telbay2($cabang, $level)->num_rows();
			$identitas = $level;

			// Dashboard Penyelesaian
			$data_onproccess2 = $this->M_master->tampil_onproccess2($cabang, $level)->num_rows();
			$data_approved2 = $this->M_master->tampil_approved2($cabang, $level)->num_rows();
			$data_rejected2 = $this->M_master->tampil_rejected2($cabang, $level)->num_rows();
			$data_revisi2 = $this->M_master->tampil_revisi2($cabang, $level)->num_rows();
			$data_pending_pic2 = $this->M_master->tampil_pending_penyelesaian($cabang, $level)->num_rows();
			$data_pending_pic3 = $this->M_master->tampil_pending_penyelesaian2($cabang, $level)->num_rows();
			$data_verified = $this->M_master->tampil_verified_penyelesaian($cabang, $level)->num_rows();
			$data_verified2 = $this->M_master->tampil_verified_penyelesaian2($cabang, $level)->num_rows();
			$data_verified_acc = $this->M_master->tampil_verified_acc_penyelesaian($cabang, $level)->num_rows();
			$data_verified_acc2 = $this->M_master->tampil_verified_acc_penyelesaian2($cabang, $level)->num_rows();
		}

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_home', array(
			'data_onproccess' => $data_onproccess,
			'data_rejected' => $data_rejected,
			'data_approved' => $data_approved,
			'data_revisi' => $data_revisi,
			'data_cancel' => $data_cancel,
			'data_cek_pic' => $data_cek_pic,
			'data_pending_pic' => $data_pending_pic,
			'data_cek_finance' => $data_cek_finance,
			'data_proses_bayar' => $data_proses_bayar,
			'data_proses_bayar2' => $data_proses_bayar2,
			'data_pendok' => $data_pendok,
			'data_lendok' => $data_lendok,
			'data_accdok' => $data_accdok,
			'data_telbay' => $data_telbay,
			'data_telbay2' => $data_telbay2,

			'data_onproccess2' => $data_onproccess2,
			'data_rejected2' => $data_rejected2,
			'data_approved2' => $data_approved2,
			'data_revisi2' => $data_revisi2,
			'data_pending_pic2' => $data_pending_pic2,
			'data_pending_pic3' => $data_pending_pic3,
			'data_verified' => $data_verified,
			'data_verified2' => $data_verified2,
			'data_verified_acc' => $data_verified_acc,
			'data_verified_acc2' => $data_verified_acc2
		));
		$this->load->view('footer');
	}

}
