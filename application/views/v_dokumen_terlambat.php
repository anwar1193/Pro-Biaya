<?php  

$nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
$cabang = $this->libraryku->tampil_user()->cabang;
$departemen = $this->libraryku->tampil_user()->departemen;
$level = $this->libraryku->tampil_user()->level;

?>
<?php date_default_timezone_set("Asia/Jakarta"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Pengajuan (Dokumen Terlambat)
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
          <h3 class="box-title">Pengajuan (Dokumen Terlambat)</h3>

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
              <th style="text-align: center;" width="10%">Status Dokumen</th>
              <th style="text-align: center" width="15%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no=1;
              foreach($data_dokterlambat as $row_dokterlambat){
            ?>
            <tr style="text-align: center">
              <td><?php echo $no++; ?></td>
              <td><?php echo date('d-m-Y',strtotime($row_dokterlambat['tanggal'])) ?></td>
              <td><?php echo $row_dokterlambat['nomor_pengajuan'] ?></td>
              <td><?php echo $row_dokterlambat['cabang'] ?></td>
              <td><?php echo $row_dokterlambat['bagian'] ?></td>
              <td><?php echo $row_dokterlambat['jenis_biaya'] ?></td>
              <td><?php echo $row_dokterlambat['sub_biaya'] ?></td>
              <td style="text-align: right;"><?php echo number_format($row_dokterlambat['jumlah'] + $row_dokterlambat['ppn'] - $row_dokterlambat['pph23'] - $row_dokterlambat['pph42'] - $row_dokterlambat['pph21'],0,',','.') ?></td>
              

              <!-- Status Dokumen -->
               <?php if($row_dokterlambat['status_dokumen']==''){ ?>
                <td style="color: orange; font-weight: bold" width="12%">
                  Pending <br>
                  <!-- Cari Due Date -->
                  <?php
                    date_default_timezone_set("Asia/Jakarta");
                    $tanggal_bayar = $row_dokterlambat['tanggal_bayar'];
                    $tgl_bayar = substr($tanggal_bayar, 8,2);
                    $bln_bayar = substr($tanggal_bayar, 5,2);
                    $thn_bayar = substr($tanggal_bayar, 0,4);

                    $tambah_14 = mktime(0,0,0,date($bln_bayar),date($tgl_bayar)+14, date($thn_bayar));
                    $batas_penyerahan0 = date("Y-m-d", $tambah_14);

                    $batas_penyerahan = strtotime($batas_penyerahan0);
                    $tanggal_sekarang = time();

                    $sisa_waktu0 = $batas_penyerahan - $tanggal_sekarang;
                    $sisa_waktu = floor($sisa_waktu0 / (60 * 60 * 24) + 1);
                  ?>

                  <?php if($tanggal_bayar != "0000-00-00"){ ?>

                    <?php if($sisa_waktu < 0){ ?>
                      <span style="color: red">
                      Terlambat : <?php echo $sisa_waktu*(-1).' Hari'; ?>
                      </span>

                    <?php }else{ ?>
                      <span style="color: black">
                      Batas Waktu Penyerahan : <?php echo $sisa_waktu; ?> Hari Lagi
                      </span>
                    <?php } ?>

                  <?php } ?>


                </td>
              <?php }elseif($row_dokterlambat['status_dokumen']=='done'){ ?>

                <td style="color: green; font-weight: bold" width="10%">
                  Diterima Oleh <?php echo $row_dokterlambat['dept_tujuan'] ?>
                </td>

              <?php }elseif($row_dokterlambat['status_dokumen']=='done acc'){ ?>

                <td style="color: blue; font-weight: bold" width="10%">
                  Diterima Oleh Accounting <br>
                </td>

              <?php } ?>
              
              <!-- td action -->
              <td style="text-align: center;">

                <a href="<?php echo base_url().'dokumen_terlambat/detail/'.$row_dokterlambat['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
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

<script type="text/javascript">
$(document).ready(function(){

  $('#by_cabang').hide();

  $(document).on('click', '#tombol1', function(){
    $('#by_cabang').slideDown(1000);
  });

});
</script>