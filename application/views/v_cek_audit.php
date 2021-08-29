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
        Data Pengajuan Disetujui (Approved)
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
              <h3 class="box-title">Pengajuan (Approved)</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
  
              <!-- Filter By : 

              <button class="btn btn-info btn-sm" id="tombol1">Cabang</button> -->

              <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-dokpen">
                <i class="fa fa-print"></i> Cetak Dokumen Pending
              </a>

              <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-dokter">
                <i class="fa fa-print"></i> Cetak Dokumen Terlambat
              </a>

              <!-- Filter by Tanggal Pengajuan -->
              <div id="by_cabang"><br>
              <form method="POST" action="<?php echo base_url().'Cek_audit' ?>">
                <table>
                  <tr>
                    <td>(Filter Pengajuan) - &nbsp;</td>

                    <td>Cabang :</td>
                    <td>
                      <select name="cabang" required="">
                        <option value="">- Pilih Cabang -</option>
                        <option value="all">ALL CABANG</option>
                        <?php foreach($data_cabang as $row){ ?>
                        <option value="<?php echo $row['nama_cabang'] ?>">
                          <?php echo $row['nama_cabang'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </td>

                    <td>&nbsp;  Dari Tanggal : </td>
                    <td><input type="date" name="tanggal_from" required></td>

                    <td>&nbsp;  Sampai Tanggal : </td>
                    <td><input type="date" name="tanggal_to" required></td>

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>

              <br><br>
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
                  <th style="text-align: center;" width="10%">Status Check</th>
                  <th style="text-align: center;" width="10%">Status Dokumen</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_audit as $row_audit){
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_audit['tanggal'])) ?></td>
                  <td><?php echo $row_audit['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_audit['cabang'] ?></td>
                  <td><?php echo $row_audit['bagian'] ?></td>
                  <td><?php echo $row_audit['jenis_biaya'] ?></td>
                  <td><?php echo $row_audit['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_audit['jumlah'] + $row_audit['ppn'] - $row_audit['pph23'] - $row_audit['pph42'] - $row_audit['pph21'],0,',','.') ?></td>
                  
                  <!-- td status check -->
                  <?php if($row_audit['status_check'] == ''){ ?>
                    <td style="color: blue; font-weight: bold">
                      : On Proccess :
                    </td>
                  <?php }else if($row_audit['status_check'] == 'Checked'){ ?>
                    <td style="color: green; font-weight: bold">
                      <?php echo '- '.$row_audit['status_check'].' by '.$row_audit['checked_by'].' -'; ?>
                    </td>
                  <?php }else if($row_audit['status_check'] == 'Pending'){ ?>
                    <td style="color: orange; font-weight: bold">
                      <?php echo '- '.$row_audit['status_check'].' by '.$row_audit['checked_by'].' -'; ?>
                    </td>
                  <?php } ?>

                  <!-- Status Dokumen -->
                   <?php if($row_audit['status_dokumen']==''){ ?>
                    <td style="color: orange; font-weight: bold" width="12%">
                      Pending <br>
                      <!-- Cari Due Date -->
                      <?php
                        date_default_timezone_set("Asia/Jakarta");
                        $tanggal_bayar = $row_audit['tanggal_bayar'];
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
                  <?php }elseif($row_audit['status_dokumen']=='done'){ ?>

                    <td style="color: green; font-weight: bold" width="10%">
                      Diterima Oleh <?php echo $row_audit['dept_tujuan'] ?>
                    </td>

                  <?php }elseif($row_audit['status_dokumen']=='done acc'){ ?>

                    <td style="color: blue; font-weight: bold" width="10%">
                      Diterima Oleh Accounting <br>
                    </td>

                  <?php } ?>
                  
                  <!-- td action -->
                  <td style="text-align: center;">

                    <!-- <a href="<?php echo base_url().'p_approved/hapus/'.$row_audit['id_pengajuan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-trash"></i> Hapus
                    </a> -->

                    <a href="<?php echo base_url().'cek_audit/detail/'.$row_audit['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
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

  <script type="text/javascript">
    $(document).ready(function(){

      // $('#by_cabang').hide();

      $(document).on('click', '#tombol1', function(){
        $('#by_cabang').slideDown(1000);
      });

    });
  </script>


  <!-- Modal Dokter -->
  <form action="<?php echo base_url().'cek_audit/cetak_dok_terlambat' ?>" method="post" target="_blank">
  <div class="modal fade" id="modal-dokter">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cetak Dokumen Terlambat</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="cabang"></span> Pilih Cabang :</label>
            <select name="cabang" id="cabang" class="form-control">
              <option value="all">All Cabang</option>

              <?php foreach($data_cabang as $row_cabang){ ?>
                <option value="<?php echo $row_cabang['nama_cabang'] ?>">
                  <?php echo $row_cabang['nama_cabang'] ?> (<?php echo $row_cabang['kode_cabang'] ?>)
                </option>
              <?php } ?>

            </select>
          </div>

        </div> 
        <div class="modal-footer">

          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> 
            <i class="fa fa-times"></i> Batal
          </button>

          <button type="submit" class="btn btn-sm btn-success" id="tombol_cetak"> 
          <i class="fa fa-print"></i> Cetak
          </button>

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Dokter -->


  <!--Modal Dokpen -->
  <form action="<?php echo base_url().'cek_audit/cetak_dok_pending' ?>" method="post" target="_blank">
  <div class="modal fade" id="modal-dokpen">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cetak Dokumen Pending</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="cabang"></span> Pilih Cabang :</label>
            <select name="cabang" id="cabang" class="form-control">
              <option value="all">All Cabang</option>

              <?php foreach($data_cabang as $row_cabang){ ?>
                <option value="<?php echo $row_cabang['nama_cabang'] ?>">
                  <?php echo $row_cabang['nama_cabang'] ?> (<?php echo $row_cabang['kode_cabang'] ?>)
                </option>
              <?php } ?>

            </select>
          </div>

        </div> 
        <div class="modal-footer">

          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> 
            <i class="fa fa-times"></i> Batal
          </button>

          <button type="submit" class="btn btn-sm btn-success" id="tombol_cetak"> 
          <i class="fa fa-print"></i> Cetak
          </button>

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- /Modal Dokpen -->