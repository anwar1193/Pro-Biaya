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
    Detail Penyelesaian Kekurangan Biaya
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
              
              <h4 style="text-align: center;">Detail Penyelesaian Kekurangan Biaya</h4>
              <hr style="border-width: 2px; width: 200px">
              
              <table class="table">

                <tr>
                  <th width="300px">Nomor Pengajuan</th>
                  <th>:</th>
                  <td><?php echo $data_penyelesaian['nomor_pengajuan'] ?></td>
                </tr>

                <tr>
                  <th>Nomor Invoice</th>
                  <th>:</th>
                  <td><?php echo $data_penyelesaian['nomor_invoice'] ?></td>
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

                <tr style="background-color:silver">
                  <th style="text-align: right;">Realisasi (Rekomendasi Reviewer)</th>
                  <th>:</th>
                  <td><?php echo number_format($data_pengajuan['nominal_penyelesaian_reviewer'],0,',','.') ?></td>
                </tr>

                <tr>
                  <th style="text-align: right;">Realisasi (Oleh Pengaju)</th>
                  <th>:</th>
                  <td><?php echo number_format($data_penyelesaian['realisasi'],0,',','.') ?></td>
                </tr>

                <tr>
                  <th style="text-align: right;">Jumlah Kurang Bayar</th>
                  <th>:</th>
                  <td><?php echo number_format($data_penyelesaian['kurang_bayar'],0,',','.') ?></td>
                </tr>

                <?php if($data_penyelesaian['alasan_beda_realisasi'] != ''){ ?>
                <tr style="background-color:silver">
                  <th>Alasan Perbedaan Realisasi</th>
                  <th>:</th>
                  <td><?php echo $data_penyelesaian['alasan_beda_realisasi'] ?></td>
                </tr>
                <?php } ?>

                <tr>
                  <th>Bank Penerima</th>
                  <th>:</th>
                  <td><?php echo $data_penyelesaian['bank'] ?></td>
                </tr>

                <tr>
                  <th>Nomor Rekening</th>
                  <th>:</th>
                  <td><?php echo $data_penyelesaian['nomor_rekening'] ?></td>
                </tr>

                <tr>
                  <th>Atas Nama</th>
                  <th>:</th>
                  <td><?php echo $data_penyelesaian['atas_nama_bank'] ?></td>
                </tr>

                <tr>
                  <th>PIC Reviewer</th>
                  <th>:</th>
                  <td><?php echo $data_penyelesaian['departemen_tujuan'] ?></td>
                </tr>

                <tr>
                  <th>Tanggal Minta Transfer</th>
                  <th>:</th>
                  <td><?php echo date('d-m-Y', strtotime($data_penyelesaian['tanggal_request_transfer'])) ?></td>
                </tr>
    

                <tr>
                  <th>Status Penyelesaian</th>
                  <th>:</th>
                  <td style="font-weight:bold">
                    <?php echo $data_penyelesaian['status_approve_penyelesaian'] ?> 
                    <?php if($data_penyelesaian['status_approve_penyelesaian'] != 'On Proccess'){ ?>
                      By <?php echo $data_penyelesaian['approved_by_penyelesaian'] ?>
                      (<?php echo $data_penyelesaian['nama_pengapprove_penyelesaian'] ?>)
                    <?php } ?>
                  </td>
                </tr>

                <tr>
                    <th>Tracking Approval</th>
                    <th>:</th>
                    <td>
                      <ul>
                        <?php foreach($data_approve_history as $row){ ?>

                          <?php if($row['status_approve'] == 'On Proccess'){ ?>

                            <li style="color: blue; font-weight: bold; margin-bottom: 5px">
                              <?php echo $row['status_approve'] ?> 
                            <small>(on <?php echo date('d-m-Y',strtotime($row['tanggal'])) ?>)</small>
                            </li>

                          <?php }else if($row['status_approve'] == 'approved'){ ?>

                            <li style="color: green; font-weight: bold; margin-bottom: 5px">
                              <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?>
                              <small>(on <?php echo date('d-m-Y', strtotime($row['tanggal'])) ?>)</small>
                              <br>
                              :: <?php echo $row['nama_pengapprove'] ?> ::
                              <br>
                              Note : "<?php echo $row['note'] ?>"
                            </li>

                          <?php }else if($row['status_approve'] == 'final approved'){ ?>

                            <li style="color: green; font-weight: bold; margin-bottom: 5px">
                              <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?>
                              <small>(on <?php echo date('d-m-Y', strtotime($row['tanggal'])) ?>)</small>
                              <br>
                              :: <?php echo $row['nama_pengapprove'] ?> ::
                              <br>
                              Note : "<?php echo $row['note'] ?>"
                            </li>

                          <?php }else if($row['status_approve'] == 'revisi'){ ?>

                            <li style="color: orange; font-weight: bold; margin-bottom: 5px">
                              <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?>
                              <small>(on <?php echo date('d-m-Y', strtotime($row['tanggal'])) ?>)</small>
                              <br>
                              :: <?php echo $row['nama_pengapprove'] ?> ::
                              <br>
                              Note : "<?php echo $row['note'] ?>"
                            </li>

                          <?php }else if($row['status_approve'] == 'rejected'){ ?>

                            <li style="color: red; font-weight: bold; margin-bottom: 5px">
                              <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?>
                              <small>(on <?php echo date('d-m-Y', strtotime($row['tanggal'])) ?>)</small>
                              <br>
                              :: <?php echo $row['nama_pengapprove'] ?> ::
                              <br>
                              Note : "<?php echo $row['note'] ?>"
                            </li>

                          <?php } ?>

                        <?php } ?>
                      </ul>
                    </td>
                  </tr>

              </table>

            </div>

          </div>

          <!-- Kronologis -->
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">

              <h4 style="text-decoration: underline;">Kronologis Kekurangan Biaya</h4>

              <?php echo $data_penyelesaian['kronologis'] ?>

            </div>
          </div>
          <!-- / Kronologis -->

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
                <a href="<?php echo base_url().'inbox_penyelesaian' ?>" class="btn btn-danger btn-xs">
                <i class="fa fa-backward"></i> Kembali
                </a>
              </span>

              <span>
                <a href="<?php echo base_url().'kekurangan_biaya/detail/'.$data_pengajuan['id_pengajuan'] ?>" class="btn btn-info btn-xs" target="_blank">
                  <i class="fa fa-eye"></i> Detail Pengajuan
                </a>
              </span>

              <span>
                <a href="#" data-toggle="modal" data-target="#modal-approve" class="btn btn-success btn-xs">
                <i class="fa fa-check"></i> Approve
                </a>
              </span>

              <span>
                <a href="#" data-toggle="modal" data-target="#modal-revisi" class="btn btn-warning btn-xs">
                <i class="fa fa-refresh"></i> Revisi
                </a>
              </span>

              <span>
                <a href="#" data-toggle="modal" data-target="#modal-reject" class="btn btn-danger btn-xs">
                <i class="fa fa-times"></i> Reject
                </a>
              </span>

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

<!-- Modal Approve -->
<form action="<?php echo base_url().'inbox_penyelesaian/approve' ?>" method="post">
  <div class="modal fade" id="modal-approve">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Approve Penyelesaian?</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_penyelesaian['id_penyelesaian'] ?>">
          <input type="text" hidden name="realisasi" value="<?php echo $data_penyelesaian['realisasi'] ?>">
          <input type="text" hidden name="id_pengajuan" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <div class="form-group">
            <label for="note"></span> Catatan :</label>
            <textarea class="form-control" name="note" id="note"></textarea>
          </div>

          <!-- Loading Approve -->
          <!-- <img id="loadingApprove" src="../../asset/gambar/loading3_baru.gif" alt="" width="280" style="opacity:0.7"> -->

        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-success" id="tombol_approve"> Approve</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Approve -->


<!-- Modal Revisi -->
<form action="<?php echo base_url().'inbox_penyelesaian/revisi' ?>" method="post">
  <div class="modal fade" id="modal-revisi">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Revisi Penyelesaian?</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_penyelesaian['id_penyelesaian'] ?>">
          <input type="text" hidden name="realisasi" value="<?php echo $data_penyelesaian['realisasi'] ?>">
          <input type="text" hidden name="id_pengajuan" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <div class="form-group">
            <label for="note"></span> Catatan :</label>
            <textarea class="form-control" name="note_revisi" id="note_revisi" required=""></textarea>
          </div>

          <!-- Loading Approve -->
          <!-- <img id="loadingApprove" src="../../asset/gambar/loading3_baru.gif" alt="" width="280" style="opacity:0.7"> -->

        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-warning" id="tombol_revisi"> Revisi</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Revisi -->


<!-- Modal Rejected -->
<form action="<?php echo base_url().'inbox_penyelesaian/reject' ?>" method="post">
  <div class="modal fade" id="modal-reject">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Reject Penyelesaian?</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" value="<?php echo $data_penyelesaian['id_penyelesaian'] ?>">
          <input type="text" hidden name="realisasi" value="<?php echo $data_penyelesaian['realisasi'] ?>">
          <input type="text" hidden name="id_pengajuan" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">

          <div class="form-group">
            <label for="note"></span> Catatan :</label>
            <textarea class="form-control" name="note_reject" id="note_reject" required=""></textarea>
          </div>

          <!-- Loading Approve -->
          <!-- <img id="loadingApprove" src="../../asset/gambar/loading3_baru.gif" alt="" width="280" style="opacity:0.7"> -->

        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-danger" id="tombol_revisi"> Reject</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Rejected -->