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
        Review Pengajuan Disetujui
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
              <h3 class="box-title">Review Pengajuan</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <button class="btn btn-info btn-sm" id="tombol1">Berdasarkan Tanggal Pengajuan</button>
              <button class="btn btn-warning btn-sm" id="tombol2">Berdasarkan Biaya</button>

              <!-- Filter by Tanggal Pengajuan -->
              <div id="tanggal_pengajuan"><br>
              <form method="POST" action="<?php echo base_url().'p_review' ?>">
                <table>
                  <tr>
                    <td>(FILTER By Tgl Pengajuan) - &nbsp;</td>

                    <td>&nbsp;  Dari Tanggal : </td>
                    <td><input type="date" name="tanggal_from" required></td>

                    <td>&nbsp;  Sampai Tanggal : </td>
                    <td><input type="date" name="tanggal_to" required></td>

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>

              <!-- Penutup Filter by Tanggal Pengajuan -->

              <!-- Filter by Jenis Biaya -->
              <div id="jenis_biaya"><br>
              <form method="POST" action="<?php echo base_url().'p_review' ?>">
                <table>
                  <tr>
                    <td>(FILTER By Sub Biaya) - &nbsp;&nbsp;</td>

                    <td>Sub Biaya :</td>
                    <td>
                      <select name="sub_biaya" required="">
                        <option value="">- Pilih Sub Biaya -</option>
                        <?php foreach($data_filter_biaya as $row){ ?>
                        <option value="<?php echo $row['sub_biaya'] ?>">
                          <?php echo $row['sub_biaya'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </td>

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data2">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>
              <!-- Penutup Filter by Jenis Biaya -->
              <br>
              <hr style="border-color: orange; border-style: dashed;">

              <table class="table table-bordered table-striped" id="tableDT" style="margin-top: 10px">
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
                  <th style="text-align: center;" width="20%">Status</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_review as $row_review){
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_review['tanggal'])) ?></td>
                  <td><?php echo $row_review['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_review['cabang'] ?></td>
                  <td><?php echo $row_review['bagian'] ?></td>
                  <td><?php echo $row_review['jenis_biaya'] ?></td>
                  <td><?php echo $row_review['sub_biaya'] ?></td>

                  <?php if($row_review['form'] != 'Kendaraan'){ ?>
                    <td style="text-align: right;"><?php echo number_format($row_review['jumlah'] + $row_review['ppn'] - $row_review['pph23'] - $row_review['pph42'] - $row_review['pph21'],0,',','.') ?></td>
                  <?php }else{ ?>
                    <td style="text-align: right;"><?php echo number_format($row_review['jumlah'] - $row_review['pph23'] - $row_review['pph42'] - $row_review['pph21'],0,',','.') ?></td>
                  <?php } ?>
                  
                  <td style="color: green; font-weight: bold">
                    <?php echo '- '.$row_review['status_approve'].' by '.$row_review['approved_by'].' -'.'<br>'.$row_review['nama_pengapprove'] ?>
                  </td>

                  
                  <td style="text-align: center;">

                    <!-- <a href="<?php echo base_url().'p_approved/hapus/'.$row_review['id_pengajuan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-trash"></i> Hapus
                    </a> -->

                    <a href="<?php echo base_url().'p_review/detail/'.$row_review['id_pengajuan'] ?>" class="btn btn-info btn-xs">
                      <i class="fa fa-check-square-o"></i> Review
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


  <script type="text/javascript">
    $(document).ready(function(){

      $('#tanggal_pengajuan').hide();
      $('#jenis_biaya').hide();

      $(document).on('click', '#tombol1', function(){
        $('#tanggal_pengajuan').slideDown(1000);
        $('#jenis_biaya').hide();
      });

      $(document).on('click', '#tombol2', function(){
        $('#tanggal_pengajuan').hide();
        $('#jenis_biaya').slideDown(1000);
      });

    });
  </script>