<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P_bayar extends CI_Controller {

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

			$data_bayar = $this->M_master->tampil_bayar_filter($tanggal_from, $tanggal_to, $bank_bayar)->result_array();;

		}else{
			$data_bayar = $this->M_master->tampil_bayar()->result_array();
		}
		
		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$data_bank_pengaju = $this->db->query("SELECT * FROM tbl_bank_pengaju ORDER BY nama_bank")->result_array();

		// Nomor Jurnal BMHD
		$nojur_bmhd = $this->M_master->nojur_bmhd();
		
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_p_bayar', array(
			'data_bayar' => $data_bayar,
			'data_bank_pengaju' => $data_bank_pengaju,
			'nojur_bmhd' => $nojur_bmhd
		));
		$this->load->view('footer');
	}

	public function hapus($id){
		$result = $this->M_master->hapus_pengajuan('tbl_pengajuan', array('id_pengajuan' => $id));
		if($result>0){
			redirect('P_on_proccess');
		}
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
		$this->load->view('v_p_detail_bayar', array(
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
		// Update status_bayar di tbl_pengajuan
		$id_pengajuan = $this->input->post('id');

		$result = $this->M_master->update_pengajuan('tbl_pengajuan', array(
			'status_bayar' => 'Proses Bayar',
			'tanggal_bayar' => date('Y-m-d', strtotime($this->input->post('tanggal_bayar'))),
			'bank_bayar' => $this->input->post('bank_bayar'),
			'catatan' => $this->input->post('note')
		), array('id_pengajuan'=>$id_pengajuan));

		if($result>0){

			// Update Informasi Di Cashflow
			$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id_pengajuan)->row_array();
			$no_pengajuan = $data_pengajuan['nomor_pengajuan'];
			$data_check = $this->M_master->tampil_check_no('tbl_check', array('nomor_pengajuan' => $no_pengajuan))->row_array();
			$tanggal_sebelumnya0 = $data_check['tanggal_bayar'];
			$tanggal_sebelumnya = date('d-m-Y', strtotime($tanggal_sebelumnya0));

			$kode_cashflow = $this->input->post('kode_cashflow');
			$tanggal_0 = $this->input->post('tanggal_bayar');
			$tanggal = date('d-m-Y', strtotime($tanggal_0));

			$con_cashflow = mysqli_connect('localhost','root','','db_cashflow');

			$quer_cash = "UPDATE tbl_cashoutproj SET tanggal='$tanggal' WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal_sebelumnya'";

			// $quer_cash = "UPDATE tbl_cashoutproj SET projection='$proj_baru' WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal'";
			mysqli_query($con_cashflow, $quer_cash);

			// Penutup Update Informasi Di Cashflow


			// simpan file pendukung nya
			$data = [];
			$count = count($_FILES['files']['name']);
			for($i=0; $i<$count; $i++){
				if(!empty($_FILES['files']['name'][$i])){
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$config['upload_path'] = './file_bayar';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx|xlsx';
					$config['max_size'] = 2048;
					// $config['file_name'] = $_FILES['files']['name'][$i];
					$config['file_name'] = 'bayar-'.date('ymd').'-'.substr(md5(rand()),0,10).'-'.$i;
					// $config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);

					if($this->upload->do_upload('file')){
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
						$image[$i] = $filename;
						$content = [
							'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
							'file' => $image[$i]
						];
						$this->M_master->simpan_pengajuan('tbl_bayar_file', $content);
					}
				}
			}

			$this->session->set_flashdata('pesan','Konfirmasi Pembayaran Berhasil');
			redirect('p_bayar/index');

		}

	}


	public function bayar_sekaligus(){
		date_default_timezone_set("Asia/Jakarta");
		$id_pengajuan = $this->input->post('id');


		if($id_pengajuan == ''){
			echo '<script>alert("Tidak Ada Pengajuan yang Dipilih");window.location="index"</script>';
		}else{
			// jalankan for sampai ke bawah nya
		

			for ($i=0; $i<sizeof($id_pengajuan); $i++) { 
				
				$result = $this->M_master->update_pengajuan('tbl_bayar', array(
					'status_bayar' => 'Proses Bayar',
					'tanggal_rencana_bayar' => date('Y-m-d', strtotime($this->input->post('tanggal_bayar'))),
					'bank_bayar' => $this->input->post('bank_bayar'),
					'catatan' => $this->input->post('note')
				), array('id'=>$id_pengajuan[$i]));

				// Cari nomor pengajuan untuk update cashflow
				$res_nopeng = $this->db->query("SELECT * FROM tbl_bayar WHERE id='$id_pengajuan[$i]'")->row_array();
				$nopeng = $res_nopeng['nomor_pengajuan'];

				// Ubah Juga Di tbl_pengajuan(utama)
				$this->M_master->update_pengajuan('tbl_pengajuan', array(
					'status_bayar' => 'Proses Bayar'
				), array('nomor_pengajuan' => $nopeng));

				// Ambil Data Pengajuan Dipilih Untuk Proses2 di bawah
				$data_pengajuan = $this->M_master->pengajuan_dipilih(array(
					'tbl_bayar.nomor_pengajuan' => $nopeng
				))->row_array();

				// Simpan Ke Proyeksi Cashflow
				$kode_cashflow = $data_pengajuan['kode_cashflow'];
				$biaya = $data_pengajuan['sub_biaya'];
				$tanggal_0 = $this->input->post('tanggal_bayar');
				$tanggal = date('d-m-Y', strtotime($tanggal_0));
				$total =$data_pengajuan['jumlah_bayar'];

				$con_cashflow = mysqli_connect('localhost','root','','db_cashflow');

				// Cek Apa Proyeksi Sudah Ada Sebelumnya
				$q_cek = "SELECT * FROM tbl_cashoutproj WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal'";
				$r_cek = mysqli_query($con_cashflow, $q_cek) or die ('error cek');
				$cek = mysqli_num_rows($r_cek);
				$data = mysqli_fetch_array($r_cek);

				// if($cek>0){//jika data sudah ada
				// 	$proj_lama = $data['projection'];
				// 	$proj_tambahan = $total;
				// 	$proj_baru = $proj_lama + $proj_tambahan;

				// 	$quer_cash = "UPDATE tbl_cashoutproj SET projection='$proj_baru' WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal'";
				// }else{ //jika data belum ada
				// 	$quer_cash = "INSERT INTO tbl_cashoutproj(kode_status,status,tanggal,projection)
				// 				VALUES('$kode_cashflow', '$biaya', '$tanggal', '$total')";
				// }

				// Tp2
				$quer_cash = "INSERT INTO tbl_cashoutproj(kode_status,status,tanggal,projection)
								VALUES('$kode_cashflow', '$biaya', '$tanggal', '$total')";

				mysqli_query($con_cashflow, $quer_cash);
				
				// Penutup Simpan Ke Proyeksi Cashflow


			}

			// Jika Semua di tbl_bayar (untuk 1 nomor pengajuan) sudah di proses bayar, maka update juga status_bayar di pengajuan utama (tbl_pengajuan) -> Next
			// $this->M_master->update_pengajuan('tbl_pengajuan', array(
			// 	'status_bayar' => 'Proses Bayar'
			// ), array('nomor_pengajuan'=>$nopeng));

		}

		
		$this->session->set_flashdata('pesan','Konfirmasi Pembayaran Berhasil');
		redirect('p_bayar');
	}

	public function bayar_satu(){
		date_default_timezone_set("Asia/Jakarta");
		$hari_ini = date('Y-m-d');
		$jam_sekarang = date('H:i:s');
		$nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;

		$id_pengajuan = $this->input->post('id');
		$jml_bayar_lama = $this->input->post('jumlah_bayar');
		$pph23 = $this->input->post('pph23');
		$pph42 = $this->input->post('pph42');
		$pph21 = $this->input->post('pph21');
		$jml_bayar = $jml_bayar_lama - ($pph23 + $pph42 + $pph21);
		$jml_sebelum_pajak = $this->input->post('jumlah_sebelum_pajak');

		// Cek Apakah Pajak Lebih Besar Dari Jumlah Biaya
		if($jml_bayar_lama <= ($pph23 + $pph42 + $pph21)) {
			echo "<script>
				alert('Jumlah Pajak Tidak Boleh Lebih Besar/Sama Dengan Jumlah Biaya !');
				window.location = 'index';
			</script>";
			exit;
		}

		$result = $this->M_master->update_pengajuan('tbl_bayar', array(
			'status_bayar' => 'Proses Bayar',
			'tanggal_rencana_bayar' => date('Y-m-d', strtotime($this->input->post('tanggal_bayar'))),
			'tanggal_proses_bayar' => $hari_ini,
			'jam_proses_bayar' => $jam_sekarang,
			'pic_proses_bayar' => $nama_lengkap,
			'bank_bayar' => $this->input->post('bank_bayar'),
			'catatan' => $this->input->post('note'),
			'jumlah_bayar' => $jml_sebelum_pajak,
			'pph23_bayar' => $pph23,
			'pph42_bayar' => $pph42,
			'pph21_bayar' => $pph21
		), array('id'=>$id_pengajuan));

		// Cari nomor pengajuan untuk update cashflow
		$res_nopeng = $this->db->query("SELECT * FROM tbl_bayar WHERE id='$id_pengajuan'")->row_array();
		$nopeng = $res_nopeng['nomor_pengajuan'];

		// Ambil Data pph sebelumnya, supaya jika pembayaran lebih dari 1x, pph sebelumnya tidak ter-replace
		$res_pph = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$nopeng'")->row_array();
		$pph23_lama = $res_pph['pph23'];
		$pph42_lama = $res_pph['pph42'];
		$pph21_lama = $res_pph['pph21'];

		// PPH yang baru (pph lama + pph diinput)
		$pph23_baru = $pph23 + $pph23_lama;
		$pph42_baru = $pph42 + $pph42_lama;
		$pph21_baru = $pph21 + $pph21_lama;

		// Cek apakah nomor BMHD sudah terbentuk sebelumnya
		$cek_bmhd = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$nopeng' AND nomor_bmhd=''")->row_array();

		if($cek_bmhd > 1){ //jika bmhd belum terbentuk, update tanggal_proses_bayar(BMHD) & nomor_bmhd

			// Ubah Di tbl_pengajuan(utama)
			$this->M_master->update_pengajuan('tbl_pengajuan', array(
				'status_bayar' => 'Proses Bayar',
				'tanggal_proses_bayar' => $hari_ini,
				'pph23' => $pph23_baru,
				'pph42' => $pph42_baru,
				'pph21' => $pph21_baru,
				'nomor_bmhd' => $this->input->post('nomor_bmhd')
			), array('nomor_pengajuan' => $nopeng));

		}else{ //jika bmhd sudah terbentuk, jangan update nomor bmhd

			// Ubah Di tbl_pengajuan(utama)
			$this->M_master->update_pengajuan('tbl_pengajuan', array(
				'status_bayar' => 'Proses Bayar',
				'pph23' => $pph23_baru,
				'pph42' => $pph42_baru,
				'pph21' => $pph21_baru
			), array('nomor_pengajuan' => $nopeng));

		}


		// Ambil Data Pengajuan Dipilih Untuk Proses2 di bawah
		$data_pengajuan = $this->M_master->pengajuan_dipilih(array(
			'tbl_bayar.nomor_pengajuan' => $nopeng
		))->row_array();

		// Simpan Ke Proyeksi Cashflow
		$kode_cashflow = $data_pengajuan['kode_cashflow'];
		$biaya = $data_pengajuan['sub_biaya'];
		$tanggal_0 = $this->input->post('tanggal_bayar');
		$tanggal = date('d-m-Y', strtotime($tanggal_0));
		$total = $jml_bayar;

		$con_cashflow = mysqli_connect('localhost','root','','db_cashflow');

		// Cek Apa Proyeksi Sudah Ada Sebelumnya
		$q_cek = "SELECT * FROM tbl_cashoutproj WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal'";
		$r_cek = mysqli_query($con_cashflow, $q_cek) or die ('error cek');
		$cek = mysqli_num_rows($r_cek);
		$data = mysqli_fetch_array($r_cek);

		if($cek>0){//jika data sudah ada
			$proj_lama = $data['projection'];
			$proj_tambahan = $total;
			$proj_baru = $proj_lama + $proj_tambahan;

			$quer_cash = "UPDATE tbl_cashoutproj SET projection='$proj_baru' WHERE kode_status='$kode_cashflow' AND tanggal='$tanggal'";
		}else{ //jika data belum ada
			$quer_cash = "INSERT INTO tbl_cashoutproj(kode_status,status,tanggal,projection)
						VALUES('$kode_cashflow', '$biaya', '$tanggal', '$total')";
		}

		mysqli_query($con_cashflow, $quer_cash);
		
		// Penutup Simpan Ke Proyeksi Cashflow

		$this->session->set_flashdata('pesan','Konfirmasi Pembayaran Berhasil');
		redirect('p_bayar');
	}

	public function revisi_dept(){
		$nomor_pengajuan = $this->input->post('nomor_pengajuan');
		$id_pengajuan = $this->input->post('id');

		$result = $this->M_master->update_pengajuan('tbl_pengajuan', array(
			'revisi_finance' => 'ya',
			'ket_refin' => $this->input->post('ket_refin')
		), array('nomor_pengajuan' => $nomor_pengajuan));

		if($result>0){
			$this->M_master->simpan_pengajuan('tbl_jurnal_reverse', array(
				'id_pengajuan' => $this->input->post('id_pengajuan'),
				'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
				'tanggal' => $this->input->post('tanggal'),
				'sub_biaya' => $this->input->post('sub_biaya'),
				'cabang' => $this->input->post('cabang'),
				'bagian' => $this->input->post('bagian'),
				'total' => $this->input->post('total'),
				'keterangan' => $this->input->post('keterangan'),
				'approved_by' => $this->input->post('approved_by'),
				'nama_pengapprove' => $this->input->post('nama_pengapprove'),
				'tanggal_approved' => $this->input->post('tanggal_approved'),
				'tanggal_reverse' => $this->input->post('tanggal_reverse')
			));

			$this->session->set_flashdata('pesan','Pengajuan Revisi Terkirim Ke PIC Departemen');
			redirect('p_bayar/detail/'.$id_pengajuan);
		}
	}

}
