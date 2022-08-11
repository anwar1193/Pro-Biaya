  <?php  

    $nama_lengkap = $this->libraryku->tampil_user()->nama_lengkap;
    $cabang = $this->libraryku->tampil_user()->cabang;
    $departemen = $this->libraryku->tampil_user()->departemen;
    $level = $this->libraryku->tampil_user()->level;

  ?>
  <?php date_default_timezone_set("Asia/Jakarta"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pengajuan Disetujui (Approved)
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pengajuan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Proses Review - Finance</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>NO Pengajuan</th>
                  <th>Cabang</th>
                  <th>Dept</th>
                  <th>Jenis Biaya</th>
                  <th>Sub Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th style="text-align: center;" width="10%">Status Check</th>
                  <th style="text-align: center;" width="10%">Status Bayar</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_approved as $row_approved){
                    // Yang tampil di view, field departemen update
                    $bagian = $row_approved['bagian'];
                    $data_departemen = $this->M_master->tampil_data_where('tbl_departemen', array('nama_departemen' => $bagian))->row_array();
                    $nama_departemen_update = $data_departemen['nama_departemen_update'];
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_approved['tanggal'])) ?></td>
                  <td><?php echo $row_approved['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_approved['cabang'] ?></td>
                  <td><?php echo $nama_departemen_update ?></td>
                  <td><?php echo $row_approved['jenis_biaya'] ?></td>
                  <td><?php echo $row_approved['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_approved['jumlah'] + $row_approved['ppn'] - $row_approved['pph23'] - $row_approved['pph42'] - $row_approved['pph21'],0,',','.') ?></td>
                  
                  <!-- td status check -->
                  <?php if($row_approved['status_check'] == ''){ ?>
                    <td style="color: blue; font-weight: bold">
                      : On Proccess :
                    </td>
                  <?php }else if($row_approved['status_check'] == 'Checked'){ ?>
                    <td style="color: green; font-weight: bold">
                      <?php echo '- '.$row_approved['status_check'].' by '.$row_approved['checked_by'].' -'; ?>
                    </td>
                  <?php }else if($row_approved['status_check'] == 'Pending'){ ?>
                    <td style="color: orange; font-weight: bold">
                      <?php echo '- '.$row_approved['status_check'].' by '.$row_approved['checked_by'].' -'; ?>
                    </td>
                  <?php } ?>

                  <!-- Kolom Status Bayar -->
                  <?php if($row_approved['status_check'] == 'Checked'){ ?>

                    <?php if($row_approved['status_bayar'] == 'Telah Dibayar' || $row_approved['status_bayar'] == 'Proses Bayar'){ ?>
                      <td style="color: green; font-weight: bold">
                        <?php echo $row_approved['status_bayar'] ?>
                      </td>
                    <?php }else{ ?>
                      <td style="color: blue; font-weight: bold">
                        Proses Check
                      </td>
                    <?php } ?>

                  <?php }else{ ?>
                    <td style="color: blue; font-weight: bold">
                      -
                    </td>
                  <?php } ?>
                  <!-- / Kolom Status Bayar -->
                  
                  <!-- td action -->
                  <td style="text-align: center;">

                    <!-- <a href="<?php echo base_url().'p_approved/hapus/'.$row_approved['id_pengajuan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-trash"></i> Hapus
                    </a> -->

                    <a href="<?php echo base_url().'p_approved/detail_3/'.$row_approved['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
                      <i class="fa fa-eye"></i> Detail
                    </a>

                    <?php if($row_approved['status_check']=='Pending'){ ?>
                    <a href="<?php echo base_url().'p_approved/edit/'.$row_approved['id_pengajuan'] ?>" class="btn btn-info btn-xs">
                      <i class="fa fa-edit"></i> Perbaiki
                    </a>
                    <?php } ?>

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