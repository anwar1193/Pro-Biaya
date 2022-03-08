  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Ambil Data Flashdata untuk kata sweet alert -->
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data User Alternate
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data User Alternate</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Data</h3>

              <span style="display:block; position:absolute; right:10px; top:10px">
                <a href="<?php echo base_url().'data_user_alternate/tambah' ?>" class="btn btn-info btn-xs">
                  <i class="fa fa-plus"></i> Tambah User
                </a>
              </span>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Username</th>
                  <th>Alternate To</th>
                  <th>Level</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Cabang</th>
                  <th>Dept</th>
                  <th>Status User</th>
                  <th style="text-align: center" width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_user as $row_user){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_user['username'] ?></td>

                  <td>
                    <span style="background-color:orange; color:white; padding:2px; border-radius:5px">
                      <?php echo $row_user['alternate_untuk'] ?>
                    </span>
                  </td>

                  <td><?php echo $row_user['level'] ?></td>
                  <td><?php echo $row_user['nik'] ?></td>
                  <td><?php echo $row_user['nama_lengkap'] ?></td>
                  <td><?php echo $row_user['cabang'] ?></td>
                  <td><?php echo $row_user['departemen'] ?></td>
                  <td class="text-center">
                    <?php if($row_user['status_user'] == 'aktif'){ ?>
                        <span style="background-color:green; color:white; padding:2px; border-radius:5px">
                            <?php echo $row_user['status_user'] ?>
                        </span> <br>

                        <a href="<?php echo base_url().'data_user_alternate/nonaktifkan_user/'.$row_user['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin untuk menonaktifkan user ini?')">
                            <i class="fa fa-minus-square"></i> Nonaktifkan User
                        </a>
                    <?php }else{ ?>
                        <span style="background-color:red; color:white; padding:2px; border-radius:5px">
                            <?php echo $row_user['status_user'] ?>
                        </span> <br>

                        <a href="<?php echo base_url().'data_user_alternate/aktifkan_user/'.$row_user['id'] ?>" class="btn btn-success btn-xs" onclick="return confirm('Apakah anda yakin untuk mengaktifkan user ini?')">
                            <i class="fa fa-check-circle"></i> Aktifkan User
                        </a>
                    <?php } ?>
                  </td>

                  
                  <td style="text-align: center;">

                    <a href="<?php echo base_url().'data_user_alternate/edit/'.$row_user['id'] ?>" class="btn btn-success btn-xs">
                      <i class="fa fa-edit"></i> Edit
                    </a>

                    <a href="<?php echo base_url().'data_user_alternate/hapus/'.$row_user['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
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