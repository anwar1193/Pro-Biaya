<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=report_transaksi_payment.xls");

	date_default_timezone_set("Asia/Jakarta");

?>

<style>
	table,th,td{
		border-collapse: collapse;
		padding: 15px;
		margin: 10px;
		color: #000;
	}

	.str{ mso-number-format:\@; }
</style>

<div>
	<span style="margin-left: 20px; font-size: 20px"><b>LAPORAN TRANSAKSI PAYMENT</b></span><br>
</div>

<table>

	<tr>
		<th>PERIODE</th>
		<td>: <?php echo date('d-m-Y', strtotime($tanggal_from)); ?> s/d <?php echo date('d-m-Y', strtotime($tanggal_to)); ?></td>
	</tr>

</table>

<br><br>

<table border="1">
	<thead>
		<tr style="background-color: silver">
			<th>TANGGAL (Payment)</th>
			<th>NOMOR PENGAJUAN</th>
			<th>CABANG</th>
			<th>DEPARTEMEN</th>
			<th>COA</th>
			<th>KETERANGAN</th>
			<th>BANK</th>
			<th>TOTAL</th>
		</tr>
	</thead>

	<tbody>
		<?php  

			$data = $this->db->query("SELECT * FROM tbl_pengajuan INNER JOIN tbl_bayar USING(nomor_pengajuan) WHERE (tbl_pengajuan.tanggal_bayar BETWEEN '$tanggal_from' AND '$tanggal_to') ORDER BY tbl_pengajuan.tanggal_bayar")->result_array();

			foreach($data as $row){
			
			// ambil tanggal bayar 
			$nopeng = $row['nomor_pengajuan'];
			$data2 = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan = '$nopeng'")->row_array();
			$tgl_bayar = $data2['tanggal_bayar'];

			// ambil nama bank
			$id_bank = $row['bank_bayar'];
            $data_bank = $this->db->query("SELECT * FROM tbl_bank WHERE id=$id_bank")->row_array();
            $nama_bank = $data_bank['nama_bank'];

            // ambil coa
            $sub_biaya = $row['sub_biaya'];
            $dt_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya'")->row_array();
		?>
		<tr>
			<td><?php echo date('d-m-Y', strtotime($data2['tanggal_bayar'])) ?></td>
			<td><?php echo $row['nomor_pengajuan'] ?></td>
			<td><?php echo $row['cabang'] ?></td>
			<td><?php echo $row['bagian'] ?></td>
			<td><?php echo $dt_coa['coa'] ?></td>
			<td><?php echo $row['keterangan'] ?></td>
			<td><?php echo $nama_bank ?></td>
			<td style="text-align: right;"><?php echo $row['jumlah_bayar'] ?></td>
		</tr>
		<?php } ?>

		<?php  
			// Cari Total
			// $data_total = $this->db->query("SELECT SUM(total) AS total_jumlah FROM tbl_pengajuan WHERE (tanggal_bayar BETWEEN '$tanggal_from' AND '$tanggal_to')")->row_array();

			$data_total = $this->db->query("SELECT SUM(tbl_bayar.jumlah_bayar) AS total_jumlah FROM tbl_pengajuan INNER JOIN tbl_bayar USING(nomor_pengajuan) WHERE (tbl_pengajuan.tanggal_bayar BETWEEN '$tanggal_from' AND '$tanggal_to')")->row_array();

			$total_biaya = $data_total['total_jumlah'];
		?>
		<tr style="background-color: silver">
			<td colspan="7" style="text-align: center; font-weight: bold">TOTAL</td>
			<td style="text-align: right;"><?php echo $total_biaya ?></td>
		</tr>

	</tbody>
</table>