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
    Data Inquiry Penyelesaian Biaya Sesuai
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
          <h3 class="box-title">Inquiry Penyelesaian Biaya Sesuai</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

        FILTER BY : 

        <button class="btn btn-info btn-sm" id="tombol1">Jenis Biaya</button>
        <button class="btn btn-success btn-sm" id="tombol2">Status Penyelesaian</button>

        <!-- Filter by Jenis Biaya -->
        <div id="jenis_biaya"><br>
          <form method="POST" action="<?php echo base_url().'inquiry_biaya_sesuai' ?>">
            <table>
              <tr>
                <td>(FILTER By Biaya) - &nbsp;&nbsp;</td>

                <td>Jenis Biaya :</td>
                <td>
                  <select name="jenis_biaya" required="" id="jenis_biaya_pilihan">
                    <option value="">- Pilih Jenis Biaya -</option>
                    <?php foreach($data_jb as $row){ ?>
                    <option value="<?php echo $row['id_jb'] ?>">
                      <?php echo $row['jenis_biaya'] ?>
                    </option>
                    <?php } ?>
                  </select>
                </td>

                <td>&nbsp;</td>

                <td>Sub Biaya :</td>
                <td>
                    <select id="sub_biaya_pilihan" name="sub_biaya" required="">
                      <option></option>
                    </select>
                </td>

                <td>
                  &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data1">
                    <i class="fa fa-search"></i> Cari Datas
                  </button>
                </td>
              </tr>
            </table>
          </form>
          </div>
          <!-- Penutup Filter by Jenis Biaya -->


          <!-- Filter by Status Approval -->
          <div id="status_penyelesaian"><br>
          <form method="POST" action="<?php echo base_url().'inquiry_biaya_sesuai' ?>">
            <table>
              <tr>
                <td>(FILTER BY Status Penyelesaian) - &nbsp;&nbsp;</td>

                <td>&nbsp; Status Penyelesaian :</td>
                <td>
                  <select name="status_penyelesaian">
                    <option value="On Proccess">On Proccess</option>
                    <option value="Verified By PIC">Verified By PIC</option>
                    <option value="Verified By Accounting">Verified By Accounting</option>
                    <option value="cancel">Cancel</option>
                    <option value="cancel by request">Cancel By Request</option>
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
          <!-- Penutup Filter by Status Approval -->

          <br>
          <hr style="border-color: orange; border-style: dashed;">

          <table id="tableDT" class="table table-bordered table-striped" style="margin-top: 10px">
            <thead>
            <tr>
              <th style="text-align: center">NO</th>
              <th style="text-align: center">NO Pengajuan</th>
              <th style="text-align: center">Jenis Biaya</th>
              <th style="text-align: center">Sub Biaya</th>
              <th style="text-align: center">Jumlah Pengajuan</th>
              <th style="text-align: center">Realisasi</th>
              <th style="text-align: center">Selisih</th>
              <th style="text-align: center">Tanggal Penyelesaian</th>
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
              <td style="text-align: right;"><?php echo number_format($row_inquiry['selisih'],0,',','.') ?></td>
              <td><?php echo date('d-m-Y', strtotime($row_inquiry['tanggal_penyelesaian'])) ?></td>
              <td><?php echo $row_inquiry['departemen_tujuan'] ?></td>
              <td style="font-weight:bold"><?php echo $row_inquiry['status_verifikasi_penyelesaian'] ?></td>

              <!-- Kolom Action -->
              <td style="text-align: center;">

                <a href="<?php echo base_url().'inquiry_biaya_sesuai/detail/'.$row_inquiry['id_penyelesaian'] ?>" class="btn btn-warning btn-xs">
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

    <!-- Script Filter -->
    <script type="text/javascript">
      $(document).ready(function(){

        $('#jenis_biaya').hide();
        $('#status_penyelesaian').hide();

        $(document).on('click', '#tombol1', function(){
          $('#jenis_biaya').slideDown(1000);
          $('#status_penyelesaian').hide();
        });

        $(document).on('click', '#tombol2', function(){
          $('#jenis_biaya').hide();
          $('#status_penyelesaian').slideDown(1000);
        });

      });
    </script>
    <!-- / Penutup Script Filter -->