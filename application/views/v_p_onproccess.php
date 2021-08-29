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
        Data Pengajuan On Proccess
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
              <h3 class="box-title">Pengajuan (On Proccess)</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tableDT" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>NO Pengajuan</th>
                  <th>Jenis Biaya</th>
                  <th>Sub Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th style="text-align: center" width="20%">Status</th>
                  <th style="text-align: center" width="18%">Next Approve</th>
                  <th style="text-align: center" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no=1;
                  foreach($data_onproccess as $row_onproccess){
                ?>
                <tr style="text-align: center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($row_onproccess['tanggal'])) ?></td>
                  <td><?php echo $row_onproccess['nomor_pengajuan'] ?></td>
                  <td><?php echo $row_onproccess['jenis_biaya'] ?></td>
                  <td><?php echo $row_onproccess['sub_biaya'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_onproccess['jumlah'] + $row_onproccess['ppn'] - $row_onproccess['pph23'] - $row_onproccess['pph42'] - $row_onproccess['pph21'],0,',','.') ?></td>
                  
                  <!-- Kolom Status Approve -->
                  <?php if($row_onproccess['status_approve'] == 'on proccess'){ ?>

                    <td style="color: blue; font-weight: bold"><?php echo $row_onproccess['status_approve'] ?></td>

                  <?php }else if($row_onproccess['status_approve'] == 'approved'){ ?>

                    <td style="color: green; font-weight: bold">
                      <?php echo '- '.$row_onproccess['status_approve'].' by '.$row_onproccess['approved_by'].' -'.'<br>'.$row_onproccess['nama_pengapprove'] ?>
                    </td>

                  <?php }else if($row_onproccess['status_approve'] == 'final approved'){ ?>

                    <td style="color: green; font-weight: bold">
                      <?php echo '- '.$row_onproccess['status_approve'].' by '.$row_onproccess['approved_by'].' -'.'<br>'.$row_onproccess['nama_pengapprove'] ?>
                    </td>

                  <?php } ?>
                  <!-- / Kolom Status Approve -->

                  <!-- Kolom Next Approve -->
                  <td style="font-weight: bold; text-align: center; color: orange">
                    <?php  

                      $level_pengaju = $row_onproccess['level_pengaju'];
                      $status_approve = $row_onproccess['status_approve'];
                      $approved_by = $row_onproccess['approved_by'];
                      $wilayah = $row_onproccess['wilayah'];
                      $dept_tujuan = $row_onproccess['dept_tujuan'];
                      $direktur_tujuan = $row_onproccess['direktur_tujuan'];
                      $direktur_asal = $row_onproccess['direktur_asal'];
                      $kadiv_tujuan = $row_onproccess['kadiv_tujuan'];
                      $kadiv_asal = $row_onproccess['kadiv_asal'];
                      $jalur_khusus = $row_onproccess['jalur_khusus'];

                      if($level_pengaju == 'ADCO' AND $status_approve=='on proccess' OR $level_pengaju=='ADCOLL' AND $status_approve=='on proccess' OR $level_pengaju=='CMC' AND $status_approve=='on proccess' OR $level_pengaju=='ADD-CABANG' AND $status_approve=='on proccess'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$cabang' AND level='Branch Manager'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Kacab';

                      }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='kacab' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='kacab' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='kacab' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='kacab'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE cabang='$wilayah' AND level='Area Manager'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Kawil';

                      }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus=='' OR 
                      $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus=='' OR 
                      $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus=='' OR 
                      $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus==''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'PIC Dept Head';

                      }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus != '' OR 
                      $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus != '' OR 
                      $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus != '' OR 
                      $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='kawil' AND $jalur_khusus != ''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head' AND jabatan_khusus='$jalur_khusus'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'PIC Dept Head';

                      }elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!='' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!='' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!='' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan!=''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$kadiv_tujuan' AND level='Division Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Division Head';

                      }elseif(
                        $level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal=='' OR 
                        $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal=='' OR 
                        $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal=='' OR 
                        $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal==''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';

                      }elseif(
                        $level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal!='' OR 
                        $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal!='' OR 
                        $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal!='' OR 
                        $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $kadiv_tujuan=='' AND $direktur_asal!=''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_asal' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';

                      }elseif(
                        $level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal!='' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal!='' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal!='' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal!=''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_asal' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';

                      }elseif(
                        $level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal=='' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal=='' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal=='' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='division head' AND $direktur_asal==''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';

                      }elseif(
                        $level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='director pengaju' OR 
                        $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='director pengaju' OR 
                        $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='director pengaju' OR 
                        $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='director pengaju'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_tujuan' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';
                      }

                      elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='director' OR 
                      $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='director' OR 
                      $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='director' OR 
                      $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='director'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='Director Finance'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director Finance';
                      }

                      elseif($level_pengaju == 'ADCO' AND $status_approve=='approved' AND $approved_by=='director finance' OR $level_pengaju == 'ADCOLL' AND $status_approve=='approved' AND $approved_by=='director finance' OR $level_pengaju == 'CMC' AND $status_approve=='approved' AND $approved_by=='director finance' OR $level_pengaju == 'ADD-CABANG' AND $status_approve=='approved' AND $approved_by=='director finance'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE level='President Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'President Director';
                      }

                      elseif($level_pengaju == 'Departement PIC' AND $status_approve=='on proccess'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$departemen' AND level='Department Head'")->row_array();
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

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='division head'){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE departemen='$dept_tujuan' AND level='Department Head'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'PIC Dept Head';

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $direktur_asal!=''){
                        $q_next = $this->db->query("SELECT * FROM tbl_user WHERE nama_lengkap='$direktur_asal' AND level='Director'")->row_array();
                        $nama_next = $q_next['nama_lengkap'];
                        $level_next = 'Director';

                      }elseif($level_pengaju == 'Departement PIC' AND $status_approve=='approved' AND $approved_by=='dept head pic' AND $direktur_asal==''){
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

                    <?php if($row_onproccess['status_approve'] == 'on proccess'){ ?>
                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-cancel"
                    data-id = "<?php echo $row_onproccess['id_pengajuan'] ?>"
                    id="pilih_cancel"
                    >
                      <i class="fa fa-times"></i> Cancel
                    </button>
                    <?php } ?>

                    <a href="<?php echo base_url().'p_on_proccess/detail/'.$row_onproccess['id_pengajuan'] ?>" class="btn btn-warning btn-xs">
                      <i class="fa fa-eye"></i> Detail
                    </a>

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
  <form action="<?php echo base_url().'p_on_proccess/hapus' ?>" method="post">
  <div class="modal fade" id="modal-cancel">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cancel Pengajuan?</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="id" id="id" hidden>

          <div class="form-group">
            <label for="alamat"></span> Alasan Cancel :</label>
            <textarea class="form-control" name="alasan_cancel" required></textarea>
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