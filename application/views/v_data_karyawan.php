  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Karyawan
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Karyawan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Data</h3>

              <span style="margin-left: 82%">
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-tambah">
                  <i class="fa fa-plus"></i> Tambah Karyawan
                </button>
              </span>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Cabang</th>
                  <th>Divisi</th>
                  <th>Departemen</th>
                  <th>Section</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_karyawan as $row_karyawan){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_karyawan['nik'] ?></td>
                  <td><?php echo $row_karyawan['nama'] ?></td>
                  <td><?php echo $row_karyawan['cabang'] ?></td>
                  <td><?php echo $row_karyawan['divisi'] ?></td>
                  <td><?php echo $row_karyawan['departemen'] ?></td>
                  <td><?php echo $row_karyawan['section'] ?></td>
                  <td style="text-align: center;">

                    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit"
                      data-nik = "<?php echo $row_karyawan['nik'] ?>"
                      data-nama = "<?php echo $row_karyawan['nama'] ?>"
                      data-cabang = "<?php echo $row_karyawan['cabang'] ?>"
                      data-divisi = "<?php echo $row_karyawan['divisi'] ?>"
                      data-departemen = "<?php echo $row_karyawan['departemen'] ?>"
                      id="pilih_edit"
                    >
                      <i class="fa fa-edit"></i> Edit
                    </button>

                    <a href="<?php echo base_url().'data_karyawan/hapus/'.$row_karyawan['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-trash"></i> Hapus
                    </a>

                  </td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Tambah -->
  <form action="<?php echo base_url().'data_karyawan/simpan' ?>" method="post">
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Input Data Karyawan</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="nik"></span> NIK :</label>
            <input type="text" name="nik" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="nama"></span> Nama :</label>
            <input type="text" name="nama" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="cabang"></span> Cabang :</label>
            <select class="form-control" name="cabang">
              <?php foreach($data_cabang as $row_cabang){ ?>
              <option value="<?php echo $row_cabang['nama_cabang'] ?>">
                <?php echo $row_cabang['kode_cabang'] ?> - <?php echo $row_cabang['nama_cabang'] ?>
              </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="divisi"></span> Divisi :</label>
            <input type="text" name="divisi" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="departemen"></span> Departemen :</label>
            <select class="form-control" name="departemen">
              <?php foreach($data_departemen as $row_departemen){ ?>
              <option value="<?php echo $row_departemen['nama_departemen'] ?>">
                <?php echo $row_departemen['kode_departemen'] ?> - <?php echo $row_departemen['nama_departemen'] ?>
              </option>
              <?php } ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Data</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Tambah -->


  <!-- Modal Edit -->
  <form action="<?php echo base_url().'data_karyawan/update' ?>" method="post">
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Data Karyawan</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="nik"></span> NIK :</label>
            <input type="text" name="nik" class="form-control" autocomplete="off" id="nik" required>
          </div>

          <div class="form-group">
            <label for="nama"></span> Nama :</label>
            <input type="text" name="nama" class="form-control" autocomplete="off" id="nama" required>
          </div>

         <div class="form-group">
            <label for="cabang"></span> Cabang :</label>
            <select class="form-control" name="cabang" id="cabang">
              <?php foreach($data_cabang as $row_cabang){ ?>
              <option value="<?php echo $row_cabang['nama_cabang'] ?>">
                <?php echo $row_cabang['kode_cabang'] ?> - <?php echo $row_cabang['nama_cabang'] ?>
              </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="divisi"></span> Divisi :</label>
            <input type="text" name="divisi" class="form-control" id="divisi" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="departemen"></span> Departemen :</label>
            <select class="form-control" name="departemen" id="departemen">
              <?php foreach($data_departemen as $row_departemen){ ?>
              <option value="<?php echo $row_departemen['nama_departemen'] ?>">
                <?php echo $row_departemen['kode_departemen'] ?> - <?php echo $row_departemen['nama_departemen'] ?>
              </option>
              <?php } ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Data</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Edit -->



  <!-- Script Jquery Edit -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih_edit', function(){

        var nik = $(this).data('nik');
        var nama = $(this).data('nama');
        var cabang = $(this).data('cabang');
        var divisi = $(this).data('divisi');
        var departemen = $(this).data('departemen');

        $('#nik').val(nik);
        $('#nama').val(nama);
        $('#cabang').val(cabang);
        $('#divisi').val(divisi);
        $('#departemen').val(departemen);
      });
    });
  </script>
  <!-- / Script Jquery Edit -->