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
        Jurnal PIC (Reverse)
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jurnal PIC (Reverse)</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Jurnal PIC</h3> -->

            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <!-- Jurnal Update -->

              <h4>Jurnal PIC (Terbaru)</h4>
              <br>

              <table class="table">
                <tr>
                  <td width="15%">Kode Jurnal</td>
                  <td>:</td>
                  <td>Pro Biaya</td>

                  <td>&nbsp;</td>

                  <td width="15%">No Ticket</td>
                  <td>:</td>
                  <td>
                    <?php 
                      // JK/BY/102020/0001
                      $nojur1 = substr($data_jurnal_update['nomor_jurnal'], 0,6);
                      $nojur21 = substr($data_jurnal_update['nomor_jurnal'], 6,2);
                      $nojur22 = substr($data_jurnal_update['nomor_jurnal'], 8,2);
                      $nojur23 = substr($data_jurnal_update['nomor_jurnal'], 10,2);
                      $nojur3 = substr($data_jurnal_update['nomor_jurnal'], 12,5);
                      echo $nojur1.$nojur21.'.'.$nojur22.'.'.$nojur23.$nojur3;
                    ?>
                  </td>
                </tr>

                <tr>
                  <td>No Referensi</td>
                  <td>:</td>
                  <td><?php echo $data_jurnal_update['nomor_pengajuan'] ?></td>

                  <td>&nbsp;</td>

                  <td>Tanggal</td>
                  <td>:</td>
                  <td><?php echo date('d-m-Y',strtotime($data_jurnal_update['tanggal'])) ?></td>
                </tr>
              </table>

              <table class="table table-bordered" style="margin-top: 20px">
                <tr>
                  <th>No Perkiraan</th>
                  <th>Nama Perkiraan</th>
                  <th>Cabang</th>
                  <th>Debet</th>
                  <th>Credit</th>
                </tr>

                <tr>
                  <td><?php echo $coa; ?></td>
                  <td><?php echo strtoupper($data_jurnal_update['sub_biaya']) ?></td>
                  <td><?php echo $data_jurnal_update['cabang'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($data_jurnal_update['total']+$data_jurnal_update['pph23']+$data_jurnal_update['pph42'],0,',','.') ?></td>
                  <td style="text-align: right;">0</td>
                </tr>

                <?php if($data_jurnal_update['pph23'] != 0){ ?>

                  <tr>
                    <td>240-002-000-000</td>
                    <td>PPH23</td>
                    <td><?php echo $data_jurnal_update['cabang'] ?></td>
                    <td style="text-align: right;">0</td>
                    <td style="text-align: right;"><?php echo number_format($data_jurnal_update['pph23'],0,',','.') ?></td>
                  </tr>

                <?php } ?>

                <?php if($data_jurnal_update['pph42'] != 0){ ?>

                  <tr>
                    <td>240-006-000-000</td>
                    <td>PPH4(2)</td>
                    <td><?php echo $data_jurnal_update['cabang'] ?></td>
                    <td style="text-align: right;">0</td>
                    <td style="text-align: right;"><?php echo number_format($data_jurnal_update['pph42'],0,',','.') ?></td>
                  </tr>

                <?php } ?>

                <tr>
                  <td>245-999-000-000</td>
                  <td>BIAYA MASIH HARUS DIBAYAR</td>
                  <td><?php echo $data_jurnal_update['cabang'] ?></td>
                  <td style="text-align: right;">0</td>
                  <td style="text-align: right;"><?php echo number_format($data_jurnal_update['total'],0,',','.') ?></td>
                </tr>

                <tr>
                  <td colspan="3" style="text-align: right;font-weight: bold;">TOTAL</td>
                  <td style="text-align: right;"><?php echo number_format($data_jurnal_update['total']+$data_jurnal_update['pph23']+$data_jurnal_update['pph42'],0,',','.') ?></td>
                  <td style="text-align: right;"><?php echo number_format($data_jurnal_update['total']+$data_jurnal_update['pph23']+$data_jurnal_update['pph42'],0,',','.') ?></td>
                </tr>
              </table>

              <br>
              <b>Keterangan :</b> <?php echo $data_jurnal_update['keterangan'] ?> <br>

              <div style="text-align: center">
                <b>Final Approved By <?php echo $data_jurnal_update['approved_by'] ?> (<?php echo $data_jurnal_update['nama_pengapprove'] ?>)</b><br>
                <b>On : <?php echo date('d-m-Y', strtotime($data_jurnal_update['tanggal_approved'])) ?></b>
              </div>

              <hr>

              <!-- / Jurnal Update -->

              <h4>History Jurnal Reverse</h4>
              <br>

              <?php foreach($data_pengajuan as $row_pengajuan){ ?>
              <table class="table">
                <tr>
                  <td width="15%">Kode Jurnal</td>
                  <td>:</td>
                  <td>Pro Biaya</td>

                  <td>&nbsp;</td>

                  <td width="15%">No Ticket</td>
                  <td>:</td>
                  <td>
                    <?php 
                      // JK/BY/102020/0001
                      $nojur1 = substr($data_jurnal_update['nomor_jurnal'], 0,6);
                      $nojur21 = substr($data_jurnal_update['nomor_jurnal'], 6,2);
                      $nojur22 = substr($data_jurnal_update['nomor_jurnal'], 8,2);
                      $nojur23 = substr($data_jurnal_update['nomor_jurnal'], 10,2);
                      $nojur3 = substr($data_jurnal_update['nomor_jurnal'], 12,5);
                      echo $nojur1.$nojur21.'.'.$nojur22.'.'.$nojur23.$nojur3;
                    ?>
                  </td>
                </tr>

                <tr>
                  <td>No Referensi</td>
                  <td>:</td>
                  <td><?php echo $row_pengajuan['nomor_pengajuan'] ?></td>

                  <td>&nbsp;</td>

                  <td>Tanggal Reverse</td>
                  <td>:</td>
                  <td><?php echo date('d-m-Y',strtotime($row_pengajuan['tanggal_reverse'])) ?></td>
                </tr>
              </table>

              <table class="table table-bordered" style="margin-top: 20px">
                <tr>
                  <th>No Perkiraan</th>
                  <th>Nama Perkiraan</th>
                  <th>Cabang</th>
                  <th>Debet</th>
                  <th>Credit</th>
                </tr>

                <tr>
                  <td>245-999-000-000</td>
                  <td>BIAYA MASIH HARUS DIBAYAR</td>
                  <td><?php echo $row_pengajuan['cabang'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_pengajuan['total'],0,',','.') ?></td>
                  <td style="text-align: right;">0</td>
                </tr>

                <tr>
                  <td><?php echo $coa; ?></td>
                  <td><?php echo strtoupper($row_pengajuan['sub_biaya']) ?></td>
                  <td><?php echo $row_pengajuan['cabang'] ?></td>
                  <td style="text-align: right;">0</td>
                  <td style="text-align: right;"><?php echo number_format($row_pengajuan['total'],0,',','.') ?></td>
                </tr>

                <tr>
                  <td colspan="3" style="text-align: right;font-weight: bold;">TOTAL</td>
                  <td style="text-align: right;"><?php echo number_format($row_pengajuan['total'],0,',','.') ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_pengajuan['total'],0,',','.') ?></td>
                </tr>
              </table>

              <br>
              <b>Keterangan :</b> <?php echo $row_pengajuan['keterangan'] ?> <br>

              <div style="text-align: center">
                <b>Final Approved By <?php echo $row_pengajuan['approved_by'] ?> (<?php echo $row_pengajuan['nama_pengapprove'] ?>)</b><br>
                <b>On : <?php echo date('d-m-Y', strtotime($row_pengajuan['tanggal_approved'])) ?></b>
              </div>

              <hr>

              <?php } ?>

              <br>

              <!-- <a href="<?php echo base_url().'all_pengajuan_tanggal' ?>" class="btn btn-danger btn-xs">
                <i class="fa fa-backward"></i> Kembali
              </a> -->

              <!-- <a href="<?php echo base_url().'all_pengajuan_tanggal/pdf_jpic/'.$row_pengajuan['id_pengajuan'] ?>" class="btn btn-warning btn-xs" target="_blank">
                <i class="fa fa-print"></i> Export Jurnal (PDF)
              </a>

              <a href="<?php echo base_url().'all_pengajuan_tanggal/detail_jpic/'.$row_pengajuan['id_pengajuan'] ?>" class="btn btn-success btn-xs">
                <i class="fa fa-list"></i> Detail Pengajuan
              </a> -->

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