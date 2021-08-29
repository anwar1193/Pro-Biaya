<script type = "text/javascript" > history.pushState(null, null); window.addEventListener('popstate', function(event) { history.pushState(null, null); }); </script>

<!-- CKEditor -->
<script src="<?php echo base_url().'asset/ckeditor_memo/ckeditor.js' ?>"></script>

<?php  

// Fungsi tanggal / zona waktu biar gak error
date_default_timezone_set("Asia/Jakarta");

$cabang = $this->libraryku->tampil_user()->cabang;

if($cabang == 'HEAD OFFICE'){
    $user = $this->libraryku->tampil_user()->departemen;
}else{
    $user = $this->libraryku->tampil_user()->level;
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tambah Memo
    <small>Input Memo Internal </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Input Memo</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  
  <!-- Tampilan Form Tambah Data -->
  <div class="box box-widget">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <?php echo $this->session->flashdata('pesan'); ?>

          <h3>INTERNAL MEMO PENYELESAIAN</h3>
          <hr style="border-width: 4px;">
          <form method="post" action="<?php echo base_url().'kelebihan_biaya/kirim_memo' ?>">

            <div class="form-group">
              <label for="nomor_pengajuan">Nomor Pengajuan</label>
              <input type="text" name="nomor_pengajuan" id="nomor_pengajuan" class="form-control" value="<?php echo $nopeng; ?>" readonly>
            </div>

            <div class="form-group">
              <label for="nomor_memo">Nomor Memo</label>
              <input type="text" name="nomor_memo" id="nomor_memo" class="form-control" required autocomplete="off">
            </div>

            <div class="form-group">
              <label for="kepada">Kepada</label>
              <input type="text" name="kepada" id="kepada" class="form-control" readonly value="Finance Dept">
            </div>

            <div class="form-group">
              <label for="cc">CC</label>
              <input type="text" name="cc" id="cc" class="form-control" readonly value="Accounting Dept">
            </div>

            <div class="form-group">
              <label for="dari">Dari</label>
              <input type="text" name="dari" id="dari" class="form-control" readonly value="<?php echo $cabang.'-'.$user;?>">
            </div>

            <div class="form-group">
              <label for="perihal">Perihal</label>
              <input type="text" name="perihal" id="perihal" class="form-control" autocomplete="off" required>
            </div>

            <div class="form-group">
              <label for="tanggal_memo">Tanggal</label>
              <input type="text" name="tanggal_memo" id="tanggal_memo" class="form-control" readonly value="<?php echo date('d-m-Y') ?>">
            </div>

            <div class="form-group">
                <label for="isi_memo">Isi Memo <em>(Bisa copy paste dari template yg sudah ada)</em></label>
                <textarea class="form-control" name="isi_memo" required></textarea>
            </div>

            <button class="btn btn-success btn-sm" type="submit" id="tombol_memo"><i class="fa fa-save"></i> Kirim Memo</button>
            <!-- <button class="btn btn-danger btn-sm" type="reset"><i class="fa fa-times"></i> Batalkan Memo</button> -->
            <a href="<?php echo base_url().'home' ?>" class="btn btn-danger btn-sm">
              Batalkan Memo
            </a>

          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- / Tampilan Form Tambah Data -->
  
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Script CKEditor -->
<script>
        CKEDITOR.replace('isi_memo');
</script>
<!-- / Script CKEditor -->

<!-- Matikan Refresh -->
<script type="text/javascript">
  $(function () {  
      $(document).keydown(function (e) {  
          return (e.which || e.keyCode) != 116;  
      });  
  }); 
</script>

<!-- Script Validasi Hilangkan/Hidden Tombol Kirim Memo  -->
<script src="<?php echo base_url().'js_custom/validasi_th_tambah_memo.js' ?>"></script>