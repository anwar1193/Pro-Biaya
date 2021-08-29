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
        All Pengajuan
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
              <h3 class="box-title">Data Pengajuan</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

              Filter By : 

              <button class="btn btn-primary btn-sm" id="tombol1">Tanggal Pengajuan</button>
              <!-- <button class="btn btn-success btn-sm" id="tombol2">Tanggal Approved</button> -->
              <button class="btn btn-warning btn-sm" id="tombol3">Status Dokumen</button>
              <button class="btn btn-info btn-sm" id="tombol4">Tanggal Proses Bayar (BMHD)</button>
              <button class="btn btn-success btn-sm" id="tombol5">Tanggal Bayar (Payment)</button>

              <!-- Filter by Tanggal Pengajuan -->
              <div id="tanggal_pengajuan"><br>
              <form method="POST" action="<?php echo base_url().'all_pengajuan_tanggal' ?>">
                <table>
                  <tr>
                    <td>(FILTER BY Tgl Pengajuan) - &nbsp;</td>

                    <td>Cabang :</td>
                    <td>
                      <select name="cabang" required="">
                        <option value="">- Pilih Cabang -</option>
                        <option value="all">ALL CABANG</option>
                        <?php foreach($data_cabang as $row){ ?>
                        <option value="<?php echo $row['nama_cabang'] ?>">
                          <?php echo $row['nama_cabang'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </td>

                    <td>&nbsp;  Dari Tanggal : </td>
                    <td><input type="date" name="tanggal_from" required></td>

                    <td>&nbsp;  Sampai Tanggal : </td>
                    <td><input type="date" name="tanggal_to" required></td>

                    <!-- Sort BY -->
                    <td>&nbsp;  Sort By : </td>
                    <td>
                        <select name="sort_by1" id="sort_by1">
                          <option width="50" value="id_pengajuan">- Pilih -</option>
                          <option value="tanggal" width="50">Tanggal Pengajuan</option>
                          <option value="total" width="50">Jumlah Biaya</option>
                        </select>

                        <select name="sort_metode1" id="sort_metode1">
                          <option width="50" value="DESC">- Pilih Metode Urutan -</option>
                        </select>
                    </td>  
                    <!-- / Sort By -->

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>

              <!-- Penutup Filter by Tanggal Pengajuan -->

              <!-- Filter by Tanggal Approved -->
              <div id="tanggal_approved"><br>
              <form method="POST" action="<?php echo base_url().'all_pengajuan_tanggal' ?>">
                <table>
                  <tr>
                    <td>(FILTER BY Tgl Approved) - &nbsp;&nbsp;</td>

                    <td>Cabang :</td>
                    <td>
                      <select name="cabang2" required="">
                        <option value="">- Pilih Cabang -</option>
                        <option value="all">ALL CABANG</option>
                        <?php foreach($data_cabang as $row){ ?>
                        <option value="<?php echo $row['nama_cabang'] ?>">
                          <?php echo $row['nama_cabang'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </td>

                    <td>&nbsp;  Dari Tanggal : </td>
                    <td><input type="date" name="tanggal_from2" required></td>

                    <td>&nbsp;  Sampai Tanggal : </td>
                    <td><input type="date" name="tanggal_to2" required></td>

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data2">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>
              <!-- Penutup Filter by Tanggal Approved -->


              <!-- Filter by Status Dokumen -->
              <div id="status_dokumen"><br>
              <form method="POST" action="<?php echo base_url().'all_pengajuan_tanggal' ?>">
                <table>
                  <tr>
                    <td>(FILTER BY Status Dokumen) - &nbsp;&nbsp;</td>

                    <td>Cabang :</td>
                    <td>
                      <select name="cabang3" required="">
                        <option value="">- Pilih Cabang -</option>
                        <option value="all">ALL CABANG</option>
                        <?php foreach($data_cabang as $row){ ?>
                        <option value="<?php echo $row['nama_cabang'] ?>">
                          <?php echo $row['nama_cabang'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </td>

                    <td>&nbsp; Status Dokumen :</td>
                    <td>
                      <select name="status_dokumen">
                        <option value="">Pending</option>
                        <option value="Done">Done</option>
                      </select>
                    </td>

                    <!-- Sort BY -->
                    <td>&nbsp;  Sort By : </td>
                    <td>
                        <select name="sort_by3" id="sort_by3">
                          <option width="50" value="id_pengajuan">- Pilih -</option>
                          <option value="tanggal" width="50">Tanggal Pengajuan</option>
                          <option value="total" width="50">Jumlah Biaya</option>
                        </select>

                        <select name="sort_metode3" id="sort_metode3">
                          <option width="50" value="DESC">- Pilih Metode Urutan -</option>
                        </select>
                    </td>  
                    <!-- / Sort By -->

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data3">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>

              <!-- Penutup Filter by Status Dokumen -->

              <!-- Filter by Tanggal Proses Bayar (BMHD) -->
              <div id="tanggal_bmhd"><br>
              <form method="POST" action="<?php echo base_url().'all_pengajuan_tanggal' ?>">
                <table>
                  <tr>
                    <td>(FILTER BY Tgl Proses Bayar (BMHD)) - &nbsp;</td>

                    <td>Cabang :</td>
                    <td>
                      <select name="cabang4" required="">
                        <option value="">- Pilih Cabang -</option>
                        <option value="all">ALL CABANG</option>
                        <?php foreach($data_cabang as $row){ ?>
                        <option value="<?php echo $row['nama_cabang'] ?>">
                          <?php echo $row['nama_cabang'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </td>

                    <td>&nbsp;  Dari Tanggal : </td>
                    <td><input type="date" name="tanggal_from4" required></td>

                    <td>&nbsp;  Sampai Tanggal : </td>
                    <td><input type="date" name="tanggal_to4" required></td>

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data4">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>

              <!-- Penutup Filter by Tanggal Proses Bayar (BMHD) -->

              <!-- Filter by Tanggal Bayar (Payment) -->
              <div id="tanggal_payment"><br>
              <form method="POST" action="<?php echo base_url().'all_pengajuan_tanggal' ?>">
                <table>
                  <tr>
                    <td>(FILTER BY Tanggal Bayar (Payment)) - &nbsp;</td>

                    <td>Cabang :</td>
                    <td>
                      <select name="cabang5" required="">
                        <option value="">- Pilih Cabang -</option>
                        <option value="all">ALL CABANG</option>
                        <?php foreach($data_cabang as $row){ ?>
                        <option value="<?php echo $row['nama_cabang'] ?>">
                          <?php echo $row['nama_cabang'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </td>

                    <td>&nbsp;  Dari Tanggal : </td>
                    <td><input type="date" name="tanggal_from5" required></td>

                    <td>&nbsp;  Sampai Tanggal : </td>
                    <td><input type="date" name="tanggal_to5" required></td>

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data5">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>

              <!-- Penutup Filter by Tanggal Bayar (Payment) -->


              <span style="float: right;">
                <!-- <a target="_blank" href="<?php echo base_url().'All_pengajuan_tanggal/cetak_dok_terlambat' ?>" class="btn btn-danger btn-sm">
                  <i class="fa fa-print"></i> Cetak Dokumen Terlambat
                </a> -->

                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-dokter">
                  <i class="fa fa-print"></i> Cetak Dokumen Terlambat
                </a>
              </span>


              <hr style="border-color: orange; border-style: dashed;">

              <!-- Sort By -->
              <form method="post" action="<?php echo base_url().'all_pengajuan_tanggal' ?>" style="margin-top: 20px">
                
                <label for="nama_field">Sort By : </label>

                <select name="sort_by" id="sort_by" required="">
                  <option width="50" value="">- Pilih -</option>
                  <option value="tanggal" width="50">Tanggal Pengajuan</option>
                  <option value="jumlah_biaya" width="50">Jumlah Biaya</option>
                </select>

                <select name="sort_metode" id="sort_metode" required="">
                  <option width="50" value="">- Pilih Metode Urutan -</option>
                </select>

                <button type="submit" name="sort">Sort</button>
                
              </form>
              <!-- Sort By -->

              <br>

              <table class="table table-bordered table-striped" id="tableDT" style="margin-top: 5px">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal Pengajuan</th>
                  <th>NO Pengajuan</th>
                  <th>Cabang</th>
                  <th>Dept</th>
                  <th>Jenis Biaya</th>
                  <th>Sub Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th>Tanggal Proses Bayar (BMHD)</th>
                  <th>Tanggal Bayar (Payment)</th>
                  <th style="text-align: center;" width="10%">Status Dokumen</th>
                  <th style="text-align: center" width="15%">View</th>
                </tr>
                </thead>
                
                <tbody>
                <?php
                  $no=1;
                  foreach($data_all_tanggal as $row_all){

                    // Cari tanggal, jam setuju bayar & bayar final
                    $nopeng = $row_all['nomor_pengajuan'];
                    $data_bayar = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$nopeng' AND jam_proses_bayar != '' ORDER BY id DESC LIMIT 0,1")->row_array();
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_all['tanggal'])) ?></td>
                  <td><?php echo $row_all['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_all['cabang'] ?></td>
                  <td><?php echo $row_all['bagian'] ?></td>
                  <td><?php echo $row_all['jenis_biaya'] ?></td>
                  <td><?php echo $row_all['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_all['jumlah']+$row_all['ppn']-($row_all['pph23']+$row_all['pph42']+$row_all['pph21']),0,',','.') ?></td>
                  
                  <td>
                    <?php echo date('d-m-Y',strtotime($row_all['tanggal_proses_bayar'])) ?>
                    <br>
                    <?php echo $data_bayar['jam_proses_bayar'] ?>
                  </td>

                  <td>
                    <?php 
                      if($row_all['tanggal_bayar'] == '0000-00-00'){
                        echo '-';
                      }else{
                        echo date('d-m-Y',strtotime($row_all['tanggal_bayar']));
                        echo '<br>';
                        echo $data_bayar['jam_bayar'];
                      }
                    ?>
                  </td>

                  <?php if($row_all['status_dokumen']==''){ ?>
                    <td style="color: orange; font-weight: bold" width="12%">
                      Pending <br>
                      <!-- Cari Due Date -->
                      <?php
                        date_default_timezone_set("Asia/Jakarta");
                        $tanggal_bayar = $row_all['tanggal_bayar'];
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

                  <?php }elseif($row_all['status_dokumen']=='done'){ ?>

                    <td style="color: green; font-weight: bold" width="10%">
                      Diteruskan ke Accounting Oleh <?php echo $row_all['dept_tujuan'] ?>

                    </td>

                  <?php }elseif($row_all['status_dokumen']=='done acc'){ ?>

                    <td style="color: blue; font-weight: bold" width="10%">
                      Diterima Oleh Accounting <br>
                    </td>

                  <?php } ?>

                  
                  <td style="text-align: center;">

                    <a href="<?php echo base_url().'all_pengajuan_tanggal/detail/'.$row_all['id_pengajuan'] ?>" class="btn btn-warning btn-xs" target="_blank">
                      <i class="fa fa-eye"></i> Detail
                    </a>

                    <?php if($row_all['balik_lagi'] != 'Ya'){ ?>
                      
                      <!-- Cek Apakah Direksi -->
                      <?php if($level != 'Director'){ ?>
                        <a href="<?php echo base_url().'all_pengajuan_tanggal/jurnal_pic/'.$row_all['id_pengajuan'] ?>" class="btn btn-info btn-xs" target="_blank">
                          <i class="fa fa-list-alt"></i> Jurnal BMHD
                        </a>

                        <!-- Cek Apakah Ada Jurnal Reverse -->
                        <?php  
                          $no_pengajuan = $row_all['nomor_pengajuan'];
                          $cek = $this->db->query("SELECT * FROM tbl_jurnal_reverse WHERE nomor_pengajuan = '$no_pengajuan'")->num_rows();
                          if($cek>0){
                        ?>
                          <!-- <a href="<?php echo base_url().'all_pengajuan_tanggal/jurnal_reverse/'.$row_all['id_pengajuan'] ?>" class="btn btn-danger btn-xs" target="_blank">
                            <i class="fa fa-refresh"></i> Jurnal Reverse
                          </a> -->
                        <?php } ?>
                      <?php } ?> <!-- / Cek Direksi -->

                    <?php } ?>

                    <?php if($row_all['status_bayar'] == 'Telah Dibayar'){ ?>
                      <!-- Cek Apakah Direksi -->
                      <?php if($level != 'Director'){ ?>

                        <a style="margin-top: 5px" href="<?php echo base_url().'all_pengajuan_tanggal/jurnal_finance/'.$row_all['id_pengajuan'] ?>" class="btn btn-success btn-xs" target="_blank">
                          <i class="fa fa-list-alt"></i> Jurnal Payment
                        </a>
                        
                      <?php } ?> <!-- / Cek Apakah Direksi -->
                    <?php } ?>

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


  <!-- Modal Dokter -->
  <form action="<?php echo base_url().'all_pengajuan_tanggal/cetak_dok_terlambat' ?>" method="post" target="_blank">
  <div class="modal fade" id="modal-dokter">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cetak Dokumen Terlambat</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="cabang"></span> Pilih Cabang :</label>
            <select name="cabang" id="cabang" class="form-control">
              <option value="all">All Cabang</option>

              <?php foreach($data_cabang as $row_cabang){ ?>
                <option value="<?php echo $row_cabang['nama_cabang'] ?>">
                  <?php echo $row_cabang['nama_cabang'] ?> (<?php echo $row_cabang['kode_cabang'] ?>)
                </option>
              <?php } ?>

            </select>
          </div>

        </div> 
        <div class="modal-footer">

          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> 
            <i class="fa fa-times"></i> Batal
          </button>

          <button type="submit" class="btn btn-sm btn-success" id="tombol_cetak"> 
          <i class="fa fa-print"></i> Cetak
          </button>

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Dokter -->


  <script type="text/javascript">
    $(document).ready(function(){

      $('#tanggal_pengajuan').hide();
      $('#tanggal_approved').hide();
      $('#status_dokumen').hide();
      $('#tanggal_bmhd').hide();
      $('#tanggal_payment').hide();

      $(document).on('click', '#tombol1', function(){
        $('#tanggal_pengajuan').slideDown(1000);
        $('#tanggal_approved').hide();
        $('#status_dokumen').hide();
        $('#tanggal_bmhd').hide();
        $('#tanggal_payment').hide();
      });

      $(document).on('click', '#tombol2', function(){
        $('#tanggal_pengajuan').hide();
        $('#tanggal_approved').slideDown(1000);
        $('#status_dokumen').hide();
        $('#tanggal_bmhd').hide();
        $('#tanggal_payment').hide();
      });

      $(document).on('click', '#tombol3', function(){
        $('#tanggal_pengajuan').hide();
        $('#tanggal_approved').hide();
        $('#status_dokumen').slideDown(1000);
        $('#tanggal_bmhd').hide();
        $('#tanggal_payment').hide();
      });

      $(document).on('click', '#tombol4', function(){
        $('#tanggal_pengajuan').hide();
        $('#tanggal_approved').hide();
        $('#status_dokumen').hide();
        $('#tanggal_bmhd').slideDown(1000);
        $('#tanggal_payment').hide();
      });

      $(document).on('click', '#tombol5', function(){
        $('#tanggal_pengajuan').hide();
        $('#tanggal_approved').hide();
        $('#status_dokumen').hide();
        $('#tanggal_bmhd').hide();
        $('#tanggal_payment').slideDown(1000);
      });

    });
  </script>


  <!-- Script Tampil Pilihan Sort -->
  <script type="text/javascript">
    $(document).ready(function(){

      // Sort General
      function tampil_sort(){
        var sort_by = $('#sort_by').val();
        var sort_metode = $('#sort_metode');

        if(sort_by == 'tanggal'){
          sort_metode.empty();
          sort_metode.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="tanggal_asc" width="50">Dari Terlama ke Terbaru</option> <option value="tanggal_desc" width="50">Dari Terbaru ke Terlama</option>');
        }else{
          sort_metode.empty();
          sort_metode.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="jumlah_asc" width="50">Dari Terkecil Ke Terbesar</option> <option value="jumlah_desc" width="50">Dari Terbesar Ke Terkecil</option>');
        }
      }

      $(document).on('change', '#sort_by', function(){
        tampil_sort();
      });
      // Penutup Sort General


      // Sort Filter Tanggal
      function tampil_sort1(){
        var sort_by1 = $('#sort_by1').val();
        var sort_metode1 = $('#sort_metode1');

        if(sort_by1 == 'tanggal'){
          sort_metode1.empty();
          sort_metode1.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="ASC" width="50">Dari Terlama ke Terbaru</option> <option value="DESC" width="50">Dari Terbaru ke Terlama</option>');
        }else{
          sort_metode1.empty();
          sort_metode1.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="ASC" width="50">Dari Terkecil Ke Terbesar</option> <option value="DESC" width="50">Dari Terbesar Ke Terkecil</option>');
        }
      }

      $(document).on('change', '#sort_by1', function(){
        tampil_sort1();
      });
      // Penutup Sort Filter Tanggal


      // Sort Filter Status Dokumen
      function tampil_sort3(){
        var sort_by3 = $('#sort_by3').val();
        var sort_metode3 = $('#sort_metode3');

        if(sort_by3 == 'tanggal'){
          sort_metode3.empty();
          sort_metode3.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="ASC" width="50">Dari Terlama ke Terbaru</option> <option value="DESC" width="50">Dari Terbaru ke Terlama</option>');
        }else{
          sort_metode3.empty();
          sort_metode3.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="ASC" width="50">Dari Terkecil Ke Terbesar</option> <option value="DESC" width="50">Dari Terbesar Ke Terkecil</option>');
        }
      }

      $(document).on('change', '#sort_by3', function(){
        tampil_sort3();
      });
      // Penutup Sort Filter Status Dokumen

    });
  </script>


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