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
                      <td>
                        <?php 
                          // Yang tampil di view, field departemen update
                          $bagian = $data_pengajuan['bagian'];
                          $data_departemen = $this->M_master->tampil_data_where('tbl_departemen', array('nama_departemen' => $bagian))->row_array();
                          $nama_departemen_update = $data_departemen['nama_departemen_update'];
                          echo $nama_departemen_update;
                        ?>
                      </td>
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
                      <td>
                        <?php echo number_format($data_pengajuan['jumlah'],0,',','.') ?>
                        &nbsp; &nbsp;
                        
                        <!-- jika level head dan departemen tujuannya dia -->
                        <?php if($level == 'Department Head' AND $departemen == $data_pengajuan['dept_tujuan']){ ?>

                          <!-- Tombol Edit Jumlah -->
                          <!-- <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit">
                            Edit Jumlah
                          </button> -->

                        <?php } ?>

                        </td>
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
                      <td><?php echo number_format($data_pengajuan['pph42'],0,'.',',') ?></td>
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

                    <!-- Counter Pengajuan Bulan Ini -->
                    <tr style="background-color: orange">
                      <td colspan="3">
                        <b>Counter Pengajuan (Berapa Kali Telah Diajukan & Nominalnya) Pada Bulan Ini</b>
                      </td>
                    </tr>

                    <tr>
                      <th>Telah Diajukan (Bulan Ini)</th>
                      <th>:</th>
                      <td>
                        <?php echo $jumlah_pengajuan.' Kali'; ?> &nbsp; &nbsp;

                        <a class="btn btn-info btn-xs" href="<?php echo base_url().'inbox/detail_counter/'.$data_pengajuan['id_pengajuan'] ?>" onclick="window.open(&apos;&apos;, &apos;popupwindow&apos;, &apos;scrollbars=yes, width=1000, height=600&apos;);return true" target="popupwindow">
                          <i class="fa fa-eye"></i> Lihat
                        </a>
                      </td>
                    </tr>

                    <tr>
                      <th>Total Nominal</th>
                      <th>:</th>
                      <td><?php echo number_format($counter_pengajuan1['nominal_counter'],0,',','.') ?></td>
                    </tr>
                    <!-- / Counter Pengajuan Bulan Ini -->

                    <?php if($data_pengajuan['sub_biaya'] == 'Biaya Listrik' || $data_pengajuan['sub_biaya'] == 'Biaya Air' || $data_pengajuan['sub_biaya'] == 'Biaya Telepon dan Fax' || $data_pengajuan['form'] == 'Kendaraan'){ ?>
                      <!-- Data Pengajuan Bulan Sebelumnya -->
                      <tr style="background-color: orange">
                        <td colspan="3">
                          <b>Data Pengajuan Bulan Sebelumnya</b>
                        </td>
                      </tr>

                      <tr>
                        <th>Jumlah Diajukan</th>
                        <th>:</th>
                        <td>
                          <?php echo $jumlah_pengajuan_lalu.' Kali'; ?> &nbsp; &nbsp;

                          <a class="btn btn-info btn-xs" href="<?php echo base_url().'inbox/detail_counter_lalu/'.$data_pengajuan['id_pengajuan'] ?>" onclick="window.open(&apos;&apos;, &apos;popupwindow&apos;, &apos;scrollbars=yes, width=1000, height=600&apos;);return true" target="popupwindow">
                            <i class="fa fa-eye"></i> Lihat
                          </a>
                        </td>
                      </tr>

                      <tr>
                        <th>Total Nominal</th>
                        <th>:</th>
                        <td><?php echo number_format($counter_pengajuan_lalu['nominal_counter'],0,',','.') ?></td>
                      </tr>
                      <!-- / Data Pengajuan Bulan Sebelumnya -->
                    <?php } ?>


                    <!-- Data Over Budget -->
                    <?php if($data_pengajuan['alasan_over_budget'] != ''){ ?>
                      <tr style="background-color: orange">
                        <th colspan="3">Keterangan (Over Budget)</th>
                      </tr>

                      <!-- Ambil Data Budget -->
                      <?php  
                        $cabang = $data_pengajuan['cabang'];
                        $departemen = $data_pengajuan['bagian'];
                        $sub_biaya = $data_pengajuan['sub_biaya'];
                        $tgl_pengajuan = $data_pengajuan['tanggal'];
                        $bulan_pengajuan = substr($tgl_pengajuan, 5,2);

                        $res_budget = $this->db->query("SELECT * FROM tbl_budget WHERE 
                                      cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'")->row_array();

                        if($bulan_pengajuan == '08'){
                          $saldo_awal = $res_budget['agu20_awal'];
                          $terpakai = $res_budget['agu20_realisasi'];
                          $saldo_akhir = $res_budget['agu20_akhir'];
                        }elseif($bulan_pengajuan == '09'){
                          $saldo_awal = $res_budget['sep20_awal'];
                          $terpakai = $res_budget['sep20_realisasi'];
                          $saldo_akhir = $res_budget['sep20_akhir'];
                        }elseif($bulan_pengajuan == '10'){
                          $saldo_awal = $res_budget['okt20_awal'];
                          $terpakai = $res_budget['okt20_realisasi'];
                          $saldo_akhir = $res_budget['okt20_akhir'];
                        }elseif($bulan_pengajuan == '11'){
                          $saldo_awal = $res_budget['nov20_awal'];
                          $terpakai = $res_budget['nov20_realisasi'];
                          $saldo_akhir = $res_budget['nov20_akhir'];
                        }elseif($bulan_pengajuan == '12'){
                          $saldo_awal = $res_budget['des20_awal'];
                          $terpakai = $res_budget['des20_realisasi'];
                          $saldo_akhir = $res_budget['des20_akhir'];
                        }

                      ?>

                      <tr>
                        <th>Saldo Budget Awal</th>
                        <th>:</th>
                        <td><?php echo number_format($saldo_awal, 0, '.', ',') ?></td>
                      </tr>

                      <tr>
                        <th>Saldo Terpakai</th>
                        <th>:</th>
                        <td><?php echo number_format($terpakai, 0, '.', ',') ?></td>
                      </tr>

                      <tr>
                        <th>Saldo Budget Akhir</th>
                        <th>:</th>
                        <td><?php echo number_format($saldo_akhir, 0, '.', ',') ?></td>
                      </tr>

                      <tr>
                        <th>Alasan Over Budget</th>
                        <th>:</th>
                        <td><?php echo $data_pengajuan['alasan_over_budget'] ?></td>
                      </tr>
                    <?php } ?>
                    <!-- / Data Over Budget -->

                    <?php if($data_pengajuan['balik_lagi'] == 'Ya'){ ?>
                      <tr style="background-color: red">
                        <td colspan="3">
                          <h4 style="color: white">
                            Pengajuan Ini Pernah Disetujui, Tapi Ada Kenaikan Harga
                          </h4>
                        </td>
                      </tr>

                      <tr>
                        <th>Keterangan Tambahan (PIC)</th>
                        <th>:</th>
                        <td><?php echo $data_pengajuan['ket_balik'] ?></td>
                      </tr>

                      <tr>
                        <th>Total Harga Sebelum Kenaikan</th>
                        <th>:</th>
                        <td><?php echo 'Rp '.number_format($data_pengajuan['harga_sebelumnya'],'0',',','.').' (Harga Sebelum Pajak)' ?></td>
                      </tr>
                    <?php } ?>

                  </table>

                </div>

              </div>

              <div class="row">
                <div class="col-sm-6 col-sm-offset-3" style="border:1px dashed gray; padding: 10px;">

                  <span>
                    <a href="<?php echo base_url().'inbox' ?>" class="btn btn-primary btn-xs">
                      <i class="fa fa-backward"></i> Kembali
                    </a>
                  </span>

                  <a href="#" data-toggle="modal" data-target="#modal-approve" class="btn btn-success btn-xs">
                    <i class="fa fa-check"></i> Approve
                  </a>

                  <a href="#" data-toggle="modal" data-target="#modal-revisi" class="btn btn-warning btn-xs">
                    <i class="fa fa-refresh"></i> Revisi
                  </a>

                  <a href="#" data-toggle="modal" data-target="#modal-reject" class="btn btn-danger btn-xs">
                    <i class="fa fa-times"></i> Reject
                  </a>

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

  <!-- Modal Reject -->
  <form action="<?php echo base_url().'inbox/reject' ?>" method="post">
  <div class="modal fade" id="modal-reject">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Reject Pengajuan?</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <div class="form-group">
            <label for="alamat"></span> Alasan Reject :</label>
            <textarea class="form-control" name="note" id="note_reject" required></textarea>
          </div>

          <!-- Loading Reject -->
          <img id="loadingReject" src="../../asset/gambar/loading3_baru.gif" alt="" width="280" style="opacity:0.7">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-danger" id="tombol_reject"> Reject</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Reject -->


  <!-- Modal Approve -->
  <form action="<?php echo base_url().'inbox/approve' ?>" method="post">
  <div class="modal fade" id="modal-approve">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Approve Pengajuan?</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <div class="form-group">
            <label for="alamat"></span> Catatan :</label>
            <textarea class="form-control" name="note"></textarea>
          </div>

          <!-- Loading Approve -->
          <img id="loadingApprove" src="../../asset/gambar/loading3_baru.gif" alt="" width="280" style="opacity:0.7">

        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-success" id="tombol_approve"> Approve</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Approve -->

  <!-- Modal Revisi -->
  <form action="<?php echo base_url().'inbox/revisi' ?>" method="post">
  <div class="modal fade" id="modal-revisi">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Revisi Pengajuan?</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">
          
          <div class="form-group">
            <label for="alamat"></span> Alasan Revisi :</label>
            <textarea class="form-control" name="note" id="note_revisi" required></textarea>
          </div>

          <!-- Loading Revisi -->
          <img id="loadingRevisi" src="../../asset/gambar/loading3_baru.gif" alt="" width="280" style="opacity:0.7">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-warning" id="tombol_revisi"> Revisi</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Revisi -->

  <!-- Modal Edit -->
  <form action="<?php echo base_url().'inbox/edit_jumlah' ?>" method="post">
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Total Pengajuan</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <div class="form-group">
            <label for="tanggal_bayar"></span> Jumlah (Sebelum Pajak) :</label>
            <input type="number" name="jumlah" class="form-control input-sm" value="<?php echo $data_pengajuan['jumlah'] ?>" id="jumlah" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="ppn"></span> PPN :</label>
            <input type="number" name="ppn" class="form-control input-sm" value="<?php echo $data_pengajuan['ppn'] ?>" id="ppn" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="pph23"></span> PPH23 :</label>
            <input type="number" name="pph23" class="form-control input-sm" value="<?php echo $data_pengajuan['pph23'] ?>" id="pph23" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="pph42"></span> PPH4(2) :</label>
            <input type="number" name="pph42" class="form-control input-sm" value="<?php echo $data_pengajuan['pph42'] ?>" id="pph42" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="total"></span> Total :</label>
            <input type="number" name="total" value="<?php echo $data_pengajuan['total'] ?>" id="total" hidden><br>

            <!-- Total Ada Separator Rupiah Nya -->
            <span id="total_rp" style="font-weight: bold; font-size: 20px; padding: 5px;">
              <?php echo number_format($data_pengajuan['total'],0,'.',',') ?>
            </span>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-success"> Update</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Edit -->


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

        total = (jumlah*1) + (ppn*1) - ((pph23*1) + (pph42*1)); //perkalian salah satu trik biar angka bisa ditambah
        $('#total').val(total);
        $('#total_rp').text(rubah(total));
      }

      // Panggil fungsi ubah data (realtime) saat form (price_item, qty_item, discount_item) di ketik / di klik
      $(document).on('keyup mouseup', '#jumlah, #ppn, #pph23 , #pph42', function(){
        hitung_otomatis();
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


  <script>

    $(document).ready(function() {

      $('#loadingApprove').hide();
      $('#loadingRevisi').hide();
      $('#loadingReject').hide();

      // Setelah tombol approve di klik, tombol tsb menghilang
      $(document).on('click', '#tombol_approve', function(){
        $(this).hide();
        $('#loadingApprove').show();
      });

      // Setelah tombol revisi di klik, tombol tsb menghilang
      $(document).on('click', '#tombol_revisi', function(){
        var note_revisi = $('#note_revisi').val();
        if(note_revisi != ''){
          $(this).hide();
          $('#loadingRevisi').show();
        } 
      });

      // Setelah tombol reject di klik, tombol tsb menghilang
      $(document).on('click', '#tombol_reject', function(){
        var note_reject = $('#note_reject').val();
        if(note_reject != ''){
          $(this).hide();
          $('#loadingReject').show();
        }
      });

    });

  </script>