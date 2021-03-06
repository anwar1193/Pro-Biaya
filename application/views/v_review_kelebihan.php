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
    Data Review Penyelesaian Kelebihan Biaya
    <small>PT Procar Int'l Finance</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Review</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  

  <div class="box">
        <div class="box-header">
          <h3 class="box-title">Review Penyelesaian Kelebihan Biaya</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

        <button class="btn btn-success btn-sm" id="tombol1">Berdasarkan Cabang</button>
        <button class="btn btn-warning btn-sm" id="tombol2">Berdasarkan Biaya</button>

        <!-- Filter by Cabang -->
        <div id="cabang"><br>
        <form method="POST" action="<?php echo base_url().'review_kelebihan_biaya' ?>">
          <table>
            <tr>
              <td>(FILTER BY Cabang) - &nbsp;&nbsp;</td>

              <td>&nbsp; Cabang :</td>
              <td>
                <select name="cabang">
                  <option value="">- Pilih Cabang -</option>
                  <?php  
                    foreach($data_cabang as $row_cabang){
                  ?>
                  <option value="<?php echo $row_cabang['nama_cabang'] ?>"><?php echo $row_cabang['nama_cabang'] ?></option>
                  <?php } ?>
                </select>
              </td>

              <td>
                &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data1">
                  <i class="fa fa-search"></i> Cari Data
                </button>
              </td>
            </tr>
          </table>
        </form>
        </div>
        <!-- Penutup Filter by Cabang -->

        <!-- Filter by Jenis Biaya -->
        <div id="jenis_biaya"><br>
        <form method="POST" action="<?php echo base_url().'review_kelebihan_biaya' ?>">
          <table>
            <tr>
              <td>(FILTER By Sub Biaya) - &nbsp;&nbsp;</td>

              <td>Sub Biaya :</td>
              <td>
                <select name="sub_biaya" required="">
                  <option value="">- Pilih Sub Biaya -</option>
                  <?php foreach($data_filter_biaya as $row){ ?>
                  <option value="<?php echo $row['sub_biaya'] ?>">
                    <?php echo $row['sub_biaya'] ?>
                  </option>
                  <?php } ?>
                </select>
              </td>

              <td>
                &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data2">
                  <i class="fa fa-search"></i> Cari Data
                </button>
              </td>
            </tr>
          </table>
        </form>
        </div>
        <!-- Penutup Filter by Jenis Biaya -->
        <br>
        <hr style="border-color: orange; border-style: dashed;">

          <table id="tableDT" class="table table-bordered table-striped" style="margin-top: 10px">
            <thead>
            <tr>
              <th>NO</th>
              <th>NO Pengajuan</th>
              <th>Cabang</th>
              <th>Bagian/Dept</th>
              <th>Jenis Biaya</th>
              <th>Sub Biaya</th>
              <th>Jumlah Pengajuan</th>
              <th>Realisasi</th>
              <th>Lebih Bayar</th>
              <th>Tanggal Pengembalian</th>
              <th>Status Penyelesaian</th>
              <th style="text-align: center" width="7%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no=1;
              foreach($data_review as $row_review){
            ?>
            <tr style="text-align: center">
              <td><?php echo $no++; ?></td>
              <td><?php echo $row_review['nomor_pengajuan'] ?></td>
              <td><?php echo $row_review['cabang'] ?></td>
              <td><?php echo $row_review['bagian'] ?></td>
              <td><?php echo $row_review['jenis_biaya'] ?></td>
              <td><?php echo $row_review['sub_biaya'] ?></td>
              <td style="text-align: right;"><?php echo number_format($row_review['total_pengajuan'],0,',','.') ?></td>
              <td style="text-align: right;"><?php echo number_format($row_review['realisasi'],0,',','.') ?></td>
              <td style="text-align: right;"><?php echo number_format($row_review['lebih_bayar'],0,',','.') ?></td>
              <td><?php echo date('d-m-Y', strtotime($row_review['tanggal_pengembalian'])) ?></td>
              <td style="font-weight:bold"><?php echo $row_review['status_penyelesaian'] ?></td>

              <!-- Kolom Action -->
              <td style="text-align: center;">

                <a href="<?php echo base_url().'review_kelebihan_biaya/detail/'.$row_review['id_penyelesaian'] ?>" class="btn btn-warning btn-xs">
                  <i class="fa fa-check-square-o"></i> Review Penyelesaian
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

<!-- Script Filter -->
<script type="text/javascript">
    $(document).ready(function(){

      $('#cabang').hide();
      $('#jenis_biaya').hide();

      $(document).on('click', '#tombol1', function(){
        $('#cabang').slideDown(1000);
        $('#jenis_biaya').hide();
      });

      $(document).on('click', '#tombol2', function(){
        $('#cabang').hide();
        $('#jenis_biaya').slideDown(1000);
      });

    });
  </script>
<!-- / Penutup Script Filter -->