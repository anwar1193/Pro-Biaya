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
        Data Pengajuan Diperbaiki (Revisi)
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
              <h3 class="box-title">Pengajuan (Revisi)</h3>

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
                  <th style="text-align: center;">Ket Revisi</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_revisi as $row_revisi){

                    // Tampilkan Note Revisi
                    $no_pengajuan = $row_revisi['nomor_pengajuan'];
                    $data_approve = $this->db->query("SELECT * FROM tbl_approved_history WHERE nomor_pengajuan='$no_pengajuan' AND status_approve='revisi' ORDER BY id_history DESC LIMIT 0,1")->row_array();
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_revisi['tanggal'])) ?></td>
                  <td><?php echo $row_revisi['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_revisi['jenis_biaya'] ?></td>
                  <td><?php echo $row_revisi['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_revisi['jumlah'] + $row_revisi['ppn'] - $row_revisi['pph23'] - $row_revisi['pph42'] - $row_revisi['pph21'],0,',','.') ?></td>
                  
                  <td style="color: orange; font-weight: bold">
                    <?php echo '- '.$row_revisi['status_approve'].' by '.$row_revisi['approved_by'].' -'.'<br>'.$row_revisi['nama_pengapprove'] ?>
                  </td>
                  
                  <td style="font-weight: bold; font-style: italic;">"<?php echo $data_approve['note']; ?>"</td>
                  
                  <td style="text-align: center;">

                    <!-- <a href="<?php echo base_url().'p_revisi/hapus/'.$row_revisi['id_pengajuan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-trash"></i> Hapus
                    </a> -->

                    <a href="<?php echo base_url().'p_revisi/detail/'.$row_revisi['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
                      <i class="fa fa-eye"></i> Detail
                    </a>

                    <!-- Hilangkan Perbaiki dari user Head -->
                    <?php if($level!='Department Head'){ ?>
                    <a href="<?php echo base_url().'p_revisi/edit/'.$row_revisi['id_pengajuan'] ?>" class="btn btn-info btn-xs">
                      <i class="fa fa-edit"></i> Revisi Pengajuan
                    </a>

                      <!-- Cek Apakah Pengajuan Ada Memo Nya -->
                      <!-- <?php  
                        $cek_memo = $this->db->query("SELECT * FROM tbl_memo WHERE nomor_pengajuan = '$no_pengajuan'")->num_rows();
                        if($cek_memo > 0){
                      ?>
                        <a href="<?php echo base_url().'p_revisi/edit_memo/'.$row_revisi['id_pengajuan'] ?>" class="btn btn-success btn-xs">
                          <i class="fa fa-edit"></i> Revisi Memo
                        </a>
                      <?php } ?> -->

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