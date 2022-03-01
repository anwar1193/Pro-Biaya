  <?php  

    $nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
    $cabang = $this->libraryku->tampil_user()->cabang;
    $departemen = $this->libraryku->tampil_user()->departemen;
    $level = $this->libraryku->tampil_user()->level;
    $jabatan_khusus = $this->libraryku->tampil_user()->jabatan_khusus;

    if($cabang=='HEAD OFFICE'){ // Jika Kantor Pusat
			$identitas = $departemen;
		}else{ // Jika Cabang
			$identitas = $level;
		}

  ?>


  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url().'asset/' ?>dist/img/avatar5.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $nama_lengkap; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> 
            <?php 
              if($cabang=='HEAD OFFICE'){
                if($level=='Director' || $level=='Director Finance' || $level=='President Director'){
                  echo $cabang;
                }else{
                  echo $departemen;
                }
              }else{
                echo $cabang;
              }
              
            ?> <br> 
            &nbsp;&nbsp;&nbsp; &nbsp;
            <?php  
              echo $level;
            ?>
          </a>
        </div>
      </div>

      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <!-- Menu Dashboard -->
        <li class="<?= $this->uri->segment(1)=='home' ? 'active' : null ?>"><a href="<?php echo base_url().'home' ?>"><i class="fa fa-dashboard"></i> <span style="font-size:17px">Dashboard</span></a></li>

        <li class="header" style="color:sandybrown; font-weight:bold; font-size:17px; text-decoration:underline">MENU PENGAJUAN</li>

        <?php if($level=='Director' OR $level=='President Director' OR $level=='admin' OR $level=='Director Finance' OR $departemen=='INTERNAL AUDIT'){ ?>
          <li class="<?= $this->uri->segment(1)=='inquiry_all' ? 'active' : null ?>"><a href="<?php echo base_url().'inquiry_all' ?>"><i class="fa fa-list"></i> <span>Inquiry Pengajuan (All)</span></a></li>
        <?php } ?>

        <?php if($departemen=='ACCOUNTING'){ ?>

        <!-- Menu All Pengajuan (Cab/Dept) -->
        <li class="<?= $this->uri->segment(1)=='all_pengajuan_tanggal' ? 'active' : null ?>"><a href="<?php echo base_url().'all_pengajuan_tanggal' ?>"><i class="fa fa-list"></i> <span>All Pengajuan (Cab/Dept)</span></a></li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-excel-o"></i> <span>Export Leggen</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Jurnal BMHD
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" data-toggle="modal" data-target="#headerLeggenPIC"><i class="fa fa-circle-o"></i> Header Data</a></li>
                <li><a href="#" data-toggle="modal" data-target="#detailLeggenPIC"><i class="fa fa-circle-o"></i> Detail Data</a></li>  
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Jurnal Payment
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" data-toggle="modal" data-target="#headerLeggenFIN"><i class="fa fa-circle-o"></i> Header Data</a></li>
                <li><a href="#" data-toggle="modal" data-target="#detailLeggenFIN"><i class="fa fa-circle-o"></i> Detail Data</a></li>  
              </ul>
            </li>
          </ul>
        </li>

        <?php } ?>

        <?php if($departemen=='ACCOUNTING' OR $departemen == 'INTERNAL AUDIT'){ ?>

        <!-- Report ACC -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-o"></i>
            <span>Report Accounting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" data-toggle="modal" data-target="#modal-report1"><i class="fa fa-circle-o"></i> Report Konsolidasi</a></li>

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Report By Cab-Dept
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" data-toggle="modal" data-target="#modal-report21"><i class="fa fa-circle-o"></i> Head Office</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modal-report22"><i class="fa fa-circle-o"></i> Cabang</a></li>
              </ul>
            </li>

            <li><a href="#" data-toggle="modal" data-target="#modal-report3"><i class="fa fa-circle-o"></i> Report Transaksi BMHD</a></li>

            <li><a href="#" data-toggle="modal" data-target="#modal-report4"><i class="fa fa-circle-o"></i> Report Transaksi Payment</a></li>

            <li><a href="#" data-toggle="modal" data-target="#modal-report5"><i class="fa fa-circle-o"></i> Report OS BMHD</a></li>
          </ul>
        </li>
        <!-- penutup Report ACC -->

        <?php } ?>
        
        <?php if($departemen=='ACCOUNTING'){ ?>

        <!-- Cetak Detail & Jurnal -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-print"></i>
            <span>Cetak Jurnal & Detail</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Cetak Jurnal
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" data-toggle="modal" data-target="#cetak-jurnal-bmhd"><i class="fa fa-circle-o"></i> Jurnal BMHD</a></li>
                <li><a href="#" data-toggle="modal" data-target="#cetak-jurnal-payment"><i class="fa fa-circle-o"></i> Jurnal Payment</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Cetak Detail
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" data-toggle="modal" data-target="#cetak-detail-bmhd"><i class="fa fa-circle-o"></i> Detail BMHD</a></li>
                <li><a href="#" data-toggle="modal" data-target="#cetak-detail-payment"><i class="fa fa-circle-o"></i> Detail Payment</a></li>
              </ul>
            </li>

          </ul>
        </li>
        <!-- penutup Cetak Detail & Jurnal -->


        <!-- Menu Data Relasi Sub Biaya -->
        <li class="<?= $this->uri->segment(1)=='data_coa' ? 'active' : null ?>"><a href="<?php echo base_url().'data_coa' ?>"><i class="fa fa-database"></i> <span>Data COA</span></a></li>
        <!-- End Menu Data Relasi Sub Biaya -->

        <?php } ?>

        <?php if($level!='ADCO' AND $level!='ADCOLL' AND $level!='CMC' AND $level!='ADD-CABANG' AND $level!='Departement PIC' AND $level!='admin' AND $nama_lengkap!='REGINA'){ ?>
        <!-- Menu Inbox -->
        <li class="<?= $this->uri->segment(1)=='inbox' ? 'active' : null ?>"><a href="<?php echo base_url().'inbox' ?>"><i class="fa fa-envelope"></i> 
          
          <span>Persetujuan Pengajuan</span>
          <span class="pull-right-container">
            <?php
              $limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
              $min_approve = $limit_approve['min_approve'];
              $max_approve = $limit_approve['max_approve'];

              if($level=='Branch Manager'){
                $jml_inbox = $this->M_master->tampil_inbox_kacab($cabang)->num_rows();
              }elseif($level=='Area Manager'){
                $jml_inbox = $this->M_master->tampil_inbox_kawil($cabang)->num_rows();
              }elseif($level=='Department Head'){
                $jml_inbox = $this->M_master->tampil_inbox_kadept($departemen, $nama_lengkap, $jabatan_khusus)->num_rows();
              }elseif($level=='Division Head'){
                $jml_inbox = $this->M_master->tampil_inbox_kadiv($nama_lengkap)->num_rows();
              }elseif($level=='Director'){
                $jml_inbox = $this->M_master->tampil_inbox_director($nama_lengkap)->num_rows();
              }elseif($level=='Director Finance'){
                $jml_inbox = $this->M_master->tampil_inbox_director_finance($nama_lengkap)->num_rows();
              }elseif($level=='President Director'){
                $jml_inbox = $this->M_master->tampil_inbox_presdir()->num_rows();
              }else{
                $jml_inbox = $this->M_master->tampil_inbox_kacab($cabang)->num_rows();
              }
            ?>
            <span class="label label-success pull-right"><?php echo $jml_inbox ?></span>
          </span>

          </a></li>
        <?php } ?>


        <!-- Persetujuan Direktur Finance -->
        <?php if($jabatan_khusus=='Director Finance'){ ?>
        <!-- Menu Inbox -->
        <li class="<?= $this->uri->segment(1)=='inbox_dirfin' ? 'active' : null ?>"><a href="<?php echo base_url().'inbox_dirfin' ?>"><i class="fa fa-envelope"></i> 
          
          <span>Persetujuan Dir Finance</span>
          <span class="pull-right-container">
            <?php
              $jml_inbox = $this->M_master->tampil_inbox_director_finance($nama_lengkap)->num_rows();
            ?>
            <span class="label label-danger pull-right"><?php echo $jml_inbox ?></span>
          </span>

          </a></li>
        <?php } ?>
        <!-- Penutup Persetujuan Direktur Finance -->

        <!-- Menu Pengajuan Biaya -->
        <?php if($level!='Department Head' AND $level!='Division Head' AND $level!='Branch Manager' AND $level!='Area Manager' AND $level!='Director' AND $level!='Director Finance' AND $level!='President Director' AND $level!='admin'){ ?>
        <li class="<?= $this->uri->segment(1)=='pengajuan_biaya' ? 'active' : null ?>"><a href="#" data-toggle="modal" data-target="#modal-pengajuan"><i class="fa fa-money"></i> <span>Ajukan Biaya</span></a></li>
        <?php } ?>

        <!-- Menu Inquiry Pengajuan -->
        <?php if($level!='Director' AND $level!='President Director' AND $level!='admin' AND $level!='Director Finance'){ ?>

          <li class="<?= $this->uri->segment(1)=='inquiry_pengajuan' ? 'active' : null ?>"><a href="<?php echo base_url().'inquiry_pengajuan' ?>"><i class="fa fa-list"></i> <span>Inquiry Pengajuan</span></a></li>

        <?php } ?>

        <!-- Menu Status Pengajuan -->
        <?php if($level!='Director' AND $level!='President Director' AND $level!='admin' AND $level!='Director Finance'){ ?>
        <li class="treeview <?= $this->uri->segment(1)=='p_on_proccess' || $this->uri->segment(1)=='p_rejected' || $this->uri->segment(1)=='p_approved' || $this->uri->segment(1)=='p_revisi' || $this->uri->segment(1)=='p_cancel' ? 'active' : null ?>">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Status Pengajuan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $this->uri->segment(1)=='p_on_proccess' ? 'active' : null ?>"><a href="<?php echo base_url().'p_on_proccess' ?>"><i class="fa fa-circle-o"></i> On Proccess</a></li>

            <!-- <li class="<?= $this->uri->segment(1)=='p_approved' ? 'active' : null ?>"><a href="<?php echo base_url().'p_approved' ?>"><i class="fa fa-circle-o"></i> Approved</a></li> -->

            <li class="treeview <?= $this->uri->segment(2)=='proses_check_pic' || $this->uri->segment(2)=='pending_by_pic' || $this->uri->segment(2)=='proses_check_finance' || $this->uri->segment(2)=='proses_bayar' ? 'active' : null ?>">
              <a href="#"><i class="fa fa-circle-o"></i> Approved
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?= $this->uri->segment(2)=='proses_check_pic' ? 'active' : null ?>"><a href="<?php echo base_url().'p_approved/proses_check_pic' ?>"><i class="fa fa-circle-o"></i> Proses Review - PIC</a></li>

                <li class="<?= $this->uri->segment(2)=='pending_by_pic' ? 'active' : null ?>"><a href="<?php echo base_url().'p_approved/pending_by_pic' ?>"><i class="fa fa-circle-o"></i> Pending - PIC</a></li>

                <li class="<?= $this->uri->segment(2)=='proses_check_finance' ? 'active' : null ?>"><a href="<?php echo base_url().'p_approved/proses_check_finance' ?>"><i class="fa fa-circle-o"></i> Proses Review - Finance</a></li>

                <li class="<?= $this->uri->segment(2)=='proses_bayar' ? 'active' : null ?>"><a href="<?php echo base_url().'p_approved/proses_bayar' ?>"><i class="fa fa-circle-o"></i> Proses Bayar - Finance</a></li>
              </ul>
            </li>

            <li class="<?= $this->uri->segment(1)=='p_revisi' ? 'active' : null ?>"><a href="<?php echo base_url().'p_revisi' ?>"><i class="fa fa-circle-o"></i> Revisi</a></li>

            <li class="<?= $this->uri->segment(1)=='p_rejected' ? 'active' : null ?>"><a href="<?php echo base_url().'p_rejected' ?>"><i class="fa fa-circle-o"></i> Rejected</a></li>

            <li class="<?= $this->uri->segment(1)=='p_cancel' ? 'active' : null ?>"><a href="<?php echo base_url().'p_cancel' ?>"><i class="fa fa-circle-o"></i> Cancel</a></li>
          </ul>
        </li>
        <?php } ?>

        <?php if($departemen!='CASH MANAGEMENT' && $departemen!='INTERNAL AUDIT'){ ?>
          <?php if($level=='Departement PIC'){ ?>
          <!-- Menu Review Pengajuan -->
          <li class="<?= $this->uri->segment(1)=='p_review' ? 'active' : null ?>"><a href="<?php echo base_url().'p_review' ?>"><i class="fa fa-check-square-o"></i> 
              <span>Review Pengajuan</span>
              <span class="pull-right-container">
              <?php  
                if($level=='Departement PIC'){
                  $jml_review = $this->M_master->tampil_review($departemen)->num_rows();
                }elseif($level=='Department Head'){
                  $jml_review = $this->M_master->tampil_review_head($departemen)->num_rows();
                }
              ?>
              <span class="label label-primary pull-right"><?php echo $jml_review; ?></span>
            </a></li>
          <?php } ?>
        <?php } ?>

        <?php if($departemen=='CASH MANAGEMENT'){ ?>

        <!-- Menu Setujui Bayar Pengajuan -->
        <li class="<?= $this->uri->segment(1)=='p_bayar' ? 'active' : null ?>"><a href="<?php echo base_url().'p_bayar' ?>"><i class="fa fa-dollar"></i> 
            <span>Setujui Byr Pengajuan</span>
            <span class="pull-right-container">
            <?php  
              $jml_bayar = $this->M_master->tampil_bayar()->num_rows();
            ?>
            <span class="label label-danger pull-right"><?php echo $jml_bayar; ?></span>
          </a></li>

        <!-- Menu Bayar Pengajuan -->
        <li class="<?= $this->uri->segment(1)=='p_bayar_final' ? 'active' : null ?>"><a href="<?php echo base_url().'p_bayar_final' ?>"><i class="fa fa-dollar"></i> 
            <span>Bayar Pengajuan-Final</span>
            <span class="pull-right-container">
            <?php  
              $jml_bayar_final = $this->M_master->tampil_bayar_final()->num_rows();
            ?>
            <span class="label label-success pull-right"><?php echo $jml_bayar_final; ?></span>
          </a></li>
        <?php } ?>

        <?php if($departemen=='CASH MANAGEMENT' OR $nama_lengkap=='REGINA'){ ?>
        <!-- Menu Inquiry Pembayaran -->

        <li class="treeview <?= $this->uri->segment(1)=='history_bayar' || $this->uri->segment(1)=='history_telah_bayar' ? 'active' : null ?>">
          <a href="#">
            <i class="fa fa-list"></i>
            <span>Inquiry Pembayaran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $this->uri->segment(1)=='history_bayar' ? 'active' : null ?>"><a href="<?php echo base_url().'history_bayar' ?>"><i class="fa fa-circle-o"></i> Proses Bayar</a></li>

            <li class="<?= $this->uri->segment(1)=='history_telah_bayar' ? 'active' : null ?>"><a href="<?php echo base_url().'history_telah_bayar' ?>"><i class="fa fa-circle-o"></i> Telah Dibayar</a></li>
          </ul>
        </li>

        <?php } ?>

        <?php if($departemen!='CASH MANAGEMENT' && $departemen!='INTERNAL AUDIT'){ ?>
          
          <?php if($level=='Departement PIC'){ ?>

          <!-- Pendingan Dokumen Yang Masuk Ke PIC tsb -->
          <li class="<?= $this->uri->segment(1)=='pendingan_dokumen' ? 'active' : null ?>"><a href="<?php echo base_url().'pendingan_dokumen' ?>"><i class="fa fa-file-o"></i> 
              <span>Review Dokumen</span>
            </a></li>
          
          <?php } ?>
          
          <?php if($level=='Departement PIC' || $level=='Department Head'){ ?>

          <!-- History Pengajuan Yang Masuk Ke PIC tsb -->
          <li class="<?= $this->uri->segment(1)=='history_pengajuan' ? 'active' : null ?>"><a href="<?php echo base_url().'history_pengajuan' ?>"><i class="fa fa-list-alt"></i> 
              <span>Inquiry Review Pengajuan</span>
            </a></li>
          
          <?php } ?>
            
          
          <?php if($level=='Departement PIC'){ ?>

          <!-- History Pengajuan Cancel Yang tujuannya Ke PIC tsb -->
          <li class="<?= $this->uri->segment(1)=='inquiry_review_cancel' ? 'active' : null ?>"><a href="<?php echo base_url().'inquiry_review_cancel' ?>"><i class="fa fa-stop"></i> 
              <span>Inquiry Review - Cancel</span>
            </a></li>


          <!-- History Pengajuan Reject Yang tujuannya Ke PIC tsb -->
          <li class="<?= $this->uri->segment(1)=='inquiry_review_reject' ? 'active' : null ?>"><a href="<?php echo base_url().'inquiry_review_reject' ?>"><i class="fa fa-stop"></i> 
              <span>Inquiry Review - Reject</span>
            </a></li>


          <?php } ?>

        <?php } ?>

        <?php if($departemen=='INTERNAL AUDIT'){ ?>
        <!-- History Pengajuan Yang Masuk Ke PIC tsb -->
        <li class="<?= $this->uri->segment(1)=='cek_audit' ? 'active' : null ?>"><a href="<?php echo base_url().'cek_audit' ?>"><i class="fa fa-eye"></i> 
            <span>Cek Pengajuan (Audit)</span>
          </a></li>
        <?php } ?>

        <!-- Menu Budget -->
        <!-- <?php if($level!='Director' AND $level!='President Director'){ ?>
        <li class="<?= $this->uri->segment(1)=='budget' ? 'active' : null ?>"><a href="<?php echo base_url().'budget' ?>"><i class="fa fa-dollar"></i> <span>Budget</span></a></li>
        <?php } ?> -->

        <?php if($departemen=='CASH MANAGEMENT'){ ?>
        <!-- Menu Admin Budget -->
        <!-- <li class="<?= $this->uri->segment(1)=='budget_admin' ? 'active' : null ?>"><a href="<?php echo base_url().'budget_admin' ?>"><i class="fa fa-money"></i> 
            <span>Admin Budget</span>
          </a></li> -->
        <?php } ?>


        <?php if($level=='admin'){ ?>
        <!-- Menu Master Data -->
        <li class="treeview <?= $this->uri->segment(1)=='data_cabang' || $this->uri->segment(1)=='data_karyawan' || $this->uri->segment(1)=='data_kendaraan' || $this->uri->segment(1)=='data_sparepart' || $this->uri->segment(1)=='data_bank' || $this->uri->segment(1)=='data_departemen' || $this->uri->segment(1)=='data_jenis_biaya' || $this->uri->segment(1)=='data_sub_biaya' || $this->uri->segment(1)=='data_level' || $this->uri->segment(1)=='relasi_biaya' || $this->uri->segment(1)=='relasi_sub' ? 'active' : null ?>">
          <a href="#">
            <i class="fa fa-database"></i>
            <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $this->uri->segment(1)=='data_cabang' ? 'active' : null ?>"><a href="<?php echo base_url().'data_cabang' ?>"><i class="fa fa-circle-o"></i> Data Cabang</a></li>

            <li class="<?= $this->uri->segment(1)=='data_departemen' ? 'active' : null ?>"><a href="<?php echo base_url().'data_departemen' ?>"><i class="fa fa-circle-o"></i> Data Departemen</a></li>

            <li class="<?= $this->uri->segment(1)=='data_karyawan' ? 'active' : null ?>"><a href="<?php echo base_url().'data_karyawan' ?>"><i class="fa fa-circle-o"></i> Data Karyawan</a></li>

            <li class="<?= $this->uri->segment(1)=='data_kendaraan' ? 'active' : null ?>"><a href="<?php echo base_url().'data_kendaraan' ?>"><i class="fa fa-circle-o"></i> Data Kendaraan</a></li>

            <li class="<?= $this->uri->segment(1)=='data_sparepart' ? 'active' : null ?>"><a href="<?php echo base_url().'data_sparepart' ?>"><i class="fa fa-circle-o"></i> Data Sparepart</a></li>

            <li class="<?= $this->uri->segment(1)=='data_bank' ? 'active' : null ?>"><a href="<?php echo base_url().'data_bank' ?>"><i class="fa fa-circle-o"></i> Data Bank</a></li>

            <li class="<?= $this->uri->segment(1)=='data_jenis_biaya' ? 'active' : null ?>"><a href="<?php echo base_url().'data_jenis_biaya' ?>"><i class="fa fa-circle-o"></i> Data Jenis Biaya</a></li>

            <li class="<?= $this->uri->segment(1)=='data_sub_biaya' ? 'active' : null ?>"><a href="<?php echo base_url().'data_sub_biaya' ?>"><i class="fa fa-circle-o"></i> Data Sub Biaya</a></li>

            <li class="<?= $this->uri->segment(1)=='data_level' ? 'active' : null ?>"><a href="<?php echo base_url().'data_level' ?>"><i class="fa fa-circle-o"></i> Data Level</a></li>

            <li class="<?= $this->uri->segment(1)=='relasi_biaya' ? 'active' : null ?>"><a href="<?php echo base_url().'relasi_biaya' ?>"><i class="fa fa-circle-o"></i> Relasi Biaya</a></li>

            <li class="<?= $this->uri->segment(1)=='relasi_sub' ? 'active' : null ?>"><a href="<?php echo base_url().'relasi_sub' ?>"><i class="fa fa-circle-o"></i> Relasi Sub Biaya</a></li>
          </ul>
        </li>

        <!-- Menu Dashboard -->
        <li class="<?= $this->uri->segment(1)=='wa_blast' ? 'active' : null ?>"><a href="<?php echo base_url().'wa_blast' ?>"><i class="fa fa-whatsapp"></i> <span>Whatsapp/Email Blast</span></a></li>
        <?php } ?>

        <?php if($level == 'Director' || $level == 'President Director'){ ?>

          <!-- Report Direksi -->
          <li class="treeview">
            <a href="#">
              <i class="fa fa-file-o"></i>
              <span>Report Pengajuan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              <li><a href="#" data-toggle="modal" data-target="#modal_dir1"><i class="fa fa-circle-o"></i> Report Rekap</a></li>

              <li><a href="#" data-toggle="modal" data-target="#modal_dir2"><i class="fa fa-circle-o"></i> Report Rincian</a></li>

            </ul>
          </li>
          <!-- penutup Report Direksi -->

        <?php } ?>

        
        <li class="header" style="color:sandybrown; font-weight:bold; font-size:17px; text-decoration:underline">MENU PENYELESAIAN</li>

        <?php  
          if($level == 'admin'){
        ?>

            <!-- Inquiry Penyelesaian Biaya -->
            <li class="treeview <?= $this->uri->segment(1)=='inquiry_kelebihan_biaya_all' || $this->uri->segment(1)=='inquiry_kekurangan_biaya_all' ? 'active' : null ?>">
              <a href="#">
                <i class="fa fa-list"></i>
                <span>Inquiry Penyelesaian (All)</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">

              <li class="<?= $this->uri->segment(1)=='inquiry_kelebihan_biaya_all' ? 'active' : null ?>"><a href="<?php echo base_url().'inquiry_kelebihan_biaya_all' ?>"><i class="fa fa-circle-o"></i> <span>Inquiry Kelebihan Biaya</span></a></li>

              <li class="<?= $this->uri->segment(1)=='inquiry_kekurangan_biaya_all' ? 'active' : null ?>"><a href="<?php echo base_url().'inquiry_kekurangan_biaya_all' ?>"><i class="fa fa-circle-o"></i> <span>Inquiry Kekurangan Biaya</span></a></li>

              </ul>
            </li>
            <!-- Penutup Inquiry Penyelesaian Biaya -->

        <?php } ?>

        <?php if($level!='Department Head' AND $level!='Division Head' AND $level!='Branch Manager' AND $level!='Area Manager' AND $level!='Director' AND $level!='Director Finance' AND $level!='President Director' AND $level!='admin'){ ?>

          <!-- Kirim Penyelesaian Biaya -->
          <li class="treeview <?= $this->uri->segment(1)=='kelebihan_biaya' || $this->uri->segment(1)=='kekurangan_biaya' ? 'active' : null ?>">
            <a href="#">
              <i class="fa fa-money"></i>
              <span>Kirim Penyelesaian</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

            <li class="<?= $this->uri->segment(1)=='kelebihan_biaya' ? 'active' : null ?>"><a href="<?php echo base_url().'kelebihan_biaya' ?>"><i class="fa fa-circle-o"></i> <span>Kelebihan Biaya</span></a></li>

            <li class="<?= $this->uri->segment(1)=='kekurangan_biaya' ? 'active' : null ?>"><a href="<?php echo base_url().'kekurangan_biaya' ?>"><i class="fa fa-circle-o"></i> <span>Kekurangan Biaya</span></a></li>

            </ul>
          </li>
          <!-- Penutup Kirim Penyelesaian Biaya -->
        
        <?php } ?>


        <?php if($level!='Department Head' AND $level!='Division Head' AND $level!='Director' AND $level!='Director Finance' AND $level!='President Director' AND $level!='admin'){ ?>

          <!-- Inquiry Penyelesaian Biaya -->
          <li class="treeview <?= $this->uri->segment(1)=='inquiry_kelebihan_biaya' || $this->uri->segment(1)=='inquiry_kekurangan_biaya' || $this->uri->segment(1)=='inquiry_biaya_sesuai' || $this->uri->segment(1)=='inquiry_biaya_dikembalikan' ? 'active' : null ?>">
            <a href="#">
              <i class="fa fa-list"></i>
              <span>Inquiry Penyelesaian</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

            <li class="<?= $this->uri->segment(1)=='inquiry_kelebihan_biaya' ? 'active' : null ?>"><a href="<?php echo base_url().'inquiry_kelebihan_biaya' ?>"><i class="fa fa-circle-o"></i> <span>Inquiry Kelebihan Biaya</span></a></li>

            <li class="<?= $this->uri->segment(1)=='inquiry_kekurangan_biaya' ? 'active' : null ?>"><a href="<?php echo base_url().'inquiry_kekurangan_biaya' ?>"><i class="fa fa-circle-o"></i> <span>Inquiry Kekurangan Biaya</span></a></li>

            <li class="<?= $this->uri->segment(1)=='inquiry_biaya_sesuai' ? 'active' : null ?>"><a href="<?php echo base_url().'inquiry_biaya_sesuai' ?>"><i class="fa fa-circle-o"></i> <span>Inquiry Biaya Sesuai</span></a></li>

            <li class="<?= $this->uri->segment(1)=='inquiry_biaya_dikembalikan' ? 'active' : null ?>"><a href="<?php echo base_url().'inquiry_biaya_dikembalikan' ?>"><i class="fa fa-circle-o"></i> <span>Inquiry Biaya Dikembalikan</span></a></li>

            </ul>
          </li>
          <!-- Penutup Inquiry Penyelesaian Biaya -->

        <?php } ?>


        <?php if($level!='Department Head' AND $level!='Division Head' AND $level!='Branch Manager' AND $level!='Area Manager' AND $level!='Director' AND $level!='Director Finance' AND $level!='President Director' AND $level!='admin'){ ?>

          <!-- Menu Pending Penyelesaian / Pengajuan Belum Diselesaikan -->
          <li class="<?= $this->uri->segment(1)=='pending_penyelesaian' ? 'active' : null ?>">
            <a href="<?php echo base_url().'pending_penyelesaian' ?>">
              <i class="fa fa-clock-o"></i> <span>Pending Penyelesaian</span>

              <?php  
                $jumlah_pending_penyelesaian = $this->db->query("SELECT * FROM tbl_pengajuan WHERE cabang='$cabang' AND bagian='$identitas' AND status_bayar='Telah Dibayar' AND nomor_invoice='ESTIMASI' AND note_penyelesaian!='' AND status_penyelesaian='' ")->num_rows();
              ?>
              <span class="pull-right-container">
                <span class="label label-warning pull-right"><?php echo $jumlah_pending_penyelesaian; ?></span>
              </span>

            </a>
          </li>
          <!-- Penutup Menu Pending Penyelesaian / Pengajuan Belum Diselesaikan -->
       
        <?php } ?>

        
        <!-- Menu Bayar Penyelesaian -->
        <?php if($departemen=='CASH MANAGEMENT'){ ?>
          
          <li class="<?= $this->uri->segment(1)=='setuju_bayar_penyelesaian' ? 'active' : null ?>"><a href="<?php echo base_url().'setuju_bayar_penyelesaian' ?>"><i class="fa fa-dollar"></i> 
              <span>Setujui Byr Penyelesaian</span>
              <span class="pull-right-container">
              <?php  
                $jml_bayar_penyelesaian = $this->M_master->tampil_bayar_penyelesaian()->num_rows();
              ?>
              <span class="label label-danger pull-right"><?php echo $jml_bayar_penyelesaian; ?></span>
            </a></li>

            <li class="<?= $this->uri->segment(1)=='bayar_penyelesaian_final' ? 'active' : null ?>"><a href="<?php echo base_url().'bayar_penyelesaian_final' ?>"><i class="fa fa-dollar"></i> 
              <span>Bayar Penyelesaian Final</span>
              <span class="pull-right-container">
                <?php  
                  $jml_bayar_penyelesaian2 = $this->M_master->tampil_bayar_penyelesaian2()->num_rows();
                ?>
                <span class="label label-success pull-right"><?php echo $jml_bayar_penyelesaian2; ?></span>
            </a></li>

        <?php } ?>
        <!-- Penutup Menu Bayar Penyelesaian -->


        <?php if($level!='ADCO' AND $level!='ADCOLL' AND $level!='CMC' AND $level!='ADD-CABANG' AND $level!='Departement PIC' AND $level!='admin' AND $nama_lengkap!='REGINA'){ ?>

        <!-- Menu Inbox Penyelesaian -->
        <li class="<?= $this->uri->segment(1)=='inbox_penyelesaian' ? 'active' : null ?>"><a href="<?php echo base_url().'inbox_penyelesaian' ?>"><i class="fa fa-envelope"></i> 

          <span>Persetujuan Penyelesaian</span>
          <span class="pull-right-container">
            <?php
              $limit_approve = $this->M_master->ambil_limit('tbl_level', array('level'=>$level))->row_array();
              $min_approve = $limit_approve['min_approve'];
              $max_approve = $limit_approve['max_approve'];

              if($level=='Branch Manager'){
                $jml_inbox = $this->M_master->tampil_inbox_kacab2($cabang)->num_rows();
              }elseif($level=='Area Manager'){
                $jml_inbox = $this->M_master->tampil_inbox_kawil2($cabang)->num_rows();
              }elseif($level=='Department Head'){
                $jml_inbox = $this->M_master->tampil_inbox_kadept2($departemen, $nama_lengkap, $jabatan_khusus)->num_rows();
              }elseif($level=='Division Head'){
                $jml_inbox = $this->M_master->tampil_inbox_kadiv2($nama_lengkap)->num_rows();
              }elseif($level=='Director'){
                $jml_inbox = $this->M_master->tampil_inbox_director2($nama_lengkap)->num_rows();
              }elseif($level=='Director Finance'){
                $jml_inbox = $this->M_master->tampil_inbox_director_finance2($nama_lengkap)->num_rows();
              }elseif($level=='President Director'){
                $jml_inbox = $this->M_master->tampil_inbox_presdir2()->num_rows();
              }else{
                $jml_inbox = $this->M_master->tampil_inbox_kacab2($cabang)->num_rows();
              }
            ?>
            <span class="label label-success pull-right"><?php echo $jml_inbox ?></span>
          </span>

        </a></li>
        <!-- Penutup Inbox Penyelesaian -->
        <?php } ?>

        <!-- Persetujuan Penyelesaian Direktur Finance -->
        <?php if($jabatan_khusus=='Director Finance'){ ?>
        <!-- Menu Inbox -->
        <li class="<?= $this->uri->segment(1)=='inbox_penyelesaian_dirfin' ? 'active' : null ?>"><a href="<?php echo base_url().'inbox_penyelesaian_dirfin' ?>"><i class="fa fa-envelope"></i> 
          
          <span>Persetujuan Dir Finance</span>
          <span class="pull-right-container">
            <?php
              $jml_inbox2 = $this->M_master->tampil_inbox_director_finance2($nama_lengkap)->num_rows();
            ?>
            <span class="label label-danger pull-right"><?php echo $jml_inbox2 ?></span>
          </span>

          </a></li>
        <?php } ?>
        <!-- Penutup Persetujuan Penyelesaian Direktur Finance -->


        <?php if($departemen!='CASH MANAGEMENT' && $departemen!='INTERNAL AUDIT'){ ?>
          <?php if($level=='Departement PIC'){ ?>
          
            <!-- Review Penyelesaian Biaya -->
            <li class="<?= $this->uri->segment(1)=='review_kelebihan_biaya' ? 'active' : null ?>"><a href="<?php echo base_url().'review_kelebihan_biaya' ?>"><i class="fa fa-check-square-o"></i> 
              <span>Review Kelebihan Biaya</span>
              <span class="pull-right-container">
              <?php  
                $jml_review_kelebihan = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_pengajuan.dept_tujuan='$departemen' AND tbl_penyelesaian_kelebihan.status_verifikasi_penyelesaian='On Proccess' ORDER BY tbl_penyelesaian_kelebihan.id_penyelesaian DESC")->num_rows();
              ?>
              <span class="label label-success pull-right"><?php echo $jml_review_kelebihan; ?></span>
            </a></li>


            <li class="<?= $this->uri->segment(1)=='review_kekurangan_biaya' ? 'active' : null ?>"><a href="<?php echo base_url().'review_kekurangan_biaya' ?>"><i class="fa fa-check-square-o"></i> 
              <span>Review Kekurangan Biaya</span>
              <span class="pull-right-container">
              <?php  
                $jml_review_kekurangan = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan INNER JOIN tbl_pengajuan USING(nomor_pengajuan) WHERE tbl_penyelesaian_kekurangan.departemen_tujuan='$departemen' AND tbl_penyelesaian_kekurangan.status_approve_penyelesaian='final approved' AND tbl_penyelesaian_kekurangan.status_verifikasi_penyelesaian='' ORDER BY tbl_penyelesaian_kekurangan.id_penyelesaian DESC")->num_rows();
              ?>
              <span class="label label-danger pull-right"><?php echo $jml_review_kekurangan; ?></span>
            </a></li>


            <li class="<?= $this->uri->segment(1)=='revisi_request_penyelesaian' ? 'active' : null ?>"><a href="<?php echo base_url().'revisi_request_penyelesaian' ?>"><i class="fa fa-wechat"></i> 
              <span>Rev. Request Penyelesaian</span>
            </a></li>
            <!-- Penutup Review Penyelesaian Biaya -->

          <?php } ?>
        <?php } ?>

        <?php if($departemen=='ACCOUNTING'){ ?>
          <!-- Review Penyelesaian Biaya By Accounting -->
          <li class="active treeview <?= $this->uri->segment(1)=='review_kelebihan_accounting' || $this->uri->segment(1)=='review_kekurangan_accounting' ? 'active' : null ?>">
              <a href="#">
                <i class="fa fa-check-square-o"></i>
                <span>All Penyelesaian (Cab/Dept)</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">

              <li class="<?= $this->uri->segment(1)=='review_kelebihan_accounting' ? 'active' : null ?>"><a href="<?php echo base_url().'review_kelebihan_accounting' ?>">
                <i class="fa fa-circle-o"></i> 
                <span>All Peny. Kelebihan</span>
                <span class="pull-right-container">
                <?php  
                  $jml_all_peny_kelebihan = $this->db->query("SELECT * FROM tbl_penyelesaian_kelebihan WHERE status_verifikasi_penyelesaian='Verified By PIC'")->num_rows();
                ?>
                <span class="label label-success pull-right"><?php echo $jml_all_peny_kelebihan; ?></span>
                </a>
              </li>

              <li class="<?= $this->uri->segment(1)=='review_kekurangan_accounting' ? 'active' : null ?>"><a href="<?php echo base_url().'review_kekurangan_accounting' ?>"><i class="fa fa-circle-o"></i> 
                <span>All Peny. Kekurangan</span>
                <span class="pull-right-container">
                <?php  
                  $jml_all_peny_kekurangan = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan WHERE status_verifikasi_penyelesaian='Verified'")->num_rows();
                ?>
                <span class="label label-danger pull-right"><?php echo $jml_all_peny_kekurangan; ?></span>
              </a></li>

              <li class="<?= $this->uri->segment(1)=='review_penyelesaian_sesuai' ? 'active' : null ?>"><a href="<?php echo base_url().'review_penyelesaian_sesuai' ?>"><i class="fa fa-circle-o"></i> 
                <span>All Peny. Sesuai</span>
                <span class="pull-right-container">
                <?php  
                  $jml_all_peny_sesuai = $this->db->query("SELECT * FROM tbl_penyelesaian_sesuai WHERE status_verifikasi_penyelesaian='Verified By PIC'")->num_rows();
                ?>
                <span class="label label-primary pull-right"><?php echo $jml_all_peny_sesuai; ?></span>
              </a></li>

              <li class="<?= $this->uri->segment(1)=='review_penyelesaian_dikembalikan' ? 'active' : null ?>"><a href="<?php echo base_url().'review_penyelesaian_dikembalikan' ?>"><i class="fa fa-circle-o"></i> 
                <span>All Peny. Dikembalikan</span>
                <span class="pull-right-container">
                <?php  
                  $jml_all_peny_dikembalikan = $this->db->query("SELECT * FROM tbl_penyelesaian_dikembalikan WHERE status_verifikasi_penyelesaian='Verified By PIC'")->num_rows();
                ?>
                <span class="label label-warning pull-right"><?php echo $jml_all_peny_dikembalikan; ?></span>
              </a></li>

              </ul>
            </li>
            <!-- Penutup Review Penyelesaian Biaya By Accounting -->

            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-excel-o"></i> <span>Export Leggen</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Jurnal BMHD
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#" data-toggle="modal" data-target="#headerLeggenPICPenyelesaian"><i class="fa fa-circle-o"></i> Header Data</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#detailLeggenPICPenyelesaian"><i class="fa fa-circle-o"></i> Detail Data</a></li>  
                  </ul>
                </li>

                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Jurnal Payment
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#" data-toggle="modal" data-target="#headerLeggenFINPenyelesaian"><i class="fa fa-circle-o"></i> Header Data</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#detailLeggenFINPenyelesaian"><i class="fa fa-circle-o"></i> Detail Data</a></li>  
                  </ul>
                </li>
              </ul>
            </li>
        <?php } ?>

        
        <li class="header" style="color:sandybrown; font-weight:bold; font-size:17px; text-decoration:underline">USER</li>

        <?php if($level=='admin'){ ?>
        <li class="<?= $this->uri->segment(1)=='data_user' ? 'active' : null ?>"><a href="<?php echo base_url().'data_user' ?>"><i class="fa fa-user"></i> Menejemen User</a></li>

        <li class="<?= $this->uri->segment(1)=='data_user_alternate' ? 'active' : null ?>"><a href="<?php echo base_url().'data_user_alternate' ?>"><i class="fa fa-user-secret"></i> User Alternate</a></li>
        <?php } ?>

        <li class="<?= $this->uri->segment(1)=='ganti_password' ? 'active' : null ?>"><a href="<?php echo base_url().'ganti_password' ?>"><i class="fa fa-key"></i> <span>Ganti Password</span></a></li>

        <li><a href="<?php echo base_url().'login/logout' ?>"><i class="fa fa-times" style="color: red"></i> <span>Logout</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


  <!-- Modal Pengajuan Biaya -->
  <form action="<?php echo base_url().'pengajuan_biaya' ?>" method="post">
  <div class="modal fade" id="modal-pengajuan">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Pengajuan Biaya</h4>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label for="">Pilih Jenis Biaya</label>
            <select id="jenis_biaya_pengajuan" name="jenis_biaya" class="form-control" required="">
              <option value="">- Pilih jenis -</option>
              <?php foreach($data_jb as $row) : ?>
              <option value="<?php echo $row['id_jb'] ?>">
                <?php echo $row['kode_jb'] ?> (<?php echo $row['jenis_biaya'] ?>)
              </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Pilih Sub Biaya</label>
            <select id="sub_biaya_pengajuan" name="sub_biaya" class="form-control" required="">
              <option></option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Lanjut Ke Form</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Pengajuan Biaya -->


  <!-- Header Leggen PIC -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/header_leggen_pic' ?>" method="post">
  <div class="modal fade" id="headerLeggenPIC">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Header Leggen Jurnal BMHD</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Pilih Tanggal</label>
            <input type="date" name="tanggal" class="form-control"></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Header Leggen PIC -->


  <!-- Detail Leggen PIC -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/detail_leggen_pic' ?>" method="post">
  <div class="modal fade" id="detailLeggenPIC">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Detail Leggen Jurnal BMHD</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Pilih Tanggal</label>
            <input type="date" name="tanggal" class="form-control"></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Detail Leggen PIC -->


  <!-- Header Leggen Finance -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/header_leggen_fin' ?>" method="post">
  <div class="modal fade" id="headerLeggenFIN">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Header Leggen Jurnal Payment</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Pilih Tanggal</label>
            <input type="date" name="tanggal" class="form-control"></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Header Leggen Finance -->


  <!-- Detail Leggen FINANCE -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/detail_leggen_fin' ?>" method="post">
  <div class="modal fade" id="detailLeggenFIN">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Detail Leggen Jurnal Payment</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Pilih Tanggal</label>
            <input type="date" name="tanggal" class="form-control"></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Detail Leggen FINANCE -->


  <!-- Header Leggen PIC Penyelesaian -->
  <form action="<?php echo base_url().'review_kekurangan_accounting/header_leggen_pic' ?>" method="post">
  <div class="modal fade" id="headerLeggenPICPenyelesaian">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Header Leggen Jurnal BMHD Penyelesaian</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Pilih Tanggal</label>
            <input type="date" name="tanggal" class="form-control"></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Header Leggen PIC Penyelesaian -->


  <!-- Detail Leggen PIC Penyelesaian -->
  <form action="<?php echo base_url().'review_kekurangan_accounting/detail_leggen_pic' ?>" method="post">
  <div class="modal fade" id="detailLeggenPICPenyelesaian">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Detail Leggen Jurnal BMHD Penyelesaian</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Pilih Tanggal</label>
            <input type="date" name="tanggal" class="form-control"></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Detail Leggen PIC Penyelesaian -->


  <!-- Header Leggen Finance Penyelesaian -->
  <form action="<?php echo base_url().'review_kekurangan_accounting/header_leggen_fin' ?>" method="post">
  <div class="modal fade" id="headerLeggenFINPenyelesaian">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Header Leggen Jurnal Payment Penyelesaian</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Pilih Tanggal</label>
            <input type="date" name="tanggal" class="form-control"></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Header Leggen Finance Penyelesaian -->

  <!-- Detail Leggen FINANCE Penyelesaian -->
  <form action="<?php echo base_url().'review_kekurangan_accounting/detail_leggen_fin' ?>" method="post">
  <div class="modal fade" id="detailLeggenFINPenyelesaian">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Detail Leggen Jurnal Payment Penyelesaian</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Pilih Tanggal</label>
            <input type="date" name="tanggal" class="form-control"></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Detail Leggen FINANCE Penyelesaian -->


  <!-- Modal Report 1 -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/report_1' ?>" method="post">
  <div class="modal fade" id="modal-report1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Report Konsolidasi Bulanan</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Dari Tanggal</label>
            <input type="date" name="tanggal_from" class="form-control" required></input>
          </div>

          <div class="form-group">
            <label for="">Ke Tanggal</label>
            <input type="date" name="tanggal_to" class="form-control" required></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Download</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Report 1 -->


  <!-- Modal Report 21 -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/report_2' ?>" method="post">
  <div class="modal fade" id="modal-report21">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Report By Cabang-Dept</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Cabang</label>
            <input type="text" name="cabang" class="form-control" value="HEAD OFFICE" readonly></input>
          </div>

          <div class="form-group">
            <label for="">Departemen/Bagian</label>
            <select name="departemen" class="form-control" required="Pilih Departemen">
              <option value="All">ALL DEPARTEMEN</option>
              <?php  
                $dept = $this->db->query("SELECT * FROM tbl_departemen WHERE nama_departemen != 'ADCO' AND nama_departemen != 'ADCOLL' AND nama_departemen != 'CMC' AND nama_departemen != 'ADD-CABANG' AND nama_departemen != 'ASSET-REC-CABANG' AND nama_departemen != 'BRANCH' AND nama_departemen != 'BANK RELATION' AND nama_departemen != 'DATA CENTER MANAGEMENT' AND nama_departemen != 'INFORMATION & TECHNOLOGY' AND nama_departemen != 'SEKRETARIS' ORDER BY nama_departemen")->result_array();
                foreach($dept as $row_dept){
              ?>
              <option value="<?php echo $row_dept['nama_departemen'] ?>"><?php echo $row_dept['nama_departemen'] ?></option>
              <?php } ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Download</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Report 21 -->


  <!-- Modal Report 22 -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/report_2' ?>" method="post">
  <div class="modal fade" id="modal-report22">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Report By Cabang-Dept</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Cabang</label>
             <select name="cabang" class="form-control" required="">
              <option value="">Pilih Cabang</option>

              <?php  
                $cbg = $this->db->query("SELECT * FROM tbl_cabang WHERE kode_cabang<100 AND nama_cabang!='HEAD OFFICE' ORDER BY nama_cabang")->result_array();
                foreach($cbg as $row_cbg){
              ?>
              <option value="<?php echo $row_cbg['nama_cabang'] ?>"><?php echo $row_cbg['nama_cabang'] ?></option>
              <?php } ?>

            </select>
          </div>

          <div class="form-group">
            <label for="">Departemen/Bagian</label>
            <select name="departemen" class="form-control" required="Pilih Departemen">
              <option value="All">ALL DEPARTEMEN</option>
              <option value="ADCO">ADCO</option>
              <option value="ADCOLL">ADCOLL</option>
              <option value="CMC">CMC</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Download</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Report 22 -->


  <!-- Modal Report 3 -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/report_3' ?>" method="post">
  <div class="modal fade" id="modal-report3">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Report Transaksi BMHD</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">COA</label>
             <select name="coa" class="form-control" required="Pilih COA">
             
              <option value="all">Semua COA</option>

              <?php  
                $q_coa = $this->db->query("SELECT DISTINCT coa, nama_coa FROM tbl_relasi_sub ORDER BY coa")->result_array();
                foreach($q_coa as $row_coa){
              ?>
              <option value="<?php echo $row_coa['coa'] ?>"><?php echo $row_coa['coa'] ?> <?php echo $row_coa['nama_coa'] ?></option>
              <?php } ?>

            </select>
          </div>

          <div class="form-group">
            <label for="">Dari Tanggal</label>
            <input type="date" name="tanggal_from" class="form-control" required></input>
          </div>

          <div class="form-group">
            <label for="">Ke Tanggal</label>
            <input type="date" name="tanggal_to" class="form-control" required></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Download</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Report 3 -->


  <!-- Modal Report 4 -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/report_4' ?>" method="post">
  <div class="modal fade" id="modal-report4">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Report Transaksi Payment</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Dari Tanggal (Payment)</label>
            <input type="date" name="tanggal_from" class="form-control" required></input>
          </div>

          <div class="form-group">
            <label for="">Ke Tanggal (Payment)</label>
            <input type="date" name="tanggal_to" class="form-control" required></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Download</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Report 4 -->


  <!-- Modal Report 5 -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/report_5' ?>" method="post">
  <div class="modal fade" id="modal-report5">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Report OS BMHD</h4>
        </div>
        <div class="modal-body">

          <!-- <div class="form-group">
            <label for="">COA</label>
             <select name="coa" class="form-control" required="Pilih COA">
              <option value="Pilih COA">Pilih COA</option>

              <?php  
                $q_coa = $this->db->query("SELECT DISTINCT coa, nama_coa FROM tbl_relasi_sub ORDER BY coa")->result_array();
                foreach($q_coa as $row_coa){
              ?>
              <option value="<?php echo $row_coa['coa'] ?>"><?php echo $row_coa['coa'] ?> <?php echo $row_coa['nama_coa'] ?></option>
              <?php } ?>

            </select>
          </div> -->

          <div class="form-group">
            <label for="">Tanggal Cut Off</label>
            <input type="date" name="tanggal" class="form-control" required></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Download</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Report 5 -->


  <!-- Modal Cetak Jurnal BMHD -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/cetak_jurnal_bmhd' ?>" method="post">
  <div class="modal fade" id="cetak-jurnal-bmhd">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cetak Jurnal BMHD</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Tanggal Proses (BMHD)</label>
            <input type="date" name="tanggal" class="form-control" required></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Cetak</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Cetak Jurnal BMHD -->


  <!-- Modal Cetak Jurnal Payment -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/cetak_jurnal_payment' ?>" method="post">
  <div class="modal fade" id="cetak-jurnal-payment">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cetak Jurnal Payment</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Tanggal Proses (Payment)</label>
            <input type="date" name="tanggal" class="form-control" required></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Cetak</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Cetak Jurnal Payment -->


  <!-- Modal Cetak Detail BMHD -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/cetak_detail_bmhd' ?>" method="post">
  <div class="modal fade" id="cetak-detail-bmhd">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cetak Detail BMHD</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Tanggal Proses (BMHD)</label>
            <input type="date" name="tanggal" class="form-control" required></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Cetak</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Cetak Detail BMHD -->


  <!-- Modal Cetak Detail Payment -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/cetak_detail_payment' ?>" method="post">
  <div class="modal fade" id="cetak-detail-payment">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cetak Detail Payment</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Tanggal Proses (Payment)</label>
            <input type="date" name="tanggal" class="form-control" required></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Cetak</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Cetak Detail Payment -->


  <!-- Modal Report Direksi (Rekap) -->
  <form action="<?php echo base_url().'report_direksi/report_rekap' ?>" method="post">
  <div class="modal fade" id="modal_dir1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Report Pengajuan Biaya (Rekap)</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Departemen/Bagian</label>
            <select name="departemen" class="form-control" required="">
              <option value="">- Pilih Departemen -</option>
              <?php  
                $dept = $this->db->query("SELECT * FROM tbl_departemen WHERE nama_departemen != 'ADCO' AND nama_departemen != 'ADCOLL' AND nama_departemen != 'CMC' AND nama_departemen != 'ADD-CABANG' AND nama_departemen != 'ASSET-REC-CABANG' AND nama_departemen != 'BRANCH' AND nama_departemen != 'BANK RELATION' AND nama_departemen != 'DATA CENTER MANAGEMENT' AND nama_departemen != 'INFORMATION & TEHCNOLOGY' AND nama_departemen != 'SEKRETARIS' ORDER BY nama_departemen")->result_array();
                foreach($dept as $row_dept){
              ?>
              <option value="<?php echo $row_dept['nama_departemen'] ?>"><?php echo $row_dept['nama_departemen'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Dari Tanggal</label>
            <input type="date" name="tanggal_from" class="form-control" required></input>
          </div>

          <div class="form-group">
            <label for="">Ke Tanggal</label>
            <input type="date" name="tanggal_to" class="form-control" required></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Download</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Report Direksi (Rekap) -->


  <!-- Modal Report Direksi (Rincian) -->
  <form action="<?php echo base_url().'report_direksi/report_rinci' ?>" method="post">
  <div class="modal fade" id="modal_dir2">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Report Pengajuan Biaya (Rincian)</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="">Departemen/Bagian</label>
            <select name="departemen" class="form-control" required="" id="pilih_departemen">
              <option value="">- Pilih Departemen -</option>
              <option value="all">ALL DEPARTEMEN</option>
              <?php  
                $dept = $this->db->query("SELECT * FROM tbl_departemen WHERE nama_departemen != 'ADCO' AND nama_departemen != 'ADCOLL' AND nama_departemen != 'CMC' AND nama_departemen != 'ADD-CABANG' AND nama_departemen != 'ASSET-REC-CABANG' AND nama_departemen != 'BRANCH' AND nama_departemen != 'BANK RELATION' AND nama_departemen != 'DATA CENTER MANAGEMENT' AND nama_departemen != 'INFORMATION & TEHCNOLOGY' AND nama_departemen != 'SEKRETARIS' ORDER BY nama_departemen")->result_array();
                foreach($dept as $row_dept){
              ?>
                <option value="<?php echo $row_dept['nama_departemen'] ?>"><?php echo $row_dept['nama_departemen'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Final Approved By</label>
            <select id="pilih_approved_by" name="final_approved_by" class="form-control" required="">
              <option value="">- Pilih Final Approved -</option>
              <option value="all">ALL</option>
              
              <?php  
                $final_approved = $this->db->query("SELECT DISTINCT nama_lengkap, level FROM tbl_user WHERE (level='President Director' OR level='Director' OR level='Department HEAD') AND (nama_lengkap != 'MUHAMMAD RIDWAN' AND nama_lengkap != 'ADI YUDIANTO' AND nama_lengkap != 'REGINA')")->result_array();
                foreach($final_approved as $row_finap){
              ?>
                <option value="<?php echo $row_finap['nama_lengkap'] ?>">
                  <?php echo $row_finap['nama_lengkap'].' ('.$row_finap['level'].')' ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Dari Tanggal</label>
            <input type="date" name="tanggal_from" class="form-control" required></input>
          </div>

          <div class="form-group">
            <label for="">Ke Tanggal</label>
            <input type="date" name="tanggal_to" class="form-control" required></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Download</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Report Direksi (Rincian) -->


  <!-- Script Pilihan Biaya -->
  <script>
    
  $(function(){

    $.ajaxSetup({
      type : 'POST',
      url : '<?php echo base_url().'pengajuan_biaya/ambil_data' ?>',
      cache : false
    });

    $("#jenis_biaya_pengajuan").change(function(){
      var value=$(this).val();
      if(value>0){
        $.ajax({
          data:{modul:'sub_biaya',id:value},
          success: function(respond){
            $("#sub_biaya_pengajuan").html(respond);
          }
        })
      }
    });

  });

  </script>
  <!-- / Script Pilihan Biaya -->


  <!-- Script Pilihan Final Approved By -->
  <!-- <script>
    
  $(function(){

    $.ajaxSetup({
      type : 'POST',
      url : '<?php echo base_url().'report_direksi/ambil_data' ?>',
      cache : false
    });

    $("#pilih_departemen").change(function(){
      var value=$(this).val();
      if(value>0){
        $.ajax({
          data:{modul:'nama_approved',id:value},
          success: function(respond){
            $("#pilih_approved_by").html(respond);
          }
        })
      }
    });

  });

  </script> -->
  <!-- / Script Pilihan Final Approved By -->