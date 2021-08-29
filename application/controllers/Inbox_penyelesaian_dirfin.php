<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox_penyelesaian_dirfin extends CI_Controller {

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
		$level = $this->libraryku->tampil_user()->level;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap; //untuk parameter direktur

		$limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
		$min_approve = $limit_approve['min_approve'];
		$max_approve = $limit_approve['max_approve'];

		$data_inbox = $this->M_master->tampil_inbox_director_finance2($nama_lengkap)->result_array();
		

		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb' => $data_jb));
		$this->load->view('v_inbox_dirfin_penyelesaian', array('data_inbox' => $data_inbox));
		$this->load->view('footer');
	}

	public function ke_index(){
		redirect('inbox');
	}

	public function hapus($id){
		$result = $this->M_master->hapus_pengajuan('tbl_pengajuan', array('id_pengajuan' => $id));
		if($result>0){
			redirect('P_on_proccess');
		}
	}

	public function detail($id){
        date_default_timezone_set("Asia/Jakarta");
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

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_inbox_dirfin_penyelesaian_detail', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_pengajuan' => $data_pengajuan
		));
		$this->load->view('footer');
	}

	public function approve(){
		date_default_timezone_set("Asia/Jakarta");
		$id = $this->input->post('id');
        $id_pengajuan = $this->input->post('id_pengajuan');
		$realisasi = $this->input->post('realisasi');

		$level = $this->libraryku->tampil_user()->jabatan_khusus;
		$nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id_pengajuan)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];

		//Jika Pengajuan Diatas Limit Maksimal Approve Direktur, Lanjut ke Presiden Direktur
		$limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
		$max_approve = $limit_approve['max_approve'];
		$total_pengajuan = $realisasi;

		if($total_pengajuan > $max_approve){ //Jika Pengajuan Lebih Besar Dari Limit
			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'approved',
				'approved_by_penyelesaian' => 'director finance',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));
		}else{ //Jika Pengajuan Lebih Kecil Dari Limit, Approve Selesai
			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'final approved',
				'approved_by_penyelesaian' => 'director finance',
				'nama_pengapprove_penyelesaian' => $nama_lengkap,
				'tanggal_approved_penyelesaian' => date('Y-m-d')
				// 'wa_blast' => 'off',
				// 'balik_lagi' => ''
			), array('id_penyelesaian' => $id));

            // update status_penyelesaian di tbl_pengajuan
            $this->M_master->approve_pengajuan('tbl_pengajuan', array(
                'status_penyelesaian' => 'final approved'
            ), array('id_pengajuan' => $id_pengajuan));
		}

		if($result>0){

			//Jika Pengajuan Diatas Limit Maksimal Approve Direktur
			$limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
			$max_approve = $limit_approve['max_approve'];
			$total_pengajuan = $realisasi;

			if($total_pengajuan > $max_approve){ //Jika Pengajuan Lebih Besar Dari Limit
				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'approved',
					'approved_by' => 'director finance',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note')
				));
			}else{ //Jika Pengajuan Lebih Kecil Dari Limit, Approve Selesai
				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'final approved',
					'approved_by' => 'director finance',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note')
				));
			}
			

			$this->session->set_flashdata('pesan','Pengajuan Berhasil di Approve');
			redirect('inbox_penyelesaian_dirfin');
		}
	}


	public function reject(){
		date_default_timezone_set("Asia/Jakarta");

		$id = $this->input->post('id');
		$id_pengajuan = $this->input->post('id_pengajuan');
		$level = $this->libraryku->tampil_user()->level;
		$nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id_pengajuan)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];

		$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
			'status_approve_penyelesaian' => 'rejected',
			'approved_by_penyelesaian' => 'director finance',
			'nama_pengapprove_penyelesaian' => $nama_lengkap
		), array('id_penyelesaian' => $id));

		// update status_penyelesaian di tbl_pengajuan
		$this->M_master->approve_pengajuan('tbl_pengajuan', array(
			'status_penyelesaian' => 'rejected'
		), array('id_pengajuan' => $id_pengajuan));
		

		if($result>0){

			$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
				'nomor_pengajuan' => $no_pengajuan,
				'status_approve' => 'rejected',
				'approved_by' => 'director finance',
				'nama_pengapprove' => $nama_lengkap,
				'tanggal' => date('Y-m-d'),
				'note' => $this->input->post('note_reject')
			));
			

			$this->session->set_flashdata('pesan','Penyelesaian Biaya Berhasil Di Reject');
			redirect('inbox_penyelesaian_dirfin');
		}
	}


	public function revisi(){
		date_default_timezone_set("Asia/Jakarta");

		$id = $this->input->post('id');
		$id_pengajuan = $this->input->post('id_pengajuan');
		$level = $this->libraryku->tampil_user()->level;
		$nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id_pengajuan)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];

		$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
			'status_approve_penyelesaian' => 'revisi',
			'approved_by_penyelesaian' => 'director finance',
			'nama_pengapprove_penyelesaian' => $nama_lengkap
		), array('id_penyelesaian' => $id));

		// update status_penyelesaian di tbl_pengajuan
		$this->M_master->approve_pengajuan('tbl_pengajuan', array(
			'status_penyelesaian' => 'revisi'
		), array('id_pengajuan' => $id_pengajuan));
		

		if($result>0){

			$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
				'nomor_pengajuan' => $no_pengajuan,
				'status_approve' => 'revisi',
				'approved_by' => 'director finance',
				'nama_pengapprove' => $nama_lengkap,
				'tanggal' => date('Y-m-d'),
				'note' => $this->input->post('note_revisi')
			));
			

			$this->session->set_flashdata('pesan','Penyelesaian Biaya Akan Dikembalikan Ke Pihak Pengaju Untuk Diperbaiki');
			redirect('inbox_penyelesaian_dirfin');
		}
	}

}
