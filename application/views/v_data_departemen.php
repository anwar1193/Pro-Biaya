  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Departemen
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Departemen</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Data</h3>

              <span style="margin-left: 82%">
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-tambah">
                  <i class="fa fa-plus"></i> Tambah Departemen
                </button>
              </span>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Kode Departemen</th>
                  <th>Nama Departemen</th>
                  <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_departemen as $row_departemen){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_departemen['kode_departemen'] ?></td>
                  <td><?php echo $row_departemen['nama_departemen'] ?></td>
                  <td style="text-align: center;">

                    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit"
                      data-kode_departemen = "<?php echo $row_departemen['kode_departemen'] ?>"
                      data-nama_departemen = "<?php echo $row_departemen['nama_departemen'] ?>"
                      id="pilih_edit"
                    >
                      <i class="fa fa-edit"></i> Edit
                    </button>

                    <a href="<?php echo base_url().'data_departemen/hapus/'.$row_departemen['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
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
  <form action="<?php echo base_url().'data_departemen/simpan' ?>" method="post">
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Input Data Departemen</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="kode_departemen"></span> Kode Departemen :</label>
            <input type="text" name="kode_departemen" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="nama_departemen"></span> Nama Departemen :</label>
            <input type="text" name="nama_departemen" class="form-control" autocomplete="off" required>
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
  <form action="<?php echo base_url().'data_departemen/update' ?>" method="post">
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Data Departemen</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="kode_departemen"></span> Kode Departemen :</label>
            <input type="text" name="kode_departemen" class="form-control" autocomplete="off" id="kode_departemen" readonly>
          </div>

          <div class="form-group">
            <label for="nama_departemen"></span> Nama Departemen :</label>
            <input type="text" name="nama_departemen" class="form-control" autocomplete="off" id="nama_departemen" required>
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

        var kode_departemen = $(this).data('kode_departemen');
        var nama_departemen = $(this).data('nama_departemen');

        $('#kode_departemen').val(kode_departemen);
        $('#nama_departemen').val(nama_departemen);
      });
    });
  </script>
  <!-- / Script Jquery Edit -->