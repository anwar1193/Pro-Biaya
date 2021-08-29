  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Level
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Level</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Data</h3>

              <span style="margin-left: 82%">
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-tambah">
                  <i class="fa fa-plus"></i> Tambah Level
                </button>
              </span>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Level</th>
                  <th>Min Approve</th>
                  <th>Max Approve</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_level as $row_level){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_level['level'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_level['min_approve'],0,'.',',') ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_level['max_approve'],0,'.',',') ?></td>
                  <td style="text-align: center;">

                    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit"
                      data-id = "<?php echo $row_level['id'] ?>"
                      data-level = "<?php echo $row_level['level'] ?>"
                      data-min_approve = "<?php echo $row_level['min_approve'] ?>"
                      data-max_approve = "<?php echo $row_level['max_approve'] ?>"
                      id="pilih_edit"
                    >
                      <i class="fa fa-edit"></i> Edit
                    </button>

                    <a href="<?php echo base_url().'data_level/hapus/'.$row_level['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
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
  <form action="<?php echo base_url().'data_level/simpan' ?>" method="post">
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Input Data Level</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="level"></span> Level :</label>
            <input type="text" name="level" class="form-control" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="min_approve"></span> Min Approve :</label>
            <input type="number" name="min_approve" class="form-control" autocomplete="off" required placeholder="Rp">
          </div>

          <div class="form-group">
            <label for="max_approve"></span> Max Approve :</label>
            <input type="text" name="max_approve" class="form-control" autocomplete="off" required placeholder="Rp">
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
  <form action="<?php echo base_url().'data_level/update' ?>" method="post">
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Data Level</h4>
        </div>
        <div class="modal-body">

          <input type="text" id="id" name="id" hidden>

          <div class="form-group">
            <label for="level"></span> Level :</label>
            <input type="text" name="level" class="form-control" autocomplete="off" id="level" required>
          </div>

          <div class="form-group">
            <label for="min_approve"></span> Min Approve :</label>
            <input type="text" name="min_approve" class="form-control" autocomplete="off" id="min_approve" required>
          </div>

          <div class="form-group">
            <label for="max_approve"></span> Max Approve :</label>
            <input type="text" name="max_approve" class="form-control" autocomplete="off" id="max_approve" required>
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
        var level = $(this).data('level');
        var min_approve = $(this).data('min_approve');
        var max_approve = $(this).data('max_approve');

        $('#id').val(id);
        $('#level').val(level);
        $('#min_approve').val(min_approve);
        $('#max_approve').val(max_approve);
      });
    });
  </script>
  <!-- / Script Jquery Edit -->