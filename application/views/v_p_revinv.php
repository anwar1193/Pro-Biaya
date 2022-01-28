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
<!-- Content Header (Page header) -->

<!-- Ambil Data Flashdata untuk kata sweet alert -->
<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

<section class="content-header">
  <h1>
    Data Pengajuan Revisi Invoice
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
          <h3 class="box-title">Pengajuan (Revisi Invoice)</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="tableDT" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>NO</th>
              <th>Tanggal</th>
              <th>NO Pengajuan</th>
              <th>NO Invoice</th>
              <th>Jenis Biaya</th>
              <th>Sub Biaya</th>
              <th>Jumlah Biaya</th>
              <th style="text-align: center" width="20%">Keterangan Revisi</th>
              <th style="text-align: center" width="15%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no=1;
              foreach($data_revInv as $row){
            ?>
            <tr style="text-align: center">
              <td><?php echo $no++; ?></td>
              <td><?php echo date('d-m-Y',strtotime($row['tanggal'])) ?></td>
              <td><?php echo $row['nomor_pengajuan'] ?></td>
              <td><?php echo $row['nomor_invoice'] ?></td>
              <td><?php echo $row['jenis_biaya'] ?></td>
              <td><?php echo $row['sub_biaya'] ?></td>
              <td style="text-align: right;"><?php echo number_format($row['total'],0,',','.') ?></td>
              
              <td style="color: gray; font-weight: bold">"<?php echo $row['keterangan_revisi_noinv'] ?>"</td>

              <!-- Kolom Action -->
              <td style="text-align: center;">

                <a href="<?php echo base_url().'p_on_proccess/revisi_invoice_detail/'.$row['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
                  <i class="fa fa-eye"></i> Detail
                </a>

                <a href="<?php echo base_url().'p_on_proccess/revisi_invoice_v/'.$row['id_pengajuan'].'/rev_inv' ?>" class="btn btn-success btn-xs">
                  <i class="fa fa-edit"></i> Revisi
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