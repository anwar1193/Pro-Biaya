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
        Data Inquiry Pengajuan
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
              <h3 class="box-title">Inquiry Pengajuan (Cabang & Dept)</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div style="position: absolute; top:50px; right:20px;">
                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-dokter">
                  <i class="fa fa-print"></i> Cetak Dokumen Terlambat
                </a>
              </div>

              &nbsp; FILTER BY : 

              <button class="btn btn-info btn-sm" id="tombol1">Tanggal Pengajuan</button>
              <button class="btn btn-warning btn-sm" id="tombol2">Jenis Biaya</button>
              <button class="btn btn-success btn-sm" id="tombol3">Status Approval</button>
              <button class="btn btn-primary btn-sm" id="tombol4">Status Dokumen</button>
              <button class="btn btn-info btn-sm" id="tombol5">Cabang</button>
              <button class="btn btn-warning btn-sm" id="tombol6">Departemen</button>

              <!-- Reset Filter -->
              <form method="POST" action="<?php echo base_url().'inquiry_all' ?>" style="float: left;">
                <button type="submit" class="btn btn-danger btn-sm" name="reset_filter">
                  <i class="fa fa-refresh"></i> Reset Filter
                </button>
              </form>
              <!-- / Reset Filter -->

              <!-- Filter by Tanggal Pengajuan -->
              &nbsp;
              <div id="tanggal_pengajuan"><br>
              <form method="POST" action="<?php echo base_url().'inquiry_all' ?>">
                <table>
                  <tr>
                    <td>(FILTER By Tgl Pengajuan) - &nbsp;</td>

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

              <!-- Filter by Jenis Biaya -->
              <div id="jenis_biaya"><br>
              <form method="POST" action="<?php echo base_url().'inquiry_all' ?>">
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

                    <!-- Sort BY -->
                    <td>&nbsp;  Sort By : </td>
                    <td>
                        <select name="sort_by2" id="sort_by2">
                          <option width="50" value="id_pengajuan">- Pilih -</option>
                          <option value="tanggal" width="50">Tanggal Pengajuan</option>
                          <option value="total" width="50">Jumlah Biaya</option>
                        </select>

                        <select name="sort_metode2" id="sort_metode2">
                          <option width="50" value="DESC">- Pilih Metode Urutan -</option>
                        </select>
                    </td>  
                    <!-- / Sort By -->

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


              <!-- Filter by Status Approval -->
              <div id="status_approval"><br>
              <form method="POST" action="<?php echo base_url().'inquiry_all' ?>">
                <table>
                  <tr>
                    <td>(FILTER BY Status Approval) - &nbsp;&nbsp;</td>

                    <td>&nbsp; Status Approval :</td>
                    <td>
                      <select name="status_approval">
                        <option value="on proccess">On Proccess</option>
                        <option value="approved">Approved</option>
                        <option value="final approved">Final Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="revisi">Revisi</option>
                        <option value="cancel">Cancel</option>
                        <option value="cancel by request">Cancel By Request</option>
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
              <!-- Penutup Filter by Status Approval -->

              <!-- Filter by Status Dokumen -->
              <div id="status_dokumen"><br>
              <form method="POST" action="<?php echo base_url().'inquiry_all' ?>">
                <table>
                  <tr>
                    <td>(FILTER BY Status Dokumen) - &nbsp;&nbsp;</td>

                    <td>&nbsp; Status Dokumen :</td>
                    <td>
                      <select name="status_dokumen">
                        <option value="">Pending</option>
                        <option value="done">Done</option>
                      </select>
                    </td>

                    <!-- Sort BY -->
                    <td>&nbsp;  Sort By : </td>
                    <td>
                        <select name="sort_by4" id="sort_by4">
                          <option width="50" value="id_pengajuan">- Pilih -</option>
                          <option value="tanggal" width="50">Tanggal Pengajuan</option>
                          <option value="total" width="50">Jumlah Biaya</option>
                        </select>

                        <select name="sort_metode4" id="sort_metode4">
                          <option width="50" value="DESC">- Pilih Metode Urutan -</option>
                        </select>
                    </td>  
                    <!-- / Sort By -->

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data4">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>
              <!-- Penutup Filter by Status Dokumen -->

              <!-- Filter by Cabang -->
              <div id="cabang"><br>
              <form method="POST" action="<?php echo base_url().'inquiry_all' ?>">
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

                    <!-- Sort BY -->
                    <td>&nbsp;  Sort By : </td>
                    <td>
                        <select name="sort_by5" id="sort_by5">
                          <option width="50" value="id_pengajuan">- Pilih -</option>
                          <option value="tanggal" width="50">Tanggal Pengajuan</option>
                          <option value="total" width="50">Jumlah Biaya</option>
                        </select>

                        <select name="sort_metode5" id="sort_metode5">
                          <option width="50" value="DESC">- Pilih Metode Urutan -</option>
                        </select>
                    </td>  
                    <!-- / Sort By -->

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data5">
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
              <form method="POST" action="<?php echo base_url().'inquiry_all' ?>">
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

                    <!-- Sort BY -->
                    <td>&nbsp;  Sort By : </td>
                    <td>
                        <select name="sort_by6" id="sort_by6">
                          <option width="50" value="id_pengajuan">- Pilih -</option>
                          <option value="tanggal" width="50">Tanggal Pengajuan</option>
                          <option value="total" width="50">Jumlah Biaya</option>
                        </select>

                        <select name="sort_metode6" id="sort_metode6">
                          <option width="50" value="DESC">- Pilih Metode Urutan -</option>
                        </select>
                    </td>  
                    <!-- / Sort By -->

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data6">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>
              <!-- Penutup Filter by Departemen -->

              <hr style="border-color: orange; border-style: dashed;">

              <!-- Sort By -->
              <form method="post" action="<?php echo base_url().'inquiry_all' ?>" style="margin-top: 20px">
                
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
              <!-- / Sort By -->

              <br>

              <table id="tableDT" class="table table-bordered table-striped" style="margin-top: 10px">
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
                  <th style="text-align: center">Sts Approve</th>
                  <th style="text-align: center">Sts Check</th>
                  <th style="text-align: center">Sts Bayar</th>
                  <th style="text-align: center">Sts Dokumen</th>
                  <th style="text-align: center" width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_inquiry as $row_inquiry){
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_inquiry['tanggal'])) ?></td>
                  <td><?php echo $row_inquiry['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_inquiry['cabang'] ?></td>
                  <td><?php echo $row_inquiry['bagian'] ?></td>
                  <td><?php echo $row_inquiry['jenis_biaya'] ?></td>
                  <td><?php echo $row_inquiry['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_inquiry['jumlah']+$row_inquiry['ppn']-($row_inquiry['pph23']+$row_inquiry['pph42']+$row_inquiry['pph21']),0,',','.') ?></td>
                  
                  <!-- Kolom Status Approve -->
                  <?php if($row_inquiry['status_approve'] == 'on proccess'){ ?>

                    <td style="color: blue; font-weight: bold"><?php echo $row_inquiry['status_approve'] ?></td>

                  <?php }else if($row_inquiry['status_approve'] == 'approved'){ ?>

                    <td style="color: green; font-weight: bold">
                      <?php echo '- '.$row_inquiry['status_approve'].' by '.$row_inquiry['approved_by'].' -'.'<br>'.$row_inquiry['nama_pengapprove'] ?>
                    </td>

                  <?php }else if($row_inquiry['status_approve'] == 'final approved'){ ?>

                    <td style="color: green; font-weight: bold">
                      <?php echo '- '.$row_inquiry['status_approve'].' by '.$row_inquiry['approved_by'].' -'.'<br>'.$row_inquiry['nama_pengapprove'] ?>
                    </td>

                  <?php }else if($row_inquiry['status_approve'] == 'cancel' || $row_inquiry['status_approve'] == 'cancel by request'){ ?>

                    <td style="color: red; font-weight: bold">
                      <?php echo $row_inquiry['status_approve'] ?>
                    </td>

                  <?php }else if($row_inquiry['status_approve'] == 'rejected'){ ?>

                    <td style="color: red; font-weight: bold">
                      <?php echo '- '.$row_inquiry['status_approve'].' by '.$row_inquiry['approved_by'].' -'.'<br>'.$row_inquiry['nama_pengapprove'] ?>
                    </td>

                  <?php }else if($row_inquiry['status_approve'] == 'revisi'){ ?>

                    <td style="color: orange; font-weight: bold">
                      <?php echo '- '.$row_inquiry['status_approve'].' by '.$row_inquiry['approved_by'].' -'.'<br>'.$row_inquiry['nama_pengapprove'] ?>
                    </td>

                  <?php } ?>
                  <!-- / Kolom Status Approve -->


                  <!-- Kolom Status Check -->
                  <?php if($row_inquiry['status_approve'] != 'final approved'){ ?>

                      <td style="font-weight: bold">
                        -
                      </td>

                  <?php }else{ ?>

                    <?php if($row_inquiry['status_check'] == ''){ ?>
                      <td style="color: blue; font-weight: bold">
                        On Proccess
                      </td>
                    <?php }else if($row_inquiry['status_check'] == 'Checked'){ ?>
                      <td style="color: green; font-weight: bold">
                        <?php echo '- '.$row_inquiry['status_check'].' by '.$row_inquiry['checked_by'].' -'; ?>
                      </td>
                    <?php }else if($row_inquiry['status_check'] == 'Pending'){ ?>
                      <td style="color: orange; font-weight: bold">
                        <?php echo '- '.$row_inquiry['status_check'].' by '.$row_inquiry['checked_by'].' -'; ?>
                      </td>
                    <?php } ?>

                  <?php } ?>
                  <!-- / Kolom Status Check -->

                  <!-- Kolom Status Bayar -->
                  <?php if($row_inquiry['status_check'] == 'Checked'){ ?>

                    <?php if($row_inquiry['status_bayar'] == 'Telah Dibayar' || $row_inquiry['status_bayar'] == 'Proses Bayar'){ ?>
                      <td style="color: green; font-weight: bold">
                        <?php echo $row_inquiry['status_bayar'] ?>
                      </td>
                    <?php }else{ ?>
                      <td style="color: blue; font-weight: bold">
                        Proses Check
                      </td>
                    <?php } ?>

                  <?php }else{ ?>
                    <td style="color: blue; font-weight: bold">
                      -
                    </td>
                  <?php } ?>
                  <!-- / Kolom Status Bayar -->


                  <!-- Kolom Status Dokumen -->

                  <?php if($row_inquiry['status_dokumen']==''){ ?>
                    <td style="color: orange; font-weight: bold" width="12%">
                      Pending <br>
                      <!-- Cari Due Date -->
                      <?php
                        date_default_timezone_set("Asia/Jakarta");
                        $tanggal_bayar = $row_inquiry['tanggal_bayar'];
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
                  <?php }elseif($row_inquiry['status_dokumen']=='done'){ ?>

                    <td style="color: green; font-weight: bold" width="10%">
                      Diterima Oleh <?php echo $row_inquiry['dept_tujuan'] ?>
                    </td>

                  <?php }elseif($row_inquiry['status_dokumen']=='done acc'){ ?>

                    <td style="color: blue; font-weight: bold" width="10%">
                      Diterima Oleh Accounting <br>
                    </td>

                  <?php } ?>
                  <!-- / Kolom Status Dokumen -->


                  <!-- Kolom Action -->
                  <td style="text-align: center;">

                    <a href="<?php echo base_url().'inquiry_all/detail/'.$row_inquiry['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
                      <i class="fa fa-eye"></i> Detail
                    </a>

                    <?php if($level == 'admin'){ ?>
                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-cancel"
                    data-id = "<?php echo $row_inquiry['id_pengajuan'] ?>"
                    data-nopeng = "<?php echo $row_inquiry['nomor_pengajuan'] ?>"
                    data-status_bayar = "<?php echo $row_inquiry['status_bayar'] ?>"
                    id="pilih_cancel"
                    >
                      <i class="fa fa-times"></i> Cancel
                    </button>
                    <?php } ?>

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


  <!-- Modal Cancel -->
  <form action="<?php echo base_url().'inquiry_all/hapus' ?>" method="post">
  <div class="modal fade" id="modal-cancel">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cancel Pengajuan?</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="id" id="id" hidden>
          <input type="text" name="nomor_pengajuan" id="nopeng" hidden>
          <input type="text" name="status_bayar" id="status_bayar" hidden>

          <div class="form-group">
            <label for="alamat"></span> Alasan Cancel :</label>
            <textarea class="form-control" name="alasan_cancel" required></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-danger"> Cancel Pengajuan</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Cancel -->


  <!-- Modal Dokter -->
  <form action="<?php echo base_url().'inquiry_all/cetak_dok_terlambat' ?>" method="post" target="_blank">
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


  <!-- Script Jquery Cancel -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih_cancel', function(){

        var id = $(this).data('id');
        var nopeng = $(this).data('nopeng');
        var status_bayar = $(this).data('status_bayar');

        $('#id').val(id);
        $('#nopeng').val(nopeng);
        $('#status_bayar').val(status_bayar);
      });
    });
  </script>
  <!-- / Script Jquery Edit Split Bayar-->


  <script type="text/javascript">
    $(document).ready(function(){

      $('#tanggal_pengajuan').hide();
      $('#jenis_biaya').hide();
      $('#status_approval').hide();
      $('#status_dokumen').hide();
      $('#cabang').hide();
      $('#departemen').hide();

      $(document).on('click', '#tombol1', function(){
        $('#tanggal_pengajuan').slideDown(1000);
        $('#jenis_biaya').hide();
        $('#status_approval').hide();
        $('#status_dokumen').hide();
        $('#cabang').hide();
        $('#departemen').hide();
      });

      $(document).on('click', '#tombol2', function(){
        $('#tanggal_pengajuan').hide();
        $('#jenis_biaya').slideDown(1000);
        $('#status_approval').hide();
        $('#status_dokumen').hide();
        $('#cabang').hide();
        $('#departemen').hide();
      });

      $(document).on('click', '#tombol3', function(){
        $('#tanggal_pengajuan').hide();
        $('#jenis_biaya').hide();
        $('#status_approval').slideDown(1000);
        $('#status_dokumen').hide();
        $('#cabang').hide();
        $('#departemen').hide();
      });

      $(document).on('click', '#tombol4', function(){
        $('#tanggal_pengajuan').hide();
        $('#jenis_biaya').hide();
        $('#status_approval').hide();
        $('#status_dokumen').slideDown(1000);
        $('#cabang').hide();
        $('#departemen').hide();
      });

      $(document).on('click', '#tombol5', function(){
        $('#tanggal_pengajuan').hide();
        $('#jenis_biaya').hide();
        $('#status_approval').hide();
        $('#status_dokumen').hide();
        $('#cabang').slideDown(1000);
        $('#departemen').hide();
      });

      $(document).on('click', '#tombol6', function(){
        $('#tanggal_pengajuan').hide();
        $('#jenis_biaya').hide();
        $('#status_approval').hide();
        $('#status_dokumen').hide();
        $('#cabang').hide();
        $('#departemen').slideDown(1000);
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


      // Sort Filter Jenis Biaya
      function tampil_sort2(){
        var sort_by2 = $('#sort_by2').val();
        var sort_metode2 = $('#sort_metode2');

        if(sort_by2 == 'tanggal'){
          sort_metode2.empty();
          sort_metode2.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="ASC" width="50">Dari Terlama ke Terbaru</option> <option value="DESC" width="50">Dari Terbaru ke Terlama</option>');
        }else{
          sort_metode2.empty();
          sort_metode2.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="ASC" width="50">Dari Terkecil Ke Terbesar</option> <option value="DESC" width="50">Dari Terbesar Ke Terkecil</option>');
        }
      }

      $(document).on('change', '#sort_by2', function(){
        tampil_sort2();
      });
      // Penutup Sort Filter Jenis Biaya


      // Sort Filter Status Approval
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
      // Penutup Sort Filter Status Approval


      // Sort Filter Status Dokumen
      function tampil_sort4(){
        var sort_by4 = $('#sort_by4').val();
        var sort_metode4 = $('#sort_metode4');

        if(sort_by4 == 'tanggal'){
          sort_metode4.empty();
          sort_metode4.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="ASC" width="50">Dari Terlama ke Terbaru</option> <option value="DESC" width="50">Dari Terbaru ke Terlama</option>');
        }else{
          sort_metode4.empty();
          sort_metode4.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="ASC" width="50">Dari Terkecil Ke Terbesar</option> <option value="DESC" width="50">Dari Terbesar Ke Terkecil</option>');
        }
      }

      $(document).on('change', '#sort_by4', function(){
        tampil_sort4();
      });
      // Penutup Sort Filter Status Dokumen


      // Sort Filter Cabang
      function tampil_sort5(){
        var sort_by5 = $('#sort_by5').val();
        var sort_metode5 = $('#sort_metode5');

        if(sort_by5 == 'tanggal'){
          sort_metode5.empty();
          sort_metode5.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="ASC" width="50">Dari Terlama ke Terbaru</option> <option value="DESC" width="50">Dari Terbaru ke Terlama</option>');
        }else{
          sort_metode5.empty();
          sort_metode5.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="ASC" width="50">Dari Terkecil Ke Terbesar</option> <option value="DESC" width="50">Dari Terbesar Ke Terkecil</option>');
        }
      }

      $(document).on('change', '#sort_by5', function(){
        tampil_sort5();
      });
      // Penutup Sort Filter Cabang


      // Sort Filter Departemen
      function tampil_sort6(){
        var sort_by6 = $('#sort_by6').val();
        var sort_metode6 = $('#sort_metode6');

        if(sort_by6 == 'tanggal'){
          sort_metode6.empty();
          sort_metode6.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="ASC" width="50">Dari Terlama ke Terbaru</option> <option value="DESC" width="50">Dari Terbaru ke Terlama</option>');
        }else{
          sort_metode6.empty();
          sort_metode6.append('<option value="" width="50">Pilih Metode Urutan</option> <option value="ASC" width="50">Dari Terkecil Ke Terbesar</option> <option value="DESC" width="50">Dari Terbesar Ke Terkecil</option>');
        }
      }

      $(document).on('change', '#sort_by6', function(){
        tampil_sort6();
      });
      // Penutup Sort Filter Departemen

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