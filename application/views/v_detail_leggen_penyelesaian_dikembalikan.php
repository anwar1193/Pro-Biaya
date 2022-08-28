<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=detail_leggen_dikembalikan.xls");

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
		<?php 
			foreach($row as $data){

            $nomor_pengajuan = $data['nomor_pengajuan'];
            $data_pengajuan = $this->db->query("SELECT * FROM tbl_pengajuan WHERE nomor_pengajuan = '$nomor_pengajuan'")->row_array();

			// Ambil COA (Nomor Perkiraan)
			$sub_biaya = $data['sub_biaya'];
			$dept = $data_pengajuan['bagian'];
			$dept_ex = 'EX '.$dept;

			$ambil_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya' AND (departemen='$dept' OR departemen='$dept_ex')")->row_array();
			$coa = $ambil_coa['coa'];

		?>

		<tr>
			<td><?php echo $data_pengajuan['ref_no'].'PYPB' ?></td>
			<td>1</td>
			<td>115-001-028-000</td>
			<td class="str"><?php echo substr($data_pengajuan['ref_no'], 0,3) ?></td>
			<td><?php echo $data['selisih'] ?></td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
		</tr>

        <tr>
			<td><?php echo $data_pengajuan['ref_no'].'PYPB' ?></td>
			<td>2</td>
			<td><?php echo $coa; ?></td>
			<td class="str"><?php echo substr($data_pengajuan['ref_no'], 0,3) ?></td>
			<td>0</td>
			<td><?php echo $data['selisih'] ?></td>
			<td>0</td>
			<td>0</td>
		</tr>

		<?php 
			}
		?>
	</tbody>
</table>