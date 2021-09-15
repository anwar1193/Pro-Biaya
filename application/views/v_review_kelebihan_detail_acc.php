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
    Detail Penyelesaian Kelebihan Biaya
    <small>PT Procar Int'l Finance</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Detail Penyelesaian</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  

  <div class="box">
        <div class="box-body">
          
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
              
              <h4 style="text-align: center;">Detail Penyelesaian Kelebihan Biaya</h4>
              <hr style="border-width: 2px; width: 200px">
              
              <table class="table">

                <tr>
                  <th>Nomor Pengajuan</th>
                  <th>:</th>
                  <td><?php echo $data_penyelesaian['nomor_pengajuan'] ?></td>
                </tr>

                <tr>
                  <th>Cabang</th>
                  <th>:</th>
                  <td><?php echo $data_pengajuan['cabang'] ?></td>
                </tr>

                <tr>
                  <th>Bagian</th>
                  <th>:</th>
                  <td><?php echo $data_pengajuan['bagian'] ?></td>
                </tr>

                <tr>
                  <th>Jenis Biaya</th>
                  <th>:</th>
                  <td><?php echo $data_penyelesaian['jenis_biaya'] ?></td>
                </tr>

                <tr>
                  <th>Sub Biaya</th>
                  <th>:</th>
                  <td><?php echo $data_penyelesaian['sub_biaya'] ?></td>
                </tr>

                <tr>
                  <th style="text-align: right;">Jumlah Pengajuan</th>
                  <th>:</th>
                  <td><?php echo number_format($data_penyelesaian['total_pengajuan'],0,',','.') ?></td>
                </tr>

                <tr>
                  <th style="text-align: right;">Realisasi</th>
                  <th>:</th>
                  <td><?php echo number_format($data_penyelesaian['realisasi'],0,',','.') ?></td>
                </tr>

                <tr>
                  <th style="text-align: right;">Jumlah Lebih Bayar</th>
                  <th>:</th>
                  <td><?php echo number_format($data_penyelesaian['lebih_bayar'],0,',','.') ?></td>
                </tr>

                <tr>
                  <th>Tanggal Pengembalian</th>
                  <th>:</th>
                  <td><?php echo date('d-m-Y', strtotime($data_penyelesaian['tanggal_pengembalian'])) ?></td>
                </tr>

                <tr>
                  <th>Cara Pengembalian</th>
                  <th>:</th>
                  <td><?php echo $data_penyelesaian['cara_pengembalian'] ?></td>
                </tr>

                <tr>
                  <th>PIC Reviewer</th>
                  <th>:</th>
                  <td><?php echo $data_penyelesaian['departemen_tujuan'] ?></td>
                </tr>
                
                <tr>
                  <th>Berkas Penyelesaian</th>
                  <th>:</th>
                  <td>
                    <ul>
                      <?php foreach($data_file as $row_file){ ?>
                      <li>
                        <?php echo $row_file['nama_file'] ?>

                        <?php 
                          if(file_exists('file_penyelesaian/'.$row_file['file'])){
                        ?>

                          <a target="_blank" href="<?php echo base_url().'file_penyelesaian/'.$row_file['file'] ?>">Download</a>
                        
                        <?php }else{ ?>

                          <?php  
                            $nama_folder = substr($row_file['file'], 0, 10);
                          ?>

                          <a target="_blank" href="<?php echo base_url().'file_penyelesaian/'.$nama_folder.'/'.$row_file['file'] ?>">Download</a>

                        <?php } ?>

                      </li>
                      <?php } ?>
                    </ul>
                  </td>
                </tr>

                <tr>
                  <th>Status Penyelesaian</th>
                  <th>:</th>
                  <td style="font-weight:bold"><?php echo $data_penyelesaian['status_verifikasi_penyelesaian'] ?></td>
                </tr>

              </table>

            </div>

          </div>

          <!-- Catatan Penyelesaian (Dari PIC Reviewer) -->
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">

              <h4 style="text-decoration: underline;">Catatan Penyelesaian (Dari PIC Reviewer)</h4>

              <?php echo $data_pengajuan['note_penyelesaian'] ?>

            </div>
          </div>
          <!-- / Catatan Penyelesaian (Dari PIC Reviewer) -->

          <div class="row">
            <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">

              <span>
                <a href="<?php echo base_url().'review_kelebihan_accounting' ?>" class="btn btn-danger btn-xs">Kembali</a>
              </span>

              <span>
                <a href="<?php echo base_url().'kelebihan_biaya/detail/'.$data_pengajuan['id_pengajuan'] ?>" class="btn btn-info btn-xs" target="_blank">Detail Pengajuan</a>
              </span>
              
              <?php if($data_penyelesaian['status_verifikasi_penyelesaian'] != 'Verified By Accounting'){ ?>
                <span>
                  <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-verifikasi">Verifikasi</a>
                </span>
              <?php } ?>

              <!-- <span>
                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-pending">Pending</a>
              </span> -->

            </div>
            <br><br><br><br><br><br><br>
          </div>

          

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

  
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Verifikasi -->
<form action="<?php echo base_url().'review_kelebihan_accounting/verifikasi' ?>" method="post">
  <div class="modal fade" id="modal-verifikasi">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Verifikasi Penyelesaian</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_penyelesaian['id_penyelesaian'] ?>">
          <input type="text" hidden name="realisasi" value="<?php echo $data_penyelesaian['realisasi'] ?>">
          <input type="text" hidden name="id_pengajuan" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <div class="form-group">
            <label for="note_verifikasi"></span> Catatan :</label>
            <textarea class="form-control" name="note_verifikasi" id="note_verifikasi" required=""></textarea>
          </div>

          <!-- Loading Approve -->
          <!-- <img id="loadingApprove" src="../../asset/gambar/loading3_baru.gif" alt="" width="280" style="opacity:0.7"> -->

        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-success" id="tombol_approve"> Verifikasi</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Verifikasi -->


  <!-- Modal Pending -->
<form action="<?php echo base_url().'review_kelebihan_biaya/pending' ?>" method="post">
  <div class="modal fade" id="modal-pending">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Pending Penyelesaian</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_penyelesaian['id_penyelesaian'] ?>">
          <input type="text" hidden name="realisasi" value="<?php echo $data_penyelesaian['realisasi'] ?>">
          <input type="text" hidden name="id_pengajuan" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <div class="form-group">
            <label for="note_verifikasi"></span> Catatan :</label>
            <textarea class="form-control" name="note_pending" id="note_pending" required=""></textarea>
          </div>

          <!-- Loading Approve -->
          <!-- <img id="loadingApprove" src="../../asset/gambar/loading3_baru.gif" alt="" width="280" style="opacity:0.7"> -->

        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-warning" id="tombol_approve"> Pending</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Pending -->