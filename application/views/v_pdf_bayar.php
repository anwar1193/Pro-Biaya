<!DOCTYPE html>
<html>
<head>
	<title>Rekap Pembayaran</title>
</head>
<body onload="window.print()">

	<h3 style="text-align: center">Rekap Biaya Harus Dibayar <br> 
	Tanggal <?php echo date('d-m-Y', strtotime($tanggal)) ?></h3>

	<h3 style="text-align: center">
		Total Bayar : <?php echo 'Rp '.number_format($total_bayar_displit,0,',','.') ?> <!-- rentan cek berkali2 -->
	</h3>

	<br>
	<center>
	<table width="60%">
		<?php 
			foreach($data_pengajuan as $row_pengajuan){ 
				$nopeng = $row_pengajuan['nomor_pengajuan'];

				// cari frekuensi bayar by nomor pengajuan
                 $frek_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$nopeng'")->num_rows();
		?>
		<tr>
			<th>No Pengajuan</th>
			<td>:</td>
			<td><?php echo $row_pengajuan['nomor_pengajuan'] ?></td>
		</tr>

		<tr>
			<th>Nomor Invoice</th>
			<td>:</td>
			<td><?php echo $row_pengajuan['nomor_invoice'] ?></td>
		</tr>

		<tr>
			<th>Cabang</th>
			<td>:</td>
			<td><?php echo $row_pengajuan['cabang'] ?></td>
		</tr>

		<tr>
			<th>Departemen</th>
			<td>:</td>
			<td>
				<?php
					if($row_pengajuan['cabang'] == 'HEAD OFFICE'){
						echo $row_pengajuan['bagian'];
					}else{
						echo $row_pengajuan['level_pengaju'];
					}
				?>
			</td>
		</tr>

		<tr>
			<th>Biaya</th>
			<td>:</td>
			<td><?php echo $row_pengajuan['sub_biaya'] ?></td>
		</tr>

		<?php if($frek_byr == 1){ //Jika pembayaran Hanya sekali, ambil dari tbl_pengajuan ?>

			<tr>
				<th>Jumlah Biaya</th>
				<td>:</td>
				<td><?php echo 'Rp '.number_format($row_pengajuan['jumlah']+$row_pengajuan['ppn']-($row_pengajuan['pph23'] + $row_pengajuan['pph42'] + $row_pengajuan['pph21']), 0, ',', '.') ?></td>
			</tr>

		<?php }else{ // Jika pembayaran lebih dari sekali, ambil dari tbl_bayar ?>

			<tr>
				<th>Jumlah Biaya</th>
				<td>:</td>
				<td><?php echo 'Rp '.number_format($row_pengajuan['jumlah_bayar']+$row_pengajuan['ppn_bayar']-($row_pengajuan['pph23_bayar'] + $row_pengajuan['pph42_bayar'] + $row_pengajuan['pph21_bayar']), 0, ',', '.') ?></td>
			</tr>

		<?php } ?>

		<tr>
			<th>Nama Bank</th>
			<td>:</td>
			<td><?php echo $row_pengajuan['bank_penerima'] ?></td>
		</tr>

		<tr>
			<th>No Rekening</th>
			<td>:</td>
			<td><?php echo $row_pengajuan['norek_penerima'] ?></td>
		</tr>

		<tr>
			<th>Atas Nama</th>
			<td>:</td>
			<td><?php echo $row_pengajuan['atas_nama'] ?></td>
		</tr>

		<tr>
			<th>Keterangan</th>
			<td>:</td>
			<td><?php echo $row_pengajuan['keterangan'] ?></td>
		</tr>

		<tr>
			<td colspan="3"><hr></td>
		</tr>

		<?php } ?>
	</table>


</body>
</html>