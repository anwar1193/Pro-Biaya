<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox_dirfin extends CI_Controller {

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

		$data_inbox = $this->M_master->tampil_inbox_director_finance($nama_lengkap)->result_array();
		

		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb' => $data_jb));
		$this->load->view('v_inbox_dirfin', array('data_inbox' => $data_inbox));
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
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_perdin = $this->M_master->tampil_perdin('tbl_pengajuan_perdin', array('nomor_pengajuan' => $no_pengajuan))->row_array();

		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		// Untuk Data Split Pembayaran
		$data_byr = $this->db->query("SELECT * FROM tbl_bayar INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
		$frek_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->num_rows();

		$data_byr2 = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id")->result_array();

		// Tampilkan Data Memo
		$data_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_inbox_dirfin_detail', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_perdin' => $data_perdin,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'data_byr2' => $data_byr2,
			'data_memo' => $data_memo
		));
		$this->load->view('footer');
	}

	public function approve(){
		date_default_timezone_set("Asia/Jakarta");
		$id = $this->input->post('id');
		$level = $this->libraryku->tampil_user()->jabatan_khusus;
		$nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];

		//Jika Pengajuan Diatas Limit Maksimal Approve Direktur, Lanjut ke Presiden Direktur
		$limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
		$max_approve = $limit_approve['max_approve'];
		$total_pengajuan = $data_pengajuan['total'];

		if($total_pengajuan > $max_approve){ //Jika Pengajuan Lebih Besar Dari Limit
			$result = $this->M_master->approve_pengajuan('tbl_pengajuan',array(
				'status_approve' => 'approved',
				'approved_by' => 'director finance',
				'nama_pengapprove' => $nama_lengkap
			), array('id_pengajuan' => $id));
		}else{ //Jika Pengajuan Lebih Kecil Dari Limit, Approve Selesai
			$result = $this->M_master->approve_pengajuan('tbl_pengajuan',array(
				'status_approve' => 'final approved',
				'approved_by' => 'director finance',
				'nama_pengapprove' => $nama_lengkap,
				'tanggal_approved' => date('Y-m-d'),
				'wa_blast' => 'off',
				'balik_lagi' => ''
			), array('id_pengajuan' => $id));
		}

		if($result>0){

			//Jika Pengajuan Diatas Limit Maksimal Approve Direktur
			$limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
			$max_approve = $limit_approve['max_approve'];
			$total_pengajuan = $data_pengajuan['total'];

			if($total_pengajuan > $max_approve){ //Jika Pengajuan Lebih Besar Dari Limit
				$this->M_master->simpan_approve_history('tbl_approved_history', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'approved',
					'approved_by' => 'director finance',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note')
				));
			}else{ //Jika Pengajuan Lebih Kecil Dari Limit, Approve Selesai
				$this->M_master->simpan_approve_history('tbl_approved_history', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'final approved',
					'approved_by' => 'director finance',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note')
				));
			}
			

			$this->session->set_flashdata('pesan','Pengajuan Berhasil di Approve');
			redirect('inbox_dirfin');
		}
	}

	public function reject(){
		$id = $this->input->post('id');
		date_default_timezone_set("Asia/Jakarta");
		$level = $this->libraryku->tampil_user()->level;
		$nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		

		$result = $this->M_master->approve_pengajuan('tbl_pengajuan',array(
			'status_approve' => 'rejected',
			'approved_by' => 'director finance',
			'nama_pengapprove' => $nama_lengkap
		), array('id_pengajuan' => $id));
		

		if($result>0){

			$this->M_master->simpan_approve_history('tbl_approved_history', array(
				'nomor_pengajuan' => $no_pengajuan,
				'status_approve' => 'rejected',
				'approved_by' => 'director finance',
				'nama_pengapprove' => $nama_lengkap,
				'tanggal' => date('Y-m-d'),
				'note' => $this->input->post('note')
			));
			
			// Saat di reject, saldo budget kembali ke cabang/dept YBS
			$tanggal_pengajuan = $data_pengajuan['tanggal'];
			$bulan_pengajuan = substr($tanggal_pengajuan, 5,2);
			$cabang = $data_pengajuan['cabang'];
			$departemen = $data_pengajuan['bagian'];
			$sub_biaya = $data_pengajuan['sub_biaya'];
			$total = $data_pengajuan['total'];

			if($bulan_pengajuan=='08'){
				$this->db->query("UPDATE tbl_budget 
					SET 
						agu20_akhir=(agu20_akhir+$total), agu20_realisasi=(agu20_realisasi-$total) 
					WHERE 
						cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
			}elseif($bulan_pengajuan=='09'){
				$this->db->query("UPDATE tbl_budget 
					SET 
						sep20_akhir=(sep20_akhir+$total), sep20_realisasi=(sep20_realisasi-$total) 
					WHERE 
						cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
			}elseif($bulan_pengajuan=='10'){
				$this->db->query("UPDATE tbl_budget 
					SET 
						okt20_akhir=(okt20_akhir+$total), okt20_realisasi=(okt20_realisasi-$total) 
					WHERE 
						cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
			}elseif($bulan_pengajuan=='11'){
				$this->db->query("UPDATE tbl_budget 
					SET 
						nov20_akhir=(nov20_akhir+$total), nov20_realisasi=(nov20_realisasi-$total) 
					WHERE 
						cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
			}elseif($bulan_pengajuan=='12'){
				$this->db->query("UPDATE tbl_budget 
					SET 
						des20_akhir=(des20_akhir+$total), des20_realisasi=(des20_realisasi-$total) 
					WHERE 
						cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'");
			}


			$this->session->set_flashdata('pesan','Pengajuan Berhasil di Reject');
			redirect('inbox_dirfin');

		}
	}


	public function revisi(){
		$id = $this->input->post('id');
		date_default_timezone_set("Asia/Jakarta");
		$level = $this->libraryku->tampil_user()->level;
		$nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];

		$result = $this->M_master->approve_pengajuan('tbl_pengajuan',array(
			'status_approve' => 'revisi',
			'approved_by' => 'director finance',
			'nama_pengapprove' => $nama_lengkap
		), array('id_pengajuan' => $id));
		

		if($result>0){

			$this->M_master->simpan_approve_history('tbl_approved_history', array(
				'nomor_pengajuan' => $no_pengajuan,
				'status_approve' => 'revisi',
				'approved_by' => 'director finance',
				'nama_pengapprove' => $nama_lengkap,
				'tanggal' => date('Y-m-d'),
				'note' => $this->input->post('note')
			));
			

			$this->session->set_flashdata('pesan','Pengajuan Biaya Akan Dikembalikan Ke Pihak Pengaju Untuk Diperbaiki');
			redirect('inbox_dirfin');
		}
	}

}
