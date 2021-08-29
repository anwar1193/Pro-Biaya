  <?php  

    $nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
    $cabang = $this->libraryku->tampil_user()->cabang;
    $departemen = $this->libraryku->tampil_user()->departemen;
    $level = $this->libraryku->tampil_user()->level;

    // Mencari ID Split Pembayaran Terakhir untuk kemudian dipengaruhi/dikenakan potong pajak
    $nomor_pengajuan = $data_pengajuan['nomor_pengajuan'];
    $idsplit = $this->db->query("SELECT MAX(id) AS ids_terakhir FROM tbl_bayar WHERE nomor_pengajuan='$nomor_pengajuan'")->row_array();
    $ids_terakhir = $idsplit['ids_terakhir'];

  ?>
  <?php date_default_timezone_set("Asia/Jakarta"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Ambil Data Flashdata berhasil untuk kata sweet alert -->
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Pengajuan
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Pengajuan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-body">
              
              <div class="row">
                <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
                  
                  <h4 style="text-align: center;">Detail Pengajuan Biaya</h4>
                  <hr style="border-width: 2px; width: 200px">
                  
                  <table class="table">
                    <tr>
                      <th width="40%">Tanggal</th>
                      <th>:</th>
                      <td><?php echo date('d-m-Y', strtotime($data_pengajuan['tanggal'])) ?></td>
                    </tr>

                    <tr>
                      <th>Nomor Pengajuan</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['nomor_pengajuan'] ?></td>
                    </tr>

                    <tr>
                      <th>Nomor Invoice</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['nomor_invoice'] ?></td>
                    </tr>

                    <tr>
                      <th>Cabang</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['cabang'] ?></td>
                    </tr>

                    <tr>
                      <th>Bagian</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['bagian'] ?></td>
                    </tr>

                    <tr>
                      <th>Jenis Biaya</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['jenis_biaya'] ?></td>
                    </tr>

                    <tr>
                      <th>Sub Biaya</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['sub_biaya'] ?></td>
                    </tr>

                    <tr>
                      <th>Keterangan</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['keterangan'] ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">Jumlah (Sebelum Pajak)</th>
                      <th>:</th>
                      <td><?php echo number_format($data_pengajuan['jumlah'],0,',','.') ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">PPN</th>
                      <th>:</th>
                      <td><?php echo number_format($data_pengajuan['ppn'],0,',','.') ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">PPH23</th>
                      <th>:</th>
                      <td><?php echo number_format($data_pengajuan['pph23'],0,',','.') ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">PPH 4(2)</th>
                      <th>:</th>
                      <td><?php echo number_format($data_pengajuan['pph42'],0,',','.') ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">PPH 21</th>
                      <th>:</th>
                      <td><?php echo number_format($data_pengajuan['pph21'],0,',','.') ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">Total</th>
                      <th>:</th>
                      <td><?php echo number_format($data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']),0,',','.') ?></td>
                    </tr>

                    <tr>
                      <th>Bank Penerima</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['bank_penerima'] ?></td>
                    </tr>

                    <tr>
                      <th>Nomor Rekening</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['norek_penerima'] ?></td>
                    </tr>

                    <tr>
                      <th>Atas Nama</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['atas_nama'] ?></td>
                    </tr>

                    <!-- Data Perjalanan Dinas -->
                    <?php  
                      if($data_perdin['nama_pic'] != ''){
                    ?>

                    <tr style="background-color: orange">
                      <td colspan="3">
                        <b>Data Perjalanan Dinas</b>
                      </td>
                    </tr>

                    <tr>
                      <th>Nama PIC (Perjalanan Dinas)</th>
                      <th>:</th>
                      <td><?php echo $data_perdin['nama_pic'] ?></td>
                    </tr>

                    <tr>
                      <th>Lokasi Tujuan</th>
                      <th>:</th>
                      <td><?php echo $data_perdin['lokasi_tujuan'] ?></td>
                    </tr>

                    <tr>
                      <th>Tujuan Perjalanan Dinas</th>
                      <th>:</th>
                      <td><?php echo $data_perdin['tujuan_perdin'] ?></td>
                    </tr>

                    <tr>
                      <th>Tanggal Kunjungan</th>
                      <th>:</th>
                      <td><?php echo date('d-m-Y', strtotime($data_perdin['dari_tanggal'])) ?> s/d <?php echo date('d-m-Y', strtotime($data_perdin['ke_tanggal'])) ?></td>
                    </tr>

                    <tr>
                      <th>Lama Kunjungan</th>
                      <th>:</th>
                      <td><?php echo $data_perdin['lama_kunjungan'] ?></td>
                    </tr>

                    <tr>
                      <th>Transportasi Yang Digunakan</th>
                      <th>:</th>
                      <td><?php echo $data_perdin['transportasi_ket'] ?></td>
                    </tr>

                     <tr>
                      <th>Penginapan/Hotel</th>
                      <th>:</th>
                      <td><?php echo $data_perdin['penginapan_ket'] ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">Biaya Transportasi</th>
                      <th>:</th>
                      <td><?php echo number_format($data_perdin['transportasi'],0,'.',',') ?> (Diisi Oleh HRD)</td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">Biaya Penginapan</th>
                      <th>:</th>
                      <td><?php echo number_format($data_perdin['penginapan'],0,'.',',') ?> (Diisi Oleh HRD)</td>
                    </tr>

                    <!-- <tr>
                      <th style="text-align: right;">Biaya Makan</th>
                      <th>:</th>
                      <td><?php echo number_format($data_perdin['makan'],0,'.',',') ?></td>
                    </tr> -->

                    <tr>
                      <th style="text-align: right;">Biaya Lain-lain</th>
                      <th>:</th>
                      <td><?php echo number_format($data_perdin['lain_lain'],0, '.', ',') ?></td>
                    </tr>

                    <?php if($data_pengajuan['sub_biaya'] != 'Biaya Perjalanan Dinas'){ ?>
                      <tr>
                        <th>Jarak</th>
                        <th>:</th>
                        <td><?php echo $data_perdin['jarak'] ?></td>
                      </tr>

                      <tr>
                        <th>Nasabah</th>
                        <th>:</th>
                        <td>
                          <?php  
                            $nomor_pengajuan = $data_pengajuan['nomor_pengajuan'];
                            $q_nasabah = $this->db->query("SELECT * FROM tbl_nopin_perdin WHERE nomor_pengajuan='$nomor_pengajuan'");
                            $r_nasabah = $q_nasabah->result_array();
                          ?>
                            <table class="table table-bordered">
                              <tr style="background-color: orange">
                                <th>Nopin</th>
                                <th>Nama Nasabah</th>
                              </tr>
                            <?php foreach($r_nasabah as $row){ ?>
                              <tr>
                                <td><?php echo $row['nopin'] ?></td>
                                <td><?php echo $row['nama_nasabah'] ?></td>
                              </tr>
                            <?php } ?>
                            </table> 
                        </td>
                      </tr>
                    <?php } ?>

                    <?php } ?>

                    <!-- / Data Perjalanan Dinas -->

                    <!-- Data Pengajuan BBM -->
                    <?php  
                      $no_pengajuan = $data_pengajuan['nomor_pengajuan'];
                      $data_bbm = $this->db->query("SELECT * FROM tbl_pengajuan_bbm WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

                      if($data_bbm['nopol'] != ''){
                    ?>

                    <tr style="background-color: orange">
                      <td colspan="3">
                        <b>Data Pengajuan BBM</b>
                      </td>
                    </tr>

                    <tr>
                      <th>Nomor Polisi</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['nopol'] ?></td>
                    </tr>

                    <tr>
                      <th>Jenis Kendaraan</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['jenis_kendaraan'] ?></td>
                    </tr>

                    <tr>
                      <th>Merk Kendaraan</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['merk_kendaraan'] ?></td>
                    </tr>

                    <tr>
                      <th>Kapasitas Silinder</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['kapasitas_silinder'] ?></td>
                    </tr>

                    <tr>
                      <th>Kilometer Pengajuan</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['kilometer_pengajuan'] ?></td>
                    </tr>

                    <tr>
                      <th>Keperluan Pengajuan BBM</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['keperluan_pengajuan_bbm'] ?></td>
                    </tr>

                    <tr>
                      <th>Jenis BBM</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['jenis_bbm'] ?></td>
                    </tr>

                    <?php } ?>

                    <!-- / Data Pengajuan BBM -->

                    <tr>
                      <th>Berkas Pendukung</th>
                      <th>:</th>
                      <td>
                        <ul>
                          <?php foreach($data_file as $row_file){ ?>
                          <li>
                            <?php echo $row_file['nama_file'] ?>

                            <?php 
                              if(file_exists('file_upload/'.$row_file['file'])){
                            ?>

                              <a target="_blank" href="<?php echo base_url().'file_upload/'.$row_file['file'] ?>">Download</a>
                            
                            <?php }else{ ?>

                              <?php  
                                $nama_folder = substr($row_file['file'], 0, 10);
                              ?>

                              <a target="_blank" href="<?php echo base_url().'file_upload/'.$nama_folder.'/'.$row_file['file'] ?>">Download</a>

                            <?php } ?>

                          </li>
                          <?php } ?>
                        </ul>
                      </td>
                    </tr>

                    <!-- Data Split Pembayaran -->
                    <tr>
                      <th>Tipe Transaksi</th>
                      <th>:</th>
                      <td>
                        <?php 
                          if($frek_byr == '1'){
                            echo 'Biaya';
                          }else{
                            echo 'Uang Muka';
                          }
                        ?>
                      </td>
                    </tr>

                    <tr>
                      <th>Frekuensi Bayar</th>
                      <th>:</th>
                      <td><?php echo $frek_byr ?> Kali Pembayaran</td>
                    </tr>

                    <tr>
                      <th>Tanggal Bayar / Harga Diluar Pajak (PPN) </th>
                      <th>:</th>
                      <td>
                        
                        <?php if($frek_byr == 1){ //jika pembayaran hanya sekali ?>

                          <table border="1" style="border-collapse: collapse;" width="100%">
                            <tr>
                              <th>Bayar Ke</th>
                              <th>Tanggal Bayar</th>
                              <th>Jumlah Sblm Pajak</th>
                              <th>PPN</th>
                              <th>Total</th>
                              <th>Action</th>
                            </tr>

                            <?php 
                              $no=1;
                              foreach($data_byr as $row_byr){ 
                              //cari jumlah (diluar pajak)
                              $nopengajuan = $row_byr['nomor_pengajuan'];
                              $dt_jml = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$nopengajuan'")->row_array();
                              $jml_sblm_pajak = $dt_jml['jumlah'];
                            ?>
                              <tr>
                                <td style="text-align: center"><?php echo $no++; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row_byr['tanggal_minta_bayar'])) ?></td>
                                <td style="text-align: right;"><?php echo number_format($jml_sblm_pajak, 0, ',', '.') ?></td>
                                <td style="text-align: right;"><?php echo number_format($dt_jml['ppn'], 0, ',', '.') ?></td>
                                <td style="text-align: right;"><?php echo number_format($dt_jml['jumlah'] + $dt_jml['ppn'], 0, ',', '.') ?></td>
                                <td style="text-align: center;">
                                  <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit"
                                  data-id = "<?php echo $row_byr['id'] ?>"
                                  data-nopeng = "<?php echo $row_byr['nomor_pengajuan'] ?>"
                                  data-tanggal = "<?php echo $row_byr['tanggal_minta_bayar'] ?>"
                                  data-jumlah = "<?php echo $jml_sblm_pajak ?>"
                                  data-ppn = "<?php echo $dt_jml['ppn'] ?>"
                                  id="pilih_edit"
                                  >
                                    Ubah
                                  </button>
                                </td>
                              </tr>
                            <?php } ?>
                          </table>

                        <?php }else{ //jika pembayaran lebih dari sekali ?>

                          <table border="1" style="border-collapse: collapse;" width="100%;">
                            <tr>
                              <th>Pembayaran Ke</th>
                              <th>Tanggal Bayar</th>
                              <th>Jumlah Bayar</th>
                              <th>PPN</th>
                              <th>Total Bayar</th>
                              <th>Action</th>
                            </tr>

                            <?php 
                              $no=1;
                              foreach($data_byr2 as $row_byr2){
                            ?>
                            
                              <tr>
                                <td style="text-align: center"><?php echo $no++; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row_byr2['tanggal_minta_bayar'])) ?></td>
                                <td style="text-align: right;"><?php echo number_format($row_byr2['jumlah_bayar']-($row_byr2['pph23_bayar']+$row_byr2['pph42_bayar']+$row_byr2['pph21_bayar']), 0, ',', '.') ?></td>
                                <td style="text-align: right;"><?php echo number_format($row_byr2['ppn_bayar'], 0, ',', '.') ?></td>
                                <td style="text-align: right;"><?php echo number_format($row_byr2['jumlah_bayar'] + $row_byr2['ppn_bayar'] -($row_byr2['pph23_bayar']+$row_byr2['pph42_bayar']+$row_byr2['pph21_bayar']), 0, ',', '.') ?></td>

                                <td style="text-align: center;">
                                  <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit_multi"
                                  data-id_multi = "<?php echo $row_byr2['id'] ?>"
                                  data-nopeng_multi = "<?php echo $row_byr2['nomor_pengajuan'] ?>"
                                  data-tanggal_multi = "<?php echo $row_byr2['tanggal_minta_bayar'] ?>"
                                  data-jumlah_multi = "<?php echo $row_byr2['jumlah_bayar'] ?>"
                                  data-ppn_multi = "<?php echo $row_byr2['ppn_bayar'] ?>"
                                  id="pilih_edit_multi"
                                  >
                                    <!-- icon edit -->
                                    <i class="fa fa-edit"></i> Ubah
                                  </button>
                                </td>

                              </tr>

                            <?php } ?>

                            <!-- TOTAL TABEL -->
                            <tr>
                            
                              <td style="font-weight: bold; text-align: right;" colspan="2">TOTAL :</td>

                              <?php  
                                $nopeng_bayar = $data_pengajuan['nomor_pengajuan'];
                                $q_total = $this->db->query("SELECT 
                                  SUM(jumlah_bayar-pph23_bayar-pph42_bayar-pph21_bayar) AS total_bayar,
                                  SUM(ppn_bayar) AS total_ppn,
                                  SUM(jumlah_bayar+ppn_bayar-pph23_bayar-pph42_bayar-pph21_bayar) AS total_all
                                  FROM tbl_bayar WHERE nomor_pengajuan = '$nopeng_bayar'")->row_array();
                              ?>

                              <td style="text-align: right; font-weight: bold">
                                <?php echo number_format($q_total['total_bayar'], 0 , ',' , '.'); ?>
                              </td>

                              <td style="text-align: right; font-weight: bold">
                                <?php echo number_format($q_total['total_ppn'], 0 , ',' , '.'); ?>
                              </td>

                               <td style="text-align: right; font-weight: bold">
                                <?php echo number_format($q_total['total_all'], 0 , ',' , '.'); ?>
                              </td>

                            </tr>

                          </table>

                        <?php } ?>

                      </td>
                    </tr>
                    <!-- / Data Split Pembayaran -->

                    <tr>
                      <th>Tracking Approval</th>
                      <th>:</th>
                      <td>
                        <ul>
                          <?php foreach($data_approve_history as $row){ ?>

                            <?php if($row['status_approve'] == 'on proccess'){ ?>

                              <li style="color: blue; font-weight: bold; margin-bottom: 5px">
                                <?php echo $row['status_approve'] ?> 
                              <small>(on <?php echo date('d-m-Y',strtotime($row['tanggal'])) ?>)</small>
                              </li>

                            <?php }else if($row['status_approve'] == 'approved'){ ?>

                              <li style="color: green; font-weight: bold; margin-bottom: 5px">
                                <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?>
                                <small>(on <?php echo date('d-m-Y', strtotime($row['tanggal'])) ?>)</small>
                                <br>
                                :: <?php echo $row['nama_pengapprove'] ?> ::
                                <br>
                                Note : "<?php echo $row['note'] ?>"
                              </li>

                            <?php }else if($row['status_approve'] == 'final approved'){ ?>

                              <li style="color: green; font-weight: bold; margin-bottom: 5px">
                                <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?>
                                <small>(on <?php echo date('d-m-Y', strtotime($row['tanggal'])) ?>)</small>
                                <br>
                                :: <?php echo $row['nama_pengapprove'] ?> ::
                                <br>
                                Note : "<?php echo $row['note'] ?>"
                              </li>

                            <?php }else if($row['status_approve'] == 'revisi'){ ?>

                              <li style="color: orange; font-weight: bold; margin-bottom: 5px">
                                <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?>
                                <small>(on <?php echo date('d-m-Y', strtotime($row['tanggal'])) ?>)</small>
                                <br>
                                :: <?php echo $row['nama_pengapprove'] ?> ::
                                <br>
                                Note : "<?php echo $row['note'] ?>"
                              </li>

                            <?php }else if($row['status_approve'] == 'rejected'){ ?>

                              <li style="color: red; font-weight: bold; margin-bottom: 5px">
                                <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?>
                                <small>(on <?php echo date('d-m-Y', strtotime($row['tanggal'])) ?>)</small>
                                <br>
                                :: <?php echo $row['nama_pengapprove'] ?> ::
                                <br>
                                Note : "<?php echo $row['note'] ?>"
                              </li>

                            <?php } ?>

                          <?php } ?>
                        </ul>
                      </td>
                    </tr>

                    <?php if($data_pengajuan['alasan_pending'] != ''){ ?>
                      <tr>
                        <th>History Pending</th>
                        <th>:</th>
                        <td style="font-weight: bold; color: orange">
                          <ul>
                            <?php 
                              $no=1;
                              foreach($data_pending_history as $row_ph){ 
                            ?>
                            <li>
                              Pending Ke - <?php echo $no++; ?> (On <?php echo date('d-m-Y', strtotime($row_ph['tanggal'])) ?>) <br>
                              Alasan Pending : "<?php echo nl2br($row_ph['note']) ?>"
                            </li><br>
                            <?php } ?>
                          </ul>
                        </td>
                      </tr>
                    <?php } ?>

                  </table>

                </div>

              </div>

              <div class="row">
                <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
                  
                  <a href="<?php echo base_url().'p_review' ?>" class="btn btn-danger btn-xs">
                    <i class="fa fa-backward"></i> Kembali
                  </a>

                  <?php if($level=='Departement PIC'){ ?>

                    <?php if($data_pengajuan['cek_fisik'] == 'ya'){ ?>
                      <a href="#" data-toggle="modal" data-target="#modal-lanjut-item" class="btn btn-success btn-xs">
                        <i class="fa fa-check"></i> Verifikasi Item
                      </a>
                    <?php }elseif($data_pengajuan['cek_fisik'] == 'tidak'){ ?>
                      <?php if($data_pengajuan['form']=='Perdin'){ ?>
                        <a href="#" data-toggle="modal" data-target="#modal-lanjut-perdin" class="btn btn-success btn-xs">
                          <i class="fa fa-check"></i> Verifikasi Perdin
                        </a>
                      <?php }else{ ?>
                        <a href="#" data-toggle="modal" data-target="#modal-lanjut" class="btn btn-success btn-xs">
                          <i class="fa fa-check"></i> Verifikasi
                        </a>
                      <?php } ?>
                    <?php } ?>

                  <?php }elseif($level=='Department Head'){ ?>

                    <?php if($data_pengajuan['balik_lagi'] == 'Ya'){ ?>
                      <span style="font-weight: bold">Menunggu Approved Terakhir Karena Ada Kenaikan Harga</span>
                    <?php }else{ ?>
                      <a href="#" data-toggle="modal" data-target="#modal-lanjut-final" class="btn btn-success btn-xs">
                        <i class="fa fa-check"></i> Verifikasi
                      </a>
                    <?php } ?>

                  <?php } ?>

                  <?php if($level=='Departement PIC'){ ?>

                  <!-- <a href="#" data-toggle="modal" data-target="#modal-ubah-harga" class="btn btn-primary btn-xs">
                    <i class="fa fa-money"></i> Verifikasi + Ubah Harga
                  </a> -->

                  <a href="#" data-toggle="modal" data-target="#modal-pending" class="btn btn-warning btn-xs">
                    <i class="fa fa-exclamation"></i> Pending
                  </a>

                  <a target="_blank" href="<?php echo base_url().'p_review/pdf_pengajuan/'.$data_pengajuan['id_pengajuan'] ?>" class="btn btn-info btn-xs"><i class="fa fa-print"></i> Cetak Pengajuan</a>

                  <a href="#" data-toggle="modal" data-target="#tambah_dokumen" class="btn btn-primary btn-xs">
                    <i class="fa fa-plus"></i> Tambah Dokumen
                  </a>

                  <?php } ?>


                  <!-- Tombol Memo -->
                  <?php if($data_memo['nomor_memo'] != ''){ ?>
                    <span>
                      <button type="button" class="btn btn-facebook btn-xs" data-toggle="modal" data-target="#modal-memo">
                        <i class="fa fa-file"></i> Lihat Memo
                      </button>
                    </span>
                  <?php } ?>
                  <!-- Penutup Tombol Memo -->

                </div>
              </div>

              

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal Lanjut -->
  <form action="<?php echo base_url().'p_review/lanjut' ?>" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="modal-lanjut">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Proses Verifikasi</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">
          <input type="text" hidden name="nomor_pengajuan" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>">
          <input type="text" hidden name="kode_cashflow" value="<?php echo $data_pengajuan['kode_cashflow'] ?>">
          <input type="text" hidden name="sub_biaya" value="<?php echo $data_pengajuan['sub_biaya'] ?>">
          <input type="text" hidden name="nomor_jurnal" value="<?php echo $no_jurnal ?>">
          <input type="text" hidden name="ids_terakhir" value="<?php echo $ids_terakhir ?>">

         <!--  <div class="form-group">
            <label for="tanggal_bayar"></span> Tanggal Bayar :</label>
            <input type="date" name="tanggal_bayar" class="form-control input-sm" min="<?php echo date('Y-m-d') ?>" required>
          </div>

          <div class="form-group">
            <label for="cara_bayar"></span> Cara Bayar :</label>
            <select name="cara_bayar" class="form-control input-sm">
              <option value="Transfer">Transfer</option>
              <option value="Cash">Cash</option>
            </select>
          </div> -->

          <?php  
            if($data_pengajuan['ppn'] == 0){ //supaya antara yang diisi ppn di awal dan yang nggak,tidak kerok
          ?>
            <div class="form-group">
              <label for="tanggal_bayar"></span> Jumlah (Sebelum Pajak) :</label>
              <input type="number" name="jumlah" class="form-control input-sm" value="<?php echo $jml_split['jml_split'] ?>" id="jumlah" pattern="[1-9]{20}" readonly>
            </div>

          <?php }else{ ?>
            <div class="form-group">
              <label for="tanggal_bayar"></span> Jumlah (Sebelum Pajak) :</label>
              <input type="number" name="jumlah" class="form-control input-sm" value="<?php echo $data_pengajuan['jumlah'] ?>" id="jumlah" pattern="[1-9]{20}" readonly>
            </div>
          <?php } ?>

          <?php if($frek_byr == 1){ ?>

            <div class="form-group">
              <label for="ppn"></span> PPN :</label>
              <input type="number" name="ppn" class="form-control input-sm" value="<?php echo $data_pengajuan['ppn'] ?>" id="ppn" pattern="[1-9]{20}" readonly>
            </div>

          <?php }else{ ?>

            <div class="form-group">
              <label for="ppn"></span> PPN :</label>
              <input type="number" name="ppn" class="form-control input-sm" value="<?php echo $data_pengajuan['ppn'] ?>" id="ppn" pattern="[1-9]{20}" readonly>
            </div>

          <?php } ?>

          <input type="number" name="pph23" value="<?php echo $data_pengajuan['pph23'] ?>" id="pph23" pattern="[1-9]{20}" hidden>

          <input type="number" name="pph42" value="<?php echo $data_pengajuan['pph42'] ?>" id="pph42" pattern="[1-9]{20}" hidden>

          <input type="number" name="pph21" value="<?php echo $data_pengajuan['pph21'] ?>" id="pph21" pattern="[1-9]{20}" hidden>

          <div class="form-group">
            <?php  

              if($data_pengajuan['ppn'] == 0){
                $total_split = $jml_split['jml_split']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']);
              
              }else{
                $total_split = $data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']);
              }
              
            ?>
            <label for="total"></span> Total :</label>
            <input type="number" name="total" value="<?php echo $total_split ?>" id="total" hidden><br>

            <!-- Total Ada Separator Rupiah Nya -->
            <span id="total_rp" style="font-weight: bold; font-size: 20px; padding: 5px;">
              <?php echo number_format($total_split,0,'.',',') ?>
            </span>
          </div>

          <div class="form-group">
            <label>Keterangan (Jika Ada Kenaikan Harga) :</label>
            <textarea name="ket_balik" class="form-control"></textarea>
          </div>

          <!-- Loading Lanjut -->
          <img id="loadingLanjut" src="../../asset/gambar/loading3_baru.gif" alt="" width="280" style="opacity:0.7">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-success" id="tombol_verifikasi1"> Verifikasi</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Lanjut -->

  <!-- Modal Lanjut Item-->
  <form action="<?php echo base_url().'p_review/lanjut' ?>" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="modal-lanjut-item">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Proses Verifikasi</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">
          <input type="text" hidden name="nomor_pengajuan" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>">
          <input type="text" hidden name="kode_cashflow" value="<?php echo $data_pengajuan['kode_cashflow'] ?>">
          <input type="text" hidden name="sub_biaya" value="<?php echo $data_pengajuan['sub_biaya'] ?>">

          <input type="text" hidden name="nomor_jurnal" value="<?php echo $no_jurnal ?>">
          <input type="text" hidden name="ids_terakhir" value="<?php echo $ids_terakhir ?>">

          <!-- <div class="form-group">
            <label for="tanggal_bayar"></span> Tanggal Bayar :</label>
            <input type="date" name="tanggal_bayar" class="form-control input-sm" min="<?php echo date('Y-m-d') ?>" required>
          </div>

          <div class="form-group">
            <label for="cara_bayar"></span> Cara Bayar :</label>
            <select name="cara_bayar" class="form-control input-sm">
              <option value="Transfer">Transfer</option>
              <option value="Cash">Cash</option>
            </select>
          </div> -->

          <div class="form-group">
            <label for="files">Upload (Foto Barang, PO, Invoice, dll) :</label>
            <input type="file" name="files[]" class="form-control input-sm" multiple="" required>
          </div>

          <?php  
            if($data_pengajuan['ppn'] == 0){ //supaya antara yang diisi ppn di awal dan yang nggak,tidak kerok
          ?>
            <div class="form-group">
              <label for="tanggal_bayar"></span> Jumlah (Sebelum Pajak) :</label>
              <input type="number" name="jumlah" class="form-control input-sm" value="<?php echo $jml_split['jml_split'] ?>" id="jumlah" pattern="[1-9]{20}" readonly>
            </div>

          <?php }else{ ?>
            <div class="form-group">
              <label for="tanggal_bayar"></span> Jumlah (Sebelum Pajak) :</label>
              <input type="number" name="jumlah" class="form-control input-sm" value="<?php echo $data_pengajuan['jumlah'] ?>" id="jumlah" pattern="[1-9]{20}" readonly>
            </div>
          <?php } ?>

          <?php if($frek_byr == 1){ //jika pembayaran sekali bisa edit ppn ?>

            <div class="form-group">
              <label for="ppn"></span> PPN :</label>
              <input type="number" name="ppn" class="form-control input-sm" value="<?php echo $data_pengajuan['ppn'] ?>" id="ppn_item" pattern="[1-9]{20}">
            </div>

          <?php }else{ //jika pembayaran lebih dari sekali, disable edit ppn ?>

            <div class="form-group">
              <label for="ppn"></span> PPN :</label>
              <input type="number" name="ppn" class="form-control input-sm" value="<?php echo $data_pengajuan['ppn'] ?>" id="ppn_item" pattern="[1-9]{20}" readonly>
            </div>

          <?php } ?>

          <input type="number" name="pph23" value="<?php echo $data_pengajuan['pph23'] ?>" id="pph23_item" pattern="[1-9]{20}" hidden>

          <input type="number" name="pph42" value="<?php echo $data_pengajuan['pph42'] ?>" id="pph42_item" pattern="[1-9]{20}" hidden>

          <input type="number" name="pph21" value="<?php echo $data_pengajuan['pph21'] ?>" id="pph21_item" pattern="[1-9]{20}" hidden>

          <div class="form-group">
            <?php  

              if($data_pengajuan['ppn'] == 0){
                $total_split = $jml_split['jml_split']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']);
              
              }else{
                $total_split = $data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']);
              }
              
            ?>
            <label for="total"></span> Total :</label>
            <input type="number" name="total" value="<?php echo $total_split ?>" id="total_item" hidden><br>

            <!-- Total Ada Separator Rupiah Nya -->
            <span id="total_rp_item" style="font-weight: bold; font-size: 20px; padding: 5px;">
              <?php echo number_format($total_split,0,'.',',') ?>
            </span>
          </div>

          <div class="form-group">
            <label>Keterangan (Jika Ada Kenaikan Harga) :</label>
            <textarea name="ket_balik" class="form-control"></textarea>
          </div>

          <!-- Loading Lanjut Item -->
          <img id="loadingLanjutItem" src="../../asset/gambar/loading3_baru.gif" alt="" width="280" style="opacity:0.7">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-success" id="tombol_verifikasi2"> Verifikasi</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Lanjut Item-->


  <!-- Modal Lanjut Perdin-->
  <form action="<?php echo base_url().'p_review/lanjut_perdin' ?>" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="modal-lanjut-perdin">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Proses Verifikasi</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">
          <input type="text" hidden name="nomor_pengajuan" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>">
          <input type="text" hidden name="kode_cashflow" value="<?php echo $data_pengajuan['kode_cashflow'] ?>">
          <input type="text" hidden name="sub_biaya" value="<?php echo $data_pengajuan['sub_biaya'] ?>">

          <input type="text" hidden name="nomor_jurnal" value="<?php echo $no_jurnal ?>">

          <input type="text" hidden name="ids_terakhir" value="<?php echo $ids_terakhir ?>">

          <!-- <div class="form-group">
            <label for="tanggal_bayar"></span> Tanggal Bayar :</label>
            <input type="date" name="tanggal_bayar" class="form-control input-sm" min="<?php echo date('Y-m-d') ?>" required>
          </div>

          <div class="form-group">
            <label for="cara_bayar"></span> Cara Bayar :</label>
            <select name="cara_bayar" class="form-control input-sm">
              <option value="Transfer">Transfer</option>
              <option value="Cash">Cash</option>
            </select>
          </div>

          <div class="form-group">
            <label for="tipe_transaksi"></span> Tipe Transaksi :</label>
            <select name="tipe_transaksi" class="form-control input-sm">
              <option value="Biaya">Biaya</option>
              <option value="Uang Muka">Uang Muka</option>
            </select>
          </div> -->

          <div class="form-group">
            <label for="files">Upload (Invoice Tiket, Hotel, dll) :</label>
            <input type="file" name="files[]" class="form-control input-sm" multiple="">
          </div>

          <div class="form-group">
            <label for="tanggal_bayar"></span> Jumlah (Sebelum Pajak) :</label>
            <input type="number" name="jumlah" class="form-control input-sm" value="<?php echo $data_pengajuan['jumlah'] ?>" id="jumlah_perdin" readonly>
          </div>

          <div class="form-group">
            <label for="biaya_transportasi"></span> Harga Tiket (Transport) :</label>
            <input type="number" name="biaya_transportasi" class="form-control input-sm" id="ppn_perdin" pattern="[1-9]{20}" value="<?php echo $data_perdin['transportasi'] ?>" readonly>
          </div>

          <div class="form-group">
            <label for="biaya_penginapan"></span> Biaya Penginapan/Hotel :</label>
            <input type="number" name="biaya_penginapan" class="form-control input-sm" id="pph23_perdin" pattern="[1-9]{20}" value="<?php echo $data_perdin['penginapan'] ?>" readonly>
          </div>

          <div class="form-group">
            <label for="lain_lain"></span> Biaya Lain-lain :</label>
            <input type="number" name="lain_lain" class="form-control input-sm" id="pph42_perdin" pattern="[1-9]{20}" value="<?php echo $data_perdin['lain_lain'] ?>">
          </div>

          <div class="form-group">
            <label for="total"></span> Total :</label>
            <input type="number" name="total" value="<?php echo $data_pengajuan['total'] ?>" id="total_perdin" hidden><br>

            <!-- Total Ada Separator Rupiah Nya -->
            <span id="total_rp_perdin" style="font-weight: bold; font-size: 20px; padding: 5px;">
              <?php echo number_format($data_pengajuan['total'],0,'.',',') ?>
            </span>
          </div>

          <textarea hidden name="ket_balik"></textarea>

          <!-- Loading Lanjut Perdin -->
          <img id="loadingLanjutPerdin" src="../../asset/gambar/loading3_baru.gif" alt="" width="280" style="opacity:0.7">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-success" id="tombol_verifikasi3"> Verifikasi</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Lanjut Perdin-->


  <!-- Modal Lanjut Final-->
  <form action="<?php echo base_url().'p_review/verifikasi_final' ?>" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="modal-lanjut-final">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Proses Verifikasi</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">
          <input type="text" hidden name="nomor_pengajuan" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>
          ">
          <input type="text" hidden name="kode_cashflow" value="<?php echo $data_pengajuan['kode_cashflow'] ?>">
          <input type="text" hidden name="sub_biaya" value="<?php echo $data_pengajuan['sub_biaya'] ?>">
          <input type="date" hidden name="tanggal_bayar" value="<?php echo $data_check_pic['tanggal_bayar'] ?>">
          <input type="text" hidden name="total" value="<?php echo $data_pengajuan['total'] ?>">


          Saat anda malakukan verifikasi, maka pengajuan biaya ini akan diteruskan ke Finance Dept untuk proses Pembayaran.

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-success"> Verifikasi</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Lanut Final -->


  <!-- Modal Pending -->
  <form action="<?php echo base_url().'p_review/pending' ?>" method="post">
  <div class="modal fade" id="modal-pending">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Pending Pengajuan?</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="nomor_pengajuan" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <div class="form-group">
            <label for="alamat"></span> Alasan Pending :</label>
            <textarea class="form-control" name="note" id="note_pending" rows="5" required></textarea>
          </div>

          <!-- Loading Lanjut -->
          <img id="loadingPending" src="../../asset/gambar/loading3_baru.gif" alt="" width="280" style="opacity:0.7">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-warning" id="tombol_pending"> Pending Pengajuan</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Pending -->


  <!-- Modal Edit -->
  <form action="<?php echo base_url().'p_review/ubah_split' ?>" method="post">
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Tanggal Bayar</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="id" autocomplete="off" id="id_byr" hidden>
          <input type="text" name="nomor_pengajuan" autocomplete="off" id="no_peng" hidden="">

          <div class="form-group">
            <label for="tanggal_minta_bayar"></span> Tanggal Bayar :</label>
            <input type="date" name="tanggal_minta_bayar" class="form-control" autocomplete="off" id="tanggal_minta_bayar" required>
          </div>

          <div class="form-group">
            <label for="jumlah_bayar"></span> Jumlah Sebelum Pajak :</label>
            <input type="text" name="jumlah_bayar" class="form-control" autocomplete="off" id="jml_bayar">
          </div>

          <div class="form-group">
            <label for="ppn_bayar"></span> PPN :</label>
            <input type="text" name="ppn_bayar" class="form-control" autocomplete="off" id="ppn_bayar">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Data</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Edit -->


  <!-- Modal Edit Multi -->
  <form action="<?php echo base_url().'p_review/ubah_split_multi' ?>" method="post">
  <div class="modal fade" id="modal-edit_multi">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Tanggal Bayar</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="id" autocomplete="off" id="id_byr_multi" hidden>
          <input type="text" name="nomor_pengajuan" autocomplete="off" id="no_peng_multi" hidden="">

          <div class="form-group">
            <label for="tanggal_minta_bayar"></span> Tanggal Bayar :</label>
            <input type="date" name="tanggal_minta_bayar" class="form-control" autocomplete="off" id="tanggal_minta_bayar_multi" required>
          </div>

          <div class="form-group">
            <label for="jumlah_bayar"></span> Jumlah Sebelum Pajak :</label>
            <input type="text" name="jumlah_bayar" class="form-control" autocomplete="off" id="jml_bayar_multi">
          </div>

          <div class="form-group">
            <label for="ppn_bayar"></span> PPN :</label>
            <input type="text" name="ppn_bayar" class="form-control" autocomplete="off" id="ppn_bayar_multi">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Data</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Edit Multi -->



  <!-- Modal Ubah Harga-->
  <form action="<?php echo base_url().'p_review/lanjut' ?>" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="modal-ubah-harga">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Verifikasi (Ubah Harga)</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">
          <input type="text" hidden name="nomor_pengajuan" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>">
          <input type="text" hidden name="kode_cashflow" value="<?php echo $data_pengajuan['kode_cashflow'] ?>">
          <input type="text" hidden name="sub_biaya" value="<?php echo $data_pengajuan['sub_biaya'] ?>">

          <!-- <div class="form-group">
            <label for="tanggal_bayar"></span> Tanggal Bayar :</label>
            <input type="date" name="tanggal_bayar" class="form-control input-sm" min="<?php echo date('Y-m-d') ?>" required>
          </div>

          <div class="form-group">
            <label for="cara_bayar"></span> Cara Bayar :</label>
            <select name="cara_bayar" class="form-control input-sm">
              <option value="Transfer">Transfer</option>
              <option value="Cash">Cash</option>
            </select>
          </div> -->

          <div class="form-group">
            <label for="files">Upload (Foto Barang, PO, Invoice, dll) :</label>
            <input type="file" name="files[]" class="form-control input-sm" multiple="" required>
          </div>

          <div class="form-group">
            <label for="tanggal_bayar"></span> Jumlah (Sebelum Pajak) :</label>
            <input type="number" name="jumlah" class="form-control input-sm" value="<?php echo $data_pengajuan['jumlah'] ?>" id="jumlah_uh" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="ppn"></span> PPN :</label>
            <input type="number" name="ppn" class="form-control input-sm" value="<?php echo $data_pengajuan['ppn'] ?>" id="ppn_uh" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="pph23"></span> PPH23 :</label>
            <input type="number" name="pph23" class="form-control input-sm" value="<?php echo $data_pengajuan['pph23'] ?>" id="pph23_uh" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="pph42"></span> PPH4(2) :</label>
            <input type="number" name="pph42" class="form-control input-sm" value="<?php echo $data_pengajuan['pph42'] ?>" id="pph42_uh" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="pph21"></span> PPH21 :</label>
            <input type="number" name="pph21" class="form-control input-sm" value="<?php echo $data_pengajuan['pph21'] ?>" id="pph21_uh" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="total"></span> Total :</label>
            <input type="number" name="total" value="<?php echo $data_pengajuan['total'] ?>" id="total_uh" hidden><br>

            <!-- Total Ada Separator Rupiah Nya -->
            <span id="total_rp_uh" style="font-weight: bold; font-size: 20px; padding: 5px;">
              <?php echo number_format($data_pengajuan['total'],0,'.',',') ?>
            </span>
          </div>

          <div class="form-group">
            <label for="total"></span> Keterangan Ubah Harga :</label>
            <textarea class="form-control" name="ket_balik"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-success"> Verifikasi</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Ubah Harga-->


  <!-- Modal Tambah Dokumen -->
  <form action="<?php echo base_url().'p_review/tambah_dokumen' ?>" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="tambah_dokumen">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Dokumen</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="nomor_pengajuan" autocomplete="off" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>" hidden>
          <input type="text" name="ref_no" autocomplete="off" value="<?php echo $data_pengajuan['ref_no'] ?>" hidden>

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



  <!-- Script Jquery Edit Split Bayar -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih_edit', function(){

        var id = $(this).data('id');
        var no_peng = $(this).data('nopeng');
        var tanggal = $(this).data('tanggal');
        var jumlah = $(this).data('jumlah');
        var ppn = $(this).data('ppn');

        $('#id_byr').val(id);
        $('#no_peng').val(no_peng);
        $('#tanggal_minta_bayar').val(tanggal);
        $('#jml_bayar').val(jumlah);
        $('#ppn_bayar').val(ppn);
      });
    });
  </script>
  <!-- / Script Jquery Edit Split Bayar-->


  <!-- Script Jquery Edit Split Bayar Multi -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih_edit_multi', function(){

        var id = $(this).data('id_multi');
        var no_peng = $(this).data('nopeng_multi');
        var tanggal = $(this).data('tanggal_multi');
        var jumlah = $(this).data('jumlah_multi');
        var ppn = $(this).data('ppn_multi');

        $('#id_byr_multi').val(id);
        $('#no_peng_multi').val(no_peng);
        $('#tanggal_minta_bayar_multi').val(tanggal);
        $('#jml_bayar_multi').val(jumlah);
        $('#ppn_bayar_multi').val(ppn);
      });
    });
  </script>
  <!-- / Script Jquery Edit Split Bayar Multi-->


  <!-- Script Hitung Total Otomatis -->
  <script type="text/javascript">
    $(document).ready(function(){

      // Rubah format angka javascript
      function rubah(angka){
         var reverse = angka.toString().split('').reverse().join(''),
         ribuan = reverse.match(/\d{1,3}/g);
         ribuan = ribuan.join('.').split('').reverse().join('');
         return ribuan;
       }

      function hitung_otomatis(){
        var jumlah = $('#jumlah').val();
        var ppn = $('#ppn').val();
        var pph23 = $('#pph23').val();
        var pph42 = $('#pph42').val();
        var pph21 = $('#pph21').val();

        total = (jumlah*1) + (ppn*1) - ((pph23*1) + (pph42*1) + (pph21*1)); //perkalian salah satu trik biar angka bisa ditambah
        $('#total').val(total);
        $('#total_rp').text(rubah(total));
      }

      // Panggil fungsi ubah data (realtime) saat form (price_item, qty_item, discount_item) di ketik / di klik
      $(document).on('keyup mouseup', '#jumlah, #ppn, #pph23 , #pph42 , #pph21' , function(){
        hitung_otomatis();
      });


      function hitung_otomatis_perdin(){
        var jumlah_perdin = $('#jumlah_perdin').val();
        var ppn_perdin = $('#ppn_perdin').val();
        var pph23_perdin = $('#pph23_perdin').val();
        var pph42_perdin = $('#pph42_perdin').val();

        total_perdin = (ppn_perdin*1) + (pph23_perdin*1) + (pph42_perdin*1); //perkalian salah satu trik biar angka bisa ditambah
        $('#total_perdin').val(total_perdin);
        $('#total_rp_perdin').text(rubah(total_perdin));
      }

      // Panggil fungsi ubah data (realtime) saat form (price_item, qty_item, discount_item) di ketik / di klik
      $(document).on('keyup mouseup', '#jumlah_perdin, #ppn_perdin, #pph23_perdin , #pph42_perdin', function(){
        hitung_otomatis_perdin();
      });


      function hitung_otomatis_item(){
        var jumlah_item = $('#jumlah_item').val();
        var ppn_item = $('#ppn_item').val();
        var pph23_item = $('#pph23_item').val();
        var pph42_item = $('#pph42_item').val();
        var pph21_item = $('#pph21_item').val();

        total_item = (jumlah_item*1) + (ppn_item*1) - ((pph23_item*1) + (pph42_item*1) + (pph21_item*1)); //perkalian salah satu trik biar angka bisa ditambah
        $('#total_item').val(total_item);
        $('#total_rp_item').text(rubah(total_item));
      }

      // Panggil fungsi ubah data (realtime) saat form (price_item, qty_item, discount_item) di ketik / di klik
      $(document).on('keyup mouseup', '#jumlah_item, #ppn_item, #pph23_item, #pph42_item, #pph21_item', function(){
        hitung_otomatis_item();
      });



      function hitung_otomatis_uh(){
        var jumlah_uh = $('#jumlah_uh').val();
        var ppn_uh = $('#ppn_uh').val();
        var pph23_uh = $('#pph23_uh').val();
        var pph42_uh = $('#pph42_uh').val();
        var pph21_uh = $('#pph21_uh').val();

        total_uh = (jumlah_uh*1) + (ppn_uh*1) - ((pph23_uh*1) + (pph42_uh*1) + (pph21_uh*1)); //perkalian salah satu trik biar angka bisa ditambah
        $('#total_uh').val(total_uh);
        $('#total_rp_uh').text(rubah(total_uh));
      }

      // Panggil fungsi ubah data (realtime) saat form (price_uh, qty_uh, discount_uh) di ketik / di klik
      $(document).on('keyup mouseup', '#jumlah_uh, #ppn_uh, #pph23_uh, #pph42_uh, #pph21_uh', function(){
        hitung_otomatis_uh();
      });

    });
  </script>
  <!-- / Script Hitung Total Otomatis -->

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


  <!-- Modal Memo -->
  <div class="modal fade" id="modal-memo">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Memo Internal</h4>
          </div>
          <div class="modal-body">
  
            <table class="table table-striped">
              <tr>
                <th>Nomor Memo</th>
                <th>:</th>
                <td><?= $data_memo['nomor_memo'] ?></td>
              </tr>

              <tr>
                <th>Kepada</th>
                <th>:</th>
                <td><?= $data_memo['kepada'] ?></td>
              </tr>

              <tr>
                <th>CC</th>
                <th>:</th>
                <td><?= $data_memo['cc'] ?></td>
              </tr>

              <tr>
                <th>Dari</th>
                <th>:</th>
                <td><?= $data_memo['dari'] ?></td>
              </tr>

              <tr>
                <th>Perihal</th>
                <th>:</th>
                <td><?= $data_memo['perihal'] ?></td>
              </tr>

              <tr>
                <th>Tanggal</th>
                <th>:</th>
                <td><?= date('d-m-Y', strtotime($data_memo['tanggal_memo'])) ?></td>
              </tr>
            </table>

            <hr>

            Isi Memo :

            <?= $data_memo['isi_memo'] ?>

            <!-- Tracking Approval Memo -->
            <table class="table" style="margin-top:50px">
            <tr>
              <th>Approval Memo</th>
              <th>:</th>
              <td>
                <ul>
                  <?php foreach($data_approve_history as $row){ ?>

                    <?php if($row['status_approve'] == 'on proccess'){ ?>

                      <li style="color: blue; font-weight: bold; margin-bottom: 5px">
                        <?php echo $row['status_approve'] ?>
                      <small>(on <?php echo date('d-m-Y',strtotime($row['tanggal'])) ?>)</small>
                      </li>

                    <?php }else if($row['status_approve'] == 'approved'){ ?>

                      <li style="color: green; font-weight: bold; margin-bottom: 5px">
                        <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?>
                        <small>(on <?php echo date('d-m-Y', strtotime($row['tanggal'])) ?>)</small>
                        <br>
                        :: <?php echo $row['nama_pengapprove'] ?> ::
                        <br>
                        Note : "<?php echo $row['note'] ?>"
                      </li>

                    <?php }else if($row['status_approve'] == 'rejected'){ ?>

                      <li style="color: red; font-weight: bold; margin-bottom: 5px">
                        <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?>
                        <small>(on <?php echo date('d-m-Y', strtotime($row['tanggal'])) ?>)</small>
                        <br>
                        :: <?php echo $row['nama_pengapprove'] ?> ::
                        <br>
                        Note : "<?php echo $row['note'] ?>"
                      </li>

                    <?php }else if($row['status_approve'] == 'revisi'){ ?>

                      <li style="color: orange; font-weight: bold; margin-bottom: 5px">
                        <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?>
                        <small>(on <?php echo date('d-m-Y', strtotime($row['tanggal'])) ?>)</small>
                        <br>
                        :: <?php echo $row['nama_pengapprove'] ?> ::
                        <br>
                        Note : "<?php echo $row['note'] ?>"
                      </li>

                    <?php }else if($row['status_approve'] == 'final approved'){ ?>

                      <li style="color: green; font-weight: bold; margin-bottom: 5px">
                        <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?><br>
                        <small>(on <?php echo date('d-m-Y', strtotime($row['tanggal'])) ?>)</small>
                        <br>
                        :: <?php echo $row['nama_pengapprove'] ?> ::
                        <br>
                        Note : "<?php echo $row['note'] ?>"
                      </li>

                    <?php } ?>

                  <?php } ?>
                </ul>
              </td>
            </tr>
            </table>
            <!-- Penutup Tracking Approval Memo -->
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> 
              <i class="fa fa-times"></i> Close
            </button>

            <!-- Tombol Cetak Memo -->
            <a href="<?php echo base_url().'inquiry_all/cetak_memo/'.$data_pengajuan['id_pengajuan'] ?>" class="btn btn-success btn-sm pull-left" target="_blank">
              <i class="fa fa-print"></i> Cetak Memo
            </a>

          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- / Modal Memo -->


    <script>

      $(document).ready(function() {

        $('#loadingLanjut').hide();
        $('#loadingLanjutItem').hide();
        $('#loadingLanjutPerdin').hide();
        $('#loadingPending').hide();

        // Setelah tombol verifikasi di klik, tombol tsb menghilang
        $(document).on('click', '#tombol_verifikasi1', function(){
          $(this).hide();
          $('#loadingLanjut').show();
        });

        // Setelah tombol verifikasi di klik, tombol tsb menghilang
        $(document).on('click', '#tombol_verifikasi2', function(){
          $(this).hide();
          $('#loadingLanjutItem').show();
        });

        // Setelah tombol verifikasi di klik, tombol tsb menghilang
        $(document).on('click', '#tombol_verifikasi3', function(){
          $(this).hide();
          $('#loadingLanjutPerdin').show();
        });

        // Setelah tombol pending di klik, tombol tsb menghilang
        $(document).on('click', '#tombol_pending', function(){
          var note_pending = $('#note_pending').val();
          if(note_pending != ''){
            $(this).hide();
            $('#loadingPending').show();
          }  
        });

      });

    </script>