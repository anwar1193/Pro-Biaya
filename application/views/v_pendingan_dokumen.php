  <?php  

    date_default_timezone_set("Asia/Jakarta");
    $nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
    $cabang = $this->libraryku->tampil_user()->cabang;
    $departemen = $this->libraryku->tampil_user()->departemen;
    $level = $this->libraryku->tampil_user()->level;

    $tgl_sekarang = date("Y-m-d");
    $yy_now = substr($tgl_sekarang, 0, 4);
    $mm_now = substr($tgl_sekarang, 5, 2);
    $dd_now = substr($tgl_sekarang, 8, 2);

  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Ambil Data Flashdata untuk kata sweet alert -->
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

    <section class="content-header">
      <h1>
        Data Pendingan Dokumen
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pending Dokumen</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pendingan Dokumen</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr style="text-align:center">
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>NO Pengajuan</th>
                  <th>No Invoice</th>
                  <th>Cabang</th>
                  <th>Dept</th>
                  <th>Jenis Biaya</th>
                  <th>Sub Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th style="text-align: center;" width="10%">Status Check</th>
                  <th style="text-align: center;" width="10%">Status Dokumen</th>
                  <th style="text-align: center;" width="10%">Status Penyelesaian</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_pendok as $row_pendok){
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_pendok['tanggal'])) ?></td>
                  <td><?php echo $row_pendok['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_pendok['nomor_invoice'] ?></td>
                  <td><?php echo $row_pendok['cabang'] ?></td>
                  <td><?php echo $row_pendok['bagian'] ?></td>
                  <td><?php echo $row_pendok['jenis_biaya'] ?></td>
                  <td><?php echo $row_pendok['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_pendok['jumlah'] + $row_pendok['ppn'] - $row_pendok['pph23'] - $row_pendok['pph42'] - $row_pendok['pph21'],0,',','.') ?></td>
                  
                  <!-- td status check -->
                  <?php if($row_pendok['status_check'] == ''){ ?>
                    <td style="color: blue; font-weight: bold">
                      : On Proccess :
                    </td>
                  <?php }else if($row_pendok['status_check'] == 'Checked'){ ?>
                    <td style="color: green; font-weight: bold">
                      <?php echo '- '.$row_pendok['status_check'].' by '.$row_pendok['checked_by'].' -'; ?>
                    </td>
                  <?php }else if($row_pendok['status_check'] == 'Pending'){ ?>
                    <td style="color: orange; font-weight: bold">
                      <?php echo '- '.$row_pendok['status_check'].' by '.$row_pendok['checked_by'].' -'; ?>
                    </td>
                  <?php } ?>

                  <!-- <?php if($row_pendok['status_dokumen']==''){ ?>
                    <td style="color: orange; font-weight: bold" width="10%">
                      Pending
                    </td>
                  <?php }elseif($row_pendok['status_dokumen']=='done'){ ?>
                    <td style="color: green; font-weight: bold" width="10%">Done</td>
                  <?php } ?> -->

                  <!-- Kolom Status Dokumen -->

                  <?php if($row_pendok['status_dokumen']==''){ ?>
                    <td style="color: orange; font-weight: bold" width="12%">
                      Pending <br>
                      <!-- Cari Due Date -->
                      <?php
                        date_default_timezone_set("Asia/Jakarta");
                        $tanggal_bayar = $row_pendok['tanggal_bayar'];
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
                          Sisa Waktu Penyerahan : <?php echo $sisa_waktu; ?> Hari
                          </span>
                        <?php } ?>

                      <?php } ?>


                    </td>
                  <?php }elseif($row_pendok['status_dokumen']=='done'){ ?>

                    <td style="color: green; font-weight: bold" width="10%">
                      Diterima Oleh <?php echo $row_pendok['dept_tujuan'] ?>
                    </td>

                  <?php }elseif($row_pendok['status_dokumen']=='done acc'){ ?>

                    <td style="color: blue; font-weight: bold" width="10%">
                      Diterima Oleh Accounting <br>
                    </td>

                  <?php } ?>
                  <!-- / Kolom Status Dokumen -->

                  <!-- Kolom Status Penyelesaian -->
                  <td style="text-align: center;">
                    <?php if($row_pendok['status_dokumen'] == 'done acc'){ ?>
                      <span style="color:green; font-weight:bold">Selesai</span>

                    <?php }else{ ?>

                      <?php if(strtoupper(trim($row_pendok['nomor_invoice'])) == 'ESTIMASI' AND $row_pendok['jenis_penyelesaian_pengaju'] != '' AND $row_pendok['jenis_penyelesaian'] == ''){ ?>
                        <span style="color:blue; font-weight:bold">Telah Diajukan</span>

                      <?php }elseif(strtoupper(trim($row_pendok['nomor_invoice'])) == 'ESTIMASI' AND $row_pendok['jenis_penyelesaian_pengaju'] != '' AND $row_pendok['jenis_penyelesaian'] != '' OR $row_pendok['jenis_penyelesaian_pengaju'] == '' AND $row_pendok['jenis_penyelesaian'] != ''){ ?>
                        <span style="color:green; font-weight:bold">On Proccess</span>

                      <?php }elseif(strtoupper(trim($row_pendok['nomor_invoice'])) == 'ESTIMASI' AND $row_pendok['jenis_penyelesaian_pengaju'] == '' AND $row_pendok['jenis_penyelesaian'] == '' AND $row_pendok['status_bayar']=='Telah Dibayar'){ ?>
                        <span style="color:orange; font-weight:bold">Belum Diselesaikan :</span><br>
                        <?php  
                          $waktu_bayar = mktime(0,0,0,$bln_bayar,$tgl_bayar,$thn_bayar);
                          $waktu_sekarang = mktime(0,0,0,$mm_now,$dd_now,$yy_now);
                          $selisih0 = $waktu_sekarang-$waktu_bayar;
	                        $selisih = $selisih0 / (60*60*24);
                        ?>
                        <span style="font-weight:bold"><?php echo $selisih ?> Hari</span>

                      <?php }else{ ?>
                        <span>-</span>
                      <?php } ?>

                    <?php } ?>

                  </td>
                  <!-- / Kolom Status Penyelesaian -->
                  
                  <!-- td action -->
                  <td style="text-align: center;">

                    <!-- <a href="<?php echo base_url().'p_approved/hapus/'.$row_pendok['id_pengajuan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-trash"></i> Hapus
                    </a> -->

                    <a href="<?php echo base_url().'pendingan_dokumen/detail/'.$row_pendok['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
                      <i class="fa fa-refresh"></i> Proses Dokumen
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