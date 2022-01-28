
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
        Number(document.getElementById('lain_lain'), 'Maaf Inputan Besar Pengajuan BBM Harus Angka (Tidak Boleh Ada Titik/Karakter Lainnya)');
    }

    function validasi_norek() {
        Number(document.getElementById('norek_penerima'), 'Maaf Inputan Nomor Rekening Harus Angka (Tidak Boleh Ada Titik/Karakter Lainnya)');
    }

    function validasi_all(){
      validasi();
      validasi_norek();
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
              
              <h3 style="text-align: center;">Form Pengajuan Biaya (BBM)</h3>
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

                      <!-- Tipe Form Dan Cek Fisik -->
                      <input type="text" name="form" value="<?php echo $data_sub_biaya['form'] ?>" hidden>
                      <input type="text" name="cek_fisik" value="<?php echo $data_sub_biaya['cek_fisik'] ?>" hidden>
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
                  <textarea class="form-control" name="keterangan" required></textarea>
                </div>

                <!-- Isian Uang -->
                <div class="row">
                  <div class="col-md-6"></div>
                  <div class="col-md-6">

                    <input type="number" name="jumlah" id="jumlah" placeholder="Rp" hidden>
                    <input type="number" name="ppn" id="ppn" placeholder="Rp" hidden>
                    <input type="number" name="pph23" id="pph23" placeholder="Rp" hidden>

                    

                  </div>
                </div>
                <!-- Isian Uang -->

                <div class="form-group">
                  <label for="bank_penerima">Bank Penerima :</label>
                  <select class="form-control" name="bank_penerima" required="-Pilih Bank-">
                    <option value="">-Pilih Bank-</option>
                    <?php foreach($data_bank_pengaju as $row_bank){ ?>
                    <option value="<?php echo $row_bank['nama_bank']; ?>"><?php echo $row_bank['nama_bank']; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="norek_penerima">Nomor Rekening Penerima :</label>
                  <input type="number" name="norek_penerima" class="form-control" value="" required autocomplete="off" id="norek_penerima" onkeyup="validasi_norek()">
                </div>

                <div class="form-group">
                  <label for="atas_nama">Atas Nama :</label>
                  <input type="text" name="atas_nama" class="form-control" value="" required autocomplete="off">
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

                <h4 style="background-color: orange; padding:10px; border-radius: 10px;">Kolom Tambahan (Biaya BBM)</h4><br>

                <div>
                  <label for="merk_kendaraan">PILIH KENDARAAN :</label>
                  <!-- <button class="btn-success" id="tombol_kendaraan_operasional"></button> -->
                  <!-- <button class="btn-primary" id="tombol_kendaraan_pribadi">KENDARAAN PRIBADI/SEWA</button> -->

                  <a class="btn btn-success" id="tombol_kendaraan_operasional">KENDARAAN OPERASIONAL</a>
                  <a class="btn btn-primary" id="tombol_kendaraan_pribadi">KENDARAAN PRIBADI/SEWA</a>
                </div><br>

                <!-- Kendaraan Operasional -->
                <div id="kendaraan_operasional">
                  <div>
                    <label for="nopol">Nomor Polisi</label>
                  </div>
                  <div class="form-group input-group">
                    <input type="text" name="nopol" id="nopol" class="form-control" readonly autofocus>
                    <span class="input-group-btn">
                      <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#modal-kendaraan">
                        <i class="fa fa-search"></i>
                      </button>
                    </span>
                  </div>

                  <div class="form-group">
                    <label for="merk_kendaraan">Merk Kendaraan :</label>
                    <input type="text" name="merk_kendaraan" id="merk_kendaraan" class="form-control" value="" autocomplete="off" readonly>
                  </div>

                  <div class="form-group">
                    <label for="jenis_kendaraan">Jenis Kendaraan :</label>
                    <input type="text" name="jenis_kendaraan" id="jenis_kendaraan" class="form-control" value="" autocomplete="off" readonly>
                  </div>

                  <div class="form-group">
                    <label for="cc">Isi Kapasitas Silinder :</label>
                    <input type="text" name="kapasitas_silinder" id="kapasitas_silinder" class="form-control" value="" readonly autocomplete="off">
                  </div>
                </div>
                <!-- Penutup Kendaraan Operasional -->

                <!-- Kendaraan Pribadi -->
                <div id="kendaraan_pribadi">

                  <div class="form-group">
                    <label for="merk_kendaraan">Nomor Polisi :</label>
                    <input type="text" name="nopol_pribadi" id="nopol_pribadi" class="form-control" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label for="merk_kendaraan">Merk Kendaraan :</label>
                    <input type="text" name="merk_kendaraan_pribadi" id="merk_kendaraan_pribadi" class="form-control" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label for="jenis_kendaraan">Jenis Kendaraan :</label>
                    <input type="text" name="jenis_kendaraan_pribadi" id="jenis_kendaraan_pribadi" class="form-control" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label for="cc">Isi Kapasitas Silinder :</label>
                    <input type="text" name="kapasitas_silinder_pribadi" id="kapasitas_silinder_pribadi" class="form-control" autocomplete="off">
                  </div>
                </div>
                <!-- Penutup Kendaraan Pribadi -->

                <div class="form-group">
                  <label for="kilometer">Kilometer Saat Pengajuan :</label>
                  <input type="text" name="kilometer_pengajuan" class="form-control" value="" required autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="keperluan_bbm">Keperluan Pengajuan BBM :</label>
                  <input type="text" name="keperluan_pengajuan_bbm" class="form-control" value="" required autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="jenis_bbm">Jenis BBM :</label>
                  <select class="form-control" name="jenis_bbm">
                    <option value="Premium">Premium</option>
                    <option value="Pertalite atau Setara">Pertalite atau Setara</option>
                    <option value="Pertamax atau Setara">Pertamax atau Setara</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="lain_lain">Besar Pengajuan BBM :</label>
                  <input type="number" name="lain_lain" id="lain_lain" class="form-control" required placeholder="Rp" pattern="[1-9]{20}" onkeyup="validasi()">
                </div>

                <div class="form-group">
                  <label for="total">Total (Nett) :</label>
                  <input type="number" name="total" id="total" hidden placeholder="Rp"><br>

                  <!-- Total yang ada pemisah rupiah nya -->
                  <span id="total_rp" style="font-weight: bold; font-size: 20px; padding: 5px;"></span>
                </div>

                <div class="form-group">
                  <label for="tipe_transaksi"></span> Tipe Transaksi :</label>
                  <select name="tipe_transaksi" id="tipe_transaksi" class="form-control input-sm">
                    <option value="1">Biaya (1 Kali Pembayaran)</option>
                    <!-- <option value="2">Uang Muka (2 Kali Pembayaran)</option>
                    <option value="3">Uang Muka (3 Kali Pembayaran)</option> -->
                  </select>
                </div>

                <!-- Rincian Pembayaran -->
                <div class="row">
                  <div class="col-md-1"></div>

                  <div class="col-md-10">
                    
                    <div class="form-group" id="pembayaran_1">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      <label>Tanggal Pembayaran</label>
                      <table width="100%">
                        <tr>
                          <td>
                            <input class="form-control" type="date" min="<?php echo date('Y-m-d') ?>" max="2022-12-31" name="tanggal_minta_bayar[]" required></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" required placeholder="Masukkan Jumlah (Rp)" id="bayar1"></input>
                          </td>

                          <input type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar1" hidden></input>

                          <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $nopeng_otomatis ?>" hidden>
                        </tr>
                      </table>
                    </div>

                    <div class="form-group" id="pembayaran_2">
                      <!-- <label>Pembayaran Ke - <?php echo $i ?></label> -->
                      <label>Tanggal Pembayaran Ke-2</label>
                      <table width="100%">
                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Masukkan Jumlah (Rp)" id="bayar2"></input>
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
                      <label>Tanggal Pembayaran Ke-3</label>
                      <table width="100%">
                        <tr>
                          <td>
                            <input class="form-control" type="date" name="tanggal_minta_bayar[]" min="<?php echo date('Y-m-d') ?>" max="2021-12-31"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Masukkan Jumlah (Rp)" id="bayar3"></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar3" min="0"></input>
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

                <button class="btn btn-success btn-sm" id="tombol_kirim" type="submit" onclick="validasi_all()"><i class="fa fa-send"></i> Kirim Pengajuan</button>

                <button class="btn btn-danger btn-sm" type="reset" id="tombol_reset"><i class="fa fa-times"></i> Reset</button>

                <!-- Notif tombol muncul -->
                <span id="notif">
                  Tombol "Kirim Pengajuan" Akan Tampil Jika Total Pengajuan Sesuai
                </span>

                  </div>
                </div>
                

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


  <!-- Modal Kendaraan -->
  <div class="modal fade" id="modal-kendaraan">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Data Kendaraan</h4>
        </div>
        <div class="modal-body">
          
          <table class="table table-bordered" id="tableDT2">
            <thead>
              <tr>
                <th>No</th>
                <th>Nopol</th>
                <th>Jenis Kendaraan</th>
                <th>Merk Kendaraan</th>
                <th>Cabang</th>
              </tr>
            </thead>

            <tbody>
              <?php 
                $no=1;
                foreach($data_kendaraan as $data) : 
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nopol'] ?></td>
                <td><?php echo $data['jenis_kendaraan'] ?></td>
                <td><?php echo $data['merk_kendaraan'] ?></td>
                <td><?php echo $data['cabang'] ?></td>
                <td>
                  <button class="btn btn-info btn-xs" id="pilih-kendaraan" type="button"
                    data-nopol="<?php echo $data['nopol'] ?>"
                    data-jenis_kendaraan="<?php echo $data['jenis_kendaraan'] ?>"
                    data-merk_kendaraan="<?php echo $data['merk_kendaraan'] ?>"
                    data-kapasitas_silinder="<?php echo $data['kapasitas_silinder'] ?>"
                  >
                  <i class="fa fa-check"></i> Pilih</button></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- / Modal Kendaraan -->

  <!-- Script Jquery Data Kendaraan -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih-kendaraan', function(){
        var nopol = $(this).data('nopol');
        var jenis_kendaraan = $(this).data('jenis_kendaraan');
        var merk_kendaraan = $(this).data('merk_kendaraan');
        var kapasitas_silinder = $(this).data('kapasitas_silinder');

        $('#nopol').val(nopol);
        $('#jenis_kendaraan').val(jenis_kendaraan);
        $('#merk_kendaraan').val(merk_kendaraan);
        $('#kapasitas_silinder').val(kapasitas_silinder);

        $('#modal-kendaraan').modal('hide');
      });
    });
  </script>
  <!-- / Script Jquery Data Kendaraan -->


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
        var lain_lain = $('#lain_lain').val();
        tot_perdin = (lain_lain*1);
        $('#jumlah').val(tot_perdin);

        var jumlah = $('#jumlah').val();
        var ppn = $('#ppn').val();
        var pph23 = $('#pph23').val();

        total = (jumlah*1) + (ppn*1) + (pph23*1); //perkalian salah satu trik biar angka bisa ditambah
        $('#total').val(total);
        $('#total_rp').text('Rp ' + rubah(total));
      }

      // Panggil fungsi ubah data (realtime) saat form (price_item, qty_item, discount_item) di ketik / di klik
      $(document).on('keyup mouseup', '#jumlah, #ppn, #pph23, #lain_lain', function(){
        hitung_otomatis();
      });

    });
  </script>
  <!-- / Script Hitung Total Otomatis -->


  <!-- Script Frekuensi Pembayaran -->
   <script type="text/javascript">
      $(document).ready(function(){
        
        $('#pembayaran_2').hide();
        $('#pembayaran_3').hide();

        function tampil_bayar(){
          var jenis_pembayaran = $('#tipe_transaksi').val();

          if(jenis_pembayaran == 1){
            $('#pembayaran_1').show();
            $('#pembayaran_2').hide();
            $('#pembayaran_3').hide();
          }else if(jenis_pembayaran == 2){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').hide();
          }else if(jenis_pembayaran == 3){
            $('#pembayaran_1').show();
            $('#pembayaran_2').show();
            $('#pembayaran_3').show();
          }
        }

        // Panggil fungsi ubah data (realtime) saat form (price_item, qty_item, discount_item) di ketik / di klik
          $(document).on('change', '#tipe_transaksi', function(){
            tampil_bayar();
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

          var ppn1 = $('#ppn_bayar1').val();

          total_fr = (pembayaran_1*1) + (pembayaran_2*1) + (pembayaran_3*1) + (ppn1*1); //perkalian salah satu trik biar angka bisa ditambah
          $('#totalFr').val(total_fr);
          $('#totalFr_rp').text('Rp ' + rubah2(total_fr));
        }

        $(document).on('keyup mouseup', '#bayar1, #bayar2, #bayar3, #ppn_bayar1', function(){
          hitung_otomatis_fr();
        });

      });
    </script>
    <!-- / Script Hitung Total Otomatis Frekuensi Bayar -->


    <!-- Script Validasi Total Harus = Total Frekuensi, kalo tidak tombol gak muncul -->
    <script type="text/javascript">
      $(document).ready(function(){

        $('#tombol_kirim').hide();
        $('#tombol_reset').hide();
        $('#notif').show();

        function tampilkan_tombol(){
          if(total == total_fr && total!=0){
            $('#tombol_kirim').show();
            $('#tombol_reset').show();
            $('#notif').hide();
          }else{
            $('#tombol_kirim').hide();
            $('#tombol_reset').hide();
            $('#notif').show();
          }
        }

        $(document).on('keyup mouseup', '#bayar1, #bayar2, #bayar3, #lain_lain, #ppn_bayar1', function(){
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
                  Baris += '<input type="file" name="files[]" id="pilih_file" class="form-control" placeholder="Upload File">';
                Baris += '</td>';

                Baris += '<td>';
                  Baris += '<input type="text" name="nama_file[]" id="nama_file" class="form-control" placeholder="Nama File" autocomplete="off">';
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
        $('#tombol_kirim').hide();
        $('#tombol_reset').hide();
        $('#total_rp').text('');
        $('#totalFr_rp').text('');
      });

    });
  </script>
  <!-- / Script Tombol Reset -->

  <!-- Script Tombol Kendaraan -->
  <script type="text/javascript">
    $(document).ready(function(){

      $('#kendaraan_pribadi').hide();

      // Tombol Kendaraan Pribadi
      $(document).on('click', '#tombol_kendaraan_pribadi', function(){
        $('#kendaraan_pribadi').slideDown(1000);
        $('#kendaraan_operasional').hide();
        $('#nopol').val('');
        $('#merk_kendaraan').val('');
        $('#jenis_kendaraan').val('');
        $('#kapasitas_silinder').val('');
      });

      // Tombol Kendaraan Operasional
      $(document).on('click', '#tombol_kendaraan_operasional', function(){
        $('#kendaraan_pribadi').hide();
        $('#kendaraan_operasional').slideDown(1000);
        $('#nopol_pribadi').val('');
        $('#merk_kendaraan_pribadi').val('');
        $('#jenis_kendaraan_pribadi').val('');
        $('#kapasitas_silinder_pribadi').val('');
      });

      // Setelah tombol kirim di klik, tombol tsb menghilang
      // $(document).on('click', '#tombol_kirim', function(){
      //   $(this).hide();
      // });

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
  <!-- / Script Tombol Kendaraan -->