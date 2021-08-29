<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_kekurangan_accounting extends CI_Controller {

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

		$data_review = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_penyelesaian_kekurangan.status_verifikasi_penyelesaian='Verified' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC")->result_array();

		$identitas = $departemen;
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_review_kekurangan_acc', array('data_review' => $data_review));
		$this->load->view('footer');
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
		$this->load->view('v_review_kekurangan_detail_acc', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history
		));
		$this->load->view('footer');
	}

    public function verifikasi(){
        // Cari nomor_pengajuan
        $id_penyelesaian = $this->input->post('id');
        $id_pengajuan = $this->input->post('id_pengajuan');
        $note_verifikasi = $this->input->post('note_verifikasi');

        
        // Update status_penyelesaian di tbl_penyelesaian_kelebihan
        $update_status = $this->M_master->update_pengajuan('tbl_penyelesaian_kekurangan', array(
            'status_verifikasi_penyelesaian' => 'Verified By ACC',
            'note_verifikasi_penyelesaian' => $note_verifikasi
        ), array('id_penyelesaian' => $id_penyelesaian));

        if($update_status > 0){

            $this->session->set_flashdata('pesan','Verifikasi Penyelesaian Kekurangan Biaya Berhasil');
            redirect('review_kekurangan_accounting');
        }
    }

    public function pending(){
        // Cari nomor_pengajuan
        $id_penyelesaian = $this->input->post('id');
        $id_pengajuan = $this->input->post('id_pengajuan');
        $note_pending = $this->input->post('note_pending');

        
        // Update status_penyelesaian di tbl_penyelesaian_kelebihan
        $update_status = $this->M_master->update_pengajuan('tbl_penyelesaian_kekurangan', array(
            'status_verifikasi_penyelesaian' => 'Pending',
            'note_verifikasi_penyelesaian' => $note_pending
        ), array('id_penyelesaian' => $id_penyelesaian));

        if($update_status > 0){

            $this->session->set_flashdata('pesan','Penyelesaian Kekurangan Biaya Berhasil Di Pending');
            redirect('review_kekurangan_biaya');
        }
    }

	public function jurnal_pic($id){
		// $data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$data_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_penyelesaian_kekurangan.id_penyelesaian = $id")->row_array();
		$no_pengajuan = $data_penyelesaian['nomor_pengajuan'];

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		// Ambil COA (Nomor Perkiraan)
		$sub_biaya = $data_penyelesaian['sub_biaya'];
		$dept = $data_penyelesaian['bagian'];
		$ambil_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya' AND departemen='$dept'")->row_array();
		$coa = $ambil_coa['coa'];
		$nama_coa = $ambil_coa['nama_coa'];


		$this->load->view('header');
		// $this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_jurnal_pic_penyelesaian', array(
			'data_penyelesaian' => $data_penyelesaian,
			'coa' => $coa,
			'nama_coa' => $nama_coa
		));
		$this->load->view('footer');
	}


	public function jurnal_finance($id){
		$data_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_penyelesaian_kekurangan.id_penyelesaian = $id")->row_array();

		$no_pengajuan = $data_penyelesaian['nomor_pengajuan'];

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		// Ambil COA (Nomor Perkiraan)
		$sub_biaya = $data_penyelesaian['sub_biaya'];
		$dept = $data_penyelesaian['bagian'];
		$ambil_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya' AND departemen='$dept'")->row_array();
		$coa = $ambil_coa['coa'];
		$nama_coa = $ambil_coa['nama_coa'];

		$this->load->view('header');
		// $this->load->view('sidebar', array('data_jb'=>$data_jb));

		//jika pembayaran lebih dari sekali
		$this->load->view('v_jurnal_finance_penyelesaian', array(
			'data_penyelesaian' => $data_penyelesaian,
			'coa' => $coa,
			'nama_coa' => $nama_coa
		));

		$this->load->view('footer');
	}


}
