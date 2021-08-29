
  <?php  

    // Fungsi tanggal / zona waktu biar gak error
    date_default_timezone_set("Asia/Jakarta");

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Management User
        <small>Input Data User </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Input User</li>
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

              <h3>Input Data User</h3>
              <hr style="border-width: 4px;">
              <form method="post" action="<?php echo base_url().'data_user/simpan' ?>">

                <div class="form-group">
                  <label for="level">Level</label>
                  <select class="form-control" name="level">
                    <?php foreach($data_level as $row_level){ ?>
                    <option value="<?php echo $row_level['level'] ?>"><?php echo $row_level['level'] ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div>
                  <label for="barcode">NIK *</label>
                </div>
                <div class="form-group input-group">
                  <input type="text" name="nik" id="nik" class="form-control" required autofocus>
                  <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#modal-karyawan">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>

                <div class="form-group">
                  <label for="nama">Nama <span style="color: red;">*</span></label>
                  <input type="text" name="nama" id="nama" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label for="cabang">Cabang <span style="color: red;">*</span></label>
                  <input type="text" name="cabang" id="cabang" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label for="divisi">Divisi <span style="color: red;">*</span></label>
                  <input type="text" name="divisi" id="divisi" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label for="nomor_wa">Nomor Whatsapp <span style="color: red;">*</span></label>
                  <input type="text" name="nomor_wa" id="nomor_wa" class="form-control" placeholder="Contoh : 6285219063505">
                </div>

                <div class="form-group">
                  <label for="email">Alamat Email <span style="color: red;">*</span></label>
                  <input type="email" name="email" id="email" class="form-control">
                </div>

                <div class="form-group">
                  <label for="departemen">Departemen <span style="color: red;">*</span></label>
                  <input type="text" name="departemen" id="departemen" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label for="username">Username <span style="color: red;">*</span></label>
                  <input type="text" name="username" id="username" class="form-control" required autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="password">Password <span style="color: red;">*</span></label>
                  <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div>
                  <label for="atasan">Atasan *</label>
                </div>
                <div class="form-group input-group">
                  <input type="text" name="atasan" id="atasan" class="form-control" autofocus>
                  <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#modal-atasan">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>

                <div class="form-group">
                  <label for="level_atasan">Level Atasan <span style="color: red;">*</span></label>
                  <input type="text" name="level_atasan" id="level_atasan" class="form-control" readonly autocomplete="off">
                </div>

                <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan Data</button>
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
                    data-cabang="<?php echo $data['cabang'] ?>"
                    data-divisi="<?php echo $data['divisi'] ?>"
                    data-departemen="<?php echo $data['departemen'] ?>"
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


  <!-- Modal Atasan -->
  <div class="modal fade" id="modal-atasan">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Data User</h4>
        </div>
        <div class="modal-body">
          
          <table class="table table-bordered" id="tableDT2">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Level</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($data_user as $data) : ?>
              <tr>
                <td><?php echo $data['nik'] ?></td>
                <td><?php echo $data['nama_lengkap'] ?></td>
                <td><?php echo $data['level'] ?></td>
                <td>
                  <button class="btn btn-info btn-xs" id="pilih-atasan" type="button"
                    data-nik_atasan="<?php echo $data['nik'] ?>"
                    data-nama_atasan="<?php echo $data['nama_lengkap'] ?>"
                    data-level_atasan="<?php echo $data['level'] ?>"
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
  <!-- / Modal Atasan -->


  <!-- Script Jquery Data Karyawan -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih', function(){
        var nik = $(this).data('nik');
        var nama = $(this).data('nama');
        var cabang = $(this).data('cabang');
        var departemen = $(this).data('departemen');
        var divisi = $(this).data('divisi');

        $('#nik').val(nik);
        $('#nama').val(nama);
        $('#cabang').val(cabang);
        $('#departemen').val(departemen);
        $('#divisi').val(divisi);

        $('#modal-karyawan').modal('hide');
      });
    });
  </script>
  <!-- / Script Jquery Data Karyawan -->

  <!-- Script Jquery Data Atasan -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih-atasan', function(){
        var atasan = $(this).data('nama_atasan');
        var level_atasan = $(this).data('level_atasan');

        $('#atasan').val(atasan);
        $('#level_atasan').val(level_atasan);

        $('#modal-atasan').modal('hide');
      });
    });
  </script>
  <!-- / Script Jquery Data Atasan -->