<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=report_dir_rincian.xls");

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
	<span style="margin-left: 20px; font-size: 20px"><b>REPORT PENGAJUAN (RINCIAN)</b></span><br>
</div>

<table>

	<tr>
		<th>DEPARTEMEN</th>
		<td>: <?php echo strtoupper($departemen) ?></td>
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
			
			<th width="5%" style="text-align: center">NO</th>
          	<th>Tanggal</th>
	        <th>NO Pengajuan</th>
	        <th>Cabang</th>
	        <th>Dept</th>
	        <th>Jenis Biaya</th>
	        <th>Sub Biaya</th>
	        <th>Jumlah Biaya</th>
	        <th style="text-align: center">Sts Approve</th>
	        <th style="text-align: center">Sts Check</th>
	        <th style="text-align: center">Sts Bayar</th>

		</tr>
	</thead>

	<tbody>
		<?php  
			$no=1;
			foreach($data_pengajuan as $row_pengajuan){
		?>

		<tr>
			<td><?php echo $no++; ?></td>
			<td style="text-align: center"><?php echo date('d-m-Y', strtotime($row_pengajuan['tanggal'])) ?></td>
			<td><?php echo $row_pengajuan['nomor_pengajuan'] ?></td>
			<td><?php echo $row_pengajuan['cabang'] ?></td>
			<td><?php echo $row_pengajuan['bagian'] ?></td>
			<td><?php echo $row_pengajuan['jenis_biaya'] ?></td>
			<td><?php echo $row_pengajuan['sub_biaya'] ?></td>
			<td><?php echo number_format($row_pengajuan['jumlah']+$row_pengajuan['ppn']-$row_pengajuan['pph23']-$row_pengajuan['pph42']-$row_pengajuan['pph21'], 0, '.' , ',') ?></td>

			<!-- Kolom Status Approve -->
	          <?php if($row_pengajuan['status_approve'] == 'on proccess'){ ?>

	            <td style="color: blue; "><?php echo $row_pengajuan['status_approve'] ?></td>

	            <?php }else if($row_pengajuan['status_approve'] == 'approved'){ ?>

	              <td style="color: green; ">
	                <?php echo '- '.$row_pengajuan['status_approve'].' by '.$row_pengajuan['approved_by'].' -'.'<br>'.$row_pengajuan['nama_pengapprove'] ?>
	              </td>

	            <?php }else if($row_pengajuan['status_approve'] == 'final approved'){ ?>

	              <td style="color: green; ">
	                <?php echo '- '.$row_pengajuan['status_approve'].' by '.$row_pengajuan['approved_by'].' -'.'<br>'.$row_pengajuan['nama_pengapprove'] ?>
	              </td>

	            <?php }else if($row_pengajuan['status_approve'] == 'cancel' || $row_pengajuan['status_approve'] == 'cancel by request'){ ?>

	              <td style="color: red; ">
	                <?php echo $row_pengajuan['status_approve'] ?>
	              </td>

	            <?php }else if($row_pengajuan['status_approve'] == 'rejected'){ ?>

	              <td style="color: red; ">
	                <?php echo '- '.$row_pengajuan['status_approve'].' by '.$row_pengajuan['approved_by'].' -'.'<br>'.$row_pengajuan['nama_pengapprove'] ?>
	              </td>

	            <?php }else if($row_pengajuan['status_approve'] == 'revisi'){ ?>

	              <td style="color: orange; ">
	                <?php echo '- '.$row_pengajuan['status_approve'].' by '.$row_pengajuan['approved_by'].' -'.'<br>'.$row_pengajuan['nama_pengapprove'] ?>
	              </td>

	            <?php } ?>
	            <!-- / Kolom Status Approve -->


	            <!-- Kolom Status Check -->
	            <?php if($row_pengajuan['status_approve'] != 'final approved'){ ?>

	                <td style="">
	                  -
	                </td>

	            <?php }else{ ?>

	              <?php if($row_pengajuan['status_check'] == ''){ ?>
	                <td style="color: blue; ">
	                  On Proccess
	                </td>
	              <?php }else if($row_pengajuan['status_check'] == 'Checked'){ ?>
	                <td style="color: green; ">
	                  <?php echo '- '.$row_pengajuan['status_check'].' by '.$row_pengajuan['checked_by'].' -'; ?>
	                </td>
	              <?php }else if($row_pengajuan['status_check'] == 'Pending'){ ?>
	                <td style="color: orange; ">
	                  <?php echo '- '.$row_pengajuan['status_check'].' by '.$row_pengajuan['checked_by'].' -'; ?>
	                </td>
	              <?php } ?>

	            <?php } ?>
	            <!-- / Kolom Status Check -->


	            <!-- Kolom Status Bayar -->
	            <?php if($row_pengajuan['status_check'] == 'Checked'){ ?>

	              <?php if($row_pengajuan['status_bayar'] == 'Telah Dibayar' || $row_pengajuan['status_bayar'] == 'Proses Bayar'){ ?>
	                <td style="color: green; ">
	                  <?php echo $row_pengajuan['status_bayar'] ?>
	                </td>
	              <?php }else{ ?>
	                <td style="color: blue; ">
	                  Proses Check
	                </td>
	              <?php } ?>

	            <?php }else{ ?>
	              <td style="color: blue; ">
	                -
	              </td>
	            <?php } ?>
	            <!-- / Kolom Status Bayar -->
		</tr>

		<?php } ?>

	</tbody>
</table>