  <?php  

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
        Inquiry Review Pengajuan
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pengajuan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Inquiry Pengajuan</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>NO Pengajuan</th>
                  <th>Cabang</th>
                  <th>Dept</th>
                  <th>Jenis Biaya</th>
                  <th>Sub Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th style="text-align: center;" width="10%">Sts Approve</th>
                  <th style="text-align: center;" width="15%">Next Approve</th>
                  <th style="text-align: center;" width="10%">Sts Check</th>
                  <th style="text-align: center;" width="10%">Sts Bayar</th>
                  <th style="text-align: center;" width="10%">Sts Dokumen</th>
                  <th style="text-align: center" width="8%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_history as $row_history){
                    // Yang tampil di view, field departemen update
                    $bagian = $row_history['bagian'];
                    $data_departemen = $this->M_master->tampil_data_where('tbl_departemen', array('nama_departemen' => $bagian))->row_array();
                    $nama_departemen_update = $data_departemen['nama_departemen_update'];
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_history['tanggal'])) ?></td>
                  <td><?php echo $row_history['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_history['cabang'] ?></td>
                  <td><?php echo $nama_departemen_update ?></td>
                  <td><?php echo $row_history['jenis_biaya'] ?></td>
                  <td><?php echo $row_history['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_history['jumlah'] + $row_history['ppn'] - $row_history['pph23'] - $row_history['pph42'] - $row_history['pph21'],0,',','.') ?></td>
                  

                  <!-- Kolom Status Approve -->
                  <?php if($row_history['status_approve'] == 'on proccess'){ ?>

                    <td style="color: blue; font-weight: bold"><?php echo $row_history['status_approve'] ?></td>

                  <?php }else if($row_history['status_approve'] == 'approved'){ ?>

                    <td style="color: green; font-weight: bold">
                      <?php echo '- '.$row_history['status_approve'].' by '.$row_history['approved_by'].' -'.'<br>'.$row_history['nama_pengapprove'] ?>
                    </td>

                  <?php }else if($row_history['status_approve'] == 'final approved'){ ?>

                    <td style="color: green; font-weight: bold">
                      <?php echo '- '.$row_history['status_approve'].' by '.$row_history['approved_by'].' -'.'<br>'.$row_history['nama_pengapprove'] ?>
                    </td>

                  <?php }else if($row_history['status_approve'] == 'cancel' || $row_history['status_approve'] == 'cancel by request'){ ?>

                    <td style="color: red; font-weight: bold">
                      <?php echo $row_history['status_approve'] ?>
                    </td>

                  <?php }else if($row_history['status_approve'] == 'rejected'){ ?>

                    <td style="color: red; font-weight: bold">
                      <?php echo '- '.$row_history['status_approve'].' by '.$row_history['approved_by'].' -'.'<br>'.$row_history['nama_pengapprove'] ?>
                    </td>

                  <?php }else if($row_history['status_approve'] == 'revisi'){ ?>

                    <td style="color: orange; font-weight: bold">
                      <?php echo '- '.$row_history['status_approve'].' by '.$row_history['approved_by'].' -'.'<br>'.$row_history['nama_pengapprove'] ?>
                    </td>

                  <?php } ?>
                  <!-- / Kolom Status Approve -->


                  <!-- Kolom Next Approve -->
                  <?php if($row_history['status_approve'] == 'final approved' || $row_history['status_approve'] == 'rejected' || $row_history['status_approve'] == 'cancel' || $row_history['status_approve'] == 'cancel by request'){ ?>
                    <td style="font-weight: bold; text-align: center; color: orange">-</td>
                  <?php }else{ ?>

                    <td style="font-weight: bold; text-align: center; color: orange">
                      <?php  

                        $level_pengaju = $row_history['level_pengaju'];
                        $cabang_pengaju = $row_history['cabang'];
                        $status_approve = $row_history['status_approve'];
                        $approved_by = $row_history['approved_by'];
                        $wilayah = $row_history['wilayah'];
                        $dept_tujuan = $row_history['dept_tujuan'];
                        $direktur_tujuan = $row_history['direktur_tujuan'];
                        $direktur_asal = $row_history['direktur_asal'];
                        $kadiv_tujuan = $row_history['kadiv_tujuan'];
                        $kadiv_asal = $row_history['kadiv_asal'];

                        if($level_pengaju == 'ADCO' AND $status_approve=='on proccess' OR $level_pengaju=='ADCOLL' AND $status_approve=='on proccess' OR $level_pengaju=='CMC' AND $status_approve=='on proccess' OR $level_pengaju=='ADD-CABANG' AND $status_approve=='on proccess'){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$cabang_pengaju' AND level='Branch Manager'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'Kacab';

                        }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='kacab' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='kacab' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='kacab' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='kacab'){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$wilayah' AND level='Area Manager'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'Kawil';

                        }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='kawil' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='kawil' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='kawil'OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='kawil'){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'PIC Dept Head';

                        }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!='' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!='' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!='' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!=''){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$kadiv_tujuan' AND level='Division Head'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'Division Head';

                        }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan==''){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'Director';

                        }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='division head' AND $kadiv_tujuan!='' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='division head' AND $kadiv_tujuan!='' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='division head' AND $kadiv_tujuan!='' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='division head' AND $kadiv_tujuan!=''){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_asal' AND level='Director'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'Director';

                        }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='director pengaju' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='director pengaju' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='director pengaju' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='director pengaju'){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'Director';
                        }

                        elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='director' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='director' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='director' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='director'){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='Director Finance'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'Director Finance';
                        }

                        elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='director finance' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='director finance' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='director finance' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='director finance'){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='President Director'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'President Director';
                        }

                        elseif($level_pengaju == 'Departement PIC' AND $status_approve=='on proccess'){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$departemen' AND level='Department Head'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'Dept. Head';

                        }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head' AND $kadiv_tujuan!=''){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$kadiv_tujuan' AND level='Division Head'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'Division Head';

                        }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head' AND $kadiv_asal!=''){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$kadiv_asal' AND level='Division Head'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'Division Head';

                        }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head' AND $kadiv_tujuan==''){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'PIC Dept Head';

                        }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='division head'){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'PIC Dept Head';

                        }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head pic'){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'Director';

                        }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='director'){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='Director Finance'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'Director Finance';
                        

                        }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='director finance'){
                          $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='President Director'")->row_array();
                          $nama_next = $q_next['nama_lengkap'];
                          $level_next = 'President Director';
                        }

                        // Tampilkan next approve (tidak udah di ubah2 cukup query diatas saja)
                        echo '- '.$level_next.' -<br>';
                        echo $nama_next;

                      ?>
                    </td>
                  <?php } ?>
                  <!-- / Kolom Next Approve -->


                  <!-- Kolom Status Check -->
                  <?php if($row_history['status_approve'] != 'final approved'){ ?>

                    <td style="font-weight: bold">
                      -
                    </td>

                  <?php }else{ ?>

                    <?php if($row_history['status_check'] == ''){ ?>
                      <td style="color: blue; font-weight: bold">
                        On Proccess
                      </td>
                    <?php }else if($row_history['status_check'] == 'Checked'){ ?>
                      <td style="color: green; font-weight: bold">
                        <?php echo '- '.$row_history['status_check'].' by '.$row_history['checked_by'].' -'; ?>
                      </td>
                    <?php }else if($row_history['status_check'] == 'Pending'){ ?>
                      <td style="color: orange; font-weight: bold">
                        <?php echo '- '.$row_history['status_check'].' by '.$row_history['checked_by'].' -'; ?>
                      </td>
                    <?php } ?>

                  <?php } ?>
                  <!-- / Kolom Status Check -->

                  <!-- Kolom Status Bayar -->
                  <?php if($row_history['status_check'] == 'Checked'){ ?>

                    <?php if($row_history['status_bayar'] == 'Telah Dibayar' || $row_history['status_bayar'] == 'Proses Bayar'){ ?>
                      <td style="color: green; font-weight: bold">
                        <?php echo $row_history['status_bayar'] ?>
                      </td>
                    <?php }else{ ?>
                      <td style="color: blue; font-weight: bold">
                        Proses Check
                      </td>
                    <?php } ?>

                  <?php }else{ ?>
                    <td style="color: blue; font-weight: bold">
                      -
                    </td>
                  <?php } ?>
                  <!-- / Kolom Status Bayar -->

                  <!-- <?php if($row_history['status_dokumen']==''){ ?>
                    <td style="color: orange; font-weight: bold" width="10%">
                      Pending
                    </td>
                  <?php }elseif($row_history['status_dokumen']=='done'){ ?>
                    <td style="color: green; font-weight: bold" width="10%">Done</td>
                  <?php } ?> -->

                  <!-- Kolom Status Dokumen -->

                  <?php if($row_history['status_dokumen']==''){ ?>
                    <td style="color: orange; font-weight: bold" width="12%">
                      Pending <br>
                      <!-- Cari Due Date -->
                      <?php
                        date_default_timezone_set("Asia/Jakarta");
                        $tanggal_bayar = $row_history['tanggal_bayar'];
                        $tgl_bayar = substr($tanggal_bayar, 8,2);
                        $bln_bayar = substr($tanggal_bayar, 5,2);
                        $thn_bayar = substr($tanggal_bayar, 0,4);

                        $tambah_14 = mktime(0,0,0,date($bln_bayar),date($tgl_bayar)+14, date($thn_bayar));
                        $batas_penyerahan0 = date("Y-m-d", $tambah_14);

                        $batas_penyerahan = strtotime($batas_penyerahan0);
                        $tanggal_sekarang = time();

                        $sisa_waktu0 = $batas_penyerahan - $tanggal_sekarang;
                        $sisa_waktu = floor($sisa_waktu0 / (60 * 60 * 24) + 1);
                      ?>

                      <?php if($tanggal_bayar != "0000-00-00"){ ?>

                        <?php if($sisa_waktu < 0){ ?>
                          <span style="color: red">
                          Terlambat : <?php echo $sisa_waktu*(-1).' Hari'; ?>
                          </span>

                        <?php }else{ ?>
                          <span style="color: black">
                          Batas Waktu Penyerahan : <?php echo $sisa_waktu; ?> Hari Lagi
                          </span>
                        <?php } ?>

                      <?php } ?>


                    </td>
                  <?php }elseif($row_history['status_dokumen']=='done'){ ?>

                    <td style="color: green; font-weight: bold" width="10%">
                      Diterima Oleh <?php echo $row_history['dept_tujuan'] ?>
                    </td>

                  <?php }elseif($row_history['status_dokumen']=='done acc'){ ?>

                    <td style="color: blue; font-weight: bold" width="10%">
                      Diterima Oleh Accounting <br>
                    </td>

                  <?php } ?>
                  <!-- / Kolom Status Dokumen -->
                  
                  <!-- td action -->
                  <td style="text-align: center;">

                    <!-- <a href="<?php echo base_url().'p_approved/hapus/'.$row_history['id_pengajuan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-trash"></i> Hapus
                    </a> -->

                    <a href="<?php echo base_url().'history_pengajuan/detail/'.$row_history['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
                      <i class="fa fa-eye"></i> Detail
                    </a>

                  </td>
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