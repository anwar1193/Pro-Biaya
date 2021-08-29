  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Jenis Biaya
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Jenis Biaya</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Data</h3>

              <span style="margin-left: 82%">
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-tambah">
                  <i class="fa fa-plus"></i> Tambah Jenis Biaya
                </button>
              </span>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Kode Biaya</th>
                  <th>Jenis Biaya (Akun)</th>
                  <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_jenis_biaya as $row_jenis_biaya){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_jenis_biaya['kode_jb'] ?></td>
                  <td><?php echo $row_jenis_biaya['jenis_biaya'] ?></td>
                  <td style="text-align: center;">

                    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit"
                      data-kode_jb = "<?php echo $row_jenis_biaya['kode_jb'] ?>"
                      data-jenis_biaya = "<?php echo $row_jenis_biaya['jenis_biaya'] ?>"
                      id="pilih_edit"
                    >
                      <i class="fa fa-edit"></i> Edit
                    </button>

                    <a href="<?php echo base_url().'data_jenis_biaya/hapus/'.$row_jenis_biaya['id_jb'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
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
  <form action="<?php echo base_url().'data_jenis_biaya/simpan' ?>" method="post">
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Input Jenis Biaya</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="kode_jb"></span> Kode Biaya :</label>
            <input type="text" name="kode_jb" class="form-control" value="<?php echo $id_otomatis; ?>" autocomplete="off" readonly>
          </div>

          <div class="form-group">
            <label for="jenis_biaya"></span> Jenis Biaya :</label>
            <input type="text" name="jenis_biaya" class="form-control" autocomplete="off" required>
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
  <form action="<?php echo base_url().'data_jenis_biaya/update' ?>" method="post">
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Jenis Biaya</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="kode_jb"></span> Kode Biaya :</label>
            <input type="text" name="kode_jb" id="kode_jb" class="form-control" autocomplete="off" readonly>
          </div>

          <div class="form-group">
            <label for="jenis_biaya"></span> Jenis Biaya :</label>
            <input type="text" name="jenis_biaya" class="form-control" id="jenis_biaya" autocomplete="off" required>
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

        var kode_jb = $(this).data('kode_jb');
        var jenis_biaya = $(this).data('jenis_biaya');

        $('#jenis_biaya').val(jenis_biaya);
        $('#kode_jb').val(kode_jb);
      });
    });
  </script>
  <!-- / Script Jquery Edit -->