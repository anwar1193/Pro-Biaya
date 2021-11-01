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
    Data Pending Penyelesaian
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
          <h3 class="box-title">Pending Penyelesaian</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <table id="tableDT" class="table table-bordered table-striped" style="margin-top: 10px">
            <thead>
            <tr>
              <th style="text-align:center">NO</th>
              <th style="text-align:center">Tanggal Pengajuan</th>
              <th style="text-align:center">NO Pengajuan</th>
              <th style="text-align:center">Cabang</th>
              <th style="text-align:center">Bagian</th>
              <th style="text-align:center">Jenis Biaya</th>
              <th style="text-align:center">Sub Biaya</th>
              <th style="text-align:center">Jumlah Biaya</th>
              <th style="text-align:center">Tgl Bayar (Finance)</th>
              <th style="text-align:center">Jarak Dibayar s/d Hari Ini</th>
              <th style="text-align:center">Jenis Penyelesaian</th>
              <th style="text-align: center" width="15%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no=1;
              foreach($data_pengajuan as $row_inquiry){
                  
            ?>
            <tr style="text-align: center">
              <td><?php echo $no++; ?></td>
              <td><?php echo date('d-m-Y',strtotime($row_inquiry['tanggal'])) ?></td>
              <td><?php echo $row_inquiry['nomor_pengajuan'] ?></td>
              <td><?php echo $row_inquiry['cabang'] ?></td>
              <td><?php echo $row_inquiry['bagian'] ?></td>
              <td><?php echo $row_inquiry['jenis_biaya'] ?></td>
              <td><?php echo $row_inquiry['sub_biaya'] ?></td>
              <td style="text-align: right;"><?php echo number_format($row_inquiry['jumlah'] + $row_inquiry['ppn'] - $row_inquiry['pph23'] - $row_inquiry['pph42'] - $row_inquiry['pph21'],0,',','.') ?></td>
              <td><?php echo date('d-m-Y', strtotime($row_inquiry['tanggal_bayar'])) ?></td>

              <!-- Jarak Dibayar s/d Hari Ini -->
              <td>
                  <?php  
                    $waktu_bayar = $row_inquiry['tanggal_bayar'];
                    $tanggal_bayar = substr($waktu_bayar, 8, 2);
                    $bulan_bayar = substr($waktu_bayar, 5, 2);
                    $tahun_bayar = substr($waktu_bayar, 0, 4);
                    $tanggal_now = date('d');
                    $bulan_now = date('m');
                    $tahun_now = date('Y');

                    $hari_bayar = mktime(0,0,0,$bulan_bayar,$tanggal_bayar,$tahun_bayar);
                    $hari_sekarang = mktime(0,0,0,$bulan_now, $tanggal_now, $tahun_now);

                    $selisih_epoch = $hari_sekarang - $hari_bayar;
                    $selisih_hari = $selisih_epoch / (60*60*24);
                    echo $selisih_hari.' Hari';
                  ?>
              </td>

              <td><?php echo $row_inquiry['jenis_penyelesaian'].' biaya' ?></td>


              <!-- Kolom Action -->
              <td style="text-align: center;">

                <a href="<?php echo base_url().'pending_penyelesaian/detail/'.$row_inquiry['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
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


<!-- Script Pilihan Biaya -->
<script>

$(function(){

$.ajaxSetup({
  type : 'POST',
  url : '<?php echo base_url().'inquiry_pengajuan/ambil_data_filter' ?>',
  cache : false
});

$("#jenis_biaya_pilihan").change(function(){
  var value=$(this).val();
  if(value>0){
    $.ajax({
      data:{modul:'sub_biaya',id:value},
      success: function(respond){
        $("#sub_biaya_pilihan").html(respond);
      }
    })
  }
});

});

</script>
<!-- / Script Pilihan Biaya -->


