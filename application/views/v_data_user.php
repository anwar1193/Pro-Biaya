  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Ambil Data Flashdata untuk kata sweet alert -->
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data User
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Data</h3>

              <span style="margin-left: 82%">
                <a href="<?php echo base_url().'data_user/tambah' ?>" class="btn btn-info btn-xs">
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
                  <th>Level</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Cabang</th>
                  <th>Dept</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Atasan</th>
                  <th width="10%">Last Login</th>
                  <th width="10%">Last Clearlog</th>
                  <th width="10%">Clearlog IP</th>
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
                  <td><?php echo $row_user['level'] ?></td>
                  <td><?php echo $row_user['nik'] ?></td>
                  <td><?php echo $row_user['nama_lengkap'] ?></td>
                  <td><?php echo $row_user['cabang'] ?></td>
                  <td><?php echo $row_user['departemen'] ?></td>
                  <td><?php echo $row_user['email'] ?></td>
                  <td><?php echo $row_user['username'] ?></td>
                  <td><?php echo $row_user['atasan'] ?></td>

                  <td>
                    <?php echo $row_user['last_login'] ?><br>

                    <a class="btn btn-warning btn-xs" href="<?php echo base_url().'data_user/log_login/'.$row_user['id'] ?>" onclick="window.open(&apos;&apos;, &apos;popupwindow&apos;, &apos;scrollbars=yes, width=900, height=500&apos;);return true" target="popupwindow">
                        <i class="fa fa-eye"></i> Log Login
                    </a>
                  </td>

                  <td>
                    <?php echo $row_user['clearlog_waktu'] ?>

                    <?php if($row_user['clearlog_waktu'] != ''){ ?>
                      <a class="btn btn-info btn-xs" href="<?php echo base_url().'data_user/history_clearlog/'.$row_user['id'] ?>" onclick="window.open(&apos;&apos;, &apos;popupwindow&apos;, &apos;scrollbars=yes, width=900, height=500&apos;);return true" target="popupwindow">
                        <i class="fa fa-eye"></i> History
                      </a>
                    <?php } ?>

                  </td>

                  <td><?php echo $row_user['clearlog_ip'].'<br>('.$row_user['clearlog_browser'].')' ?></td>
                  <td style="text-align: center;">

                    <a href="<?php echo base_url().'data_user/edit/'.$row_user['id'] ?>" class="btn btn-success btn-xs">
                      <i class="fa fa-edit"></i> Edit
                    </a>

                    <a href="<?php echo base_url().'data_user/hapus/'.$row_user['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
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