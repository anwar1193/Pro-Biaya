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

<?php foreach($data_pengajuan as $row_pengajuan){ ?>

<body>
  
  <?php 

    // Ambil COA (Nomor Perkiraan)
    $sub_biaya = $row_pengajuan['sub_biaya'];
    $dept = $row_pengajuan['bagian'];
    $ambil_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya' AND departemen='$dept'")->row_array();
    $coa = $ambil_coa['coa'];
    $nama_coa = $ambil_coa['nama_coa'];

  ?>

	<table width="100%">
	    <tr>
	      <td width="15%">Kode Jurnal</td>
	      <td>:</td>
	      <td width="20%">Pro Biaya</td>

	      <td>&nbsp;</td>

	      <td width="15%">No Ticket</td>
	      <td>:</td>
	      <td>
	      	<?php 
              
              if($row_pengajuan['nomor_bmhd'] == ''){ //jika pengajuan lama, sblm pemisahan nomor tiket

                // JK/BY/102520/0001
                $nojur1 = substr($row_pengajuan['nomor_jurnal'], 0,6);
                $nojur21 = substr($row_pengajuan['tanggal_proses_bayar'], 8,2);
                $nojur22 = substr($row_pengajuan['tanggal_proses_bayar'], 5,2);
                $nojur23 = substr($row_pengajuan['tanggal_proses_bayar'], 2,2);
                $nojur3 = substr($row_pengajuan['nomor_jurnal'], 12,5);
                echo $nojur1.$nojur21.'.'.$nojur22.'.'.$nojur23.'/'.$nojur3;

              }else{

                // JK/BMHD/102520/0001
                $nojur1 = substr($row_pengajuan['nomor_bmhd'], 0,8);
                $nojur21 = substr($row_pengajuan['nomor_bmhd'], 10,2);
                $nojur22 = substr($row_pengajuan['nomor_bmhd'], 8,2);
                $nojur23 = substr($row_pengajuan['nomor_bmhd'], 12,2);
                $nojur3 = substr($row_pengajuan['nomor_bmhd'], 15,4);
                echo $nojur1.$nojur21.'.'.$nojur22.'.'.$nojur23.'/'.$nojur3;
              }

            ?>
	      </td>
	    </tr>

	    <tr>
	      <td>No Referensi</td>
	      <td>:</td>
	      <td><?php echo $row_pengajuan['nomor_pengajuan'] ?></td>

	      <td>&nbsp;</td>

	      <td>Tanggal BMHD</td>
	      <td>:</td>
	      <td><?php echo date('d-m-Y',strtotime($row_pengajuan['tanggal_proses_bayar'])) ?></td>
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
          <td><?php echo $coa; ?></td>
          <td><?php echo strtoupper($nama_coa); ?></td>
          <td><?php echo $row_pengajuan['cabang'] ?></td>

          <td style="text-align: right;"><?php echo number_format($row_pengajuan['jumlah']+$row_pengajuan['ppn'],0,',','.') ?></td>
          <td style="text-align: right;">0</td>
        </tr>

        <?php if($row_pengajuan['pph23'] != 0){ ?>

          <tr>
            <td>240-002-000-000</td>
            <td>PPH23</td>
            <td><?php echo $row_pengajuan['cabang'] ?></td>
            <td style="text-align: right;">0</td>
            <td style="text-align: right;"><?php echo number_format($row_pengajuan['pph23'],0,',','.') ?></td>
          </tr>

        <?php } ?>

        <?php if($row_pengajuan['pph42'] != 0){ ?>

          <tr>
            <td>240-006-000-000</td>
            <td>PPH4(2)</td>
            <td><?php echo $row_pengajuan['cabang'] ?></td>
            <td style="text-align: right;">0</td>
            <td style="text-align: right;"><?php echo number_format($row_pengajuan['pph42'],0,',','.') ?></td>
          </tr>

        <?php } ?>


        <?php if($row_pengajuan['pph21'] != 0){ ?>

          <tr>
            <td>240-001-000-000</td>
            <td>PPH21</td>
            <td><?php echo $row_pengajuan['cabang'] ?></td>
            <td style="text-align: right;">0</td>
            <td style="text-align: right;"><?php echo number_format($row_pengajuan['pph21'],0,',','.') ?></td>
          </tr>

        <?php } ?>

        <tr>
          <td>245-999-000-000</td>
          <td>BIAYA MASIH HARUS DIBAYAR</td>
          <td><?php echo $row_pengajuan['cabang'] ?></td>
          <td style="text-align: right;">0</td>
          <td style="text-align: right;"><?php echo number_format($row_pengajuan['jumlah']+$row_pengajuan['ppn']-($row_pengajuan['pph23']+$row_pengajuan['pph42']+$row_pengajuan['pph21']),0,',','.') ?></td>
        </tr>

        <tr>
          <td colspan="3" style="text-align: right;font-weight: bold;">TOTAL</td>
          <td style="text-align: right;"><?php echo number_format($row_pengajuan['jumlah']+$row_pengajuan['ppn'],0,',','.') ?></td>

          <td style="text-align: right;"><?php echo number_format($row_pengajuan['jumlah']+$row_pengajuan['ppn'],0,',','.') ?></td>
        </tr>
	  </table>

	  <br><br>
      <b>Keterangan :</b> <?php echo $row_pengajuan['keterangan'] ?> <br><br>

      <div style="text-align: center">
        <b>Final Approved By <?php echo $row_pengajuan['approved_by'] ?> (<?php echo $row_pengajuan['nama_pengapprove'] ?>)</b><br>
        <b>On : <?php echo date('d-m-Y', strtotime($row_pengajuan['tanggal_approved'])) ?></b>
      </div><br>

    

</body>
<?php } ?>
</html>

