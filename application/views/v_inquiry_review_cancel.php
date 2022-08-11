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
        Inquiry Review - Cancel
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
              <h3 class="box-title">Inquiry Pengajuan - Cancel</h3>

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
                  <th>Status</th>
                  <th>Alasan Cancel</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_inquiry as $row_inquiry){

                    // Yang tampil di view, field departemen update
                    $bagian = $row_inquiry['bagian'];
                    $data_departemen = $this->M_master->tampil_data_where('tbl_departemen', array('nama_departemen' => $bagian))->row_array();
                    $nama_departemen_update = $data_departemen['nama_departemen_update'];
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_inquiry['tanggal'])) ?></td>
                  <td><?php echo $row_inquiry['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_inquiry['cabang'] ?></td>
                  <td><?php echo $nama_departemen_update ?></td>
                  <td><?php echo $row_inquiry['jenis_biaya'] ?></td>
                  <td><?php echo $row_inquiry['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_inquiry['jumlah'] + $row_inquiry['ppn'] - $row_inquiry['pph23'] - $row_inquiry['pph42'] - $row_inquiry['pph21'],0,',','.') ?></td>

                  <!-- Kolom Status Approve -->
                  <?php if($row_inquiry['status_approve'] == 'cancel' || $row_inquiry['status_approve'] == 'cancel by request'){ ?>

                    <td style="color: red; font-weight: bold">
                      <?php echo $row_inquiry['status_approve'] ?>
                    </td>

                  <?php } ?>
                  <!-- / Kolom Status Approve -->

                  <td><?php echo $row_inquiry['alasan_cancel'] ?></td>
                  
                  <!-- td action -->
                  <td style="text-align: center;">

                    <!-- <a href="<?php echo base_url().'p_approved/hapus/'.$row_inquiry['id_pengajuan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-trash"></i> Hapus
                    </a> -->

                    <a href="<?php echo base_url().'inquiry_review_cancel/detail/'.$row_inquiry['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
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