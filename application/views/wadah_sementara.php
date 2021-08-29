
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
              
              <h3 style="text-align: center;">Edit Pengajuan Biaya</h3>
              <hr style="border-width: 4px; width: 300px">
              
              <form method="post" action="<?php echo base_url().'p_approved/update' ?>" enctype="multipart/form-data">

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
                      <input type="number" name="jumlah" id="jumlah" class="form-control" required value="<?php echo $data_pengajuan['jumlah'] ?>">
                    </div>

                    <div class="form-group">
                      <label for="ppn">PPN :</label>
                      <input type="number" name="ppn" id="ppn" class="form-control" required value="<?php echo $data_pengajuan['ppn'] ?>">
                    </div>

                    <div class="form-group">
                      <label for="pph23">PPH 23 :</label>
                      <input type="number" name="pph23" id="pph23" class="form-control" required value="<?php echo $data_pengajuan['pph23'] ?>">
                    </div>

                    <div class="form-group">
                      <label for="total">Total (Nett) :</label>
                      <input type="number" name="total" id="total" class="form-control" readonly value="<?php echo $data_pengajuan['total'] ?>">
                    </div>

                  </div>
                </div>
                <!-- Isian Uang -->

                <div class="form-group">
                  <label for="bank_penerima">Bank Penerima :</label>
                  <input type="text" name="bank_penerima" class="form-control" required value="<?php echo $data_pengajuan['bank_penerima'] ?>">
                </div>

                <div class="form-group">
                  <label for="norek_penerima">Nomor Rekening Penerima :</label>
                  <input type="text" name="norek_penerima" class="form-control" required value="<?php echo $data_pengajuan['norek_penerima'] ?>">
                </div>

                <div class="form-group">
                  <label for="atas_nama">Atas Nama :</label>
                  <input type="text" name="atas_nama" class="form-control" required value="<?php echo $data_pengajuan['atas_nama'] ?>">
                </div>

                <div class="form-group">
                  <label for="files">Upload Berkas Baru<span style="color: red;">*</span></label>
                  <input type="file" name="files[]" class="form-control" multiple="">
                </div>

                <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-send"></i> Update Pengajuan</button>
                
                <a href="<?php echo base_url().'p_approved/pending_by_pic' ?>" class="btn btn-danger btn-sm">
                  <i class="fa fa-backward"></i> Kembali
                </a>

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

      function hitung_otomatis(){
        var jumlah = $('#jumlah').val();
        var ppn = $('#ppn').val();
        var pph23 = $('#pph23').val();

        total = (jumlah*1) + (ppn*1) + (pph23*1); //perkalian salah satu trik biar angka bisa ditambah
        $('#total').val(total);
      }

      // Panggil fungsi ubah data (realtime) saat form (price_item, qty_item, discount_item) di ketik / di klik
      $(document).on('keyup mouseup', '#jumlah, #ppn, #pph23', function(){
        hitung_otomatis();
      });

    });
  </script>
  <!-- / Script Hitung Total Otomatis -->