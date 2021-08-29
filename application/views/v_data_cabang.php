  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Cabang
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Cabang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Data</h3>

              <span style="margin-left: 82%">
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-tambah">
                  <i class="fa fa-plus"></i> Tambah Cabang
                </button>
              </span>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Kode Cabang</th>
                  <th>Nama Cabang</th>
                  <th>Nomor Telepon</th>
                  <th>Alamat</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_cabang as $row_cabang){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_cabang['kode_cabang'] ?></td>
                  <td><?php echo $row_cabang['nama_cabang'] ?></td>
                  <td><?php echo $row_cabang['no_telepon'] ?></td>
                  <td><?php echo $row_cabang['alamat'] ?></td>
                  <td style="text-align: center;">

                    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit"
                      data-kode_cabang = "<?php echo $row_cabang['kode_cabang'] ?>"
                      data-nama_cabang = "<?php echo $row_cabang['nama_cabang'] ?>"
                      data-no_telepon = "<?php echo $row_cabang['no_telepon'] ?>"
                      data-alamat = "<?php echo $row_cabang['alamat'] ?>"
                      id="pilih_edit"
                    >
                      <i class="fa fa-edit"></i> Edit
                    </button>

                    <a href="<?php echo base_url().'data_cabang/hapus/'.$row_cabang['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
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
  <form action="<?php echo base_url().'data_cabang/simpan' ?>" method="post">
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Input Data Cabang</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="kode_cabang"></span> Kode Cabang :</label>
            <input type="text" name="kode_cabang" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="nama_cabang"></span> Nama Cabang :</label>
            <input type="text" name="nama_cabang" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="no_telepon"></span> Nomor Telepon :</label>
            <input type="text" name="no_telepon" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="alamat"></span> Alamat :</label>
            <textarea class="form-control" name="alamat"></textarea>
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
  <form action="<?php echo base_url().'data_cabang/update' ?>" method="post">
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Data Cabang</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="kode_cabang"></span> Kode Cabang :</label>
            <input type="text" name="kode_cabang" class="form-control" autocomplete="off" id="kode_cabang" required>
          </div>

          <div class="form-group">
            <label for="nama_cabang"></span> Nama Cabang :</label>
            <input type="text" name="nama_cabang" class="form-control" autocomplete="off" id="nama_cabang" required>
          </div>

          <div class="form-group">
            <label for="no_telepon"></span> Nomor Telepon :</label>
            <input type="text" name="no_telepon" class="form-control" autocomplete="off" id="no_telepon" required>
          </div>

          <div class="form-group">
            <label for="alamat"></span> Alamat :</label>
            <textarea class="form-control" name="alamat" id="alamat"></textarea>
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
  <!-- / Modal Tambah -->



  <!-- Script Jquery Edit -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih_edit', function(){

        var kode_cabang = $(this).data('kode_cabang');
        var nama_cabang = $(this).data('nama_cabang');
        var no_telepon = $(this).data('no_telepon');
        var alamat = $(this).data('alamat');

        $('#kode_cabang').val(kode_cabang);
        $('#nama_cabang').val(nama_cabang);
        $('#no_telepon').val(no_telepon);
        $('#alamat').val(alamat);
      });
    });
  </script>
  <!-- / Script Jquery Edit -->