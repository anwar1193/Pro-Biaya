<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_cabang extends CI_Controller {

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
		$data_cabang = $this->M_master->tampil_cabang()->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_data_cabang', array('data_cabang' => $data_cabang));
		$this->load->view('footer');
	}

	public function simpan(){
		$result = $this->M_master->simpan_cabang('tbl_cabang', array(
			'kode_cabang' => $this->input->post('kode_cabang'),
			'nama_cabang' => $this->input->post('nama_cabang'),
			'no_telepon' => $this->input->post('no_telepon'),
			'alamat' => $this->input->post('alamat')
		));

		if($result>0){
			echo '<script>alert("Data Cabang Tersimpan");window.location="index"</script>';
		}
	}

	public function update(){
		$result = $this->M_master->update_cabang('tbl_cabang', array(
			'nama_cabang' => $this->input->post('nama_cabang'),
			'no_telepon' => $this->input->post('no_telepon'),
			'alamat' => $this->input->post('alamat')
		), array('kode_cabang' => $this->input->post('kode_cabang')));

		if($result>0){
			echo '<script>alert("Data Cabang Diubah");window.location="index"</script>';
		}
	}

	public function hapus($id){
		$result = $this->M_master->hapus_cabang('tbl_cabang', array('id' => $id));
		if($result>0){
			redirect('data_cabang');
		}
	}

}
