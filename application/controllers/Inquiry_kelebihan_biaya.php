<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiry_kelebihan_biaya extends CI_Controller {

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

		if($cabang=='HEAD OFFICE'){ // Jika Kantor Pusat

			// $data_inquiry = $this->M_master->inquiryHO($departemen)->result_array();
            $data_inquiry = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_pengajuan.bagian='$departemen' ORDER BY tbl_penyelesaian_kelebihan.id_penyelesaian DESC")->result_array();
			$identitas = $departemen;

		}else{ // Jika Cabang
			
            // $data_inquiry = $this->M_master->inquiry($cabang, $level)->result_array();
            $data_inquiry = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$level' ORDER BY tbl_penyelesaian_kelebihan.id_penyelesaian DESC")->result_array();
				
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_inquiry_kelebihan', array('data_inquiry' => $data_inquiry));
		$this->load->view('footer');
	}

	public function detail($id){
        $data_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan WHERE id_penyelesaian=$id")->row_array();
		$no_pengajuan = $data_penyelesaian['nomor_pengajuan'];
        $data_file = $this->db->query("SELECT * FROM tbl_kelebihan_file WHERE nomor_pengajuan = '$no_pengajuan'")->result_array();
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

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_inquiry_kelebihan_detail', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_file' => $data_file,
			'data_pengajuan' => $data_pengajuan
		));
		$this->load->view('footer');
	}

	public function pending()
	{
		date_default_timezone_set("Asia/Jakarta");
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){ // Jika Kantor Pusat

			$data_inquiry = $this->M_master->tampil_pending_penyelesaianHO2($departemen)->result_array();
			$identitas = $departemen;

		}else{ // Jika Cabang
			
            $data_inquiry = $this->M_master->tampil_pending_penyelesaian2($cabang, $level)->result_array();
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_pending_penyelesaian2', array('data_inquiry' => $data_inquiry));
		$this->load->view('footer');
	}

	public function detail_pending($id){
        $data_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan WHERE id_penyelesaian=$id")->row_array();
		$no_pengajuan = $data_penyelesaian['nomor_pengajuan'];
        $data_file = $this->db->query("SELECT * FROM tbl_kelebihan_file WHERE nomor_pengajuan = '$no_pengajuan'")->result_array();
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

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_pending_detail2', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_file' => $data_file,
			'data_pengajuan' => $data_pengajuan
		));
		$this->load->view('footer');
	}

	public function perbaiki_pending($id){
        cek_belum_login();

        $nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
        $cabang = $this->libraryku->tampil_user()->cabang;
        $departemen = $this->libraryku->tampil_user()->departemen;
        $level = $this->libraryku->tampil_user()->level;
        $jabatan_khusus = $this->libraryku->tampil_user()->jabatan_khusus;

        if($cabang=='HEAD OFFICE'){
            $identitas = $departemen;
        }else{
            $identitas = $level;
        }

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
        
		// $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cabang' AND bagian='$identitas' AND status_bayar='Telah Dibayar' AND status_penyelesaian='' ")->result_array();

		$data_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan WHERE id_penyelesaian=$id")->row_array();
		$nomor_pengajuan = $data_penyelesaian['nomor_pengajuan'];
		$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$nomor_pengajuan'")->row_array();
		
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_perbaiki_penyelesaian_pending2', array(
			'data_pengajuan' => $data_pengajuan,
			'data_penyelesaian' => $data_penyelesaian
		));
		$this->load->view('footer');
	}


	public function verified()
	{
		date_default_timezone_set("Asia/Jakarta");
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){ // Jika Kantor Pusat

			$data_inquiry = $this->M_master->tampil_verified_penyelesaianHO2($departemen)->result_array();
			$identitas = $departemen;

		}else{ // Jika Cabang
			
            $data_inquiry = $this->M_master->tampil_verified_penyelesaian2($cabang, $level)->result_array();
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_verified_penyelesaian2', array('data_inquiry' => $data_inquiry));
		$this->load->view('footer');
	}


	// function untuk relasi pilihan biaya
	public function ambil_data_filter(){
		// Untuk Pencarian Sub Biaya
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;
		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$modul=$this->input->post('modul');
		$id=$this->input->post('id');

		if($modul=="sub_biaya"){
			echo $this->M_master->sub_biaya_filter($id, $identitas);
		}
	}


	public function cetak_pengajuan($id){
		date_default_timezone_set("Asia/Jakarta");
		
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_jb = $this->M_master->tampil_jenis_biaya()->result_array();
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_check_file = $this->M_master->tampil_check_no('tbl_check_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
		$data_perdin = $this->M_master->tampil_perdin('tbl_pengajuan_perdin', array('nomor_pengajuan' => $no_pengajuan))->row_array();

		$this->load->view('v_pengajuan_pdf', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_perdin' => $data_perdin
		));

		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("struk_pengajuan.pdf",array('Attachment' => 0)); //Nama Hasil Export PDF
	}


}
