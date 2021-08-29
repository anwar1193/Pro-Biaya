<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_admin extends CI_Controller {

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
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		// $data_budget = $this->M_master->tampil_budget($cabang,$identitas)->result_array();
		$data_budget = $this->M_master->tampil_budget_admin()->result_array();
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_budget_admin', array('data_budget' => $data_budget));
		$this->load->view('footer');
	}

	public function detail($cab, $dept){
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		// Untuk Sidebar
		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		// Untuk Detail Budget (Cabang)
		if($cab == 'HEAD%20OFFICE'){
			$cbg = 'HEAD OFFICE';
		}else{
			$cbg = $cab;
		}

		// Untuk Detail Budget (Departemen)
		if($dept == 'LOAN%20ADMINISTRATION'){
			$deptm = 'LOAN ADMINISTRATION';
		}elseif($dept == 'CREDIT%20ACCEPTANCE%20UNIT'){
			$deptm = 'CREDIT ACCEPTANCE UNIT';
		}elseif($dept == 'COLLECTION%20SUPPORT'){
			$deptm = 'COLLECTION SUPPORT';
		}elseif($dept == 'ASSET%20DISPOSAL'){
			$deptm = 'ASSET DISPOSAL';
		}elseif($dept == 'ASSET%20RECOVERY'){
			$deptm = 'ASSET RECOVERY';
		}elseif($dept == 'BANK%20RELATION'){
			$deptm = 'BANK RELATION';
		}elseif($dept == 'INTERNAL%20AUDIT'){
			$deptm = 'INTERNAL AUDIT';
		}elseif($dept == 'DATA%20CENTER%20MANAGEMENT'){
			$deptm = 'DATA CENTER MANAGEMENT';
		}elseif($dept == 'GENERAL%20AFFAIR'){
			$deptm = 'GENERAL AFFAIR';
		}else{
			$deptm = $dept;
		}

		$data_budget = $this->M_master->tampil_budget($cbg,$deptm)->result_array();
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_budget_detail', array('data_budget' => $data_budget, 'cbg'=>$cbg, 'deptm'=>$deptm));
		$this->load->view('footer');
	}


	public function update(){
		$result = $this->M_master->update_budget('tbl_budget', array(
			'agu20_akhir' => $this->input->post('agu20_akhir'),
			'sep20_akhir' => $this->input->post('sep20_akhir'),
			'okt20_akhir' => $this->input->post('okt20_akhir'),
			'nov20_akhir' => $this->input->post('nov20_akhir'),
			'des20_akhir' => $this->input->post('des20_akhir')
		), array('id' => $this->input->post('id')));

		if($result>0){
			$this->session->set_flashdata('pesan','Data Budget Berhasil Diupdate');
			redirect('budget_admin');
		}
	}


}
