  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Kendaraan Inventaris
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Kendaraan Inventaris</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Data</h3>

              <span style="margin-left: 82%">
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-tambah">
                  <i class="fa fa-plus"></i> Tambah Kendaraan
                </button>
              </span>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Nopol</th>
                  <th>Jenis Kendaraan</th>
                  <th>Merk Kendaraan</th>
                  <th>Kapasitas Silinder</th>
                  <th>Cabang</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_kendaraan as $row_kendaraan){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_kendaraan['nopol'] ?></td>
                  <td><?php echo $row_kendaraan['jenis_kendaraan'] ?></td>
                  <td><?php echo $row_kendaraan['merk_kendaraan'] ?></td>
                  <td><?php echo $row_kendaraan['kapasitas_silinder'] ?></td>
                  <td><?php echo $row_kendaraan['cabang'] ?></td>
                  <td style="text-align: center;">

                    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit"
                      data-id = "<?php echo $row_kendaraan['id'] ?>"
                      data-nopol = "<?php echo $row_kendaraan['nopol'] ?>"
                      data-jenis_kendaraan = "<?php echo $row_kendaraan['jenis_kendaraan'] ?>"
                      data-merk_kendaraan = "<?php echo $row_kendaraan['merk_kendaraan'] ?>"
                      data-kapasitas_silinder = "<?php echo $row_kendaraan['kapasitas_silinder'] ?>"
                      data-cabang = "<?php echo $row_kendaraan['cabang'] ?>"
                      id="pilih_edit"
                    >
                      <i class="fa fa-edit"></i> Edit
                    </button>

                    <a href="<?php echo base_url().'data_kendaraan/hapus/'.$row_kendaraan['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
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
  <form action="<?php echo base_url().'data_kendaraan/simpan' ?>" method="post">
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Input Data Kendaraan</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="nopol"></span> Nopol :</label>
            <input type="text" name="nopol" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="jenis_kendaraan"></span> Jenis Kendaraan :</label>
            <select name="jenis_kendaraan" class="form-control">
              <option value="Mobil">Mobil</option>
              <option value="Motor">Motor</option>
            </select>
          </div>

          <div class="form-group">
            <label for="merk_kendaraan"></span> Merk Kendaraan :</label>
            <input type="text" name="merk_kendaraan" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="kapasitas_silinder"></span> Kapasitas Silinder :</label>
            <input type="text" name="kapasitas_silinder" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="cabang"></span> Cabang :</label>
            <input type="text" name="cabang" class="form-control" autocomplete="off" required>
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
  <form action="<?php echo base_url().'data_kendaraan/update' ?>" method="post">
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Data Kendaraan</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="id" id="id" autocomplete="off" hidden>

          <div class="form-group">
            <label for="nopol"></span> Nopol :</label>
            <input type="text" name="nopol" class="form-control" id="nopol" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="jenis_kendaraan"></span> Jenis Kendaraan :</label>
            <select name="jenis_kendaraan" class="form-control" id="jenis_kendaraan">
              <option value="Mobil">Mobil</option>
              <option value="Motor">Motor</option>
            </select>
          </div>

          <div class="form-group">
            <label for="merk_kendaraan"></span> Merk Kendaraan :</label>
            <input type="text" name="merk_kendaraan" id="merk_kendaraan" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="kapasitas_silinder"></span> Kapasitas Silinder :</label>
            <input type="text" name="kapasitas_silinder" id="kapasitas_silinder" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="cabang"></span> Cabang :</label>
            <input type="text" name="cabang" id="cabang" class="form-control" autocomplete="off" required>
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
        var nopol = $(this).data('nopol');
        var jenis_kendaraan = $(this).data('jenis_kendaraan');
        var merk_kendaraan = $(this).data('merk_kendaraan');
        var kapasitas_silinder = $(this).data('kapasitas_silinder');
        var cabang = $(this).data('cabang');

        $('#id').val(id);
        $('#nopol').val(nopol);
        $('#jenis_kendaraan').val(jenis_kendaraan);
        $('#merk_kendaraan').val(merk_kendaraan);
        $('#kapasitas_silinder').val(kapasitas_silinder);
        $('#cabang').val(cabang);
      });
    });
  </script>
  <!-- / Script Jquery Edit -->