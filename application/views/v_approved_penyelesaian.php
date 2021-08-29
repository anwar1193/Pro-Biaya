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
    Penyelesaian Kekurangan Biaya (Final Approved)
    <small>PT Procar Int'l Finance</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Penyelesaian</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  

  <div class="box">
        <div class="box-header">
          <h3 class="box-title">Penyelesaian Kekurangan Biaya (Final Approved)</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <table id="tableDT" class="table table-bordered table-striped" style="margin-top: 10px">
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
              foreach($data_inquiry as $row_inquiry){
            ?>
            <tr style="text-align: center">
              <td><?php echo $no++; ?></td>
              <td><?php echo $row_inquiry['nomor_pengajuan'] ?></td>
              <td><?php echo $row_inquiry['jenis_biaya'] ?></td>
              <td><?php echo $row_inquiry['sub_biaya'] ?></td>
              <td style="text-align: right;"><?php echo number_format($row_inquiry['total_pengajuan'],0,',','.') ?></td>
              <td style="text-align: right;"><?php echo number_format($row_inquiry['realisasi'],0,',','.') ?></td>
              <td style="text-align: right;"><?php echo number_format($row_inquiry['kurang_bayar'],0,',','.') ?></td>
              <td><?php echo date('d-m-Y', strtotime($row_inquiry['tanggal_request_transfer'])) ?></td>
              <td><?php echo $row_inquiry['departemen_tujuan'] ?></td>
              <td style="font-weight:bold">
                <?php echo $row_inquiry['status_approve_penyelesaian'] ?> 
                <?php if($row_inquiry['status_approve_penyelesaian'] != 'On Proccess'){ ?>
                  By <?php echo $row_inquiry['approved_by_penyelesaian'] ?><br>
                  (<?php echo $row_inquiry['nama_pengapprove_penyelesaian'] ?>)
                <?php } ?>

              </td>

              <!-- Kolom Action -->
              <td style="text-align: center;">

                <a href="<?php echo base_url().'inquiry_kekurangan_biaya/detail/'.$row_inquiry['id_penyelesaian'] ?>" class="btn btn-warning btn-xs">
                  <i class="fa fa-eye"></i> Detail
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