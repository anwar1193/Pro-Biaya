<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bayar_penyelesaian_final extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('helperku');
		$this->load->library(array('libraryku','dompdf_gen'));
		$this->load->model('M_master');
	}

	public function index()
	{
		date_default_timezone_set("Asia/Jakarta");
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

        $data_inquiry = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_penyelesaian_kekurangan.status_bayar_penyelesaian='Proses Bayar' ORDER BY tbl_penyelesaian_kekurangan.tanggal_rencana_bayar_penyelesaian ASC")->result_array();
        
        $identitas = $level;

		$nomor_pymt_penyelesaian = $this->M_master->nojur_pymt_penyelesaian();
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_bayar_penyelesaian_final', array(
			'data_inquiry' => $data_inquiry,
			'nomor_pymt_penyelesaian' => $nomor_pymt_penyelesaian
		));
		$this->load->view('footer');
	}

    public function bayar_final(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal_bayar_penyelesaian = date('Y-m-d');
        $id_penyelesaian = $this->input->post('id_penyelesaian');

		$nomor_pymt_penyelesaian = $this->input->post('nomor_pymt_penyelesaian');

        $result = $this->M_master->update_pengajuan('tbl_penyelesaian_kekurangan', array(
            'status_bayar_penyelesaian' => 'Telah Dibayar',
            'tanggal_bayar_penyelesaian' => $tanggal_bayar_penyelesaian,
            'nomor_pymt_penyelesaian' => $nomor_pymt_penyelesaian
        ), array('id_penyelesaian' => $id_penyelesaian));

        if($result>0){
            echo '<script>alert("Pembayaran Penyelesaian Telah Di Bayar");window.location="index"</script>';
        }
    }

	public function detail($id){
        $data_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan WHERE id_penyelesaian=$id")->row_array();
		$no_pengajuan = $data_penyelesaian['nomor_pengajuan'];

        $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan = '$no_pengajuan'")->row_array();

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history_penyelesaian', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_bayar_penyelesaian_final_d', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history
		));
		$this->load->view('footer');
	}


}
