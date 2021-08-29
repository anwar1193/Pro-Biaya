<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detai Pengajuan</title>
	<style>
		.logo{
			position: absolute;
			width: 60px;
			height: auto;
		}

		.garis{
			border: 0;
			border-style: inset;
			border-top: 1px solid #000;
		}

		table,th,td{
			border-collapse: collapse;
		}
	</style>
</head>
<body>

	<h4 style="text-align: center;">Detail Pengajuan Biaya</h4><br><br>
	<div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
      
      <table width="100%" border="1" style="font-size: 12px;">
        <tr>
          <th width="40%" style="text-align: left;">Tanggal</th>
          <th width="5%">:</th>
          <td><?php echo date('d-m-Y', strtotime($data_pengajuan['tanggal'])) ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Nomor Pengajuan</th>
          <th>:</th>
          <td><?php echo $data_pengajuan['nomor_pengajuan'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Cabang</th>
          <th>:</th>
          <td><?php echo $data_pengajuan['cabang'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Bagian</th>
          <th>:</th>
          <td><?php echo $data_pengajuan['bagian'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Jenis Biaya</th>
          <th>:</th>
          <td><?php echo $data_pengajuan['jenis_biaya'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Sub Biaya</th>
          <th>:</th>
          <td><?php echo $data_pengajuan['sub_biaya'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Keterangan</th>
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
          <th style="text-align: left;">Bank Penerima</th>
          <th>:</th>
          <td><?php echo $data_pengajuan['bank_penerima'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Nomor Rekening</th>
          <th>:</th>
          <td><?php echo $data_pengajuan['norek_penerima'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Atas Nama</th>
          <th>:</th>
          <td><?php echo $data_pengajuan['atas_nama'] ?></td>
        </tr>

        <!-- Data Perjalanan Dinas -->
        <?php  
          if($data_perdin['nama_pic'] != ''){
        ?>

        <tr style="background-color: orange">
          <td colspan="3" style="text-align: center;">
            <b>Data Perjalanan Dinas</b>
          </td>
        </tr>

        <tr>
          <th style="text-align: left;">Nama PIC (Perjalanan Dinas)</th>
          <th>:</th>
          <td><?php echo $data_perdin['nama_pic'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Lokasi Tujuan</th>
          <th>:</th>
          <td><?php echo $data_perdin['lokasi_tujuan'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Tujuan Perjalanan Dinas</th>
          <th>:</th>
          <td><?php echo $data_perdin['tujuan_perdin'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Tanggal Kunjungan</th>
          <th>:</th>
          <td><?php echo date('d-m-Y', strtotime($data_perdin['dari_tanggal'])) ?> s/d <?php echo date('d-m-Y', strtotime($data_perdin['ke_tanggal'])) ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Lama Kunjungan</th>
          <th>:</th>
          <td><?php echo $data_perdin['lama_kunjungan'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Transportasi Yang Digunakan</th>
          <th>:</th>
          <td><?php echo $data_perdin['transportasi_ket'] ?></td>
        </tr>

         <tr>
          <th style="text-align: left;">Penginapan/Hotel</th>
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
            <th style="text-align: left;">Jarak</th>
            <th>:</th>
            <td><?php echo $data_perdin['jarak'] ?></td>
          </tr>

          <tr>
            <th style="text-align: left;">Nasabah</th>
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
          <td colspan="3" style="text-align: center;">
            <b>Data Pengajuan BBM</b>
          </td>
        </tr>

        <tr>
          <th style="text-align: left;">Nomor Polisi</th>
          <th>:</th>
          <td><?php echo $data_bbm['nopol'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Jenis Kendaraan</th>
          <th>:</th>
          <td><?php echo $data_bbm['jenis_kendaraan'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Merk Kendaraan</th>
          <th>:</th>
          <td><?php echo $data_bbm['merk_kendaraan'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Kapasitas Silinder</th>
          <th>:</th>
          <td><?php echo $data_bbm['kapasitas_silinder'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Kilometer Pengajuan</th>
          <th>:</th>
          <td><?php echo $data_bbm['kilometer_pengajuan'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Keperluan Pengajuan BBM</th>
          <th>:</th>
          <td><?php echo $data_bbm['keperluan_pengajuan_bbm'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Jenis BBM</th>
          <th>:</th>
          <td><?php echo $data_bbm['jenis_bbm'] ?></td>
        </tr>

        <?php } ?>

        <!-- / Data Pengajuan BBM -->

        <tr>
          <th style="text-align: left;">Berkas Pendukung</th>
          <th>:</th>
          <td>
            <ul>
              <?php foreach($data_file as $row_file){ ?>
              <li>
                <?php echo $row_file['nama_file'] ?>
                <a href="<?php echo base_url().'file_upload/'.$row_file['file'] ?>">Download</a>
              </li>
              <?php } ?>
            </ul>
          </td>
        </tr>

        <!-- Data Split Pembayaran -->
        <tr>
          <th style="text-align: left;">Tipe Transaksi</th>
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
          <th style="text-align: left;">Frekuensi Bayar</th>
          <th>:</th>
          <td><?php echo $frek_byr ?> Kali Pembayaran</td>
        </tr>

        <tr>
          <th style="text-align: left;">Tanggal Bayar</th>
          <th>:</th>
          <td>
            
            <table border="1" style="border-collapse: collapse;" width="100%">
              <tr>
                <th>Bayar Ke</th>
                <th>Tanggal Bayar</th>
                <th>Jumlah Bayar</th>
              </tr>

              <?php 
                $no=1;
                foreach($data_byr as $row_byr){ 
              ?>
                <tr>
                  <td style="text-align: center"><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($row_byr['tanggal_minta_bayar'])) ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_byr['jumlah_bayar'], 0, ',', '.') ?></td>
                </tr>
              <?php } ?>
            </table>

          </td>
        </tr>
        <!-- / Data Split Pembayaran -->

        <tr>
          <th style="text-align: left;">History Approval</th>
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
            <th style="text-align: left;">Saldo Budget Awal</th>
            <th>:</th>
            <td><?php echo number_format($saldo_awal, 0, '.', ',') ?></td>
          </tr>

          <tr>
            <th style="text-align: left;">Saldo Terpakai</th>
            <th>:</th>
            <td><?php echo number_format($terpakai, 0, '.', ',') ?></td>
          </tr>

          <tr>
            <th style="text-align: left;">Saldo Budget Akhir</th>
            <th>:</th>
            <td><?php echo number_format($saldo_akhir, 0, '.', ',') ?></td>
          </tr>

          <tr>
            <th style="text-align: left;">Alasan Over Budget</th>
            <th>:</th>
            <td><?php echo $data_pengajuan['alasan_over_budget'] ?></td>
          </tr>
        <?php } ?>
        <!-- / Data Over Budget -->

      </table>

    </div>


</body>
</html>