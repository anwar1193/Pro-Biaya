  <?php  

    error_reporting(0);
    $nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
    $cabang = $this->libraryku->tampil_user()->cabang;
    $departemen = $this->libraryku->tampil_user()->departemen;
    $level = $this->libraryku->tampil_user()->level;

  ?>
  <?php date_default_timezone_set("Asia/Jakarta"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Whatsapp/Email Blast
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Whatsapp Blast</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Kirim Notifikasi Via Whatsapp/ Email</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <form method="post" action="<?php echo base_url().'wa_blast/kirim_wa' ?>" style="float: left;">
                <span>
                  <button type="submit" class="btn btn-success btn-xs">
                    <i class="fa fa-whatsapp"></i> Kirim Notifikasi Whatsapp
                  </button>
                </span>
              </form>

              <form method="post" action="<?php echo base_url().'wa_blast/kirim_email' ?>" style="margin-left: 10px">
                <span>
                  <button type="submit" class="btn btn-warning btn-xs">
                    <i class="fa fa-envelope"></i> Kirim Notifikasi Email
                  </button>
                </span>
              </form>

              <br>
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal Pengajuan</th>
                  <th>NO Pengajuan</th>
                  <th>Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th style="text-align: center" width="18%">Next Approve</th>
                  <th>Nomor WA</th>
                  <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_wa as $row_wa){
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_wa['tanggal'])) ?></td>
                  <td><?php echo $row_wa['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_wa['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_wa['total'],0,',','.') ?></td>

                  <!-- Kolom Next Approve -->
                  <td style="font-weight: bold; text-align: center; color: orange">
                    <?php  

                      $level_pengaju = $row_wa['level_pengaju'];
                      $status_approve = $row_wa['status_approve'];
                      $approved_by = $row_wa['approved_by'];
                      $wilayah = $row_wa['wilayah'];
                      $dept_tujuan = $row_wa['dept_tujuan'];
                      $direktur_tujuan = $row_wa['direktur_tujuan'];
                      $cab = $row_wa['cabang'];
                      $wil = $row_wa['wilayah'];
                      $deptm = $row_wa['bagian'];

                      if($level_pengaju == 'ADCO' AND $status_approve=='on proccess' OR $level_pengaju == 'ADCOLL' AND $status_approve=='on proccess'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$cab' AND level='Branch Manager'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Kacab';
                        $nomor_wa = $q_next['nomor_wa'];
                        $email = $q_next['email'];

                      }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='kacab' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='kacab'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$wil' AND level='Area Manager'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Kawil';
                        $nomor_wa = $q_next['nomor_wa'];
                        $email = $q_next['email'];

                      }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='kawil' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='kawil'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'PIC Dept Head';
                        $nomor_wa = $q_next['nomor_wa'];
                        $email = $q_next['email'];

                      }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='dept head pic' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='dept head pic'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';
                        $nomor_wa = $q_next['nomor_wa'];
                        $email = $q_next['email'];

                      }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='director' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='director'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='President Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'President Director';
                        $nomor_wa = $q_next['nomor_wa'];
                        $email = $q_next['email'];
                      }

                      elseif($level_pengaju == 'Departement PIC' AND $status_approve=='on proccess'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$deptm' AND level='Department Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Dept Head';
                        $nomor_wa = $q_next['nomor_wa'];
                        $email = $q_next['email'];

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'PIC Dept Head';
                        $nomor_wa = $q_next['nomor_wa'];
                        $email = $q_next['email'];

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head pic'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';
                        $nomor_wa = $q_next['nomor_wa'];
                        $email = $q_next['email'];

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='director'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='President Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'President Director';
                        $nomor_wa = $q_next['nomor_wa'];
                        $email = $q_next['email'];

                      }

                      // Tampilkan next approve (tidak udah di ubah2 cukup query diatas saja)
                      echo '- '.$level_next.' -<br>';
                      echo $nama_next;

                    ?>
                  </td>
                  <!-- / Kolom Next Approve -->

                  <!-- Nomor Whatsapp -->
                  <td><?php echo $nomor_wa; ?></td>

                  <!-- Email -->
                  <td><?php echo $email; ?></td>

                </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->