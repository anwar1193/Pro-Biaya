<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setuju_bayar_penyelesaian extends CI_Controller {

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

        $data_inquiry = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_penyelesaian_kekurangan.status_verifikasi_penyelesaian='Verified' AND tbl_penyelesaian_kekurangan.status_bayar_penyelesaian='' ORDER BY tbl_penyelesaian_kekurangan.tanggal_request_transfer ASC")->result_array();
        
        $identitas = $level;

		// Nomor Jurnal BMHD
		$nojur_bmhd_penyelesaian = $this->M_master->nojur_bmhd_penyelesaian();
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_setuju_bayar_penyelesaian', array(
			'data_inquiry' => $data_inquiry,
			'nojur_bmhd_penyelesaian' => $nojur_bmhd_penyelesaian
		));
		$this->load->view('footer');
	}

    public function setuju_bayar(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal_proses_bayar = date('Y-m-d');
        $tanggal_rencana_bayar = $this->input->post('tanggal_rencana_bayar_penyelesaian');
        $bank_bayar_penyelesaian = $this->input->post('bank_bayar_penyelesaian');
        $id_penyelesaian = $this->input->post('id_penyelesaian');

		// Nomor BMHD Penyelesaian
		$nomor_bmhd_penyelesaian = $this->input->post('nomor_bmhd_penyelesaian');

        $result = $this->M_master->update_pengajuan('tbl_penyelesaian_kekurangan', array(
            'status_bayar_penyelesaian' => 'Proses Bayar',
            'tanggal_rencana_bayar_penyelesaian' => $tanggal_rencana_bayar,
            'tanggal_proses_bayar_penyelesaian' => $tanggal_proses_bayar,
            'bank_bayar_penyelesaian' => $bank_bayar_penyelesaian,
            'nomor_bmhd_penyelesaian' => $nomor_bmhd_penyelesaian
        ), array('id_penyelesaian' => $id_penyelesaian));

        if($result>0){
            echo '<script>alert("Pembayaran Penyelesaian Telah Di Setujui");window.location="index"</script>';
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
		$this->load->view('v_setuju_bayar_penyelesaian_d', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history
		));
		$this->load->view('footer');
	}


}
