<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Daftar Dokumen Pengajuan</title>
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

	<h4 style="text-align: center;">Daftar Dokumen Pengajuan Biaya</h4><br><br>
	<div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
      
      <table width="100%" border="1" style="font-size: 12px;">
        <tr>
          <th width="40%" style="text-align: left;">Tanggal Pengajuan</th>
          <th width="5%">:</th>
          <td><?php echo date('d-m-Y', strtotime($data_pengajuan['tanggal'])) ?></td>
        </tr>

        <tr>
          <th width="40%" style="text-align: left;">Tanggal Proses BMHD</th>
          <th width="5%">:</th>
          <td><?php echo date('d-m-Y', strtotime($data_pengajuan['tanggal_proses_bayar'])) ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Nomor Pengajuan</th>
          <th>:</th>
          <td><?php echo $data_pengajuan['nomor_pengajuan'] ?></td>
        </tr>

        <tr>
          <th style="text-align: left;">Nomor Invoice</th>
          <th>:</th>
          <td><?php echo $data_pengajuan['nomor_invoice'] ?></td>
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
          <th style="text-align: right;">Total</th>
          <th>:</th>
          <td><?php echo number_format($data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23'] + $data_pengajuan['pph42'] + $data_pengajuan['pph21']),0,',','.') ?></td>
        </tr>

        <tr>
          <th>Berkas Pendukung</th>
          <th>:</th>
          <td>
            <ul>
              <?php foreach($data_file as $row_file){ ?>
              <li>
                <?php echo $row_file['nama_file'] ?>
              </li>
              <?php } ?>
            </ul>
          </td>
        </tr>

      </table>

      <br><br>

      <table width="100%" border="1">
        <tr>
          <th>Diserahkan Oleh</th>
          <th>Penerima-1</th>
          <th>Penerima-2</th>
        </tr>

        <tr>
          <td>&nbsp; <br> &nbsp; <br> &nbsp;</td>
          <td></td>
          <td></td>
        </tr>

        <tr style="text-align: center;">
          <td><?php echo $data_pengajuan['cabang'] ?> (<?php echo $data_pengajuan['bagian'] ?>)</td>
          <td><?php echo $data_pengajuan['dept_tujuan'] ?> Departement</td>
          <td>ACCOUNTING Departement</td>
        </tr>
      </table>

    </div>
    <br><br><br>


    <span>Catatan (Diisi Oleh Pengaju) :</span> <br><br>

    <table width="100%" border="1">

      <tr>
        <th style="font-weight: bold; text-align: left;" width="40%">Pengajuan</th>
        <td width="5%" style="text-align: center">:</td>
        <td>Rp.</td>
      </tr>

      <tr>
        <th style="font-weight: bold; text-align: left;" width="40%">Realisasi</th>
        <td width="5%" style="text-align: center">:</td>
        <td>Rp.</td>
      </tr>

      <tr>
        <th style="font-weight: bold; text-align: left;" width="40%">Kurang (Lebih) Bayar</th>
        <td width="5%" style="text-align: center">:</td>
        <td>Rp.</td>
      </tr>

      <tr>
        <th style="font-weight: bold; text-align: left;" width="40%">Tanggal Pengembalian Lebih Bayar</th>
        <td width="5%" style="text-align: center">:</td>
        <td>......... / ......... / ................</td>
      </tr>

      <tr>
        <th style="font-weight: bold; text-align: left;" width="40%">Cara Pengembalian</th>
        <td width="5%" style="text-align: center">:</td>
        <td>
          <div style="width: 15px; border: 1px solid black; height: 15px "></div> Tunai (LPPD) <br>
          <div style="width: 15px; border: 1px solid black; height: 15px "></div> Transfer BCA 523 0304922 (Lampiran : Bukti Setor)
        </td>
      </tr>

    </table>


</body>
</html>