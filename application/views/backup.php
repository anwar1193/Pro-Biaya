 <!-- validasi tidak boleh titik/karakter -->
 <script type="text/javascript">

    function refreshPage(){
        window.location.reload();
    } 

   // fungsi number
    function Number(nilai, pesan) {
        var numberExp = /^[0-9]+$/;
        if(nilai.value.match(numberExp)) {
            return true;
        }
        else {
            alert(pesan);
            refreshPage();
            nilai.focus();
            return false;
        }
    }

    function validasi() {
        Number(document.getElementById('jumlah'), 'Maaf Inputan Harus Angka (Tidak Boleh Ada Titik/Karakter Lainnya)');
    }

    function validasi_norek() {
        Number(document.getElementById('norek_penerima'), 'Maaf Inputan Harus Angka (Tidak Boleh Ada Titik/Karakter Lainnya)');
    }
 </script>

 <!-- CKEditor -->
 <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

  <?php  

    // Info User Login
    $nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
    $cabang = $this->libraryku->tampil_user()->cabang;
    $departemen = $this->libraryku->tampil_user()->departemen;
    $level = $this->libraryku->tampil_user()->level;

    if($departemen=='BRANCH'){ //biar cabang tampil nama_bagiannya
      $dept = $level;
    }else{
      $dept = $departemen;
    }

  ?>

 <?php date_default_timezone_set("Asia/Jakarta"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengajuan Biaya
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengajuan Biaya</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Tampilan Form Tambah Data -->
      <div class="box box-widget">
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
              
              <h3 style="text-align: center;">Revisi Pengajuan Biaya</h3>
              <hr style="border-width: 4px; width: 300px">
              
              <form method="post" action="<?php echo base_url().'p_revisi/update' ?>" enctype="multipart/form-data">

                <!-- Form Atas-1 -->
                <div class="row">
                  <div class="col-md-6">

                    <input type="text" name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>" hidden>

                    <div class="form-group">
                      <label for="nim">Tanggal :</label>
                      <input type="text" name="tanggal" class="form-control" value="<?php echo $data_pengajuan['tanggal'] ?>" readonly>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nomor">Nomor :</label>
                      <input type="text" name="nomor_pengajuan" class="form-control" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>" readonly>
                    </div>
                  </div>
                </div>

                <!-- Form Atas-2 -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cabang">Cabang :</label>
                      <input type="text" name="cabang" class="form-control" value="<?php echo $data_pengajuan['cabang'] ?>" readonly>
                    </div>
                  </div>

                  <!-- Data Wilayah -->
                  <input type="text" name="wilayah" value="<?php echo $data_pengajuan['wilayah'] ?>" hidden>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bagian">Bagian (Departemen) :</label>
                      <input type="text" name="bagian" value="<?php echo $data_pengajuan['bagian'] ?>" class="form-control" readonly>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="biaya">Biaya :</label>
                  <input type="text" name="jenis_biaya" class="form-control" value="<?php echo $data_pengajuan['jenis_biaya'] ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="sub_biaya">Sub Biaya :</label>
                  <input type="text" name="sub_biaya" class="form-control" value="<?php echo $data_pengajuan['sub_biaya'] ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="nomor_invoice">Nomor Invoice :</label>
                  <input type="text" name="nomor_invoice" class="form-control" value="<?php echo $data_pengajuan['nomor_invoice'] ?>" autocomplete="off">
                </div>

                <!-- Departemen Tujuan -->
                <input type="text" name="dept_tujuan" value="<?php echo $data_pengajuan['dept_tujuan'] ?>" hidden>

                <div class="form-group">
                  <label for="keterangan">Keterangan (Rincian) :</label>
                  <textarea class="form-control" name="keterangan">
                    <?php echo $data_pengajuan['keterangan'] ?>
                  </textarea>
                </div>

                <!-- Cek Apakah Ada memo di pengajuan -->
                <?php  
                  $nomor_pengajuan = $data_pengajuan['nomor_pengajuan'];
                  $nopeng_otomatis = $data_pengajuan['nomor_pengajuan'];
                  $cek_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan = '$nomor_pengajuan'")->num_rows();

                  if($cek_memo < 1){ //jika belum ada memo, tampilkan checklist tambahkan memo
                ?>

                  <!-- Check Box Memo -->
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="tambahkan_memo" value="ya">
                        <span style="font-weight:bold; font-size:18px">Tambahkan Internal Memo</span>
                      </label>
                    </div>
                  </div>

                <?php }else{ //jika sudah ada memo, checklist disembunyikan ?>

                  <input type="checkbox" name="tambahkan_memo" value="" hidden>

                <?php } ?>
                <!-- Penutup Cek Apakah Ada memo di pengajuan -->

                <!-- Isian Uang -->
                <div class="row">
                  <div class="col-md-6"></div>
                  <div class="col-md-6">

                    <?php if($data_pengajuan['form'] == 'Perdin'){ ?>
                      
                      <div class="form-group">
                        <label for="jumlah">Jumlah :</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" required value="<?php echo $data_pengajuan['jumlah'] ?>" onkeyup="validasi()" readonly>
                      </div>

                      <div class="form-group">
                        <label for="ppn">PPN :</label>
                        <input type="number" name="ppn" id="ppn" class="form-control" required value="<?php echo $data_pengajuan['ppn'] ?>" readonly>
                      </div>

                    <?php }else{ ?>
                      <div class="form-group">
                        <label for="jumlah">Jumlah :</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" required value="<?php echo $data_pengajuan['jumlah'] ?>" onkeyup="validasi()">
                      </div>

                      <div class="form-group">
                        <label for="ppn">PPN :</label>
                        <input type="number" name="ppn" id="ppn" class="form-control" required value="<?php echo $data_pengajuan['ppn'] ?>">
                      </div>
                    <?php } ?>

                    <div class="form-group">
                      <label for="pph23">PPH 23 :</label>
                      <input type="number" name="pph23" id="pph23" class="form-control" required value="<?php echo $data_pengajuan['pph23'] ?>" readonly>
                    </div>

                    <div class="form-group">
                      <label for="total">Total (Nett) :</label>
                      <!-- <input type="number" name="total" id="total" class="form-control" readonly value="<?php echo $data_pengajuan['total'] ?>"> -->

                      <input type="number" name="total" id="total" hidden value="<?php echo $data_pengajuan['total'] ?>"><br>

                      <!-- Total yang ada pemisah rupiah nya -->
                      <span id="total_rp" style="font-weight: bold; font-size: 20px; padding: 5px;">
                        <?php echo $data_pengajuan['total'] ?>
                      </span>

                    </div>

                  </div>
                </div>
                <!-- Isian Uang -->

                <div class="form-group">
                  <label for="bank_penerima">Bank Penerima :</label>
                  <select class="form-control" name="bank_penerima">
                    <option value="<?php echo $data_pengajuan['bank_penerima'] ?>"><?php echo $data_pengajuan['bank_penerima'] ?></option>

                    <?php foreach($data_bank_pengaju as $row_bank){ ?>
                    <option value="<?php echo $row_bank['nama_bank'] ?>"><?php echo $row_bank['nama_bank'] ?></option>
                    <?php } ?>

                  </select>
                </div>

                <div class="form-group">
                  <label for="norek_penerima">Nomor Rekening Penerima :</label>
                  <input type="number" name="norek_penerima" class="form-control" required value="<?php echo $data_pengajuan['norek_penerima'] ?>" onkeyup="validasi_norek()" id="norek_penerima">
                </div>

                <div class="form-group">
                  <label for="atas_nama">Atas Nama :</label>
                  <input type="text" name="atas_nama" class="form-control" required value="<?php echo $data_pengajuan['atas_nama'] ?>">
                </div>

                <!-- <div class="form-group">
                  <label for="files">Upload Berkas Baru<span style="color: red;">*</span></label>
                  <input type="file" name="files[]" class="form-control" multiple="">
                </div> -->

                <div class="form-group">
                  <label for="Berkas">Berkas Pendukung :</label>
                  <table width="70%" border="1" style="border-collapse: collapse;">
                    <tr>
                      <th style="text-align: center">Nama File</th>
                      <th style="text-align: center">Kode File</th>
                      <th style="text-align: center">Action</th>
                    </tr>

                    <?php foreach($data_berkas as $row_berkas){ ?>
                    <tr>
                      <td><?php echo $row_berkas['nama_file'] ?></td>
                      <td><?php echo $row_berkas['file'] ?></td>
                      <td style="text-align: center;">

                        <?php 
                          if(file_exists('file_upload/'.$row_berkas['file'])){
                        ?>

                          <a class="btn btn-info btn-xs" target="_blank" href="<?php echo base_url().'file_upload/'.$row_berkas['file'] ?>">Lihat File</a>
                        
                        <?php }else{ ?>

                          <?php  
                            $nama_folder = substr($row_berkas['file'], 0, 10);
                          ?>

                          <a class="btn btn-info btn-xs" target="_blank" href="<?php echo base_url().'file_upload/'.$nama_folder.'/'.$row_berkas['file'] ?>">Lihat File</a>

                        <?php } ?>

                        <a onclick="return confirm('Anda Yakin Akan Menghapus File Ini?')" href="<?php echo base_url().'p_revisi/hapus_file/'.$row_berkas['id'].'/'.$data_pengajuan['id_pengajuan'] ?>" class="btn btn-danger btn-xs">Hapus</a>
                      </td>
                    </tr>
                    <?php } ?>
                  </table>            
                </div>

                <input type="text" name="ref_no" autocomplete="off" value="<?php echo $data_pengajuan['ref_no'] ?>" hidden>

                <b>Upload Berkas Baru (jpg / png / jpeg / pdf) :</b>
                <table class="table table-bordered" id="tableLoop">
                  <thead>
                    <tr class="bg-success">
                      <th>No</th>
                      <th>Upload File</th>
                      <th>Nama File</th>
                      <th class="text-center">
                        <button class="btn btn-primary btn-xs" id="BarisBaru">
                          <i class="fa fa-plus"></i> Tambah File
                        </button>
                      </th>
                    </tr>
                  </thead>

                  <tbody></tbody>
                </table>

                <!-- Form Perjalanan Dinas -->

                <?php if($data_pengajuan['form'] == 'Perdin'){ ?>

                <h4 style="background-color: orange; padding:10px; border-radius: 10px;">Kolom Tambahan (Biaya Dinas)</h4>

                  <?php  
                      // Cari Data Perdin
                      $nopeng = $data_pengajuan['nomor_pengajuan'];
                      $dt_perdin = $this->db->query("SELECT * FROM tbl_pengajuan_perdin WHERE nomor_pengajuan='$nopeng'")->row_array();
                  ?>

                <div class="form-group">
                  <label for="nama_pic">Nama PIC (Yang Melakukan Perjalanan Dinas) :</label>
                  <input type="text" name="nama_pic" class="form-control" value="<?php echo $dt_perdin['nama_pic'] ?>" required autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="lokasi_tujuan">Nama / Lokasi Tujuan :</label>
                  <input type="text" name="lokasi_tujuan" class="form-control" value="<?php echo $dt_perdin['lokasi_tujuan'] ?>" required autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="lokasi_tujuan">Tujuan Melakukan Perjalanan Dinas :</label>
                  <input type="text" name="tujuan_perdin" class="form-control" value="<?php echo $dt_perdin['tujuan_perdin'] ?>" required autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="lokasi_tujuan">Tanggal Kunjungan :</label>
                  <table>
                    <tr>
                      <td>
                        <input type="date" name="dari_tanggal" value="<?php echo $dt_perdin['dari_tanggal'] ?>" id="tanggal_awal" class="form-control" required autocomplete="off">
                      </td>
                      <td>&nbsp; s/d &nbsp;</td>
                      <td>
                        <input type="date" name="ke_tanggal" value="<?php echo $dt_perdin['ke_tanggal'] ?>" id="tanggal_akhir" class="form-control" required autocomplete="off">
                      </td>
                    </tr>
                  </table>
                </div>

                <div class="form-group">
                  <label for="lama_kunjungan">Lama Kunjungan :</label>
                  <input type="text" name="lama_kunjungan" id="selisih_hari" class="form-control" value="<?php echo $dt_perdin['lama_kunjungan'] ?>" required autocomplete="off">
                </div>

                <input type="text" id="selisih_hari2" hidden>

                <div class="form-group">
                  <label>Rincian Penggunaan Dana</label>
                </div>

                <!-- Isian Biaya Perdin -->
                <div class="row">
                  <div class="col-md-1"></div>

                  <div class="col-md-11">

                    <!-- Transportasi -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="transportasi_ket">Transportasi Digunakan :</label>
                          <select class="form-control" name="transportasi_ket" required="">
                            <option value="<?php echo $dt_perdin['transportasi_ket'] ?>"><?php echo $dt_perdin['transportasi_ket'] ?></option>
                            <option value="Pesawat">Pesawat</option>
                            <option value="Kereta Api">Kereta Api</option>
                            <option value="Bus">Bus</option>
                            <option value="Taxi">Taxi</option>
                            <option value="Kendaraan Operasional">Kendaraan Operasional</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                          </select>
                        </div>
                      </div>

                      <?php if($cabang=='HEAD OFFICE'){ ?>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="transportasi">Biaya Transportasi :</label>
                            <input type="number" name="transportasi" value="<?php echo $dt_perdin['transportasi'] ?>" id="transportasi" class="form-control" placeholder="Diisi Oleh HRD" readonly>
                          </div>
                        </div>
                      <?php }else{ ?>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="transportasi">Biaya Transportasi :</label>
                            <input type="number" name="transportasi" value="<?php echo $dt_perdin['transportasi'] ?>" id="transportasi" class="form-control" placeholder="Rp">
                          </div>
                        </div>
                      <?php } ?> 
                    </div>

                    <!-- Hotel -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="penginapan_ket">Penginapan/Hotel :</label>
                          <select class="form-control" name="penginapan_ket" required="" id="penginapan_ket">
                            <option value="<?php echo $dt_perdin['penginapan_ket'] ?>"><?php echo $dt_perdin['penginapan_ket'] ?></option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="1">1 Hari</option>
                            <option value="2">2 Hari</option>
                            <option value="3">3 Hari</option>
                            <option value="4">4 Hari</option>
                            <option value="5">5 Hari</option>
                            <option value="6">6 Hari</option>
                            <option value="7">7 Hari</option>
                          </select>
                        </div>
                      </div>

                      <?php if($cabang=='HEAD OFFICE'){ ?>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="penginapan">Biaya Hotel :</label>
                            <input type="number" name="penginapan" id="penginapan" class="form-control" placeholder="Diisi Oleh HRD" value="<?php echo $dt_perdin['penginapan'] ?>" readonly>
                          </div>
                        </div>
                      <?php }else{ ?>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="penginapan">Biaya Hotel :</label>
                            <input type="number" name="penginapan" value="<?php echo $dt_perdin['penginapan'] ?>" id="penginapan" class="form-control" placeholder="Rp">
                          </div>
                        </div>
                      <?php } ?>
                      
                    </div>


                    <!-- Lain-lain -->
                    <div class="row">
                      <div class="col-md-6"></div>
                      <div class="col-md-6">
                        <!-- Biaya Perdin -->
                        <input type="number" name="makan" value="<?php echo $dt_perdin['makan'] ?>" hidden id="makan" value="0">

                        <div class="form-group">
                          <label for="lain_lain">Biaya Lain-lain :</label>
                          <input type="number" name="lain_lain" value="<?php echo $dt_perdin['lain_lain'] ?>" id="lain_lain" class="form-control" required placeholder="Rp" pattern="[1-9]{20}" onkeyup="validasi()">
                        </div>
                      </div>
                    </div>

                <?php } ?>
                <!-- Penutup Form Perjalanan Dinas -->

                <!-- Jika bukan perdin jenis transaksi tampil -->
                <?php if($data_pengajuan['form'] != 'Perdin'){ ?>

                <div class="form-group">
                  <label>Tipe Transaksi :</label>
                  <?php 
                    if($frek_byr == '1'){
                      echo 'Biaya - '.$frek_byr.' Kali Pembayaran';
                    }else{
                      echo 'Uang Muka - '.$frek_byr.' Kali Pembayaran';
                    }
                  ?>
                  --
                  <button type="button" class="btn btn-xs btn-primary" id="btn_ubah_tipetrans">
                    <span>
                      <i class="fa fa-edit"></i> Revisi
                    </span>
                  </button>

                </div>

                <table class="table table-bordered">
                  <tr style="background-color: orange">
                    <th>Bayar Ke</th>
                    <th>Tanggal Bayar</th>
                    <th>Jumlah</th>
                    <th>PPN</th>
                  </tr>

                  <?php 
                    $no=1;
                    foreach($data_byr as $row_byr){ 
                  ?>
                    <tr>
                      <td style="text-align: center"><?php echo $no++; ?></td>
                      <td><?php echo date('d-m-Y', strtotime($row_byr['tanggal_minta_bayar'])) ?></td>
                      <td style="text-align: right;"><?php echo number_format($row_byr['jumlah_bayar'], 0, ',', '.') ?></td>
                      <td style="text-align: right;"><?php echo number_format($row_byr['ppn_bayar'], 0, ',', '.') ?></td>
                    </tr>
                  <?php } ?>
                </table>

                <!-- Ubah Tipe Transaksi -->
                <div id="ubah_tipetrans">
                  <div class="form-group">
                    <label for="tipe_transaksi"></span> Ubah Tipe Transaksi :</label>
                    <select name="tipe_transaksi" class="form-control input-sm" id="tipe_transaksi">
                      <option value="1">Biaya (1 Kali Pembayaran)</option>
                      <option value="2">Uang Muka (2 Kali Pembayaran)</option>
                      <option value="3">Uang Muka (3 Kali Pembayaran)</option>
                      <option value="4">Uang Muka (4 Kali Pembayaran)</option>
                      <option value="5">Uang Muka (5 Kali Pembayaran)</option>
                      <option value="6">Uang Muka (6 Kali Pembayaran)</option>
                      <option value="7">Uang Muka (7 Kali Pembayaran)</option>
                      <option value="8">Uang Muka (8 Kali Pembayaran)</option>
                      <option value="9">Uang Muka (9 Kali Pembayaran)</option>
                      <option value="10">Uang Muka (10 Kali Pembayaran)</option>
                      <option value="11">Uang Muka (11 Kali Pembayaran)</option>
                      <option value="12">Uang Muka (12 Kali Pembayaran)</option>
                    </select>
                  </div>

                  <!-- Rincian Pembayaran -->
                  <div class="row">
                    <div class="col-md-1"></div>

                    <div class="col-md-10">
                      
                    <div class="form-group" id="pembayaran_1">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      
                      <table width="100%">

                        <tr>
                          <td><label>Tgl Pembayaran :</label></td>
                          <td><label>Jumlah (Sebelum Pajak) :</label></td>
                          <td><label>PPN :</label></td>
                        </tr>

                        <tr>
                          <td>
                            <input class="form-control" type="date" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" name="tanggal_minta_bayar[]" id="tgl_min_bayar1"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar1" min="0"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar1" min="0"></input>
                          </td>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group" id="pembayaran_2">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      
                      <table width="100%">

                        <tr>
                          <td><label>Tgl Pembayaran Ke-2 :</label></td>
                          <td><label>Jumlah (Sebelum Pajak) :</label></td>
                          <td><label>PPN :</label></td>
                        </tr>

                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" id="tgl_min_bayar2"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar2" min="0"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar2" min="0"></input>
                          </td>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group" id="pembayaran_3">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      
                      <table width="100%">

                        <tr>
                          <td><label>Tgl Pembayaran Ke-3 :</label></td>
                          <td><label>Jumlah (Sebelum Pajak) :</label></td>
                          <td><label>PPN :</label></td>
                        </tr>

                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" id="tgl_min_bayar3"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar3" min="0"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar3" min="0"></input>
                          </td>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>


                    <div class="form-group" id="pembayaran_4">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      
                      <table width="100%">

                        <tr>
                          <td><label>Tgl Pembayaran Ke-4 :</label></td>
                          <td><label>Jumlah (Sebelum Pajak) :</label></td>
                          <td><label>PPN :</label></td>
                        </tr>

                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" id="tgl_min_bayar4"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar4" min="0"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar4" min="0"></input>
                          </td>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group" id="pembayaran_5">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      
                      <table width="100%">

                        <tr>
                          <td><label>Tgl Pembayaran Ke-5 :</label></td>
                          <td><label>Jumlah (Sebelum Pajak) :</label></td>
                          <td><label>PPN :</label></td>
                        </tr>

                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" id="tgl_min_bayar5"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar5" min="0"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar5" min="0"></input>
                          </td>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>


                    <div class="form-group" id="pembayaran_6">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      
                      <table width="100%">

                        <tr>
                          <td><label>Tgl Pembayaran Ke-6 :</label></td>
                          <td><label>Jumlah (Sebelum Pajak) :</label></td>
                          <td><label>PPN :</label></td>
                        </tr>

                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" id="tgl_min_bayar6"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar6" min="0"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar6" min="0"></input>
                          </td>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>


                    <div class="form-group" id="pembayaran_7">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      
                      <table width="100%">

                        <tr>
                          <td><label>Tgl Pembayaran Ke-7 :</label></td>
                          <td><label>Jumlah (Sebelum Pajak) :</label></td>
                          <td><label>PPN :</label></td>
                        </tr>

                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" id="tgl_min_bayar7"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar7" min="0"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar7" min="0"></input>
                          </td>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>


                    <div class="form-group" id="pembayaran_8">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      
                      <table width="100%">

                        <tr>
                          <td><label>Tgl Pembayaran Ke-8 :</label></td>
                          <td><label>Jumlah (Sebelum Pajak) :</label></td>
                          <td><label>PPN :</label></td>
                        </tr>

                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" id="tgl_min_bayar8"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar8" min="0"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar8" min="0"></input>
                          </td>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>


                    <div class="form-group" id="pembayaran_9">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      
                      <table width="100%">

                        <tr>
                          <td><label>Tgl Pembayaran Ke-9 :</label></td>
                          <td><label>Jumlah (Sebelum Pajak) :</label></td>
                          <td><label>PPN :</label></td>
                        </tr>

                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" id="tgl_min_bayar9"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar9" min="0"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar9" min="0"></input>
                          </td>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>


                    <div class="form-group" id="pembayaran_10">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      
                      <table width="100%">

                        <tr>
                          <td><label>Tgl Pembayaran Ke-10 :</label></td>
                          <td><label>Jumlah (Sebelum Pajak) :</label></td>
                          <td><label>PPN :</label></td>
                        </tr>

                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" id="tgl_min_bayar10"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar10" min="0"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar10" min="0"></input>
                          </td>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>


                    <div class="form-group" id="pembayaran_11">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      
                      <table width="100%">

                        <tr>
                          <td><label>Tgl Pembayaran Ke-11 :</label></td>
                          <td><label>Jumlah (Sebelum Pajak) :</label></td>
                          <td><label>PPN :</label></td>
                        </tr>

                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" id="tgl_min_bayar11"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar11" min="0"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar11" min="0"></input>
                          </td>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>


                    <div class="form-group" id="pembayaran_12">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      
                      <table width="100%">

                        <tr>
                          <td><label>Tgl Pembayaran Ke-12 :</label></td>
                          <td><label>Jumlah (Sebelum Pajak) :</label></td>
                          <td><label>PPN :</label></td>
                        </tr>

                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" id="tgl_min_bayar12"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar12" min="0"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar12" min="0"></input>
                          </td>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>


                      <!-- Total Frekuensi -->
                      <div class="form-group">
                        <label for="totalFr">Total :</label>
                        <input type="number" name="totalFr" id="totalFr" hidden placeholder="Rp"><br>

                        <!-- Total yang ada pemisah rupiah nya -->
                        <span id="totalFr_rp" style="font-weight: bold; font-size: 20px; padding: 5px;"></span>
                      </div>

                    </div>

                    <div class="col-md-1"></div>
                  </div>
                </div>
                <!-- / Ubah Tipe Transaksi -->

                <?php } ?>
                <!-- Jika bukan perdin jenis transaksi tampil -->
                
                <a href="<?php echo base_url().'p_revisi' ?>" class="btn btn-danger btn-sm" >
                  <i class="fa fa-backward"></i> Kembali
                </a>

                <button class="btn btn-success btn-sm" id="tombol_kirim" type="submit"><i class="fa fa-send"></i> Update Pengajuan</button>

                <!-- Notif tombol muncul -->
                <span id="notif">
                  Tombol "Update Pengajuan" Akan Tampil Jika Total Pengajuan Sesuai
                </span>

              </form>

            </div>
          </div>
        </div>
      </div>
      <!-- / Tampilan Form Tambah Data -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Script CKEditor -->
  <script>
          CKEDITOR.replace('keterangan');
  </script>
  <!-- / Script CKEditor -->


  <!-- Script Hitung Total Otomatis -->
  <script type="text/javascript">
    $(document).ready(function(){

      hitung_otomatis();

      // Rubah format angka javascript
      function rubah(angka){
         var reverse = angka.toString().split('').reverse().join(''),
         ribuan = reverse.match(/\d{1,3}/g);
         ribuan = ribuan.join('.').split('').reverse().join('');
         return ribuan;
       }

      function hitung_otomatis(){
        var jumlah = $('#jumlah').val();
        var ppn = $('#ppn').val();
        var pph23 = $('#pph23').val();

        total = (jumlah*1) + (ppn*1) + (pph23*1); //perkalian salah satu trik biar angka bisa ditambah

        jumlah_atas = (jumlah*1) + (pph23*1); //perkalian salah satu trik biar angka bisa ditambah
        ppn_atas = (ppn*1) + (pph23*1); //perkalian salah satu trik biar angka bisa ditambah

        $('#total').val(total);
        $('#total_rp').text('Rp ' + rubah(total));
      }

      // Panggil fungsi ubah data (realtime) saat form (price_item, qty_item, discount_item) di ketik / di klik
      $(document).on('keyup mouseup', '#jumlah, #ppn, #pph23', function(){
        hitung_otomatis();
      });

    });
  </script>
  <!-- / Script Hitung Total Otomatis -->


  <!-- Script Frekuensi Pembayaran -->
  <script type="text/javascript">
      $(document).ready(function(){

        $("#bayar1").attr("required",""); //wajib diisi
        $("#ppn_bayar1").attr("required",""); //wajib diisi
        $("#tgl_min_bayar1").attr("required",""); //wajib diisi

        $('#bayar1').val(0);
        $('#ppn_bayar1').val(0);
        
        $('#pembayaran_2').hide();
        $('#pembayaran_3').hide();
        $('#pembayaran_4').hide();
        $('#pembayaran_5').hide();
        $('#pembayaran_6').hide();
        $('#pembayaran_7').hide();
        $('#pembayaran_8').hide();
        $('#pembayaran_9').hide();
        $('#pembayaran_10').hide();
        $('#pembayaran_11').hide();
        $('#pembayaran_12').hide();

        function tampil_bayar(){
          var jenis_pembayaran = $('#tipe_transaksi').val();

          if(jenis_pembayaran == 1){
            $('#pembayaran_1').show();
            $('#pembayaran_2').hide();
            $('#pembayaran_3').hide();
            $('#pembayaran_4').hide();
            $('#pembayaran_5').hide();
            $('#pembayaran_6').hide();
            $('#pembayaran_7').hide();
            $('#pembayaran_8').hide();
            $('#pembayaran_9').hide();
            $('#pembayaran_10').hide();
            $('#pembayaran_11').hide();
            $('#pembayaran_12').hide();

            $('#bayar2').val('');
            $('#bayar3').val('');
            $('#bayar4').val('');
            $('#bayar5').val('');
            $('#bayar6').val('');
            $('#bayar7').val('');
            $('#bayar8').val('');
            $('#bayar9').val('');
            $('#bayar10').val('');
            $('#bayar11').val('');
            $('#bayar12').val('');

            $('#ppn_bayar2').val('');
            $('#ppn_bayar3').val('');
            $('#ppn_bayar4').val('');
            $('#ppn_bayar5').val('');
            $('#ppn_bayar6').val('');
            $('#ppn_bayar7').val('');
            $('#ppn_bayar8').val('');
            $('#ppn_bayar9').val('');
            $('#ppn_bayar10').val('');
            $('#ppn_bayar11').val('');
            $('#ppn_bayar12').val('');

            $('#tgl_min_bayar2').val('');
            $('#tgl_min_bayar3').val('');
            $('#tgl_min_bayar4').val('');
            $('#tgl_min_bayar5').val('');
            $('#tgl_min_bayar6').val('');
            $('#tgl_min_bayar7').val('');
            $('#tgl_min_bayar8').val('');
            $('#tgl_min_bayar9').val('');
            $('#tgl_min_bayar10').val('');
            $('#tgl_min_bayar11').val('');
            $('#tgl_min_bayar12').val('');

            $("#bayar1").attr("required",""); //wajib diisi
            $("#ppn_bayar1").attr("required",""); //wajib diisi
            $("#tgl_min_bayar1").attr("required",""); //wajib diisi

            $('#bayar1').val(0);
            $('#ppn_bayar1').val(0);

          }else if(jenis_pembayaran == 2){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').hide();
            $('#pembayaran_4').hide();
            $('#pembayaran_5').hide();
            $('#pembayaran_6').hide();
            $('#pembayaran_7').hide();
            $('#pembayaran_8').hide();
            $('#pembayaran_9').hide();
            $('#pembayaran_10').hide();
            $('#pembayaran_11').hide();
            $('#pembayaran_12').hide();

            $('#bayar3').val('');
            $('#bayar4').val('');
            $('#bayar5').val('');
            $('#bayar6').val('');
            $('#bayar7').val('');
            $('#bayar8').val('');
            $('#bayar9').val('');
            $('#bayar10').val('');
            $('#bayar11').val('');
            $('#bayar12').val('');

            $('#ppn_bayar3').val('');
            $('#ppn_bayar4').val('');
            $('#ppn_bayar5').val('');
            $('#ppn_bayar6').val('');
            $('#ppn_bayar7').val('');
            $('#ppn_bayar8').val('');
            $('#ppn_bayar9').val('');
            $('#ppn_bayar10').val('');
            $('#ppn_bayar11').val('');
            $('#ppn_bayar12').val('');

            $('#tgl_min_bayar3').val('');
            $('#tgl_min_bayar4').val('');
            $('#tgl_min_bayar5').val('');
            $('#tgl_min_bayar6').val('');
            $('#tgl_min_bayar7').val('');
            $('#tgl_min_bayar8').val('');
            $('#tgl_min_bayar9').val('');
            $('#tgl_min_bayar10').val('');
            $('#tgl_min_bayar11').val('');
            $('#tgl_min_bayar12').val('');

            $("#bayar1").attr("required",""); //wajib diisi
            $("#bayar1").attr("min","1"); //wajib diisi
            $("#ppn_bayar1").attr("required",""); //wajib diisi
            $("#tgl_min_bayar1").attr("required",""); //wajib diisi
            $('#bayar1').val(0);
            $('#ppn_bayar1').val(0);

            $("#bayar2").attr("required",""); //wajib diisi
            $("#bayar2").attr("min","1"); //wajib diisi
            $("#ppn_bayar2").attr("required",""); //wajib diisi
            $("#tgl_min_bayar2").attr("required",""); //wajib diisi
            $('#bayar2').val(0);
            $('#ppn_bayar2').val(0);

          }else if(jenis_pembayaran == 3){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').show();
            $('#pembayaran_4').hide();
            $('#pembayaran_5').hide();
            $('#pembayaran_6').hide();
            $('#pembayaran_7').hide();
            $('#pembayaran_8').hide();
            $('#pembayaran_9').hide();
            $('#pembayaran_10').hide();
            $('#pembayaran_11').hide();
            $('#pembayaran_12').hide();

            $('#bayar4').val('');
            $('#bayar5').val('');
            $('#bayar6').val('');
            $('#bayar7').val('');
            $('#bayar8').val('');
            $('#bayar9').val('');
            $('#bayar10').val('');
            $('#bayar11').val('');
            $('#bayar12').val('');

            $('#ppn_bayar4').val('');
            $('#ppn_bayar5').val('');
            $('#ppn_bayar6').val('');
            $('#ppn_bayar7').val('');
            $('#ppn_bayar8').val('');
            $('#ppn_bayar9').val('');
            $('#ppn_bayar10').val('');
            $('#ppn_bayar11').val('');
            $('#ppn_bayar12').val('');

            $('#tgl_min_bayar4').val('');
            $('#tgl_min_bayar5').val('');
            $('#tgl_min_bayar6').val('');
            $('#tgl_min_bayar7').val('');
            $('#tgl_min_bayar8').val('');
            $('#tgl_min_bayar9').val('');
            $('#tgl_min_bayar10').val('');
            $('#tgl_min_bayar11').val('');
            $('#tgl_min_bayar12').val('');

            $("#bayar1").attr("required",""); //wajib diisi
            $("#bayar1").attr("min","1"); //wajib diisi
            $("#ppn_bayar1").attr("required",""); //wajib diisi
            $("#tgl_min_bayar1").attr("required",""); //wajib diisi
            $('#bayar1').val(0);
            $('#ppn_bayar1').val(0);

            $("#bayar2").attr("required",""); //wajib diisi
            $("#bayar2").attr("min","1"); //wajib diisi
            $("#ppn_bayar2").attr("required",""); //wajib diisi
            $("#tgl_min_bayar2").attr("required",""); //wajib diisi
            $('#bayar2').val(0);
            $('#ppn_bayar2').val(0);

            $("#bayar3").attr("required",""); //wajib diisi
            $("#bayar3").attr("min","1"); //wajib diisi
            $("#ppn_bayar3").attr("required",""); //wajib diisi
            $("#tgl_min_bayar3").attr("required",""); //wajib diisi
            $('#bayar3').val(0);
            $('#ppn_bayar3').val(0);

          }else if(jenis_pembayaran == 4){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').show();
            $('#pembayaran_4').show();
            $('#pembayaran_5').hide();
            $('#pembayaran_6').hide();
            $('#pembayaran_7').hide();
            $('#pembayaran_8').hide();
            $('#pembayaran_9').hide();
            $('#pembayaran_10').hide();
            $('#pembayaran_11').hide();
            $('#pembayaran_12').hide();

            $('#bayar5').val('');
            $('#bayar6').val('');
            $('#bayar7').val('');
            $('#bayar8').val('');
            $('#bayar9').val('');
            $('#bayar10').val('');
            $('#bayar11').val('');
            $('#bayar12').val('');

            $('#ppn_bayar5').val('');
            $('#ppn_bayar6').val('');
            $('#ppn_bayar7').val('');
            $('#ppn_bayar8').val('');
            $('#ppn_bayar9').val('');
            $('#ppn_bayar10').val('');
            $('#ppn_bayar11').val('');
            $('#ppn_bayar12').val('');

            $('#tgl_min_bayar5').val('');
            $('#tgl_min_bayar6').val('');
            $('#tgl_min_bayar7').val('');
            $('#tgl_min_bayar8').val('');
            $('#tgl_min_bayar9').val('');
            $('#tgl_min_bayar10').val('');
            $('#tgl_min_bayar11').val('');
            $('#tgl_min_bayar12').val('');

            $("#bayar1").attr("required",""); //wajib diisi
            $("#bayar1").attr("min","1"); //wajib diisi
            $("#ppn_bayar1").attr("required",""); //wajib diisi
            $("#tgl_min_bayar1").attr("required",""); //wajib diisi
            $('#bayar1').val(0);
            $('#ppn_bayar1').val(0);

            $("#bayar2").attr("required",""); //wajib diisi
            $("#bayar2").attr("min","1"); //wajib diisi
            $("#ppn_bayar2").attr("required",""); //wajib diisi
            $("#tgl_min_bayar2").attr("required",""); //wajib diisi
            $('#bayar2').val(0);
            $('#ppn_bayar2').val(0);

            $("#bayar3").attr("required",""); //wajib diisi
            $("#bayar3").attr("min","1"); //wajib diisi
            $("#ppn_bayar3").attr("required",""); //wajib diisi
            $("#tgl_min_bayar3").attr("required",""); //wajib diisi
            $('#bayar3').val(0);
            $('#ppn_bayar3').val(0);

            $("#bayar4").attr("required",""); //wajib diisi
            $("#bayar4").attr("min","1"); //wajib diisi
            $("#ppn_bayar4").attr("required",""); //wajib diisi
            $("#tgl_min_bayar4").attr("required",""); //wajib diisi
            $('#bayar4').val(0);
            $('#ppn_bayar4').val(0);

          }else if(jenis_pembayaran == 5){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').show();
            $('#pembayaran_4').show();
            $('#pembayaran_5').show();
            $('#pembayaran_6').hide();
            $('#pembayaran_7').hide();
            $('#pembayaran_8').hide();
            $('#pembayaran_9').hide();
            $('#pembayaran_10').hide();
            $('#pembayaran_11').hide();
            $('#pembayaran_12').hide();

            $('#bayar6').val('');
            $('#bayar7').val('');
            $('#bayar8').val('');
            $('#bayar9').val('');
            $('#bayar10').val('');
            $('#bayar11').val('');
            $('#bayar12').val('');

            $('#ppn_bayar6').val('');
            $('#ppn_bayar7').val('');
            $('#ppn_bayar8').val('');
            $('#ppn_bayar9').val('');
            $('#ppn_bayar10').val('');
            $('#ppn_bayar11').val('');
            $('#ppn_bayar12').val('');

            $('#tgl_min_bayar6').val('');
            $('#tgl_min_bayar7').val('');
            $('#tgl_min_bayar8').val('');
            $('#tgl_min_bayar9').val('');
            $('#tgl_min_bayar10').val('');
            $('#tgl_min_bayar11').val('');
            $('#tgl_min_bayar12').val('');

            $("#bayar1").attr("required",""); //wajib diisi
            $("#bayar1").attr("min","1"); //wajib diisi
            $("#ppn_bayar1").attr("required",""); //wajib diisi
            $("#tgl_min_bayar1").attr("required",""); //wajib diisi
            $('#bayar1').val(0);
            $('#ppn_bayar1').val(0);

            $("#bayar2").attr("required",""); //wajib diisi
            $("#bayar2").attr("min","1"); //wajib diisi
            $("#ppn_bayar2").attr("required",""); //wajib diisi
            $("#tgl_min_bayar2").attr("required",""); //wajib diisi
            $('#bayar2').val(0);
            $('#ppn_bayar2').val(0);

            $("#bayar3").attr("required",""); //wajib diisi
            $("#bayar3").attr("min","1"); //wajib diisi
            $("#ppn_bayar3").attr("required",""); //wajib diisi
            $("#tgl_min_bayar3").attr("required",""); //wajib diisi
            $('#bayar3').val(0);
            $('#ppn_bayar3').val(0);

            $("#bayar4").attr("required",""); //wajib diisi
            $("#bayar4").attr("min","1"); //wajib diisi
            $("#ppn_bayar4").attr("required",""); //wajib diisi
            $("#tgl_min_bayar4").attr("required",""); //wajib diisi
            $('#bayar4').val(0);
            $('#ppn_bayar4').val(0);

            $("#bayar5").attr("required",""); //wajib diisi
            $("#bayar5").attr("min","1"); //wajib diisi
            $("#ppn_bayar5").attr("required",""); //wajib diisi
            $("#tgl_min_bayar5").attr("required",""); //wajib diisi
            $('#bayar5').val(0);
            $('#ppn_bayar5').val(0);
            
          }else if(jenis_pembayaran == 6){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').show();
            $('#pembayaran_4').show();
            $('#pembayaran_5').show();
            $('#pembayaran_6').show();
            $('#pembayaran_7').hide();
            $('#pembayaran_8').hide();
            $('#pembayaran_9').hide();
            $('#pembayaran_10').hide();
            $('#pembayaran_11').hide();
            $('#pembayaran_12').hide();

            $('#bayar7').val('');
            $('#bayar8').val('');
            $('#bayar9').val('');
            $('#bayar10').val('');
            $('#bayar11').val('');
            $('#bayar12').val('');

            $('#ppn_bayar7').val('');
            $('#ppn_bayar8').val('');
            $('#ppn_bayar9').val('');
            $('#ppn_bayar10').val('');
            $('#ppn_bayar11').val('');
            $('#ppn_bayar12').val('');

            $('#tgl_min_bayar7').val('');
            $('#tgl_min_bayar8').val('');
            $('#tgl_min_bayar9').val('');
            $('#tgl_min_bayar10').val('');
            $('#tgl_min_bayar11').val('');
            $('#tgl_min_bayar12').val('');

            $("#bayar1").attr("required",""); //wajib diisi
            $("#bayar1").attr("min","1"); //wajib diisi
            $("#ppn_bayar1").attr("required",""); //wajib diisi
            $("#tgl_min_bayar1").attr("required",""); //wajib diisi
            $('#bayar1').val(0);
            $('#ppn_bayar1').val(0);

            $("#bayar2").attr("required",""); //wajib diisi
            $("#bayar2").attr("min","1"); //wajib diisi
            $("#ppn_bayar2").attr("required",""); //wajib diisi
            $("#tgl_min_bayar2").attr("required",""); //wajib diisi
            $('#bayar2').val(0);
            $('#ppn_bayar2').val(0);

            $("#bayar3").attr("required",""); //wajib diisi
            $("#bayar3").attr("min","1"); //wajib diisi
            $("#ppn_bayar3").attr("required",""); //wajib diisi
            $("#tgl_min_bayar3").attr("required",""); //wajib diisi
            $('#bayar3').val(0);
            $('#ppn_bayar3').val(0);

            $("#bayar4").attr("required",""); //wajib diisi
            $("#bayar4").attr("min","1"); //wajib diisi
            $("#ppn_bayar4").attr("required",""); //wajib diisi
            $("#tgl_min_bayar4").attr("required",""); //wajib diisi
            $('#bayar4').val(0);
            $('#ppn_bayar4').val(0);

            $("#bayar5").attr("required",""); //wajib diisi
            $("#bayar5").attr("min","1"); //wajib diisi
            $("#ppn_bayar5").attr("required",""); //wajib diisi
            $("#tgl_min_bayar5").attr("required",""); //wajib diisi
            $('#bayar5').val(0);
            $('#ppn_bayar5').val(0);

            $("#bayar6").attr("required",""); //wajib diisi
            $("#bayar6").attr("min","1"); //wajib diisi
            $("#ppn_bayar6").attr("required",""); //wajib diisi
            $("#tgl_min_bayar6").attr("required",""); //wajib diisi
            $('#bayar6').val(0);
            $('#ppn_bayar6').val(0);
            
          }else if(jenis_pembayaran == 7){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').show();
            $('#pembayaran_4').show();
            $('#pembayaran_5').show();
            $('#pembayaran_6').show();
            $('#pembayaran_7').show();
            $('#pembayaran_8').hide();
            $('#pembayaran_9').hide();
            $('#pembayaran_10').hide();
            $('#pembayaran_11').hide();
            $('#pembayaran_12').hide();

            $('#bayar8').val('');
            $('#bayar9').val('');
            $('#bayar10').val('');
            $('#bayar11').val('');
            $('#bayar12').val('');

            $('#ppn_bayar8').val('');
            $('#ppn_bayar9').val('');
            $('#ppn_bayar10').val('');
            $('#ppn_bayar11').val('');
            $('#ppn_bayar12').val('');

            $('#tgl_min_bayar8').val('');
            $('#tgl_min_bayar9').val('');
            $('#tgl_min_bayar10').val('');
            $('#tgl_min_bayar11').val('');
            $('#tgl_min_bayar12').val('');

            $("#bayar1").attr("required",""); //wajib diisi
            $("#bayar1").attr("min","1"); //wajib diisi
            $("#ppn_bayar1").attr("required",""); //wajib diisi
            $("#tgl_min_bayar1").attr("required",""); //wajib diisi
            $('#bayar1').val(0);
            $('#ppn_bayar1').val(0);

            $("#bayar2").attr("required",""); //wajib diisi
            $("#bayar2").attr("min","1"); //wajib diisi
            $("#ppn_bayar2").attr("required",""); //wajib diisi
            $("#tgl_min_bayar2").attr("required",""); //wajib diisi
            $('#bayar2').val(0);
            $('#ppn_bayar2').val(0);

            $("#bayar3").attr("required",""); //wajib diisi
            $("#bayar3").attr("min","1"); //wajib diisi
            $("#ppn_bayar3").attr("required",""); //wajib diisi
            $("#tgl_min_bayar3").attr("required",""); //wajib diisi
            $('#bayar3').val(0);
            $('#ppn_bayar3').val(0);

            $("#bayar4").attr("required",""); //wajib diisi
            $("#bayar4").attr("min","1"); //wajib diisi
            $("#ppn_bayar4").attr("required",""); //wajib diisi
            $("#tgl_min_bayar4").attr("required",""); //wajib diisi
            $('#bayar4').val(0);
            $('#ppn_bayar4').val(0);

            $("#bayar5").attr("required",""); //wajib diisi
            $("#bayar5").attr("min","1"); //wajib diisi
            $("#ppn_bayar5").attr("required",""); //wajib diisi
            $("#tgl_min_bayar5").attr("required",""); //wajib diisi
            $('#bayar5').val(0);
            $('#ppn_bayar5').val(0);

            $("#bayar6").attr("required",""); //wajib diisi
            $("#bayar6").attr("min","1"); //wajib diisi
            $("#ppn_bayar6").attr("required",""); //wajib diisi
            $("#tgl_min_bayar6").attr("required",""); //wajib diisi
            $('#bayar6').val(0);
            $('#ppn_bayar6').val(0);

            $("#bayar7").attr("required",""); //wajib diisi
            $("#bayar7").attr("min","1"); //wajib diisi
            $("#ppn_bayar7").attr("required",""); //wajib diisi
            $("#tgl_min_bayar7").attr("required",""); //wajib diisi
            $('#bayar7').val(0);
            $('#ppn_bayar7').val(0);
            
          }else if(jenis_pembayaran == 8){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').show();
            $('#pembayaran_4').show();
            $('#pembayaran_5').show();
            $('#pembayaran_6').show();
            $('#pembayaran_7').show();
            $('#pembayaran_8').show();
            $('#pembayaran_9').hide();
            $('#pembayaran_10').hide();
            $('#pembayaran_11').hide();
            $('#pembayaran_12').hide();

            $('#bayar9').val('');
            $('#bayar10').val('');
            $('#bayar11').val('');
            $('#bayar12').val('');

            $('#ppn_bayar9').val('');
            $('#ppn_bayar10').val('');
            $('#ppn_bayar11').val('');
            $('#ppn_bayar12').val('');

            $('#tgl_min_bayar9').val('');
            $('#tgl_min_bayar10').val('');
            $('#tgl_min_bayar11').val('');
            $('#tgl_min_bayar12').val('');

            $("#bayar1").attr("required",""); //wajib diisi
            $("#bayar1").attr("min","1"); //wajib diisi
            $("#ppn_bayar1").attr("required",""); //wajib diisi
            $("#tgl_min_bayar1").attr("required",""); //wajib diisi
            $('#bayar1').val(0);
            $('#ppn_bayar1').val(0);

            $("#bayar2").attr("required",""); //wajib diisi
            $("#bayar2").attr("min","1"); //wajib diisi
            $("#ppn_bayar2").attr("required",""); //wajib diisi
            $("#tgl_min_bayar2").attr("required",""); //wajib diisi
            $('#bayar2').val(0);
            $('#ppn_bayar2').val(0);

            $("#bayar3").attr("required",""); //wajib diisi
            $("#bayar3").attr("min","1"); //wajib diisi
            $("#ppn_bayar3").attr("required",""); //wajib diisi
            $("#tgl_min_bayar3").attr("required",""); //wajib diisi
            $('#bayar3').val(0);
            $('#ppn_bayar3').val(0);

            $("#bayar4").attr("required",""); //wajib diisi
            $("#bayar4").attr("min","1"); //wajib diisi
            $("#ppn_bayar4").attr("required",""); //wajib diisi
            $("#tgl_min_bayar4").attr("required",""); //wajib diisi
            $('#bayar4').val(0);
            $('#ppn_bayar4').val(0);

            $("#bayar5").attr("required",""); //wajib diisi
            $("#bayar5").attr("min","1"); //wajib diisi
            $("#ppn_bayar5").attr("required",""); //wajib diisi
            $("#tgl_min_bayar5").attr("required",""); //wajib diisi
            $('#bayar5').val(0);
            $('#ppn_bayar5').val(0);

            $("#bayar6").attr("required",""); //wajib diisi
            $("#bayar6").attr("min","1"); //wajib diisi
            $("#ppn_bayar6").attr("required",""); //wajib diisi
            $("#tgl_min_bayar6").attr("required",""); //wajib diisi
            $('#bayar6').val(0);
            $('#ppn_bayar6').val(0);

            $("#bayar7").attr("required",""); //wajib diisi
            $("#bayar7").attr("min","1"); //wajib diisi
            $("#ppn_bayar7").attr("required",""); //wajib diisi
            $("#tgl_min_bayar7").attr("required",""); //wajib diisi
            $('#bayar7').val(0);
            $('#ppn_bayar7').val(0);

            $("#bayar8").attr("required",""); //wajib diisi
            $("#bayar8").attr("min","1"); //wajib diisi
            $("#ppn_bayar8").attr("required",""); //wajib diisi
            $("#tgl_min_bayar8").attr("required",""); //wajib diisi
            $('#bayar8').val(0);
            $('#ppn_bayar8').val(0);
            
          }else if(jenis_pembayaran == 9){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').show();
            $('#pembayaran_4').show();
            $('#pembayaran_5').show();
            $('#pembayaran_6').show();
            $('#pembayaran_7').show();
            $('#pembayaran_8').show();
            $('#pembayaran_9').show();
            $('#pembayaran_10').hide();
            $('#pembayaran_11').hide();
            $('#pembayaran_12').hide();

            $('#bayar10').val('');
            $('#bayar11').val('');
            $('#bayar12').val('');

            $('#ppn_bayar10').val('');
            $('#ppn_bayar11').val('');
            $('#ppn_bayar12').val('');

            $('#tgl_min_bayar10').val('');
            $('#tgl_min_bayar11').val('');
            $('#tgl_min_bayar12').val('');

            $("#bayar1").attr("required",""); //wajib diisi
            $("#bayar1").attr("min","1"); //wajib diisi
            $("#ppn_bayar1").attr("required",""); //wajib diisi
            $("#tgl_min_bayar1").attr("required",""); //wajib diisi
            $('#bayar1').val(0);
            $('#ppn_bayar1').val(0);

            $("#bayar2").attr("required",""); //wajib diisi
            $("#bayar2").attr("min","1"); //wajib diisi
            $("#ppn_bayar2").attr("required",""); //wajib diisi
            $("#tgl_min_bayar2").attr("required",""); //wajib diisi
            $('#bayar2').val(0);
            $('#ppn_bayar2').val(0);

            $("#bayar3").attr("required",""); //wajib diisi
            $("#bayar3").attr("min","1"); //wajib diisi
            $("#ppn_bayar3").attr("required",""); //wajib diisi
            $("#tgl_min_bayar3").attr("required",""); //wajib diisi
            $('#bayar3').val(0);
            $('#ppn_bayar3').val(0);

            $("#bayar4").attr("required",""); //wajib diisi
            $("#bayar4").attr("min","1"); //wajib diisi
            $("#ppn_bayar4").attr("required",""); //wajib diisi
            $("#tgl_min_bayar4").attr("required",""); //wajib diisi
            $('#bayar4').val(0);
            $('#ppn_bayar4').val(0);

            $("#bayar5").attr("required",""); //wajib diisi
            $("#bayar5").attr("min","1"); //wajib diisi
            $("#ppn_bayar5").attr("required",""); //wajib diisi
            $("#tgl_min_bayar5").attr("required",""); //wajib diisi
            $('#bayar5').val(0);
            $('#ppn_bayar5').val(0);

            $("#bayar6").attr("required",""); //wajib diisi
            $("#bayar6").attr("min","1"); //wajib diisi
            $("#ppn_bayar6").attr("required",""); //wajib diisi
            $("#tgl_min_bayar6").attr("required",""); //wajib diisi
            $('#bayar6').val(0);
            $('#ppn_bayar6').val(0);

            $("#bayar7").attr("required",""); //wajib diisi
            $("#bayar7").attr("min","1"); //wajib diisi
            $("#ppn_bayar7").attr("required",""); //wajib diisi
            $("#tgl_min_bayar7").attr("required",""); //wajib diisi
            $('#bayar7').val(0);
            $('#ppn_bayar7').val(0);

            $("#bayar8").attr("required",""); //wajib diisi
            $("#bayar8").attr("min","1"); //wajib diisi
            $("#ppn_bayar8").attr("required",""); //wajib diisi
            $("#tgl_min_bayar8").attr("required",""); //wajib diisi
            $('#bayar8').val(0);
            $('#ppn_bayar8').val(0);

            $("#bayar9").attr("required",""); //wajib diisi
            $("#bayar9").attr("min","1"); //wajib diisi
            $("#ppn_bayar9").attr("required",""); //wajib diisi
            $("#tgl_min_bayar9").attr("required",""); //wajib diisi
            $('#bayar9').val(0);
            $('#ppn_bayar9').val(0);
            
          }else if(jenis_pembayaran == 10){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').show();
            $('#pembayaran_4').show();
            $('#pembayaran_5').show();
            $('#pembayaran_6').show();
            $('#pembayaran_7').show();
            $('#pembayaran_8').show();
            $('#pembayaran_9').show();
            $('#pembayaran_10').show();
            $('#pembayaran_11').hide();
            $('#pembayaran_12').hide();

            $('#bayar11').val('');
            $('#bayar12').val('');

            $('#ppn_bayar11').val('');
            $('#ppn_bayar12').val('');

            $('#tgl_min_bayar11').val('');
            $('#tgl_min_bayar12').val('');

            $("#bayar1").attr("required",""); //wajib diisi
            $("#bayar1").attr("min","1"); //wajib diisi
            $("#ppn_bayar1").attr("required",""); //wajib diisi
            $("#tgl_min_bayar1").attr("required",""); //wajib diisi
            $('#bayar1').val(0);
            $('#ppn_bayar1').val(0);

            $("#bayar2").attr("required",""); //wajib diisi
            $("#bayar2").attr("min","1"); //wajib diisi
            $("#ppn_bayar2").attr("required",""); //wajib diisi
            $("#tgl_min_bayar2").attr("required",""); //wajib diisi
            $('#bayar2').val(0);
            $('#ppn_bayar2').val(0);

            $("#bayar3").attr("required",""); //wajib diisi
            $("#bayar3").attr("min","1"); //wajib diisi
            $("#ppn_bayar3").attr("required",""); //wajib diisi
            $("#tgl_min_bayar3").attr("required",""); //wajib diisi
            $('#bayar3').val(0);
            $('#ppn_bayar3').val(0);

            $("#bayar4").attr("required",""); //wajib diisi
            $("#bayar4").attr("min","1"); //wajib diisi
            $("#ppn_bayar4").attr("required",""); //wajib diisi
            $("#tgl_min_bayar4").attr("required",""); //wajib diisi
            $('#bayar4').val(0);
            $('#ppn_bayar4').val(0);

            $("#bayar5").attr("required",""); //wajib diisi
            $("#bayar5").attr("min","1"); //wajib diisi
            $("#ppn_bayar5").attr("required",""); //wajib diisi
            $("#tgl_min_bayar5").attr("required",""); //wajib diisi
            $('#bayar5').val(0);
            $('#ppn_bayar5').val(0);

            $("#bayar6").attr("required",""); //wajib diisi
            $("#bayar6").attr("min","1"); //wajib diisi
            $("#ppn_bayar6").attr("required",""); //wajib diisi
            $("#tgl_min_bayar6").attr("required",""); //wajib diisi
            $('#bayar6').val(0);
            $('#ppn_bayar6').val(0);

            $("#bayar7").attr("required",""); //wajib diisi
            $("#bayar7").attr("min","1"); //wajib diisi
            $("#ppn_bayar7").attr("required",""); //wajib diisi
            $("#tgl_min_bayar7").attr("required",""); //wajib diisi
            $('#bayar7').val(0);
            $('#ppn_bayar7').val(0);

            $("#bayar8").attr("required",""); //wajib diisi
            $("#bayar8").attr("min","1"); //wajib diisi
            $("#ppn_bayar8").attr("required",""); //wajib diisi
            $("#tgl_min_bayar8").attr("required",""); //wajib diisi
            $('#bayar8').val(0);
            $('#ppn_bayar8').val(0);

            $("#bayar9").attr("required",""); //wajib diisi
            $("#bayar9").attr("min","1"); //wajib diisi
            $("#ppn_bayar9").attr("required",""); //wajib diisi
            $("#tgl_min_bayar9").attr("required",""); //wajib diisi
            $('#bayar9').val(0);
            $('#ppn_bayar9').val(0);

            $("#bayar10").attr("required",""); //wajib diisi
            $("#bayar10").attr("min","1"); //wajib diisi
            $("#ppn_bayar10").attr("required",""); //wajib diisi
            $("#tgl_min_bayar10").attr("required",""); //wajib diisi
            $('#bayar10').val(0);
            $('#ppn_bayar10').val(0);
            
          }else if(jenis_pembayaran == 11){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').show();
            $('#pembayaran_4').show();
            $('#pembayaran_5').show();
            $('#pembayaran_6').show();
            $('#pembayaran_7').show();
            $('#pembayaran_8').show();
            $('#pembayaran_9').show();
            $('#pembayaran_10').show();
            $('#pembayaran_11').show();
            $('#pembayaran_12').hide();

            $('#bayar12').val('');

            $('#ppn_bayar12').val('');

            $('#tgl_min_bayar12').val('');

            $("#bayar1").attr("required",""); //wajib diisi
            $("#bayar1").attr("min","1"); //wajib diisi
            $("#ppn_bayar1").attr("required",""); //wajib diisi
            $("#tgl_min_bayar1").attr("required",""); //wajib diisi
            $('#bayar1').val(0);
            $('#ppn_bayar1').val(0);

            $("#bayar2").attr("required",""); //wajib diisi
            $("#bayar2").attr("min","1"); //wajib diisi
            $("#ppn_bayar2").attr("required",""); //wajib diisi
            $("#tgl_min_bayar2").attr("required",""); //wajib diisi
            $('#bayar2').val(0);
            $('#ppn_bayar2').val(0);

            $("#bayar3").attr("required",""); //wajib diisi
            $("#bayar3").attr("min","1"); //wajib diisi
            $("#ppn_bayar3").attr("required",""); //wajib diisi
            $("#tgl_min_bayar3").attr("required",""); //wajib diisi
            $('#bayar3').val(0);
            $('#ppn_bayar3').val(0);

            $("#bayar4").attr("required",""); //wajib diisi
            $("#bayar4").attr("min","1"); //wajib diisi
            $("#ppn_bayar4").attr("required",""); //wajib diisi
            $("#tgl_min_bayar4").attr("required",""); //wajib diisi
            $('#bayar4').val(0);
            $('#ppn_bayar4').val(0);

            $("#bayar5").attr("required",""); //wajib diisi
            $("#bayar5").attr("min","1"); //wajib diisi
            $("#ppn_bayar5").attr("required",""); //wajib diisi
            $("#tgl_min_bayar5").attr("required",""); //wajib diisi
            $('#bayar5').val(0);
            $('#ppn_bayar5').val(0);

            $("#bayar6").attr("required",""); //wajib diisi
            $("#bayar6").attr("min","1"); //wajib diisi
            $("#ppn_bayar6").attr("required",""); //wajib diisi
            $("#tgl_min_bayar6").attr("required",""); //wajib diisi
            $('#bayar6').val(0);
            $('#ppn_bayar6').val(0);

            $("#bayar7").attr("required",""); //wajib diisi
            $("#bayar7").attr("min","1"); //wajib diisi
            $("#ppn_bayar7").attr("required",""); //wajib diisi
            $("#tgl_min_bayar7").attr("required",""); //wajib diisi
            $('#bayar7').val(0);
            $('#ppn_bayar7').val(0);

            $("#bayar7").attr("required",""); //wajib diisi
            $("#bayar7").attr("min","1"); //wajib diisi
            $("#ppn_bayar8").attr("required",""); //wajib diisi
            $("#tgl_min_bayar8").attr("required",""); //wajib diisi
            $('#bayar8').val(0);
            $('#ppn_bayar8').val(0);

            $("#bayar9").attr("required",""); //wajib diisi
            $("#bayar9").attr("min","1"); //wajib diisi
            $("#ppn_bayar9").attr("required",""); //wajib diisi
            $("#tgl_min_bayar9").attr("required",""); //wajib diisi
            $('#bayar9').val(0);
            $('#ppn_bayar9').val(0);

            $("#bayar10").attr("required",""); //wajib diisi
            $("#bayar10").attr("min","1"); //wajib diisi
            $("#ppn_bayar10").attr("required",""); //wajib diisi
            $("#tgl_min_bayar10").attr("required",""); //wajib diisi
            $('#bayar10').val(0);
            $('#ppn_bayar10').val(0);

            $("#bayar11").attr("required",""); //wajib diisi
            $("#bayar11").attr("min","1"); //wajib diisi
            $("#ppn_bayar11").attr("required",""); //wajib diisi
            $("#tgl_min_bayar11").attr("required",""); //wajib diisi
            $('#bayar11').val(0);
            $('#ppn_bayar11').val(0);
            
          }else if(jenis_pembayaran == 12){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').show();
            $('#pembayaran_4').show();
            $('#pembayaran_5').show();
            $('#pembayaran_6').show();
            $('#pembayaran_7').show();
            $('#pembayaran_8').show();
            $('#pembayaran_9').show();
            $('#pembayaran_10').show();
            $('#pembayaran_11').show();
            $('#pembayaran_12').show();

            $("#bayar1").attr("required",""); //wajib diisi
            $("#bayar1").attr("min","1"); //wajib diisi
            $("#ppn_bayar1").attr("required",""); //wajib diisi
            $("#tgl_min_bayar1").attr("required",""); //wajib diisi
            $('#bayar1').val(0);
            $('#ppn_bayar1').val(0);

            $("#bayar2").attr("required",""); //wajib diisi
            $("#bayar2").attr("min","1"); //wajib diisi
            $("#ppn_bayar2").attr("required",""); //wajib diisi
            $("#tgl_min_bayar2").attr("required",""); //wajib diisi
            $('#bayar2').val(0);
            $('#ppn_bayar2').val(0);

            $("#bayar3").attr("required",""); //wajib diisi
            $("#bayar3").attr("min","1"); //wajib diisi
            $("#ppn_bayar3").attr("required",""); //wajib diisi
            $("#tgl_min_bayar3").attr("required",""); //wajib diisi
            $('#bayar3').val(0);
            $('#ppn_bayar3').val(0);

            $("#bayar4").attr("required",""); //wajib diisi
            $("#bayar4").attr("min","1"); //wajib diisi
            $("#ppn_bayar4").attr("required",""); //wajib diisi
            $("#tgl_min_bayar4").attr("required",""); //wajib diisi
            $('#bayar4').val(0);
            $('#ppn_bayar4').val(0);

            $("#bayar5").attr("required",""); //wajib diisi
            $("#bayar5").attr("min","1"); //wajib diisi
            $("#ppn_bayar5").attr("required",""); //wajib diisi
            $("#tgl_min_bayar5").attr("required",""); //wajib diisi
            $('#bayar5').val(0);
            $('#ppn_bayar5').val(0);

            $("#bayar6").attr("required",""); //wajib diisi
            $("#bayar6").attr("min","1"); //wajib diisi
            $("#ppn_bayar6").attr("required",""); //wajib diisi
            $("#tgl_min_bayar6").attr("required",""); //wajib diisi
            $('#bayar6').val(0);
            $('#ppn_bayar6').val(0);

            $("#bayar7").attr("required",""); //wajib diisi
            $("#bayar7").attr("min","1"); //wajib diisi
            $("#ppn_bayar7").attr("required",""); //wajib diisi
            $("#tgl_min_bayar7").attr("required",""); //wajib diisi
            $('#bayar7').val(0);
            $('#ppn_bayar7').val(0);

            $("#bayar8").attr("required",""); //wajib diisi
            $("#bayar8").attr("min","1"); //wajib diisi
            $("#ppn_bayar8").attr("required",""); //wajib diisi
            $("#tgl_min_bayar8").attr("required",""); //wajib diisi
            $('#bayar8').val(0);
            $('#ppn_bayar8').val(0);

            $("#bayar9").attr("required",""); //wajib diisi
            $("#bayar9").attr("min","1"); //wajib diisi
            $("#ppn_bayar9").attr("required",""); //wajib diisi
            $("#tgl_min_bayar9").attr("required",""); //wajib diisi
            $('#bayar9').val(0);
            $('#ppn_bayar9').val(0);

            $("#bayar10").attr("required",""); //wajib diisi
            $("#bayar10").attr("min","1"); //wajib diisi
            $("#ppn_bayar10").attr("required",""); //wajib diisi
            $("#tgl_min_bayar10").attr("required",""); //wajib diisi
            $('#bayar10').val(0);
            $('#ppn_bayar10').val(0);

            $("#bayar11").attr("required",""); //wajib diisi
            $("#bayar11").attr("min","1"); //wajib diisi
            $("#ppn_bayar11").attr("required",""); //wajib diisi
            $("#tgl_min_bayar11").attr("required",""); //wajib diisi
            $('#bayar11').val(0);
            $('#ppn_bayar11').val(0);

            $("#bayar12").attr("required",""); //wajib diisi
            $("#bayar12").attr("min","1"); //wajib diisi
            $("#ppn_bayar12").attr("required",""); //wajib diisi
            $("#tgl_min_bayar12").attr("required",""); //wajib diisi
            $('#bayar12').val(0);
            $('#ppn_bayar12').val(0);
            
          }

        }

        // Panggil fungsi ubah data (realtime) saat form (price_item, qty_item, discount_item) di ketik / di klik
          $(document).on('change', '#tipe_transaksi', function(){
            tampil_bayar();

            // setiap klik combo box nya, tombol dan total nya di reset
            $('#totalFr_rp').text('');
            $('#totalFr').val('');
            $('#tombol_kirim').hide();
            // $('#tombol_kirim2').hide();
            $('#tombol_reset').hide();
          });

       
      });
    </script>


    <!-- Script Hitung Total Otomatis Frekuensi Bayar -->
    <script type="text/javascript">
      $(document).ready(function(){

        // Rubah format angka javascript
        function rubah2(angka){
           var reverse = angka.toString().split('').reverse().join(''),
           ribuan = reverse.match(/\d{1,3}/g);
           ribuan = ribuan.join('.').split('').reverse().join('');
           return ribuan;
         }

        function hitung_otomatis_fr(){
          var pembayaran_1 = $('#bayar1').val();
          var pembayaran_2 = $('#bayar2').val();
          var pembayaran_3 = $('#bayar3').val();
          var pembayaran_4 = $('#bayar4').val();
          var pembayaran_5 = $('#bayar5').val();
          var pembayaran_6 = $('#bayar6').val();
          var pembayaran_7 = $('#bayar7').val();
          var pembayaran_8 = $('#bayar8').val();
          var pembayaran_9 = $('#bayar9').val();
          var pembayaran_10 = $('#bayar10').val();
          var pembayaran_11 = $('#bayar11').val();
          var pembayaran_12 = $('#bayar12').val();

          var ppn1 = $('#ppn_bayar1').val();
          var ppn2 = $('#ppn_bayar2').val();
          var ppn3 = $('#ppn_bayar3').val();
          var ppn4 = $('#ppn_bayar4').val();
          var ppn5 = $('#ppn_bayar5').val();
          var ppn6 = $('#ppn_bayar6').val();
          var ppn7 = $('#ppn_bayar7').val();
          var ppn8 = $('#ppn_bayar8').val();
          var ppn9 = $('#ppn_bayar9').val();
          var ppn10 = $('#ppn_bayar10').val();
          var ppn11 = $('#ppn_bayar11').val();
          var ppn12 = $('#ppn_bayar12').val();

          total_fr = (pembayaran_1*1) + (pembayaran_2*1) + (pembayaran_3*1) + (pembayaran_4*1) + (pembayaran_5*1) + (pembayaran_6*1) + (pembayaran_7*1) + (pembayaran_8*1) + (pembayaran_9*1) + (pembayaran_10*1) + (pembayaran_11*1) + (pembayaran_12*1); 

          total_ppn = (ppn1*1) + (ppn2*1) + (ppn3*1) + (ppn4*1) + (ppn5*1) + (ppn6*1) + (ppn7*1) + (ppn8*1) + (ppn9*1) + (ppn10*1) + (ppn11*1) + (ppn12*1);

          $('#totalFr').val(total_fr + total_ppn);
          $('#totalFr_rp').text('Rp ' + rubah2(total_fr + total_ppn));
        }

        $(document).on('keyup mouseup', '#bayar1, #bayar2, #bayar3, #bayar4, #bayar5, #bayar6, #bayar7, #bayar8, #bayar9, #bayar10, #bayar11, #bayar12, #ppn_bayar1, #ppn_bayar2, #ppn_bayar3, #ppn_bayar4, #ppn_bayar5, #ppn_bayar6, #ppn_bayar7, #ppn_bayar8, #ppn_bayar9, #ppn_bayar10, #ppn_bayar11, #ppn_bayar12', function(){
          hitung_otomatis_fr();
        });

      });
    </script>
    <!-- / Script Hitung Total Otomatis Frekuensi Bayar -->


    <!-- Script Validasi Total Harus = Total Frekuensi, kalo tidak tombol gak muncul -->
    <script type="text/javascript">
      $(document).ready(function(){

        $('#tombol_kirim').hide();
        // $('#tombol_kirim2').hide();
        $('#tombol_reset').hide();
        $('#ubah_tipetrans').hide();
        $('#notif').hide();

        $(document).on('click', '#btn_ubah_tipetrans', function(){
          $('#tombol_kirim').hide();
          $('#ubah_tipetrans').show();
          $('#notif').show();
          $('#tanggal1').attr("required","");
        });


        function tampilkan_tombol(){
          if(jumlah_atas == total_fr && ppn_atas == total_ppn && jumlah_atas!=0){
            $('#tombol_kirim').show();
            // $('#tombol_kirim2').show();
            $('#tombol_reset').show();
            $('#notif').hide();
          }else{
            $('#tombol_kirim').hide();
            // $('#tombol_kirim2').hide();
            $('#tombol_reset').hide();
            $('#notif').show();
          }
        }

        $(document).on('keyup mouseup', '#bayar1, #bayar2, #bayar3, #bayar4, #bayar5, #bayar6, #bayar7, #bayar8, #bayar9, #bayar10, #bayar11, #bayar12, #ppn_bayar1, #ppn_bayar2, #ppn_bayar3, #ppn_bayar4, #ppn_bayar5, #ppn_bayar6, #ppn_bayar7, #ppn_bayar8, #ppn_bayar9, #ppn_bayar10, #ppn_bayar11, #ppn_bayar12, #jumlah, #ppn', function(){
          tampilkan_tombol();
        });

      });
    </script>


  <!-- Script Upload Multiple File -->
    <script type="text/javascript">

      $(document).ready(function(){
        for(b=1; b<=1; b++){
          barisBaru();
        }
        $('#BarisBaru').click(function(e){
          e.preventDefault();
          barisBaru();
        });

        $("tableLoop tbody").find('input[type=text]').filter(':visible:first').focus();
      });
      
      function barisBaru(){
        $(document).ready(function(){
          $("[data-toggle='tooltip'").tooltip();
        });

        var Nomor = $("#tableLoop tbody tr").length + 1;
        var Baris = '<tr>';
                Baris += '<td class="text-center">'+Nomor+'</td>';

                Baris += '<td>';
                  Baris += '<input type="file" id="pilih_file" name="files[]" class="form-control" placeholder="Upload File">';
                Baris += '</td>';

                Baris += '<td>';
                  Baris += '<input type="text" id="nama_file" name="nama_file[]" class="form-control" placeholder="Nama File" autocomplete="off">';
                Baris += '</td>';

                Baris += '<td class="text-center">';
                  Baris += '<a class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Baris" id="HapusBaris"><i class="fa fa-times"></i></a>';
                Baris += '</td>';
            Baris += '</tr>';

        $("#tableLoop tbody").append(Baris);
        $("#tableLoop tbody tr").each(function(){
          $(this).find('td:nth-child(2) input').focus();
        });

      }

      $(document).on('click', '#HapusBaris', function(e){
        e.preventDefault();
        var Nomor = 1;
        $(this).parent().parent().remove();
        $('tableLoop tbody tr').each(function(){
          $(this).find('td:nth-child(1)').html(Nomor);
          Nomor++;
        });
      });


      // Jika file upload di klik, nama file akan jadi required/wajib
      $(document).ready(function() {
        $("#pilih_file").click(function() {
          $("#nama_file").attr("required","");
        })
     });

    </script>


    <!-- Script Tombol Hilang Kalo Jumlah Di Otak Atik -->
