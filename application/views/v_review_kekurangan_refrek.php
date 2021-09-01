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
    Data Review Penyelesaian Kekurangan Biaya (Revisi Rekening)
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
          <h3 class="box-title">Review Penyelesaian Kekurangan Biaya (Revisi Rekening)</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <table id="tableDT" class="table table-bordered table-striped" style="margin-top: 10px">
            <thead>
            <tr>
              <th style="text-align: center">NO</th>
              <th style="text-align: center">NO Pengajuan</th>
              <th style="text-align: center">Cabang</th>
              <th style="text-align: center">Jenis Biaya</th>
              <th style="text-align: center">Sub Biaya</th>
              <th style="text-align: center">Jumlah Pengajuan</th>
              <th style="text-align: center">Realisasi</th>
              <th style="text-align: center">Kurang Bayar</th>
              <th style="text-align: center">Tanggal Minta Transfer</th>
              <th style="text-align: center">Bank Penerima</th>
              <th style="text-align: center">Nomor Rekening</th>
              <th style="text-align: center">Atas Nama</th>
              <th style="text-align: center" width="7%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no=1;
              foreach($data_inquiry as $row_review){
            ?>
            <tr style="text-align: center">
              <td><?php echo $no++; ?></td>
              <td><?php echo $row_review['nomor_pengajuan'] ?></td>
              <td><?php echo $row_review['cabang'] ?></td>
              <td><?php echo $row_review['jenis_biaya'] ?></td>
              <td><?php echo $row_review['sub_biaya'] ?></td>
              <td style="text-align: right;"><?php echo number_format($row_review['total_pengajuan'],0,',','.') ?></td>
              <td style="text-align: right;"><?php echo number_format($row_review['realisasi'],0,',','.') ?></td>
              <td style="text-align: right;"><?php echo number_format($row_review['kurang_bayar'],0,',','.') ?></td>
              <td><?php echo date('d-m-Y', strtotime($row_review['tanggal_request_transfer'])) ?></td>
              <td><?php echo $row_review['bank'] ?></td>
              <td><?php echo $row_review['nomor_rekening'] ?></td>
              <td><?php echo $row_review['atas_nama_bank'] ?></td>

              <!-- Kolom Action -->
              <td style="text-align: center;">

              <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit"
                data-id_penyelesaian = "<?php echo $row_review['id_penyelesaian'] ?>"
                data-bank_penerima = "<?php echo $row_review['bank'] ?>"
                data-norek_penerima = "<?php echo $row_review['nomor_rekening'] ?>"
                data-atas_nama = "<?php echo $row_review['atas_nama_bank'] ?>"
                id="pilih_edit"
                >
                <i class="fa fa-edit"></i> Perbaiki Rekening
              </button>

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


<!-- Modal Edit -->
<form action="<?php echo base_url().'review_kekurangan_biaya/update_rekening' ?>" method="post">
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Data Rekening</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="id_penyelesaian" id="id_penyelesaian" hidden>

          <div class="form-group">
            <label for="bank_penerima"></span> Bank Penerima :</label>

            <select class="form-control" name="bank" id="bank_penerima" required="">
              <option value="Mandiri">Mandiri</option>
              <option value="BCA">BCA</option>
              <option value="BCA">BNI</option>
              <option value="Mega">Mega</option>
              <option value="Permata">Permata</option>
              <option value="Danamon">Danamon</option>
              <option value="BRI">BRI</option>
            </select>
          </div>

          <div class="form-group">
            <label for="norek_penerima"></span> Nomor Rekening :</label>
            <input type="text" name="nomor_rekening" class="form-control" autocomplete="off" id="norek_penerima" required>
          </div>

          <div class="form-group">
            <label for="atas_nama"></span> Atas Nama :</label>
            <input type="text" name="atas_nama_bank" class="form-control" autocomplete="off" id="atas_nama" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Rekening</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Edit -->


  <!-- Script Jquery Edit -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih_edit', function(){

        var id_penyelesaian = $(this).data('id_penyelesaian');
        var bank_penerima = $(this).data('bank_penerima');
        var norek_penerima = $(this).data('norek_penerima');
        var atas_nama = $(this).data('atas_nama');

        $('#id_penyelesaian').val(id_penyelesaian);
        $('#bank_penerima').val(bank_penerima);
        $('#norek_penerima').val(norek_penerima);
        $('#atas_nama').val(atas_nama);
      });
    });
  </script>
  <!-- / Script Jquery Edit -->


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