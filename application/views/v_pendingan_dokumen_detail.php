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

    <!-- Ambil Data Flashdata untuk kata sweet alert -->
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>
    
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
                <?php if($data_pengajuan['form'] == 'Kendaraan'){ ?>
                  <div class="col-sm-8 col-sm-offset-2" style="border:1px dotted gray; padding: 10px;">
                <?php }else{ ?>
                  <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
                <?php } ?>
                  
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
                      <td>
                        <?php echo number_format($data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']),0,',','.') ?>

                        <input type="text" id="total_biaya" value="<?php echo $data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']) ?>" hidden>
                      </td>
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
                      <td><?php echo number_format($data_perdin['transportasi'],0,',','.') ?> (Diisi Oleh HRD)</td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">Biaya Penginapan</th>
                      <th>:</th>
                      <td><?php echo number_format($data_perdin['penginapan'],0,',','.') ?> (Diisi Oleh HRD)</td>
                    </tr>

                    <!-- <tr>
                      <th style="text-align: right;">Biaya Makan</th>
                      <th>:</th>
                      <td><?php echo number_format($data_perdin['makan'],0,',','.') ?></td>
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
                      <th>Status Kendaraan</th>
                      <th>:</th>
                      <td>
                        <?php  
                          $nopol = $data_bbm['nopol'];
                          // cek apakah nopol ada di dalam list kendaraan operasional
                          $cek_kendaraan = $this->M_master->tampil_data_where('tbl_kendaraan', array('nopol' => $nopol))->num_rows();
                          if($cek_kendaraan > 0){
                            echo 'Kendaraan Operasional';
                          }else{
                            echo 'Kendaraan Pribadi';
                          }
                        ?>
                      </td>
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

                    <!-- Data Perbaikan Kendaraan -->

                    <?php  
                      $data_perbaikan_kendaraan = $this->M_master->tampil_data_where('tbl_pengajuan_kendaraan', array('nomor_pengajuan' => $no_pengajuan))->row_array();

                      $data_sparepart = $this->M_master->tampil_data_where('tbl_rincian_sparepart', array('nomor_pengajuan' => $no_pengajuan))->result_array();

                      $data_jasa_perbaikan = $this->M_master->tampil_data_where('tbl_rincian_jasa_perbaikan', array('nomor_pengajuan' => $no_pengajuan))->result_array();

                      $nopol_perbaikan = $data_perbaikan_kendaraan['nopol_perbaikan'];

                      if($nopol_perbaikan != ''){
                    ?>

                      <tr style="background-color: orange">
                        <td colspan="3">
                          <b>Data Perbaikan Kendaraan Inventaris</b>
                        </td>
                      </tr>

                      <tr>
                        <th>Nomor Polisi</th>
                        <th>:</th>
                        <td><?php echo $data_perbaikan_kendaraan['nopol_perbaikan'] ?></td>
                      </tr>

                      <tr>
                        <th>Merk Kendaraan</th>
                        <th>:</th>
                        <td><?php echo $data_perbaikan_kendaraan['merk_kendaraan'] ?></td>
                      </tr>

                      <tr>
                        <th>Kilometer Saat Pengajuan</th>
                        <th>:</th>
                        <td><?php echo $data_perbaikan_kendaraan['kilometer_pengajuan'] ?></td>
                      </tr>

                      <tr>
                        <th>Rincian Sparepart</th>
                        <th>:</th>
                        <td>
                            <table class="table table-bordered" width="100%">
                              <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Nama Sparepart</th>
                                <th class="text-center">Harga Sparepart</th>
                                <th class="text-center">Jenis Sparepart</th>
                              </tr>

                              <?php 
                                $no=1;
                                $total_jumlah_sparepart = 0;
                                foreach($data_sparepart as $row){ 
                                  $total_jumlah_sparepart += $row['jumlah_sparepart'];
                              ?>
                              <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo $row['sparepart'] ?></td>
                                <td class="text-right"><?php echo number_format($row['jumlah_sparepart'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                  <?php 
                                    if($row['keterangan_sparepart'] == '-'){
                                      echo '(Diisi Reviewer)';
                                    }else{
                                      echo $row['keterangan_sparepart'];
                                    }
                                  ?>
                                </td>
                              </tr>
                              <?php } ?>

                              <tr style="font-weight:bold">
                                <td colspan="2" class="text-right">TOTAL :</td>
                                <td class="text-right"><?php echo number_format($total_jumlah_sparepart, 0, ',', '.') ?></td>
                              </tr>
                            </table>
                        </td>
                      </tr>

                      <tr>
                        <th>Diskon Sparepart</th>
                        <th>:</th>
                        <td><?php echo number_format($data_perbaikan_kendaraan['diskon_sparepart'], 0 , ',', '.') ?></td>
                      </tr>

                      <tr>
                        <th>Rincian Jasa Perbaikan</th>
                        <th>:</th>
                        <td>
                            <table class="table table-bordered">
                              <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Nama Jasa</th>
                                <th class="text-center">Biaya Jasa</th>
                                <th class="text-center">Jenis Jasa</th>
                              </tr>

                              <?php 
                                $no=1;
                                $total_jumlah_jasa = 0;
                                foreach($data_jasa_perbaikan as $row){ 
                                  $total_jumlah_jasa += $row['jumlah_jasa'];
                              ?>
                              <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo $row['jasa'] ?></td>
                                <td class="text-right"><?php echo number_format($row['jumlah_jasa'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                  <?php 
                                    if($row['keterangan_jasa'] == '-' || $row['keterangan_jasa'] == ''){
                                      echo '(Diisi Reviewer)';
                                    }else{
                                      echo $row['keterangan_jasa'];
                                    }
                                  ?>
                                </td>
                              </tr>
                              <?php } ?>

                              <tr style="font-weight:bold">
                                <td colspan="2" class="text-right">TOTAL :</td>
                                <td class="text-right"><?php echo number_format($total_jumlah_jasa, 0, ',', '.') ?></td>
                              </tr>
                            </table>
                        </td>
                      </tr>

                      <tr>
                        <th>Diskon Jasa Perbaikan</th>
                        <th>:</th>
                        <td><?php echo number_format($data_perbaikan_kendaraan['diskon_jasa'], 0 , ',', '.') ?></td>
                      </tr>
                      
                    <?php } ?>
                    <!-- / Data Perbaikan Kendaraan -->
                    
                    <tr>
                      <th><span id="berkas_pendukung">Berkas Pendukung</span></th>
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
                            
                            <br>

                            Sts Doc :

                            <?php if($row_file['status']==''){ ?>
                              <span style="color: orange; font-weight: bold;">Pending</span> 

                              <form method="post" action="<?php echo base_url().'pendingan_dokumen/check_dokumen' ?>">

                                <input type="text" hidden name="id_pengajuan" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">
                                <input type="text" hidden name="nomor_pengajuan" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>">
                                <input type="text" hidden name="id_file" value="<?php echo $row_file['id'] ?>">

                                <button type="submit" name="submit" class="btn btn-success btn-xs">
                                  <i class="fa fa-check"></i> Ok</button>

                                <button type="submit" name="reject" class="btn btn-danger btn-xs">
                                  <i class="fa fa-times"></i> Reject</button>

                              </form>

                            <?php }elseif($row_file['status']=='Reject'){ ?>
                              <span style="color: red; font-weight: bold;">Reject</span>
                            <?php }else{ ?>
                              <span style="color: green; font-weight: bold;">Done</span>
                            <?php } ?>

                          </li>
                          <?php } ?>
                        </ul>

                        <!-- Tampilkan jika ada request tambah dokumen -->
                        <?php if($data_pengajuan['tambah_dokumen'] == 'ya'){ ?>
                          <span style="color: green; font-weight: bold;">
                            - Request Tambah Dokumen Terkirim (By <?php echo $data_pengajuan['tambah_dokumen_pic'] ?> ) - 
                          </span>
                        <?php }elseif($data_pengajuan['tambah_dokumen'] == 'dikirim'){ ?>
                          <span style="color: green; font-weight: bold;">
                            - Dokumen Tambahan Telah Dikirim Pengaju - 
                          </span>
                        <?php } ?>

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
                      <th>Tanggal Bayar</th>
                      <th>:</th>
                      <td>
                        
                        <table class="table table-bordered" width="100%">
                          <tr>
                            <th style="text-align: center">Pembayaran Ke</th>
                            <th style="text-align: center">Tanggal Bayar</th>
                            <th style="text-align: center">Jumlah</th>
                            <th style="text-align: center">PPN</th>
                            <th style="text-align: center">Total</th>
                          </tr>

                          <?php if($frek_byr == 1){ //jika bayar sekali, panggil dari tbl_pengajuan?>

                            <tr>
                              <td style="text-align: center"><?php echo '1'; ?></td>
                              <td><?php echo date('d-m-Y', strtotime($data_byr['tanggal_minta_bayar'])) ?></td>
                              <td style="text-align: right;"><?php echo number_format($data_byr['jumlah']-($data_byr['pph23']+$data_byr['pph42']+$data_byr['pph21']), 0, ',', '.') ?></td>
                              <td style="text-align: right;"><?php echo number_format($data_byr['ppn'], 0, ',', '.') ?></td>

                              <td style="text-align: right;">
                                <?php echo number_format($data_byr['jumlah']+$data_byr['ppn']-($data_byr['pph23']+$data_byr['pph42']+$data_byr['pph21']), 0, ',', '.') ?>
                              </td>
                            </tr>

                          <?php }else{ //jika bayar lebih dari sekali, panggil dari tbl_bayar ?>

                            <?php 
                              $no=1;
                              foreach($data_byr2 as $row_byr2){
                            ?>
                            
                              <tr>
                                <td style="text-align: center"><?php echo $no++; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row_byr2['tanggal_minta_bayar'])) ?></td>

                                <td style="text-align: right;"><?php echo number_format($row_byr2['jumlah_bayar']-($row_byr2['pph23_bayar']+$row_byr2['pph42_bayar']+$row_byr2['pph21_bayar']), 0, ',', '.') ?></td>
                                <td style="text-align: right;"><?php echo number_format($row_byr2['ppn_bayar'], 0, ',', '.') ?></td>
                                <td style="text-align: right;"><?php echo number_format($row_byr2['jumlah_bayar']+$row_byr2['ppn_bayar']-($row_byr2['pph23_bayar']+$row_byr2['pph42_bayar']+$row_byr2['pph21_bayar']), 0, ',', '.') ?></td>
                              </tr>

                            <?php } ?>

                            <!-- TOTAL TABEL -->
                            <?php  
                              $nopeng_bayar = $data_pengajuan['nomor_pengajuan'];
                              $q_total = $this->db->query("SELECT 
                                SUM(jumlah_bayar-pph23_bayar-pph42_bayar-pph21_bayar) AS total_jumlah, 
                                SUM(ppn_bayar) AS total_ppn, 
                                SUM(jumlah_bayar+ppn_bayar-pph23_bayar-pph42_bayar-pph21_bayar) AS total_bayar 
                                FROM tbl_bayar WHERE nomor_pengajuan = '$nopeng_bayar'")->row_array();
                            ?>
                            
                            <tr>
                              <td style="font-weight: bold; text-align: right;" colspan="2">TOTAL :</td>
                              <td style="text-align: right; font-weight: bold">
                                <?php echo number_format($q_total['total_jumlah'], 0 , ',' , '.');?>
                              </td>

                              <td style="text-align: right; font-weight: bold">
                                <?php echo number_format($q_total['total_ppn'], 0 , ',' , '.');?>
                              </td>

                              <td style="text-align: right; font-weight: bold">
                                <?php echo number_format($q_total['total_bayar'], 0 , ',' , '.');?>
                              </td>
                            </tr>

                          <?php } // penutup jika bayar sekali / lebih dari sekali ?>

                        </table>

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
                                :: 
                                  <?php echo $row['nama_pengapprove'] ?> 
                                  <?php if($row['status_alternate'] == 'alternate'){ ?>
                                    (USER ALTERNATE)
                                  <?php } ?>
                                ::
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

                     <tr>
                      <th>Status Check (By PIC Dept)</th>
                      <th>:</th>
                      <td>
                        <ul>
                          <?php if($data_pengajuan['status_check'] == 'Checked'){ ?>

                            <li style="color: green; font-weight: bold; margin-bottom: 5px">
                              <?php echo $data_pengajuan['status_check'] ?> by <?php echo $data_pengajuan['checked_by'] ?> <br>
                              <small>(on <?php echo date('d-m-Y', strtotime($data_pengajuan['checked_on'])) ?>)</small>
                            </li>

                          <?php }elseif($data_pengajuan['status_check'] == 'Pending'){ ?>

                            <li style="color: orange; font-weight: bold; margin-bottom: 5px">
                              <?php echo $data_pengajuan['status_check'] ?> by <?php echo $data_pengajuan['checked_by'] ?> <br>
                              <small>(on <?php echo date('d-m-Y', strtotime($data_pengajuan['checked_on'])) ?>)</small>
                              <br>
                              Note : "<?php echo $data_pengajuan['alasan_pending'] ?>"
                            </li>
                            
                          <?php } ?>
                        </ul>
                      </td>
                    </tr>

                    <!-- Data Penyelesaian Request Pengaju -->
                    <?php
                      $no_invoice = strtoupper(trim($data_pengajuan['nomor_invoice']));
                      if($no_invoice == 'ESTIMASI'){ 
                    ?>
                    <tr style="background-color: orange">
                      <td colspan="3">
                        <b>PENYELESAIAN (REQUEST PENGAJU)</b>
                      </td>
                    </tr>

                    <tr>
                      <th>Jenis Penyelesaian</th>
                      <th>:</th>
                      <td>
                        <span style="font-weight:bold"><?php echo $data_pengajuan['jenis_penyelesaian_pengaju'] ?></span>
                      </td>
                    </tr>

                    <tr>
                      <th>Note Penyelesaian</th>
                      <th>:</th>
                      <td>
                        <?php if($data_pengajuan['note_penyelesaian_pengaju']==''){ ?>
                          <span>-</span>
                        <?php }else{ ?>
                          <span><?php echo $data_pengajuan['note_penyelesaian_pengaju'] ?></span>
                        <?php } ?>
                      </td>
                    </tr>
                    <!-- Data Penyelesaian Request Pengaju -->

                    <!-- Data Penyelesaian -->
                    <tr style="background-color: orange">
                      <td colspan="3">
                        <b>PENYELESAIAN (REVIEWER)</b>
                      </td>
                    </tr>

                    <tr>
                      <th>Status Penyelesaian</th>
                      <th>:</th>
                      <td>
                        <?php if($data_pengajuan['note_penyelesaian']==''){ ?>
                          <span style="font-weight:bold">Belum Di Proses</span>
                        <?php }else{ ?>
                          <span style="font-weight:bold">On Proccess</span>
                        <?php } ?>
                      </td>
                    </tr>

                    <tr>
                      <th>Nominal Penyelesaian</th>
                      <th>:</th>
                      <td>
                        Rp. <?php echo number_format($data_pengajuan['nominal_penyelesaian_reviewer'], 0, '.', ',') ?>
                      </td>
                    </tr>

                    <tr>
                      <th>Jenis Penyelesaian</th>
                      <th>:</th>
                      <td>
                        <?php if($data_pengajuan['jenis_penyelesaian'] != ''){ ?>
                          <span style="font-weight:bold"><?php echo $data_pengajuan['jenis_penyelesaian'] ?></span>
                        <?php }else{ ?>
                          <span style="font-weight:bold">-</span>
                        <?php } ?>
                        
                      </td>
                    </tr>

                    <tr>
                      <th>Note Penyelesaian</th>
                      <th>:</th>
                      <td>
                        <?php if($data_pengajuan['note_penyelesaian']==''){ ?>
                          <span>-</span>
                        <?php }else{ ?>
                          <span><?php echo $data_pengajuan['note_penyelesaian'] ?></span>
                        <?php } ?>
                      </td>
                    </tr>
                    <!-- Data Penyelesaian -->

                    <?php } ?>

                  </table>

                </div>

              </div>

              <div class="row">
                <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
                  <span>
                    <a href="<?php echo base_url().'pendingan_dokumen' ?>" class="btn btn-danger btn-xs">Kembali</a>
                  </span>

                  <!-- Cek Apakah request sedang dalam proses pengajuan -->
                  <?php if($data_pengajuan['tambah_dokumen'] != 'ya'){ ?>

                  <span>
                    <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-dokumen">
                      <i class="fa fa-file"></i> Request Tambah Dokumen
                    </button>
                  </span>

                  <?php } ?>

                  <a href="#" data-toggle="modal" data-target="#tambah_dokumen" class="btn btn-primary btn-xs">
                    <i class="fa fa-plus"></i> Tambah Dokumen
                  </a>

                  <!-- Tombol Request Penyelesaian -->
                  <?php 
                    if($no_invoice == 'TBO'){ 
                  ?>
                  <a href="#" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-revisi_invoice">
                    <i class="fa fa-refresh"></i> Revisi No. Invoice
                  </a>
                  <?php } ?>

                  <?php  
                  // Cek apakah tidak ada dokumen di pengajuan
                  $no_pengajuan = $data_pengajuan['nomor_pengajuan'];
                  $q_cek_tdk = $this->db->query("SELECT * FROM tbl_pengajuan_file WHERE nomor_pengajuan='$no_pengajuan'");
                  $cek_tdk = $q_cek_tdk->num_rows();

                  if($cek_tdk<1){ //Jika memang tidak ada dokumen
                  ?>

                    <a href="#" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-kirim_accounting">Tdk Ada Dokumen
                    </a>

                  <?php } ?>

                  <?php  
                  // Cek Apakah Dokumen sudah lengkap semua
                  $qcek_dok = $this->db->query("SELECT * FROM tbl_pengajuan_file WHERE nomor_pengajuan='$no_pengajuan' AND status='' ");
                  $cek_dok = $qcek_dok->num_rows();

                  if($cek_dok<1 AND $cek_tdk>0){ //jika semua dokumen udah done, munculkan tombol dokumen lengkap
                  ?>

                    <!-- <a href="<?php echo base_url().'pendingan_dokumen/verifikasi_dokumen/'.$data_pengajuan['id_pengajuan'] ?>" class="btn btn-xs btn-success" onclick="return confirm('Apakah Anda Yakin Dokumen Sudah Lengkap & Akan Dikirim Ke Accounting?')">Dokumen Lengkap & Kirim Ke Accounting
                    </a> -->

                    <?php if($data_pengajuan['status_dokumen'] != 'done'){ ?>
                      <a href="#" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-kirim_accounting">Dokumen Lengkap & Kirim Ke Accounting
                      </a>
                    <?php } ?>

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

                  <!-- Tombol Request Penyelesaian -->
                  <?php 
                    if($no_invoice == 'ESTIMASI' AND $data_pengajuan['note_penyelesaian'] == '' AND $data_pengajuan['status_bayar']=='Telah Dibayar'){ 
                  ?>
                  <a href="#" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-request_penyelesaian">
                    Proses Penyelesaian
                  </a>
                  <?php } ?>

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

  <!-- Modal Dokumen -->
  <form action="<?php echo base_url().'pendingan_dokumen/request_dokumen' ?>" method="post">
  <div class="modal fade" id="modal-dokumen">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Request Tambah Dokumen</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="nomor_pengajuan" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <input type="text" hidden name="tambah_dokumen_pic" value="<?php echo $departemen ?>">

          <div class="form-group">
            <label for="alamat"></span> Isi Request :</label>
            <textarea class="form-control" name="ket_tambah_dokumen" required></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-info"> Kirim Request</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Dokumen -->
  

  <!-- Modal Revisi Nomor Invoice -->
  <form action="<?php echo base_url().'pendingan_dokumen/revisi_invoice' ?>" method="post">
  <div class="modal fade" id="modal-revisi_invoice">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Revisi No. Invoice</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="nomor_pengajuan" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <div class="form-group">
            <label for="alamat"></span> Keterangan Revisi :</label>
            <textarea class="form-control" name="ket_revisi" rows="5" required></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Revisi</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Revisi Nomor Invoice -->


  <!-- Modal Tambah Dokumen -->
  <form action="<?php echo base_url().'pendingan_dokumen/tambah_dokumen' ?>" method="post" enctype="multipart/form-data">
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
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> 
              <i class="fa fa-times"></i> Close
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- / Modal Memo -->


  <!-- Modal Kirim Accounting -->
  <form action="<?php echo base_url().'pendingan_dokumen/verifikasi_dokumen' ?>" method="post">
  <div class="modal fade" id="modal-kirim_accounting">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Kirim Dokumen Ke Accounting</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="nomor_pengajuan" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <input type="text" hidden name="tambah_dokumen_pic" value="<?php echo $departemen ?>">

          <input type="text" hidden name="jenis_penyelesaian_reviewer" value="<?php echo $data_pengajuan['jenis_penyelesaian'] ?>">
          <input type="text" hidden name="nomor_invoice" value="<?php echo $data_pengajuan['nomor_invoice'] ?>">

          <h4>Apakah anda yakin dokumen telah lengkap & akan meneruskan ke Accounting Dept?</h4>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-info"> Proses</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Kirim Dokumen -->



  <!-- Modal Request Penyelesaian -->
  <form action="<?php echo base_url().'pendingan_dokumen/request_penyelesaian' ?>" method="post">
  <div class="modal fade" id="modal-request_penyelesaian">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Proses Penyelesaian</h4>
          <em>Rekomendasi ini akan menjadi acuan pengaju/cabang untuk melakukan penyelesaian</em>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="nomor_pengajuan" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>">
          <input type="text" hidden name="jenis_biaya" value="<?php echo $data_pengajuan['jenis_biaya'] ?>">
          <input type="text" hidden name="sub_biaya" value="<?php echo $data_pengajuan['sub_biaya'] ?>">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <input type="text" hidden name="departemen" value="<?php echo $departemen ?>">

          <input type="text" value="<?php echo $data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']) ?>" hidden name="total_pengajuan">

          <!-- <div class="form-group">
            <label for="jenis_penyelesaian" required>Jenis Penyelesaian :</label>
            <select name="jenis_penyelesaian" id="jenis_penyelesaian" class="form-control" required="">
              <option value="">- Pilih -</option>
              <option value="kelebihan">Kelebihan Biaya</option>
              <option value="kekurangan">Kekurangan Biaya</option>
            </select>
          </div> -->

          <div class="form-group">
            <label for=""></span> Nominal Pengajuan Awal :</label>
            <input type="text" class="form-control" value="<?php echo number_format($data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']),0,'.',',') ?>" readonly>
          </div>

          <div class="form-group">
            <label for="nominal_penyelesaian"></span> Nominal Penyelesaian :</label>
            <input type="number" class="form-control" placeholder="Rp" name="nominal_penyelesaian" id="nominal_penyelesaian" required>
            <span style="display:block; position:absolute; right:15px; font-weight:bold" id="nominal_penyelesaian_v">0</span>
          </div>

          <div class="form-group">
            <label for="jenis_penyelesaian"></span> Jenis Penyelesaian :</label>
            <input type="text" class="form-control" name="jenis_penyelesaian" id="jenis_penyelesaian" readonly>
          </div>

          <div class="form-group">
            <label for=""></span> Nominal Kelebihan/Kekurangan :</label>
            <input type="text" class="form-control" readonly id="selisih">
          </div>

          <div class="form-group">
            <label for="note_penyelesaian"></span> Isi Note :</label>
            <textarea class="form-control" name="note_penyelesaian" rows="10" required></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-info" id="tombol-penyelesaian"> Proses</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Request Penyelesaian -->


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

  <!-- Script Penentuan Kelebihan/Kekurangan -->
    <script>
      $(document).ready(function(){

        // Rubah format angka javascript
        function rubah(angka){
          var reverse = angka.toString().split('').reverse().join(''),
          ribuan = reverse.match(/\d{1,3}/g);
          ribuan = ribuan.join(',').split('').reverse().join('');
          return ribuan;
        }

        $(document).on('keyup mouseup', '#nominal_penyelesaian', function(){
          const nominal_penyelesaian = $('#nominal_penyelesaian').val();
          const total_biaya = $('#total_biaya').val();
          
          $('#nominal_penyelesaian_v').text(rubah(nominal_penyelesaian));

          if(nominal_penyelesaian*1 > total_biaya*1){
            $('#jenis_penyelesaian').val('kekurangan');
            $('#selisih').val(rubah((nominal_penyelesaian*1) - (total_biaya*1)));
          }else if(nominal_penyelesaian*1 == total_biaya*1){
            $('#jenis_penyelesaian').val('Biaya Sesuai');
            $('#selisih').val(rubah((nominal_penyelesaian*1) - (total_biaya*1)));
          }else if(nominal_penyelesaian*1 == 0){
            $('#jenis_penyelesaian').val('Biaya Dikembalikan');
            $('#selisih').val(rubah((nominal_penyelesaian*1) - (total_biaya*1)));
          }else{
            $('#jenis_penyelesaian').val('kelebihan');
            $('#selisih').val(rubah((total_biaya*1) - (nominal_penyelesaian*1)));
          }
        });


        // $(document).on('click', '#tombol-penyelesaian', function(){
        //   const nominal_penyelesaian = $('#nominal_penyelesaian').val();
        //   if(nominal_penyelesaian == 0){
        //     alert("Nominal Penyelesaian Tidak Boleh 0");
        //     return false;
        //   }
        // });


      });
    </script>
  <!-- END Script Penentuan Kelebihan/Kekurangan -->