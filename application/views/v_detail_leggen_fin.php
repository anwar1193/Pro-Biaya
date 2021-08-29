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

			// Ambil Bank
	          $id_bank = $data['bank_bayar'];

	          // Ambil Nama & COA Bank
	          $data_bank = $this->db->query("SELECT * FROM tbl_bank WHERE id=$id_bank")->row_array();
	          $nama_bank = $data_bank['nama_bank'];
	          $coa_bank = $data_bank['coa_bank'];

			//   Cek apakah data sekali pembayaran atau lebih dari sekali
			$nopeng = $data['nomor_pengajuan'];
			$cek_tipe_pembayaran = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan = '$nopeng'")->num_rows();

		?>

		<tr>
			<td><?php echo $data['ref_no'].'PYMT' ?></td>
			<td>1</td>
			<td><?php echo '245-999-000-000'; ?></td>
			<td class="str"><?php echo substr($data['ref_no'], 0,3) ?></td>

			<?php if($cek_tipe_pembayaran > 1){ ?>
				<td><?php echo $data['jumlah_bayar']+$data['ppn_bayar']-($data['pph23_bayar']+$data['pph42_bayar']+$data['pph21_bayar']) ?></td>
			<?php }else{ ?>
				<td><?php echo $data['jumlah']+$data['ppn']-($data['pph23']+$data['pph42']+$data['pph21']) ?></td>
			<?php } ?>

			<td>0</td>
			<td>0</td>
			<td>0</td>
		</tr>

			<?php if($data['cabang'] != 'HEAD OFFICE'){ ?>

				<tr>
					<td><?php echo $data['ref_no'].'PYMT' ?></td>
					<td>2</td>
					<td>120-001-000-000</td>
					<td class="str"><?php echo substr($data['ref_no'], 0,3) ?></td>
					<td>0</td>

					<?php if($cek_tipe_pembayaran > 1){ ?>
						<td><?php echo $data['jumlah_bayar']+$data['ppn_bayar']-($data['pph23_bayar']+$data['pph42_bayar']+$data['pph21_bayar']) ?></td>
					<?php }else{ ?>
						<td><?php echo $data['jumlah']+$data['ppn']-($data['pph23']+$data['pph42']+$data['pph21']) ?></td>
					<?php } ?>

					<td>0</td>
					<td>0</td>
				</tr>

				<tr>
					<td><?php echo $data['ref_no'].'PYMT' ?></td>
					<td>3</td>
					<td>120-001-000-000</td>
					<td class="str">000</td>

					<?php if($cek_tipe_pembayaran > 1){ ?>
						<td><?php echo $data['jumlah_bayar']+$data['ppn_bayar']-($data['pph23_bayar']+$data['pph42_bayar']+$data['pph21_bayar']) ?></td>
					<?php }else{ ?>
						<td><?php echo $data['jumlah']+$data['ppn']-($data['pph23']+$data['pph42']+$data['pph21']) ?></td>
					<?php } ?>

					<td>0</td>
					<td>0</td>
					<td>0</td>
				</tr>

				<tr>
					<td><?php echo $data['ref_no'].'PYMT' ?></td>
					<td>4</td>
					<td><?php echo $coa_bank; ?></td>
					<td class="str">000</td>
					<td>0</td>

					<?php if($cek_tipe_pembayaran > 1){ ?>
						<td><?php echo $data['jumlah_bayar']+$data['ppn_bayar']-($data['pph23_bayar']+$data['pph42_bayar']+$data['pph21_bayar']) ?></td>
					<?php }else{ ?>
						<td><?php echo $data['jumlah']+$data['ppn']-($data['pph23']+$data['pph42']+$data['pph21']) ?></td>
					<?php } ?>

					<td>0</td>
					<td>0</td>
				</tr>

			<?php }else{ ?>

				<tr>
					<td><?php echo $data['ref_no'].'PYMT' ?></td>
					<td>2</td>
					<td><?php echo $coa_bank; ?></td>
					<td class="str"><?php echo substr($data['ref_no'], 0,3) ?></td>
					<td>0</td>

					<?php if($cek_tipe_pembayaran > 1){ ?>
						<td><?php echo $data['jumlah_bayar']+$data['ppn_bayar']-($data['pph23_bayar']+$data['pph42_bayar']+$data['pph21_bayar']) ?></td>
					<?php }else{ ?>
						<td><?php echo $data['jumlah']+$data['ppn']-($data['pph23']+$data['pph42']+$data['pph21']) ?></td>
					<?php } ?>

					<td>0</td>
					<td>0</td>
				</tr>

			<?php } ?>

		<?php 
			}
		?>
	</tbody>
</table>