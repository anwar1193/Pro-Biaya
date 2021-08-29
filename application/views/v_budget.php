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
        Data Budget <?php echo $cabang; ?> -
        <?php 
          if($cabang=='HEAD OFFICE'){
            echo $departemen;
          }else{
            echo $level;
          }
        ?>
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

                  <td style="text-align: right;"><?php echo number_format($row_budget['sep20_awal'],0,',','.') ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_budget['sep20_realisasi'],0,',','.') ?></td>

                  <?php if(substr($row_budget['sep20_akhir'], 0,1) == '-'){ ?>
                    <td style="text-align: right; color: red; font-weight: bold"><?php echo number_format($row_budget['sep20_akhir'],0,',','.') ?></td>
                  <?php }else{ ?>
                    <td style="text-align: right;"><?php echo number_format($row_budget['sep20_akhir'],0,',','.') ?></td>
                  <?php } ?>

                  <td style="text-align: right;"><?php echo number_format($row_budget['okt20_awal'],0,',','.') ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_budget['okt20_realisasi'],0,',','.') ?></td>
                  <?php if(substr($row_budget['okt20_akhir'], 0,1) == '-'){ ?>
                    <td style="text-align: right; color: red; font-weight: bold"><?php echo number_format($row_budget['okt20_akhir'],0,',','.') ?></td>
                  <?php }else{ ?>
                    <td style="text-align: right;"><?php echo number_format($row_budget['okt20_akhir'],0,',','.') ?></td>
                  <?php } ?>

                  <td style="text-align: right;"><?php echo number_format($row_budget['nov20_awal'],0,',','.') ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_budget['nov20_realisasi'],0,',','.') ?></td>
                  <?php if(substr($row_budget['nov20_akhir'], 0,1) == '-'){ ?>
                    <td style="text-align: right; color: red; font-weight: bold"><?php echo number_format($row_budget['nov20_akhir'],0,',','.') ?></td>
                  <?php }else{ ?>
                    <td style="text-align: right;"><?php echo number_format($row_budget['nov20_akhir'],0,',','.') ?></td>
                  <?php } ?>

                  <td style="text-align: right;"><?php echo number_format($row_budget['des20_awal'],0,',','.') ?></td>
                  <td style="text-align: right;"><?php echo number_format($row_budget['des20_realisasi'],0,',','.') ?></td>
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

                  <td style="text-align: right;"><?php echo number_format($total_awal,0,',','.') ?></td>
                  <td style="text-align: right;"><?php echo number_format($total_realisasi,0,',','.') ?></td>
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
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- <script>

    $(document).ready(function(){

      // Rubah format angka javascript
      function rubah(angka){
         var reverse = angka.toString().split('').reverse().join(''),
         ribuan = reverse.match(/\d{1,3}/g);
         ribuan = ribuan.join(',').split('').reverse().join('');
         return ribuan;
      }

      function hitung_total_awal(){
        var total_awal = 0;

        $('#table_data tr').each(function(){
          total_awal += parseInt($(this).find('#t_awal').text());
        });

        isNaN(total_awal) ? $('#gt_awal').text(0) : $('#gt_awal').text(total_awal);

      }

      hitung_total_awal();

    });

  </script> -->

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