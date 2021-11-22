  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Sparepart Kendaraan
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Sparepart Kendaraan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Data</h3>

              <span style="display: block; position: absolute; top:10px; right: 10px;">
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-tambah">
                  <i class="fa fa-plus"></i> Tambah Sparepart
                </button>
              </span>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Nama Sparepart</th>
                  <th>Keterangan Sparepart</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_sparepart as $row_sparepart){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_sparepart['nama_sparepart'] ?></td>
                  <td><?php echo $row_sparepart['keterangan'] ?></td>
                  <td style="text-align: center;">

                    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit"
                      data-id = "<?php echo $row_sparepart['id'] ?>"
                      data-nama_sparepart = "<?php echo $row_sparepart['nama_sparepart'] ?>"
                      data-keterangan = "<?php echo $row_sparepart['keterangan'] ?>"
                      id="pilih_edit"
                    >
                      <i class="fa fa-edit"></i> Edit
                    </button>

                    <a href="<?php echo base_url().'data_sparepart/hapus/'.$row_sparepart['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
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
  <form action="<?php echo base_url().'data_sparepart/simpan' ?>" method="post">
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Input Data Sparepart</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="nama_sparepart"></span> Nama Sparepart :</label>
            <input type="text" name="nama_sparepart" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="keterangan"></span> Keterangan :</label>
            <textarea name="keterangan" class="form-control"></textarea>
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
  <form action="<?php echo base_url().'data_sparepart/update' ?>" method="post">
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Data Sparepart</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="id" id="id" autocomplete="off" hidden>

          <div class="form-group">
            <label for="nama_sparepart"></span> Nama Sparepart :</label>
            <input type="text" name="nama_sparepart" id="nama_sparepart" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="keterangan"></span> Keterangan :</label>
            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
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

        var id = $(this).data('id');
        var nama_sparepart = $(this).data('nama_sparepart');
        var keterangan = $(this).data('keterangan');

        $('#id').val(id);
        $('#nama_sparepart').val(nama_sparepart);
        $('#keterangan').val(keterangan);
      });
    });
  </script>
  <!-- / Script Jquery Edit -->