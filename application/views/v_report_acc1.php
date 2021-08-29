<?php  

	// Script Excel (Tanpa Tambahan Library) Apapun
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/x-msexcel");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=report_konsolidasi_bulanan.xls");

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
	<span style="margin-left: 20px; font-size: 15px"><b>KONSOLIDASI</b></span><br>
	<span style="margin-left: 20px; font-size: 12px"><b>PERIODE : <?php echo date('d-m-Y', strtotime($tanggal_from)) ?> s/d <?php echo date('d-m-Y', strtotime($tanggal_to)) ?></b></span><br><br>
</div>

<table border="1">
	<thead>
		<tr>
			<th rowspan="2" style="background-color: silver; color: white">RINCIAN</th>
			<th rowspan="2" style="background-color: blue; color: white">KONSOLIDASI</th>
			<th rowspan="2" style="background-color: gray; color: white">HEAD OFFICE</th>
			<th rowspan="2" style="background-color: gray; color: white">CABANG</th>
			<th colspan="8" style="background-color: blue; color: white">WILAYAH-1</th>
			<!-- <th>WILAYAH-1</th>
			<th>WILAYAH-1</th>
			<th>WILAYAH-1</th>
			<th>WILAYAH-1</th>
			<th>WILAYAH-1</th>
			<th>WILAYAH-1</th>
			<th>WILAYAH-1</th> -->
			<th colspan="7" style="background-color: gray; color: white">WILAYAH-2</th>
			<!-- <th>WILAYAH-2</th>
			<th>WILAYAH-2</th>
			<th>WILAYAH-2</th>
			<th>WILAYAH-2</th>
			<th>WILAYAH-2</th>
			<th>WILAYAH-2</th> -->
			<th style="background-color: blue; color: white">WILAYAH-3</th>
			<th colspan="5" style="background-color: gray; color: white">WILAYAH-5</th>
			<!-- <th>WILAYAH-5</th>
			<th>WILAYAH-5</th>
			<th>WILAYAH-5</th>
			<th>WILAYAH-5</th> -->
			<th colspan="4" style="background-color: blue; color: white">WILAYAH-6</th>
			<!-- <th>WILAYAH-6</th>
			<th>WILAYAH-6</th>
			<th>WILAYAH-6</th> -->
			<th colspan="5" style="background-color: gray; color: white">WILAYAH-7</th>
			<!-- <th>WILAYAH-7</th>
			<th>WILAYAH-7</th>
			<th>WILAYAH-7</th>
			<th>WILAYAH-7</th> -->
		</tr>

		<tr>
			<!-- <th>RINCIAN</th> -->
			<!-- <th>KONSOLIDASI</th> -->
			<!-- <th>HEAD OFFICE</th> -->
			<!-- <th>CABANG</th> -->
			<th style="background-color: blue; color: white">MEDAN</th>
			<th style="background-color: blue; color: white">PEKANBARU</th>
			<th style="background-color: blue; color: white">ACEH</th>
			<th style="background-color: blue; color: white">PADANG</th>
			<th style="background-color: blue; color: white">LHOKSEUMAWE</th>
			<th style="background-color: blue; color: white">PALEMBANG</th>
			<th style="background-color: blue; color: white">JAMBI</th>
			<th style="background-color: blue; color: white">LAMPUNG</th>
			<th style="background-color: gray; color: white">KALIMALANG</th>
			<th style="background-color: gray; color: white">TANGERANG</th>
			<th style="background-color: gray; color: white">SERANG</th>
			<th style="background-color: gray; color: white">PURWAKARTA</th>
			<th style="background-color: gray; color: white">CIBUBUR</th>
			<th style="background-color: gray; color: white">BOGOR</th>
			<th style="background-color: gray; color: white">SUKABUMI</th>
			<th style="background-color: blue; color: white">TEGAL</th>
			<th style="background-color: gray; color: white">YOGYAKARTA</th>
			<th style="background-color: gray; color: white">SOLO</th>
			<th style="background-color: gray; color: white">MADIUN</th>
			<th style="background-color: gray; color: white">BALI</th>
			<th style="background-color: gray; color: white">GIANYAR</th>
			<th style="background-color: blue; color: white">PONTIANAK</th>
			<th style="background-color: blue; color: white">KOTAWARINGIN TIMUR</th>
			<th style="background-color: blue; color: white">BANJARMASIN</th>
			<th style="background-color: blue; color: white">SAMARINDA</th>
			<th style="background-color: gray; color: white">MAKASSAR</th>
			<th style="background-color: gray; color: white">MANADO</th>
			<th style="background-color: gray; color: white">PARE-PARE</th>
			<th style="background-color: gray; color: white">PALOPO</th>
			<th style="background-color: gray; color: white">PALU</th>
		</tr>
	</thead>

	<tbody id="table_data">

		<tr style="background-color: orange">
			<th colspan="34" style="text-align: left;">OPEX</th>
		</tr>

		<?php foreach($data_opex as $row_opex){ 
			$jenis_biaya = $row_opex['jenis_biaya'];
		?>
		<tr>
			<td><?php echo $jenis_biaya; ?></td>

			<!-- OPEX Konsolidasi -->
			<td style="text-align: right;">
				<?php  
					$opex_konsolidasi = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_konsol FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Telah Dibayar'
						OR 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_konsolidasi['total_konsol'];
				?>
			</td>

			<!-- OPEX Head Office -->
			<td style="text-align: right;">
				<?php  
					$opex_ho = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_ho FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='HEAD OFFICE' AND status_bayar='Telah Dibayar' OR 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='HEAD OFFICE' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_ho['total_ho'];
				?>
			</td>

			<!-- OPEX Cabang -->
			<td style="text-align: right;">
				<?php  
					$opex_cabang = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_cabang FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang!='HEAD OFFICE' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang!='HEAD OFFICE' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_cabang['total_cabang'];
				?>
			</td>

			<!-- OPEX Medan -->
			<td style="text-align: right;">
				<?php  
					$opex_medan = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_medan FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MEDAN' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MEDAN' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_medan['total_medan'];
				?>
			</td>

			<!-- OPEX Pekanbaru -->
			<td style="text-align: right;">
				<?php  
					$opex_pekanbaru = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_pekanbaru FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PEKANBARU' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PEKANBARU' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_pekanbaru['total_pekanbaru'];
				?>
			</td>

			<!-- OPEX Aceh -->
			<td style="text-align: right;">
				<?php  
					$opex_aceh = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_aceh FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='ACEH' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='ACEH' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_aceh['total_aceh'];
				?>
			</td>

			<!-- OPEX padang -->
			<td style="text-align: right;">
				<?php  
					$opex_padang = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_padang FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PADANG' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PADANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_padang['total_padang'];
				?>
			</td>

			<!-- OPEX lhokseumawe -->
			<td style="text-align: right;">
				<?php  
					$opex_lhokseumawe = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_lhokseumawe FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='LHOKSEUMAWE' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='LHOKSEUMAWE' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_lhokseumawe['total_lhokseumawe'];
				?>
			</td>

			<!-- OPEX palembang -->
			<td style="text-align: right;">
				<?php  
					$opex_palembang = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_palembang FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PALEMBANG' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PALEMBANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_palembang['total_palembang'];
				?>
			</td>

			<!-- OPEX jambi -->
			<td style="text-align: right;">
				<?php  
					$opex_jambi = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_jambi FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='JAMBI' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='JAMBI' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_jambi['total_jambi'];
				?>
			</td>

			<!-- OPEX lampung -->
			<td style="text-align: right;">
				<?php  
					$opex_lampung = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_lampung FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='LAMPUNG' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='LAMPUNG' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_lampung['total_lampung'];
				?>
			</td>

			<!-- OPEX kalimalang -->
			<td style="text-align: right;">
				<?php  
					$opex_kalimalang = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_kalimalang FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='KALIMALANG' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='KALIMALANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_kalimalang['total_kalimalang'];
				?>
			</td>

			<!-- OPEX tangerang -->
			<td style="text-align: right;">
				<?php  
					$opex_tangerang = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_tangerang FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='TANGERANG' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='TANGERANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_tangerang['total_tangerang'];
				?>
			</td>

			<!-- OPEX serang -->
			<td style="text-align: right;">
				<?php  
					$opex_serang = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_serang FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SERANG' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SERANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_serang['total_serang'];
				?>
			</td>

			<!-- OPEX purwakarta -->
			<td style="text-align: right;">
				<?php  
					$opex_purwakarta = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_purwakarta FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PURWAKARTA' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PURWAKARTA' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_purwakarta['total_purwakarta'];
				?>
			</td>

			<!-- OPEX cibubur -->
			<td style="text-align: right;">
				<?php  
					$opex_cibubur = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_cibubur FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='CIBUBUR' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='CIBUBUR' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_cibubur['total_cibubur'];
				?>
			</td>

			<!-- OPEX bogor -->
			<td style="text-align: right;">
				<?php  
					$opex_bogor = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_bogor FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='BOGOR' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='BOGOR' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_bogor['total_bogor'];
				?>
			</td>

			<!-- OPEX sukabumi -->
			<td style="text-align: right;">
				<?php  
					$opex_sukabumi = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_sukabumi FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SUKABUMI' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SUKABUMI' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_sukabumi['total_sukabumi'];
				?>
			</td>

			<!-- OPEX tegal -->
			<td style="text-align: right;">
				<?php  
					$opex_tegal = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_tegal FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='TEGAL' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='TEGAL' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_tegal['total_tegal'];
				?>
			</td>

			<!-- OPEX yogyakarta -->
			<td style="text-align: right;">
				<?php  
					$opex_yogyakarta = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_yogyakarta FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='YOGYAKARTA' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='YOGYAKARTA' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_yogyakarta['total_yogyakarta'];
				?>
			</td>

			<!-- OPEX solo -->
			<td style="text-align: right;">
				<?php  
					$opex_solo = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_solo FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SOLO' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SOLO' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_solo['total_solo'];
				?>
			</td>

			<!-- OPEX madiun -->
			<td style="text-align: right;">
				<?php  
					$opex_madiun = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_madiun FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MADIUN' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MADIUN' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_madiun['total_madiun'];
				?>
			</td>

			<!-- OPEX bali -->
			<td style="text-align: right;">
				<?php  
					$opex_bali = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_bali FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='BALI' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='BALI' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_bali['total_bali'];
				?>
			</td>

			<!-- OPEX gianyar -->
			<td style="text-align: right;">
				<?php  
					$opex_gianyar = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_gianyar FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='GIANYAR' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='GIANYAR' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_gianyar['total_gianyar'];
				?>
			</td>

			<!-- OPEX pontianak -->
			<td style="text-align: right;">
				<?php  
					$opex_pontianak = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_pontianak FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PONTIANAK' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PONTIANAK' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_pontianak['total_pontianak'];
				?>
			</td>

			<!-- OPEX kotawaringin -->
			<td style="text-align: right;">
				<?php  
					$opex_kotawaringin = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_kotawaringin FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='KOTAWARINGIN' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='KOTAWARINGIN' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_kotawaringin['total_kotawaringin'];
				?>
			</td>

			<!-- OPEX banjarmasin -->
			<td style="text-align: right;">
				<?php  
					$opex_banjarmasin = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_banjarmasin FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='BANJARMASIN' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='BANJARMASIN' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_banjarmasin['total_banjarmasin'];
				?>
			</td>

			<!-- OPEX samarinda -->
			<td style="text-align: right;">
				<?php  
					$opex_samarinda = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_samarinda FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SAMARINDA' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SAMARINDA' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_samarinda['total_samarinda'];
				?>
			</td>

			<!-- OPEX makassar -->
			<td style="text-align: right;">
				<?php  
					$opex_makassar = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_makassar FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MAKASSAR' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MAKASSAR' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_makassar['total_makassar'];
				?>
			</td>

			<!-- OPEX manado -->
			<td style="text-align: right;">
				<?php  
					$opex_manado = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_manado FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MANADO' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MANADO' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_manado['total_manado'];
				?>
			</td>

			<!-- OPEX pare -->
			<td style="text-align: right;">
				<?php  
					$opex_pare = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_pare FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PARE-PARE' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PARE-PARE' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_pare['total_pare'];
				?>
			</td>

			<!-- OPEX palopo -->
			<td style="text-align: right;">
				<?php  
					$opex_palopo = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_palopo FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PALOPO' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PALOPO' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_palopo['total_palopo'];
				?>
			</td>

			<!-- OPEX palu -->
			<td style="text-align: right;">
				<?php  
					$opex_palu = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_palu FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PALU' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PALU' AND status_bayar='Proses Bayar'")->row_array();
					echo $opex_palu['total_palu'];
				?>
			</td>

		</tr>
		<?php } ?>

		<tr style="background-color: silver">
			<td style="font-weight: bold">TOTAL OPEX</td>

			<!-- Total Konsolidasi -->
			<td style="text-align: right;">
				<?php  
					$total_konsolidasi = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_konsolidasi FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Proses Bayar'")->row_array();
					echo $total_konsolidasi['total_konsolidasi'];
				?>
			</td>

			<!-- Total HEAD OFFICE -->
			<td style="text-align: right;">
				<?php  
					$total_head_office = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_head_office FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='HEAD OFFICE' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='HEAD OFFICE' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_head_office['total_head_office'];
				?>
			</td>

			<!-- Total CABANG -->
			<td style="text-align: right;">
				<?php  
					$total_cabang = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cabang FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang!='HEAD OFFICE' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang!='HEAD OFFICE' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cabang['total_cabang'];
				?>
			</td>

			<!-- Total medan -->
			<td style="text-align: right;">
				<?php  
					$total_medan = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_medan FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MEDAN' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MEDAN' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_medan['total_medan'];
				?>
			</td>

			<!-- Total pekanbaru -->
			<td style="text-align: right;">
				<?php  
					$total_pekanbaru = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_pekanbaru FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PEKANBARU' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PEKANBARU' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_pekanbaru['total_pekanbaru'];
				?>
			</td>

			<!-- Total aceh -->
			<td style="text-align: right;">
				<?php  
					$total_aceh = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_aceh FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='ACEH' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='ACEH' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_aceh['total_aceh'];
				?>
			</td>

			<!-- Total padang -->
			<td style="text-align: right;">
				<?php  
					$total_padang = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_padang FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PADANG' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PADANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_padang['total_padang'];
				?>
			</td>

			<!-- Total lhokseumawe -->
			<td style="text-align: right;">
				<?php  
					$total_lhokseumawe = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_lhokseumawe FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='LHOKSEUMAWE' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='LHOKSEUMAWE' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_lhokseumawe['total_lhokseumawe'];
				?>
			</td>

			<!-- Total palembang -->
			<td style="text-align: right;">
				<?php  
					$total_palembang = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_palembang FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PALEMBANG' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PALEMBANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_palembang['total_palembang'];
				?>
			</td>

			<!-- Total jambi -->
			<td style="text-align: right;">
				<?php  
					$total_jambi = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_jambi FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='JAMBI' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='JAMBI' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_jambi['total_jambi'];
				?>
			</td>

			<!-- Total lampung -->
			<td style="text-align: right;">
				<?php  
					$total_lampung = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_lampung FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='LAMPUNG' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='LAMPUNG' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_lampung['total_lampung'];
				?>
			</td>

			<!-- Total kalimalang -->
			<td style="text-align: right;">
				<?php  
					$total_kalimalang = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_kalimalang FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='KALIMALANG' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='KALIMALANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_kalimalang['total_kalimalang'];
				?>
			</td>

			<!-- Total tangerang -->
			<td style="text-align: right;">
				<?php  
					$total_tangerang = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_tangerang FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='TANGERANG' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='TANGERANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_tangerang['total_tangerang'];
				?>
			</td>

			<!-- Total serang -->
			<td style="text-align: right;">
				<?php  
					$total_serang = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_serang FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SERANG' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SERANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_serang['total_serang'];
				?>
			</td>

			<!-- Total purwakarta -->
			<td style="text-align: right;">
				<?php  
					$total_purwakarta = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_purwakarta FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PURWAKARTA' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PURWAKARTA' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_purwakarta['total_purwakarta'];
				?>
			</td>

			<!-- Total cibubur -->
			<td style="text-align: right;">
				<?php  
					$total_cibubur = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cibubur FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='CIBUBUR' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='CIBUBUR' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cibubur['total_cibubur'];
				?>
			</td>

			<!-- Total bogor -->
			<td style="text-align: right;">
				<?php  
					$total_bogor = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_bogor FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='BOGOR' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='BOGOR' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_bogor['total_bogor'];
				?>
			</td>

			<!-- Total sukabumi -->
			<td style="text-align: right;">
				<?php  
					$total_sukabumi = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_sukabumi FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SUKABUMI' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SUKABUMI' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_sukabumi['total_sukabumi'];
				?>
			</td>

			<!-- Total tegal -->
			<td style="text-align: right;">
				<?php  
					$total_tegal = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_tegal FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='TEGAL' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='TEGAL' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_tegal['total_tegal'];
				?>
			</td>

			<!-- Total yogyakarta -->
			<td style="text-align: right;">
				<?php  
					$total_yogyakarta = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_yogyakarta FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='YOGYAKARTA' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='YOGYAKARTA' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_yogyakarta['total_yogyakarta'];
				?>
			</td>

			<!-- Total solo -->
			<td style="text-align: right;">
				<?php  
					$total_solo = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_solo FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SOLO' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SOLO' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_solo['total_solo'];
				?>
			</td>

			<!-- Total madiun -->
			<td style="text-align: right;">
				<?php  
					$total_madiun = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_madiun FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MADIUN' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MADIUN' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_madiun['total_madiun'];
				?>
			</td>

			<!-- Total bali -->
			<td style="text-align: right;">
				<?php  
					$total_bali = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_bali FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='BALI' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='BALI' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_bali['total_bali'];
				?>
			</td>

			<!-- Total gianyar -->
			<td style="text-align: right;">
				<?php  
					$total_gianyar = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_gianyar FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='GIANYAR' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='GIANYAR' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_gianyar['total_gianyar']
				?>
			</td>

			<!-- Total pontianak -->
			<td style="text-align: right;">
				<?php  
					$total_pontianak = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_pontianak FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PONTIANAK' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PONTIANAK' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_pontianak['total_pontianak'];
				?>
			</td>

			<!-- Total kotawaringin -->
			<td style="text-align: right;">
				<?php  
					$total_kotawaringin = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_kotawaringin FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='KOTAWARINGIN' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='KOTAWARINGIN' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_kotawaringin['total_kotawaringin']
				?>
			</td>

			<!-- Total banjarmasin -->
			<td style="text-align: right;">
				<?php  
					$total_banjarmasin = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_banjarmasin FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='BANJARMASIN' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='BANJARMASIN' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_banjarmasin['total_banjarmasin'];
				?>
			</td>

			<!-- Total samarinda -->
			<td style="text-align: right;">
				<?php  
					$total_samarinda = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_samarinda FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SAMARINDA' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SAMARINDA' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_samarinda['total_samarinda'];
				?>
			</td>

			<!-- Total makassar -->
			<td style="text-align: right;">
				<?php  
					$total_makassar = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_makassar FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MAKASSAR' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MAKASSAR' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_makassar['total_makassar'];
				?>
			</td>

			<!-- Total manado -->
			<td style="text-align: right;">
				<?php  
					$total_manado = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_manado FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MANADO' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MANADO' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_manado['total_manado'];
				?>
			</td>

			<!-- Total pare -->
			<td style="text-align: right;">
				<?php  
					$total_pare = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_pare FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PARE-PARE' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PARE-PARE' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_pare['total_pare'];
				?>
			</td>

			<!-- Total palopo -->
			<td style="text-align: right;">
				<?php  
					$total_palopo = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_palopo FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PALOPO' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PALOPO' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_palopo['total_palopo'];
				?>
			</td>

			<!-- Total palu -->
			<td style="text-align: right;">
				<?php  
					$total_palu = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_palu FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PALU' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='opex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PALU' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_palu['total_palu'];
				?>
			</td>

		</tr>

		<tr>
			<th colspan="34" style="text-align: left;">&nbsp;</th>
		</tr>

		<tr style="background-color: orange">
			<th colspan="34" style="text-align: left;">CAPEX</th>
		</tr>

		<?php foreach($data_capex as $row_capex){ 
			$jenis_biaya = $row_capex['jenis_biaya'];
		?>
		<tr>
			<td><?php echo $jenis_biaya; ?></td>

			<!-- CAPEX Konsolidasi -->
			<td style="text-align: right;">
				<?php  
					$capex_konsolidasi = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_konsol FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_konsolidasi['total_konsol'];
				?>
			</td>

			<!-- capex Head Office -->
			<td style="text-align: right;">
				<?php  
					$capex_ho = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_ho FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='HEAD OFFICE' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='HEAD OFFICE' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_ho['total_ho'];
				?>
			</td>

			<!-- capex Cabang -->
			<td style="text-align: right;">
				<?php  
					$capex_cabang = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_cabang FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang!='HEAD OFFICE' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang!='HEAD OFFICE' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_cabang['total_cabang'];
				?>
			</td>

			<!-- capex Medan -->
			<td style="text-align: right;">
				<?php  
					$capex_medan = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_medan FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MEDAN' AND status_bayar='Telah Dibayar' OR

						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MEDAN' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_medan['total_medan'];
				?>
			</td>

			<!-- capex Pekanbaru -->
			<td style="text-align: right;">
				<?php  
					$capex_pekanbaru = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_pekanbaru FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PEKANBARU' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PEKANBARU' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_pekanbaru['total_pekanbaru'];
				?>
			</td>

			<!-- capex Aceh -->
			<td style="text-align: right;">
				<?php  
					$capex_aceh = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_aceh FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='ACEH' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='ACEH' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_aceh['total_aceh'];
				?>
			</td>

			<!-- capex padang -->
			<td style="text-align: right;">
				<?php  
					$capex_padang = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_padang FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PADANG' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PADANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_padang['total_padang'];
				?>
			</td>

			<!-- capex lhokseumawe -->
			<td style="text-align: right;">
				<?php  
					$capex_lhokseumawe = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_lhokseumawe FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='LHOKSEUMAWE' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='LHOKSEUMAWE' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_lhokseumawe['total_lhokseumawe'];
				?>
			</td>

			<!-- capex palembang -->
			<td style="text-align: right;">
				<?php  
					$capex_palembang = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_palembang FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PALEMBANG' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PALEMBANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_palembang['total_palembang'];
				?>
			</td>

			<!-- capex jambi -->
			<td style="text-align: right;">
				<?php  
					$capex_jambi = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_jambi FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='JAMBI' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='JAMBI' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_jambi['total_jambi'];
				?>
			</td>

			<!-- capex lampung -->
			<td style="text-align: right;">
				<?php  
					$capex_lampung = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_lampung FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='LAMPUNG' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='LAMPUNG' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_lampung['total_lampung'];
				?>
			</td>

			<!-- capex kalimalang -->
			<td style="text-align: right;">
				<?php  
					$capex_kalimalang = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_kalimalang FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='KALIMALANG' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='KALIMALANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_kalimalang['total_kalimalang'];
				?>
			</td>

			<!-- capex tangerang -->
			<td style="text-align: right;">
				<?php  
					$capex_tangerang = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_tangerang FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='TANGERANG' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='TANGERANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_tangerang['total_tangerang'];
				?>
			</td>

			<!-- capex serang -->
			<td style="text-align: right;">
				<?php  
					$capex_serang = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_serang FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SERANG' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SERANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_serang['total_serang'];
				?>
			</td>

			<!-- capex purwakarta -->
			<td style="text-align: right;">
				<?php  
					$capex_purwakarta = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_purwakarta FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PURWAKARTA' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PURWAKARTA' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_purwakarta['total_purwakarta'];
				?>
			</td>

			<!-- capex cibubur -->
			<td style="text-align: right;">
				<?php  
					$capex_cibubur = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_cibubur FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='CIBUBUR' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='CIBUBUR' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_cibubur['total_cibubur'];
				?>
			</td>

			<!-- capex bogor -->
			<td style="text-align: right;">
				<?php  
					$capex_bogor = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_bogor FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='BOGOR' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='BOGOR' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_bogor['total_bogor'];
				?>
			</td>

			<!-- capex sukabumi -->
			<td style="text-align: right;">
				<?php  
					$capex_sukabumi = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_sukabumi FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SUKABUMI' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SUKABUMI' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_sukabumi['total_sukabumi'];
				?>
			</td>

			<!-- capex tegal -->
			<td style="text-align: right;">
				<?php  
					$capex_tegal = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_tegal FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='TEGAL' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='TEGAL' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_tegal['total_tegal'];
				?>
			</td>

			<!-- capex yogyakarta -->
			<td style="text-align: right;">
				<?php  
					$capex_yogyakarta = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_yogyakarta FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='YOGYAKARTA' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='YOGYAKARTA' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_yogyakarta['total_yogyakarta'];
				?>
			</td>

			<!-- capex solo -->
			<td style="text-align: right;">
				<?php  
					$capex_solo = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_solo FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SOLO' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SOLO' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_solo['total_solo'];
				?>
			</td>

			<!-- capex madiun -->
			<td style="text-align: right;">
				<?php  
					$capex_madiun = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_madiun FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MADIUN' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MADIUN' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_madiun['total_madiun'];
				?>
			</td>

			<!-- capex bali -->
			<td style="text-align: right;">
				<?php  
					$capex_bali = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_bali FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='BALI' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='BALI' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_bali['total_bali'];
				?>
			</td>

			<!-- capex gianyar -->
			<td style="text-align: right;">
				<?php  
					$capex_gianyar = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_gianyar FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='GIANYAR' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='GIANYAR' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_gianyar['total_gianyar'];
				?>
			</td>

			<!-- capex pontianak -->
			<td style="text-align: right;">
				<?php  
					$capex_pontianak = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_pontianak FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PONTIANAK' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PONTIANAK' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_pontianak['total_pontianak'];
				?>
			</td>

			<!-- capex kotawaringin -->
			<td style="text-align: right;">
				<?php  
					$capex_kotawaringin = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_kotawaringin FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='KOTAWARINGIN' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='KOTAWARINGIN' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_kotawaringin['total_kotawaringin'];
				?>
			</td>

			<!-- capex banjarmasin -->
			<td style="text-align: right;">
				<?php  
					$capex_banjarmasin = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_banjarmasin FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='BANJARMASIN' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='BANJARMASIN' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_banjarmasin['total_banjarmasin'];
				?>
			</td>

			<!-- capex samarinda -->
			<td style="text-align: right;">
				<?php  
					$capex_samarinda = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_samarinda FROM tbl_pengajuan WHERE 
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SAMARINDA' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='SAMARINDA' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_samarinda['total_samarinda'];
				?>
			</td>

			<!-- capex makassar -->
			<td style="text-align: right;">
				<?php  
					$capex_makassar = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_makassar FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MAKASSAR' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MAKASSAR' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_makassar['total_makassar'];
				?>
			</td>

			<!-- capex manado -->
			<td style="text-align: right;">
				<?php  
					$capex_manado = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_manado FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MANADO' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='MANADO' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_manado['total_manado'];
				?>
			</td>

			<!-- capex pare -->
			<td style="text-align: right;">
				<?php  
					$capex_pare = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_pare FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PARE-PARE' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PARE-PARE' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_pare['total_pare'];
				?>
			</td>

			<!-- capex palopo -->
			<td style="text-align: right;">
				<?php  
					$capex_palopo = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_palopo FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PALOPO' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PALOPO' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_palopo['total_palopo'];
				?>
			</td>

			<!-- capex palu -->
			<td style="text-align: right;">
				<?php  
					$capex_palu = $this->db->query("SELECT SUM(jumlah+ppn-pph23-pph42-pph21) AS total_palu FROM tbl_pengajuan WHERE jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PALU' AND status_bayar='Telah Dibayar' OR
						jenis_biaya='$jenis_biaya' AND (tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND cabang='PALU' AND status_bayar='Proses Bayar'")->row_array();
					echo $capex_palu['total_palu'];
				?>
			</td>

		</tr>
		<?php } ?>


		<tr style="background-color: silver">
			<td style="font-weight: bold">TOTAL CAPEX</td>

			<!-- Total Konsolidasi -->
			<td style="text-align: right;">
				<?php  
					$total_cp_konsolidasi = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_konsolidasi FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_konsolidasi['total_cp_konsolidasi'];
				?>
			</td>

			<!-- Total HEAD OFFICE -->
			<td style="text-align: right;">
				<?php  
					$total_cp_head_office = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_head_office FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='HEAD OFFICE' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='HEAD OFFICE' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_head_office['total_cp_head_office'];
				?>
			</td>

			<!-- Total CABANG -->
			<td style="text-align: right;">
				<?php  
					$total_cp_cabang = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_cabang FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang!='HEAD OFFICE' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang!='HEAD OFFICE' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_cabang['total_cp_cabang'];
				?>
			</td>

			<!-- Total medan -->
			<td style="text-align: right;">
				<?php  
					$total_cp_medan = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_medan FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MEDAN' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MEDAN' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_medan['total_cp_medan'];
				?>
			</td>

			<!-- Total pekanbaru -->
			<td style="text-align: right;">
				<?php  
					$total_cp_pekanbaru = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_pekanbaru FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PEKANBARU' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PEKANBARU' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_pekanbaru['total_cp_pekanbaru'];
				?>
			</td>

			<!-- Total aceh -->
			<td style="text-align: right;">
				<?php  
					$total_cp_aceh = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_aceh FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='ACEH' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='ACEH' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_aceh['total_cp_aceh'];
				?>
			</td>

			<!-- Total padang -->
			<td style="text-align: right;">
				<?php  
					$total_cp_padang = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_padang FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PADANG' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PADANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_padang['total_cp_padang'];
				?>
			</td>

			<!-- Total lhokseumawe -->
			<td style="text-align: right;">
				<?php  
					$total_cp_lhokseumawe = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_lhokseumawe FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='LHOKSEUMAWE' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='LHOKSEUMAWE' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_lhokseumawe['total_cp_lhokseumawe'];
				?>
			</td>

			<!-- Total palembang -->
			<td style="text-align: right;">
				<?php  
					$total_cp_palembang = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_palembang FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PALEMBANG' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PALEMBANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_palembang['total_cp_palembang'];
				?>
			</td>

			<!-- Total jambi -->
			<td style="text-align: right;">
				<?php  
					$total_cp_jambi = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_jambi FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='JAMBI' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='JAMBI' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_jambi['total_cp_jambi'];
				?>
			</td>

			<!-- Total lampung -->
			<td style="text-align: right;">
				<?php  
					$total_cp_lampung = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_lampung FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='LAMPUNG' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='LAMPUNG' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_lampung['total_cp_lampung'];
				?>
			</td>

			<!-- Total kalimalang -->
			<td style="text-align: right;">
				<?php  
					$total_cp_kalimalang = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_kalimalang FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='KALIMALANG' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='KALIMALANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_kalimalang['total_cp_kalimalang'];
				?>
			</td>

			<!-- Total tangerang -->
			<td style="text-align: right;">
				<?php  
					$total_cp_tangerang = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_tangerang FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='TANGERANG' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='TANGERANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_tangerang['total_cp_tangerang'];
				?>
			</td>

			<!-- Total serang -->
			<td style="text-align: right;">
				<?php  
					$total_cp_serang = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_serang FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SERANG' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SERANG' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_serang['total_cp_serang'];
				?>
			</td>

			<!-- Total purwakarta -->
			<td style="text-align: right;">
				<?php  
					$total_cp_purwakarta = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_purwakarta FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PURWAKARTA' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PURWAKARTA' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_purwakarta['total_cp_purwakarta'];
				?>
			</td>

			<!-- Total cibubur -->
			<td style="text-align: right;">
				<?php  
					$total_cp_cibubur = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_cibubur FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='CIBUBUR' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='CIBUBUR' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_cibubur['total_cp_cibubur'];
				?>
			</td>

			<!-- Total bogor -->
			<td style="text-align: right;">
				<?php  
					$total_cp_bogor = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_bogor FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='BOGOR' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='BOGOR' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_bogor['total_cp_bogor'];
				?>
			</td>

			<!-- Total sukabumi -->
			<td style="text-align: right;">
				<?php  
					$total_cp_sukabumi = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_sukabumi FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SUKABUMI' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SUKABUMI' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_sukabumi['total_cp_sukabumi'];
				?>
			</td>

			<!-- Total tegal -->
			<td style="text-align: right;">
				<?php  
					$total_cp_tegal = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_tegal FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='TEGAL' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='TEGAL' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_tegal['total_cp_tegal'];
				?>
			</td>

			<!-- Total yogyakarta -->
			<td style="text-align: right;">
				<?php  
					$total_cp_yogyakarta = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_yogyakarta FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='YOGYAKARTA' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='YOGYAKARTA' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_yogyakarta['total_cp_yogyakarta'];
				?>
			</td>

			<!-- Total solo -->
			<td style="text-align: right;">
				<?php  
					$total_cp_solo = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_solo FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SOLO' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SOLO' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_solo['total_cp_solo'];
				?>
			</td>

			<!-- Total madiun -->
			<td style="text-align: right;">
				<?php  
					$total_cp_madiun = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_madiun FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MADIUN' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MADIUN' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_madiun['total_cp_madiun'];
				?>
			</td>

			<!-- Total bali -->
			<td style="text-align: right;">
				<?php  
					$total_cp_bali = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_bali FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='BALI' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='BALI' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_bali['total_cp_bali'];
				?>
			</td>

			<!-- Total gianyar -->
			<td style="text-align: right;">
				<?php  
					$total_cp_gianyar = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_gianyar FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='GIANYAR' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='GIANYAR' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_gianyar['total_cp_gianyar'];
				?>
			</td>

			<!-- Total pontianak -->
			<td style="text-align: right;">
				<?php  
					$total_cp_pontianak = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_pontianak FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PONTIANAK' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PONTIANAK' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_pontianak['total_cp_pontianak'];
				?>
			</td>

			<!-- Total kotawaringin -->
			<td style="text-align: right;">
				<?php  
					$total_cp_kotawaringin = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_kotawaringin FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='KOTAWARINGIN' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='KOTAWARINGIN' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_kotawaringin['total_cp_kotawaringin'];
				?>
			</td>

			<!-- Total banjarmasin -->
			<td style="text-align: right;">
				<?php  
					$total_cp_banjarmasin = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_banjarmasin FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='BANJARMASIN' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='BANJARMASIN' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_banjarmasin['total_cp_banjarmasin'];
				?>
			</td>

			<!-- Total samarinda -->
			<td style="text-align: right;">
				<?php  
					$total_cp_samarinda = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_samarinda FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SAMARINDA' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='SAMARINDA' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_samarinda['total_cp_samarinda'];
				?>
			</td>

			<!-- Total makassar -->
			<td style="text-align: right;">
				<?php  
					$total_cp_makassar = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_makassar FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MAKASSAR' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MAKASSAR' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_makassar['total_cp_makassar'];
				?>
			</td>

			<!-- Total manado -->
			<td style="text-align: right;">
				<?php  
					$total_cp_manado = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_manado FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MANADO' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='MANADO' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_manado['total_cp_manado'];
				?>
			</td>

			<!-- Total pare -->
			<td style="text-align: right;">
				<?php  
					$total_cp_pare = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_pare FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PARE-PARE' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PARE-PARE' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_pare['total_cp_pare'];
				?>
			</td>

			<!-- Total palopo -->
			<td style="text-align: right;">
				<?php  
					$total_cp_palopo = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_palopo FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PALOPO' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PALOPO' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_palopo['total_cp_palopo'];
				?>
			</td>

			<!-- Total palu -->
			<td style="text-align: right;">
				<?php  
					$total_cp_palu = $this->db->query("SELECT SUM(tbl_pengajuan.jumlah + tbl_pengajuan.ppn - tbl_pengajuan.pph23 - tbl_pengajuan.pph42 - tbl_pengajuan.pph21) AS total_cp_palu FROM tbl_pengajuan INNER JOIN tbl_jenis_biaya ON tbl_pengajuan.jenis_biaya = tbl_jenis_biaya.jenis_biaya WHERE 
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PALU' AND status_bayar='Telah Dibayar' OR
						tbl_jenis_biaya.opex_capex='capex' AND (tbl_pengajuan.tanggal BETWEEN '$tanggal_from' AND '$tanggal_to') AND tbl_pengajuan.cabang='PALU' AND status_bayar='Proses Bayar'")->row_array();
					echo $total_cp_palu['total_cp_palu'];
				?>
			</td>

		</tr>

		<tr>
			<th colspan="34" style="text-align: left;">&nbsp;</th>
		</tr>

		<tr style="background-color: silver">
			<td style="font-weight: bold">TOTAL OPEX DAN CAPEX</td>

			<td style="text-align: right;">
				<?php echo $total_konsolidasi['total_konsolidasi']+$total_cp_konsolidasi['total_cp_konsolidasi']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_head_office['total_head_office']+$total_cp_head_office['total_cp_head_office']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_cabang['total_cabang']+$total_cp_cabang['total_cp_cabang']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_medan['total_medan']+$total_cp_medan['total_cp_medan']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_pekanbaru['total_pekanbaru']+$total_cp_pekanbaru['total_cp_pekanbaru']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_aceh['total_aceh']+$total_cp_aceh['total_cp_aceh']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_padang['total_padang']+$total_cp_padang['total_cp_padang']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_lhokseumawe['total_lhokseumawe']+$total_cp_lhokseumawe['total_cp_lhokseumawe']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_palembang['total_palembang']+$total_cp_palembang['total_cp_palembang']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_jambi['total_jambi']+$total_cp_jambi['total_cp_jambi']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_lampung['total_lampung']+$total_cp_lampung['total_cp_lampung']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_kalimalang['total_kalimalang']+$total_cp_kalimalang['total_cp_kalimalang']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_tangerang['total_tangerang']+$total_cp_tangerang['total_cp_tangerang']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_serang['total_serang']+$total_cp_serang['total_cp_serang']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_purwakarta['total_purwakarta']+$total_cp_purwakarta['total_cp_purwakarta']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_cibubur['total_cibubur']+$total_cp_cibubur['total_cp_cibubur']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_bogor['total_bogor']+$total_cp_bogor['total_cp_bogor']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_sukabumi['total_sukabumi']+$total_cp_sukabumi['total_cp_sukabumi']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_tegal['total_tegal']+$total_cp_tegal['total_cp_tegal']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_yogyakarta['total_yogyakarta']+$total_cp_yogyakarta['total_cp_yogyakarta']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_solo['total_solo']+$total_cp_solo['total_cp_solo']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_madiun['total_madiun']+$total_cp_madiun['total_cp_madiun']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_bali['total_bali']+$total_cp_bali['total_cp_bali']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_gianyar['total_gianyar']+$total_cp_gianyar['total_cp_gianyar']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_pontianak['total_pontianak']+$total_cp_pontianak['total_cp_pontianak']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_kotawaringin['total_kotawaringin']+$total_cp_kotawaringin['total_cp_kotawaringin']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_banjarmasin['total_banjarmasin']+$total_cp_banjarmasin['total_cp_banjarmasin']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_samarinda['total_samarinda']+$total_cp_samarinda['total_cp_samarinda']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_makassar['total_makassar']+$total_cp_makassar['total_cp_makassar']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_manado['total_manado']+$total_cp_manado['total_cp_manado']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_pare['total_pare']+$total_cp_pare['total_cp_pare']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_palopo['total_palopo']+$total_cp_palopo['total_cp_palopo']; ?>
			</td>

			<td style="text-align: right;">
				<?php echo $total_palu['total_palu']+$total_cp_palu['total_cp_palu']; ?>
			</td>

		</tr>

	</tbody>	

	
</table>