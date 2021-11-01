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

<!-- Ambil Data Flashdata untuk kata sweet alert -->
<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

<section class="content-header">
  <h1>
    Data Request Penyelesaian
    <small>PT Procar Int'l Finance</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Request Penyelesaian</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  

  <div class="box">
        <div class="box-header">
          <h3 class="box-title">Request Penyelesaian</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="tableDT" class="table table-bordered table-striped">
            <thead>
            <tr style="text-align:center">
              <th>NO</th>
              <th>Tanggal Pengajuan</th>
              <th>NO Pengajuan</th>
              <th>No Invoice</th>
              <th>Cabang</th>
              <th>Dept</th>
              <th>Jenis Biaya</th>
              <th>Sub Biaya</th>
              <th>Jumlah Biaya</th>
              <th style="text-align: center;" width="10%">Status Dokumen</th>
              <th>Jenis Penyelesaian</th>
              <th style="text-align: center" width="15%">Note Penyelesaian</th>
              <th style="text-align: center" width="5%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no=1;
              foreach($data_pengajuan as $row_pengajuan){
            ?>
            <tr style="text-align: center">
              <td><?php echo $no++; ?></td>
              <td><?php echo date('d-m-Y',strtotime($row_pengajuan['tanggal'])) ?></td>
              <td><?php echo $row_pengajuan['nomor_pengajuan'] ?></td>
              <td><?php echo $row_pengajuan['nomor_invoice'] ?></td>
              <td><?php echo $row_pengajuan['cabang'] ?></td>
              <td><?php echo $row_pengajuan['bagian'] ?></td>
              <td><?php echo $row_pengajuan['jenis_biaya'] ?></td>
              <td><?php echo $row_pengajuan['sub_biaya'] ?></td>
              <td style="text-align: right;"><?php echo number_format($row_pengajuan['jumlah'] + $row_pengajuan['ppn'] - $row_pengajuan['pph23'] - $row_pengajuan['pph42'] - $row_pengajuan['pph21'],0,',','.') ?></td>
              

              <!-- Kolom Status Dokumen -->
              <?php if($row_pengajuan['status_dokumen']==''){ ?>
                <td style="color: orange; font-weight: bold" width="12%">
                  Pending <br>
                  <!-- Cari Due Date -->
                  <?php
                    date_default_timezone_set("Asia/Jakarta");
                    $tanggal_bayar = $row_pengajuan['tanggal_bayar'];
                    $tgl_bayar = substr($tanggal_bayar, 8,2);
                    $bln_bayar = substr($tanggal_bayar, 5,2);
                    $thn_bayar = substr($tanggal_bayar, 0,4);

                    $tambah_14 = mktime(0,0,0,date($bln_bayar),date($tgl_bayar)+14, date($thn_bayar));
                    $batas_penyerahan0 = date("Y-m-d", $tambah_14);

                    $batas_penyerahan = strtotime($batas_penyerahan0);
                    $tanggal_sekarang = time();

                    $sisa_waktu0 = $batas_penyerahan - $tanggal_sekarang;
                    $sisa_waktu = floor($sisa_waktu0 / (60 * 60 * 24) + 1);
                  ?>

                  <?php if($tanggal_bayar != "0000-00-00"){ ?>

                    <?php if($sisa_waktu < 0){ ?>
                      <span style="color: red">
                      Terlambat : <?php echo $sisa_waktu*(-1).' Hari'; ?>
                      </span>

                    <?php }else{ ?>
                      <span style="color: black">
                      Batas Waktu Penyerahan : <?php echo $sisa_waktu; ?> Hari Lagi
                      </span>
                    <?php } ?>

                  <?php } ?>


                </td>
              <?php }elseif($row_pengajuan['status_dokumen']=='done'){ ?>

                <td style="color: green; font-weight: bold" width="10%">
                  Diterima Oleh <?php echo $row_pengajuan['dept_tujuan'] ?>
                </td>

              <?php }elseif($row_pengajuan['status_dokumen']=='done acc'){ ?>

                <td style="color: blue; font-weight: bold" width="10%">
                  Diterima Oleh Accounting <br>
                </td>

              <?php } ?>
              <!-- / Kolom Status Dokumen -->

              <!-- Jenis & Note Penyelesaian -->
              <td><?php echo $row_pengajuan['jenis_penyelesaian'] ?></td>

              <td>
                  <?php echo $row_pengajuan['note_penyelesaian'] ?> <br>
                  <button style="margin-top: 5px;" class="btn btn-xs btn-success" id="pilih_edit" data-toggle="modal" data-target="#modal-ubah"
                    data-id_pengajuan = "<?php echo $row_pengajuan['id_pengajuan'] ?>"
                    data-note_penyelesaian = "<?php echo $row_pengajuan['note_penyelesaian'] ?>"
                  >
                        <i class="fa fa-edit"></i> Ubah Note
                  </button>
              </td>
              
              <!-- td action -->
              <td style="text-align: center;">

                <a href="<?php echo base_url().'revisi_request_penyelesaian/detail/'.$row_pengajuan['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
                  <i class="fa fa-refresh"></i> Detail
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


<!-- Modal Ubah -->
<form action="<?php echo base_url().'revisi_request_penyelesaian/ubah' ?>" method="post">
  <div class="modal fade" id="modal-ubah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Note Penyelesaian</h4>
        </div>
        <div class="modal-body">

          <input type="text" id="id_pengajuan" name="id_pengajuan" hidden>
          <textarea class="form-control" name="note_penyelesaian" id="note_penyelesaian" rows="10" required=""></textarea>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Note</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Ubah -->

  <script>
      $(document).ready(function(){

        // Script modal-ubah
        $(document).on('click','#pilih_edit', function(){
            var id = $(this).data('id_pengajuan');
            var note = $(this).data('note_penyelesaian');

            $('#id_pengajuan').val(id);
            $('#note_penyelesaian').val(note);

        });

      });
  </script>