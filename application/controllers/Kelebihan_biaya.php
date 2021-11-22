<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kelebihan_biaya extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('helperku');
		$this->load->library('libraryku');
		$this->load->model('M_master');
	}


	public function index(){
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
        $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cabang' AND bagian='$identitas' AND status_bayar='Telah Dibayar' AND nomor_invoice='ESTIMASI' AND jenis_penyelesaian='kelebihan' AND note_penyelesaian!='' AND status_penyelesaian='' ")->result_array();
        
		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_kelebihan_biaya', array('data_pengajuan' => $data_pengajuan));
		$this->load->view('footer');
	}

	public function simpan(){
        date_default_timezone_set("Asia/Jakarta");
		$nomor_pengajuan = $this->input->post('nomor_pengajuan');
        $nomor_penyelesaian = $nomor_pengajuan.'/PY';
        $jenis_biaya = $this->input->post('jenis_biaya');
        $sub_biaya = $this->input->post('sub_biaya');
        $departemen_tujuan = $this->input->post('departemen_tujuan');
        $total_pengajuan = $this->input->post('jumlah');
        $realisasi = $this->input->post('realisasi');
        $lebih_bayar = $this->input->post('lebih_bayar');
        $alasan_beda_realisasi = $this->input->post('alasan_beda_realisasi');

        $tgl_pengembalian = $this->input->post('tanggal_pengembalian');
        $tanggal_pengembalian = date('Y-m-d', strtotime($tgl_pengembalian));

        $cara_pengembalian = $this->input->post('cara_pengembalian');

        $result = $this->M_master->simpan_pengajuan('tbl_penyelesaian_kelebihan', array(
            'nomor_pengajuan' => $nomor_pengajuan,
            'nomor_penyelesaian' => $nomor_penyelesaian,
            'jenis_biaya' => $jenis_biaya,
            'sub_biaya' => $sub_biaya,
            'total_pengajuan' => $total_pengajuan,
            'realisasi' => $realisasi,
            'lebih_bayar' => $lebih_bayar,
            'alasan_beda_realisasi' => $alasan_beda_realisasi,
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'cara_pengembalian' => $cara_pengembalian,
            'departemen_tujuan' => $departemen_tujuan,
            'status_verifikasi_penyelesaian' => 'On Proccess'
        ));

        if($result > 0){

            // Update status penyelesaian di tbl_pengajuan
            $this->M_master->update_pengajuan('tbl_pengajuan', array(
                'status_penyelesaian' => 'On Proccess'
            ), array('nomor_pengajuan' => $nomor_pengajuan));


            // Simpan File Pengajuan
            $hari_ini = date("Y-m-d");

            $folderUpload = "./file_penyelesaian/".$hari_ini;

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
                        $this->M_master->simpan_pengajuan('tbl_kelebihan_file', $content);
                    }
                }
            }

            $this->session->set_flashdata('pesan','Penyelesaian Kelebihan Biaya Berhasil Terkirim');
            redirect('kelebihan_biaya');
        }

	}


    public function update_pending(){
        date_default_timezone_set("Asia/Jakarta");
        $id_penyelesaian = $this->input->post('id_penyelesaian');
		$nomor_pengajuan = $this->input->post('nomor_pengajuan');
        $nomor_penyelesaian = $nomor_pengajuan.'/PY';
        $jenis_biaya = $this->input->post('jenis_biaya');
        $sub_biaya = $this->input->post('sub_biaya');
        $departemen_tujuan = $this->input->post('departemen_tujuan');
        $total_pengajuan = $this->input->post('jumlah');
        $realisasi = $this->input->post('realisasi');
        $lebih_bayar = $this->input->post('lebih_bayar');

        $tgl_pengembalian = $this->input->post('tanggal_pengembalian');
        $tanggal_pengembalian = date('Y-m-d', strtotime($tgl_pengembalian));

        $cara_pengembalian = $this->input->post('cara_pengembalian');

        $result = $this->M_master->update_pengajuan('tbl_penyelesaian_kelebihan', array(
            'nomor_pengajuan' => $nomor_pengajuan,
            'nomor_penyelesaian' => $nomor_penyelesaian,
            'jenis_biaya' => $jenis_biaya,
            'sub_biaya' => $sub_biaya,
            'total_pengajuan' => $total_pengajuan,
            'realisasi' => $realisasi,
            'lebih_bayar' => $lebih_bayar,
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'cara_pengembalian' => $cara_pengembalian,
            'departemen_tujuan' => $departemen_tujuan,
            'status_verifikasi_penyelesaian' => 'On Proccess'
        ), array('id_penyelesaian' => $id_penyelesaian));

        if($result > 0){

            // Update status penyelesaian di tbl_pengajuan
            $this->M_master->update_pengajuan('tbl_pengajuan', array(
                'status_penyelesaian' => 'On Proccess'
            ), array('nomor_pengajuan' => $nomor_pengajuan));


            // Simpan File Pengajuan
            $hari_ini = date("Y-m-d");

            $folderUpload = "./file_penyelesaian/".$hari_ini;

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
                        $this->M_master->simpan_pengajuan('tbl_kelebihan_file', $content);
                    }
                }
            }

            $this->session->set_flashdata('pesan','Penyelesaian Kelebihan Biaya Berhasil Terkirim');
            redirect('inquiry_kelebihan_biaya/pending');
        }

	}


	public function kirim_memo(){
        echo '<script>alert("Penyelesaian Terkirim");window.location="index"</script>';
        exit;
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
		// $this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_detail_kelebihan', array(
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

}
