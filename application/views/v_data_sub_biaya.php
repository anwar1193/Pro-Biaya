  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Sub Biaya
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Sub Biaya</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Data</h3>

              <span style="margin-left: 82%">
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-tambah">
                  <i class="fa fa-plus"></i> Tambah Sub Biaya
                </button>
              </span>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Jenis Biaya (Akun)</th>
                  <th>Sub Biaya</th>
                  <th>Departemen Tujuan</th>
                  <th>Form</th>
                  <th>Cek Fisik</th>
                  <th>Kode Cashflow</th>
                  <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_sub_biaya as $row_sub_biaya){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_sub_biaya['kode_jb'].'-('.$row_sub_biaya['jenis_biaya'].')' ?></td>
                  <td><?php echo $row_sub_biaya['sub_biaya'] ?></td>
                  <td><?php echo $row_sub_biaya['departemen_tujuan'] ?></td>
                  <td><?php echo $row_sub_biaya['form'] ?></td>
                  <td><?php echo $row_sub_biaya['cek_fisik'] ?></td>
                  <td><?php echo $row_sub_biaya['kode_cashflow'] ?></td>
                  <td style="text-align: center;">

                    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit"
                      data-id_sb = "<?php echo $row_sub_biaya['id_sb'] ?>"
                      data-id_jb = "<?php echo $row_sub_biaya['id_jb'] ?>"
                      data-jenis_biaya = "<?php echo $row_sub_biaya['jenis_biaya'] ?>"
                      data-sub_biaya = "<?php echo $row_sub_biaya['sub_biaya'] ?>"
                      data-departemen_tujuan = "<?php echo $row_sub_biaya['departemen_tujuan'] ?>"
                      data-form = "<?php echo $row_sub_biaya['form'] ?>"
                      data-cek_fisik = "<?php echo $row_sub_biaya['cek_fisik'] ?>"
                      data-kode_cashflow = "<?php echo $row_sub_biaya['kode_cashflow'] ?>"
                      id="pilih_edit"
                    >
                      <i class="fa fa-edit"></i> Edit
                    </button>

                    <a href="<?php echo base_url().'data_sub_biaya/hapus/'.$row_sub_biaya['id_sb'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
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
  <form action="<?php echo base_url().'data_sub_biaya/simpan' ?>" method="post">
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Input Sub Biaya</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="id_jb"></span> Jenis Biaya (Akun) :</label>
            <select class="form-control" name="id_jb">
              <?php foreach($data_jenis_biaya as $row_jenis_biaya){ ?>
                <option value="<?php echo $row_jenis_biaya['id_jb'] ?>">
                  <?php echo $row_jenis_biaya['kode_jb'].' ('.$row_jenis_biaya['jenis_biaya'].')' ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="sub_biaya"></span> Sub Biaya :</label>
            <input type="text" name="sub_biaya" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="departemen_tujuan"></span> Departemen Tujuan :</label>
            <select class="form-control" name="departemen_tujuan">
              <?php foreach($data_departemen as $row_departemen){ ?>
                <option value="<?php echo $row_departemen['nama_departemen'] ?>">
                  <?php echo $row_departemen['nama_departemen'] ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="form"></span> Form :</label>
            <select class="form-control" name="form">
              <option value="General">General</option>
              <option value="Perdin">Perdin</option>
              <option value="BBM">BBM</option>
            </select>
          </div>

          <div class="form-group">
            <label for="cek_fisik"></span> Cek Fisik :</label>
            <select class="form-control" name="cek_fisik">
              <option value="ya">Ya</option>
              <option value="tidak">Tidak</option>
            </select>
          </div>

          <div class="form-group">
            <label for="kode_cashflow"></span> Kode Cashflow :</label>
            <input type="text" name="kode_cashflow" class="form-control" autocomplete="off">
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
  <form action="<?php echo base_url().'data_sub_biaya/update' ?>" method="post">
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update sub Biaya</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="id_sb" id="id_sb" hidden>

          <div class="form-group">
            <label for="jenis_biaya"></span> Jenis Biaya :</label>
            <input type="text" name="jenis_biaya" id="jenis_biaya" class="form-control" autocomplete="off" readonly>
          </div>

          <div class="form-group">
            <label for="sub_biaya"></span> Sub Biaya :</label>
            <input type="text" name="sub_biaya" class="form-control" id="sub_biaya" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="departemen_tujuan"></span> Departemen Tujuan :</label>
            <select class="form-control" name="departemen_tujuan" id="departemen_tujuan">
              <?php foreach($data_departemen as $row_departemen){ ?>
                <option value="<?php echo $row_departemen['nama_departemen'] ?>">
                  <?php echo $row_departemen['nama_departemen'] ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="form"></span> Form :</label>
            <select class="form-control" name="form" id="form">
              <option value="General">General</option>
              <option value="Perdin">Perdin</option>
              <option value="BBM">BBM</option>
            </select>
          </div>

          <div class="form-group">
            <label for="cek_fisik"></span> Cek Fisik :</label>
            <select class="form-control" name="cek_fisik" id="cek_fisik">
              <option value="ya">Ya</option>
              <option value="tidak">Tidak</option>
            </select>
          </div>

          <div class="form-group">
            <label for="kode_cashflow"></span> Kode Cashflow :</label>
            <input type="text" name="kode_cashflow" id="kode_cashflow" class="form-control" autocomplete="off">
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

        var id_sb = $(this).data('id_sb');
        var jenis_biaya = $(this).data('jenis_biaya');
        var sub_biaya = $(this).data('sub_biaya');
        var departemen_tujuan = $(this).data('departemen_tujuan');
        var form = $(this).data('form');
        var cek_fisik = $(this).data('cek_fisik');
        var kode_cashflow = $(this).data('kode_cashflow');

        $('#id_sb').val(id_sb);
        $('#jenis_biaya').val(jenis_biaya);
        $('#sub_biaya').val(sub_biaya);
        $('#departemen_tujuan').val(departemen_tujuan);
        $('#form').val(form);
        $('#cek_fisik').val(cek_fisik);
        $('#kode_cashflow').val(kode_cashflow);

      });
    });
  </script>
  <!-- / Script Jquery Edit -->