<?php  
  // Cari Total Bayar
  $total_bayar = 0;
  foreach($data_penyelesaian as $row){
      $total_bayar += $row['kurang_bayar'];
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rekap Pembayaran</title>
</head>
<body onload="window.print()">

	<h3 style="text-align: center">Rekap Penyelesaian Harus Dibayar <br> 
	Tanggal <?php echo date('d-m-Y', strtotime($tanggal)) ?></h3>

	<h3 style="text-align: center">
		Total Bayar : <?php echo 'Rp '.number_format($total_bayar,0,',','.') ?> <!-- rentan cek berkali2 -->
	</h3>

	<br>
	<center>
	<table width="60%">
		<?php 
			foreach($data_penyelesaian as $row_penyelesaian){ 
				$nopeng = $row_penyelesaian['nomor_pengajuan'];

                // Ambil Data Pengajuan Untuk Kelengkapan Data
                $data_pengajuan = $this->M_master->tampil_data_where('tbl_pengajuan', array('nomor_pengajuan' => $nopeng))->row_array();
                
		?>
		<tr>
			<th>No Pengajuan</th>
			<td>:</td>
			<td><?php echo $row_penyelesaian['nomor_pengajuan'] ?></td>
		</tr>

		<tr>
			<th>Nomor Invoice</th>
			<td>:</td>
			<td><?php echo $row_penyelesaian['nomor_invoice'] ?></td>
		</tr>

		<tr>
			<th>Cabang</th>
			<td>:</td>
			<td><?php echo $data_pengajuan['cabang'] ?></td>
		</tr>

		<tr>
			<th>Departemen</th>
			<td>:</td>
			<td>
				<?php
					if($data_pengajuan['cabang'] == 'HEAD OFFICE'){
						echo $data_pengajuan['bagian'];
					}else{
						echo $data_pengajuan['level_pengaju'];
					}
				?>
			</td>
		</tr>

		<tr>
			<th>Biaya</th>
			<td>:</td>
			<td><?php echo $data_pengajuan['sub_biaya'] ?></td>
		</tr>

		<tr>
			<th>Jumlah Biaya</th>
			<td>:</td>
			<td><?php echo 'Rp '.number_format($row_penyelesaian['kurang_bayar'], 0, ',', '.') ?></td>
		</tr>

		<tr>
			<th>Nama Bank</th>
			<td>:</td>
			<td><?php echo $row_penyelesaian['bank'] ?></td>
		</tr>

		<tr>
			<th>No Rekening</th>
			<td>:</td>
			<td><?php echo $row_penyelesaian['nomor_rekening'] ?></td>
		</tr>

		<tr>
			<th>Atas Nama</th>
			<td>:</td>
			<td><?php echo $row_penyelesaian['atas_nama_bank'] ?></td>
		</tr>

		<tr>
			<th>Keterangan</th>
			<td>:</td>
			<td><?php echo $row_penyelesaian['kronologis'] ?></td>
		</tr>

		<tr>
			<td colspan="3"><hr></td>
		</tr>

		<?php } ?>
	</table>


</body>
</html>