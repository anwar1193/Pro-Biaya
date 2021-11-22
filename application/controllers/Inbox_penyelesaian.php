<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox_penyelesaian extends CI_Controller {

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
		$jabatan_khusus = $this->libraryku->tampil_user()->jabatan_khusus; //untuk parameter direktur

		$limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
		$min_approve = $limit_approve['min_approve'];
		$max_approve = $limit_approve['max_approve'];

		if($level == 'Branch Manager'){
			$data_inbox = $this->M_master->tampil_inbox_kacab2($cabang)->result_array();
		}elseif($level == 'Area Manager'){
			$data_inbox = $this->M_master->tampil_inbox_kawil2($cabang)->result_array();
		}elseif($level == 'Department Head'){
			$data_inbox = $this->M_master->tampil_inbox_kadept2($departemen, $nama_lengkap, $jabatan_khusus)->result_array();
		}elseif($level == 'Division Head'){
			$data_inbox = $this->M_master->tampil_inbox_kadiv2($nama_lengkap)->result_array();
		}elseif($level == 'Director'){
			$data_inbox = $this->M_master->tampil_inbox_director2($nama_lengkap)->result_array();
		}elseif($level == 'Director Finance'){
			$data_inbox = $this->M_master->tampil_inbox_director_finance2($nama_lengkap)->result_array();
		}elseif($level == 'President Director'){
			$data_inbox = $this->M_master->tampil_inbox_presdir2()->result_array();
		}else{
			$data_inbox = $this->M_master->tampil_inbox_kadept2($departemen)->result_array();
		}
		

		if($cabang == 'HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb' => $data_jb));
		$this->load->view('v_inbox_penyelesaian', array('data_inbox' => $data_inbox));
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

		$data_approve_history = $this->M_master->tampil_approve_history('tbl_approved_history_penyelesaian', array(
			'nomor_pengajuan' => $no_pengajuan
		))->result_array();

		$this->load->view('header');
		$this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_inbox_penyelesaian_detail', array(
			'data_penyelesaian' => $data_penyelesaian,
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history
		));
		$this->load->view('footer');
	}

	public function approve(){
		date_default_timezone_set("Asia/Jakarta");

		$id = $this->input->post('id');
		$id_pengajuan = $this->input->post('id_pengajuan');
		$realisasi = $this->input->post('realisasi');

		$level = $this->libraryku->tampil_user()->level;
		$nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
		$direktur = $this->libraryku->tampil_user()->atasan;
		$kadiv = $this->libraryku->tampil_user()->nama_kadiv;
		$data_pengajuan = $this->M_master->tampil_pengajuan_detail($id_pengajuan)->row_array();
		$no_pengajuan = $data_pengajuan['nomor_pengajuan'];

		if($level=='Branch Manager'){ //Jika Yang Approved Kacab

			// update status_penyelesaian di tbl_penyelesaian_kekurangan
			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'approved',
				'approved_by_penyelesaian' => 'kacab',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'approved'
			), array('id_pengajuan' => $id_pengajuan));

		}elseif($level=='Area Manager'){ // Jika Yang Approved Kawil

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'approved',
				'approved_by_penyelesaian' => 'kawil',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'approved'
			), array('id_pengajuan' => $id_pengajuan));

		}elseif($level=='Department Head'){ // Jika Yang Approved Dept Head
			
			$dept_pengaju = $data_pengajuan['bagian']; // Lihat Siapa Yang Mengajukan
			$dept_tujuan = $data_pengajuan['dept_tujuan'];
			$departemen = $this->libraryku->tampil_user()->departemen; //departemen dari head yg login

			//Jika Pengajuan Diatas Limit Maksimal Approve, Lanjut ke Kadiv
			$limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
			$max_approve = $limit_approve['max_approve'];
			$total_pengajuan = $realisasi;
			$jenis_biaya = $data_pengajuan['jenis_biaya'];

			if($dept_pengaju == $departemen){ //jika yang mengajukan anak buahnya sendiri, ia sbg dept asal

				// Cek apakah dept tujuan adalah dept nya sendiri
				if($dept_tujuan == $departemen){ // jika tujuan pengajuan dept nya sendiri

					// harus tambah limit
					if($total_pengajuan > $max_approve){

						// Cek apakah dia punya kadiv
						$q_cekUser = $this->db->query("SELECT * FROM tbl_user WHERE level='Department Head' AND departemen='$departemen'")->row_array();
						$kadiv = $q_cekUser['nama_kadiv'];

						if($kadiv != ''){ //jika punya kadiv, lanjut ke kadiv

							$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
								'status_approve_penyelesaian' => 'approved',
								'approved_by_penyelesaian' => 'dept head pic',
								'nama_pengapprove_penyelesaian' => $nama_lengkap,
								'direktur_tujuan_penyelesaian' => $direktur,
								'kadiv_tujuan_penyelesaian' => $kadiv
							), array('id_penyelesaian' => $id));

						}else{ //jika tidak punya kadiv

							// Ambil Limit Kadiv
							$q_limit_kadiv = $this->db->query("SELECT * FROM tbl_level WHERE level='Division Head'")->row_array();
							$limit_kadiv = $q_limit_kadiv['max_approve'];

							if($total_pengajuan > $limit_kadiv){ //jika pengajuan melebihi limit kadiv
								$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
									'status_approve_penyelesaian' => 'approved',
									'approved_by_penyelesaian' => 'dept head pic',
									'nama_pengapprove_penyelesaian' => $nama_lengkap,
									'direktur_tujuan_penyelesaian' => $direktur,
									'kadiv_tujuan_penyelesaian' => $kadiv
								), array('id_penyelesaian' => $id));

							}else{ //jika pengajuan tidak melebihi limit kadiv
								$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
									'status_approve_penyelesaian' => 'final approved',
									'approved_by_penyelesaian' => 'dept head pic',
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
						}

						

					}else{
						$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
							'status_approve_penyelesaian' => 'final approved',
							'approved_by_penyelesaian' => 'dept head pic',
							'nama_pengapprove_penyelesaian' => $nama_lengkap,
							'tanggal_approved_penyelesaian' => date('Y-m-d')
							// 'wa_blast' => 'off',
							// 'balik_lagi' => ''
						), array('id_penyelesaian' => $id));

						// update status_penyelesaian di tbl_pengajuan
						$this->M_master->approve_pengajuan('tbl_pengajuan', array(
							'status_penyelesaian' => 'approved'
						), array('id_pengajuan' => $id_pengajuan));
					}

					

				}else{ //jika tujuan pengajuan dept lain

					$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
						'status_approve_penyelesaian' => 'approved',
						'approved_by_penyelesaian' => 'dept head',
						'nama_pengapprove_penyelesaian' => $nama_lengkap
					), array('id_penyelesaian' => $id));

				}

				

			}else{ //jika yang mengajukan dari dept lain, ia sebagai dept tujuan
				
				//jika total pengajuan melebihi limit / perdin, lanjut kadiv
				if($total_pengajuan > $max_approve){ 

					// Cek apakah dia punya kadiv
					$q_cekUser = $this->db->query("SELECT * FROM tbl_user WHERE level='Department Head' AND departemen='$departemen'")->row_array();
					$kadiv = $q_cekUser['nama_kadiv'];

					if($kadiv != ''){ //jika punya kadiv, lanjut ke kadiv
						$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
							'status_approve_penyelesaian' => 'approved',
							'approved_by_penyelesaian' => 'dept head pic',
							'nama_pengapprove_penyelesaian' => $nama_lengkap,
							'direktur_tujuan_penyelesaian' => $direktur,
							'kadiv_tujuan_penyelesaian' => $kadiv
						), array('id_penyelesaian' => $id));

					}else{ //jika tidak punya kadiv
						// Ambil Limit Kadiv
						$q_limit_kadiv = $this->db->query("SELECT * FROM tbl_level WHERE level='Division Head'")->row_array();
						$limit_kadiv = $q_limit_kadiv['max_approve'];

						if($total_pengajuan > $limit_kadiv){ //jika pengajuan melebihi limit kadiv
							$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
								'status_approve_penyelesaian' => 'approved',
								'approved_by_penyelesaian' => 'dept head pic',
								'nama_pengapprove_penyelesaian' => $nama_lengkap,
								'direktur_tujuan_penyelesaian' => $direktur,
								'kadiv_tujuan_penyelesaian' => $kadiv
							), array('id_penyelesaian' => $id));

						}else{ //jika pengajuan tidak melebihi limit kadiv
							$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
								'status_approve_penyelesaian' => 'final approved',
								'approved_by_penyelesaian' => 'dept head pic',
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
					}

					
				}elseif($total_pengajuan <= $max_approve){ // jika total pengajuan masih dibawah limit, selesai
					$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
						'status_approve_penyelesaian' => 'final approved',
						'approved_by_penyelesaian' => 'dept head pic',
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

			}

			

		}elseif($level=='Division Head'){ // Jika Yang Approved Division Head / Kadiv

			$kadiv_asal = $data_pengajuan['kadiv_asal']; // kadiv Yang Mengajukan
			$kadiv_tujuan = $data_pengajuan['kadiv_tujuan']; // kadiv reviewer
			$kadiv_login = $this->libraryku->tampil_user()->nama_lengkap; //kadiv yg sedang login

			// Perbedaan Limit Cabang & Pusat
			$cabang_pengajuan = $data_pengajuan['cabang'];

			if($cabang_pengajuan == 'HEAD OFFICE'){
				//Penentuan Limit Approve
				$max_approve = 500000;
			}else{
				//Penentuan Limit Approve
				$limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
				$max_approve = $limit_approve['max_approve'];
			}

			$total_pengajuan = $realisasi;
			$jenis_biaya = $data_pengajuan['jenis_biaya'];

			if($kadiv_asal == $kadiv_login){ //Jika yang ajukan dari anak buah nya sendiri

				if($kadiv_tujuan == $kadiv_login){ //Jika tujuan divisinya sendiri

					//jika total pengajuan melebihi limit / perdin, lanjut director
					if($total_pengajuan > $max_approve){ 
						$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
							'status_approve_penyelesaian' => 'approved',
							'approved_by_penyelesaian' => 'division head',
							'nama_pengapprove_penyelesaian' => $nama_lengkap
						), array('id_penyelesaian' => $id));
					}else{ // jika total pengajuan masih dibawah limit, selesai
						$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
							'status_approve_penyelesaian' => 'final approved',
							'approved_by_penyelesaian' => 'division head',
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

				}else{ //jika tujuan divisi lain
					$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
						'status_approve_penyelesaian' => 'approved',
						'approved_by_penyelesaian' => 'division head',
						'nama_pengapprove_penyelesaian' => $nama_lengkap
					), array('id_penyelesaian' => $id));
				}

			}else{ //Jika yang ajukan dari dept lain, ia sebagai dept tujuan

				//jika total pengajuan melebihi limit / perdin, lanjut director
				if($total_pengajuan > $max_approve){ 
					$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
						'status_approve_penyelesaian' => 'approved',
						'approved_by_penyelesaian' => 'division head',
						'nama_pengapprove_penyelesaian' => $nama_lengkap
					), array('id_penyelesaian' => $id));
				}else{ // jika total pengajuan masih dibawah limit, selesai
					$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
						'status_approve_penyelesaian' => 'final approved',
						'approved_by_penyelesaian' => 'division head',
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

			}


		}elseif($level=='Director'){ // Jika Yang Approved Director

			//Jika Pengajuan Diatas Limit Maksimal Approve Direktur, Lanjut ke Presiden Direktur
			$limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
			$max_approve = $limit_approve['max_approve'];
			$total_pengajuan = $realisasi;

			$dir_asal = $data_pengajuan['direktur_asal'];
			$dir_tujuan = $data_pengajuan['direktur_tujuan'];
			$dir_login = $this->libraryku->tampil_user()->nama_lengkap; //direktur yg login

			if($dir_login == $dir_asal AND $dir_login != $dir_tujuan){ //jika hanya sebagai direktur asal

				$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
					'status_approve_penyelesaian' => 'approved',
					'approved_by_penyelesaian' => 'director pengaju',
					'nama_pengapprove_penyelesaian' => $nama_lengkap
				), array('id_penyelesaian' => $id));

			}elseif($dir_login != $dir_asal AND $dir_login == $dir_tujuan){ //jika hanya sebagai direktur tujuan

				if($total_pengajuan > $max_approve){ //Jika Pengajuan Lebih Besar Dari Limit
					$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
						'status_approve_penyelesaian' => 'approved',
						'approved_by_penyelesaian' => 'director',
						'nama_pengapprove_penyelesaian' => $nama_lengkap
					), array('id_penyelesaian' => $id));
				}else{ //Jika Pengajuan Lebih Kecil Dari Limit, Approve Selesai

					$bagian = $data_pengajuan['bagian'];

					if($bagian == 'INTERNAL AUDIT'){ //jika audit yang ajukan, sampai ke pak gusti

						$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
							'status_approve_penyelesaian' => 'approved',
							'approved_by_penyelesaian' => 'director',
							'nama_pengapprove_penyelesaian' => $nama_lengkap,
							'tanggal_approved_penyelesaian' => date('Y-m-d')
							// 'wa_blast' => 'off'
						), array('id_penyelesaian' => $id));

					}else{ //jika bukan audit, selesai sampai sini

						$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
							'status_approve_penyelesaian' => 'final approved',
							'approved_by_penyelesaian' => 'director',
							'nama_pengapprove_penyelesaian' => $nama_lengkap,
							// 'balik_lagi' => '',
							// 'ket_balik' => '',
							'tanggal_approved_penyelesaian' => date('Y-m-d')
							// 'wa_blast' => 'off'
						), array('id_penyelesaian' => $id));

						// update status_penyelesaian di tbl_pengajuan
						$this->M_master->approve_pengajuan('tbl_pengajuan', array(
							'status_penyelesaian' => 'final approved'
						), array('id_pengajuan' => $id_pengajuan));

					}
					
				}

			}elseif($dir_login == $dir_asal AND $dir_login == $dir_tujuan){ //jika sebagai dir asal & tujuan

				if($total_pengajuan > $max_approve){ //Jika Pengajuan Lebih Besar Dari Limit
					$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
						'status_approve_penyelesaian' => 'approved',
						'approved_by_penyelesaian' => 'director',
						'nama_pengapprove_penyelesaian' => $nama_lengkap
					), array('id_penyelesaian' => $id));
				}else{ //Jika Pengajuan Lebih Kecil Dari Limit, Approve Selesai
					$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
						'status_approve_penyelesaian' => 'final approved',
						'approved_by_penyelesaian' => 'director',
						'nama_pengapprove_penyelesaian' => $nama_lengkap,
						// 'balik_lagi' => '',
						// 'ket_balik' => '',
						'tanggal_approved_penyelesaian' => date('Y-m-d')
						// 'wa_blast' => 'off'
					), array('id_penyelesaian' => $id));

					// update status_penyelesaian di tbl_pengajuan
					$this->M_master->approve_pengajuan('tbl_pengajuan', array(
						'status_penyelesaian' => 'final approved'
					), array('id_pengajuan' => $id_pengajuan));

				}

			}


		}elseif($level=='Director Finance'){ // Jika Yang Approved Director Finance

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

		}elseif($level=='President Director'){ // Jika Yang Approved President Director

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'final approved',
				'approved_by_penyelesaian' => 'president director',
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

			if($level=='Branch Manager'){ // Jika Yang Approved Kacab

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'approved',
					'approved_by' => 'kacab',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note')
				));
				

			}elseif($level=='Area Manager'){ // Jika Yang Approved Kawil

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'approved',
					'approved_by' => 'kawil',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note')
				));

			}elseif($level=='Department Head'){ // Jika Yang Approved Dept Head

				//Jika Pengajuan Diatas Limit Maksimal Approve Kacab
				$limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
				$max_approve = $limit_approve['max_approve'];
				$total_pengajuan = $realisasi;

				$dept_pengaju = $data_pengajuan['bagian']; // Lihat Siapa Yang Mengajukan
				$dept_tujuan = $data_pengajuan['dept_tujuan'];
				$departemen = $this->libraryku->tampil_user()->departemen; //departemen dari head yg login

				if($dept_pengaju == $departemen){ //jk yang mengajukan anak buahnya sendiri,ia sbg dept asal

					// Cek apakah dept tujuan adalah dept nya sendiri
					if($dept_tujuan == $departemen){ // jika tujuan pengajuan dept nya sendiri

						if($total_pengajuan > $max_approve){ //jika pengajuan melebihi limit

							// Cek apakah dia punya kadiv
							$q_cekUser = $this->db->query("SELECT * FROM tbl_user WHERE level='Department Head' AND departemen='$departemen'")->row_array();
							$kadiv = $q_cekUser['nama_kadiv'];

							if($kadiv != ''){ //jika punya kadiv
								$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
									'nomor_pengajuan' => $no_pengajuan,
									'status_approve' => 'approved',
									'approved_by' => 'dept head pic',
									'nama_pengapprove' => $nama_lengkap,
									'tanggal' => date('Y-m-d'),
									'note' => $this->input->post('note')
								));

							}else{ //jika tidak punya kadiv

								// Ambil Limit Kadiv
								$q_limit_kadiv = $this->db->query("SELECT * FROM tbl_level WHERE level='Division Head'")->row_array();
								$limit_kadiv = $q_limit_kadiv['max_approve'];

								if($total_pengajuan > $limit_kadiv){ //jika pengajuan melebihi limit kadiv
									$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
										'nomor_pengajuan' => $no_pengajuan,
										'status_approve' => 'approved',
										'approved_by' => 'dept head pic',
										'nama_pengapprove' => $nama_lengkap,
										'tanggal' => date('Y-m-d'),
										'note' => $this->input->post('note')
									));

								}else{ //jika tidak melebihi limit kadiv
									$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
										'nomor_pengajuan' => $no_pengajuan,
										'status_approve' => 'final approved',
										'approved_by' => 'dept head pic',
										'nama_pengapprove' => $nama_lengkap,
										'tanggal' => date('Y-m-d'),
										'note' => $this->input->post('note')
									));
								}
							}

							
						}else{ //jika sesuai limit
							$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
								'nomor_pengajuan' => $no_pengajuan,
								'status_approve' => 'final approved',
								'approved_by' => 'dept head pic',
								'nama_pengapprove' => $nama_lengkap,
								'tanggal' => date('Y-m-d'),
								'note' => $this->input->post('note')
							));
						}

					}else{ //jika tujuan pengajuan dept lain
						$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
							'nomor_pengajuan' => $no_pengajuan,
							'status_approve' => 'approved',
							'approved_by' => 'dept head',
							'nama_pengapprove' => $nama_lengkap,
							'tanggal' => date('Y-m-d'),
							'note' => $this->input->post('note')
						));
					}

				}else{ //jika yang mengajukan dari dept lain, ia sebagai dept tujuan

					if($total_pengajuan > $max_approve){ //jika pengajuan melebihi limit

						// Cek apakah dia punya kadiv
						$q_cekUser = $this->db->query("SELECT * FROM tbl_user WHERE level='Department Head' AND departemen='$departemen'")->row_array();
						$kadiv = $q_cekUser['nama_kadiv'];

						if($kadiv != ''){ //jika punya kadiv
							$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
								'nomor_pengajuan' => $no_pengajuan,
								'status_approve' => 'approved',
								'approved_by' => 'dept head pic',
								'nama_pengapprove' => $nama_lengkap,
								'tanggal' => date('Y-m-d'),
								'note' => $this->input->post('note')
							));

						}else{ //jika tidak punya kadiv

							// Ambil Limit Kadiv
							$q_limit_kadiv = $this->db->query("SELECT * FROM tbl_level WHERE level='Division Head'")->row_array();
							$limit_kadiv = $q_limit_kadiv['max_approve'];

							if($total_pengajuan > $limit_kadiv){ //jika pengajuan melebihi limit kadiv
								$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
									'nomor_pengajuan' => $no_pengajuan,
									'status_approve' => 'approved',
									'approved_by' => 'dept head pic',
									'nama_pengapprove' => $nama_lengkap,
									'tanggal' => date('Y-m-d'),
									'note' => $this->input->post('note')
								));

							}else{ //jika tidak melebihi limit kadiv
								$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
									'nomor_pengajuan' => $no_pengajuan,
									'status_approve' => 'final approved',
									'approved_by' => 'dept head pic',
									'nama_pengapprove' => $nama_lengkap,
									'tanggal' => date('Y-m-d'),
									'note' => $this->input->post('note')
								));
							}
								
						}

						
					}else{ //jika sesuai limit
						$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
							'nomor_pengajuan' => $no_pengajuan,
							'status_approve' => 'final approved',
							'approved_by' => 'dept head pic',
							'nama_pengapprove' => $nama_lengkap,
							'tanggal' => date('Y-m-d'),
							'note' => $this->input->post('note')
						));
					}
				}


			}elseif($level=='Division Head'){ // Jika Yang Approved Division Head

				$kadiv_asal = $data_pengajuan['kadiv_asal']; // kadiv Yang Mengajukan
				$kadiv_tujuan = $data_pengajuan['kadiv_tujuan']; // kadiv reviewer
				$kadiv_login = $this->libraryku->tampil_user()->nama_lengkap; //kadiv yg sedang login

				// Perbedaan Limit Cabang & Pusat
				$cabang_pengajuan = $data_pengajuan['cabang'];

				if($cabang_pengajuan == 'HEAD OFFICE'){
					//Penentuan Limit Approve
					$max_approve = 500000;
				}else{
					//Penentuan Limit Approve
					$limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
					$max_approve = $limit_approve['max_approve'];
				}

				$total_pengajuan = $realisasi;

				if($kadiv_asal == $kadiv_login){ //Jika yang ajukan dari anak buah nya sendiri

					if($kadiv_tujuan == $kadiv_login){ //Jika tujuan divisinya sendiri

						if($total_pengajuan > $max_approve){
							$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
								'nomor_pengajuan' => $no_pengajuan,
								'status_approve' => 'approved',
								'approved_by' => 'division head',
								'nama_pengapprove' => $nama_lengkap,
								'tanggal' => date('Y-m-d'),
								'note' => $this->input->post('note')
							));
						}else{
							$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
								'nomor_pengajuan' => $no_pengajuan,
								'status_approve' => 'final approved',
								'approved_by' => 'division head',
								'nama_pengapprove' => $nama_lengkap,
								'tanggal' => date('Y-m-d'),
								'note' => $this->input->post('note')
							));
						}

					}else{ //Jika tujuan nya divisi lain
						$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
							'nomor_pengajuan' => $no_pengajuan,
							'status_approve' => 'approved',
							'approved_by' => 'division head',
							'nama_pengapprove' => $nama_lengkap,
							'tanggal' => date('Y-m-d'),
							'note' => $this->input->post('note')
						));
					}

				}else{ //Jika yang ajukan dept lain, ia sebagai kadiv tujuan

					if($total_pengajuan > $max_approve){
						$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
							'nomor_pengajuan' => $no_pengajuan,
							'status_approve' => 'approved',
							'approved_by' => 'division head',
							'nama_pengapprove' => $nama_lengkap,
							'tanggal' => date('Y-m-d'),
							'note' => $this->input->post('note')
						));
					}else{
						$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
							'nomor_pengajuan' => $no_pengajuan,
							'status_approve' => 'final approved',
							'approved_by' => 'division head',
							'nama_pengapprove' => $nama_lengkap,
							'tanggal' => date('Y-m-d'),
							'note' => $this->input->post('note')
						));
					}

				}

				

			}elseif($level=='Director'){ // Jika Yang Approved Director

				//Jika Pengajuan Diatas Limit Maksimal Approve Direktur
				$limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
				$max_approve = $limit_approve['max_approve'];
				$total_pengajuan = $realisasi;

				$dir_asal = $data_pengajuan['direktur_asal'];
				$dir_tujuan = $data_pengajuan['direktur_tujuan'];
				$dir_login = $this->libraryku->tampil_user()->nama_lengkap; //direktur yg login

				if($dir_login == $dir_asal AND $dir_login != $dir_tujuan){ //sebagai direktur asal

					$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
						'nomor_pengajuan' => $no_pengajuan,
						'status_approve' => 'approved',
						'approved_by' => 'director',
						'nama_pengapprove' => $nama_lengkap,
						'tanggal' => date('Y-m-d'),
						'note' => $this->input->post('note')
					));

				}elseif($dir_login != $dir_asal AND $dir_login == $dir_tujuan){ //sebagai direktur tujuan

					if($total_pengajuan > $max_approve){ //Jika Pengajuan Lebih Besar Dari Limit
						$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
							'nomor_pengajuan' => $no_pengajuan,
							'status_approve' => 'approved',
							'approved_by' => 'director',
							'nama_pengapprove' => $nama_lengkap,
							'tanggal' => date('Y-m-d'),
							'note' => $this->input->post('note')
						));
					}else{ //Jika Pengajuan Lebih Kecil Dari Limit, Approve Selesai
						$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
							'nomor_pengajuan' => $no_pengajuan,
							'status_approve' => 'final approved',
							'approved_by' => 'director',
							'nama_pengapprove' => $nama_lengkap,
							'tanggal' => date('Y-m-d'),
							'note' => $this->input->post('note')
						));
					}

				}elseif($dir_login == $dir_asal AND $dir_login == $dir_tujuan){ //sebagai dir asal & tujuan

					if($total_pengajuan > $max_approve){ //Jika Pengajuan Lebih Besar Dari Limit
						$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
							'nomor_pengajuan' => $no_pengajuan,
							'status_approve' => 'approved',
							'approved_by' => 'director',
							'nama_pengapprove' => $nama_lengkap,
							'tanggal' => date('Y-m-d'),
							'note' => $this->input->post('note')
						));
					}else{ //Jika Pengajuan Lebih Kecil Dari Limit, Approve Selesai

						$bagian = $data_pengajuan['bagian'];

						if($bagian == 'INTERNAL AUDIT'){ //jika internal audit, harus sampai ke pak gusti
							$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
								'nomor_pengajuan' => $no_pengajuan,
								'status_approve' => 'approved',
								'approved_by' => 'director',
								'nama_pengapprove' => $nama_lengkap,
								'tanggal' => date('Y-m-d'),
								'note' => $this->input->post('note')
							));
						}else{ //kalau bukan internal audit, selesai
							$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
								'nomor_pengajuan' => $no_pengajuan,
								'status_approve' => 'final approved',
								'approved_by' => 'director',
								'nama_pengapprove' => $nama_lengkap,
								'tanggal' => date('Y-m-d'),
								'note' => $this->input->post('note')
							));
						}
						
					}

				}

			}elseif($level=='Director Finance'){ // Jika Yang Approved Director

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

			}elseif($level=='President Director'){ // Jika Yang Approved President Director

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'final approved',
					'approved_by' => 'president director',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note')
				));

			}
			

			$this->session->set_flashdata('pesan','Penyelesaian Berhasil di Approve');
			redirect('inbox_penyelesaian');
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

		if($level=='Branch Manager'){ // Jika Yang Revisi Kacab

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'revisi',
				'approved_by_penyelesaian' => 'kacab',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'revisi'
			), array('id_pengajuan' => $id_pengajuan));
			

		}elseif($level=='Area Manager'){ // Jika Yang Revisi Kawil

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'revisi',
				'approved_by_penyelesaian' => 'kawil',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'revisi'
			), array('id_pengajuan' => $id_pengajuan));

		}elseif($level=='Department Head'){ // Jika Yang Revisi Dept Head

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'revisi',
				'approved_by_penyelesaian' => 'dept head',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'revisi'
			), array('id_pengajuan' => $id_pengajuan));

		}elseif($level=='Division Head'){ // Jika Yang Revisi Division Head

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'revisi',
				'approved_by_penyelesaian' => 'division head',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'revisi'
			), array('id_pengajuan' => $id_pengajuan));

		}elseif($level=='Director'){ // Jika Yang Revisi Director

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'revisi',
				'approved_by_penyelesaian' => 'director',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'revisi'
			), array('id_pengajuan' => $id_pengajuan));

		}elseif($level=='President Director'){ // Jika Yang Revisi President Director

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'revisi',
				'approved_by_penyelesaian' => 'president director',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'revisi'
			), array('id_pengajuan' => $id_pengajuan));

		}
		

		if($result>0){

			if($level=='Branch Manager'){ // Jika yang Revisi Kacab

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'revisi',
					'approved_by' => 'kacab',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note_revisi')
				));

			}elseif($level=='Area Manager'){ // Jika yang Revisi Kawil

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'revisi',
					'approved_by' => 'kawil',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note_revisi')
				));

			}elseif($level=='Department Head'){ // Jika yang Revisi Dept Head

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'revisi',
					'approved_by' => 'dept head',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note_revisi')
				));

			}elseif($level=='Division Head'){ // Jika yang Revisi Division Head

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'revisi',
					'approved_by' => 'division head',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note_revisi')
				));

			}elseif($level=='Director'){ // Jika yang Revisi Director

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'revisi',
					'approved_by' => 'director',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note_revisi')
				));

			}elseif($level=='President Director'){ // Jika yang Revisi President Director

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'revisi',
					'approved_by' => 'president director',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note_penyelesaian')
				));

			}
			

			$this->session->set_flashdata('pesan','Penyelesaian Biaya Akan Dikembalikan Ke Pihak Pengaju Untuk Diperbaiki');
			redirect('inbox_penyelesaian');
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

		if($level=='Branch Manager'){ // Jika Yang Reject Kacab

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'rejected',
				'approved_by_penyelesaian' => 'kacab',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'rejected'
			), array('id_pengajuan' => $id_pengajuan));
			

		}elseif($level=='Area Manager'){ // Jika Yang Reject Kawil

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'rejected',
				'approved_by_penyelesaian' => 'kawil',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'rejected'
			), array('id_pengajuan' => $id_pengajuan));

		}elseif($level=='Department Head'){ // Jika Yang Reject Dept Head

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'rejected',
				'approved_by_penyelesaian' => 'dept head',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'rejected'
			), array('id_pengajuan' => $id_pengajuan));

		}elseif($level=='Division Head'){ // Jika Yang Reject Division Head

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'rejected',
				'approved_by_penyelesaian' => 'division head',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'rejected'
			), array('id_pengajuan' => $id_pengajuan));

		}elseif($level=='Director'){ // Jika Yang Reject Director

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'rejected',
				'approved_by_penyelesaian' => 'director',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'rejected'
			), array('id_pengajuan' => $id_pengajuan));

		}elseif($level=='President Director'){ // Jika Yang Reject President Director

			$result = $this->M_master->approve_pengajuan('tbl_penyelesaian_kekurangan',array(
				'status_approve_penyelesaian' => 'rejected',
				'approved_by_penyelesaian' => 'president director',
				'nama_pengapprove_penyelesaian' => $nama_lengkap
			), array('id_penyelesaian' => $id));

			// update status_penyelesaian di tbl_pengajuan
			$this->M_master->approve_pengajuan('tbl_pengajuan', array(
				'status_penyelesaian' => 'rejected'
			), array('id_pengajuan' => $id_pengajuan));

		}
		

		if($result>0){

			if($level=='Branch Manager'){ // Jika yang Reject Kacab

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'rejected',
					'approved_by' => 'kacab',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note_reject')
				));

			}elseif($level=='Area Manager'){ // Jika yang Reject Kawil

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'rejected',
					'approved_by' => 'kawil',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note_reject')
				));

			}elseif($level=='Department Head'){ // Jika yang Reject Dept Head

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'rejected',
					'approved_by' => 'dept head',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note_reject')
				));

			}elseif($level=='Division Head'){ // Jika yang Reject Division Head

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'rejected',
					'approved_by' => 'division head',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note_reject')
				));

			}elseif($level=='Director'){ // Jika yang Reject Director

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'rejected',
					'approved_by' => 'director',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note_reject')
				));

			}elseif($level=='President Director'){ // Jika yang Reject President Director

				$this->M_master->simpan_approve_history('tbl_approved_history_penyelesaian', array(
					'nomor_pengajuan' => $no_pengajuan,
					'status_approve' => 'rejected',
					'approved_by' => 'president director',
					'nama_pengapprove' => $nama_lengkap,
					'tanggal' => date('Y-m-d'),
					'note' => $this->input->post('note_reject')
				));

			}
			

			$this->session->set_flashdata('pesan','Penyelesaian Biaya Berhasil Di Reject');
			redirect('inbox_penyelesaian');
		}
	}

	public function edit_jumlah(){
		$id_pengajuan = $this->input->post('id');
		$result = $this->M_master->update_pengajuan('tbl_pengajuan', array(
			'jumlah' => $this->input->post('jumlah'),
			'ppn' => $this->input->post('ppn'),
			'pph23' => $this->input->post('pph23'),
			'pph42' => $this->input->post('pph42'),
			'total' => $this->input->post('total')
		), array('id_pengajuan' => $id_pengajuan));

		if($result>0){
			$this->session->set_flashdata('pesan','Total Pengajuan Diubah');
			redirect('inbox/detail/'.$id_pengajuan);
		}

	}


	public function detail_counter($id){
		date_default_timezone_set("Asia/Jakarta");
		
		$cabang = $this->libraryku->tampil_user()->cabang;
		$departemen = $this->libraryku->tampil_user()->departemen;
		$level = $this->libraryku->tampil_user()->level;

		if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}
		
		$data_jb = $this->M_master->tampil_relasi_biaya(array('departemen' => $identitas))->result_array();


		// Cari Counter Pengajuan (Sdh Berapa yang diajukan pada bulan ini)
		$bulan_ini = date('m');
		$tahun_ini = date('Y');

		// Cari Data Dipilih
		$data_dipilih = $this->db->query("SELECT * FROM tbl_pengajuan WHERE id_pengajuan=$id")->row_array();
		$cabang1 = $data_dipilih['cabang'];
		$bagian1 = $data_dipilih['bagian'];
		$sub_biaya1 = $data_dipilih['sub_biaya'];


		// Query Cari Counter Pengajuan (Jumlah Data)
		$data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE 
			sub_biaya='$sub_biaya1' AND MONTH(tanggal)='$bulan_ini' AND YEAR(tanggal)='$tahun_ini' AND cabang='$cabang1' AND bagian='$bagian1' AND status_approve != 'cancel' AND
			sub_biaya='$sub_biaya1' AND MONTH(tanggal)='$bulan_ini' AND YEAR(tanggal)='$tahun_ini' AND cabang='$cabang1' AND bagian='$bagian1' AND status_approve != 'cancel by request' AND
			sub_biaya='$sub_biaya1' AND MONTH(tanggal)='$bulan_ini' AND YEAR(tanggal)='$tahun_ini' AND cabang='$cabang1' AND bagian='$bagian1' AND status_approve != 'rejected'
		")->result_array();

		$this->load->view('header');
		// $this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_list_counter', array(
			'data_pengajuan' => $data_pengajuan,
			'sub_biaya1' => $sub_biaya1,
			'cabang1' => $cabang1,
			'bagian1' => $bagian1
		));
		$this->load->view('footer');
	}


	public function detail_list_counter($id){
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

		// Data Pembayaran Pertama untuk menampilkan tanggal bayar
		$data_byr1 = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan' ORDER BY id ASC LIMIT 0,1")->row_array();

		// Tampilkan Data Memo
		$data_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

		$this->load->view('header');
		// $this->load->view('sidebar', array('data_jb'=>$data_jb));
		$this->load->view('v_list_counter_detail', array(
			'data_pengajuan' => $data_pengajuan,
			'data_approve_history' => $data_approve_history,
			'data_file' => $data_file,
			'data_check' => $data_check,
			'data_check_file' => $data_check_file,
			'data_perdin' => $data_perdin,
			'data_byr' => $data_byr,
			'frek_byr' => $frek_byr,
			'data_byr1' => $data_byr1,
			'data_byr2' => $data_byr2,
			'data_memo' => $data_memo
		));
		$this->load->view('footer');
	}


}
