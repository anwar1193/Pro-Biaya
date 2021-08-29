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
        Data Pengajuan Ditolak (Rejected)
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
              <h3 class="box-title">Pengajuan (Rejected)</h3>

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
                  <th style="text-align: center;">Status</th>
                  <th>Alasan Reject</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_rejected as $row_rejected){
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_rejected['tanggal'])) ?></td>
                  <td><?php echo $row_rejected['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_rejected['jenis_biaya'] ?></td>
                  <td><?php echo $row_rejected['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_rejected['jumlah'] + $row_rejected['ppn'] - $row_rejected['pph23'] - $row_rejected['pph42'] - $row_rejected['pph21'],0,',','.') ?></td>
                  
                  <td style="color: red; font-weight: bold">
                    <?php echo '- '.$row_rejected['status_approve'].' by '.$row_rejected['approved_by'].' -'.'<br>'.$row_rejected['nama_pengapprove'] ?>
                  </td>

                  <?php
                    // cari alasan reject 
                    $nomor_pengajuan = $row_rejected['nomor_pengajuan'];
                    $data_reject = $this->db->query("SELECT * FROM tbl_approved_history WHERE nomor_pengajuan='$nomor_pengajuan' AND status_approve='rejected'")->row_array();
                    $alasan_reject = $data_reject['note'];

                  ?>

                  <td><?php echo $alasan_reject; ?></td>

                  
                  <td style="text-align: center;">

                    <!-- <a href="<?php echo base_url().'p_rejected/hapus/'.$row_rejected['id_pengajuan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-trash"></i> Hapus
                    </a> -->

                    <a href="<?php echo base_url().'p_rejected/detail/'.$row_rejected['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
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