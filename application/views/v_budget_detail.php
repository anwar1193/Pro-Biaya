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
        Data Budget <?php echo $cbg; ?> - <?php echo $deptm; ?>
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

              <!-- table scroll -->
              <table class="table" style="display: block; overflow-x: auto; white-space: nowrap;">
              <tr>
              <td>

              <table id="" class="table table-bordered table-striped">
                <thead style="background-color: orange">
                <tr>
                  <th rowspan="2" style="line-height: 70px">NO</th>
                  <th rowspan="2" style="line-height: 70px">Biaya</th>
                  <th rowspan="2" style="line-height: 70px">Sub Biaya</th>
                  <th rowspan="2" style="line-height: 70px; text-align: center;">Action</th>
                  <th colspan="3" style="text-align: center">September-2020</th>
                  <th colspan="3" style="text-align: center">Oktober-2020</th>
                  <th colspan="3" style="text-align: center">November-2020</th>
                  <th colspan="3" style="text-align: center">Desember-2020</th>
                  <th colspan="3" style="text-align: center">TOTAL 2020</th>
                </tr>

                <tr>
                  <th>Saldo Awal</th>
                  <th>Realisasi</th>
                  <th>Saldo Akhir</th>

                  <th>Saldo Awal</th>
                  <th>Realisasi</th>
                  <th>Saldo Akhir</th>

                  <th>Saldo Awal</th>
                  <th>Realisasi</th>
                  <th>Saldo Akhir</th>

                  <th>Saldo Awal</th>
                  <th>Realisasi</th>
                  <th>Saldo Akhir</th>

                  <th>Saldo Awal</th>
                  <th>Realisasi</th>
                  <th>Saldo Akhir</th>
                </tr>

                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_budget as $row_budget){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_budget['biaya'] ?></td>
                  <td><?php echo $row_budget['sub_biaya'] ?></td>

                  <td>
                    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-update"
                            data-id = "<?php echo $row_budget['id'] ?>"
                            data-biaya = "<?php echo $row_budget['biaya'] ?>"
                            data-sub_biaya = "<?php echo $row_budget['sub_biaya'] ?>"
                            data-agu20 = "<?php echo $row_budget['agu20_akhir'] ?>"
                            data-sep20 = "<?php echo $row_budget['sep20_akhir'] ?>"
                            data-okt20 = "<?php echo $row_budget['okt20_akhir'] ?>"
                            data-nov20 = "<?php echo $row_budget['nov20_akhir'] ?>"
                            data-des20 = "<?php echo $row_budget['des20_akhir'] ?>"
                            id="pilih"
                    >
                      Update Budget
                    </button>
                  </td>

                  <td style="text-align: right;"><?php echo number_format($row_budget['sep20_awal'],0,'.',',') ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_budget['sep20_realisasi'],0,'.',',') ?></td>
                  <?php if(substr($row_budget['sep20_akhir'], 0,1) == '-'){ ?>
                    <td style="text-align: right; color: red; font-weight: bold"><?php echo number_format($row_budget['sep20_akhir'],0,',','.') ?></td>
                  <?php }else{ ?>
                    <td style="text-align: right;"><?php echo number_format($row_budget['sep20_akhir'],0,',','.') ?></td>
                  <?php } ?>

                  <td style="text-align: right;"><?php echo number_format($row_budget['okt20_awal'],0,'.',',') ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_budget['okt20_realisasi'],0,'.',',') ?></td>
                  <?php if(substr($row_budget['okt20_akhir'], 0,1) == '-'){ ?>
                    <td style="text-align: right; color: red; font-weight: bold"><?php echo number_format($row_budget['okt20_akhir'],0,',','.') ?></td>
                  <?php }else{ ?>
                    <td style="text-align: right;"><?php echo number_format($row_budget['okt20_akhir'],0,',','.') ?></td>
                  <?php } ?>

                  <td style="text-align: right;"><?php echo number_format($row_budget['nov20_awal'],0,'.',',') ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_budget['nov20_realisasi'],0,'.',',') ?></td>
                  <?php if(substr($row_budget['nov20_akhir'], 0,1) == '-'){ ?>
                    <td style="text-align: right; color: red; font-weight: bold"><?php echo number_format($row_budget['nov20_akhir'],0,',','.') ?></td>
                  <?php }else{ ?>
                    <td style="text-align: right;"><?php echo number_format($row_budget['nov20_akhir'],0,',','.') ?></td>
                  <?php } ?>

                  <td style="text-align: right;"><?php echo number_format($row_budget['des20_awal'],0,'.',',') ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_budget['des20_realisasi'],0,'.',',') ?></td>
                  <?php if(substr($row_budget['des20_akhir'], 0,1) == '-'){ ?>
                    <td style="text-align: right; color: red; font-weight: bold"><?php echo number_format($row_budget['des20_akhir'],0,',','.') ?></td>
                  <?php }else{ ?>
                    <td style="text-align: right;"><?php echo number_format($row_budget['des20_akhir'],0,',','.') ?></td>
                  <?php } ?>

                  <!-- Data Total -->
                  <?php  
                    $total_awal = $row_budget['sep20_awal'] + $row_budget['okt20_awal'] + $row_budget['nov20_awal'] + $row_budget['des20_awal'];

                    $total_realisasi = $row_budget['sep20_realisasi'] + $row_budget['okt20_realisasi'] + $row_budget['nov20_realisasi'] + $row_budget['des20_realisasi'];

                    $total_akhir = $row_budget['sep20_akhir'] + $row_budget['okt20_akhir'] + $row_budget['nov20_akhir'] + $row_budget['des20_akhir'];
                  ?>

                  <td style="text-align: right;"><?php echo number_format($total_awal,0,'.',',') ?></td>
                  <td style="text-align: right;"><?php echo number_format($total_realisasi,0,'.',',') ?></td>
                  <?php if(substr($total_akhir, 0,1) == '-'){ ?>
                    <td style="text-align: right; color: red; font-weight: bold"><?php echo number_format($total_akhir,0,',','.') ?></td>
                  <?php }else{ ?>
                    <td style="text-align: right;"><?php echo number_format($total_akhir,0,',','.') ?></td>
                  <?php } ?>
                  
                </tr>
                <?php } ?>
                </tbody>
              </table>

              </td>
              </tr>
              </table>
              <!-- table scroll -->
              <br>
              <a href="<?php echo base_url().'budget_admin' ?>" class="btn btn-danger btn-sm">
                <i class="fa fa-backward"></i> Kembali
              </a>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal Edit -->
  <form action="<?php echo base_url().'budget_admin/update' ?>" method="post">
  <div class="modal fade" id="modal-update">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Data Budget</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="id" id="id" hidden>

          <div class="form-group">
            <label for="biaya"></span> Biaya :</label>
            <input type="text" name="biaya" class="form-control" autocomplete="off" id="biaya" readonly>
          </div>

          <div class="form-group">
            <label for="sub_biaya"></span> sub_biaya :</label>
            <input type="text" name="sub_biaya" class="form-control" autocomplete="off" id="sub_biaya" readonly>
          </div>

          <div class="form-group">
            <label for="agu20_akhir"></span> Agustus 2020 :</label>
            <input type="text" name="agu20_akhir" class="form-control" autocomplete="off" id="agu20_akhir" required>
          </div>

          <div class="form-group">
            <label for="sep20_akhir"></span> September 2020 :</label>
            <input type="text" name="sep20_akhir" class="form-control" autocomplete="off" id="sep20_akhir" required>
          </div>

          <div class="form-group">
            <label for="okt20_akhir"></span> Oktober 2020 :</label>
            <input type="text" name="okt20_akhir" class="form-control" autocomplete="off" id="okt20_akhir" required>
          </div>

          <div class="form-group">
            <label for="nov20_akhir"></span> November 2020 :</label>
            <input type="text" name="nov20_akhir" class="form-control" autocomplete="off" id="nov20_akhir" required>
          </div>

          <div class="form-group">
            <label for="des20_akhir"></span> Desember 2020 :</label>
            <input type="text" name="des20_akhir" class="form-control" autocomplete="off" id="des20_akhir" required>
          </div>

          

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Data</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Tambah -->



  <!-- Script Jquery Edit -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih', function(){

        var id = $(this).data('id');
        var biaya = $(this).data('biaya');
        var sub_biaya = $(this).data('sub_biaya');
        var agu20 = $(this).data('agu20');
        var sep20 = $(this).data('sep20');
        var okt20 = $(this).data('okt20');
        var nov20 = $(this).data('nov20');
        var des20 = $(this).data('des20');

        $('#id').val(id);
        $('#biaya').val(biaya);
        $('#sub_biaya').val(sub_biaya);
        $('#agu20_akhir').val(agu20);
        $('#sep20_akhir').val(sep20);
        $('#okt20_akhir').val(okt20);
        $('#nov20_akhir').val(nov20);
        $('#des20_akhir').val(des20);
      });
    });
  </script>
  <!-- / Script Jquery Edit -->


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