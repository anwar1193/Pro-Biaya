<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=report_cab_dept.xls");

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
	<span style="margin-left: 20px; font-size: 20px"><b>LAPORAN PENGELUARAN OPEX DAN CAPEX</b></span><br>
</div>

<table width="300px">
	<tr>
		<th>WILAYAH</th>
		<td>:</td>
		<td><?php echo $data_wilayah['wilayah'] ?></td>
	</tr>

	<tr>
		<th>CABANG</th>
		<td>:</td>
		<td><?php echo $cabang; ?></td>
	</tr>

	<tr>
		<th>BAGIAN/DEPARTEMEN</th>
		<td>:</td>
		<td><?php echo $departemen; ?></td>
	</tr>

	<tr>
		<th>PERIODE</th>
		<td>:</td>
		<td>Jan-21 s/d Des-21</td>
	</tr>
</table>

<table border="1">
	<thead>
		<tr>
			<th rowspan="2" style="background-color: silver; color: white">RINCIAN</th>
			<th colspan="13" style="background-color: blue; color: white; text-align: center">TAHUN 2021</th>
			<!-- <th>Nama Bulan</th>
			<th>Nama Bulan</th>
			<th>Nama Bulan</th>
			<th>Nama Bulan</th>
			<th>Nama Bulan</th>
			<th>Nama Bulan</th>
			<th>Nama Bulan</th>
			<th>Nama Bulan</th>
			<th>Nama Bulan</th>
			<th>Nama Bulan</th>
			<th>Nama Bulan</th> -->
		</tr>

		<tr>
			<!-- <th>RINCIAN</th> -->
			<th style="background-color: blue; color: white">JANUARI</th>
			<th style="background-color: blue; color: white">FEBRUARI</th>
			<th style="background-color: blue; color: white">MARET</th>
			<th style="background-color: blue; color: white">APRIL</th>
			<th style="background-color: blue; color: white">MEI</th>
			<th style="background-color: blue; color: white">JUNI</th>
			<th style="background-color: blue; color: white">JULI</th>
			<th style="background-color: blue; color: white">AGUSTUS</th>
			<th style="background-color: blue; color: white">SEPTEMBER</th>
			<th style="background-color: blue; color: white">OKTOBER</th>
			<th style="background-color: blue; color: white">NOVEMBER</th>
			<th style="background-color: blue; color: white">DESEMBER</th>
			<th style="background-color: blue; color: white">TOTAL</th>
		</tr>
	</thead>

	<tbody id="table_data">

		<tr style="background-color: orange">
			<th colspan="14" style="text-align: left;">OPEX</th>
		</tr>

		<?php foreach($data_opex as $row_opex){ 
			$jenis_biaya = $row_opex['jenis_biaya'];
		?>
		<tr>
			<td><?php echo $jenis_biaya; ?></td>

			<!-- OPEX januari -->
			<td style="text-align: right;">
				<?php
					if($departemen == 'All'){
						$opex_januari = $this->db->query("SELECT SUM(total) AS total_januari FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='01' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_januari = $this->db->query("SELECT SUM(total) AS total_januari FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='01' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}
					
					echo $opex_januari['total_januari'];
				?>
			</td>

			<!-- OPEX februari -->
			<td style="text-align: right;">
				<?php
					if($departemen == 'All'){
						$opex_februari = $this->db->query("SELECT SUM(total) AS total_februari FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='02' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_februari = $this->db->query("SELECT SUM(total) AS total_februari FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='02' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}  
					
					echo $opex_februari['total_februari'];
				?>
			</td>

			<!-- OPEX maret -->
			<td style="text-align: right;">
				<?php  
					if($departemen == 'All'){
						$opex_maret = $this->db->query("SELECT SUM(total) AS total_maret FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='03' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_maret = $this->db->query("SELECT SUM(total) AS total_maret FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='03' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}
					
					echo $opex_maret['total_maret'];
				?>
			</td>

			<!-- OPEX april -->
			<td style="text-align: right;">
				<?php  
					if($departemen == 'All'){
						$opex_april = $this->db->query("SELECT SUM(total) AS total_april FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='04' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_april = $this->db->query("SELECT SUM(total) AS total_april FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='04' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}
					
					echo $opex_april['total_april'];
				?>
			</td>

			<!-- OPEX mei -->
			<td style="text-align: right;">
				<?php  
					if($departemen == 'All'){
						$opex_mei = $this->db->query("SELECT SUM(total) AS total_mei FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='05' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_mei = $this->db->query("SELECT SUM(total) AS total_mei FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='05' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}
					
					echo $opex_mei['total_mei'];
				?>
			</td>

			<!-- OPEX juni -->
			<td style="text-align: right;">
				<?php  
					if($departemen == 'All'){
						$opex_juni = $this->db->query("SELECT SUM(total) AS total_juni FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='06' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_juni = $this->db->query("SELECT SUM(total) AS total_juni FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='06' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}
					
					echo $opex_juni['total_juni'];
				?>
			</td>

			<!-- OPEX juli -->
			<td style="text-align: right;">
				<?php  
					if($departemen == 'All'){
						$opex_juli = $this->db->query("SELECT SUM(total) AS total_juli FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='07' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_juli = $this->db->query("SELECT SUM(total) AS total_juli FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='07' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}
					
					echo $opex_juli['total_juli'];
				?>
			</td>

			<!-- OPEX agustus -->
			<td style="text-align: right;">
				<?php  
					if($departemen == 'All'){
						$opex_agustus = $this->db->query("SELECT SUM(total) AS total_agustus FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='08' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_agustus = $this->db->query("SELECT SUM(total) AS total_agustus FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='08' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}
					
					echo $opex_agustus['total_agustus'];
				?>
			</td>

			<!-- OPEX september -->
			<td style="text-align: right;">
				<?php  
					if($departemen == 'All'){
						$opex_september = $this->db->query("SELECT SUM(total) AS total_september FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='09' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_september = $this->db->query("SELECT SUM(total) AS total_september FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='09' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}
					
					echo $opex_september['total_september'];
				?>
			</td>

			<!-- OPEX oktober -->
			<td style="text-align: right;">
				<?php  
					if($departemen == 'All'){
						$opex_oktober = $this->db->query("SELECT SUM(total) AS total_oktober FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='10' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_oktober = $this->db->query("SELECT SUM(total) AS total_oktober FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='10' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}
					
					echo $opex_oktober['total_oktober'];
				?>
			</td>

			<!-- OPEX november -->
			<td style="text-align: right;">
				<?php  
					if($departemen == 'All'){
						$opex_november = $this->db->query("SELECT SUM(total) AS total_november FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='11' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_november = $this->db->query("SELECT SUM(total) AS total_november FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='11' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}
					
					echo $opex_november['total_november'];
				?>
			</td>

			<!-- OPEX desember -->
			<td style="text-align: right;">
				<?php  
					if($departemen == 'All'){
						$opex_desember = $this->db->query("SELECT SUM(total) AS total_desember FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='12' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_desember = $this->db->query("SELECT SUM(total) AS total_desember FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='12' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}
					
					echo $opex_desember['total_desember'];
				?>
			</td>

			<!-- OPEX ALL -->
			<td style="text-align: right;">
				<?php  
					if($departemen == 'All'){
						$opex_all = $this->db->query("SELECT SUM(total) AS total_all FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
					}else{
						$opex_all = $this->db->query("SELECT SUM(total) AS total_all FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
					}
					
					echo $opex_all['total_all'];
				?>
			</td>



		</tr>
		<?php } ?>

		<tr style="background-color: silver">
	      <td style="font-weight: bold">TOTAL OPEX</td>


	      <!-- Total januari -->
	      <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_januari = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_januari FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='01' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_januari = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_januari FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='01' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_januari['total_januari'];
	          ?>
          </td>

          <!-- Total februari -->
	        <td style="text-align: right;">
	          <?php 
	          	if($departemen == 'All'){
	          		$total_februari = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_februari FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='02' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_februari = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_februari FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='02' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				} 
	            
	            echo $total_februari['total_februari'];
	          ?>
	        </td>

	        <!-- Total maret -->
	        <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_maret = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_maret FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='03' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_maret = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_maret FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='03' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_maret['total_maret'];
	          ?>
	        </td>

	        <!-- Total april -->
	        <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_april = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_april FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='04' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_april = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_april FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='04' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_april['total_april'];
	          ?>
	        </td>

	        <!-- Total mei -->
	        <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_mei = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_mei FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='05' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_mei = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_mei FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='05' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_mei['total_mei'];
	          ?>
	        </td>

	        <!-- Total juni -->
	        <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_juni = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_juni FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='06' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_juni = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_juni FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='06' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_juni['total_juni'];
	          ?>
	        </td>

	        <!-- Total juli -->
	        <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_juli = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_juli FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='07' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_juli = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_juli FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='07' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_juli['total_juli'];
	          ?>
	        </td>

	        <!-- Total agustus -->
	        <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_agustus = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_agustus FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='08' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_agustus = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_agustus FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='08' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_agustus['total_agustus'];
	          ?>
	        </td>

	        <!-- Total september -->
	        <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_september = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_september FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='09' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_september = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_september FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='09' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_september['total_september'];
	          ?>
	        </td>

	        <!-- Total oktober -->
	        <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_oktober = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_oktober FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='10' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_oktober = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_oktober FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='10' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_oktober['total_oktober'];
	          ?>
	        </td>

	        <!-- Total november -->
	        <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_november = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_november FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='11' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_november = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_november FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='11' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_november['total_november'];
	          ?>
	        </td>

	        <!-- Total desember -->
	        <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_desember = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_desember FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='12' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_desember = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_desember FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND MONTH(tbl_pengajuan.tanggal)='12' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_desember['total_desember'];
	          ?>
	        </td>

	        <!-- Total all -->
	        <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_all = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_all FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_all = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_all FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='opex' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_all['total_all'];
	          ?>
	        </td>

	    </tr>


	    <tr>
	      <th colspan="14" style="text-align: left;">&nbsp;</th>
	    </tr>

	    <tr style="background-color: orange">
	      <th colspan="14" style="text-align: left;">CAPEX</th>
	    </tr>

	    <?php foreach($data_capex as $row_capex){ 
	      $jenis_biaya = $row_capex['jenis_biaya'];
	    ?>

	    <tr>

	      <td><?php echo $jenis_biaya; ?></td>

	      <!-- CAPEX januari -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_januari = $this->db->query("SELECT SUM(total) AS total_januari FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='01' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$capex_januari = $this->db->query("SELECT SUM(total) AS total_januari FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='01' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
				
				echo $capex_januari['total_januari'];
			?>
		  </td>

		  <!-- CAPEX februari -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_februari = $this->db->query("SELECT SUM(total) AS total_februari FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='02' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$capex_februari = $this->db->query("SELECT SUM(total) AS total_februari FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='02' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
				
				echo $capex_februari['total_februari'];
			?>
		  </td>

		  <!-- CAPEX maret -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_maret = $this->db->query("SELECT SUM(total) AS total_maret FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='03' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$capex_maret = $this->db->query("SELECT SUM(total) AS total_maret FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='03' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
				
				echo $capex_maret['total_maret'];
			?>
		  </td>

		  <!-- CAPEX april -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_april = $this->db->query("SELECT SUM(total) AS total_april FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='04' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();	
				}else{
					$capex_april = $this->db->query("SELECT SUM(total) AS total_april FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='04' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();	
				}
				
				echo $capex_april['total_april'];
			?>
		  </td>

		  <!-- CAPEX mei -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_mei = $this->db->query("SELECT SUM(total) AS total_mei FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='05' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$capex_mei = $this->db->query("SELECT SUM(total) AS total_mei FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='05' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
				
				echo $capex_mei['total_mei'];
			?>
		  </td>

		  <!-- CAPEX juni -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_juni = $this->db->query("SELECT SUM(total) AS total_juni FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='06' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$capex_juni = $this->db->query("SELECT SUM(total) AS total_juni FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='06' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
				
				echo $capex_juni['total_juni'];
			?>
		  </td>

		  <!-- CAPEX juli -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_juli = $this->db->query("SELECT SUM(total) AS total_juli FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='07' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$capex_juli = $this->db->query("SELECT SUM(total) AS total_juli FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='07' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
				
				echo $capex_juli['total_juli'];
			?>
		  </td>

		  <!-- CAPEX agustus -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_agustus = $this->db->query("SELECT SUM(total) AS total_agustus FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='08' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$capex_agustus = $this->db->query("SELECT SUM(total) AS total_agustus FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='08' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
				
				echo $capex_agustus['total_agustus'];
			?>
		  </td>

		  <!-- CAPEX september -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_september = $this->db->query("SELECT SUM(total) AS total_september FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='09' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$capex_september = $this->db->query("SELECT SUM(total) AS total_september FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='09' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
				
				echo $capex_september['total_september'];
			?>
		  </td>

		  <!-- CAPEX oktober -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_oktober = $this->db->query("SELECT SUM(total) AS total_oktober FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='10' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$capex_oktober = $this->db->query("SELECT SUM(total) AS total_oktober FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='10' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
				
				echo $capex_oktober['total_oktober'];
			?>
		  </td>

		  <!-- CAPEX november -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_november = $this->db->query("SELECT SUM(total) AS total_november FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='11' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$capex_november = $this->db->query("SELECT SUM(total) AS total_november FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='11' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
				
				echo $capex_november['total_november'];
			?>
		  </td>

		  <!-- CAPEX desember -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_desember = $this->db->query("SELECT SUM(total) AS total_desember FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='12' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$capex_desember = $this->db->query("SELECT SUM(total) AS total_desember FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND MONTH(tanggal)='12' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
				
				echo $capex_desember['total_desember'];
			?>
		  </td>

		  <!-- CAPEX all -->
		  <td style="text-align: right;">
			<?php  
				if($departemen == 'All'){
					$capex_all = $this->db->query("SELECT SUM(total) AS total_all FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$capex_all = $this->db->query("SELECT SUM(total) AS total_all FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
				
				echo $capex_all['total_all'];
			?>
		  </td>

	      

	    </tr>
	    <?php } ?>

	    <tr style="background-color: silver">
	      <td style="font-weight: bold">TOTAL CAPEX</td>

	      <!-- Total januari -->
	      <td style="text-align: right;">
	          <?php 
	          	if($departemen == 'All'){
	          		$total_cp_januari = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_januari FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='01' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_cp_januari = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_januari FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='01' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				} 
	            
	            echo $total_cp_januari['total_cp_januari'];
	          ?>
          </td>

          <!-- Total februari -->
	      <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_cp_februari = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_februari FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='02' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_cp_februari = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_februari FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='02' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_cp_februari['total_cp_februari'];
	          ?>
          </td>

          <!-- Total maret -->
	      <td style="text-align: right;">
	          <?php 
	          	if($departemen == 'All'){
	          		$total_cp_maret = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_maret FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='03' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_cp_maret = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_maret FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='03' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();	
				} 
	            
	            echo $total_cp_maret['total_cp_maret'];
	          ?>
          </td>

          <!-- Total april -->
	      <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_cp_april = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_april FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='04' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();	
				}else{
					$total_cp_april = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_april FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='04' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();	
				}
	            
	            echo $total_cp_april['total_cp_april'];
	          ?>
          </td>

          <!-- Total mei -->
	      <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_cp_mei = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_mei FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='05' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_cp_mei = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_mei FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='05' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_cp_mei['total_cp_mei'];
	          ?>
          </td>

          <!-- Total juni -->
	      <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_cp_juni = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_juni FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='06' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_cp_juni = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_juni FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='06' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_cp_juni['total_cp_juni'];
	          ?>
          </td>

          <!-- Total juli -->
	      <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_cp_juli = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_juli FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='07' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_cp_juli = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_juli FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='07' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();	
				}
	            
	            echo $total_cp_juli['total_cp_juli'];
	          ?>
          </td>

          <!-- Total agustus -->
	      <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_cp_agustus = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_agustus FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='08' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();	
				}else{
					$total_cp_agustus = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_agustus FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='08' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();	
				}
	            
	            echo $total_cp_agustus['total_cp_agustus'];
	          ?>
          </td>

          <!-- Total september -->
	      <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_cp_september = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_september FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='09' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_cp_september = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_september FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='09' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}
	            
	            echo $total_cp_september['total_cp_september'];
	          ?>
          </td>

          <!-- Total oktober -->
	      <td style="text-align: right;">
	          <?php
	          	if($departemen == 'All'){
	          		$total_cp_oktober = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_oktober FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='10' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_cp_oktober = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_oktober FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='10' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}  
	            
	            echo $total_cp_oktober['total_cp_oktober'];
	          ?>
          </td>

          <!-- Total november -->
	      <td style="text-align: right;">
	          <?php  
	          	if($departemen == 'All'){
	          		$total_cp_november = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_november FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='11' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_cp_november = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_november FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='11' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();	
				}
	            
	            echo $total_cp_november['total_cp_november'];
	          ?>
          </td>

          <!-- Total desember -->
	      <td style="text-align: right;">
	          <?php
	          	if($departemen == 'All'){
	          		$total_cp_desember = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_desember FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='12' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_cp_desember = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_desember FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND MONTH(tbl_pengajuan.tanggal)='12' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}  
	            
	            echo $total_cp_desember['total_cp_desember'];
	          ?>
          </td>

          <!-- Total all -->
	      <td style="text-align: right;">
	          <?php
	          	if($departemen == 'All'){
	          		$total_cp_all = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_all FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND cabang='$cabang' AND status_bayar='Telah Dibayar'")->row_array();
				}else{
					$total_cp_all = $this->db->query("SELECT SUM(tbl_pengajuan.total) AS total_cp_all FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE tbl_jenis_biaya.opex_capex='capex' AND cabang='$cabang' AND bagian='$departemen' AND status_bayar='Telah Dibayar'")->row_array();
				}  
	            
	            echo $total_cp_all['total_cp_all'];
	          ?>
          </td>

	    </tr>

	    <tr>
	      <th colspan="14" style="text-align: left;">&nbsp;</th>
	    </tr>

	    <tr style="background-color: silver">
	      <td style="font-weight: bold">TOTAL OPEX DAN CAPEX</td>

	      <td style="text-align: right;">
	        <?php echo $total_januari['total_januari']+$total_cp_januari['total_cp_januari']; ?>
	      </td>

	      <td style="text-align: right;">
	        <?php echo $total_februari['total_februari']+$total_cp_februari['total_cp_februari']; ?>
	      </td>

	      <td style="text-align: right;">
	        <?php echo $total_maret['total_maret']+$total_cp_maret['total_cp_maret']; ?>
	      </td>

	      <td style="text-align: right;">
	        <?php echo $total_april['total_april']+$total_cp_april['total_cp_april']; ?>
	      </td>

	      <td style="text-align: right;">
	        <?php echo $total_mei['total_mei']+$total_cp_mei['total_cp_mei']; ?>
	      </td>

	      <td style="text-align: right;">
	        <?php echo $total_juni['total_juni']+$total_cp_juni['total_cp_juni']; ?>
	      </td>

	      <td style="text-align: right;">
	        <?php echo $total_juli['total_juli']+$total_cp_juli['total_cp_juli']; ?>
	      </td>

	      <td style="text-align: right;">
	        <?php echo $total_agustus['total_agustus']+$total_cp_agustus['total_cp_agustus']; ?>
	      </td>

	      <td style="text-align: right;">
	        <?php echo $total_september['total_september']+$total_cp_september['total_cp_september']; ?>
	      </td>

	      <td style="text-align: right;">
	        <?php echo $total_oktober['total_oktober']+$total_cp_oktober['total_cp_oktober']; ?>
	      </td>

	      <td style="text-align: right;">
	        <?php echo $total_november['total_november']+$total_cp_november['total_cp_november']; ?>
	      </td>

	      <td style="text-align: right;">
	        <?php echo $total_desember['total_desember']+$total_cp_desember['total_cp_desember']; ?>
	      </td>

	      <td style="text-align: right;">
	        <?php echo $total_all['total_all']+$total_cp_all['total_cp_all']; ?>
	      </td>

	    </tr>


	</tbody>	

	
</table>