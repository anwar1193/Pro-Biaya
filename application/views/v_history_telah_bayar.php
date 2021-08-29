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