<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=detail_leggen_pymt.xls");

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

			// Ambil Bank
	        $bank = $data['bank_bayar_penyelesaian'];

            // Ambil Nama & COA Bank
            $data_bank = $this->db->query("SELECT * FROM tbl_bank WHERE nama_bank='$bank'")->row_array();
            $coa_bank = $data_bank['coa_bank'];

		?>

		<tr>
			<td><?php echo $data_pengajuan['ref_no'].'PYMT-PY' ?></td>
			<td>1</td>
			<td><?php echo '245-999-000-000'; ?></td>
			<td class="str"><?php echo substr($data_pengajuan['ref_no'], 0,3) ?></td>

			<td><?php echo $data['kurang_bayar'] ?></td>

			<td>0</td>
			<td>0</td>
			<td>0</td>
		</tr>

			<?php if($data_pengajuan['cabang'] != 'HEAD OFFICE'){ ?>

				<tr>
					<td><?php echo $data_pengajuan['ref_no'].'PYMT-PY' ?></td>
					<td>2</td>
					<td>120-001-000-000</td>
					<td class="str"><?php echo substr($data_pengajuan['ref_no'], 0,3) ?></td>
					<td>0</td>

					<td><?php echo $data['kurang_bayar'] ?></td>

					<td>0</td>
					<td>0</td>
				</tr>

				<tr>
					<td><?php echo $data_pengajuan['ref_no'].'PYMT-PY' ?></td>
					<td>3</td>
					<td>120-001-000-000</td>
					<td class="str">000</td>

					<td><?php echo $data['kurang_bayar'] ?></td>

					<td>0</td>
					<td>0</td>
					<td>0</td>
				</tr>

				<tr>
					<td><?php echo $data_pengajuan['ref_no'].'PYMT-PY' ?></td>
					<td>4</td>
					<td><?php echo $coa_bank; ?></td>
					<td class="str">000</td>
					<td>0</td>

					<td><?php echo $data['kurang_bayar'] ?></td>

					<td>0</td>
					<td>0</td>
				</tr>

			<?php }else{ ?>

				<tr>
					<td><?php echo $data_pengajuan['ref_no'].'PYMT-PY' ?></td>
					<td>2</td>
					<td><?php echo $coa_bank; ?></td>
					<td class="str"><?php echo substr($data_pengajuan['ref_no'], 0,3) ?></td>
					<td>0</td>

					<td><?php echo $data['kurang_bayar'] ?></td>

					<td>0</td>
					<td>0</td>
				</tr>

			<?php } ?>

		<?php 
			}
		?>
	</tbody>
</table>