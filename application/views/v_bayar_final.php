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
        Bayar Pengajuan - Final
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
              <form method="POST" action="<?php echo base_url().'p_bayar_final' ?>">
                <table>
                  <tr>
                    <td>(FILTER By Tgl Rencana Bayar & Nama Bank) - &nbsp;</td>

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

              <!-- <form method="post" action="<?php echo base_url().'history_bayar/cetak' ?>"> -->

              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr style="text-align: center">
                  <th>NO</th>
                  <th>Tgl Rencana Bayar</th>
                  <th>Bank Bayar</th>
                  <th>NO Pengajuan</th>
                  <th>Cabang</th>
                  <th>Departemen</th>
                  <th>Sub Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th  style="display: none;">Jumlah Biaya</th>
                  <th>Bank</th>
                  <th>No Rekening</th>
                  <th width="10%">Pembayaran Ke</th>
                  <th>Status Bayar</th>
                  <!-- <th style="text-align: center">Pilih Cetak</th> -->
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


                  // Ambil Bank
                  $nopeng = $row_bayar['nomor_pengajuan'];
                  $q_bank = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$nopeng'")->row_array();
                  $id_bank = $q_bank['bank_bayar'];

                  // Ambil Nama Bank
                  $data_bank = $this->db->query("SELECT * FROM tbl_bank WHERE id='$id_bank'")->row_array();
                  $nama_bank = $data_bank['nama_bank'];

                  // cari frekuensi bayar by nomor pengajuan
                  $frek_byr = $this->db->query("SELECT * FROM tbl_bayar WHERE nomor_pengajuan='$no_pengajuan'")->num_rows();

                  // Yang tampil di view, field departemen update
                  $bagian = $row_bayar['bagian'];
                  $data_departemen = $this->M_master->tampil_data_where('tbl_departemen', array('nama_departemen' => $bagian))->row_array();
                  $nama_departemen_update = $data_departemen['nama_departemen_update'];

                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>

                  <!-- tanggal rencana bayar -->
                  <td>
                    <?php echo date('d-m-Y',strtotime($row_bayar['tanggal_rencana_bayar'])) ?>

                    <button class="btn btn-xs btn-warning" id="pilih_edit" data-toggle="modal" data-target="#modal-ubah"
                        data-tanggal = "<?php echo $row_bayar['tanggal_rencana_bayar'] ?>"
                        data-id_ubah = "<?php echo $row_bayar['id'] ?>"
                        data-nopeng = "<?php echo $row_bayar['nomor_pengajuan'] ?>"
                        data-total = "<?php echo $row_bayar['jumlah']+$row_bayar['ppn']-($row_bayar['pph23']+$row_bayar['pph42']+$row_bayar['pph21']) ?>"
                    >
                      <i class="fa fa-edit"></i> Ubah Tanggal
                    </button>

                  </td>

                  <!-- bank bayar -->
                  <td>
                    <?php echo $nama_bank; ?>

                    <button class="btn btn-xs btn-warning" id="pilih_bank" data-toggle="modal" data-target="#modal-bank"
                        data-bank = "<?php echo $nama_bank ?>"
                        data-id_bank = "<?php echo $row_bayar['id'] ?>"
                    >
                      <i class="fa fa-edit"></i> Ubah Bank
                    </button>

                  </td>

                  <td><?php echo $row_bayar['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_bayar['cabang'] ?></td>
                  <td><?php echo $nama_departemen_update ?></td>
                  <td><?php echo $row_bayar['sub_biaya'] ?></td>

                  <?php if($frek_byr == 1){ // jika hanya sekali bayar ?>

                    <td style="text-align: right;"><?php echo number_format($row_bayar['jumlah']+$row_bayar['ppn']-($row_bayar['pph23']+$row_bayar['pph42']+$row_bayar['pph21']),0,',','.') ?></td>

                    <td id="bayar" style="display: none;"><?php echo $row_bayar['jumlah']+$row_bayar['ppn']-($row_bayar['pph23']+$row_bayar['pph42']+$row_bayar['pph21']) ?></td>

                  <?php }else{ // Jika lebih dari sekali bayar ?>

                    <td style="text-align: right;"><?php echo number_format($row_bayar['jumlah_bayar']+$row_bayar['ppn_bayar']-($row_bayar['pph23_bayar']+$row_bayar['pph42_bayar']+$row_bayar['pph21_bayar']),0,',','.') ?></td>

                    <td id="bayar" style="display: none;"><?php echo $row_bayar['jumlah_bayar']+$row_bayar['ppn_bayar']-($row_bayar['pph23_bayar']+$row_bayar['pph42_bayar']+$row_bayar['pph21_bayar']) ?></td>

                  <?php } ?>


                  <td>
                    <?php echo $row_bayar['bank_penerima'] ?>
                  </td>

                  <!-- Nomor Rekening Penerima -->
                  <td>
                    <?php echo $row_bayar['norek_penerima'] ?>
                    <button class="btn btn-xs btn-warning" id="pilih_rekening" data-toggle="modal" data-target="#modal-rekening"
                        data-nopeng = "<?php echo $row_bayar['nomor_pengajuan'] ?>"
                    >
                      <i class="fa fa-refresh"></i> Ajukan Revisi Rekening
                    </button>

                    <?php if($row_bayar['minta_bukti_transfer'] == 'ya'){ ?>
                      <br><span class="bg-warning">(Wajib Upload Bukti Transfer)</span>
                    <?php } ?>

                  </td>


                  <?php if($frek_byr == 1){ // jika hanya sekali bayar ?>

                    <td>Pembayaran 1 Kali</td>

                  <?php }else{ // jika lebih dari sekali pembayaran ?>

                    <td><?php echo 'Pembayaran Ke-'.$row_bayar['pembayaran_ke'] ?></td>

                  <?php } ?>
                  

                  <td style="color: green"><?php echo $row_bayar['sts_bayar'] ?></td>

                  <!-- <td style="text-align: center">
                    <input type="checkbox" name="id_pengajuan[]" class="minimal" value="<?php echo $row_bayar['id'] ?>">
                  </td> -->
                  
                  <td style="text-align: center;">

                    <!-- <form method="post" action="<?php echo base_url().'p_bayar_final/bayar' ?>">
                      <input type="text" hidden name="id" value="<?php echo $row_bayar['id'] ?>">
                      <input type="text" hidden name="nomor_pengajuan" value="<?php echo $row_bayar['nomor_pengajuan'] ?>">
                      <button type="submit" class="btn btn-xs btn-success" onclick="return confirm('Anda Yakin Akan Membayar Pengajuan Ini?')">
                        <i class="fa fa-check"></i> Bayar Pengajuan Lama
                      </button>
                    </form> -->

                    <?php if($frek_byr == 1){ // Jika hanya sekali bayar, ambil dari tbl_pengajuan ?>

                      <button class="btn btn-xs btn-success" id="pilih_bayar" data-toggle="modal" data-target="#modal-bayar"
                        data-id = "<?php echo $row_bayar['id'] ?>"
                        data-nopeng = "<?php echo $row_bayar['nomor_pengajuan'] ?>"
                        data-ref_no = "<?php echo $row_bayar['ref_no'] ?>"
                        data-minta_bukti_transfer = "<?php echo $row_bayar['minta_bukti_transfer'] ?>"
                        data-jumlah_bayar = "<?php echo $row_bayar['jumlah']+$row_bayar['ppn']-($row_bayar['pph23']+$row_bayar['pph42']+$row_bayar['pph21']) ?>"
                      >
                        <i class="fa fa-check"></i> Bayar Pengajuan
                      </button>

                    <?php }else{ // Jika lebih dari sekali bayar, ambil dari tbl_bayar ?>

                      <button class="btn btn-xs btn-success" id="pilih_bayar" data-toggle="modal" data-target="#modal-bayar"
                        data-id = "<?php echo $row_bayar['id'] ?>"
                        data-nopeng = "<?php echo $row_bayar['nomor_pengajuan'] ?>"
                        data-ref_no = "<?php echo $row_bayar['ref_no'] ?>"
                        data-minta_bukti_transfer = "<?php echo $row_bayar['minta_bukti_transfer'] ?>"
                        data-jumlah_bayar = "<?php echo $row_bayar['jumlah_bayar']+$row_bayar['ppn_bayar']-($row_bayar['pph23_bayar']+$row_bayar['pph42_bayar']+$row_bayar['pph21_bayar']) ?>"
                      >
                        <i class="fa fa-check"></i> Bayar Pengajuan
                      </button>

                    <?php } ?>

                    <a href="<?php echo base_url().'p_bayar_final/detail/'.$row_bayar['id'] ?>" class="btn btn-info btn-xs"  target="_blank">
                      <i class="fa fa-eye"></i> Detail
                    </a>

                  </td>
                </tr>
                <?php } ?>
                </tbody>

                <tfoot>
                  <tr>
                    <td colspan="11" style="text-align: right; font-weight: bold">TOTAL BAYAR : </td>
                    <td style="text-align: right; font-weight: bold; font-size: 18px;" id="total"></td>
                  </tr>
                </tfoot>

              </table>


              <!-- Tombol cetak pengajuan -->
              <center>
              <span>
                <button type="button" data-toggle="modal" data-target="#modal-cetak" class="btn btn-primary btn-xs">
                  <i class="fa fa-print"></i> Cetak Pengajuan
                </button>
              </span>
              </center>

              <!-- </form> -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal Ubah -->
  <form action="<?php echo base_url().'p_bayar_final/ubah' ?>" method="post">
  <div class="modal fade" id="modal-ubah">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Tanggal Bayar</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden id="id_ubah" name="id">
          <input type="text" hidden id="nmr_pengajuan" name="nomor_pengajuan">
          <input type="text" hidden id="total_bayar" name="total_bayar">

          <div class="form-group">
            <label for="nik"></span> Tanggal Bayar :</label>
            <input type="date" name="tanggal_rencana_bayar" class="form-control" autocomplete="off" id="tanggal_rencana_bayar" required min="<?php echo date('Y-m-d') ?>" max="2022-12-31">
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
  <!-- / Modal Ubah -->


  <!-- Modal Bank -->
  <form action="<?php echo base_url().'p_bayar_final/ubah_bank' ?>" method="post">
  <div class="modal fade" id="modal-bank">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Bank Bayar</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="id" id="id_bank">

          <div class="form-group">
            <label for="bank_bayar"></span> Bank Bayar :</label>
            <select class="form-control" name="bank_bayar">
              <?php  
                $bank = $this->db->query("SELECT * FROM tbl_bank")->result_array();
                foreach($bank as $row_bank){
              ?>
                <option value="<?php echo $row_bank['id'] ?>"><?php echo $row_bank['nama_bank'] ?></option>
              <?php } ?>
            </select>
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
  <!-- / Modal Bank -->


  <!-- Modal Rekening -->
  <form action="<?php echo base_url().'p_bayar_final/revisi_rekening' ?>" method="post">
  <div class="modal fade" id="modal-rekening">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ajukan Revisi Data Rekening</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="nomor_pengajuan" id="nomor_pengajuan">

          <div class="form-group">
            <label for="alasan_revisi_rekening"></span> Alasan Pengajuan Revisi Rekening :</label>
            <textarea class="form-control" name="alasan_revisi_rekening" required></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim Revisi</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Rekening -->


  <!-- Modal Cetak -->
  <form action="<?php echo base_url().'p_bayar_final/cetak' ?>" method="post">
  <div class="modal fade" id="modal-cetak">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cetak Pengajuan</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="alamat"></span> Tanggal Rencana Bayar :</label>
            <input type="date" name="tanggal" class="form-control" required></input>
          </div>

          <div class="form-group">
            <label for="alamat"></span> Bank Penerima :</label>
            <select name="bank_penerima" class="form-control">
              <option value="Semua Bank">Semua Bank</option>
              <?php foreach($data_bank_pengaju as $row_bank){ ?>
              <option value="<?php echo $row_bank['nama_bank'] ?>"><?php echo $row_bank['nama_bank'] ?></option>
              <?php } ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-success"> Cetak Pengajuan</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Cetak -->


  <!-- Modal Bayar Pengajuan -->
  <form action="<?php echo base_url().'p_bayar_final/bayar' ?>" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="modal-bayar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Bayar Pengajuan</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="id" id="id_bayar" hidden>
          <input type="text" name="nomor_pengajuan" id="nopeng" hidden>
          <input type="text" name="nomor_pymt" value="<?php echo $nojur_pymt ?>" hidden>
          <input type="text" name="ref_no" id="ref_no" hidden>

          <!-- <div class="form-group">
            <label for="tanggal_bayar"></span> Jumlah (Sebelum Pajak) :</label>
            <input type="number" name="jumlah_bayar" class="form-control input-sm" id="jumlah_bayar" pattern="[1-9]{20}" readonly>
          </div> -->

          <input type="number" name="pph23" id="pph23" pattern="[1-9]{20}" hidden>

          <input type="number" name="pph42" id="pph42" pattern="[1-9]{20}" hidden>

          <input type="number" name="pph21" id="pph21" pattern="[1-9]{20}" hidden>

          <input type="text" id="minta_bukti_transfer" hidden>
          <span id="notif_minta_bukti"></span>

          <div class="form-group">
            <label for="total"></span> Total Bayar :</label>
            <input type="number" name="total" id="totals" hidden><br>

            <!-- Total yang ada pemisah rupiah nya -->
            <span id="total_rp" style="font-weight: bold; font-size: 20px; padding: 5px;"></span>

            <br><br>

            <b>Upload Bukti Transfer (Optional) :</b>
            <table class="table table-bordered" id="tableLoop">
              <thead>
                <tr class="bg-success">
                  <th>No</th>
                  <th>Upload File</th>
                  <th>Nama File</th>
                  <th class="text-center">
                    <button class="btn btn-primary btn-xs" id="BarisBaru">
                      <i class="fa fa-plus"></i> Tambah File
                    </button>
                  </th>
                </tr>
              </thead>

              <tbody></tbody>
            </table>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-success" id="tombolBayar"> Bayar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Bayar Pengajuan -->


  <!-- Script Jquery Edit -->
  <script>
    $(document).ready(function(){

      $(document).on('click','#pilih_edit', function(){
        var tanggal = $(this).data('tanggal');
        var id_ubah = $(this).data('id_ubah');
        var nopeng = $(this).data('nopeng');
        var total = $(this).data('total');

        $('#tanggal_rencana_bayar').val(tanggal);
        $('#id_ubah').val(id_ubah);
        $('#nmr_pengajuan').val(nopeng);
        $('#total_bayar').val(total);

      });


      $(document).on('click','#pilih_bank', function(){
        var id_bank = $(this).data('id_bank');

        $('#id_bank').val(id_bank);
        
      });


      $(document).on('click','#pilih_rekening', function(){
        var nomor_pengajuan = $(this).data('nopeng');

        $('#nomor_pengajuan').val(nomor_pengajuan);
        
      });


      $(document).on('click', '#tombolBayar', function(){
        // Jika ada request bukti transfer dari pic reviewer, maka tampilkan notif nya
        var minta_bukti_transfer2 = $('#minta_bukti_transfer').val();
        var pilih_file = $('#pilih_file').val();
        var nama_file = $('#nama_file').val();

        if(minta_bukti_transfer2 == 'ya' && pilih_file == ''){
          alert("Wajib upload bukti transfer karena ada request dari PIC Reviewer !");
          return false;
        }else{
          if(pilih_file != '' && nama_file == ''){
            alert("Nama file belum diisi !");
            return false;
          }else{
            $(this).hide();
          }
        }
        
      });


    });
  </script>
  <!-- / Script Jquery Edit -->


  <!-- Script Jquery Bayar -->
  <script>
    $(document).ready(function(){

      // Rubah format angka javascript
      function ubah_format(angka){
         var reverse = angka.toString().split('').reverse().join(''),
         ribuan = reverse.match(/\d{1,3}/g);
         ribuan = ribuan.join('.').split('').reverse().join('');
         return ribuan;
      }

      $(document).on('click','#pilih_bayar', function(){
        var id = $(this).data('id');
        var nopeng = $(this).data('nopeng');
        var jml_bayar = $(this).data('jumlah_bayar');
        var pph23 = $(this).data('pph23');
        var ref_no = $(this).data('ref_no');
        var minta_bukti_transfer = $(this).data('minta_bukti_transfer');

        $('#id_bayar').val(id);
        $('#nopeng').val(nopeng);
        $('#jumlah_bayar').val(jml_bayar);
        $('#pph23').val(pph23);
        $('#pph42').val(pph42);
        $('#pph21').val(pph21);
        $('#totals').val(jml_bayar);
        $('#total_rp').text(ubah_format(jml_bayar));
        $('#ref_no').val(ref_no);
        $('#minta_bukti_transfer').val(minta_bukti_transfer);

      });

    });
  </script>
  <!-- / Script Jquery Bayar -->


  <!-- Script Tampil Totalan -->
  <script>

    $(document).ready(function(){

      // Rubah format angka javascript
      function rubah(angka){
         var reverse = angka.toString().split('').reverse().join(''),
         ribuan = reverse.match(/\d{1,3}/g);
         ribuan = ribuan.join(',').split('').reverse().join('');
         return ribuan;
      }

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


  <!-- Script Hitung Total Otomatis -->
  <script type="text/javascript">
    $(document).ready(function(){

      // Rubah format angka javascript
      function rubah(angka){
         var reverse = angka.toString().split('').reverse().join(''),
         ribuan = reverse.match(/\d{1,3}/g);
         ribuan = ribuan.join('.').split('').reverse().join('');
         return ribuan;
       }

      function hitung_otomatis(){
        var jumlah = $('#jumlah_bayar').val();
        var pph23 = $('#pph23').val();
        var pph42 = $('#pph42').val();
        var pph21 = $('#pph21').val();

        totals = (jumlah*1); //perkalian salah satu trik biar angka bisa ditambah
        $('#totals').val(totals);
        $('#total_rp').text(rubah(totals));
      }

      // Panggil fungsi ubah data (realtime) saat form (price_item, qty_item, discount_item) di ketik / di klik
      $(document).on('keyup mouseup', '#jumlah, #pph23 , #pph42 , #pph21' , function(){
        hitung_otomatis();
      });

    });
  </script>
  <!-- / Script Hitung Total Otomatis -->


  <!-- Script Upload Multiple File -->
<script type="text/javascript">

$(document).ready(function(){
  for(b=1; b<=1; b++){
    barisBaru();
  }
  $('#BarisBaru').click(function(e){
    e.preventDefault();
    barisBaru();
  });

  $("tableLoop tbody").find('input[type=text]').filter(':visible:first').focus();
});

function barisBaru(){
  $(document).ready(function(){
    $("[data-toggle='tooltip'").tooltip();
  });

  var Nomor = $("#tableLoop tbody tr").length + 1;
  var Baris = '<tr>';
          Baris += '<td class="text-center">'+Nomor+'</td>';

          Baris += '<td>';
            Baris += '<input type="file" id="pilih_file" name="files[]" class="form-control" placeholder="Upload File">';
          Baris += '</td>';

          Baris += '<td>';
            Baris += '<input type="text" name="nama_file[]" class="form-control" placeholder="Nama File" id="nama_file" autocomplete="off">';
          Baris += '</td>';

          Baris += '<td class="text-center">';
            Baris += '<a class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Baris" id="HapusBaris"><i class="fa fa-times"></i></a>';
          Baris += '</td>';
      Baris += '</tr>';

  $("#tableLoop tbody").append(Baris);
  $("#tableLoop tbody tr").each(function(){
    $(this).find('td:nth-child(2) input').focus();
  });

}

$(document).on('click', '#HapusBaris', function(e){
  e.preventDefault();
  var Nomor = 1;
  $(this).parent().parent().remove();
  $('tableLoop tbody tr').each(function(){
    $(this).find('td:nth-child(1)').html(Nomor);
    Nomor++;
  });
});



$(document).ready(function() {

  // Jika file upload di klik, nama file akan jadi required/wajib
  $("#pilih_file").click(function() {
    $("#nama_file").attr("required","");
  });


});

</script>