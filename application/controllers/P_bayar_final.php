<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P_bayar_final extends CI_Controller {

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

		if(isset($_POST['cari_data'])){
			$tanggal_from = date('Y-m-d', strtotime($this->input->post('tanggal_from')));
			$tanggal_to = date('Y-m-d', strtotime($this->input->post('tanggal_to')));
			$bank_bayar = $this->input->post('nama_bank');

			$data_bayar = $this->M_master->tampil_bayar_final_filter($tanggal_from, $tanggal_to, $bank_bayar)->result_array();;

		}else{
			$data_bayar = $this->M_master->tampil_bayar_final()->result_array();
		}	
		
		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$data_bank_pengaju = $this->db->query("SELECT * FROM tbl_bank_pengaju ORDER BY nama_bank")->result_array();

		// Nomor Jurnal PYMT
		$nojur_pymt = $this->M_master->nojur_pymt();
		
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_bayar_final', array(
			'data_bayar' => $data_bayar,
			'data_bank_pengaju' => $data_bank_pengaju,
			'nojur_pymt' => $nojur_pymt
		));
		$this->load->view('footer');
	}

	public function detail($id){
		$data_pengajuan = $this->M_master->tampil_bayar_detail($id)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();
		$data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();
		$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
		$data_check_file = $this->M_master->tampil_check_no('tbl_check_file', array('nomor_pengajuan' => $no_pengajuan))->result_array();
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
		$this->load->view('v_p_detail_bayar_final', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_perdin' => $data_perdin,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'data_byr2' => $data_byr2,
			'data_memo' => $data_memo
		));
		$this->load->view('footer');
	}


	public function bayar(){
		date_default_timezone_set("Asia/Jakarta");
		$id = $this->input->post('id');
		$nomor_pengajuan = $this->input->post('nomor_pengajuan');
		$jumlah_bayar = $this->input->post('jumlah_bayar');
		$pph23 = $this->input->post('pph23');
		$pph42 = $this->input->post('pph42');
		$pph21 = $this->input->post('pph21');
		$total = $this->input->post('total');
		$hari_ini = date('Y-m-d');
		$jam_sekarang = date('H:i:s');
		$nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
		$ref_no = $this->input->post('ref_no');

		// Update tbl_bayar
		$this->M_master->update_pengajuan('tbl_bayar', array(
			'status_bayar' => 'Telah Dibayar',
			'tanggal_bayar' => $hari_ini,
			'jam_bayar' => $jam_sekarang,
			'pic_bayar' => $nama_lengkap,
			'nomor_pymt' => $this->input->post('nomor_pymt')
		), array('id'=>$id));

		// Update tbl_pengajuan
		$this->M_master->update_pengajuan('tbl_pengajuan', array(
			'status_bayar' => 'Telah Dibayar',
			'tanggal_bayar' => $hari_ini,
			'nomor_pymt' => $this->input->post('nomor_pymt')
		), array('nomor_pengajuan'=>$nomor_pengajuan));

		// Ambil Data Pengajuan Dipilih Untuk Proses2 di bawah
		$data_pengajuan = $this->M_master->pengajuan_dipilih(array(
			'tbl_bayar.nomor_pengajuan' => $nomor_pengajuan
		))->row_array();

		// Simpan Ke Proyeksi Cashflow
		$kode_cashflow = $data_pengajuan['kode_cashflow'];
		$biaya = $data_pengajuan['sub_biaya'];
		$tanggal = date('d-m-Y');

		$con_cashflow = mysqli_connect('localhost','root','','db_cashflow');

		// Cek Apa Proyeksi Sudah Ada Sebelumnya
		$q_cek = "SELECT * FROM tbl_cashoutreal WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal'";
		$r_cek = mysqli_query($con_cashflow, $q_cek) or die ('error cek');
		$cek = mysqli_num_rows($r_cek);
		$data = mysqli_fetch_array($r_cek);

		if($cek>0){//jika data sudah ada
			$real_lama = $data['realisasi'];
			$real_tambahan = $total;
			$real_baru = $real_lama + $real_tambahan;

			$quer_cash = "UPDATE tbl_cashoutreal SET realisasi='$real_baru' WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal'";
		}else{ //jika data belum ada
			$quer_cash = "INSERT INTO tbl_cashoutreal(kode_status,status,tanggal,realisasi)
						VALUES('$kode_cashflow', '$biaya', '$tanggal', '$total')";
		}

		mysqli_query($con_cashflow, $quer_cash);
		// Penutup Simpan Ke Proyeksi Cashflow


		// Simpan File Bayar / Bukti Transfer................................
		$folderUpload = "./file_bayar/".$hari_ini;

		# periksa apakah folder tersedia
		if (!is_dir($folderUpload)) {
		  # jika tidak maka folder harus dibuat terlebih dahulu
		  mkdir($folderUpload, 0777, $rekursif = true);
		}

		// ref_no diambil untuk nama file nya (pembeda antar pengajuan)
		$refno = $this->input->post('ref_no');

		$data = [];
		$count = count($_FILES['files']['name']);
		for($i=0; $i<$count; $i++){
			if(!empty($_FILES['files']['name'][$i])){
				$_FILES['file']['name'] = $_FILES['files']['name'][$i];
				$_FILES['file']['type'] = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['files']['error'][$i];
				$_FILES['file']['size'] = $_FILES['files']['size'][$i];

				$config['upload_path'] = $folderUpload;
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$config['max_size'] = 0;
				// $config['file_name'] = $_FILES['files']['name'][$i];
				$config['file_name'] = date('Y-m-d').'-'.$refno.'-'.substr(md5(rand()),0,5).'-'.$i;
				// $config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);

				if($this->upload->do_upload('file')){
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					$image[$i] = $filename;
					$content = [
						'nomor_pengajuan' => $nomor_pengajuan,
						'file' => $image[$i],
						'nama_file' => $this->input->post('nama_file')[$i]
					];
					$this->M_master->simpan_pengajuan('tbl_bayar_file', $content);
				}
			}
		}

		// END Simpan File Bayar / Bukti Transfer.............................

		$this->session->set_flashdata('pesan','Pengajuan Telah Dibayar');
		redirect('p_bayar_final');

	}

	public function ubah(){
		$id = $this->input->post('id');
		$nopeng = $this->input->post('nomor_pengajuan');
		
		// Cari Data Biaya Lengkap
		$data_bayar = $this->M_master->tampil_bayar_final_filter2(array('tbl_pengajuan.nomor_pengajuan'=>$nopeng))->row_array();

		// Update Ke Proyeksi Cashflow
		$kode_cashflow = $data_bayar['kode_cashflow'];
		$biaya = $data_bayar['sub_biaya'];
		$tanggal_lama0 = $data_bayar['tanggal_rencana_bayar'];
		$tanggal_lama = date('d-m-Y', strtotime($tanggal_lama0));
		$total = $this->input->post('total_bayar');

		$tanggal_0 = $this->input->post('tanggal_rencana_bayar');
		$tanggal_baru = date('d-m-Y', strtotime($tanggal_0));

		$con_cashflow = mysqli_connect('localhost','root','','db_cashflow');

		// 1. ACTION PADA TANGGAL LAMA (KURANGI/HAPUS)
		$data_cashflow = "SELECT * FROM tbl_cashoutproj WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal_lama'";
		$r_data_cashflow = mysqli_query($con_cashflow, $data_cashflow) or die ('error cek2');
		$dt_cashflow = mysqli_fetch_array($r_data_cashflow);
		$proj_awal = $data['projection'];
		$proj_update = $proj_awal - $total;
		$quer_cash_kurang = "UPDATE tbl_cashoutproj SET projection='0' WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal_lama'";
		mysqli_query($con_cashflow, $quer_cash_kurang);

		// 2. ACTION PADA TANGGAL BARU (TAMBAHKAN)
		// Cek Apa Proyeksi Sudah Ada Sebelumnya
		$q_cek = "SELECT * FROM tbl_cashoutproj WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal_baru'";
		$r_cek = mysqli_query($con_cashflow, $q_cek) or die ('error cek');
		$cek = mysqli_num_rows($r_cek);
		$data = mysqli_fetch_array($r_cek);

		if($cek>0){//jika data sudah ada
			$proj_lama = $data['projection'];
			$proj_tambahan = $total;
			$proj_baru = $proj_lama + $proj_tambahan;

			$quer_cash = "UPDATE tbl_cashoutproj SET projection='$proj_baru' WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal_baru'";
		}else{ //jika data belum ada
			$quer_cash = "INSERT INTO tbl_cashoutproj(kode_status,status,tanggal,projection)
						VALUES('$kode_cashflow', '$biaya', '$tanggal_baru', '$total')";
		}

		mysqli_query($con_cashflow, $quer_cash);
		
		// Penutup Update Ke Proyeksi Cashflow

		$this->M_master->update_pengajuan('tbl_bayar', array(
			'tanggal_rencana_bayar' => $this->input->post('tanggal_rencana_bayar')
		), array('id'=>$id));

		$this->session->set_flashdata('pesan','Tanggal Bayar Berhasil Diubah');
		redirect('p_bayar_final');

	}

	public function ubah_bank(){
		$id = $this->input->post('id');
		// Update bank bayar

		$this->M_master->update_pengajuan('tbl_bayar', array(
			'bank_bayar' => $this->input->post('bank_bayar')
		), array('id'=>$id));

		$this->session->set_flashdata('pesan','Bank Bayar Berhasil Diubah');
		redirect('p_bayar_final');

	}

	public function revisi_rekening(){
		$nopeng = $this->input->post('nomor_pengajuan');
		// Update bank bayar

		$this->M_master->update_pengajuan('tbl_pengajuan', array(
			'revisi_rekening' => 'ya',
			'alasan_revisi_rekening' => $this->input->post('alasan_revisi_rekening')
		), array('nomor_pengajuan'=>$nopeng));

		$this->session->set_flashdata('pesan','Permintaan Revisi Rekening Terkirim Ke PIC');
		redirect('p_bayar_final');

	}


	public function cetak(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = $this->input->post('tanggal');
		$bank_penerima = $this->input->post('bank_penerima');

		if($bank_penerima == 'Semua Bank'){

			// Ambil Data Pengajuan Dipilih Untuk Proses2 di bawah
			$data_pengajuan = $this->M_master->pilih_cetak(array(
				'tbl_bayar.tanggal_rencana_bayar' => $tanggal
			))->result_array();

			// Cari tanggal untuk di cetak
			$data_tunggal = $this->M_master->pilih_cetak(array(
				'tbl_bayar.tanggal_rencana_bayar' => $tanggal
			))->row_array();

			$tanggal = $data_tunggal['tanggal_rencana_bayar'];

			// Cari total untuk di cetak
			$data_total = $this->M_master->total_cetak(array(
				'tbl_bayar.tanggal_rencana_bayar' => $tanggal
			))->row_array();

			$total = $data_total['tot_bayar'];
			$total_displit = $data_total['tot_bayar_displit'];

			// Cek Apakah Data Yang Mau Di Cetak Ada
			$cek_ada = $this->M_master->pilih_cetak(array(
				'tbl_bayar.tanggal_rencana_bayar' => $tanggal
			))->num_rows();

		}else{

			// Ambil Data Pengajuan Dipilih Untuk Proses2 di bawah
			$data_pengajuan = $this->M_master->pilih_cetak(array(
				'tbl_bayar.tanggal_rencana_bayar' => $tanggal,
				'tbl_pengajuan.bank_penerima' => $bank_penerima
			))->result_array();

			// Cari tanggal untuk di cetak
			$data_tunggal = $this->M_master->pilih_cetak(array(
				'tbl_bayar.tanggal_rencana_bayar' => $tanggal,
				'tbl_pengajuan.bank_penerima' => $bank_penerima
			))->row_array();

			$tanggal = $data_tunggal['tanggal_rencana_bayar'];

			// Cari total untuk di cetak
			$data_total = $this->M_master->total_cetak(array(
				'tbl_bayar.tanggal_rencana_bayar' => $tanggal,
				'tbl_pengajuan.bank_penerima' => $bank_penerima
			))->row_array();
			$total = $data_total['tot_bayar'];
			$total_displit = $data_total['tot_bayar_displit'];

			// Cek Apakah Data Yang Mau Di Cetak Ada
			$cek_ada = $this->M_master->pilih_cetak(array(
				'tbl_bayar.tanggal_rencana_bayar' => $tanggal,
				'tbl_pengajuan.bank_penerima' => $bank_penerima
			))->num_rows();

		}


		if($cek_ada > 0){ //jika data yang di cetak ada
			// Ke Report
			$this->load->view('v_pdf_bayar', array(
				'data_pengajuan' => $data_pengajuan,
				'tanggal' => $tanggal,
				'total_bayar' => $total,
				'total_bayar_displit' => $total_displit
			));
		}else{ //jika tidak ada data yang di cetak
			redirect('p_bayar_final');
		}

	}

}
