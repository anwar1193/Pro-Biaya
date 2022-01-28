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
        Revisi Nomor Invoice
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
              
              <h3 style="text-align: center;">Revisi Nomor Invoice</h3>
              <hr style="border-width: 4px; width: 300px">
              
              <form method="post" action="<?php echo base_url().'p_on_proccess/update_invoice' ?>" enctype="multipart/form-data">

                <input type="text" name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>" hidden>

                <input type="text" name="page" value="<?php echo $page ?>" hidden>

                <div class="form-group">
                    <label for="nomor">Nomor Pengajuan :</label>
                    <input type="text" name="nomor_pengajuan" class="form-control" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>" readonly>
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
                  <label for="jenis_invoice">Jenis Invoice :</label>
                  <select id="jenis_invoice" class="form-control" required="">
                    <option value="fixed">Fixed</option>
                    <!-- <option value="fixed" <?= $data_pengajuan['nomor_invoice']!='ESTIMASI' && $data_pengajuan['nomor_invoice']!='TBO' ? 'selected' : null ?>>Fixed</option>
                    <option value="estimasi" <?= $data_pengajuan['nomor_invoice']=='ESTIMASI' ? 'selected' : null ?>>Estimasi</option>
                    <option value="tbo" <?= $data_pengajuan['nomor_invoice']=='TBO' ? 'selected' : null ?>>Fixed (TBO)</option> -->
                  </select>
                </div>

                <div class="form-group">
                  <label for="nomor_invoice">Nomor Invoice :</label>
                  <input type="text" name="nomor_invoice" id="ex_nomor_invoice" class="form-control" value="" autocomplete="off" required autofocus placeholder="Masukkan Nomor Invoice">
                </div>
                
                <!-- Kemana Harus Kembali -->
                <?php if($page=='rev_inv'){ ?>
                  <a href="<?php echo base_url().'p_on_proccess/revisi_invoice' ?>" class="btn btn-danger btn-sm" >
                    <i class="fa fa-backward"></i> Kembali
                  </a>
                <?php }else{ ?>
                  <a href="<?php echo base_url().'inquiry_pengajuan' ?>" class="btn btn-danger btn-sm" >
                    <i class="fa fa-backward"></i> Kembali
                  </a>
                <?php } ?>

                <button class="btn btn-success btn-sm" id="tombol_kirim" type="submit"><i class="fa fa-send"></i> Update Nomor Invoice</button>

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

   


  <!-- Script Upload Multiple File -->
    <script type="text/javascript">
      
      $(document).ready(function() {

        // Pilihan Jenis Invoice
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
        $("#ex_nomor_invoice").on({
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
          var nomor_invoice = $('#ex_nomor_invoice').val();
          if(nomor_invoice.substr(0,1) == '-'){
            alert("Nomor Invoice Tidak Boleh Diawali Tanda - (Minus)");
            return false;
          }
        });
      

      });

    </script>

    <!-- Script Tombol Hilang Kalo Jumlah Di Otak Atik -->

    <!-- Script Validasi Hilangkan/Hidden Tombol Kirim Pengajuan  -->
    <script src="<?php echo base_url().'js_custom/validasi_th_pengajuan.js' ?>"></script>