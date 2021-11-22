<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_sparepart extends CI_Controller {

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

		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$data_sparepart = $this->M_master->tampil_data('tbl_sparepart')->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_data_sparepart', array(
			'data_sparepart' => $data_sparepart
		));
		$this->load->view('footer');
	}

	public function simpan(){
		$result = $this->M_master->simpan_data('tbl_sparepart', array(
			'nama_sparepart' => $this->input->post('nama_sparepart'),
			'keterangan' => $this->input->post('keterangan')
		));

		if($result>0){
			echo '<script>alert("Data Sparepart Tersimpan");window.location="index"</script>';
		}
	}

	public function update(){
		$result = $this->M_master->update_data('tbl_sparepart', array(
			'nama_sparepart' => $this->input->post('nama_sparepart'),
			'keterangan' => $this->input->post('keterangan')
		), array('id' => $this->input->post('id')));

		if($result>0){
			echo '<script>alert("Data Sparepart Diubah");window.location="index"</script>';
		}
	}

	public function hapus($id){
		$result = $this->M_master->hapus_kendaraan('tbl_sparepart', array('id' => $id));
		if($result>0){
			redirect('data_sparepart');
		}
	}

}
