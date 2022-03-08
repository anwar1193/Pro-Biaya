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

                <!-- Data Penyelesaian -->
                <tr style="background-color: orange">
                  <td colspan="3">
                    <b>PENYELESAIAN</b>
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


              </table>

            </div>

          </div>

          <div class="row">
            <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
              <span>
                <a href="<?php echo base_url().'revisi_request_penyelesaian' ?>" class="btn btn-danger btn-xs">Kembali</a>
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