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
        Data Pengajuan Tambah Dokumen
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
              <h3 class="box-title">Pengajuan (Tambah Dokumen)</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>NO Pengajuan</th>
                  <th>Jenis Biaya</th>
                  <th>Sub Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th style="text-align: center" width="20%">Permintaan Dokumen</th>
                  <th>PIC Request</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_tamdok as $row_tamdok){
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_tamdok['tanggal'])) ?></td>
                  <td><?php echo $row_tamdok['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_tamdok['jenis_biaya'] ?></td>
                  <td><?php echo $row_tamdok['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_tamdok['total'],0,',','.') ?></td>
                  
                  <!-- Kolom Status Approve -->
                    <td style="color: gray; font-weight: bold">"<?php echo $row_tamdok['ket_tambah_dokumen'] ?>"</td>
                  <!-- / Kolom Status Approve -->

                  <td><?php echo $row_tamdok['tambah_dokumen_pic'] ?> Dept</td>

                  <!-- Kolom Action -->
                  <td style="text-align: center;">

                    <!-- <a href="<?php echo base_url().'p_on_proccess/hapus_tamdok/'.$row_tamdok['id_pengajuan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-times"></i> Cancel/Hapus
                    </a> -->

                    <a href="<?php echo base_url().'p_on_proccess/tamdok_detail/'.$row_tamdok['id_pengajuan'] ?>" class="btn btn-info btn-xs">
                      <i class="fa fa-plus"></i> Tambahkan Dokumen
                    </a>

                  </td>
                  <!-- / Kolom Action -->
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