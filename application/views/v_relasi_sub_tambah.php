
  <?php  

    // Fungsi tanggal / zona waktu biar gak error
    date_default_timezone_set("Asia/Jakarta");

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Relasi Sub Biaya
        <small>Input Relasi Sub Biaya </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Input Relasi Sub Biaya</li>
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

              <h3>Input Data Relasi Sub Biaya</h3>
              <hr style="border-width: 4px;">
              <form method="post" action="<?php echo base_url().'relasi_sub/simpan' ?>">

                <div class="form-group">
                  <label for="departemen">Departemen</label>
                  <select class="form-control" name="departemen">
                    <?php foreach($data_departemen as $row_departemen){ ?>
                    <option value="<?php echo $row_departemen['nama_departemen'] ?>"><?php echo $row_departemen['nama_departemen'] ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div>
                  <label for="sub_biaya">Sub Biaya *</label>
                </div>
                <div class="form-group input-group">
                  <input type="text" name="sub_biaya" id="sub_biaya" class="form-control" required autofocus>
                  <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#modal-sub">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>

                <input type="text" id="id_sb" name="id_sb">
                <input type="text" id="id_jb" name="id_jb">
                <input type="text" id="departemen_tujuan" name="departemen_tujuan">
                <input type="text" id="form" name="form">
                <input type="text" id="cek_fisik" name="cek_fisik">
                <input type="text" id="kode_cashflow" name="kode_cashflow">

                <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan Data</button>
                <a href="<?php echo base_url().'relasi_sub' ?>" class="btn btn-danger btn-sm"><i class="fa fa-backward"></i> Kembali</a>

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


  <!-- Modal Sub Biaya -->
  <div class="modal fade" id="modal-sub">
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
                <th>Sub Biaya</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($data_sub_biaya as $data) : ?>
              <tr>
                <td><?php echo $data['id_jb'] ?></td>
                <td><?php echo $data['kode_jb'] ?></td>
                <td><?php echo $data['jenis_biaya'] ?></td>
                <td><?php echo $data['sub_biaya'] ?></td>
                <td>
                  <button class="btn btn-info btn-xs" id="pilih" type="button"
                    data-id_sb="<?php echo $data['id_sb'] ?>"
                    data-id_jb="<?php echo $data['id_jb'] ?>"
                    data-sub_biaya="<?php echo $data['sub_biaya'] ?>"
                    data-departemen_tujuan="<?php echo $data['departemen_tujuan'] ?>"
                    data-form="<?php echo $data['form'] ?>"
                    data-cek_fisik="<?php echo $data['cek_fisik'] ?>"
                    data-kode_cashflow="<?php echo $data['kode_cashflow'] ?>"
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
  <!-- / Modal Sub -->


  <!-- Script Jquery Data Karyawan -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih', function(){
        var id_sb = $(this).data('id_sb');
        var id_jb = $(this).data('id_jb');
        var sub_biaya = $(this).data('sub_biaya');
        var departemen_tujuan = $(this).data('departemen_tujuan');
        var form = $(this).data('form');
        var cek_fisik = $(this).data('cek_fisik');
        var kode_cashflow = $(this).data('kode_cashflow');

        $('#id_sb').val(id_sb);
        $('#id_jb').val(id_jb);
        $('#sub_biaya').val(sub_biaya);
        $('#departemen_tujuan').val(departemen_tujuan);
        $('#form').val(form);
        $('#cek_fisik').val(cek_fisik);
        $('#kode_cashflow').val(kode_cashflow);

        $('#modal-sub').modal('hide');
      });
    });
  </script>
  <!-- / Script Jquery Data Karyawan -->