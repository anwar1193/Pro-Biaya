  <?php date_default_timezone_set("Asia/Jakarta"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Ambil Data Flashdata untuk kata sweet alert -->
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

    <section class="content-header">
      <h1>
        Persetujuan Pengajuan Biaya (Direktur Finance)
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Persetujuan Pengajuan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Persetujuan Pengajuan Direktur Finance</h3>

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
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_inbox as $row_inbox){
                    // Yang tampil di view, field departemen update
                    $bagian = $row_inbox['bagian'];
                    $data_departemen = $this->M_master->tampil_data_where('tbl_departemen', array('nama_departemen' => $bagian))->row_array();
                    $nama_departemen_update = $data_departemen['nama_departemen_update'];
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_inbox['tanggal'])) ?></td>
                  <td><?php echo $row_inbox['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_inbox['cabang'] ?></td>
                  <td><?php echo $nama_departemen_update ?></td>
                  <td><?php echo $row_inbox['jenis_biaya'] ?></td>
                  <td><?php echo $row_inbox['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_inbox['jumlah'] + $row_inbox['ppn'] - $row_inbox['pph23'] - $row_inbox['pph42'] - $row_inbox['pph21'],0,',','.') ?></td>
                  <td style="text-align: center;">

                    <a href="<?php echo base_url().'inbox_dirfin/detail/'.$row_inbox['id_pengajuan'] ?>" class="btn btn-info btn-xs">
                      <i class="fa fa-refresh"></i> Proses
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