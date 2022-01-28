<?php  

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
    Jurnal Payment Penyelesaian
    <small>PT Procar Int'l Finance</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Jurnal Payment</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  

  <div class="box">
        <div class="box-header">
          <!-- <h3 class="box-title">Jurnal PIC</h3> -->

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table">
            <tr>
              <td width="15%">Kode Jurnal</td>
              <td>:</td>
              <td>Pro Biaya</td>

              <td>&nbsp;</td>

              <td width="15%">No Ticket</td>
              <td>:</td>
              <td>
                <?php

                  // JK/PYMT/102520/0001
                  $nojur1 = substr($data_penyelesaian['nomor_pymt_penyelesaian'], 0,11);
                  $nojur21 = substr($data_penyelesaian['nomor_pymt_penyelesaian'], 13,2);
                  $nojur22 = substr($data_penyelesaian['nomor_pymt_penyelesaian'], 11,2);
                  $nojur23 = substr($data_penyelesaian['nomor_pymt_penyelesaian'], 15,2);
                  $nojur3 = substr($data_penyelesaian['nomor_pymt_penyelesaian'], 18,4);
                  echo $nojur1.$nojur21.'.'.$nojur22.'.'.$nojur23.'/'.$nojur3;

                ?>
              </td>
            </tr>

            <tr>
              <td>No Referensi</td>
              <td>:</td>
              <td><?php echo $data_penyelesaian['nomor_penyelesaian'] ?></td>

              <td>&nbsp;</td>

              <td>Tanggal</td>
              <td>:</td>
              <td><?php echo date('d-m-Y',strtotime($data_penyelesaian['tanggal_bayar_penyelesaian'])) ?></td>
            </tr>
          </table>

          <table class="table table-bordered" style="margin-top: 20px">
            <tr>
              <th>No Perkiraan</th>
              <th>Nama Perkiraan</th>
              <th>Cabang</th>
              <th>Debet</th>
              <th>Credit</th>
            </tr>

            <tr>
              <td>245-999-000-000</td>
              <td>BIAYA MASIH HARUS DIBAYAR</td>
              <td><?php echo $data_penyelesaian['cabang'] ?></td>
              <td style="text-align: right;"><?php echo number_format($data_penyelesaian['kurang_bayar'],0,',','.') ?></td>
              <td style="text-align: right;">0</td>
            </tr>

            <?php if($data_penyelesaian['cabang'] != 'HEAD OFFICE'){ ?>
              <tr>
                <td>120-001-000-000</td>
                <td>REKENING ANTAR KANTOR</td>
                <td><?php echo $data_penyelesaian['cabang'] ?></td>
                <td style="text-align: right;">0</td>
                <td style="text-align: right;"><?php echo number_format($data_penyelesaian['kurang_bayar'],0,',','.') ?></td>
              </tr>

              <tr>
                <td>120-001-000-000</td>
                <td>REKENING ANTAR KANTOR</td>
                <td>HEAD OFFICE</td>
                <td style="text-align: right;"><?php echo number_format($data_penyelesaian['kurang_bayar'],0,',','.') ?></td>
                <td style="text-align: right;">0</td>
              </tr>
            <?php } ?>

            <?php  
              // Ambil Bank
              $nopeng = $data_penyelesaian['nomor_pengajuan'];
              $data_bayar = $this->db->query("SELECT * FROM tbl_penyelesaian_kekurangan WHERE nomor_pengajuan='$nopeng'")->row_array();
              $bank = $data_bayar['bank_bayar_penyelesaian'];

              // Ambil Nama & COA Bank
              $data_bank = $this->db->query("SELECT * FROM tbl_bank WHERE nama_bank='$bank'")->row_array();
              $nama_bank = $data_bank['nama_bank'];
              $coa_bank = $data_bank['coa_bank'];
            ?>

            <tr>
              <td><?php echo $coa_bank; ?></td>
              <td><?php echo $nama_bank ?></td>
              <td>HEAD OFFICE</td>
              <td style="text-align: right;">0</td>
              <td style="text-align: right;"><?php echo number_format($data_penyelesaian['kurang_bayar'],0,',','.') ?></td>
            </tr>

            <tr>
              <td colspan="3" style="text-align: right;font-weight: bold;">TOTAL</td>
              <td style="text-align: right;"><?php echo number_format($data_penyelesaian['kurang_bayar'],0,',','.') ?></td>
              <td style="text-align: right;"><?php echo number_format($data_penyelesaian['kurang_bayar'],0,',','.') ?></td>
            </tr>
          </table>

          <br>
          <b>Keterangan :</b> <?php echo $data_penyelesaian['kronologis'] ?> <br>

          <div style="text-align: center">
            <b>Final Approved By <?php echo $data_penyelesaian['approved_by_penyelesaian'] ?> (<?php echo $data_penyelesaian['nama_pengapprove_penyelesaian'] ?>)</b><br>
            <b>On : <?php echo date('d-m-Y', strtotime($data_penyelesaian['tanggal_approved_penyelesaian'])) ?></b>
          </div><br>

          <button class="btn btn-success no-print" onclick="window.print()">Cetak Jurnal</button>

          <!-- <a href="<?php echo base_url().'all_pengajuan_tanggal' ?>" class="btn btn-danger btn-xs">
            <i class="fa fa-backward"></i> Kembali
          </a> -->

          <!-- <a href="<?php echo base_url().'all_pengajuan_tanggal/pdf_jfin/'.$data_penyelesaian['id_pengajuan'] ?>" class="btn btn-warning btn-xs" target="_blank">
            <i class="fa fa-print"></i> Export Jurnal (PDF)
          </a>

          <a href="<?php echo base_url().'all_pengajuan_tanggal/detail_jfin/'.$data_penyelesaian['id_pengajuan'] ?>" class="btn btn-success btn-xs">
            <i class="fa fa-list"></i> Detail Pengajuan
          </a> -->

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