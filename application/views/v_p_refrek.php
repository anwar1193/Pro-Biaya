  <?php  

    error_reporting(0);
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
        Data Pengajuan (Revisi Rekening By Finance)
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
              <h3 class="box-title">Pengajuan (Revisi Rekening By Finance)</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>NO Pengajuan</th>
                  <th>Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th>Bank Penerima</th>
                  <th>Nomor Rekening</th>
                  <th>Atas Nama</th>
                  <th style="text-align: center" width="20%">Ket Revisi</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_refrek as $row_refrek){
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_refrek['tanggal'])) ?></td>
                  <td><?php echo $row_refrek['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_refrek['jenis_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_refrek['total'],0,',','.') ?></td>

                  <td><?php echo $row_refrek['bank_penerima'] ?></td>
                  <td><?php echo $row_refrek['norek_penerima'] ?></td>
                  <td><?php echo $row_refrek['atas_nama'] ?></td>
                  
                  <!-- Kolom Status Approve -->
                    <td style="color: gray; font-weight: bold">"<?php echo $row_refrek['alasan_revisi_rekening'] ?>"</td>
                  <!-- / Kolom Status Approve -->

                  <!-- Kolom Action -->
                  <td style="text-align: center;">

                    <!-- <a href="<?php echo base_url().'p_on_proccess/hapus_refrek/'.$row_refrek['id_pengajuan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-times"></i> Cancel/Hapus
                    </a> -->

                    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-edit"
                      data-id_pengajuan = "<?php echo $row_refrek['id_pengajuan'] ?>"
                      data-nomor_pengajuan = "<?php echo $row_refrek['nomor_pengajuan'] ?>"
                      data-bank_penerima = "<?php echo $row_refrek['bank_penerima'] ?>"
                      data-norek_penerima = "<?php echo $row_refrek['norek_penerima'] ?>"
                      data-atas_nama = "<?php echo $row_refrek['atas_nama'] ?>"
                      id="pilih_edit"
                    >
                      <i class="fa fa-edit"></i> Perbaiki Rekening
                    </button>

                  </td>
                  <!-- / Kolom Action -->
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


  <!-- Modal Edit -->
  <form action="<?php echo base_url().'p_on_proccess/update_rekening' ?>" method="post">
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Data Karyawan</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id_pengajuan" id="id_pengajuan">
          <input type="text" hidden name="nomor_pengajuan" id="nomor_pengajuan">

          <div class="form-group">
            <label for="bank_penerima"></span> Bank Penerima :</label>

            <select class="form-control" name="bank_penerima" id="bank_penerima">
              <option value="Mandiri">Mandiri</option>
              <option value="BCA">BCA</option>
              <option value="Mega">Mega</option>
              <option value="Permata">Permata</option>
              <option value="Danamon">Danamon</option>
              <option value="BRI">BRI</option>
            </select>
          </div>

          <div class="form-group">
            <label for="norek_penerima"></span> Nomor Rekening :</label>
            <input type="text" name="norek_penerima" class="form-control" autocomplete="off" id="norek_penerima" required>
          </div>

          <div class="form-group">
            <label for="atas_nama"></span> Atas Nama :</label>
            <input type="text" name="atas_nama" class="form-control" autocomplete="off" id="atas_nama" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Rekening</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Edit -->


  <!-- Script Jquery Edit -->
  <script>
    $(document).ready(function(){
      $(document).on('click','#pilih_edit', function(){

        var id_pengajuan = $(this).data('id_pengajuan');
        var nomor_pengajuan = $(this).data('nomor_pengajuan');
        var bank_penerima = $(this).data('bank_penerima');
        var norek_penerima = $(this).data('norek_penerima');
        var atas_nama = $(this).data('atas_nama');

        $('#id_pengajuan').val(id_pengajuan);
        $('#nomor_pengajuan').val(nomor_pengajuan);
        $('#bank_penerima').val(bank_penerima);
        $('#norek_penerima').val(norek_penerima);
        $('#atas_nama').val(atas_nama);
      });
    });
  </script>
  <!-- / Script Jquery Edit -->