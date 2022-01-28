<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=header_leggen_pymt.xls");

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
		<?php 
            foreach($row as $data){ 
                $nomor_pengajuan = $data['nomor_pengajuan'];
                $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan='$nomor_pengajuan'")->row_array();

        ?>
		<tr>
			<td><?php echo $data_pengajuan['ref_no'].'PYMT' ?></td>
			<td>9</td>
			<td>PYMT</td>

			<td><?php echo $data['tanggal_bayar_penyelesaian'] ?></td>
			<td><?php echo $data['tanggal_bayar_penyelesaian'] ?></td>

			<td>JK</td>
			<td>IDR</td>
			<td><?php echo $data['nomor_pengajuan'] ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>