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
        Setujui Bayar Pengajuan
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
              <h3 class="box-title">Data Pengajuan</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <!-- Filter by Tanggal Pengajuan -->
              <div id="tanggal_pengajuan">
              <form method="POST" action="<?php echo base_url().'p_bayar' ?>">
                <table>
                  <tr>
                    <td>(FILTER By Tgl Minta Bayar & Nama Bank) - &nbsp;</td>

                    <td>&nbsp;  Dari Tanggal : </td>
                    <td><input type="date" name="tanggal_from" required></td>

                    <td>&nbsp;  Sampai Tanggal : </td>
                    <td><input type="date" name="tanggal_to" required></td>

                    <td>&nbsp;  Nama Bank : </td>
                    <td>
                      <select name="nama_bank">
                        <?php foreach($data_bank_pengaju as $row_bank){ ?>
                        <option value="<?php echo $row_bank['nama_bank'] ?>"><?php echo $row_bank['nama_bank'] ?></option>
                        <?php } ?>
                      </select>
                    </td>

                    <td>
                      &nbsp;  <button type="submit" class="btn btn-info btn-xs" name="cari_data">
                        <i class="fa fa-search"></i> Cari Data
                      </button>
                    </td>
                  </tr>
                </table>
              </form>
              </div>

              <!-- Penutup Filter by Tanggal Pengajuan --><br>

              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr style="text-align: center">
                  <th>NO</th>
                  <th>Tanggal Minta Bayar</th>
                  <th>NO Pengajuan</th>
                  <th>Cabang</th>
                  <th>Departemen</th>
                  <th>Jenis Biaya</th>
                  <th>Sub Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th  style="display: none;">Jumlah Biaya</th>
                  <th>Bank</th>
                  <th width="10%">Pembayaran Ke</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody id="table_data">
                <?php
                  $no=1;
                  foreach($data_bayar as $row_bayar){
                  $no_pengajuan = $row_bayar['nomor_pengajuan'];
                  // ambil tanggal permintaan bayar
                  $r_perbay = $this->db->query("SELECT * FROM tbl_check WHERE nomor_pengajuan='$no_pengajuan'")->row_array();
                  $tanggal_permintaan = $r_perbay['tanggal_bayar'];

                  // cari frekuensi bayar by nomor pengajuan
                  $frek_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan'")->num_rows();

                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_bayar['tanggal_minta_bayar'])) ?></td>
                  <td><?php echo $row_bayar['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_bayar['cabang'] ?></td>
                  <td><?php echo $row_bayar['bagian'] ?></td>
                  <td><?php echo $row_bayar['jenis_biaya'] ?></td>
                  <td><?php echo $row_bayar['sub_biaya'] ?></td>

                  
                  <?php if($frek_byr == 1){ // jika hanya sekali bayar ?>

                    <td style="text-align: right;"><?php echo number_format($row_bayar['jumlah']+$row_bayar['ppn']-($row_bayar['pph23']+$row_bayar['pph42']+$row_bayar['pph21']),0,',','.') ?></td>

                    <td id="bayar" style="display: none;"><?php echo $row_bayar['jumlah']+$row_bayar['ppn']-($row_bayar['pph23']+$row_bayar['pph42']+$row_bayar['pph21']) ?></td>

                  <?php }else{ // jika lebih dari sekali pembayaran ?>

                    <td style="text-align: right;"><?php echo number_format($row_bayar['jumlah_bayar']+$row_bayar['ppn_bayar']-($row_bayar['pph23_bayar']+$row_bayar['pph42_bayar']+$row_bayar['pph21_bayar']),0,',','.') ?></td>

                    <td id="bayar" style="display: none;"><?php echo $row_bayar['jumlah_bayar']+$row_bayar['ppn_bayar']-($row_bayar['pph23_bayar']+$row_bayar['pph42_bayar']+$row_bayar['pph21_bayar']) ?></td>

                  <?php } ?>
                  
                  <td><?php echo $row_bayar['bank_penerima'] ?></td>

                  <?php if($frek_byr == 1){ // jika hanya sekali bayar ?>

                    <td>Pembayaran 1 Kali</td>

                  <?php }else{ // jika lebih dari sekali pembayaran ?>

                    <td><?php echo 'Pembayaran Ke-'.$row_bayar['pembayaran_ke'] ?></td>

                  <?php } ?>
                  
                  <td style="text-align: center;">

                    <!-- <a href="<?php echo base_url().'p_approved/hapus/'.$row_bayar['id_pengajuan'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')">
                      <i class="fa fa-trash"></i> Hapus
                    </a> -->

                    <a href="<?php echo base_url().'p_bayar/detail/'.$row_bayar['id'] ?>" class="btn btn-info btn-xs" target="_blank">
                      <i class="fa fa-eye"></i> Detail
                    </a>

                    <?php if($frek_byr == 1){ // Jika Hanya Sekali Bayar ?>

                      <button type="button" class="btn btn-success btn-xs" id="pilih_bayar" data-toggle="modal" data-target="#modal-bayar"
                        data-id = "<?php echo $row_bayar['id'] ?>"
                        data-nopeng = "<?php echo $row_bayar['nomor_pengajuan'] ?>"
                        data-sebelum_pajak = "<?php echo $row_bayar['jumlah'] ?>"
                        data-jumlah_bayar = "<?php echo $row_bayar['jumlah']+$row_bayar['ppn']-($row_bayar['pph23']+$row_bayar['pph42']+$row_bayar['pph21']) ?>"
                      >
                        <i class="fa fa-check-square-o"></i> Setujui Bayar
                      </button>

                    <?php }else{ // Jika lebih dari sekali bayar ?>

                      <button type="button" class="btn btn-success btn-xs" id="pilih_bayar" data-toggle="modal" data-target="#modal-bayar"
                        data-id = "<?php echo $row_bayar['id'] ?>"
                        data-nopeng = "<?php echo $row_bayar['nomor_pengajuan'] ?>"
                        data-sebelum_pajak = "<?php echo $row_bayar['jumlah_bayar'] ?>"
                        data-jumlah_bayar = "<?php echo $row_bayar['jumlah_bayar']+$row_bayar['ppn_bayar']-($row_bayar['pph23_bayar']+$row_bayar['pph42_bayar']+$row_bayar['pph21_bayar']) ?>"
                      >
                        <i class="fa fa-check-square-o"></i> Setujui Bayar
                      </button>

                    <?php } ?>

                  </td>
                </tr>
                <?php } ?>
                </tbody>

                <tfoot>
                  <tr>
                    <td colspan="9" style="text-align: right; font-weight: bold">TOTAL BAYAR : </td>
                    <td style="text-align: right; font-weight: bold; font-size: 18px;" id="total"></td>
                  </tr>
                </tfoot>

              </table>

              <!-- Modal Bayar -->
              <form method="post" action="<?php echo base_url().'p_bayar/bayar_satu' ?>">
              <div class="modal fade" id="modal-bayar">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Setujui Bayar Pengajuan</h4>
                    </div>
                    <div class="modal-body">

                      <input type="text" name="nomor_bmhd" value="<?php echo $nojur_bmhd ?>" hidden>

                      <div class="form-group">
                        <label for="alamat"></span> Tgl Rencana Bayar :</label>
                        <input type="date" name="tanggal_bayar" class="form-control" id="tglRencanaBayar" required min="<?php echo date('Y-m-d') ?>" max="2022-12-31"></input>
                      </div>

                      <div class="form-group">
                        <label for="alamat"></span> Bank yg Digunakan :</label>
                        <select class="form-control" name="bank_bayar">
                          <?php  
                            $bank = $this->db->query("SELECT * FROM tbl_bank")->result_array();
                            foreach($bank as $row_bank){
                          ?>
                          <option value="<?php echo $row_bank['id'] ?>"><?php echo $row_bank['nama_bank'] ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <input type="text" name="id" id="id_bayar" hidden>
                      <input type="text" name="nomor_pengajuan" id="nopeng" hidden>

                      <div class="form-group">
                        <label for="tanggal_bayar"></span> Jumlah Bayar :</label>
                        <input type="number" name="jumlah_bayar" class="form-control input-sm" id="jumlah_bayar" pattern="[1-9]{20}" readonly>
                      </div>

                      <input type="number" name="jumlah_sebelum_pajak" id="jumlah_sebelum_pajak" hidden>

                      <div class="form-group">
                        <label for="pph23"></span> pph23 :</label>
                        <input type="number" name="pph23" class="form-control input-sm" id="pph23" pattern="[1-9]{20}">
                      </div>

                      <div class="form-group">
                        <label for="pph42"></span> pph4(2) :</label>
                        <input type="number" name="pph42" class="form-control input-sm" id="pph42" pattern="[1-9]{20}">
                      </div>

                      <div class="form-group">
                        <label for="pph21"></span> pph21 :</label>
                        <input type="number" name="pph21" class="form-control input-sm" id="pph21" pattern="[1-9]{20}">
                      </div>

                      <!-- <div class="form-group">
                        <label for="alamat"></span> Catatan :</label>
                        <textarea class="form-control" name="note"></textarea>
                      </div> -->

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
                      <button type="submit" class="btn btn-sm btn-success" id="tombolSetujuiBayar"> Setujui Bayar</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              </form>
              <!-- / Modal Bayar -->  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <script>

    $(document).ready(function(){

      // Rubah format angka javascript
      function rubah(angka){
         var reverse = angka.toString().split('').reverse().join(''),
         ribuan = reverse.match(/\d{1,3}/g);
         ribuan = ribuan.join(',').split('').reverse().join('');
         return ribuan;
      }

      $(document).on('click','#pilih_bayar', function(){
        var id = $(this).data('id');
        var nopeng = $(this).data('nopeng');
        var jml_bayar = $(this).data('jumlah_bayar');
        var jml_sebelum_pajak = $(this).data('sebelum_pajak');

        $('#id_bayar').val(id);
        $('#nopeng').val(nopeng);
        $('#jumlah_sebelum_pajak').val(jml_sebelum_pajak);
        $('#jumlah_bayar').val(jml_bayar);
        $('#totals').val(jml_bayar);
        $('#total_rp').text(ubah_format(jml_bayar));

      });

      $(document).on('click', '#tombolSetujuiBayar', function(){
        $(this).hide();
      });

      $(document).on('click', '#tglRencanaBayar', function(){
        $('#tombolSetujuiBayar').show();
      });

      function hitung_total(){
        var total = 0;

        $('#table_data tr').each(function(){
          total += parseInt($(this).find('#bayar').text());
        });

        isNaN(total) ? $('#total').text(0) : $('#total').text(rubah(total));

      }

      hitung_total();

    });

  </script>


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