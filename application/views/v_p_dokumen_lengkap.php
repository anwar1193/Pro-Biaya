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
        Data Pengajuan Dokumen Lengkap
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pengajuan Dokumen Lengkap</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pengajuan (Dokumen Lengkap)</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>NO Pengajuan</th>
                  <th>Jenis Biaya</th>
                  <th>Sub Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th style="text-align: center;">Status</th>
                  <th style="text-align: center;" width="10%">Status Dokumen</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_lendok as $row_lendok){
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_lendok['tanggal'])) ?></td>
                  <td><?php echo $row_lendok['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_lendok['jenis_biaya'] ?></td>
                  <td><?php echo $row_lendok['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_lendok['jumlah'] + $row_lendok['ppn'] - $row_lendok['pph23'] - $row_lendok['pph42'] - $row_lendok['pph21'],0,',','.') ?></td>
                  
                  <td style="color: green; font-weight: bold">
                    <?php echo '- '.$row_lendok['status_approve'].' by '.$row_lendok['approved_by'].' -'.'<br>'.$row_lendok['nama_pengapprove'] ?>
                  </td>

                  <?php if($row_lendok['status_dokumen']==''){ ?>
                    <td style="color: orange; font-weight: bold" width="10%">
                      Pending
                    </td>

                  <?php }elseif($row_lendok['status_dokumen']=='done'){ ?>
                    <td style="color: green; font-weight: bold" width="10%">Diterima oleh <?php echo $row_lendok['dept_tujuan'] ?></td>

                  <?php }elseif($row_lendok['status_dokumen']=='done acc'){ ?>
                    <td style="color: green; font-weight: bold" width="10%">Diterima oleh Accounting</td>
                  <?php } ?>
                  
                  <td style="text-align: center;">

                    <a href="<?php echo base_url().'p_dokumen_lengkap/detail/'.$row_lendok['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
                      <i class="fa fa-eye"></i> Detail
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