
  <?php  

    // Fungsi tanggal / zona waktu biar gak error
    date_default_timezone_set("Asia/Jakarta");

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <!-- Ambil Data Flashdata berhasil untuk kata sweet alert -->
  <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ganti Password
        <small>Update Data User </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!-- Tampilan Form Tambah Data -->
      <div class="box box-widget">
        <div class="box-body">
          <div class="row">
            <div class="col-sm-4 col-sm-offset-4">

              <h3>Ganti Password</h3>
              <hr style="border-width: 4px;">
              <form method="post" action="<?php echo base_url().'ganti_password/update_password' ?>">

                <input type="text" name="id_user" value="<?php echo $data_user['id'] ?>" hidden>

                <div class="form-group">
                  <label for="nama">Nama <span style="color: red;">*</span></label>
                  <input type="text" name="nama" id="nama" value="<?php echo $data_user['nama_lengkap'] ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label for="username">Username <span style="color: red;">*</span></label>
                  <input type="text" name="username" value="<?php echo $data_user['username'] ?>" id="username" class="form-control" readonly autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="password_lama">Password Lama <span style="color: red;">*</span></label>
                  <input type="password" name="password_lama" id="password_lama" class="form-control form-password" required>
                </div>

                <div class="form-group">
                  <label for="password">Password Baru <span style="color: red;">*</span></label>
                  <input type="password" name="password" id="password" class="form-control form-password" required minlength="5" placeholder="minimal 5 karakter">
                </div>

                <input type="checkbox" class="form-checkbox"> Show password <br><br>

                <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Update Password</button>
                <button class="btn btn-danger btn-sm" type="reset"><i class="fa fa-times"></i> Reset</button>

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

  <!-- Script Lihat Password -->
  <script type="text/javascript">
    $(document).ready(function(){   
      $('.form-checkbox').click(function(){
        if($(this).is(':checked')){
          $('.form-password').attr('type','text');
        }else{
          $('.form-password').attr('type','password');
        }
      });
    });
  </script>

  <!-- Panggil File JS SweetAlert -->
  <script src="<?php echo base_url().'asset/sweetAlert/sweetalert2.all.min.js' ?>"></script>

  <!-- script sweet alert -->
  <script type="text/javascript">
    // Jika Berhasil Melakukan Aksi (Simpan, Edit, Hapus)
    var flashData = $('.flash-data').data('flashdata');

    if(flashData){
      Swal.fire({
        icon: 'warning', //Icon : success, error, warning, info, question
        title: 'Ganti Password !',
        text: flashData
        // footer: 'Data Mahasiswa Tersimpan Ke Database'
      });
    }

  </script>