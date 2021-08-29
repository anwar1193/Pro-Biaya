<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Memo Pengajuan</title>
	<style>
		.logo{
			position: absolute;
			width: 60px;
			height: auto;
		}

		.garis{
			border: 0;
			border-style: inset;
			border-top: 1px solid #000;
		}

		table,th,td{
			border-collapse: collapse;
		}
	</style>
</head>
<body>

	<h4 style="text-align: center;">Memo Internal</h4><br><br>
	<div class="col-sm-6 col-sm-offset-3" style="border:1px dotted gray; padding: 10px;">
    
    <table class="table" width="700px">
        <tr>
        <td>Nomor Memo</td>
        <td>:</td>
        <td><?= $data_memo['nomor_memo'] ?></td>
        </tr>

        <tr>
        <td>Kepada</td>
        <td>:</td>
        <td><?= $data_memo['kepada'] ?></td>
        </tr>

        <tr>
        <td>CC</td>
        <td>:</td>
        <td><?= $data_memo['cc'] ?></td>
        </tr>

        <tr>
        <td>Dari</td>
        <td>:</td>
        <td><?= $data_memo['dari'] ?></td>
        </tr>

        <tr>
        <td>Perihal</td>
        <td>:</td>
        <td><?= $data_memo['perihal'] ?></td>
        </tr>

        <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td><?= date('d-m-Y', strtotime($data_memo['tanggal_memo'])) ?></td>
        </tr>
    </table>

    <hr style="border-collapse: collapse;">

    Isi Memo : <br><br>

    <?= $data_memo['isi_memo'] ?>

    <!-- Tracking Approval Memo -->
    <table class="table" style="margin-top:50px">
    <tr>
        <th>Approval Memo</th>
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
    </table>
    <!-- Penutup Tracking Approval Memo -->


</body>
</html>