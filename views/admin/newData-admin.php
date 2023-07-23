<?php

// Jika "Admin" Belum Login Akan Diarahkan ke Halaman Login
// Jika yang Login "Admin" maka Admin Dapat Masuk Ke Halaman Admin maupun User
// jika yang Login "User" maka User Tidak Akan Bisa Masuk Ke Halaman Admin
if ($_SESSION["level"] != "admin") {
    header("Location: /Web-Dealer/login");
    exit;
}

if (isset($_POST["submit"])) {
    if (addProduct($_POST) > 0) {
        $_SESSION["berhasil"] = "Data Berhasil Ditambahkan !!!";
    } else {
        $_SESSION["gagal"] = "Data Gagal Ditambahkan !!!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Welcome Admin" ?>
    <?php include("partials/Head-admin.php"); ?>
</head>

<body>
    <?php include("partials/NavBar-admin.php") ?>

    <h1>Halaman ADD NEW DATA</h1>

    <form action="" method="post" class="newData" enctype="multipart/form-data">
        <?php if (isset($_SESSION["berhasil"])): ?>
            <div class='alert alert-success mt-2 mb-n2' role='alert'>
                <?= $_SESSION["berhasil"] ?>
                <?php unset($_SESSION["berhasil"]) ?>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION["gagal"])): ?>
            <div class='alert alert-danger mt-2 mb-n2' role='alert'>
                <?= $_SESSION["gagal"] ?>
                <?php unset($_SESSION["gagal"]) ?>
            </div>
        <?php endif ?>

        <?php if (isset($_SESSION['errSelectImg'])): ?>
            <div class="alert alert-danger mt-2 mb-n2" role="alert">
                <?= $_SESSION['errSelectImg'] ?>
                <?php unset($_SESSION['errSelectImg']); ?>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['errTrueFormat'])): ?>
            <div class="alert alert-danger mt-2 mb-n2" role="alert">
                <?= $_SESSION['errTrueFormat'] ?>
                <?php unset($_SESSION['errTrueFormat']); ?>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['errImgSize'])): ?>
            <div class="alert alert-danger mt-2 mb-n2" role="alert">
                <?= $_SESSION['errImgSize'] ?>
                <?php unset($_SESSION['errImgSize']); ?>
            </div>
        <?php endif ?>

        <div class="form-group my-2">
            <label for="carName">Car Name</label>
            <input type="text" class="form-control" name="name" 
                id="carName" placeholder="Enter email" autocomplete="off">
        </div>

        <div class="form-group my-2">
            <label for="year">Year</label>
            <input type="text" class="form-control" name="year" 
                id="year" placeholder="Enter Year" autocomplete="off">
        </div>

        <div class="form-group my-2">
            <label for="type">Car Type</label>
            <input type="text" class="form-control" name="type" 
                id="type" placeholder="Enter Car Type" autocomplete="off">
            <small id="type" class="form-text text-muted">
                e.g. "S M/T"
            </small>
        </div>

        <div class="form-group my-2">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price" 
                id="price" placeholder="Enter Price" autocomplete="off">
            <small id="price" class="form-text text-muted">
                e.g. "200000000".
            </small>
        </div>

        <div class="form-group my-2">
            <label for="img">Insert Image Product</label>
            <input type="file" class="form-control-file" name="image" id="img">
        </div>

        <button type="submit" name="submit" class="btn btn-primary mt-3">
            Submit
        </button>
    </form>
</body>

</html>