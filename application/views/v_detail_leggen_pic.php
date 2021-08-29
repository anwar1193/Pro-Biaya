<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=detail_leggen_bmhd.xls");

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

			// Ambil COA (Nomor Perkiraan)
			$sub_biaya = $data['sub_biaya'];
			$dept = $data['bagian'];
			$ambil_coa = $this->db->query("SELECT * FROM tbl_relasi_sub WHERE sub_biaya='$sub_biaya' AND departemen='$dept'")->row_array();
			$coa = $ambil_coa['coa'];

		?>

		<tr>
			<td><?php echo $data['ref_no'].'BMHD' ?></td>
			<td>1</td>
			<td><?php echo $coa; ?></td>
			<td class="str"><?php echo substr($data['ref_no'], 0,3) ?></td>
			<td><?php echo $data['jumlah']+$data['ppn'] ?></td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
		</tr>

		<?php if($data['pph23'] != 0){ ?>
		<tr>
			<td><?php echo $data['ref_no'].'BMHD' ?></td>
			<td>2</td>
			<td>240-002-000-000</td>
			<td class="str"><?php echo substr($data['ref_no'], 0,3) ?></td>
			<td>0</td>
			<td><?php echo $data['pph23'] ?></td>
			<td>0</td>
			<td>0</td>
		</tr>

		<tr>
			<td><?php echo $data['ref_no'].'BMHD' ?></td>
			<td>3</td>
			<td>245-999-000-000</td>
			<td class="str"><?php echo substr($data['ref_no'], 0,3) ?></td>
			<td>0</td>
			<td><?php echo $data['jumlah']+$data['ppn']-($data['pph23']+$data['pph42']+$data['pph21']) ?></td>
			<td>0</td>
			<td>0</td>
		</tr>
		<?php } ?>

		<?php if($data['pph42'] != 0){ ?>
		<tr>
			<td><?php echo $data['ref_no'].'BMHD' ?></td>
			<td>2</td>
			<td>240-006-000-000</td>
			<td class="str"><?php echo substr($data['ref_no'], 0,3) ?></td>
			<td>0</td>
			<td><?php echo $data['pph42'] ?></td>
			<td>0</td>
			<td>0</td>
		</tr>

		<tr>
			<td><?php echo $data['ref_no'].'BMHD' ?></td>
			<td>3</td>
			<td>245-999-000-000</td>
			<td class="str"><?php echo substr($data['ref_no'], 0,3) ?></td>
			<td>0</td>
			<td><?php echo $data['jumlah']+$data['ppn']-($data['pph23']+$data['pph42']+$data['pph21']) ?></td>
			<td>0</td>
			<td>0</td>
		</tr>
		<?php } ?>

		<?php if($data['pph21'] != 0){ ?>
		<tr>
			<td><?php echo $data['ref_no'].'BMHD' ?></td>
			<td>2</td>
			<td>240-001-000-000</td>
			<td class="str"><?php echo substr($data['ref_no'], 0,3) ?></td>
			<td>0</td>
			<td><?php echo $data['pph21'] ?></td>
			<td>0</td>
			<td>0</td>
		</tr>

		<tr>
			<td><?php echo $data['ref_no'].'BMHD' ?></td>
			<td>3</td>
			<td>245-999-000-000</td>
			<td class="str"><?php echo substr($data['ref_no'], 0,3) ?></td>
			<td>0</td>
			<td><?php echo $data['jumlah']+$data['ppn']-($data['pph23']+$data['pph42']+$data['pph21']) ?></td>
			<td>0</td>
			<td>0</td>
		</tr>
		<?php } ?>

		<?php if($data['pph21'] == 0 AND $data['pph23'] == 0 AND $data['pph42'] == 0){ ?>
		<tr>
			<td><?php echo $data['ref_no'].'BMHD' ?></td>
			<td>2</td>
			<td>245-999-000-000</td>
			<td class="str"><?php echo substr($data['ref_no'], 0,3) ?></td>
			<td>0</td>
			<td><?php echo $data['jumlah']+$data['ppn']-($data['pph23']+$data['pph42']+$data['pph21']) ?></td>
			<td>0</td>
			<td>0</td>
		</tr>
		<?php } ?>

		<?php 
			}
		?>
	</tbody>
</table>