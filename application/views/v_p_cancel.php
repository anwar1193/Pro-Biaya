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

  <!-- Ambil Data Flashdata untuk kata sweet alert -->
  <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pengajuan Cancel (Dibatalkan)
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
              <h3 class="box-title">Pengajuan (Cancel)</h3>

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
                  <th style="text-align: center" width="10%">Status</th>
                  <th style="text-align: center" width="20%">Alasan Cancel</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_cancel as $row_cancel){
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_cancel['tanggal'])) ?></td>
                  <td><?php echo $row_cancel['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_cancel['jenis_biaya'] ?></td>
                  <td><?php echo $row_cancel['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_cancel['jumlah'] + $row_cancel['ppn'] - $row_cancel['pph23'] - $row_cancel['pph42'] - $row_cancel['pph21'],0,',','.') ?></td>
                  
                  <td style="color: red; font-weight: bold">
                    Cancel
                  </td>

                  <!-- Kolom Alasan Cancel -->
                  <td style="text-align: center;"><?php echo $row_cancel['alasan_cancel'] ?></td>
                  <!-- / Kolom Alasan Cancel -->

                  <!-- td action -->
                  <td style="text-align: center;">

                    <a href="<?php echo base_url().'p_cancel/detail/'.$row_cancel['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
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


  <!-- Modal Cancel -->
  <form action="<?php echo base_url().'p_on_proccess/hapus' ?>" method="post">
  <div class="modal fade" id="modal-cancel">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cancel Pengajuan?</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="id" id="id" hidden>

          <div class="form-group">
            <label for="alamat"></span> Alasan Cancel :</label>
            <textarea class="form-control" name="alasan_cancel" required></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-danger"> Cancel Pengajuan</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Cancel -->


  <!-- Script Jquery Cancel -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih_cancel', function(){

        var id = $(this).data('id');

        $('#id').val(id);
      });
    });
  </script>
  <!-- / Script Jquery Edit Split Bayar-->


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