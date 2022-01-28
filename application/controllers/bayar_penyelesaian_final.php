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

		if(isset($_POST['cari_data'])){
			$tanggal_from = date('Y-m-d', strtotime($this->input->post('tanggal_from')));
			$tanggal_to = date('Y-m-d', strtotime($this->input->post('tanggal_to')));
			$nama_bank = $this->input->post('nama_bank');

			$data_inquiry = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_penyelesaian_kekurangan.status_bayar_penyelesaian='Proses Bayar' AND (tbl_penyelesaian_kekurangan.tanggal_rencana_bayar_penyelesaian BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_penyelesaian_kekurangan.bank='$nama_bank' ORDER BY tbl_penyelesaian_kekurangan.tanggal_rencana_bayar_penyelesaian ASC")->result_array();
		}else{
			$data_inquiry = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_penyelesaian_kekurangan.status_bayar_penyelesaian='Proses Bayar' ORDER BY tbl_penyelesaian_kekurangan.tanggal_rencana_bayar_penyelesaian ASC")->result_array();
		}

        $identitas = $level;

		$nomor_pymt_penyelesaian = $this->M_master->nojur_pymt_penyelesaian();
		$data_bank_pengaju = $this->db->query("SELECT * FROM tbl_bank_pengaju ORDER BY nama_bank")->result_array();
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_bayar_penyelesaian_final', array(
			'data_inquiry' => $data_inquiry,
			'nomor_pymt_penyelesaian' => $nomor_pymt_penyelesaian,
			'data_bank_pengaju' => $data_bank_pengaju
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


	public function ubah_tanggal(){
		$tanggal_baru = date('Y-m-d', strtotime($this->input->post('tanggal_rencana_bayar')));
		$id_penyelesaian = $this->input->post('id_penyelesaian');

		$result = $this->M_master->update_pengajuan('tbl_penyelesaian_kekurangan', array(
			'tanggal_rencana_bayar_penyelesaian' => $tanggal_baru
		), array('id_penyelesaian' => $id_penyelesaian));

		if($result>0){
			echo '<script>
				alert("Tanggal Rencana Bayar Berhasil Diubah");window.location="index";
			</script>';
		}
	}

	public function ubah_bank(){
		$bank = $this->input->post('bank_bayar');
		$id_penyelesaian = $this->input->post('id_penyelesaian');

		$result = $this->M_master->update_pengajuan('tbl_penyelesaian_kekurangan', array(
			'bank_bayar_penyelesaian' => $bank
		), array('id_penyelesaian' => $id_penyelesaian));

		if($result>0){
			echo '<script>
				alert("Bank Bayar Berhasil Diubah");window.location="index";
			</script>';
		}
	}

	public function revisi_rekening(){
		$id_penyelesaian = $this->input->post('id_penyelesaian');

		$result = $this->M_master->update_pengajuan('tbl_penyelesaian_kekurangan', array(
			'revisi_rekening_penyelesaian' => 'ya',
			'alasan_revisi_rekening_penyelesaian' => $this->input->post('alasan_revisi_rekening')
		), array('id_penyelesaian'=>$id_penyelesaian));

		if($result>0){
			echo '<script>
				alert("Permintaan revisi rekening terkirim ke PIC Reviewer");window.location="index";
			</script>';
		}

	}


	public function cetak(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = $this->input->post('tanggal');
		$bank_penerima = $this->input->post('bank_penerima');

		if($bank_penerima == 'Semua Bank'){

			// Ambil Data Pengajuan Dipilih Untuk Proses2 di bawah
			$data_penyelesaian = $this->M_master->pilih_cetak_penyelesaian(array(
				'tbl_penyelesaian_kekurangan.tanggal_rencana_bayar_penyelesaian' => $tanggal
			))->result_array();

			// Cari tanggal untuk di cetak
			$data_tunggal = $this->M_master->pilih_cetak_penyelesaian(array(
				'tbl_penyelesaian_kekurangan.tanggal_rencana_bayar_penyelesaian' => $tanggal
			))->row_array();

			$tanggal = $data_tunggal['tanggal_rencana_bayar_penyelesaian'];

			// Cek Apakah Data Yang Mau Di Cetak Ada
			$cek_ada = $this->M_master->pilih_cetak_penyelesaian(array(
				'tbl_penyelesaian_kekurangan.tanggal_rencana_bayar_penyelesaian' => $tanggal
			))->num_rows();

		}else{

			// Ambil Data Pengajuan Dipilih Untuk Proses2 di bawah
			$data_penyelesaian = $this->M_master->pilih_cetak_penyelesaian(array(
				'tbl_penyelesaian_kekurangan.tanggal_rencana_bayar_penyelesaian' => $tanggal,
				'tbl_penyelesaian_kekurangan.bank' => $bank_penerima
			))->result_array();

			// Cari tanggal untuk di cetak
			$data_tunggal = $this->M_master->pilih_cetak_penyelesaian(array(
				'tbl_penyelesaian_kekurangan.tanggal_rencana_bayar_penyelesaian' => $tanggal,
				'tbl_penyelesaian_kekurangan.bank' => $bank_penerima
			))->row_array();

			$tanggal = $data_tunggal['tanggal_rencana_bayar_penyelesaian'];

			// Cek Apakah Data Yang Mau Di Cetak Ada
			$cek_ada = $this->M_master->pilih_cetak_penyelesaian(array(
				'tbl_penyelesaian_kekurangan.tanggal_rencana_bayar_penyelesaian' => $tanggal,
				'tbl_penyelesaian_kekurangan.bank' => $bank_penerima
			))->num_rows();

		}


		if($cek_ada > 0){ //jika data yang di cetak ada
			// Ke Report
			$this->load->view('v_pdf_bayar_penyelesaian', array(
				'data_penyelesaian' => $data_penyelesaian,
				'tanggal' => $tanggal
			));
		}else{ //jika tidak ada data yang di cetak
			redirect('bayar_penyelesaian_final');
		}

	}


}
