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

<!-- Ambil Data Flashdata untuk kata sweet alert -->
<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Penyelesaian Kekurangan Biaya (On Proccess)
    <small>PT Procar Int'l Finance</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Penyelesaian</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  

  <div class="box">
        <div class="box-header">
          <h3 class="box-title">Penyelesaian Kekurangan Biaya (On Proccess)</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <table id="tableDT" class="table table-bordered table-striped" style="margin-top: 10px">
            <thead>
            <tr>
              <th style="text-align: center">NO</th>
              <th style="text-align: center">NO Pengajuan</th>
              <th style="text-align: center">Jenis Biaya</th>
              <th style="text-align: center">Sub Biaya</th>
              <th style="text-align: center">Jumlah Pengajuan</th>
              <th style="text-align: center">Realisasi</th>
              <th style="text-align: center">Kurang Bayar</th>
              <th style="text-align: center">Tanggal Minta Transfer</th>
              <th style="text-align: center">PIC Reviewer</th>
              <th style="text-align: center">Status Penyelesaian</th>
              <th style="text-align: center" width="18%">Next Approve</th>
              <th style="text-align: center" width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no=1;
              foreach($data_inquiry as $row_inquiry){
            ?>
            <tr style="text-align: center">
              <td><?php echo $no++; ?></td>
              <td><?php echo $row_inquiry['nomor_pengajuan'] ?></td>
              <td><?php echo $row_inquiry['jenis_biaya'] ?></td>
              <td><?php echo $row_inquiry['sub_biaya'] ?></td>
              <td style="text-align: right;"><?php echo number_format($row_inquiry['total_pengajuan'],0,',','.') ?></td>
              <td style="text-align: right;"><?php echo number_format($row_inquiry['realisasi'],0,',','.') ?></td>
              <td style="text-align: right;"><?php echo number_format($row_inquiry['kurang_bayar'],0,',','.') ?></td>
              <td><?php echo date('d-m-Y', strtotime($row_inquiry['tanggal_request_transfer'])) ?></td>
              <td><?php echo $row_inquiry['departemen_tujuan'] ?></td>
              <td style="font-weight:bold">
                <?php echo $row_inquiry['status_approve_penyelesaian'] ?> 
                <?php if($row_inquiry['status_approve_penyelesaian'] != 'On Proccess'){ ?>
                  By <?php echo $row_inquiry['approved_by_penyelesaian'] ?><br>
                  (<?php echo $row_inquiry['nama_pengapprove_penyelesaian'] ?>)
                <?php } ?>

              </td>

              <!-- Kolom Next Approve -->
              <td style="font-weight: bold; text-align: center; color: orange">
                    <?php  
                      $cabang_pengaju = $row_inquiry['cabang'];
                      $level_pengaju = $row_inquiry['level_pengaju'];
                      $status_approve = $row_inquiry['status_approve_penyelesaian'];
                      $approved_by = $row_inquiry['approved_by_penyelesaian'];
                      $wilayah = $row_inquiry['wilayah'];
                      $dept_tujuan = $row_inquiry['dept_tujuan'];
                      $direktur_tujuan = $row_inquiry['direktur_tujuan_penyelesaian'];
                      $direktur_asal = $row_inquiry['direktur_asal'];
                      $kadiv_tujuan = $row_inquiry['kadiv_tujuan_penyelesaian'];
                      $kadiv_asal = $row_inquiry['kadiv_asal'];
                      $jalur_khusus = $row_inquiry['jalur_khusus'];

                      if(($level_pengaju == 'ADCO' OR $level_pengaju=='ADCOLL' OR $level_pengaju=='CMC' OR $level_pengaju=='ADD-CABANG' OR $level_pengaju=='Departement PIC') AND $status_approve=='On Proccess' AND $cabang_pengaju!='HEAD OFFICE'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$cabang' AND level='Branch Manager'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Kacab'; //done

                      }elseif(($level_pengaju == 'ADCO' OR $level_pengaju=='ADCOLL' OR $level_pengaju=='CMC' OR $level_pengaju=='ADD-CABANG' OR $level_pengaju=='Departement PIC') AND $status_approve=='approved' AND $approved_by=='kacab' AND $cabang_pengaju!='HEAD OFFICE'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$wilayah' AND level='Area Manager'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Kawil'; //done

                      }elseif(($level_pengaju == 'ADCO' OR $level_pengaju == 'ADCOLL' OR $level_pengaju == 'CMC' OR $level_pengaju == 'ADD-CABANG' OR $level_pengaju == 'Departement PIC') AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus=='' AND $cabang_pengaju != 'HEAD OFFICE'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'PIC Dept Head'; //done

                      }elseif(($level_pengaju == 'ADCO' OR $level_pengaju == 'ADCOLL' OR $level_pengaju == 'CMC' OR $level_pengaju == 'ADD-CABANG' OR $level_pengaju == 'Departement PIC') AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus != '' AND $cabang_pengaju != 'HEAD OFFICE'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head' AND jabatan_khusus='$jalur_khusus'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'PIC Dept Head'; // done

                      }elseif(($level_pengaju == 'ADCO' OR $level_pengaju == 'ADCOLL' OR $level_pengaju == 'CMC' OR $level_pengaju == 'ADD-CABANG' OR $level_pengaju == 'Departement PIC') AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!='' AND $cabang_pengaju != 'HEAD OFFICE'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$kadiv_tujuan' AND level='Division Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Division Head'; //done

                      }elseif(
                        ($level_pengaju == 'ADCO' OR $level_pengaju == 'ADCOLL' OR $level_pengaju == 'CMC' OR $level_pengaju == 'ADD-CABANG' OR $level_pengaju == 'Departement PIC') AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal=='' AND $cabang_pengaju != 'HEAD OFFICE'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director'; //done

                      }elseif(
                        ($level_pengaju == 'ADCO' OR $level_pengaju == 'ADCOLL' OR $level_pengaju == 'CMC' OR $level_pengaju == 'ADD-CABANG' OR $level_pengaju == 'Departement PIC') AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal!='' AND $cabang_pengaju != 'HEAD OFFICE'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_asal' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director'; //done

                      }elseif(
                        ($level_pengaju == 'ADCO' OR $level_pengaju == 'ADCOLL' OR $level_pengaju == 'CMC' OR $level_pengaju == 'ADD-CABANG' OR $level_pengaju == 'Departement PIC') AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal!='' AND $cabang_pengaju != 'HEAD OFFICE'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_asal' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director'; //done

                      }elseif(
                        ($level_pengaju == 'ADCO' OR $level_pengaju == 'ADCOLL' OR $level_pengaju == 'CMC' OR $level_pengaju == 'ADD-CABANG' OR $level_pengaju == 'Departement PIC') AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal=='' AND $cabang_pengaju != 'HEAD OFFICE'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';

                      }elseif(
                        ($level_pengaju == 'ADCO' OR $level_pengaju == 'ADCOLL' OR $level_pengaju == 'CMC' OR $level_pengaju == 'ADD-CABANG' OR $level_pengaju == 'Departement PIC') AND $status_approve=='approved' AND $approved_by=='director pengaju' AND $cabang_pengaju != 'HEAD OFFICE'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';
                      }

                      elseif(($level_pengaju == 'ADCO' OR $level_pengaju == 'ADCOLL' OR $level_pengaju == 'CMC' OR $level_pengaju == 'ADD-CABANG' OR $level_pengaju == 'Departement PIC') AND $status_approve=='approved' AND $approved_by=='director' AND $cabang_pengaju != 'HEAD OFFICE'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='Director Finance'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director Finance';
                      }

                      elseif(($level_pengaju == 'ADCO' OR $level_pengaju == 'ADCOLL' OR $level_pengaju == 'CMC' OR $level_pengaju == 'ADD-CABANG' OR $level_pengaju == 'Departement PIC') AND $status_approve=='approved' AND $approved_by=='director finance' AND $cabang_pengaju != 'HEAD OFFICE'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='President Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'President Director';
                      
                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='On Proccess' AND $cabang_pengaju=='HEAD OFFICE' AND $jalur_khusus==''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$departemen' AND level='Department Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Dept. Head';

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='On Proccess' AND $cabang_pengaju=='HEAD OFFICE' AND $jalur_khusus!=''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$departemen' AND level='Department Head' AND jabatan_khusus='$jalur_khusus'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Dept. Head';

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head' AND $kadiv_tujuan!=''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$kadiv_tujuan' AND level='Division Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Division Head';

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head' AND $kadiv_asal!=''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$kadiv_asal' AND level='Division Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Division Head';

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head' AND $kadiv_tujuan==''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'PIC Dept Head';

                      // Approved By Division Head.............................

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='division head' AND $jalur_khusus==''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'PIC Dept Head';

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='division head' AND $jalur_khusus!=''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_asal' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';

                      // Approved By Dept Head PIC..............................

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!=''){
                      $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$kadiv_tujuan' AND level='Division Head'")->row_array();
                      $nama_next = $q_next['nama_lengkap'];
                      $level_next = 'Division Head';

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal!=''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_asal' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal==''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';
                      
                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='director_pengaju'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director Finance';

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='director'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='Director Finance'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director Finance';
                      

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='director finance'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='President Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'President Director';
                      }

                      // Tampilkan next approve (tidak udah di ubah2 cukup query diatas saja)
                      echo '- '.$level_next.' -<br>';
                      echo $nama_next;

                    ?>
                  </td>
                  <!-- / Kolom Next Approve -->

              <!-- Kolom Action -->
              <td style="text-align: center;">

                <a href="<?php echo base_url().'inquiry_kekurangan_biaya/detail/'.$row_inquiry['id_penyelesaian'] ?>" class="btn btn-warning btn-xs">
                  <i class="fa fa-eye"></i> Detail
                </a>

                <a href="<?php echo base_url().'inquiry_kekurangan_biaya/perbaiki/'.$row_inquiry['id_penyelesaian'] ?>" class="btn btn-info btn-xs">
                  <i class="fa fa-edit"></i> Edit
                </a>
                
                <div style="margin-top:5px">
                  <a href="#" data-toggle="modal" data-target="#modal-cancel" class="btn btn-danger btn-xs"
                    data-id = "<?php echo $row_inquiry['id_penyelesaian'] ?>"
                    id="pilih_cancel"
                  >
                    <i class="fa fa-times"></i> Cancel
                  </a>
                </div>

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


<!-- Modal Cancel -->
<form action="<?php echo base_url().'inquiry_kekurangan_biaya/cancel' ?>" method="post">
<div class="modal fade" id="modal-cancel">
<div class="modal-dialog modal-sm">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Cancel Pengajuan?</h4>
    </div>
    <div class="modal-body">

      <input type="text" name="id_penyelesaian" id="id" hidden>

      <div class="form-group">
        <label for="note_cancel"></span> Alasan Cancel :</label>
        <textarea class="form-control" name="note_cancel" required></textarea>
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-warning btn-sm pull-left" data-dismiss="modal"> Batal</button>
      <button type="submit" class="btn btn-sm btn-danger"> Cancel Pengajuan</button>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
</form>
<!-- / Modal Cancel -->


<!-- Script Jquery Cancel -->
<script>
$(document).ready(function(){
  $(document).on('click','#pilih_cancel', function(){

    var id = $(this).data('id');

    $('#id').val(id);
  });
});
</script>
<!-- / Script Jquery Edit Split Bayar-->



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