<?php  

// Fungsi tanggal / zona waktu biar gak error
date_default_timezone_set("Asia/Jakarta");

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Management User Alternate
    <small>Input Data User </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Input User Alternate</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  
  <!-- Tampilan Form Tambah Data -->
  <div class="box box-widget">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <?php echo $this->session->flashdata('pesan'); ?>

          <h3>Input Data User Alternate</h3>
          <hr style="border-width: 4px;">
          <form method="post" action="<?php echo base_url().'data_user_alternate/simpan' ?>">

            <div>
              <label for="barcode">Alternate Untuk :</label>
            </div>
            <div class="form-group input-group">
              <input type="text" name="alternate_untuk_username" id="alternate_untuk_username" class="form-control" required readonly style="background-color:white" placeholder="Username">

              <input type="text" name="alternate_untuk_detail" id="alternate_untuk_detail" class="form-control" required readonly style="background-color:white" placeholder="Detail">

              <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#modal-alternateUntuk">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>

            <div>
              <label for="barcode">Pilih User Alternate :</label>
            </div>
            <div class="form-group input-group">
              <input type="text" name="user_alternate_nik" id="user_alternate_nik" class="form-control" required readonly style="background-color:white" placeholder="NIK">

              <input type="text" name="user_alternate_nama" id="user_alternate_nama" class="form-control" required readonly style="background-color:white" placeholder="Nama">

              <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#modal-karyawan">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>

            <div class="form-group">
              <label for="username">Username :</label>
              <input type="text" name="username" id="username" class="form-control" required autocomplete="off">
            </div>

            <div class="form-group">
              <label for="password">Password :</label>
              <input type="password" name="password" id="password" class="form-control form-password" required>
            </div>

            <input type="checkbox" class="form-checkbox"> Show password <br><br>

            <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan Data</button>

            <a href="<?php echo base_url().'data_user_alternate' ?>" class="btn btn-danger btn-sm">
                <i class="fa fa-times"></i> Kembali
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


<!-- Modal Data Karyawan -->
<div class="modal fade" id="modal-karyawan">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Data Karyawan</h4>
    </div>
    <div class="modal-body">
      
      <table class="table table-bordered" id="tableDT">
        <thead>
          <tr>
            <th>NIK</th>
            <th>Nama</th>
            <th>Cabang</th>
            <th>Divisi</th>
            <th>Departemen</th>
            <th>Level</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($data_karyawan as $data) : ?>
          <tr>
            <td><?php echo $data['nik'] ?></td>
            <td><?php echo $data['nama'] ?></td>
            <td><?php echo $data['cabang'] ?></td>
            <td><?php echo $data['divisi'] ?></td>
            <td><?php echo $data['departemen'] ?></td>
            <td><?php echo $data['level'] ?></td>
            <td>
              <button class="btn btn-info btn-xs" id="pilih" type="button"
                data-nik="<?php echo $data['nik'] ?>"
                data-nama="<?php echo $data['nama'] ?>"
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
<!-- / Modal Data Karyawan -->


<!-- Modal Alternate Untuk -->
<div class="modal fade" id="modal-alternateUntuk">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Data Karyawan</h4>
    </div>
    <div class="modal-body">
      
      <table class="table table-bordered" id="tableDT2">
        <thead>
          <tr>
            <th>Username</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Departemen</th>
            <th>Cabang</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($data_user as $data) : ?>
          <tr>
            <td><?php echo $data['username'] ?></td>
            <td><?php echo $data['nama_lengkap'] ?></td>
            <td><?php echo $data['level'] ?></td>
            <td><?php echo $data['departemen'] ?></td>
            <td><?php echo $data['cabang'] ?></td>
            <td>
              <button class="btn btn-info btn-xs" id="pilih_alternateUntuk" type="button"
                data-username="<?php echo $data['username'] ?>"
                data-nama_lengkap="<?php echo $data['nama_lengkap'] ?>"
                data-level="<?php echo $data['level'] ?>"
                data-departemen="<?php echo $data['departemen'] ?>"
                data-cabang="<?php echo $data['cabang'] ?>"
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
<!-- / Modal Alternate Untuk -->


<!-- Script Jquery Data Pilihan -->
<script>
$(document).ready(function(){

  //Pilih Data alternate untuk
  $(document).on('click','#pilih_alternateUntuk', function(){
    var username = $(this).data('username');
    var nama_lengkap = $(this).data('nama_lengkap');
    var level = $(this).data('level');
    var departemen = $(this).data('departemen');
    var cabang = $(this).data('cabang');

    $('#alternate_untuk_username').val(username);
    $('#alternate_untuk_detail').val(nama_lengkap);

    $('#modal-alternateUntuk').modal('hide');
  });

  // Pilih Data user alternate
  $(document).on('click','#pilih', function(){
    var nik = $(this).data('nik');
    var nama = $(this).data('nama');

    $('#user_alternate_nik').val(nik);
    $('#user_alternate_nama').val(nama);

    $('#modal-karyawan').modal('hide');
  });

});
</script>
<!-- / Script Jquery Data Pilihan -->

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