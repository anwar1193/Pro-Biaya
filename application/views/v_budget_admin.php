  <?php  

    $nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
    $cabang = $this->libraryku->tampil_user()->cabang;
    $departemen = $this->libraryku->tampil_user()->departemen;
    $level = $this->libraryku->tampil_user()->level;

  ?>
  <?php date_default_timezone_set("Asia/Jakarta"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Ambil Data Flashdata untuk kata sweet alert -->
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Budget (All Cabang/Dept)
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Budget</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Budget</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="tableDT" class="table table-bordered table-striped">
                <thead style="background-color: orange">
                <tr>
                  <th>NO</th>
                  <th>Cabang</th>
                  <th>Departemen</th>
                  <th style="text-align: center;">Action</th>
                </tr>

                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_budget as $row_budget){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_budget['cabang'] ?></td>
                  <td><?php echo $row_budget['departemen'] ?></td>
                  <td style="text-align: center;">
                    <a href="<?php echo base_url().'budget_admin/detail/'.$row_budget['cabang'].'/'.$row_budget['departemen'] ?>" class="btn btn-info btn-sm">
                      <i class="fa fa-money"></i> Lihat Budget
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

  <!-- Panggil File JS SweetAlert -->
  <script src="<?php echo base_url().'asset/sweetAlert/sweetalert2.all.min.js' ?>"></script>

  <!-- script sweet alert -->
  <script type="text/javascript">
    // Jika Berhasil Melakukan Aksi (Simpan, Edit, Hapus)
    var flashData = $('.flash-data').data('flashdata');
    if(flashData){
      Swal.fire({
        icon: 'success', //Icon : success, error, warning, info, question
        title: 'Berhasil',
        text: flashData
        // footer: 'Data Mahasiswa Tersimpan Ke Database'
      });
    }
  </script>