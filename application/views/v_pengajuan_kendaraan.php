
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
            <div class="col-sm-8 col-sm-offset-2" style="border:1px dotted gray; padding: 10px;">
              
              <h3 style="text-align: center;">Form Pengajuan Biaya (Perbaikan Kendaraan)</h3>
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
                  <label for="nomor_invoice">Nomor Invoice :</label>
                  <input type="text" name="nomor_invoice" class="form-control" required placeholder="Optional" autocomplete="off">
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

                <h4 style="background-color: orange; padding:10px; border-radius: 10px;">Kolom Tambahan Biaya Perbaikan Kendaraan</h4><br>

                <!-- Kendaraan Operasional -->
                <div id="kendaraan_operasional">
                  <div>
                    <label for="nopol">Nomor Polisi</label>
                  </div>
                  <div class="form-group input-group">
                    <input type="text" name="nopol_perbaikan" id="nopol" class="form-control" readonly autofocus>
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
                </div>
                <!-- Penutup Kendaraan Operasional -->

                

                <div class="form-group">
                  <label for="kilometer">Kilometer Saat Pengajuan :</label>
                  <input type="text" name="kilometer_pengajuan" class="form-control" value="" required autocomplete="off">
                </div>

                <!-- <div class="form-group">
                  <label for="lain_lain">Besar Pengajuan BBM :</label>
                  <input type="number" name="lain_lain" id="lain_lain" class="form-control" required placeholder="Rp" pattern="[1-9]{20}" onkeyup="validasi()">
                </div> -->

                <b>Rincian Data Sparepart/Material :</b>
                <table class="table table-bordered mt-5" id="tableLoop_sparepart">
                  <thead>
                    <tr class="bg-success">
                      <th>No</th>
                      <th>Nama Sparepart</th>
                      <th>Jumlah</th>
                      <th>Diskon</th>
                      <th>Jenis Sparepart</th>
                      <th class="text-center">
                        <button class="btn btn-primary btn-xs" id="BarisBaru_sparepart">
                          <i class="fa fa-plus"></i> Tambah
                        </button>
                      </th>
                    </tr>
                  </thead>

                  <tbody id="table_data_sparepart"></tbody>

                  <tfoot>
                    <tr style="font-weight:bold;" class="text-right">
                      <td colspan="2" class="text-right">TOTAL :</td>
                      <td><span id="tot_jumlah_sparepart">0</span></td>
                      <td><span id="tot_diskon_sparepart">0</span></td>
                    </tr>
                  </tfoot>
                </table>

                <b>Rincian Data Jasa Perbaikan :</b>
                <table class="table table-bordered mt-5" id="tableLoop_jasa">
                  <thead>
                    <tr class="bg-success">
                      <th>No</th>
                      <th width="40%">Nama Jasa</th>
                      <th width="25%">Jumlah</th>
                      <th width="25%">Diskon</th>
                      <th class="text-center">
                        <button class="btn btn-primary btn-xs" id="BarisBaru_jasa">
                          <i class="fa fa-plus"></i> Tambah
                        </button>
                      </th>
                    </tr>
                  </thead>

                  <tbody id="table_data_jasa"></tbody>

                  <tfoot>
                    <tr style="font-weight:bold;" class="text-right">
                      <td colspan="2" class="text-right">TOTAL :</td>
                      <td><span id="tot_jumlah_jasa">0</span></td>
                      <td><span id="tot_diskon_jasa">0</span></td>
                    </tr>
                  </tfoot>
                </table>

                <div class="form-group">
                  <label for="total">Total (Nett) :</label>
                  <input type="number" name="total" id="total" placeholder="Rp" hidden><br>

                  <!-- Total yang ada pemisah rupiah nya -->
                  <span id="total_rp" style="font-weight: bold; font-size: 20px; padding: 5px;">0</span>
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
                            <input class="form-control" type="date" min="<?php echo date('Y-m-d') ?>" max="2021-12-31" name="tanggal_minta_bayar[]" required></input>
                          </td>

                          <td>
                            <input class="form-control" type="number" name="jumlah_bayar[]" required placeholder="Masukkan Jumlah (Rp)" id="bayar1"></input>
                          </td>

                          <input type="number" name="ppn_bayar[]" placeholder="PPN" id="ppn_bayar1" hidden></input>

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
        var merk_kendaraan = $(this).data('merk_kendaraan');

        $('#nopol').val(nopol);
        $('#merk_kendaraan').val(merk_kendaraan);

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

          total_fr = (pembayaran_1*1); //perkalian salah satu trik biar angka bisa ditambah
          $('#totalFr').val(total_fr);
          $('#totalFr_rp').text('Rp ' + rubah2(total_fr));
        }

        $(document).on('keyup mouseup', '#bayar1, #bayar2, #bayar3, #ppn_bayar1', function(){
          hitung_otomatis_fr();
        });

      });
    </script>
    <!-- / Script Hitung Total Otomatis Frekuensi Bayar -->


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
    <!-- Penutup Script Upload Multiple File -->


    <!-- Script Sparepart Multiple --> 
    <script type="text/javascript">

    //    function rubah_sparepart(angka){
    //      var reverse = angka.toString().split('').reverse().join(''),
    //      ribuan = reverse.match(/\d{1,3}/g);
    //      ribuan = ribuan.join('.').split('').reverse().join('');
    //      return ribuan;
    //    }

      
      $(document).ready(function(){

        for(b=1; b<=1; b++){
          barisBaru_sparepart();
        }
        $('#BarisBaru_sparepart').click(function(e){
          e.preventDefault();
          barisBaru_sparepart();
        });

        $("tableLoop_sparepart tbody").find('input[type=text]').filter(':visible:first').focus();
      });
      
      function barisBaru_sparepart(){
        $(document).ready(function(){
          $("[data-toggle='tooltip'").tooltip();
        });

        var Nomor = $("#tableLoop_sparepart tbody tr").length + 1;
        var Baris = '<tr>';
                Baris += '<td class="text-center">'+Nomor+'</td>'; 

                Baris += '<td>';
                  Baris += '<input type="text" name="sparepart[]" id="sparepart" class="form-control" autocomplete="off" placeholder="Nama Sparepart">';
                Baris += '</td>';

                Baris += '<td>';
                  Baris += '<input type="number" name="jumlah_sparepart[]" id="jumlah_sparepart" class="form-control" value="0">';
                Baris += '</td>'; 

                Baris += '<td>';
                  Baris += '<input type="number" name="diskon_sparepart[]" id="diskon_sparepart" class="form-control" value="0" autocomplete="off">';
                Baris += '</td>';

                Baris += '<td>';
                  Baris += '<input type="text" name="keterangan_sparepart[]" id="keterangan_sparepart" class="form-control" autocomplete="off" placeholder="Diisi Oleh Reviewer" disabled>';
                Baris += '</td>';

                // Baris += '<td>';
                //   Baris += '<select name="keterangan_sparepart[]" class="form-control" required="">';
                //   Baris += '<option value="">-Jenis Sparepart-</option>';
                //   Baris += '<?php foreach($data_sparepart as $row){ ?>';
                //   Baris += '<option value="<?php echo $row['nama_sparepart'] ?>"><?php echo $row['nama_sparepart'] ?></option>';
                //   Baris += '<?php } ?>';
                //   Baris += '</select>';
                // Baris += '</td>';

                Baris += '<td class="text-center">';
                  Baris += '<a class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Baris" id="HapusBaris_sparepart"><i class="fa fa-times"></i></a>';
                Baris += '</td>';
            Baris += '</tr>';

        $("#tableLoop_sparepart tbody").append(Baris);
        $("#tableLoop_sparepart tbody tr").each(function(){
          $(this).find('td:nth-child(2) input').focus();
        });

      }

      $(document).on('click', '#HapusBaris_sparepart', function(e){
        e.preventDefault();
        var Nomor = 1;
        $(this).parent().parent().remove();
        $('tableLoop_sparepart tbody tr').each(function(){
          $(this).find('td:nth-child(1)').html(Nomor);
          Nomor++;
        });
      });

    </script>
    <!-- Penutup Script Sparepart Multiple -->


    <!-- Script Jasa Multiple --> 
    <script type="text/javascript">

       function rubah_jasa(angka){
         var reverse = angka.toString().split('').reverse().join(''),
         ribuan = reverse.match(/\d{1,3}/g);
         ribuan = ribuan.join('.').split('').reverse().join('');
         return ribuan;
       }

      
      $(document).ready(function(){

        for(b=1; b<=1; b++){
          barisBaru_jasa();
        }
        $('#BarisBaru_jasa').click(function(e){
          e.preventDefault();
          barisBaru_jasa();
        });

        $("tableLoop_jasa tbody").find('input[type=text]').filter(':visible:first').focus();
      });
      
      function barisBaru_jasa(){
        $(document).ready(function(){
          $("[data-toggle='tooltip'").tooltip();
        });

        var Nomor = $("#tableLoop_jasa tbody tr").length + 1;
        var Baris = '<tr>';
                Baris += '<td class="text-center">'+Nomor+'</td>'; 

                Baris += '<td>';
                  Baris += '<input type="text" name="jasa[]" id="jasa" class="form-control" placeholder="Masukkan Nama Jasa">';
                Baris += '</td>'; 

                Baris += '<td>';
                  Baris += '<input type="number" name="jumlah_jasa[]" id="jumlah_jasa" class="form-control" value="0">';
                Baris += '</td>'; 

                Baris += '<td>';
                  Baris += '<input type="number" name="diskon_jasa[]" id="diskon_jasa" class="form-control" value="0" autocomplete="off">';
                Baris += '</td>';

                Baris += '<td class="text-center">';
                  Baris += '<a class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Baris" id="HapusBaris_jasa"><i class="fa fa-times"></i></a>';
                Baris += '</td>';
            Baris += '</tr>';

        $("#tableLoop_jasa tbody").append(Baris);
        $("#tableLoop_jasa tbody tr").each(function(){
          $(this).find('td:nth-child(2) input').focus();
        });

      }

      $(document).on('click', '#HapusBaris_jasa', function(e){
        e.preventDefault();
        var Nomor = 1;
        $(this).parent().parent().remove();
        $('tableLoop_jasa tbody tr').each(function(){
          $(this).find('td:nth-child(1)').html(Nomor);
          Nomor++;
        });
      });
      

      function hitung_total_jasa(){
        var total_jasa = 0;
        var diskon_jasa = 0;
        var total_sparepart = 0;
        var diskon_sparepart = 0;

        var total_selisih = 0;

        $('#table_data_jasa tr').each(function(){
        total_jasa += parseInt($(this).find('#jumlah_jasa').val());
        diskon_jasa += parseInt($(this).find('#diskon_jasa').val());
        });

        $('#table_data_sparepart tr').each(function(){
        total_sparepart += parseInt($(this).find('#jumlah_sparepart').val());
        diskon_sparepart += parseInt($(this).find('#diskon_sparepart').val());
        });

        total_selisih = total_jasa - diskon_jasa + total_sparepart - diskon_sparepart;

        isNaN(total_jasa) ? $('#total_rp').text(0) : $('#total_rp').text(rubah_jasa(total_selisih));
        isNaN(total_jasa) ? $('#jumlah').val(0) : $('#jumlah').val(total_selisih);
        isNaN(total_jasa) ? $('#total').val(0) : $('#total').val(total_selisih);

        isNaN(total_jasa) ? $('#tot_jumlah_sparepart').text(0) : $('#tot_jumlah_sparepart').text(rubah_jasa(total_sparepart));
        isNaN(total_jasa) ? $('#tot_diskon_sparepart').text(0) : $('#tot_diskon_sparepart').text(rubah_jasa(diskon_sparepart));

        isNaN(total_jasa) ? $('#tot_jumlah_jasa').text(0) : $('#tot_jumlah_jasa').text(rubah_jasa(total_jasa));
        isNaN(total_jasa) ? $('#tot_diskon_jasa').text(0) : $('#tot_diskon_jasa').text(rubah_jasa(diskon_jasa));

    }

    $(document).on('keyup', '#jumlah_jasa, #diskon_jasa, #jumlah_sparepart, #diskon_sparepart', function(){
        hitung_total_jasa();
    });

    </script>
    <!-- Penutup Script Jasa Multiple -->

    <!-- Script Validasi Total Harus = Total Frekuensi, kalo tidak tombol gak muncul -->
    <script type="text/javascript">
      $(document).ready(function(){

        $('#tombol_kirim').hide();
        $('#tombol_reset').hide();
        $('#notif').show();

        function tampilkan_tombol(){
          var total = $('#total').val();
          var bayar = $('#bayar1').val();

          if(total == bayar && total!=0){
            $('#tombol_kirim').show();
            $('#tombol_reset').show();
            $('#notif').hide();
          }else{
            $('#tombol_kirim').hide();
            $('#tombol_reset').hide();
            $('#notif').show();
          }
        }

        $(document).on('keyup mouseup', '#bayar1, #jumlah_sparepart, #diskon_sparepart, #jumlah_jasa, #diskon_jasa', function(){
          tampilkan_tombol();
        });

      });
    </script>
    <!-- / Script Validasi Total Harus = Total Frekuensi, kalo tidak tombol gak muncul -->


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
