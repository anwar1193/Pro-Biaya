<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=header_leggen.xls");

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
		<tr>
			<td><?php echo "'".$row['ref_no'] ?></td>
			<td>9</td>
			<td>
				<?php 
                  // JK/BY/102020/0001
                  $nojur1 = substr($row['nomor_jurnal'], 0,6);
                  $nojur21 = substr($row['nomor_jurnal'], 6,2);
                  $nojur22 = substr($row['nomor_jurnal'], 8,2);
                  $nojur23 = substr($row['nomor_jurnal'], 10,2);
                  $nojur3 = substr($row['nomor_jurnal'], 12,5);
                  echo $nojur1.$nojur21.'.'.$nojur22.'.'.$nojur23.$nojur3;
                ?>
			</td>
			<td><?php echo $row['tanggal'] ?></td>
			<td><?php echo $row['tanggal'] ?></td>
			<td>JK</td>
			<td>IDR</td>
			<td><?php echo $row['sub_biaya'] ?></td>
		</tr>
	</tbody>
</table>