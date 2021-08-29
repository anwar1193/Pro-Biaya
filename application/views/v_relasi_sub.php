  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting Relasi Sub Biaya
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Relasi Sub Biaya</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Data</h3>

              <span style="margin-left: 82%">
                <a class="btn btn-info btn-xs" href="<?php echo base_url().'relasi_sub/tambah' ?>">
                  <i class="fa fa-plus"></i> Tambah Relasi Sub Biaya
                </a>
              </span>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Departemen</th>
                  <th>Sub Biaya</th>
                  <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_relasi_sub as $row_relasi_sub){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_relasi_sub['departemen'] ?></td>
                  <td><?php echo $row_relasi_sub['sub_biaya'] ?></td>
                  <td style="text-align: center;">

                    <a href="<?php echo base_url().'relasi_biaya/edit/'.$row_relasi_sub['id'] ?>" class="btn btn-success btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-trash"></i> Edit
                    </a>

                    <a href="<?php echo base_url().'relasi_biaya/hapus/'.$row_relasi_sub['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
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