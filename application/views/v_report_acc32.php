<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=report_os_bmhd.xls");

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
	<span style="margin-left: 20px; font-size: 20px"><b>LAPORAN TRANSAKSI BMHD</b></span><br>
</div>

<table>
	<!-- <tr>
		<th>COA</th>
		<td>: <?php echo $coa.' '.$nama_coa ?></td>
	</tr> -->

	<tr>
		<th>PERIODE</th>
		<td>: <?php echo date('d-m-Y', strtotime($tanggal_from)); ?> s/d <?php echo date('d-m-Y', strtotime($tanggal_to)); ?></td>
	</tr>
</table>

<br><br>

<table border="1">
	<thead>
		<tr style="background-color: silver">
			<th>TANGGAL (BMHD)</th>
			<th>NOMOR PENGAJUAN</th>
			<th>CABANG</th>
			<th>DEPARTEMEN</th>
			<th>COA</th>
			<th>KETERANGAN</th>
			<th>JUMLAH (SEBELUM PAJAK)</th>
			<th>PPN</th>
			<th>PPH 23</th>
			<th>PPH 4(2)</th>
			<th>PPH 21</th>
			<th>TOTAL</th>
		</tr>
	</thead>

	<tbody>
		<?php

			$data = $this->db->query("SELECT * FROM tbl_pengajuan WHERE (tanggal_proses_bayar BETWEEN '$tanggal_from' AND '$tanggal_to') ORDER BY tanggal_proses_bayar DESC")->result_array();

			foreach($data as $row){

			// ambil coa
			$sub_biaya = $row['sub_biaya'];
			$dt_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya'")->row_array();
		?>
		<tr>
			<td><?php echo date('d-m-Y', strtotime($row['tanggal_proses_bayar'])) ?></td>
			<td><?php echo $row['nomor_pengajuan'] ?></td>
			<td><?php echo $row['cabang'] ?></td>
			<td><?php echo $row['bagian'] ?></td>
			<td><?php echo $dt_coa['coa'].' '.$dt_coa['nama_coa'] ?></td>
			<td><?php echo $row['keterangan'] ?></td>
			<td style="text-align: right;"><?php echo $row['jumlah'] ?></td>
			<td style="text-align: right;"><?php echo $row['ppn'] ?></td>
			<td style="text-align: right;"><?php echo $row['pph23'] ?></td>
			<td style="text-align: right;"><?php echo $row['pph42'] ?></td>
			<td style="text-align: right;"><?php echo $row['pph21'] ?></td>
			<td style="text-align: right;"><?php echo $row['jumlah']+$row['ppn']-($row['pph23']+$row['pph42']+$row['pph21']) ?></td>
		</tr>
		<?php } ?>

		<?php  
			// Ambil Totalan

			$data_total = $this->db->query("SELECT SUM(jumlah) AS jumlah_total, SUM(ppn) AS total_ppn, SUM(pph23) AS total_pph23, SUM(pph42) AS total_pph42, SUM(pph21) AS total_pph21, SUM(total) AS grand_total FROM tbl_pengajuan WHERE (tanggal_proses_bayar BETWEEN '$tanggal_from' AND '$tanggal_to')")->row_array();
		?>
		<tr style="background-color: silver">
			<td colspan="6" style="text-align: center">TOTAL</td>
			<td style="text-align: right;"><?php echo $data_total['jumlah_total'] ?></td>
			<td style="text-align: right;"><?php echo $data_total['total_ppn'] ?></td>
			<td style="text-align: right;"><?php echo $data_total['total_pph23'] ?></td>
			<td style="text-align: right;"><?php echo $data_total['total_pph42'] ?></td>
			<td style="text-align: right;"><?php echo $data_total['total_pph21'] ?></td>
			<td style="text-align: right;"><?php echo $data_total['jumlah_total']+$data_total['total_ppn']-($data_total['total_pph23']+$data_total['total_pph42']+$data_total['total_pph21']) ?></td>
		</tr>
	</tbody>
</table>