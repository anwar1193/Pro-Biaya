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

	<table width="100%">
	    <tr>
          <td width="15%">Kode Jurnal</td>
          <td>:</td>
          <td>Pro Biaya</td>

          <td>&nbsp;</td>

          <td width="15%">No Ticket</td>
          <td>:</td>
          <td>
            <?php 
              
              if($data_pengajuan['nomor_pymt'] == ''){ //jika pengajuan lama, sblm pemisahan nomor tiket

                // JK/BY/102520/0001
                $nojur1 = substr($data_pengajuan['nomor_jurnal'], 0,6);
                $nojur21 = substr($data_pengajuan['nomor_jurnal'], 6,2);
                $nojur22 = substr($data_pengajuan['nomor_jurnal'], 8,2);
                $nojur23 = substr($data_pengajuan['nomor_jurnal'], 10,2);
                $nojur3 = substr($data_pengajuan['nomor_jurnal'], 12,5);
                echo $nojur1.$nojur21.'.'.$nojur22.'.'.$nojur23.'/'.$nojur3;

              }else{

                // JK/PYMT/102520/0001
                $nojur1 = substr($data_pengajuan['nomor_pymt'], 0,8);
                $nojur21 = substr($data_pengajuan['nomor_pymt'], 10,2);
                $nojur22 = substr($data_pengajuan['nomor_pymt'], 8,2);
                $nojur23 = substr($data_pengajuan['nomor_pymt'], 12,2);
                $nojur3 = substr($data_pengajuan['nomor_pymt'], 15,4);
                echo $nojur1.$nojur21.'.'.$nojur22.'.'.$nojur23.'/'.$nojur3;
              }

            ?>
          </td>
        </tr>

        <tr>
          <td>No Referensi</td>
          <td>:</td>
          <td><?php echo $data_pengajuan['nomor_pengajuan'] ?></td>

          <td>&nbsp;</td>

          <td>Tanggal</td>
          <td>:</td>
          <td><?php echo date('d-m-Y',strtotime($data_pengajuan['tanggal_bayar'])) ?></td>
        </tr>
	  </table>

	  <table border="1" width="100%" style="margin-top: 20px; font-size: 12px">
	    <tr>
          <th>No Perkiraan</th>
          <th>Nama Perkiraan</th>
          <th>Cabang</th>
          <th>Debet</th>
          <th>Credit</th>
        </tr>

        <tr>
          <td>245-999-000-000</td>
          <td>BIAYA MASIH HARUS DIBAYAR</td>
          <td><?php echo $data_pengajuan['cabang'] ?></td>
          <td style="text-align: right;"><?php echo number_format($data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']),0,',','.') ?></td>
          <td style="text-align: right;">0</td>
        </tr>

        <?php if($data_pengajuan['cabang'] != 'HEAD OFFICE'){ ?>
          <tr>
            <td>120-001-000-000</td>
            <td>REKENING ANTAR KANTOR</td>
            <td><?php echo $data_pengajuan['cabang'] ?></td>
            <td style="text-align: right;">0</td>
            <td style="text-align: right;"><?php echo number_format($data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']),0,',','.') ?></td>
          </tr>

          <tr>
            <td>120-001-000-000</td>
            <td>REKENING ANTAR KANTOR</td>
            <td>HEAD OFFICE</td>
            <td style="text-align: right;"><?php echo number_format($data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']),0,',','.') ?></td>
            <td style="text-align: right;">0</td>
          </tr>
        <?php } ?>

        <?php  
          // Ambil Bank
          $nopeng = $data_pengajuan['nomor_pengajuan'];
          $data_bayar = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$nopeng'")->row_array();
          $id_bank = $data_bayar['bank_bayar'];

          // Ambil Nama & COA Bank
          $data_bank = $this->db->query("SELECT * FROM tbl_bank WHERE id=$id_bank")->row_array();
          $nama_bank = $data_bank['nama_bank'];
          $coa_bank = $data_bank['coa_bank'];
        ?>

        <tr>
          <td><?php echo $coa_bank; ?></td>
          <td><?php echo $nama_bank ?></td>
          <td>HEAD OFFICE</td>
          <td style="text-align: right;">0</td>
          <td style="text-align: right;"><?php echo number_format($data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']),0,',','.') ?></td>
        </tr>

        <tr>
          <td colspan="3" style="text-align: right;font-weight: bold;">TOTAL</td>
          <td style="text-align: right;"><?php echo number_format($data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']),0,',','.') ?></td>
          <td style="text-align: right;"><?php echo number_format($data_pengajuan['jumlah']+$data_pengajuan['ppn']-($data_pengajuan['pph23']+$data_pengajuan['pph42']+$data_pengajuan['pph21']),0,',','.') ?></td>
        </tr>
	  </table>

	  <br><br>
      <b>Keterangan :</b> <?php echo $data_pengajuan['keterangan'] ?> <br><br>

      <div style="text-align: center">
        <b>Final Approved By <?php echo $data_pengajuan['approved_by'] ?> (<?php echo $data_pengajuan['nama_pengapprove'] ?>)</b><br>
        <b>On : <?php echo date('d-m-Y', strtotime($data_pengajuan['tanggal_approved'])) ?></b>
      </div><br>


</body>
</html>