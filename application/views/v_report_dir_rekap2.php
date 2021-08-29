<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=report_dir_rekap.xls");

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
	<span style="margin-left: 20px; font-size: 20px"><b>REPORT PENGAJUAN (REKAP)</b></span><br>
</div>

<table>

	<tr>
		<th>DEPARTEMEN</th>
		<td>: <?php echo $departemen ?></td>
	</tr>

	<tr>
		<th>PERIODE</th>
		<td>: <?php echo date('d-m-Y', strtotime($tanggal_from)); ?> s/d <?php echo date('d-m-Y', strtotime($tanggal_to)); ?></td>
	</tr>

</table>

<br><br>

<table border="1">
	<thead>
		<tr style="background-color: silver">
			<th rowspan="2">Sub Biaya</th>
			<th colspan="2">Kadept</th>
			
			<th colspan="2">Kadiv</th>

			<th colspan="2">Direktur Bidang</th>
			
			<th colspan="2">Direktur Finance</th>
			
			<th colspan="2">Direktur Utama</th>
			
		</tr>

		<tr style="background-color: silver">
			
			<th>Total Approve</th>
			<th>Total Amount</th>
			<th>Total Approve</th>
			<th>Total Amount</th>
			<th>Total Approve</th>
			<th>Total Amount</th>
			<th>Total Approve</th>
			<th>Total Amount</th>
			<th>Total Approve</th>
			<th>Total Amount</th>

		</tr>
	</thead>

	<tbody>
		<?php  
			$dt_biaya = $this->db->query("SELECT DISTINCT sub_biaya FROM tbl_pengajuan WHERE dept_tujuan = '$departemen' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to')")->result_array();
			foreach($dt_biaya as $row_biaya){
			$sub_biaya = $row_biaya['sub_biaya'];
		?>

		<tr>
			<!-- Sub Biaya -->
			<td><?php echo $sub_biaya ?></td>

			<!-- Total Approve Kadept -->
			<td style="text-align: center">
				<?php  
					$app_kadept = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND sub_biaya='$sub_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='dept head pic'

					")->num_rows();

					echo $app_kadept;
				?>
			</td>

			<!-- Total Ammount Kadept -->
			<td style="text-align: right;">
				<?php  
					$amm_kadept = $this->db->query("SELECT SUM(jumlah+ppn-pph42-pph23-pph21) AS total FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND sub_biaya='$sub_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='dept head pic'

					")->row_array();

					echo number_format($amm_kadept['total'], 0 , '.', ',');
				?>
			</td>

			<!-- Total Approve Kadiv -->
			<td style="text-align: center">
				<?php  
					$app_kadiv = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND sub_biaya='$sub_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='division head'

					")->num_rows();

					echo $app_kadiv;
				?>
			</td>

			<!-- Total Ammount Kadiv -->
			<td style="text-align: right;">
				<?php  
					$amm_kadiv = $this->db->query("SELECT SUM(jumlah+ppn-pph42-pph23-pph21) AS total FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND sub_biaya='$sub_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='division head'

					")->row_array();

					echo number_format($amm_kadiv['total'], 0 , '.', ',');
				?>
			</td>

			<!-- Total Approve Direktur Bidang -->
			<td style="text-align: center;">
				<?php  
					$app_dir_bidang = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND sub_biaya='$sub_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director'

					")->num_rows();

					echo $app_dir_bidang;
				?>
			</td>

			<!-- Total Ammount Direktur Bidang -->
			<td style="text-align: right;">
				<?php  
					$amm_dir_bidang = $this->db->query("SELECT SUM(jumlah+ppn-pph42-pph23-pph21) AS total FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND sub_biaya='$sub_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director'

					")->row_array();

					echo number_format($amm_dir_bidang['total'], 0 , '.' , ',');
				?>
			</td>

			<!-- Total Approve Direktur Finance -->
			<td style="text-align: center">
				<?php  
					$app_dir_finance = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND sub_biaya='$sub_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director finance'

					")->num_rows();

					echo $app_dir_finance;
				?>
			</td>

			<!-- Total Ammount Direktur Finance -->
			<td style="text-align: right;">
				<?php  
					$amm_dir_finance = $this->db->query("SELECT SUM(jumlah+ppn-pph42-pph23-pph21) AS total FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND sub_biaya='$sub_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='director finance'

					")->row_array();

					echo number_format($amm_dir_finance['total'], 0 , '.' , ',');
				?>
			</td>

			<!-- Total Approve President Direktur -->
			<td style="text-align: center">
				<?php  
					$app_president = $this->db->query("SELECT * FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND sub_biaya='$sub_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='president director'

					")->num_rows();

					echo $app_president;
				?>
			</td>

			<!-- Total Ammount President Direktur -->
			<td style="text-align: right;">
				<?php  
					$amm_president = $this->db->query("SELECT SUM(jumlah+ppn-pph42-pph23-pph21) AS total FROM tbl_pengajuan WHERE
						dept_tujuan='$departemen' AND sub_biaya='$sub_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_approve='final approved' AND approved_by='president director'

					")->row_array();

					echo number_format($amm_president['total'], 0 , '.' , ',');
				?>
			</td>
		</tr>

		<?php } ?>

	</tbody>
</table>