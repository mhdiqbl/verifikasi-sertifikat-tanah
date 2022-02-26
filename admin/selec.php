<?php 
session_start();
$id = $_SESSION['id'];
$nama = $_SESSION['nama'];
if (!isset($_SESSION["login"])) {
  header("Location: ../index.php");
  exit;
}

require '../conn/koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$id'");
if (mysqli_num_rows($result)===1) {
  $row = mysqli_fetch_assoc($result);
}

// cek apakah tombol submit sudah diklik belum
if (isset($_POST["submit"])) {

	// cek apakah data berhasil di tambahkan atau tidak
	if (tambah($_POST) > 0) {
		echo "<script>alert('data berhasil');
		document.location.href = 'tambah.php';
		</script>";
	}else{
		echo "<script>alert('data gagal');
		document.location.href = 'tambah.php';
		</script>";
	}
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>
<body>
        <form id="demo-form2" method="POST" action="" data-parsley-validate class="form-horizontal form-label-left">

        <div class="item form-group">
        <label class="col-form-label col-md-4 col-sm-3 label-align" for="no_sertifikat">Kode Buku Tanah
        </label>
        <div class="col-md-6 col-sm-6 ">
        <input class="form-control col-5" name="no_sertifikat">
        </div>
        </div>
        <div class="item form-group">
        <label class="col-form-label col-md-4 col-sm-3 label-align" for="id_hak">Tipe Hak
        </label>
        <div class="col-md-6 col-sm-6 ">
        <input class="form-control col-5" name="id_hak" list="hak">
        <datalist name="id_hak" id="hak">
        <?php
        $hak = query("SELECT * FROM hak_sertifikat");
        ?>
        <?php foreach ($hak as $d) : ?>
        <option value="<?= $d['id_hak'] ?>"><?= $d['nm_hak']?></option>
        <?php endforeach; ?>
        </datalist>
        </div>
        </div>
        <div class="item form-group">
        <label for="middle-name" for="id_desa" class="col-form-label col-md-4 col-sm-3 label-align">Desa</label>
        <div class="col-md-6 col-sm-6 ">
            <!-- <select class="js-example-basic-single" name="state"> -->
        <select class="select2" id="desa" name="id_desa">
        <?php
        $desa = query("SELECT * FROM desa");
        ?>
        <?php foreach ($desa as $ds) : ?>
        <option value="<?= $ds['id_desa']?>"><?= $ds['nm_desa']?></option>
        <?php endforeach; ?>
        </select>
        </div>
        </div>
        <div class="ln_solid"></div>
        <div class="item form-group">
        <div class="col-md-6 col-sm-6 offset-md-4">
        <button type="reset" name="reset" class="btn btn-warning"><i class="fa fa-undo"> Reset</i></button>
        <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-plus-square"> Submit</i></button>
        </div>
        </div>

        </form>
</body>

<script>
    $(document).ready(function() {
    $('.select2').select2();
});
</script>
</html>