<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiry_kekurangan_biaya extends CI_Controller {

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

			if(isset($_POST['cari_data1'])){

				$sub_biaya = $this->input->post('sub_biaya');
				$data_inquiry = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_pengajuan.bagian='$departemen' AND tbl_pengajuan.sub_biaya='$sub_biaya' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC")->result_array();

			}elseif(isset($_POST['cari_data2'])){

				$status_approval = $this->input->post('status_approval');
				$data_inquiry = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_pengajuan.bagian='$departemen' AND tbl_penyelesaian_kekurangan.status_approve_penyelesaian='$status_approval' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC")->result_array();

			}else{
				$data_inquiry = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_pengajuan.bagian='$departemen' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC")->result_array();
			}

			
			$identitas = $departemen;

		}else{ // Jika Cabang
			
			if(isset($_POST['cari_data1'])){

				$sub_biaya = $this->input->post('sub_biaya');
				$data_inquiry = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.sub_biaya='$sub_biaya' AND tbl_pengajuan.bagian='$level' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC")->result_array();

			}elseif(isset($_POST['cari_data2'])){
				$status_approval = $this->input->post('status_approval');
				$data_inquiry = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$level' AND tbl_penyelesaian_kekurangan.status_approve_penyelesaian='$status_approval' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC")->result_array();
			}else{
				$data_inquiry = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_pengajuan.cabang='$cabang' AND tbl_pengajuan.bagian='$level' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC")->result_array();
			}
            
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_inquiry_kekurangan', array('data_inquiry' => $data_inquiry));
		$this->load->view('footer');
	}

	public function proses_bayar()
	{
		date_default_timezone_set("Asia/Jakarta");
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){ // Jika Kantor Pusat

			// $data_inquiry = $this->M_master->inquiryHO($departemen)->result_array();
            $data_inquiry = $this->M_master->tampil_proses_bayar_penyelesaianHO($departemen)->result_array();
			$identitas = $departemen;

		}else{ // Jika Cabang
			
            // $data_inquiry = $this->M_master->inquiry($cabang, $level)->result_array();
            $data_inquiry = $this->M_master->tampil_proses_bayar_penyelesaian($cabang, $level)->result_array();
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_proses_bayar_penyelesaian', array('data_inquiry' => $data_inquiry));
		$this->load->view('footer');
	}

	public function telah_dibayar()
	{
		date_default_timezone_set("Asia/Jakarta");
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){ // Jika Kantor Pusat

			// $data_inquiry = $this->M_master->inquiryHO($departemen)->result_array();
            $data_inquiry = $this->M_master->tampil_telbayHO2($departemen)->result_array();
			$identitas = $departemen;

		}else{ // Jika Cabang
			
            // $data_inquiry = $this->M_master->inquiry($cabang, $level)->result_array();
            $data_inquiry = $this->M_master->tampil_telbay2($cabang, $level)->result_array();
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_telah_bayar_penyelesaian', array('data_inquiry' => $data_inquiry));
		$this->load->view('footer');
	}

	public function on_proccess()
	{
		date_default_timezone_set("Asia/Jakarta");
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){ // Jika Kantor Pusat

			$data_inquiry = $this->M_master->tampil_onproccessHO2($departemen)->result_array();
			$identitas = $departemen;

		}else{ // Jika Cabang
			
            $data_inquiry = $this->M_master->tampil_onproccess2($cabang, $level)->result_array();
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_on_proccess_penyelesaian', array('data_inquiry' => $data_inquiry));
		$this->load->view('footer');
	}

	public function final_approved()
	{
		date_default_timezone_set("Asia/Jakarta");
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){ // Jika Kantor Pusat

			$data_inquiry = $this->M_master->tampil_approvedHO2($departemen)->result_array();
			$identitas = $departemen;

		}else{ // Jika Cabang
			
            $data_inquiry = $this->M_master->tampil_approved2($cabang, $level)->result_array();
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_approved_penyelesaian', array('data_inquiry' => $data_inquiry));
		$this->load->view('footer');
	}

	public function revisi()
	{
		date_default_timezone_set("Asia/Jakarta");
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){ // Jika Kantor Pusat

			$data_inquiry = $this->M_master->tampil_revisiHO2($departemen)->result_array();
			$identitas = $departemen;

		}else{ // Jika Cabang
			
            $data_inquiry = $this->M_master->tampil_revisi2($cabang, $level)->result_array();
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_revisi_penyelesaian', array('data_inquiry' => $data_inquiry));
		$this->load->view('footer');
	}

	public function rejected()
	{
		date_default_timezone_set("Asia/Jakarta");
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){ // Jika Kantor Pusat

			$data_inquiry = $this->M_master->tampil_rejectedHO2($departemen)->result_array();
			$identitas = $departemen;

		}else{ // Jika Cabang
			
            $data_inquiry = $this->M_master->tampil_rejected2($cabang, $level)->result_array();
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_rejected_penyelesaian', array('data_inquiry' => $data_inquiry));
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

			$data_inquiry = $this->M_master->tampil_pending_penyelesaianHO($departemen)->result_array();
			$identitas = $departemen;

		}else{ // Jika Cabang
			
            $data_inquiry = $this->M_master->tampil_pending_penyelesaian($cabang, $level)->result_array();
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_pending_penyelesaian', array('data_inquiry' => $data_inquiry));
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

			$data_inquiry = $this->M_master->tampil_verified_penyelesaianHO($departemen)->result_array();
			$identitas = $departemen;

		}else{ // Jika Cabang
			
            $data_inquiry = $this->M_master->tampil_verified_penyelesaian($cabang, $level)->result_array();
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_verified_penyelesaian', array('data_inquiry' => $data_inquiry));
		$this->load->view('footer');
	}

	public function verified_acc()
	{
		date_default_timezone_set("Asia/Jakarta");
		cek_belum_login();
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){ // Jika Kantor Pusat

			$data_inquiry = $this->M_master->tampil_verified_acc_penyelesaianHO($departemen)->result_array();
			$identitas = $departemen;

		}else{ // Jika Cabang
			
            $data_inquiry = $this->M_master->tampil_verified_acc_penyelesaian($cabang, $level)->result_array();
            $identitas = $level;
			
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_verified_penyelesaian_acc', array('data_inquiry' => $data_inquiry));
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
		$this->load->view('v_inquiry_kekurangan_detail', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history
		));
		$this->load->view('footer');
	}

	public function detail_revisi($id){
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
		$this->load->view('v_revisi_detail', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_pengajuan' => $data_pengajuan
		));
		$this->load->view('footer');
	}

	public function detail_pending($id){
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
		$this->load->view('v_pending_detail', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_pengajuan' => $data_pengajuan
		));
		$this->load->view('footer');
	}

	public function detail_verified($id){
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
		$this->load->view('v_verified_detail', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_pengajuan' => $data_pengajuan
		));
		$this->load->view('footer');
	}

	public function detail_verified_acc($id){
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
		$this->load->view('v_verified_acc_detail', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_pengajuan' => $data_pengajuan
		));
		$this->load->view('footer');
	}

	public function perbaiki($id){
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

		$data_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan WHERE id_penyelesaian=$id")->row_array();

		$no_pengajuan = $data_penyelesaian['nomor_pengajuan'];

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		// Data pengajuan all untuk menampilkan data untuk cari pengajuan
        $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cabang' AND bagian='$identitas' AND status_bayar='Telah Dibayar' AND status_penyelesaian='' ")->result_array();

		// Data pengajuan spesifik yang ingin diperbaiki
		$data_penyelesaian_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

        $data_bank = $this->db->query("SELECT * FROM tbl_bank_pengaju ORDER BY nama_bank")->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_perbaiki_penyelesaian', array(
            'data_penyelesaian' => $data_penyelesaian,
            'data_pengajuan' => $data_pengajuan,
            'data_bank' => $data_bank,
            'data_penyelesaian_pengajuan' => $data_penyelesaian_pengajuan
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

		$data_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan WHERE id_penyelesaian=$id")->row_array();

		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

        $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cabang' AND bagian='$identitas' AND status_bayar='Telah Dibayar' AND status_penyelesaian='' ")->result_array();

        $data_bank = $this->db->query("SELECT * FROM tbl_bank_pengaju ORDER BY nama_bank")->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_perbaiki_penyelesaian_pending', array(
            'data_penyelesaian' => $data_penyelesaian,
            'data_pengajuan' => $data_pengajuan,
            'data_bank' => $data_bank
        ));
		$this->load->view('footer');
	}


	// function cancel
	public function cancel(){
		$id_penyelesaian = $this->input->post('id_penyelesaian');
		$result = $this->M_master->update_pengajuan('tbl_penyelesaian_kekurangan', array(
			'status_approve_penyelesaian' => 'cancel',
			'note_cancel' => $this->input->post('note_cancel'),
			'approved_by_penyelesaian' => '',
			'nama_pengapprove_penyelesaian' => '',
			'direktur_tujuan_penyelesaian' => '',
			'status_verifikasi_penyelesaian' => '',
			'status_bayar_penyelesaian' => ''
		), array('id_penyelesaian' => $id_penyelesaian));

		if($result > 0){
			echo '<script>
				alert("Penyelesaian Berhasil Di Cancel");window.location="on_proccess";
			</script>';
		}
	}


}
