
<?php  

// Fungsi tanggal / zona waktu biar gak error
date_default_timezone_set("Asia/Jakarta");

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->

<!-- Ambil Data Flashdata untuk kata sweet alert -->
<div class="flash-data" id="flashdata" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

<section class="content-header">
<h1>
Penyelesaian Kelebihan Biaya (Pending)
<small>Form Penyelesaian </small>
</h1>
<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Penyelesaian Kelebihan
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

      <h3 style="text-align:center">Form Penyelesaian (Kelebihan Biaya)</h3>
      <hr style="border-width: 4px;">
      <form method="post" action="<?php echo base_url().'kelebihan_biaya/update_pending' ?>" enctype="multipart/form-data">

        <input type="text" name="id_penyelesaian" value="<?php echo $data_penyelesaian['id_penyelesaian'] ?>" hidden>

        <div>
          <label for="barcode">Nomor Pengajuan</label>
        </div>
        <div class="form-group input-group"> 
          <input type="text" name="nomor_pengajuan" id="nomor_pengajuan" class="form-control" value="<?php echo $data_penyelesaian['nomor_pengajuan'] ?>" required readonly>
          <span class="input-group-btn">
            <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#modal-nomor_pengajuan">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div>

        <div class="form-group">
          <label for="jenis_biaya">Jenis Biaya</label>
          <input type="text" name="jenis_biaya" id="jenis_biaya" class="form-control" readonly value="<?php echo $data_penyelesaian['jenis_biaya'] ?>">
        </div>

        <div class="form-group">
          <label for="sub_biaya">Sub Biaya</label>
          <input type="text" name="sub_biaya" id="sub_biaya" class="form-control" value="<?php echo $data_penyelesaian['sub_biaya'] ?>" readonly>
        </div>

        <div class="form-group">
          <label for="jumlah">Total Pengajuan</label>
          <input type="text" name="jumlah" id="jumlah" class="form-control" value="<?php echo $data_penyelesaian['total_pengajuan'] ?>" readonly>
        </div>

        <div class="form-group">
          <label for="realisasi">Realisasi</label>
          <input type="text" name="realisasi" id="realisasi" class="form-control" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off" value="<?php echo $data_penyelesaian['realisasi'] ?>" readonly>
        </div>

        <div class="form-group">
          <label for="lebih_bayar">Lebih Bayar (Total Pengajuan - Realisasi)</label> <br>
          <span id="lebih_bayar_text" style="font-weight:bold; font-size:30px">Rp 0</span>
          <input type="number" name="lebih_bayar" id="lebih_bayar" value="<?php echo $data_penyelesaian['lebih_bayar'] ?>" hidden>
        </div>
        
        <!-- <div class="form-group">
          <label for="note_penyelesaian2">Catatan Penyelesaian (Dari PIC Reviewer)</label>
          <input type="text" name="note_penyelesaian2" id="note_penyelesaian2" class="form-control" autocomplete="off" style="background-color:yellow" readonly>
        </div>   -->

        <div class="form-group">
          <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
          <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control" required value="<?php echo $data_penyelesaian['tanggal_pengembalian'] ?>">
        </div>

        <div class="form-group">
          <label for="cara_pengembalian">Cara Pengembalian</label>
          <select name="cara_pengembalian" id="cara_pengembalian" class="form-control" required="">
              <option value="<?php echo $data_penyelesaian['cara_pengembalian'] ?>"><?php echo $data_penyelesaian['cara_pengembalian'] ?></option>
              <option value="Tunai (LPPD)">Tunai (LPPD)</option>
              <option value="Transfer BCA 523 0304922">Transfer BCA 523 0304922 (Lampiran : Bukti Setor)</option>
          </select>
        </div>

        <!-- Berkas Pendukung -->
        <div class="form-group">
          <label for="Berkas">Berkas Pendukung :</label>
          <table width="100%" border="1" style="border-collapse: collapse;" cellpadding="5px">
            <tr>
              <th style="text-align: center">Nama File</th>
              <th style="text-align: center">Kode File</th>
              <th style="text-align: center">Action</th>
            </tr>

            <?php foreach($data_file as $row_berkas){ ?>
            <tr>
              <td><?php echo $row_berkas['nama_file'] ?></td>
              <td><?php echo $row_berkas['file'] ?></td>
              <td style="text-align: center;">

                <?php 
                  if(file_exists('file_penyelesaian/'.$row_berkas['file'])){
                ?>

                  <a class="btn btn-info btn-xs" target="_blank" href="<?php echo base_url().'file_penyelesaian/'.$row_berkas['file'] ?>">Lihat File</a>
                
                <?php }else{ ?>

                  <?php  
                    $nama_folder = substr($row_berkas['file'], 0, 10);
                  ?>

                  <a class="btn btn-info btn-xs" target="_blank" href="<?php echo base_url().'file_penyelesaian/'.$nama_folder.'/'.$row_berkas['file'] ?>">Lihat File</a>

                <?php } ?>

                <a onclick="return confirm('Anda Yakin Akan Menghapus File Ini?')" href="<?php echo base_url().'inquiry_kelebihan_biaya/hapus_file/'.$row_berkas['id'].'/'.$data_penyelesaian['id_penyelesaian'] ?>" class="btn btn-danger btn-xs">Hapus</a>
              </td>
            </tr>
            <?php } ?>
          </table>            
        </div>

        <b>Upload Berkas Tambahan (jpg / png / jpeg / pdf) :</b>
        <table class="table table-bordered" id="tableLoop">
            <thead>
            <tr class="bg-success">
                <th>No</th>
                <th>Upload File</th>
                <th>Nama File</th>
                <th class="text-center">
                <button class="btn btn-primary btn-xs" id="BarisBaru">
                    <i class="fa fa-plus"></i> Tambah File
                </button>
                </th>
            </tr>
            </thead>

            <tbody></tbody>
        </table>

        <input type="text" name="ref_no" id="ref_no"  value="<?php echo $data_pengajuan['ref_no'] ?>" hidden>
        <input type="text" name="departemen_tujuan" id="departemen_tujuan" value="<?php echo $data_pengajuan['dept_tujuan'] ?>" hidden>

        <!-- Check Box Memo -->
        <!-- <div class="form-group">
            <div class="checkbox">
            <label>
                <input type="checkbox" name="tambahkan_memo" value="ya">
                <span style="font-weight:bold; font-size:18px">Tambahkan Internal Memo</span>
            </label>
            </div>
        </div> -->

        <!-- <div class="form-group" style="background-color:yellow; padding:5px" id="tampil_note">
          <label for="note_penyelesaian">Note Penyelesaian (Dari Reviewer)</label> <br>
          <span id="note_penyelesaian" style="font-weight:bold; font-size:20px"></span>
        </div> -->

        <br>

        <span>
          <a href="<?php echo base_url().'inquiry_kelebihan_biaya/detail_pending/'.$data_penyelesaian['id_penyelesaian'] ?>" class="btn btn-danger btn-sm">
            <i class="fa fa-backward"></i> Kembali
          </a>
        </span>

        <button class="btn btn-success btn-sm" type="submit" id="tombol_kirim"><i class="fa fa-send"></i> Update Penyelesaian</button>

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


<!-- Modal Data Nomor Pengajuan -->
<div class="modal fade" id="modal-nomor_pengajuan">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">Data Pengajuan</h4>
</div>
<div class="modal-body">
  
  <table class="table table-bordered" id="tableDT">
    <thead>
      <tr>
        <th>Nomor Pengajuan</th>
        <th>Jenis Biaya</th>
        <th>Sub Biaya</th>
        <th>Jumlah Biaya</th>
        <th style="text-align:center">Action</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach($data_pengajuan as $data) : ?>
      <tr>
        <td><?php echo $data['nomor_pengajuan'] ?></td>
        <td><?php echo $data['jenis_biaya'] ?></td>
        <td><?php echo $data['sub_biaya'] ?></td>
        <td style="text-align:right"><?php echo number_format($data['jumlah'] + $data['ppn'] - $data['pph23'] - $data['pph42'] - $data['pph21'], 0, '.', ',') ?></td>
        <td style="text-align:center">
          <button class="btn btn-info btn-xs" id="pilih" type="button"
            data-nomor_pengajuan="<?php echo $data['nomor_pengajuan'] ?>"
            data-ref_no="<?php echo $data['ref_no'] ?>"
            data-departemen_tujuan="<?php echo $data['dept_tujuan'] ?>"
            data-jenis_biaya="<?php echo $data['jenis_biaya'] ?>"
            data-sub_biaya="<?php echo $data['sub_biaya'] ?>"
            data-note_penyelesaian="<?php echo $data['note_penyelesaian'] ?>"
            data-jumlah="<?php echo $data['jumlah']+$data['ppn']-$data['pph23']-$data['pph42']-$data['pph21'] ?>"
          >
          <i class="fa fa-check"></i> Pilih</button>

          <a href="<?php echo base_url().'kelebihan_biaya/detail/'.$data['id_pengajuan'] ?>" class="btn btn-warning btn-xs" target="_blank">
            Detail Pengajuan
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>
<div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> Close</button>
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- / Modal Nomor Pengajuan -->




<script>
$(document).ready(function(){

// Rubah format angka javascript
function rubah(angka){
    var reverse = angka.toString().split('').reverse().join(''),
    ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan;
}

var jumlah_direct = $('#jumlah').val();
var realisasi_direct = $('#realisasi').val();
var lebih_bayar_direct = (jumlah_direct * 1) - (realisasi_direct * 1);
$('#lebih_bayar_text').text('Rp ' + rubah(lebih_bayar_direct));

// Script data pengajuan
$('#tampil_note').hide();
$('#flashdata').hide();

$(document).on('click','#pilih', function(){

var nomor_pengajuan = $(this).data('nomor_pengajuan');
var ref_no = $(this).data('ref_no');
var jenis_biaya = $(this).data('jenis_biaya');
var sub_biaya = $(this).data('sub_biaya');
var jumlah = $(this).data('jumlah');
var note_penyelesaian = $(this).data('note_penyelesaian');
var departemen_tujuan = $(this).data('departemen_tujuan');

if(note_penyelesaian != ''){
  $('#tampil_note').show();
}else{
  $('#tampil_note').hide();
}

$('#nomor_pengajuan').val(nomor_pengajuan);
$('#ref_no').val(ref_no);
$('#departemen_tujuan').val(departemen_tujuan);
$('#jenis_biaya').val(jenis_biaya);
$('#sub_biaya').val(sub_biaya);
$('#jumlah').val(jumlah);
$('#note_penyelesaian').text('"'+note_penyelesaian+'"');
$('#note_penyelesaian2').val('"'+note_penyelesaian+'"');

$('#modal-nomor_pengajuan').modal('hide');
});


// perhitungan lebih bayar
$(document).on('keyup mouseup', '#realisasi', function(){
var jumlah = $('#jumlah').val();
var realisasi = $('#realisasi').val();
var lebih_bayar = (jumlah * 1) - (realisasi * 1);
$('#lebih_bayar').val(lebih_bayar);
$('#lebih_bayar_text').text('Rp ' + rubah(lebih_bayar));
});  


// validasi realisasi tidak boleh lebih besar dari total pengajuan
$(document).on('click', '#tombol_kirim', function(){
var jumlah_v = $('#jumlah').val();
var realisasi_v = $('#realisasi').val();
var lebih_bayar_v = (jumlah_v * 1) - (realisasi_v * 1);

if(lebih_bayar_v <= 0){
    alert("Nilai Realisasi Tidak Boleh Lebih Besar / Sama Dengan Total Pengajuan");
    return false;
}
});

});

</script>


<!-- Script Upload Multiple File -->
<script type="text/javascript">

$(document).ready(function(){
for(b=1; b<=1; b++){
barisBaru();
}
$('#BarisBaru').click(function(e){
e.preventDefault();
barisBaru();
});

$("tableLoop tbody").find('input[type=text]').filter(':visible:first').focus();
});

function barisBaru(){
$(document).ready(function(){
$("[data-toggle='tooltip'").tooltip();
});

var Nomor = $("#tableLoop tbody tr").length + 1;
var Baris = '<tr>';
      Baris += '<td class="text-center">'+Nomor+'</td>';

      Baris += '<td>';
        Baris += '<input type="file" id="pilih_file" name="files[]" class="form-control" placeholder="Upload File">';
      Baris += '</td>';

      Baris += '<td>';
        Baris += '<input type="text" name="nama_file[]" class="form-control" placeholder="Nama File" id="nama_file" autocomplete="off">';
      Baris += '</td>';

      Baris += '<td class="text-center">';
        Baris += '<a class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Baris" id="HapusBaris"><i class="fa fa-times"></i></a>';
      Baris += '</td>';
  Baris += '</tr>';

$("#tableLoop tbody").append(Baris);
$("#tableLoop tbody tr").each(function(){
$(this).find('td:nth-child(2) input').focus();
});

}

$(document).on('click', '#HapusBaris', function(e){
e.preventDefault();
var Nomor = 1;
$(this).parent().parent().remove();
$('tableLoop tbody tr').each(function(){
$(this).find('td:nth-child(1)').html(Nomor);
Nomor++;
});
});


// Jika file upload di klik, nama file akan jadi required/wajib
$(document).ready(function() {
$("#pilih_file").click(function() {
$("#nama_file").attr("required","");
})
});

</script>

<!-- Penutup Script Upload Multiple File -->

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