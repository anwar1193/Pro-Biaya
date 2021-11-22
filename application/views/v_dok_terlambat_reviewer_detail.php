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
                  <td><?php echo number_format($data_pengajuan['total'],0,',','.') ?></td>
                </tr>

                <tr>
                  <th>Keterangan</th>
                  <th>:</th>
                  <td><?php echo $data_pengajuan['keterangan'] ?></td>
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
                            <table border="1" style="border-collapse: collapse;" width="100%">
                              <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Nama Sparepart</th>
                                <th class="text-center">Harga Sparepart</th>
                                <th class="text-center">Diskon</th>
                                <th class="text-center">Keterangan</th>
                              </tr>

                              <?php 
                                $no=1;
                                $total_jumlah_sparepart = 0;
                                $total_diskon_sparepart = 0;
                                foreach($data_sparepart as $row){ 
                                  $total_jumlah_sparepart += $row['jumlah_sparepart'];
                                  $total_diskon_sparepart += $row['diskon_sparepart'];
                              ?>
                              <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo $row['sparepart'] ?></td>
                                <td class="text-right"><?php echo number_format($row['jumlah_sparepart'], 0, ',', '.') ?></td>
                                <td class="text-right"><?php echo number_format($row['diskon_sparepart'], 0, ',', '.') ?></td>
                                <td class="text-center"><?php echo $row['keterangan_sparepart'] ?></td>
                              </tr>
                              <?php } ?>

                              <tr style="font-weight:bold">
                                <td colspan="2" class="text-right">TOTAL :</td>
                                <td class="text-right"><?php echo number_format($total_jumlah_sparepart, 0, ',', '.') ?></td>
                                <td class="text-right"><?php echo number_format($total_diskon_sparepart, 0, ',', '.') ?></td>
                              </tr>
                            </table>
                        </td>
                      </tr>


                      <tr>
                        <th>Rincian Jasa Perbaikan</th>
                        <th>:</th>
                        <td>
                            <table border="1" style="border-collapse: collapse;" width="100%">
                              <tr>
                                <th class="text-center" width="10%">NO</th>
                                <th class="text-center" width="45%">Nama Jasa</th>
                                <th class="text-center" width="25%">Biaya Jasa</th>
                                <th class="text-center" width="20%">Diskon</th>
                              </tr>

                              <?php 
                                $no=1;
                                $total_jumlah_jasa = 0;
                                $total_diskon_jasa = 0;
                                foreach($data_jasa_perbaikan as $row){ 
                                  $total_jumlah_jasa += $row['jumlah_jasa'];
                                  $total_diskon_jasa += $row['diskon_jasa'];
                              ?>
                              <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo $row['jasa'] ?></td>
                                <td class="text-right"><?php echo number_format($row['jumlah_jasa'], 0, ',', '.') ?></td>
                                <td class="text-right"><?php echo number_format($row['diskon_jasa'], 0, ',', '.') ?></td>
                              </tr>
                              <?php } ?>

                              <tr style="font-weight:bold">
                                <td colspan="2" class="text-right">TOTAL :</td>
                                <td class="text-right"><?php echo number_format($total_jumlah_jasa, 0, ',', '.') ?></td>
                                <td class="text-right"><?php echo number_format($total_diskon_jasa, 0, ',', '.') ?></td>
                              </tr>
                            </table>
                        </td>
                      </tr>
                      
                    <?php } ?>
                    <!-- / Data Perbaikan Kendaraan -->

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
                  <th>Tanggal Bayar</th>
                  <th>:</th>
                  <td>
                    
                    <table border="1" style="border-collapse: collapse;" width="100%">
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
                          <td style="text-align: right;"><?php echo number_format($data_byr['jumlah']+$data_byr['ppn']-($data_byr['pph23']+$data_byr['pph42']+$data_byr['pph21']), 0, ',', '.') ?></td>
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

                <tr style="background-color: orange">
                  <td colspan="3">
                    <b>Diisi Oleh Dept PIC (<?php echo $data_pengajuan['dept_tujuan'] ?>)</b>
                  </td>
                </tr>

                <!-- <tr>
                  <th>Tanggal Permintaan Bayar</th>
                  <th>:</th>
                  <td><?php echo date('d-m-Y', strtotime($data_pengajuan['tanggal_minta_bayar'])) ?></td>
                </tr> -->

                <tr>
                  <th>Tipe Transaksi</th>
                  <th>:</th>
                  <td>
                    <?php 
                      if($data_check['tipe_transaksi'] == '1'){
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
                  <td><?php echo $data_check['tipe_transaksi'] ?> Kali Pembayaran</td>
                </tr>

                <tr>
                  <th>Berkas (Dari PIC)</th>
                  <th>:</th>
                  <td>
                    <ul>
                      <?php foreach($data_check_file as $row_cf){ ?>
                         <li>
                          <?php echo $row_cf['file'] ?>
                          <a href="<?php echo base_url().'file_check/'.$row_cf['file'] ?>">Download</a>
                        </li>
                      <?php } ?>
                    </ul>
                  </td>
                </tr>

                <tr style="background-color: orange">
                  <td colspan="3">
                    <b>Diisi Oleh FINANCE Dept</b>
                  </td>
                </tr>

                <tr>
                  <th>Status Bayar</th>
                  <th>:</th>
                  <td style="font-weight: bold">
                    <?php 
                      if($data_pengajuan['status_bayar'] == 'Telah Dibayar'){
                        echo $data_pengajuan['status_bayar']; 
                      }elseif($data_pengajuan['status_bayar'] == 'Proses Bayar'){
                        echo $data_pengajuan['status_bayar']; 
                      }else{
                        echo 'Proses Check';
                      }
                    ?>
                  </td>
                </tr>

                <tr>
                  <th>Tanggal Bayar</th>
                  <th>:</th>
                  <td>
                    <?php 
                      if($data_byr1['tanggal_rencana_bayar']=='0000-00-00'){
                        echo '-';
                      }else{
                        echo date('d-m-Y', strtotime($data_byr1['tanggal_rencana_bayar']));
                      }
                    ?>
                  </td>
                </tr>

              </table>

            </div>

          </div>

          <div class="row">
            <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
              <span>
                <a href="<?php echo base_url().'dokumen_terlambat_reviewer' ?>" class="btn btn-danger btn-xs">Kembali</a>
              </span>

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