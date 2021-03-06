<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=header_leggen_bmhd.xls");

?>

<style>
	table,th,td{
		border-collapse: collapse;
		padding: 15px;
		margin: 10px;
		color: #000;
	}
</style>

<div style="text-align: center;">
	<span style="margin-left: 20px; font-size: 20px"><b>HEADER DATA</b></span>
</div>

<table border="1">
	<thead>
		<tr>
			<th>RefNo</th>
			<th>Source</th>
			<th>BookCode</th>
			<th>TxnDate</th>
			<th>ValueDate</th>
			<th>Journal Type</th>
			<th>CurrencyCode</th>
			<th>Description</th>
		</tr>
	</thead>	

	<tbody>
		<?php foreach($row as $data){ 
			date_default_timezone_set("Asia/Jakarta");
			$tanggal_proses_bayar0 = $data['tanggal_proses_bayar_penyelesaian'];
			$tanggal_proses_bayar = date('Y-m-d', strtotime($tanggal_proses_bayar0));
            $nomor_pengajuan = $data['nomor_pengajuan'];

            // Ambil Data Pengajuan Sebelumnya
            $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$nomor_pengajuan'")->row_array();
            $ref_no = $data_pengajuan['ref_no'];
		?>
		<tr>
			<td><?php echo $ref_no.'BMHD' ?></td>
			<td>9</td>
			<td>BMHD</td>
			<td><?php echo $tanggal_proses_bayar ?></td>
			<td><?php echo $tanggal_proses_bayar ?></td>
			<td>JK</td>
			<td>IDR</td>
			<td><?php echo $data['nomor_pengajuan'] ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>