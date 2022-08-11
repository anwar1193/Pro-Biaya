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

    <!-- Ambil Data Flashdata berhasil untuk kata sweet alert -->
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan'); ?>"></div>

    <section class="content-header">
      <h1>
        Detail Pengajuan
        <small>PT Procar Int'l Finance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Pengajuan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="box">
            <div class="box-body">
              
              <div class="row">
                <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
                  
                  <h4 style="text-align: center;">Detail Pengajuan Biaya</h4>
                  <hr style="border-width: 2px; width: 200px">
                  
                  <table class="table">
                    <tr>
                      <th width="40%">Tanggal</th>
                      <th>:</th>
                      <td><?php echo date('d-m-Y', strtotime($data_pengajuan['tanggal'])) ?></td>
                    </tr>

                    <tr>
                      <th>Nomor Pengajuan</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['nomor_pengajuan'] ?></td>
                    </tr>

                    <tr>
                      <th>Nomor Invoice</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['nomor_invoice'] ?></td>
                    </tr>

                    <tr>
                      <th>Cabang</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['cabang'] ?></td>
                    </tr>

                    <tr>
                      <th>Bagian</th>
                      <th>:</th>
                      <td>
                        <?php 
                          // Yang tampil di view, field departemen update
                          $bagian = $data_pengajuan['bagian'];
                          $data_departemen = $this->M_master->tampil_data_where('tbl_departemen', array('nama_departemen' => $bagian))->row_array();
                          $nama_departemen_update = $data_departemen['nama_departemen_update'];
                          echo $nama_departemen_update;
                        ?>
                      </td>
                    </tr>

                    <tr>
                      <th>Jenis Biaya</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['jenis_biaya'] ?></td>
                    </tr>

                    <tr>
                      <th>Sub Biaya</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['sub_biaya'] ?></td>
                    </tr>

                    <tr>
                      <th>Keterangan</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['keterangan'] ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">Jumlah</th>
                      <th>:</th>
                      <td><?php echo number_format($data_pengajuan['jumlah'],0,',','.') ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">PPN</th>
                      <th>:</th>
                      <td><?php echo number_format($data_pengajuan['ppn'],0,',','.') ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">PPH23</th>
                      <th>:</th>
                      <td><?php echo number_format($data_pengajuan['pph23'],0,',','.') ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">PPH 4(2)</th>
                      <th>:</th>
                      <td><?php echo number_format($data_pengajuan['pph42'],0,',','.') ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">Total</th>
                      <th>:</th>
                      <td><?php echo number_format($data_pengajuan['total'],0,',','.') ?></td>
                    </tr>

                    <tr>
                      <th>Bank Penerima</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['bank_penerima'] ?></td>
                    </tr>

                    <tr>
                      <th>Nomor Rekening</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['norek_penerima'] ?></td>
                    </tr>

                    <tr>
                      <th>Atas Nama</th>
                      <th>:</th>
                      <td><?php echo $data_pengajuan['atas_nama'] ?></td>
                    </tr>

                    <!-- Data Perjalanan Dinas -->
                    <?php  
                      if($data_perdin['nama_pic'] != ''){
                    ?>

                    <tr style="background-color: orange">
                      <td colspan="3">
                        <b>Data Perjalanan Dinas</b>
                      </td>
                    </tr>

                    <tr>
                      <th>Nama PIC (Perjalanan Dinas)</th>
                      <th>:</th>
                      <td><?php echo $data_perdin['nama_pic'] ?></td>
                    </tr>

                    <tr>
                      <th>Lokasi Tujuan</th>
                      <th>:</th>
                      <td><?php echo $data_perdin['lokasi_tujuan'] ?></td>
                    </tr>

                    <tr>
                      <th>Tujuan Perjalanan Dinas</th>
                      <th>:</th>
                      <td><?php echo $data_perdin['tujuan_perdin'] ?></td>
                    </tr>

                    <tr>
                      <th>Tanggal Kunjungan</th>
                      <th>:</th>
                      <td><?php echo date('d-m-Y', strtotime($data_perdin['dari_tanggal'])) ?> s/d <?php echo date('d-m-Y', strtotime($data_perdin['ke_tanggal'])) ?></td>
                    </tr>

                    <tr>
                      <th>Lama Kunjungan</th>
                      <th>:</th>
                      <td><?php echo $data_perdin['lama_kunjungan'] ?></td>
                    </tr>

                    <tr>
                      <th>Transportasi Yang Digunakan</th>
                      <th>:</th>
                      <td><?php echo $data_perdin['transportasi_ket'] ?></td>
                    </tr>

                     <tr>
                      <th>Penginapan/Hotel</th>
                      <th>:</th>
                      <td><?php echo $data_perdin['penginapan_ket'] ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">Biaya Transportasi</th>
                      <th>:</th>
                      <td><?php echo number_format($data_perdin['transportasi'],0,',','.') ?> (Diisi Oleh HRD)</td>
                    </tr>

                    <tr>
                      <th style="text-align: right;">Biaya Penginapan</th>
                      <th>:</th>
                      <td><?php echo number_format($data_perdin['penginapan'],0,',','.') ?> (Diisi Oleh HRD)</td>
                    </tr>

                    <!-- <tr>
                      <th style="text-align: right;">Biaya Makan</th>
                      <th>:</th>
                      <td><?php echo number_format($data_perdin['makan'],0,',','.') ?></td>
                    </tr> -->

                    <tr>
                      <th style="text-align: right;">Biaya Lain-lain</th>
                      <th>:</th>
                      <td><?php echo number_format($data_perdin['lain_lain'],0, '.', ',') ?></td>
                    </tr>

                    <?php if($data_pengajuan['sub_biaya'] != 'Biaya Perjalanan Dinas'){ ?>
                      <tr>
                        <th>Jarak</th>
                        <th>:</th>
                        <td><?php echo $data_perdin['jarak'] ?></td>
                      </tr>

                      <tr>
                        <th>Nasabah</th>
                        <th>:</th>
                        <td>
                          <?php  
                            $nomor_pengajuan = $data_pengajuan['nomor_pengajuan'];
                            $q_nasabah = $this->db->query("SELECT * FROM tbl_nopin_perdin WHERE nomor_pengajuan='$nomor_pengajuan'");
                            $r_nasabah = $q_nasabah->result_array();
                          ?>
                            <table class="table table-bordered">
                              <tr style="background-color: orange">
                                <th>Nopin</th>
                                <th>Nama Nasabah</th>
                              </tr>
                            <?php foreach($r_nasabah as $row){ ?>
                              <tr>
                                <td><?php echo $row['nopin'] ?></td>
                                <td><?php echo $row['nama_nasabah'] ?></td>
                              </tr>
                            <?php } ?>
                            </table> 
                        </td>
                      </tr>

                    <?php } ?>

                    <?php } ?>

                    <!-- / Data Perjalanan Dinas -->


                    <!-- Data Pengajuan BBM -->
                    <?php  
                      $no_pengajuan = $data_pengajuan['nomor_pengajuan'];
                      $data_bbm = $this->db->query("SELECT * FROM tbl_pengajuan_bbm WHERE nomor_pengajuan='$no_pengajuan'")->row_array();

                      if($data_bbm['nopol'] != ''){
                    ?>

                    <tr style="background-color: orange">
                      <td colspan="3">
                        <b>Data Pengajuan BBM</b>
                      </td>
                    </tr>

                    <tr>
                      <th>Nomor Polisi</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['nopol'] ?></td>
                    </tr>

                    <tr>
                      <th>Jenis Kendaraan</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['jenis_kendaraan'] ?></td>
                    </tr>

                    <tr>
                      <th>Merk Kendaraan</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['merk_kendaraan'] ?></td>
                    </tr>

                    <tr>
                      <th>Kapasitas Silinder</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['kapasitas_silinder'] ?></td>
                    </tr>

                    <tr>
                      <th>Kilometer Pengajuan</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['kilometer_pengajuan'] ?></td>
                    </tr>

                    <tr>
                      <th>Keperluan Pengajuan BBM</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['keperluan_pengajuan_bbm'] ?></td>
                    </tr>

                    <tr>
                      <th>Jenis BBM</th>
                      <th>:</th>
                      <td><?php echo $data_bbm['jenis_bbm'] ?></td>
                    </tr>

                    <?php } ?>

                    <!-- / Data Pengajuan BBM -->

                    <tr>
                      <th>Berkas Pendukung</th>
                      <th>:</th>
                      <td>
                        <ul>
                          <?php foreach($data_file as $row_file){ ?>
                          <li>
                            <?php echo $row_file['nama_file'] ?>

                            <?php 
                              if(file_exists('file_upload/'.$row_file['file'])){
                            ?>

                              <a target="_blank" href="<?php echo base_url().'file_upload/'.$row_file['file'] ?>">Download</a>
                            
                            <?php }else{ ?>

                              <?php  
                                $nama_folder = substr($row_file['file'], 0, 10);
                              ?>

                              <a target="_blank" href="<?php echo base_url().'file_upload/'.$nama_folder.'/'.$row_file['file'] ?>">Download</a>

                            <?php } ?>

                          </li>
                          <?php } ?>
                        </ul>
                      </td>
                    </tr>

                    <tr>
                      <th>Tracking Approval</th>
                      <th>:</th>
                      <td>
                        <ul>
                          <?php foreach($data_approve_history as $row){ ?>

                            <?php if($row['status_approve'] == 'on proccess'){ ?>

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

                            <?php }else if($row['status_approve'] == 'rejected'){ ?>

                              <li style="color: red; font-weight: bold; margin-bottom: 5px">
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

                            <?php }else if($row['status_approve'] == 'final approved'){ ?>

                              <li style="color: green; font-weight: bold; margin-bottom: 5px">
                                <?php echo $row['status_approve'] ?> by <?php echo $row['approved_by'] ?><br>
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


                    <!-- Data Over Budget -->
                    <?php if($data_pengajuan['alasan_over_budget'] != ''){ ?>
                      <tr style="background-color: orange">
                        <th colspan="3">Keterangan (Over Budget)</th>
                      </tr>

                      <!-- Ambil Data Budget -->
                      <?php  
                        $cabang = $data_pengajuan['cabang'];
                        $departemen = $data_pengajuan['bagian'];
                        $sub_biaya = $data_pengajuan['sub_biaya'];
                        $tgl_pengajuan = $data_pengajuan['tanggal'];
                        $bulan_pengajuan = substr($tgl_pengajuan, 5,2);

                        $res_budget = $this->db->query("SELECT * FROM tbl_budget WHERE 
                                      cabang='$cabang' AND departemen='$departemen' AND sub_biaya='$sub_biaya'")->row_array();

                        if($bulan_pengajuan == '08'){
                          $saldo_awal = $res_budget['agu20_awal'];
                          $terpakai = $res_budget['agu20_realisasi'];
                          $saldo_akhir = $res_budget['agu20_akhir'];
                        }elseif($bulan_pengajuan == '09'){
                          $saldo_awal = $res_budget['sep20_awal'];
                          $terpakai = $res_budget['sep20_realisasi'];
                          $saldo_akhir = $res_budget['sep20_akhir'];
                        }elseif($bulan_pengajuan == '10'){
                          $saldo_awal = $res_budget['okt20_awal'];
                          $terpakai = $res_budget['okt20_realisasi'];
                          $saldo_akhir = $res_budget['okt20_akhir'];
                        }elseif($bulan_pengajuan == '11'){
                          $saldo_awal = $res_budget['nov20_awal'];
                          $terpakai = $res_budget['nov20_realisasi'];
                          $saldo_akhir = $res_budget['nov20_akhir'];
                        }elseif($bulan_pengajuan == '12'){
                          $saldo_awal = $res_budget['des20_awal'];
                          $terpakai = $res_budget['des20_realisasi'];
                          $saldo_akhir = $res_budget['des20_akhir'];
                        }

                      ?>

                      <tr>
                        <th>Saldo Budget Awal</th>
                        <th>:</th>
                        <td><?php echo number_format($saldo_awal, 0, '.', ',') ?></td>
                      </tr>

                      <tr>
                        <th>Saldo Terpakai</th>
                        <th>:</th>
                        <td><?php echo number_format($terpakai, 0, '.', ',') ?></td>
                      </tr>

                      <tr>
                        <th>Saldo Budget Akhir</th>
                        <th>:</th>
                        <td><?php echo number_format($saldo_akhir, 0, '.', ',') ?></td>
                      </tr>

                      <tr>
                        <th>Alasan Over Budget</th>
                        <th>:</th>
                        <td><?php echo $data_pengajuan['alasan_over_budget'] ?></td>
                      </tr>
                    <?php } ?>
                    <!-- / Data Over Budget -->

                  </table>

                </div>

              </div>

              <div class="row">

                <div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
                  
                  <span>
                    <a href="<?php echo base_url().'p_on_proccess/tambah_dokumen' ?>" class="btn btn-danger btn-xs">Kembali</a>
                  </span>

                  <!-- <span>
                    <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-pajak">
                      <i class="fa fa-edit"></i> Edit Pajak
                    </button>
                  </span> -->

                  <span>
                    <a href="<?php echo base_url().'p_on_proccess/edit_finance/'.$data_pengajuan['id_pengajuan'] ?>" class="btn btn-info btn-xs">
                      <i class="fa fa-edit"></i> Perbaiki
                    </a>
                  </span>

                </div>

              </div>

              

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal Pajak -->
  <form action="<?php echo base_url().'p_on_proccess/ubah_pajak' ?>" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="modal-pajak">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Pajak</h4>
        </div>
        <div class="modal-body">

          <input type="text" hidden name="nomor_pengajuan" value="<?php echo $data_pengajuan['nomor_pengajuan'] ?>">

          <input type="text" hidden name="id" value="<?php echo $data_pengajuan['id_pengajuan'] ?>">
          
          <div class="form-group">
            <label for="tanggal_bayar"></span> Jumlah :</label>
            <input type="number" name="jumlah" class="form-control input-sm" value="<?php echo $data_pengajuan['jumlah'] ?>" id="jumlah" pattern="[1-9]{20}" readonly>
          </div>

          <div class="form-group">
            <label for="ppn"></span> PPN :</label>
            <input type="number" name="ppn" class="form-control input-sm" value="<?php echo $data_pengajuan['ppn'] ?>" id="ppn" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="pph23"></span> PPH23 :</label>
            <input type="number" name="pph23" class="form-control input-sm" value="<?php echo $data_pengajuan['pph23'] ?>" id="pph23" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="pph42"></span> PPH4(2) :</label>
            <input type="number" name="pph42" class="form-control input-sm" value="<?php echo $data_pengajuan['pph42'] ?>" id="pph42" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="pph21"></span> PPH21 :</label>
            <input type="number" name="pph21" class="form-control input-sm" value="<?php echo $data_pengajuan['pph21'] ?>" id="pph21" pattern="[1-9]{20}">
          </div>

          <div class="form-group">
            <label for="total"></span> Total :</label>
            <input type="number" name="total" value="<?php echo $data_pengajuan['total'] ?>" id="total" hidden><br>

            <!-- Total Ada Separator Rupiah Nya -->
            <span id="total_rp" style="font-weight: bold; font-size: 20px; padding: 5px;">
              <?php echo number_format($data_pengajuan['total'],0,'.',',') ?>
            </span>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal"> Batal</button>
          <button type="submit" class="btn btn-sm btn-info"> Update</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </form>
  <!-- / Modal Pajak -->


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
        var jumlah = $('#jumlah').val();
        var ppn = $('#ppn').val();
        var pph23 = $('#pph23').val();
        var pph42 = $('#pph42').val();
        var pph21 = $('#pph21').val();

        total = (jumlah*1) + (ppn*1) - ((pph23*1) + (pph42*1) + (pph21*1)); //perkalian salah satu trik biar angka bisa ditambah
        $('#total').val(total);
        $('#total_rp').text(rubah(total));
      }

      // Panggil fungsi ubah data (realtime) saat form (price, qty, discount) di ketik / di klik
      $(document).on('keyup mouseup', '#jumlah, #ppn, #pph23 , #pph42 , #pph21', function(){
        hitung_otomatis();
      });

    });
  </script>
  <!-- / Script Hitung Total Otomatis -->


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