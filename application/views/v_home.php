  <?php  

    $nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
    $cabang = $this->libraryku->tampil_user()->cabang;
    $departemen = $this->libraryku->tampil_user()->departemen;
    $level = $this->libraryku->tampil_user()->level;
    $jabatan_khusus = $this->libraryku->tampil_user()->jabatan_khusus;
    $password = $this->libraryku->tampil_user()->password;

    // Cari Identitas Sebagai Pembeda Cabang/Pusat 
    if($cabang=='HEAD OFFICE'){
			$identitas = $departemen;
		}else{
			$identitas = $level;
		}

    date_default_timezone_set("Asia/Jakarta");

  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <!-- Ambil Data Flashdata berhasil untuk kata sweet alert -->
  <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>
  
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <!-- Jika Ada pengajuan gagal proses, tampil di dashboard -->
      <?php 
        if($cabang == 'HEAD OFFICE'){
          $cek_gagal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_approve='over budget' AND bagian='$departemen'")->num_rows();
        }else{
          $cek_gagal = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_approve='over budget' AND cabang='$cabang' AND bagian='$level'")->num_rows();
        }
        
      ?>

      <?php if($cek_gagal > 0 AND $level=='Departement PIC'){ ?> <!-- jika ada pengajuan gagal tampilkan notifikasi -->
        <!-- Notifikasi Pengajuan gagal -->
        <div class="callout callout-danger">
            <h4>Perhatian !</h4>
            <p>
              Anda memiliki pengajuan yang gagal proses, biasanya disebabkan oleh kesalahan teknis (misal mati lampu, koneksi terputus, dll). Harap hapus pengajuan gagal tersebut dengan 
              <a href="<?php echo base_url().'p_on_proccess/pengajuan_gagal' ?>">Klik Disini</a>
            </p>
        </div>
      <?php } ?>


      <!-- Jika Ada tambahan dokumen, tampil di dashboard -->
      <?php 
        if($cabang == 'HEAD OFFICE'){
          $cek_tamdok = $this->db->query("SELECT * FROM tbl_pengajuan WHERE tambah_dokumen='ya' AND bagian='$departemen'")->num_rows();
        }else{
          $cek_tamdok = $this->db->query("SELECT * FROM tbl_pengajuan WHERE tambah_dokumen='ya' AND cabang='$cabang' AND bagian='$level'")->num_rows();
        }
        
      ?>

      <?php if($cek_tamdok > 0 AND $cabang=='HEAD OFFICE' AND $level=='Departement PIC' OR $cek_tamdok > 0 AND $cabang !='HEAD OFFICE'){ ?> <!-- jika ada tambahan dokumen tampilkan notifikasi -->
        <!-- Notifikasi Tambahan Dokumen -->
        <div class="callout callout-info">
            <h4>Perhatian !</h4>
            <p>
              Anda memiliki request tambahan dokumen, Silahkan 
              <a href="<?php echo base_url().'p_on_proccess/tambah_dokumen' ?>">Lengkapi Dokumen</a>
            </p>
        </div>
      <?php } ?>


      <!-- Jika Ada revisi data by finance, tampil di dashboard (khusus PIC Dept) -->
      <?php 

        if($cabang == 'HEAD OFFICE'){
          $cek_refin = $this->db->query("SELECT * FROM tbl_pengajuan WHERE revisi_finance='ya' AND dept_tujuan='$departemen'")->num_rows();
        }else{
          $cek_refin = $this->db->query("SELECT * FROM tbl_pengajuan WHERE revisi_finance='ya' AND dept_tujuan='$cabang' AND bagian='$level'")->num_rows();
        }
        
      ?>

      <?php if($cek_refin > 0 AND $cabang=='HEAD OFFICE' AND $level=='Departement PIC'){ ?> <!-- jika ada revisi data by finance tampilkan notifikasi -->
        <!-- Notifikasi Revisi data Finance -->
        <div class="callout callout-success">
            <h4>Perhatian !</h4>
            <p>
              Anda memiliki pengajuan revisi dari Finance Dept. Silahkan 
              <a href="<?php echo base_url().'p_on_proccess/revisi_finance' ?>">Lihat Data</a>
            </p>
        </div>
      <?php } ?>


      <!-- Jika Ada revisi rekening pengajuan by finance, tampil di dashboard (khusus PIC Dept) -->
      <?php 
        if($cabang == 'HEAD OFFICE'){
          $cek_refrek = $this->db->query("SELECT * FROM tbl_pengajuan WHERE revisi_rekening='ya' AND dept_tujuan='$departemen'")->num_rows();
        }else{
          $cek_refrek = $this->db->query("SELECT * FROM tbl_pengajuan WHERE revisi_rekening='ya' AND dept_tujuan='$cabang' AND bagian='$level'")->num_rows();
        }
        
      ?>

      <?php if($cek_refrek > 0){ ?> <!-- jika ada revisi rekening by finance tampilkan notifikasi -->
        <?php if($level == 'Departement PIC'){ ?>
          <!-- Notifikasi Revisi Rekening Finance -->
          <div class="callout callout-warning">
              <h4>Perhatian !</h4>
              <p>
                Anda memiliki pengajuan revisi (Terkait Nomor Rekening) dari Finance Dept. Silahkan 
                <a href="<?php echo base_url().'p_on_proccess/revisi_rekening' ?>">Lihat Data</a>
              </p>
          </div>
        <?php } ?>
      <?php } ?>
      <!-- Penutup Jika Ada revisi rekening pengajuan by finance, tampil di dashboard (khusus PIC Dept) -->


      <!-- Jika Ada revisi rekening penyelesaian by finance, tampil di dashboard (khusus PIC Dept) -->
      <?php 
        if($cabang == 'HEAD OFFICE'){
          $cek_refrek_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan WHERE revisi_rekening_penyelesaian='ya' AND departemen_tujuan='$departemen'")->num_rows();
        }else{
          $cek_refrek_penyelesaian = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan WHERE revisi_rekening_penyelesaian='ya' AND departemen_tujuan='$cabang'")->num_rows();
        }
        
      ?>

      <?php if($cek_refrek_penyelesaian > 0){ ?> <!-- jika ada revisi rekening penyelesaian by finance tampilkan notifikasi -->
        <?php if($level == 'Departement PIC'){ ?>
          <!-- Notifikasi Revisi Rekening Finance -->
          <div class="callout callout-warning">
              <h4>Perhatian !</h4>
              <p>
                Anda memiliki permintaan revisi (Terkait Nomor Rekening Penyelesaian) dari Finance Dept. Silahkan 
                <a href="<?php echo base_url().'review_kekurangan_biaya/revisi_rekening' ?>">Lihat Data</a>
              </p>
          </div>
        <?php } ?>
      <?php } ?>
      <!-- Penutup Jika Ada revisi rekening penyelesaian by finance, tampil di dashboard (khusus PIC Dept) -->


      <!-- Jika Ada Approval Masuk -->
      <?php

        if($level=='Branch Manager'){
          $cek_inbox = $this->M_master->tampil_inbox_kacab($cabang)->num_rows();
        }elseif($level=='Area Manager'){
          $cek_inbox = $this->M_master->tampil_inbox_kawil($cabang)->num_rows();
        }elseif($level=='Department Head'){
          $cek_inbox = $this->M_master->tampil_inbox_kadept($departemen, $nama_lengkap, $jabatan_khusus)->num_rows();
        }elseif($level=='Division Head'){
          $cek_inbox = $this->M_master->tampil_inbox_kadiv($nama_lengkap)->num_rows();
        }elseif($level=='Director'){
          $cek_inbox = $this->M_master->tampil_inbox_director($nama_lengkap)->num_rows();
        }elseif($level=='Director Finance'){
          $cek_inbox = $this->M_master->tampil_inbox_director_finance($nama_lengkap)->num_rows();
        }elseif($level=='President Director'){
          $cek_inbox = $this->M_master->tampil_inbox_presdir()->num_rows();
        }else{
          $cek_inbox = $this->M_master->tampil_inbox_kacab($nama_lengkap)->num_rows();
        }
        
      ?>

      <?php if($cek_inbox > 0){ ?> <!-- jika ada approval masuk tampilkan notifikasi -->
        <!-- Notifikasi Approval -->
        <div class="callout callout-success">
            <h4>Perhatian !</h4>
            <p>
              Anda memiliki <?php echo $cek_inbox; ?> approval pengajuan. Silahkan 
              <a href="<?php echo base_url().'inbox' ?>">Lihat Disini</a>
            </p>
        </div>
      <?php } ?>


      <!-- Jika Ada Approval Dir Finance Masuk -->
      <?php

        if($jabatan_khusus=='Director Finance'){
          $cek_inbox_dirfin = $this->M_master->tampil_inbox_director_finance($nama_lengkap)->num_rows();
        }else{
          $cek_inbox_dirfin = 0;
        }
        
      ?>

      <?php if($cek_inbox_dirfin > 0){ ?> <!-- jika ada approval masuk director finance tampilkan notifikasi -->
        <!-- Notifikasi Approval -->
        <div class="callout callout-info">
            <h4>Perhatian !</h4>
            <p>
              Anda memiliki <?php echo $cek_inbox_dirfin; ?> approval pengajuan (Direktur Finance). Silahkan 
              <a href="<?php echo base_url().'inbox_dirfin' ?>">Lihat Disini</a>
            </p>
        </div>
      <?php } ?>

      <!-- Jika Password Standar, Muncul Notifikasi Merah -->
      <?php if($password == 'aa9f4a51510466c95ba66eb18dfe89550b0ba8a0'){ ?>

        <div class="callout callout-warning">
            <h4>Perhatian !</h4>
            <p>
              Anda masih menggunakan password standar! Demi keamanan segera ganti password anda
              <a href="<?php echo base_url().'ganti_password' ?>">Disini</a>
            </p>
        </div>

      <?php } ?>


      <!-- Dokumen Terlambat -->
      <?php  
        $data_dokterlambat = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Telah Dibayar' AND status_dokumen='' AND cabang='$cabang' AND bagian='$identitas' AND datediff(tanggal_bayar, current_date()) < -14 ")->num_rows();
        
        if($data_dokterlambat > 0){
      ?>

        <div class="callout callout-danger">
            <h4>Peringatan Dokumen Terlambat !</h4>
            <p>
              Anda mempunyai <?php echo $data_dokterlambat ?> dokumen terlambat. Untuk melihat Detail nya, silahkan 
              <a href="<?php echo base_url().'dokumen_terlambat' ?>">Klik Disini</a>
            </p>
        </div>

      <?php } ?>


      <!-- Dokumen Terlambat -->
      <?php  
        $data_dokterlambat_reviewer = $this->db->query("SELECT * FROM tbl_pengajuan WHERE status_bayar='Telah Dibayar' AND status_dokumen='' AND dept_tujuan='$identitas' AND datediff(tanggal_bayar, current_date()) < -14 ")->num_rows();
        
        if($data_dokterlambat_reviewer > 0){
      ?>

        <div class="callout callout-danger">
            <h4>Peringatan Dokumen Terlambat (Reviewer) !</h4>
            <p>
              Anda mempunyai <?php echo $data_dokterlambat_reviewer ?> dokumen terlambat untuk pengajuan yang anda review. Untuk melihat Detail nya, silahkan 
              <a href="<?php echo base_url().'dokumen_terlambat_reviewer' ?>">Klik Disini</a>
            </p>
        </div>

      <?php } ?>

      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>

    <!-- Main content Pengajuan Biaya-->
    <section class="content" style="border:5px dashed orange; margin-left:10px; margin-right:10px">

    <p>
      <span style="font-weight:bold; font-size:20px; text-decoration: underline;">Dashboard Pengajuan Biaya</span>
    </p>
      
    <!-- Dashboard Utama -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a style="color: black" href="<?php echo base_url().'p_on_proccess' ?>">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
            
            <div class="info-box-content">
              <span class="info-box-text">On Proccess</span>
              <span class="info-box-number"><?php echo $data_onproccess; ?></span>
            </div>
            
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-2 col-sm-6 col-xs-12">
          <a style="color: black" href="<?php echo base_url().'p_approved' ?>">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Approved</span>
              <span class="info-box-number"><?php echo $data_approved; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-2 col-sm-6 col-xs-12">
          <a style="color: black" href="<?php echo base_url().'p_revisi' ?>">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-refresh"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Revisi</span>
              <span class="info-box-number"><?php echo $data_revisi; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-2 col-sm-6 col-xs-12">
          <a style="color: black" href="<?php echo base_url().'p_rejected' ?>">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-times"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Rejected</span>
              <span class="info-box-number"><?php echo $data_rejected; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <a style="color: black" href="<?php echo base_url().'p_cancel' ?>">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-stop"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Cancel</span>
              <span class="info-box-number"><?php echo $data_cancel; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


      </div>
    <!-- / Dashboard Utama -->


    <!-- Dashboard Paling Bener -->

      <div class="row">
        
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <h4>Status Pengajuan - PIC Dept</h4>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">

                <li>
                  <a href="<?php echo base_url().'p_approved/proses_check_pic' ?>">Proses Review - PIC Dept <span class="pull-right badge bg-green">
                    <?php echo $data_cek_pic; ?>
                  </span></a>
                </li>

                <!-- Jika Ada data di pending, buat background warnanya jadi kuning -->
                <?php if($data_pending_pic > 0){ ?>
                  <li style="background-color: yellow">
                    <a href="<?php echo base_url().'p_approved/pending_by_pic' ?>">Pending - PIC Dept <span class="pull-right badge bg-green">
                      <?php echo $data_pending_pic; ?>
                    </span></a>
                  </li>
                <?php }else{ ?>
                  <li>
                    <a href="<?php echo base_url().'p_approved/pending_by_pic' ?>">Pending - PIC Dept <span class="pull-right badge bg-green">
                      <?php echo $data_pending_pic; ?>
                    </span></a>
                  </li>
                <?php } ?>

                <li>
                  <a href="<?php echo base_url().'p_dokumen_pending' ?>">Dokumen Pending - PIC Dept <span class="pull-right badge bg-green">
                    <?php echo $data_pendok; ?>
                  </span></a>
                </li>

                <li>
                  <a href="<?php echo base_url().'p_dokumen_lengkap' ?>">Dokumen Diterima - PIC Dept <span class="pull-right badge bg-green">
                    <?php echo $data_lendok; ?>
                  </span></a>
                </li>

              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->


        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
              <h4>Status Pengajuan - Finance Dept</h4>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">

                <li>
                  <a href="<?php echo base_url().'p_approved/proses_check_finance' ?>">Proses Review - Finance <span class="pull-right badge bg-yellow">
                    <?php echo $data_cek_finance; ?>
                  </span></a>
                </li>

                <li>
                  <a href="<?php echo base_url().'p_approved/proses_bayar' ?>">Proses Bayar - Finance <span class="pull-right badge bg-yellow">
                    <?php echo $data_proses_bayar; ?>
                  </span></a>
                </li>

                <li>
                  <a href="<?php echo base_url().'p_telah_dibayar' ?>">Pembayaran Selesai <span class="pull-right badge bg-yellow">
                    <?php echo $data_telbay; ?>
                  </span></a>
                </li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->


        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green">
              <h4>Status Dokumen - Accounting Dept</h4>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">

                <!-- <li>
                  <a href="<?php echo base_url().'p_dokumen_pending' ?>">Dokumen Pending <span class="pull-right badge bg-aqua">
                    <?php echo $data_pendok; ?>
                  </span></a>
                </li> -->

                <li>
                  <a href="<?php echo base_url().'p_dokumen_lengkap' ?>">Dokumen Selesai <span class="pull-right badge bg-aqua">
                    <?php echo $data_accdok; ?>
                  </span></a>
                </li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

    <!-- / Dashboard Paling Bener -->
      
    </section>
    <!-- /.main content pengajuan biaya-->

    <!-- Dashboard Penyelesaian -->
    <?php include 'v_home_penyelesaian.php'; ?>

  </div>
  <!-- /.content-wrapper -->


  <!-- Panggil File JS SweetAlert -->
  <script src="<?php echo base_url().'asset/sweetAlert/sweetalert2.all.min.js' ?>"></script>

  <!-- script sweet alert -->
  <script type="text/javascript">
    // Jika Berhasil Melakukan Aksi (Simpan, Edit, Hapus)
    var flashData = $('.flash-data').data('flashdata');

    if(flashData){
      Swal.fire({
        icon: 'success', //Icon : success, error, warning, info, question
        title: 'Berhasil',
        text: flashData
        // footer: 'Data Mahasiswa Tersimpan Ke Database'
      });
    }

  </script>