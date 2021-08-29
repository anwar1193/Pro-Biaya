
  <?php  

    // Fungsi tanggal / zona waktu biar gak error
    date_default_timezone_set("Asia/Jakarta");

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Relasi Biaya
        <small>Input Relasi Biaya </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Input Relasi</li>
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

              <h3>Input Data Relasi Biaya</h3>
              <hr style="border-width: 4px;">
              <form method="post" action="<?php echo base_url().'relasi_biaya/simpan' ?>">

                <div class="form-group">
                  <label for="departemen">Departemen</label>
                  <select class="form-control" name="departemen">
                    <?php foreach($data_departemen as $row_departemen){ ?>
                    <option value="<?php echo $row_departemen['nama_departemen'] ?>"><?php echo $row_departemen['nama_departemen'] ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div>
                  <label for="kode_jb">Kode Biaya *</label>
                </div>
                <div class="form-group input-group">
                  <input type="text" name="kode_jb" id="kode_jb" class="form-control" required autofocus>
                  <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#modal-biaya">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>

                <input type="text" id="id_jb" name="id_jb" hidden>

                <div class="form-group">
                  <label for="jenis_biaya">Jenis Biaya <span style="color: red;">*</span></label>
                  <input type="text" name="jenis_biaya" id="jenis_biaya" class="form-control" readonly>
                </div>

                <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan Data</button>
                <a href="<?php echo base_url().'relasi_biaya' ?>" class="btn btn-danger btn-sm"><i class="fa fa-backward"></i> Kembali</a>

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


  <!-- Modal Data Biaya -->
  <div class="modal fade" id="modal-biaya">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Data Biaya</h4>
        </div>
        <div class="modal-body">
          
          <table class="table table-bordered" id="tableDT">
            <thead>
              <tr>
                <th>ID</th>
                <th>Kode Biaya</th>
                <th>Jenis Biaya</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($data_jenis_biaya as $data) : ?>
              <tr>
                <td><?php echo $data['id_jb'] ?></td>
                <td><?php echo $data['kode_jb'] ?></td>
                <td><?php echo $data['jenis_biaya'] ?></td>
                <td>
                  <button class="btn btn-info btn-xs" id="pilih" type="button"
                    data-id_jb="<?php echo $data['id_jb'] ?>"
                    data-kode_jb="<?php echo $data['kode_jb'] ?>"
                    data-jenis_biaya="<?php echo $data['jenis_biaya'] ?>"
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


  <!-- Script Jquery Data Karyawan -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih', function(){
        var id_jb = $(this).data('id_jb');
        var kode_jb = $(this).data('kode_jb');
        var jenis_biaya = $(this).data('jenis_biaya');

        $('#id_jb').val(id_jb);
        $('#kode_jb').val(kode_jb);
        $('#jenis_biaya').val(jenis_biaya);

        $('#modal-biaya').modal('hide');
      });
    });
  </script>
  <!-- / Script Jquery Data Karyawan -->