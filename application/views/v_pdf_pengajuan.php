<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laporan PDF</title>
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
          <th style="text-align: right;">Jumlah</th>
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
          <th style="text-align: right;">PPH21</th>
          <th>:</th>
          <td><?php echo number_format($data_pengajuan['pph21'],0,',','.') ?></td>
        </tr>

        <tr>
          <th style="text-align: right;">PPH4(2)</th>
          <th>:</th>
          <td><?php echo number_format($data_pengajuan['pph42'],0,',','.') ?></td>
        </tr>

        <tr>
          <th style="text-align: right;">Total</th>
          <th>:</th>
          <td><?php echo number_format($data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']),0,',','.') ?></td>
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
          <td colspan="3" style="text-align: left;">
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
          <th style="text-align: left;">Jarak</th>
          <th>:</th>
          <td><?php echo $data_perdin['jarak'] ?></td>
        </tr>

        <tr>
          <th style="text-align: right;">Biaya Transportasi</th>
          <th>:</th>
          <td><?php echo number_format($data_perdin['transportasi'],0,',','.') ?></td>
        </tr>

        <tr>
          <th style="text-align: right;">Biaya Penginapan</th>
          <th>:</th>
          <td><?php echo number_format($data_perdin['penginapan'],0,',','.') ?></td>
        </tr>

        <tr>
          <th style="text-align: right;">Biaya Makan</th>
          <th>:</th>
          <td><?php echo number_format($data_perdin['makan'],0,',','.') ?></td>
        </tr>

        <tr>
          <th style="text-align: right;">Biaya Lain-lain</th>
          <th>:</th>
          <td><?php echo number_format($data_perdin['lain_lain'],0, '.', ',') ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">No Pin</th>
          <th>:</th>
          <td><?php echo $data_perdin['nopin'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Nama Nasabah</th>
          <th>:</th>
          <td><?php echo $data_perdin['nama_nasabah'] ?></td>
        </tr>

        <?php } ?>

        <!-- / Data Perjalanan Dinas -->

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

        <tr>
          <th style="text-align: left;">Tracking Approval</th>
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
          <th style="text-align: left;">Status Check (By PIC Dept)</th>
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
            <b>Diisi Oleh FINANCE Dept</b>
          </td>
        </tr>

        <tr>
          <th style="text-align: left;">Status Bayar</th>
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
          <th style="text-align: left;">Tanggal Proses BMHD</th>
          <th>:</th>
          <td>
            <?php 
              if($data_pengajuan['tanggal_proses_bayar']=='0000-00-00'){
                echo '-';
              }else{
                echo date('d-m-Y', strtotime($data_pengajuan['tanggal_proses_bayar'])) ;
              }
            ?>
          </td>
        </tr>

        <tr>
          <th style="text-align: left;">Tanggal Bayar</th>
          <th>:</th>
          <td>
            <?php 
              if($data_pengajuan['tanggal_bayar']=='0000-00-00'){
                echo '-';
              }else{
                echo date('d-m-Y', strtotime($data_pengajuan['tanggal_bayar'])) ;
              }
            ?>
          </td>
        </tr>

        <tr>
          <th style="text-align: left;">Catatan</th>
          <th>:</th>
          <td><?php echo $data_pengajuan['catatan'] ?></td>
        </tr>

      </table>

    </div>


</body>
</html>