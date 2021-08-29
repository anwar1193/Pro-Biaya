<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P_dokumen_lengkap extends CI_Controller {

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
    $departemen = $this->libraryku->tampil_user()->departemen;
    $level = $this->libraryku->tampil_user()->level;

    if($cabang=='HEAD OFFICE'){
      
      $data_lendok = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
      status_approve = 'final approved' AND status_dokumen='done' AND bagian='$departemen' OR 
      status_approve = 'final approved' AND status_dokumen='done acc' AND bagian='$departemen'
      ORDER BY id_pengajuan DESC")->result_array();

      $identitas = $departemen;

    }else{
      // $data_lendok = $this->M_master->tampil_lendok($cabang, $level)->result_array();

      $data_lendok = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
      status_approve = 'final approved' AND status_dokumen='done' AND cabang='$cabang' AND bagian='$level' OR
      status_approve = 'final approved' AND status_dokumen='done acc' AND cabang='$cabang' AND bagian='$level' ORDER BY id_pengajuan DESC")->result_array();

      $identitas = $level;
    }
    
    $data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();
    $this->load->view('header');
    $this->load->view('sidebar', array('data_jb'=>$data_jb));
    $this->load->view('v_p_dokumen_lengkap', array('data_lendok' => $data_lendok));
    $this->load->view('footer');
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
    $this->load->view('v_p_detail_lendok', array(
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

  public function edit($id){
    $data_pengajuan = $this->M_master->tampil_pengajuan_detail($id)->row_array();
    $no_pengajuan = $data_pengajuan['nomor_pengajuan'];
    $data_file = $this->M_master->tampil_file('tbl_pengajuan_file', array('nomor_pengajuan'=>$no_pengajuan))->result_array();

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
    $this->load->view('v_edit_pengajuan', array(
      'data_pengajuan' => $data_pengajuan,
      'data_file' => $data_file
    ));
    $this->load->view('footer');
  }


  public function update(){
    date_default_timezone_set("Asia/Jakarta");
    $level = $this->libraryku->tampil_user()->level;

    $result = $this->M_master->update_pengajuan('tbl_pengajuan', array(
      'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
      'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
      'level_pengaju' => $level,
      'dept_tujuan' => $this->input->post('dept_tujuan'),
      'cabang' => $this->input->post('cabang'),
      'wilayah' => $this->input->post('wilayah'),
      'bagian' => $this->input->post('bagian'),
      'jenis_biaya' => $this->input->post('jenis_biaya'),
      'sub_biaya' => $this->input->post('sub_biaya'),
      'keterangan' => $this->input->post('keterangan'),
      'jumlah' => $this->input->post('jumlah'),
      'ppn' => $this->input->post('ppn'),
      'pph23' => $this->input->post('pph23'),
      'total' => $this->input->post('total'),
      'bank_penerima' => $this->input->post('bank_penerima'),
      'norek_penerima' => $this->input->post('norek_penerima'),
      'atas_nama' => $this->input->post('atas_nama'),
      'status_approve' => 'on proccess',
      'approved_by' => '',
      'nama_pengapprove' => ''
    ), array('id_pengajuan' => $this->input->post('id')));

    if($result>0){

      // Simpan File Pengajuan
      $data = [];
      $count = count($_FILES['files']['name']);
      for($i=0; $i<$count; $i++){
        if(!empty($_FILES['files']['name'][$i])){
          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
          $_FILES['file']['size'] = $_FILES['files']['size'][$i];

          $config['upload_path'] = './file_upload';
          $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx|xlsx';
          $config['max_size'] = 2048;
          // $config['file_name'] = $_FILES['files']['name'][$i];
          $config['file_name'] = 'item-'.date('ymd').'-'.substr(md5(rand()),0,10).'-'.$i;
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
            $this->M_master->simpan_pengajuan('tbl_pengajuan_file', $content);
          }
        }
      }

      // Simpan Pengajuan History
      $this->M_master->simpan_approve_history('tbl_approved_history', array(
        'nomor_pengajuan' => $this->input->post('nomor_pengajuan'),
        'status_approve' => 'on proccess',
        'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal')))
      ));

      $this->session->set_flashdata('pesan','Pengajuan Biaya Telah Diperbaiki & Akan Diproses Kembali');
      redirect('p_revisi/index');
    }
  }


}
