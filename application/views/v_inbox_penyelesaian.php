<?php date_default_timezone_set("Asia/Jakarta"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Ambil Data Flashdata untuk kata sweet alert -->
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

    <section class="content-header">
      <h1>
        Persetujuan Penyelesaian Kekurangan Biaya
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Penyelesaian Pengajuan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Penyelesaian Pengajuan</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="text-align: center">NO</th>
                    <th style="text-align: center">NO Pengajuan</th>
                    <th style="text-align: center">Jenis Biaya</th>
                    <th style="text-align: center">Sub Biaya</th>
                    <th style="text-align: center">Jumlah Pengajuan</th>
                    <th style="text-align: center">Realisasi</th>
                    <th style="text-align: center">Kurang Bayar</th>
                    <th style="text-align: center">Tanggal Minta Transfer</th>
                    <th style="text-align: center">PIC Reviewer</th>
                    <th style="text-align: center">Status Penyelesaian</th>
                    <th style="text-align: center" width="7%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_inbox as $row_inbox){
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row_inbox['nomor_pengajuan'] ?></td>
                    <td><?php echo $row_inbox['jenis_biaya'] ?></td>
                    <td><?php echo $row_inbox['sub_biaya'] ?></td>
                    <td style="text-align: right;"><?php echo number_format($row_inbox['total_pengajuan'],0,',','.') ?></td>
                    <td style="text-align: right;"><?php echo number_format($row_inbox['realisasi'],0,',','.') ?></td>
                    <td style="text-align: right;"><?php echo number_format($row_inbox['kurang_bayar'],0,',','.') ?></td>
                    <td style="text-align: center;"><?php echo date('d-m-Y', strtotime($row_inbox['tanggal_request_transfer'])) ?></td>
                    <td><?php echo $row_inbox['departemen_tujuan'] ?></td>
                    <td style="font-weight:bold; text-align:center">
                      <?php echo $row_inbox['status_approve_penyelesaian']?> 
                      <?php if($row_inbox['status_approve_penyelesaian'] != 'On Proccess'){ ?>
                        By <?php echo $row_inbox['approved_by_penyelesaian'] ?> <br>
                        (<?php echo $row_inbox['nama_pengapprove_penyelesaian'] ?>)
                      <?php } ?>
                    </td>

                    <!-- Kolom Action -->
                    <td style="text-align: center;">

                        <a href="<?php echo base_url().'inbox_penyelesaian/detail/'.$row_inbox['id_penyelesaian'] ?>" class="btn btn-success btn-xs">
                        <i class="fa fa-refresh"></i> Proses
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