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
              <h3 class="box-title">Inquiry Pengajuan</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

              FILTER BY : 

              <button class="btn btn-info btn-sm" id="tombol1">Tanggal Pengajuan</button>
              <button class="btn btn-warning btn-sm" id="tombol2">Jenis Biaya</button>
              <button class="btn btn-success btn-sm" id="tombol3">Status Approval</button>
              <button class="btn btn-primary btn-sm" id="tombol4">Status Dokumen</button>

              <!-- Filter by Tanggal Pengajuan -->
              <div id="tanggal_pengajuan"><br>
              <form method="POST" action="<?php echo base_url().'inquiry_pengajuan' ?>">
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
              <form method="POST" action="<?php echo base_url().'inquiry_pengajuan' ?>">
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
              <form method="POST" action="<?php echo base_url().'inquiry_pengajuan' ?>">
                <table>
                  <tr>
                    <td>(FILTER BY Status Approval) - &nbsp;&nbsp;</td>

                    <td>&nbsp; Status Approval :</td>
                    <td>
                      <select name="status_approval">
                        <option value="on proccess">On Proccess</option>
                        <option value="final approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="revisi">Revisi</option>
                        <option value="cancel">Cancel</option>
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
              <form method="POST" action="<?php echo base_url().'inquiry_pengajuan' ?>">
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
              <!-- Penutup Filter by Status Approval -->

              <hr style="border-color: orange; border-style: dashed;">

              <!-- Sort By -->
              <form method="post" action="<?php echo base_url().'inquiry_pengajuan' ?>" style="margin-top: 20px">
                
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
                  <th>NO Invoice</th>
                  <th>Cabang</th>
                  <th>Bagian</th>
                  <th>Jenis Biaya</th>
                  <th>Sub Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th style="text-align: center">Sts Approve</th>
                  <th style="text-align: center" width="10%">Sts Check</th>
                  <th style="text-align: center">Sts Bayar</th>
                  <th style="text-align: center">Sts Dokumen</th>
                  <th style="text-align: center">Sts Penyelesaian</th>
                  <th style="text-align: center" width="15%">Action</th>
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
                  <td><?php echo $row_inquiry['nomor_invoice'] ?></td>
                  <td><?php echo $row_inquiry['cabang'] ?></td>
                  <td><?php echo $row_inquiry['bagian'] ?></td>
                  <td><?php echo $row_inquiry['jenis_biaya'] ?></td>
                  <td><?php echo $row_inquiry['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_inquiry['jumlah'] + $row_inquiry['ppn'] - $row_inquiry['pph23'] - $row_inquiry['pph42'] - $row_inquiry['pph21'],0,',','.') ?></td>
                  
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
                        On Proccess <br>
                        (<?php echo $row_inquiry['dept_tujuan'] ?>)
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
                      Diterima Oleh <?php echo $row_inquiry['dept_tujuan'] ?> <br>

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

                  <?php }elseif($row_inquiry['status_dokumen']=='done acc'){ ?>

                    <td style="color: blue; font-weight: bold" width="10%">
                      Diterima Oleh Accounting <br>
                    </td>

                  <?php } ?>
                  <!-- / Kolom Status Dokumen -->

                  <!-- Kolom Status Penyelesaian -->
                  <td style="text-align: center;">
                    <?php if($row_inquiry['status_dokumen'] == 'done acc'){ ?>
                      <span style="color:green; font-weight:bold">Selesai</span>
                    <?php }else{ ?>
                      <?php if($row_inquiry['jenis_penyelesaian_pengaju'] != ''){ ?>
                        <span style="color:blue; font-weight:bold">Telah Diajukan</span>
                      <?php }else{ ?>
                        <span>-</span>
                      <?php } ?>
                    <?php } ?>

                  </td>
                  <!-- / Kolom Status Penyelesaian -->


                  <!-- Kolom Action -->
                  <td style="text-align: center;">

                    <a href="<?php echo base_url().'inquiry_pengajuan/detail/'.$row_inquiry['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
                      <i class="fa fa-eye"></i> Detail
                    </a>

                    <?php if($row_inquiry['status_bayar'] == 'Telah Dibayar'){ ?>
                      <a href="<?php echo base_url().'inquiry_pengajuan/cetak_pengajuan/'.$row_inquiry['id_pengajuan'] ?>" class="btn btn-success btn-xs" target="_blank" style="margin-top: 5px;">
                        <i class="fa fa-print"></i> Cetak List Dokumen
                      </a>

                      <?php if($row_inquiry['jenis_penyelesaian_pengaju'] == '' AND $row_inquiry['status_dokumen'] != 'done acc' AND strtoupper(trim($row_inquiry['nomor_invoice'])) == 'ESTIMASI'){ ?>
                        <a href="#" data-toggle="modal" data-target="#ajukan_penyelesaian" class="btn btn-info btn-xs" style="margin-top: 5px;"
                          id="pilih_penyelesaian"
                          data-nomor_pengajuan="<?php echo $row_inquiry['nomor_pengajuan'] ?>"
                        >
                          <i class="fa fa-check"></i> Ajukan Penyelesaian
                        </a>
                      <?php } ?>

                    <?php }else{ ?>

                      <a href="#" class="btn btn-default btn-xs" disabled style="margin-top: 5px;">
                        <i class="fa fa-print"></i> Cetak List Dokumen
                      </a>

                      <a href="#" class="btn btn-default btn-xs" style="margin-top: 5px;" disabled>
                        <i class="fa fa-check"></i> Ajukan Penyelesaian
                      </a>

                    <?php } ?>

                    <a href="#" data-toggle="modal" data-target="#tambah_dokumen" class="btn btn-primary btn-xs" style="margin-top: 5px;"
                        id="pilih_tambah_dokumen"
                        data-nomor_pengajuan="<?php echo $row_inquiry['nomor_pengajuan'] ?>"
                        data-ref_no="<?php echo $row_inquiry['ref_no'] ?>"
                      >
                      <i class="fa fa-plus"></i> Tambah Dokumen
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


  <!-- Modal Cancel -->
  <form action="<?php echo base_url().'p_on_proccess/hapus' ?>" method="post">
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
  

  <!-- Modal Tambah Dokumen -->
  <form action="<?php echo base_url().'inquiry_pengajuan/tambah_dokumen' ?>" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="tambah_dokumen">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Dokumen</h4>
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


  <!-- Modal Ajukan Penyelesaian -->
  <form action="<?php echo base_url().'inquiry_pengajuan/ajukan_penyelesaian' ?>" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="ajukan_penyelesaian">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ajukan Penyelesaian</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="nomor_pengajuan" autocomplete="off" id="nomor_pengajuan2" hidden>

          <div class="form-group">
            <label for="jenis_penyelesaian">Jenis Penyelesaian :</label>
            <select name="jenis_penyelesaian" id="jenis_penyelesaian" class="form-control" required="">
              <option value="">-Pilih-</option>
              <option value="kelebihan">Kelebihan</option>
              <option value="kekurangan">Kekurangan</option>
            </select>
          </div>

          <div class="form-group">
            <label for="note_penyelesaian">Note Penyelesaian :</label>
            <textarea name="note_penyelesaian" class="form-control" required=""></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Ajukan Penyelesaian</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Ajukan Penyelesaian -->


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


  <script type="text/javascript">
    $(document).ready(function(){

      $('#tanggal_pengajuan').hide();
      $('#jenis_biaya').hide();
      $('#status_approval').hide();
      $('#status_dokumen').hide();

      $(document).on('click', '#tombol1', function(){
        $('#tanggal_pengajuan').slideDown(1000);
        $('#jenis_biaya').hide();
        $('#status_approval').hide();
        $('#status_dokumen').hide();
      });

      $(document).on('click', '#tombol2', function(){
        $('#tanggal_pengajuan').hide();
        $('#jenis_biaya').slideDown(1000);
        $('#status_approval').hide();
        $('#status_dokumen').hide();
      });

      $(document).on('click', '#tombol3', function(){
        $('#tanggal_pengajuan').hide();
        $('#jenis_biaya').hide();
        $('#status_approval').slideDown(1000);
        $('#status_dokumen').hide();
      });

      $(document).on('click', '#tombol4', function(){
        $('#tanggal_pengajuan').hide();
        $('#jenis_biaya').hide();
        $('#status_approval').hide();
        $('#status_dokumen').slideDown(1000);
      });

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

    });
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