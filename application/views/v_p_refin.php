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
        Data Pengajuan (Revisi By Finance)
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
              <h3 class="box-title">Pengajuan (Revisi By Finance)</h3>

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
                  <th style="text-align: center" width="20%">Ket Revisi</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_refin as $row_refin){
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_refin['tanggal'])) ?></td>
                  <td><?php echo $row_refin['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_refin['jenis_biaya'] ?></td>
                  <td><?php echo $row_refin['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_refin['total'],0,',','.') ?></td>
                  
                  <!-- Kolom Status Approve -->
                    <td style="color: gray; font-weight: bold">"<?php echo $row_refin['ket_refin'] ?>"</td>
                  <!-- / Kolom Status Approve -->

                  <!-- Kolom Action -->
                  <td style="text-align: center;">

                    <!-- <a href="<?php echo base_url().'p_on_proccess/hapus_refin/'.$row_refin['id_pengajuan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-times"></i> Cancel/Hapus
                    </a> -->

                    <a href="<?php echo base_url().'p_on_proccess/refin_detail/'.$row_refin['id_pengajuan'] ?>" class="btn btn-info btn-xs">
                      <i class="fa fa-edit"></i> Perbaiki
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