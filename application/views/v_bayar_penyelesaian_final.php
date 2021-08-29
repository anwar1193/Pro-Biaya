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
    Data Penyelesaian Kekurangan Biaya (Bayar Final)
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
          <h3 class="box-title">Penyelesaian Kekurangan Biaya (Bayar Final)</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <table id="tableDT" class="table table-bordered table-striped" style="margin-top: 10px">
            <thead>
            <tr>
              <th style="text-align: center">NO</th>
              <th style="text-align: center">NO Pengajuan</th>
              <th style="text-align: center">Tgl Rencana Bayar</th>
              <th style="text-align: center">Bank Bayar</th>
              <th style="text-align: center">Jenis Biaya</th>
              <th style="text-align: center">Sub Biaya</th>
              <th style="text-align: center">Jumlah Pengajuan</th>
              <th style="text-align: center">Realisasi</th>
              <th style="text-align: center">Kurang Bayar</th>
              <th style="text-align: center">Bank Tujuan</th>
              <th style="text-align: center">Nomor Rekening</th>
              <th style="text-align: center" width="15%">Action</th>
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
              <td><?php echo date('d-m-Y', strtotime($row_inquiry['tanggal_rencana_bayar_penyelesaian'])) ?></td>
              <td><?php echo $row_inquiry['bank_bayar_penyelesaian'] ?></td>
              <td><?php echo $row_inquiry['jenis_biaya'] ?></td>
              <td><?php echo $row_inquiry['sub_biaya'] ?></td>
              <td style="text-align: right;"><?php echo number_format($row_inquiry['total_pengajuan'],0,',','.') ?></td>
              <td style="text-align: right;"><?php echo number_format($row_inquiry['realisasi'],0,',','.') ?></td>
              <td style="text-align: right;"><?php echo number_format($row_inquiry['kurang_bayar'],0,',','.') ?></td>
              <td><?php echo $row_inquiry['bank'] ?></td>
              <td><?php echo $row_inquiry['nomor_rekening'] ?></td>

              <!-- Kolom Action -->
              <td style="text-align: center;">

                <a href="<?php echo base_url().'bayar_penyelesaian_final/detail/'.$row_inquiry['id_penyelesaian'] ?>" class="btn btn-warning btn-xs">
                  <i class="fa fa-eye"></i> Detail
                </a>

                <a href="#" data-toggle="modal" data-target="#modal-setuju_bayar" class="btn btn-success btn-xs" id="setuju_bayar"
                        data-id = "<?php echo $row_inquiry['id_penyelesaian'] ?>"
                        data-nopeng = "<?php echo $row_inquiry['nomor_pengajuan'] ?>"
                        data-kurang_bayar = "<?php echo $row_inquiry['kurang_bayar'] ?>"
                >
                  <i class="fa fa-check"></i> Bayar Penyelesaian
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


<!-- Modal Bayar -->
<form method="post" action="<?php echo base_url().'bayar_penyelesaian_final/bayar_final' ?>">
<div class="modal fade" id="modal-setuju_bayar">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Bayar Penyelesaian (Final)</h4>
    </div>
    <div class="modal-body">

        <input type="text" name="id_penyelesaian" id="id_penyelesaian" hidden>
        <input type="text" name="nomor_pengajuan" id="nopeng" hidden>
        <input type="text" name="nomor_pymt_penyelesaian" value="<?php echo $nomor_pymt_penyelesaian ?>" hidden>

        <div class="form-group">
            <label for="kurang_bayar"></span> Jumlah (Kurang Bayar) :</label> <br>
            <input type="number" name="kurang_bayar" id="kurang_bayar" hidden>
            <span style="font-weight: bold; font-size: 20px; padding: 5px;" id="kurang_bayar_rp"></span>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-sm btn-success" id="tombolSetujuiBayar"> Bayar</button>
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
</form>
<!-- / Modal Bayar -->  


<!-- Script Jquery Modal Setuju Bayar -->
<script>
$(document).ready(function(){

  // Rubah format angka javascript
  function rubah(angka){
        var reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join(',').split('').reverse().join('');
        return ribuan;
    }

  $(document).on('click','#setuju_bayar', function(){

    var id = $(this).data('id');
    var nopeng = $(this).data('nopeng');
    var kurang_bayar = $(this).data('kurang_bayar');

    $('#id_penyelesaian').val(id);
    $('#nopeng').val(nopeng);
    $('#kurang_bayar').val(kurang_bayar);
    $('#kurang_bayar_rp').text(rubah(kurang_bayar));
  });
});
</script>
<!-- / Script Jquery Setuju Bayar -->



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