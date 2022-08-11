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
              
              <form method="post" action="<?php echo base_url().'p_on_proccess/update_finance' ?>" enctype="multipart/form-data">

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

                <!-- Isian Uang -->
                <div class="row">
                  <div class="col-md-6"></div>
                  <div class="col-md-6">
                    
                    <div class="form-group">
                      <label for="jumlah">Jumlah :</label>
                      <input type="number" name="jumlah" id="jumlah" class="form-control" required value="<?php echo $data_pengajuan['jumlah'] ?>" onkeyup="validasi()" readonly>
                    </div>

                    <div class="form-group">
                      <label for="ppn">PPN :</label>
                      <input type="number" name="ppn" id="ppn" class="form-control" required value="<?php echo $data_pengajuan['ppn'] ?>" readonly>
                    </div>

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
                    <option value="<?php echo $data_pengajuan['bank_penerima']; ?>"><?php echo $data_pengajuan['bank_penerima']; ?></option>
                    <?php foreach($data_bank_pengaju as $row_bank){ ?>
                      <option value="<?php echo $row_bank['nama_bank']; ?>"><?php echo $row_bank['nama_bank']; ?></option>
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

                <div class="form-group">
                  <label>Tipe Transaksi :</label>
                  <?php 
                    if($frek_byr == '1'){
                      echo 'Biaya - '.$frek_byr.' Kali Pembayaran';
                    }else{
                      echo 'Uang Muka - '.$frek_byr.' Kali Pembayaran';
                    }
                  ?>
                  
                  <!-- <button type="button" class="btn btn-xs btn-primary" id="btn_ubah_tipetrans">
                    <span>
                      <i class="fa fa-edit"></i> Revisi
                    </span>
                  </button> -->

                </div>

                <table class="table table-bordered">
                  <tr style="background-color: orange">
                    <th>Bayar Ke</th>
                    <th>Tanggal Bayar</th>
                    <th>Jumlah Bayar</th>
                    <th>PPN</th>
                    <th>Total</th>
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
                      <td style="text-align: right;"><?php echo number_format($row_byr['jumlah_bayar'] + $row_byr['ppn_bayar'], 0, ',', '.') ?></td>
                    </tr>
                  <?php } ?>

                  <?php  
                      // cari total dari 
                      $nomor_pengajuan = $data_pengajuan['nomor_pengajuan'];
                      $data_total_bayar = $this->db->query("SELECT SUM(jumlah_bayar) AS jml_byr, SUM(ppn_bayar) AS ppn_byr FROM tbl_bayar WHERE nomor_pengajuan = '$nomor_pengajuan'")->row_array();
                    ?>
                    <tr>
                      <th colspan="2" style="text-align: right;">TOTAL</th>
                      <th style="text-align: right;"><?php echo number_format($data_total_bayar['jml_byr'], 0, ',', '.') ?></th>
                      <th style="text-align: right;"><?php echo number_format($data_total_bayar['ppn_byr'], 0, ',', '.') ?></th>
                      <th style="text-align: right;"><?php echo number_format($data_total_bayar['jml_byr'] + $data_total_bayar['ppn_byr'], 0, ',', '.') ?></th>
                    </tr>

                </table>

                <!-- Ubah Tipe Transaksi -->
                <div id="ubah_tipetrans">
                  <div class="form-group">
                    <label for="tipe_transaksi"></span> Ubah Tipe Transaksi :</label>
                    <select name="tipe_transaksi" class="form-control input-sm" id="tipe_transaksi">
                      <option value="0">- Pilih Tipe Transaksi -</option>
                      <option value="1">Biaya (1 Kali Pembayaran)</option>
                      <option value="2">Uang Muka (2 Kali Pembayaran)</option>
                      <option value="3">Uang Muka (3 Kali Pembayaran)</option>
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
                              <input class="form-control" type="date" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" name="tanggal_minta_bayar[]" id="tanggal1"></input>
                            </td>

                            <td>
                              <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Masukkan Jumlah (Rp)" id="bayar1" min="0"></input>
                            </td>

                            <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>" hidden>
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
                              <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Masukkan Jumlah (Rp)" id="bayar2" min="0"></input>
                            </td>

                            <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $data_pengajuan['nomor_pengajuan']  ?>" hidden>
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
                              <input class="form-control" type="number" name="jumlah_bayar[]" placeholder="Masukkan Jumlah (Rp)" id="bayar3" min="0"></input>
                            </td>

                            <input type="text" name="nomor_pengajuan_fr[]" value="<?php echo $data_pengajuan['nomor_pengajuan']  ?>" hidden>
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

                <button class="btn btn-success btn-sm" id="tombol_kirim" type="submit"><i class="fa fa-send"></i> Update Pengajuan</button>
                
                <a href="<?php echo base_url().'p_on_proccess/refin_detail/'.$data_pengajuan['id_pengajuan'] ?>" class="btn btn-danger btn-sm" >
                  <i class="fa fa-backward"></i> Kembali
                </a>

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
        
        $('#pembayaran_1').hide();
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

          total_fr = (pembayaran_1*1) + (pembayaran_2*1) + (pembayaran_3*1); //perkalian salah satu trik biar angka bisa ditambah
          $('#totalFr').val(total_fr);
          $('#totalFr_rp').text('Rp ' + rubah2(total_fr));
        }

        $(document).on('keyup mouseup', '#bayar1, #bayar2, #bayar3', function(){
          hitung_otomatis_fr();
        });

      });
    </script>
    <!-- / Script Hitung Total Otomatis Frekuensi Bayar -->


    <!-- Script Validasi Total Harus = Total Frekuensi, kalo tidak tombol gak muncul -->
    <script type="text/javascript">
      $(document).ready(function(){

        $('#ubah_tipetrans').hide();
        $('#notif').hide();

        // $(document).on('keyup mouseup', '#jumlah', function(){
        //   $('#tombol_kirim').hide();
        //   $('#tombol_reset').hide();
        //   $('#ubah_tipetrans').show();
        //   $('#notif').show();
        // });

        $(document).on('click', '#btn_ubah_tipetrans', function(){
          $('#tombol_kirim').hide();
          $('#ubah_tipetrans').show();
          $('#notif').show();
          $('#tanggal1').attr("required","");
        });

        function tampilkan_tombol(){
          if(total == total_fr){
            $('#tombol_kirim').show();
            $('#tombol_reset').show();
            $('#notif').hide();
          }else{
            $('#tombol_kirim').hide();
            $('#tombol_reset').hide();
            $('#notif').show();
          }
        }

        $(document).on('keyup mouseup', '#bayar1, #bayar2, #bayar3, #jumlah, #ppn', function(){
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
