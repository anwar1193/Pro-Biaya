 <!-- CKEditor -->
 <script src="<?php echo base_url().'asset/ckeditor/ckeditor.js' ?>"></script>

 <!-- validasi tidak boleh titik/karakter -->
 <script type="text/javascript">

   // fungsi number
    function Number(nilai, pesan) {
        var numberExp = /^[0-9]+$/;
        if(nilai.value.match(numberExp)) {
            return true;
        }
        else {
            alert(pesan);
            nilai.focus();
            return false;
        }
    }

    function validasi() {
        Number(document.getElementById('jumlah'), 'Maaf Inputan Jumlah Harus Angka (Tidak Boleh Ada Titik/Karakter Lainnya)');
    }

    function validasi_norek() {
        Number(document.getElementById('norek_penerima'), 'Maaf Inputan Nomor Rekening Harus Angka (Tidak Boleh Ada Titik/Karakter Lainnya)');
    }


    function validasi_all(){
      // validasi();
      // validasi_norek();
    }

 </script>


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
              
              <h3 style="text-align: center;">Form Pengajuan Biaya</h3>
              <hr style="border-width: 4px; width: 300px">
              
              <form method="post" action="<?php echo base_url().'pengajuan_biaya/simpan' ?>" enctype="multipart/form-data">

                <!-- Form Atas-1 -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nim">Tanggal :</label>
                      <input type="text" name="tanggal" class="form-control" value="<?php echo date('d-m-Y') ?>" readonly>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nomor">Nomor :</label>
                      <input type="text" name="nomor_pengajuan" class="form-control" value="<?php echo $nopeng_otomatis ?>" readonly>

                      <!-- Tipe Form, Cek Fisik dan Kode Cashflow -->
                      <input type="text" name="form" value="<?php echo $data_sub_biaya['form'] ?>" hidden>
                      <input type="text" name="cek_fisik" value="<?php echo $data_sub_biaya['cek_fisik'] ?>"hidden>
                      <input type="text" name="kode_cashflow" value="<?php echo $data_sub_biaya['kode_cashflow'] ?>" hidden>

                    </div>
                  </div>
                </div>

                <!-- ref no -->
                <input type="text" name="ref_no" value="<?php echo $ref_no ?>" hidden>

                <!-- Form Atas-2 -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cabang">Cabang :</label>
                      <input type="text" name="cabang" class="form-control" value="<?php echo $cabang ?>" readonly>
                    </div>
                  </div>

                  <!-- Data Wilayah -->
                  <input type="text" name="wilayah" value="<?php echo $data_cabang['wilayah'] ?>" hidden>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bagian">Bagian (Departemen) :</label>
                      <input type="text" name="bagian" value="<?php echo $dept ?>" class="form-control" readonly>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="biaya">Biaya :</label>
                  <input type="text" name="jenis_biaya" class="form-control" value="<?php echo $data_sub_biaya['jenis_biaya'] ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="sub_biaya">Sub Biaya :</label>
                  <input type="text" name="sub_biaya" class="form-control" value="<?php echo $data_sub_biaya['sub_biaya'] ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="jenis_invoice">Jenis Invoice :</label>
                  <select id="jenis_invoice" class="form-control" required="">
                    <option value="">- Pilih -</option>
                    <option value="fixed">Fixed</option>
                    <option value="estimasi">Estimasi</option>
                    <option value="tbo">Fixed (TBO)</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nomor_invoice">Nomor Invoice :</label>
                  <input type="text" name="nomor_invoice" id="nomor_invoice" class="form-control" required autocomplete="off" readonly autofocus>
                </div>

                <!-- Departemen Tujuan -->
                <input type="text" name="dept_tujuan" value="<?php echo $data_sub_biaya['departemen_tujuan'] ?>" hidden>

                <div class="form-group">
                  <label for="keterangan">Keterangan (Rincian) :</label>
                  <textarea class="form-control" name="keterangan" id="bandel" required></textarea>
                </div>

                <!-- Check Box Memo -->
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="tambahkan_memo" value="ya">
                      <span style="font-weight:bold; font-size:18px">Tambahkan Internal Memo</span>
                    </label>
                  </div>
                </div>

                <!-- Isian Uang -->
                <div class="row">
                  <div class="col-md-6"></div>
                  <div class="col-md-6">
                    
                    <div class="form-group">
                      <label for="jumlah">Jumlah (Sebelum Pajak) :</label>
                      <!-- <input type="number" name="jumlah" id="jumlah" class="form-control" required placeholder="Rp" pattern="[1-9]{20}" onkeyup="validasi()"> -->
                      <input type="text" name="jumlah" id="jumlah" class="form-control" required placeholder="Rp" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>

                    <div class="form-group">
                      <label for="ppn">PPN :</label>
                      <!-- <input type="number" name="ppn" id="ppn" class="form-control" required value="0"> -->

                      <input type="text" name="ppn" id="ppn" class="form-control" required value="0" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>

                    <input type="number" name="pph23" id="pph23" required value="0" readonly hidden>

                    <div class="form-group">
                      <label for="total">Total (Nett) :</label>
                      <input type="number" name="total" id="total" hidden placeholder="Rp"><br>

                      <!-- Total yang ada pemisah rupiah nya -->
                      <span id="total_rp" style="font-weight: bold; font-size: 20px; padding: 5px;"></span>
                    </div>

                    

                  </div>
                </div>
                <!-- Isian Uang -->

                <div class="form-group">
                  <label for="bank_penerima">Bank Penerima :</label>

                  <select class="form-control" name="bank_penerima" id="bank_penerima" required="-Pilih Bank-">
                    <option value="">-Pilih Bank-</option>
                    <?php foreach($data_bank_pengaju as $row_bank){ ?>
                    <option value="<?php echo $row_bank['nama_bank']; ?>"><?php echo $row_bank['nama_bank']; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="norek_penerima">Nomor Rekening Penerima :</label>
                  <!-- <input type="number" name="norek_penerima" class="form-control" value="" required autocomplete="off" id="norek_penerima" onkeyup="validasi_norek()"> -->

                  <input type="text" name="norek_penerima" id="norek_penerima" class="form-control" required value="" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                </div>

                <div class="form-group">
                  <label for="atas_nama">Atas Nama :</label>
                  <input type="text" name="atas_nama" id="atas_nama" class="form-control" value="" required autocomplete="off">
                </div>

                <!-- <div class="form-group">
                  <label for="files">Upload Berkas <span style="color: red;">*</span></label>
                  <input type="file" name="files[]" class="form-control" multiple="">
                </div> -->

                <b>Upload Berkas (jpg / png / jpeg / pdf) :</b>
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

                <div class="form-group">
                  <label for="tipe_transaksi"></span> Tipe Transaksi :</label>
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
                            <input class="form-control" type="date" min="<?php echo date('Y-m-d') ?>" max="2022-12-31" name="tanggal_minta_bayar[]" id="tgl_min_bayar1"></input>
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar1"></input> -->
                            <input type="text" name="jumlah_bayar[]" id="bayar1" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar1"></input> -->
                            <input type="text" name="ppn_bayar[]" id="ppn_bayar1" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <!-- <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar2"></input> -->
                            <input type="text" name="jumlah_bayar[]" id="bayar2" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar2"></input> -->
                            <input type="text" name="ppn_bayar[]" id="ppn_bayar2" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <!-- <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar3"></input> -->
                            <input type="text" name="jumlah_bayar[]" id="bayar3" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar3"></input> -->
                            <input type="text" name="ppn_bayar[]" id="ppn_bayar3" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <!-- <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar4"></input> -->
                            <input type="text" name="jumlah_bayar[]" id="bayar4" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar4"></input> -->
                            <input type="text" name="ppn_bayar[]" id="ppn_bayar4" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <!-- <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar5"></input> -->
                            <input type="text" name="jumlah_bayar[]" id="bayar5" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar5"></input> -->
                            <input type="text" name="ppn_bayar[]" id="ppn_bayar5" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <!-- <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar6"></input> -->
                            <input type="text" name="jumlah_bayar[]" id="bayar6" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar6"></input> -->
                            <input type="text" name="ppn_bayar[]" id="ppn_bayar6" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <!-- <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar7"></input> -->
                            <input type="text" name="jumlah_bayar[]" id="bayar7" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar7"></input> -->
                            <input type="text" name="ppn_bayar[]" id="ppn_bayar7" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <!-- <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar8"></input> -->
                            <input type="text" name="jumlah_bayar[]" id="bayar8" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar8"></input> -->
                            <input type="text" name="ppn_bayar[]" id="ppn_bayar8" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <!-- <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar9"></input> -->
                            <input type="text" name="jumlah_bayar[]" id="bayar9" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar9"></input> -->
                            <input type="text" name="ppn_bayar[]" id="ppn_bayar9" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <!-- <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar10"></input> -->
                            <input type="text" name="jumlah_bayar[]" id="bayar10" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar10"></input> -->
                            <input type="text" name="ppn_bayar[]" id="ppn_bayar10" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <!-- <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar11"></input> -->
                            <input type="text" name="jumlah_bayar[]" id="bayar11" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar11"></input> -->
                            <input type="text" name="ppn_bayar[]" id="ppn_bayar11" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <!-- <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Jumlah (Sebelum Pajak)" id="bayar12"></input> -->
                            <input type="text" name="jumlah_bayar[]" id="bayar12" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </td>

                          <td>
                            <!-- <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar12"></input> -->
                            <input type="text" name="ppn_bayar[]" id="ppn_bayar12" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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

                <button class="btn btn-success btn-sm" id="tombol_kirim" type="submit"><i class="fa fa-send"></i> Kirim Pengajuan</button>
                
                <!-- <button class="btn btn-info btn-sm" id="tombol_kirim2" name="tambah_memo" type="submit" onclick="validasi_all()"><i class="fa fa-plus"></i> Kirim Pengajuan & Tambah Memo</button> -->

                <button class="btn btn-danger btn-sm" type="reset" id="tombol_reset"><i class="fa fa-times"></i> Reset</button>

                <!-- Notif tombol muncul -->
                <span id="notif">
                  Tombol "Kirim Pengajuan" Akan Tampil Jika Total Pengajuan Sesuai
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

  <!-- Notif saat refresh/meninggalkan halaman -->
   <!-- <script type="text/javascript">
     window.onbeforeunload = function() {
        return "Anda Yakin";
      };
   </script> -->


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
            $("#bayar1").attr("min","1"); //minimal 1
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
        $('#notif').show();


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
                  Baris += '<input type="text" name="nama_file[]" class="form-control" placeholder="Nama File" id="nama_file" autocomplete="off">';
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


  <!-- Script Tombol Reset -->
  <script type="text/javascript">
    $(document).ready(function(){

      // Panggil fungsi ubah data (realtime) saat form (price_item, qty_item, discount_item) di ketik / di klik
      $(document).on('click', '#tombol_reset', function(){
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
        $('#tombol_kirim').hide();
        // $('#tombol_kirim2').hide();
        $('#tombol_reset').hide();
        $('#total_rp').text('');
        $('#totalFr_rp').text('');
        $('#bandel').val('').change();
      });

      $('#jenis_invoice').change(function(){
        let jenis_invoice = $(this).val();

        if(jenis_invoice == 'fixed'){
          $('#nomor_invoice').removeAttr('readonly').val('').attr({'placeholder' : 'Masukkan Nomor Invoice'}).focus();
        }else if(jenis_invoice == 'estimasi'){
          $('#nomor_invoice').removeAttr('placeholder').val('ESTIMASI').attr({'readonly' : ''});
        }else if(jenis_invoice == 'tbo'){
          $('#nomor_invoice').removeAttr('placeholder').val('TBO').attr({'readonly' : ''});
        }
      });

      $(document).on('click', '#tombol_kirim', function(){
        var nomor_invoice = $('#nomor_invoice').val();
        if(nomor_invoice == '0'){
          alert("Nomor Invoice Tidak Boleh 0");
          $('#nomor_invoice').val('').focus();
        }
      });


      // Nomor Invoice Tidak Bisa Tulis Spasi
      $("#nomor_invoice").on({
      keydown: function(e) {
        if (e.which === 32)
          return false;
        },
        keyup: function(){
        this.value = this.value.toLowerCase();
        },
        change: function() {
          this.value = this.value.replace(/\s/g, "");
        }
      });

      // Nomor Invoice Tidak Boleh Diawali - (minus)
      $('#tombol_kirim').on('click', function(){
        var nomor_invoice = $('#nomor_invoice').val();
        if(nomor_invoice.substr(0,1) == '-'){
          alert("Nomor Invoice Tidak Boleh Diawali Tanda - (Minus)");
          return false;
        }
      });

    });
  </script>
  <!-- / Script Tombol Reset -->

  <!-- Script Validasi Hilangkan/Hidden Tombol Kirim Pengajuan  -->
  <script src="<?php echo base_url().'js_custom/validasi_th_pengajuan.js' ?>"></script>