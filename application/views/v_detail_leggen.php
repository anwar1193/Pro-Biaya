<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=detail_leggen.xls");

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
	<span style="margin-left: 20px; font-size: 20px"><b>DETAIL DATA</b></span>
</div>

<table border="1">
	<thead>
		<tr>
			<th>RefNo</th>
			<th>RowNO</th>
			<th>COANo</th>
			<th>SegID1Code</th>
			<th>Debet</th>
			<th>Credit</th>
			<th>Debet Forex</th>
			<th>Credit Forex</th>
		</tr>
	</thead>	

	<tbody>
		<tr>
			<td><?php echo "'".$row['ref_no'] ?></td>
			<td>1</td>
			<td><?php echo $coa; ?></td>
			<td><?php echo "'".substr($row['ref_no'], 0,3) ?></td>
			<td><?php echo number_format($row['total']+$row['pph23']+$row['pph42']+$row['pph21'],0,',','.') ?></td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
		</tr>

		<tr>
			<td><?php echo "'".$row['ref_no'] ?></td>
			<td>2</td>
			<td>245-999-000-000</td>
			<td><?php echo "'".substr($row['ref_no'], 0,3) ?></td>
			<td>0</td>
			<td><?php echo number_format($row['total']+$row['pph23']+$row['pph42']+$row['pph21'],0,',','.') ?></td>
			<td>0</td>
			<td>0</td>
		</tr>
	</tbody>
</table>