  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data COA
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data COA</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Data</h3>

              <!-- <span style="margin-left: 82%">
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-tambah">
                  <i class="fa fa-plus"></i> Tambah Bank
                </button>
              </span> -->

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Departemen Asal</th>
                  <th>Jenis Biaya</th>
                  <th>Sub Biaya</th>
                  <th>Departemen Tujuan</th>
                  <th>COA</th>
                  <th>Nama COA</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_coa as $row_coa){
                      $id_jb = $row_coa['id_jb'];
                      $data_jb = $this->M_master->tampil_data_where('tbl_jenis_biaya', array('id_jb' => $id_jb))->row_array();
                      $jenis_biaya = $data_jb['jenis_biaya'];
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_coa['departemen'] ?></td>
                  <td><?php echo $jenis_biaya ?></td>
                  <td><?php echo $row_coa['sub_biaya'] ?></td>
                  <td><?php echo $row_coa['departemen_tujuan'] ?></td>
                  <td><?php echo $row_coa['coa'] ?></td>
                  <td><?php echo $row_coa['nama_coa'] ?></td>
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