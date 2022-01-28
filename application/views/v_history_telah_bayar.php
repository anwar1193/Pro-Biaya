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
        Inquiry Pembayaran - Telah Dibayar
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
              <h3 class="box-title">Telah Dibayar (Default Pembayaran Hari Ini)</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

            &nbsp; FILTER BY : 

            <button class="btn btn-info btn-sm" id="tombol1">Tanggal Bayar</button>
            <button class="btn btn-warning btn-sm" id="tombol2">Jenis Biaya</button>
            <button class="btn btn-success btn-sm" id="tombol3">Cabang</button>
            <button class="btn btn-primary btn-sm" id="tombol4">Departemen</button>

            <!-- Reset Filter -->
            <form method="POST" action="<?php echo base_url().'history_telah_bayar' ?>" style="float: left;">
              <button type="submit" class="btn btn-danger btn-sm" name="reset_filter">
                <i class="fa fa-refresh"></i> Reset Filter
              </button>
            </form>
            <!-- / Reset Filter -->

            <!-- Filter by Tanggal Rencana Bayar -->
              &nbsp;
              <div id="tanggal_bayar"><br>
              <form method="POST" action="<?php echo base_url().'history_telah_bayar' ?>">
                <table>
                  <tr>
                    <td>(FILTER By Tgl Bayar) - &nbsp;</td>

                    <td>&nbsp;  Dari Tanggal : </td>
                    <td><input type="date" name="tanggal_from" required></td>

                    <td>&nbsp;  Sampai Tanggal : </td>
                    <td><input type="date" name="tanggal_to" required></td>

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>
              <!-- Penutup Filter by Tanggal Rencana Bayar -->

              <!-- Filter by Jenis Biaya -->
              <div id="jenis_biaya"><br>
              <form method="POST" action="<?php echo base_url().'history_telah_bayar' ?>">
                <table>
                  <tr>
                    <td>(FILTER By Biaya) - &nbsp;&nbsp;</td>

                    <td>Jenis Biaya :</td>
                    <td>
                      <select name="jenis_biaya" required="" id="jenis_biaya_pilihan">
                        <option value="">- Pilih Jenis Biaya -</option>
                        <?php foreach($data_jb_bayar as $row){ ?>
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
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data2">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>
              <!-- Penutup Filter by Jenis Biaya -->

              <!-- Filter by Cabang -->
              <div id="cabang"><br>
              <form method="POST" action="<?php echo base_url().'history_telah_bayar' ?>">
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
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data3">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>
              <!-- Penutup Filter by Cabang -->


              <!-- Filter by Departemen -->
              <div id="departemen"><br>
              <form method="POST" action="<?php echo base_url().'history_telah_bayar' ?>">
                <table>
                  <tr>
                    <td>(FILTER BY Departemen) - &nbsp;&nbsp;</td>

                    <td>&nbsp; Departemen :</td>
                    <td>
                      <select name="departemen">
                        <option value="">- Pilih Departemen -</option>
                        <?php  
                          foreach($data_departemen as $row_departemen){
                        ?>
                        <option value="<?php echo $row_departemen['nama_departemen'] ?>"><?php echo $row_departemen['nama_departemen'] ?></option>
                        <?php } ?>
                      </select>
                    </td>

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data4">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>
              <!-- Penutup Filter by Departemen -->

              <!-- <form method="post" action="<?php echo base_url().'history_bayar/cetak' ?>"> -->
              <br><br>
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr style="text-align: center">
                  <th>NO</th>
                  <th>Tgl Rencana Bayar</th>
                  <th width="8%">Tgl Bayar</th>
                  <th>NO Pengajuan</th>
                  <th>Cabang</th>
                  <th>Departemen</th>
                  <th>Jenis Biaya</th>
                  <th>Sub Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th>Bank</th>
                  <th>Pembayaran Ke</th>
                  <th>Status Bayar</th>
                  <th>Bank Bayar</th>
                  <!-- <th style="text-align: center">Pilih Cetak</th> -->
                  <th style="text-align: center" width="7%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_bayar as $row_bayar){
                  $no_pengajuan = $row_bayar['nomor_pengajuan'];
                  // ambil tanggal permintaan bayar
                  $r_perbay = $this->db->query("SELECT * FROM tbl_check WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
                  $tanggal_permintaan = $r_perbay['tanggal_bayar'];

                  // Cari nama bank bayar
                  $bank_bayar = $row_bayar['bnk_bayar'];
                  $nama_bank_byr = $this->db->query("SELECT * FROM tbl_bank WHERE id='$bank_bayar'")->row_array();
                  $nama_bank_bayar = $nama_bank_byr['nama_bank'];

                  // cari frekuensi bayar by nomor pengajuan
                  $frek_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan'")->num_rows();
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_bayar['tanggal_rencana_bayar'])) ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_bayar['tanggal_bayar'])) ?></td>
                  <td><?php echo $row_bayar['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_bayar['cabang'] ?></td>
                  <td><?php echo $row_bayar['bagian'] ?></td>
                  <td><?php echo $row_bayar['jenis_biaya'] ?></td>
                  <td><?php echo $row_bayar['sub_biaya'] ?></td>

                  <?php if($frek_byr == 1){ //Jika Sekali Bayar ?>
                    
                    <td style="text-align: right;"><?php echo number_format($row_bayar['jumlah']+$row_bayar['ppn']-($row_bayar['pph23']+$row_bayar['pph42']+$row_bayar['pph21']),0,',','.') ?></td>
                  
                  <?php }else{ //Jika Lebih Dari sekali bayar ?>
                    
                    <td style="text-align: right;"><?php echo number_format($row_bayar['jumlah_bayar']+$row_bayar['ppn_bayar']-($row_bayar['pph23_bayar']+$row_bayar['pph42_bayar']+$row_bayar['pph21_bayar']),0,',','.') ?></td>
                    
                  <?php } ?>

                  <td><?php echo $row_bayar['bank_penerima'] ?></td>

                  <?php if($frek_byr == 1){ // jika hanya sekali bayar ?>

                    <td>Pembayaran 1 Kali</td>

                  <?php }else{ // jika lebih dari sekali pembayaran ?>

                    <td><?php echo 'Pembayaran Ke-'.$row_bayar['pembayaran_ke'] ?></td>

                  <?php } ?>

                  <td style="color: green"><?php echo $row_bayar['sts_bayar'] ?></td>
                  <td><?php echo $nama_bank_bayar ?></td>

                  <!-- <td style="text-align: center">
                    <input type="checkbox" name="id_pengajuan[]" class="minimal" value="<?php echo $row_bayar['id'] ?>">
                  </td> -->
                  
                  <td style="text-align: center;">

                    <a href="<?php echo base_url().'history_telah_bayar/detail/'.$row_bayar['id'] ?>" class="btn btn-info btn-xs">
                      <i class="fa fa-eye"></i> Detail
                    </a>

                    <a href="#" data-toggle="modal" data-target="#tambah_dokumen" class="btn btn-primary btn-xs" style="margin-top: 5px;"
                        id="pilih_tambah_dokumen"
                        data-nomor_pengajuan="<?php echo $row_bayar['nomor_pengajuan'] ?>"
                        data-ref_no="<?php echo $row_bayar['ref_no'] ?>"
                      >
                      <i class="fa fa-plus"></i> Bukti Transfer
                    </a>

                  </td>
                </tr>
                <?php } ?>
                </tbody>
              </table>

              <!-- </form> -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Tambah Dokumen -->
  <form action="<?php echo base_url().'history_telah_bayar/tambah_dokumen' ?>" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="tambah_dokumen">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Upload Bukti Transfer</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="nomor_pengajuan" autocomplete="off" id="nomor_pengajuan" hidden>
          <input type="text" name="ref_no" autocomplete="off" id="ref_no" hidden>

          <b>Upload Berkas (jpg / png / jpeg / pdf) :</b>
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

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload Dokumen</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Tambah Dokumen -->


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
      url : '<?php echo base_url().'inquiry_all/ambil_data_all' ?>',
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


  <script type="text/javascript">
    $(document).ready(function(){

      $('#tanggal_bayar').hide();
      $('#jenis_biaya').hide();
      $('#cabang').hide();
      $('#departemen').hide();

      $(document).on('click', '#tombol1', function(){
        $('#tanggal_bayar').slideDown(1000);
        $('#jenis_biaya').hide();
        $('#cabang').hide();
        $('#departemen').hide();
      });

      $(document).on('click', '#tombol2', function(){
        $('#tanggal_bayar').hide();
        $('#jenis_biaya').slideDown(1000);
        $('#cabang').hide();
        $('#departemen').hide();
      });

      $(document).on('click', '#tombol3', function(){
        $('#tanggal_bayar').hide();
        $('#jenis_biaya').hide();
        $('#cabang').slideDown(1000);
        $('#departemen').hide();
      });

      $(document).on('click', '#tombol4', function(){
        $('#tanggal_bayar').hide();
        $('#jenis_biaya').hide();
        $('#cabang').hide();
        $('#departemen').slideDown(1000);
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

<script>
    $(document).ready(function(){

      // Script Jquery pilih tambah dokumen
      $(document).on('click','#pilih_tambah_dokumen', function(){
        var nomor_pengajuan = $(this).data('nomor_pengajuan');
        var ref_no = $(this).data('ref_no');
        $('#nomor_pengajuan').val(nomor_pengajuan);
        $('#ref_no').val(ref_no);
      });

      // Script Jquery pilih penyelesaian
      $(document).on('click','#pilih_penyelesaian', function(){
        var nomor_pengajuan = $(this).data('nomor_pengajuan');
        $('#nomor_pengajuan2').val(nomor_pengajuan);
      });
      

    });
  </script>
  <!-- / Script Jquery pilih tambah dokumen-->