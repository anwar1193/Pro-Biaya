  <?php date_default_timezone_set("Asia/Jakarta"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Ambil Data Flashdata untuk kata sweet alert -->
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

    <section class="content-header">
      <h1>
        Data Counter Pengajuan
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Counter Pengajuan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Counter Pengajuan ( <?php echo $sub_biaya1 ?> - <?php echo $cabang1 ?> - <?php echo $bagian1 ?> ) Bulan Ini</h3>

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
                  <th width="20%" style="text-align: center">Sts Approve</th>
                  <th width="20%" style="text-align: center">Next Approve</th>
                  <th style="text-align: center">Sts Check</th>
                  <th style="text-align: center">Sts Bayar</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_pengajuan as $row_pengajuan){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_pengajuan['tanggal'])) ?></td>
                  <td><?php echo $row_pengajuan['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_pengajuan['cabang'] ?></td>
                  <td><?php echo $row_pengajuan['bagian'] ?></td>
                  <td><?php echo $row_pengajuan['jenis_biaya'] ?></td>
                  <td><?php echo $row_pengajuan['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_pengajuan['jumlah'] + $row_pengajuan['ppn'] - $row_pengajuan['pph23'] - $row_pengajuan['pph42'] - $row_pengajuan['pph21'],0,',','.') ?></td>

                  <!-- Kolom Status Approve -->
                  <?php if($row_pengajuan['status_approve'] == 'on proccess'){ ?>

                    <td style="color: blue; font-weight: bold; text-align:center"><?php echo $row_pengajuan['status_approve'] ?></td>

                    <?php }else if($row_pengajuan['status_approve'] == 'approved'){ ?>

                      <td style="color: green; font-weight: bold; text-align:center">
                        <?php echo '- '.$row_pengajuan['status_approve'].' by '.$row_pengajuan['approved_by'].' -'.'<br>'.$row_pengajuan['nama_pengapprove'] ?>
                      </td>

                    <?php }else if($row_pengajuan['status_approve'] == 'final approved'){ ?>

                      <td style="color: green; font-weight: bold; text-align:center">
                        <?php echo '- '.$row_pengajuan['status_approve'].' by '.$row_pengajuan['approved_by'].' -'.'<br>'.$row_pengajuan['nama_pengapprove'] ?>
                      </td>

                    <?php }else if($row_pengajuan['status_approve'] == 'cancel' || $row_pengajuan['status_approve'] == 'cancel by request'){ ?>

                      <td style="color: red; font-weight: bold; text-align:center">
                        <?php echo $row_pengajuan['status_approve'] ?>
                      </td>

                    <?php }else if($row_pengajuan['status_approve'] == 'rejected'){ ?>

                      <td style="color: red; font-weight: bold; text-align:center">
                        <?php echo '- '.$row_pengajuan['status_approve'].' by '.$row_pengajuan['approved_by'].' -'.'<br>'.$row_pengajuan['nama_pengapprove'] ?>
                      </td>

                    <?php }else if($row_pengajuan['status_approve'] == 'revisi'){ ?>

                      <td style="color: orange; font-weight: bold; text-align:center">
                        <?php echo '- '.$row_pengajuan['status_approve'].' by '.$row_pengajuan['approved_by'].' -'.'<br>'.$row_pengajuan['nama_pengapprove'] ?>
                      </td>

                    <?php } ?>
                    <!-- / Kolom Status Approve -->


                    <!-- Kolom Next Approve -->
                    <?php if($row_pengajuan['status_approve'] == 'final approved' || $row_pengajuan['status_approve'] == 'rejected'){ ?>
                      <td style="font-weight: bold; text-align: center; color: orange">-</td>
                    <?php }else{ ?>

                      <td style="font-weight: bold; text-align: center; color: orange">
                        <?php  

                          $cabang = $row_pengajuan['cabang'];
                          $departemen = $row_pengajuan['bagian'];
                          $level_pengaju = $row_pengajuan['level_pengaju'];
                          $status_approve = $row_pengajuan['status_approve'];
                          $approved_by = $row_pengajuan['approved_by'];
                          $wilayah = $row_pengajuan['wilayah'];
                          $dept_tujuan = $row_pengajuan['dept_tujuan'];
                          $direktur_tujuan = $row_pengajuan['direktur_tujuan'];
                          $direktur_asal = $row_pengajuan['direktur_asal'];
                          $kadiv_tujuan = $row_pengajuan['kadiv_tujuan'];
                          $kadiv_asal = $row_pengajuan['kadiv_asal'];
                          $jalur_khusus = $row_pengajuan['jalur_khusus'];

                          if($level_pengaju == 'ADCO' AND $status_approve=='on proccess' OR $level_pengaju=='ADCOLL' AND $status_approve=='on proccess' OR $level_pengaju=='CMC' AND $status_approve=='on proccess' OR $level_pengaju=='ADD-CABANG' AND $status_approve=='on proccess'){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$cabang' AND level='Branch Manager'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'Kacab';

                          }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='kacab' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='kacab' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='kacab' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='kacab'){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$wilayah' AND level='Area Manager'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'Kawil';

                          }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus=='' OR 
                          $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus=='' OR 
                          $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus=='' OR 
                          $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus==''){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'PIC Dept Head';
    
                          }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus != '' OR 
                          $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus != '' OR 
                          $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus != '' OR 
                          $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus != ''){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head' AND jabatan_khusus='$jalur_khusus'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'PIC Dept Head';

                          }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!='' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!='' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!='' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!=''){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$kadiv_tujuan' AND level='Division Head'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'Division Head';

                          }elseif(
                            $level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal=='' OR 
                            $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal=='' OR 
                            $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal=='' OR 
                            $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal==''){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'Director';

                          }elseif(
                            $level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal!='' OR 
                            $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal!='' OR 
                            $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal!='' OR 
                            $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal!=''){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_asal' AND level='Director'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'Director';

                          }elseif(
                            $level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal!='' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal!='' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal!='' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal!=''){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_asal' AND level='Director'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'Director';

                          }elseif(
                            $level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal=='' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal=='' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal=='' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal==''){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'Director';

                          }elseif(
                            $level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='director pengaju' OR 
                            $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='director pengaju' OR 
                            $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='director pengaju' OR 
                            $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='director pengaju'){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'Director';
                          }

                          elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='director' OR 
                          $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='director' OR 
                          $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='director' OR 
                          $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='director'){
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

                          }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $direktur_asal!=''){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_asal' AND level='Director'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'Director';

                          }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $direktur_asal==''){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'Director';
                          
                          }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='director_pengaju'){
                            $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                            $nama_next = $q_next['nama_lengkap'];
                            $level_next = 'Director Finance';

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
                    <?php if($row_pengajuan['status_approve'] != 'final approved'){ ?>

                        <td style="font-weight: bold; text-align:center">
                          -
                        </td>

                    <?php }else{ ?>

                      <?php if($row_pengajuan['status_check'] == ''){ ?>
                        <td style="color: blue; font-weight: bold; text-align:center">
                          On Proccess
                        </td>
                      <?php }else if($row_pengajuan['status_check'] == 'Checked'){ ?>
                        <td style="color: green; font-weight: bold; text-align:center">
                          <?php echo '- '.$row_pengajuan['status_check'].' by '.$row_pengajuan['checked_by'].' -'; ?>
                        </td>
                      <?php }else if($row_pengajuan['status_check'] == 'Pending'){ ?>
                        <td style="color: orange; font-weight: bold; text-align:center">
                          <?php echo '- '.$row_pengajuan['status_check'].' by '.$row_pengajuan['checked_by'].' -'; ?>
                        </td>
                      <?php } ?>

                    <?php } ?>
                    <!-- / Kolom Status Check -->


                    <!-- Kolom Status Bayar -->
                    <?php if($row_pengajuan['status_check'] == 'Checked'){ ?>

                      <?php if($row_pengajuan['status_bayar'] == 'Telah Dibayar' || $row_pengajuan['status_bayar'] == 'Proses Bayar'){ ?>
                        <td style="color: green; font-weight: bold; text-align:center">
                          <?php echo $row_pengajuan['status_bayar'] ?>
                        </td>
                      <?php }else{ ?>
                        <td style="color: blue; font-weight: bold; text-align:center">
                          Proses Check
                        </td>
                      <?php } ?>

                    <?php }else{ ?>
                      <td style="color: blue; font-weight: bold; text-align:center">
                        -
                      </td>
                    <?php } ?>
                    <!-- / Kolom Status Bayar -->

                    <td style="text-align:center">
                      <a href="<?php echo base_url().'inbox/detail_list_counter/'.$row_pengajuan['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
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