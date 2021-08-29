<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Dokumen Terlambat</title>
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

      <h3 style="text-align: center;">Data Pengajuan (Dokumen Terlambat)</h3>

      <hr style="border-color: silver; border-collapse: collapse; border-style: dashed; width: 400px;">

	  <table border="1" width="100%" style="margin-top: 20px; font-size: 12px">

	    <tr>
	      <th>NO</th>
	      <th>Tanggal</th>
	      <th>No Pengajuan</th>
	      <th>Cabang</th>
	      <th>Dept</th>
	      <th>Jenis Biaya</th>
	      <th>Sub Biaya</th>
	      <th>Jumlah Biaya</th>
          <th>Status Dokumen</th>
	    </tr>

        <?php 
            $no=1;
            foreach($data_pengajuan as $row_pengajuan) : 
        ?>
        <tr>
            <td style="text-align:center"><?= $no++ ?></td>
            <td style="text-align:center"><?= date('d-m-Y', strtotime($row_pengajuan['tanggal'])) ?></td>
            <td><?= $row_pengajuan['nomor_pengajuan'] ?></td>
            <td style="text-align:center"><?= $row_pengajuan['cabang'] ?></td>
            <td style="text-align:center"><?= $row_pengajuan['bagian'] ?></td>
            <td><?= $row_pengajuan['jenis_biaya'] ?></td>
            <td><?= $row_pengajuan['sub_biaya'] ?></td>
            <td style="text-align:center"><?= number_format($row_pengajuan['jumlah'] + $row_pengajuan['ppn'] - $row_pengajuan['pph23'] - $row_pengajuan['pph42'] - $row_pengajuan['pph21'], 0, '.', ',') ?></td>
            
            <!-- Status Dokumen -->
            <?php if($row_pengajuan['status_dokumen']==''){ ?>
            <td style="font-weight: bold" width="12%">
                Pending <br>
                <!-- Cari Due Date -->
                <?php
                date_default_timezone_set("Asia/Jakarta");
                $tanggal_bayar = $row_pengajuan['tanggal_bayar'];
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
            <?php }elseif($row_pengajuan['status_dokumen']=='done'){ ?>

            <td style="color: green; font-weight: bold" width="10%">
                Diterima Oleh <?php echo $row_pengajuan['dept_tujuan'] ?>
            </td>

            <?php }elseif($row_pengajuan['status_dokumen']=='done acc'){ ?>

            <td style="color: blue; font-weight: bold" width="10%">
                Diterima Oleh Accounting <br>
            </td>

            <?php } ?>

        </tr>
        <?php endforeach; ?>
	  </table>

    

</body>
</html>

