<?php

// Jika "Admin" Belum Login Akan Diarahkan ke Halaman Login
// Jika yang Login "Admin" maka Admin Dapat Masuk Ke Halaman Admin maupun User
// jika yang Login "User" maka User Tidak Akan Bisa Masuk Ke Halaman Admin
if ($_SESSION["level"] != "admin") {
    header("Location: /Web-Dealer/login");
    exit;
}

$chatForm = showData("SELECT * FROM chat ORDER BY id DESC");

// Jika 'id' Sudah Ada Pada Url Jalankan Function Didalamnya
if (isset($_GET["id"])) {
    $getId = $_GET["id"];
    $query = "DELETE FROM chat WHERE id = $getId";
    // Jika Data yang Terpengaruh Lebih dari 0 Maka Jalankan Function
    if (deleteData($query) > 0) {
        header("Location: /Web-Dealer/chatForm-admin");
    } else {
        // Delete Gagal
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("partials/Head-admin.php"); ?>
    <title>Nar AutoCars | Welcome Admin</title>
</head>

<body>
    <?php include("partials/NavBar-admin.php") ?>

    <h1>Chat Form</h1>
    <div class="table-responsive-xxl px-5">
        <table class="table table-striped table-hover">
            <tr>
                <th class="text-center">No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th class="text-center">Action</th>
            </tr>

            <?php $i = 1;
            foreach ($chatForm as $cf): ?>
                <tr class="align-middle">
                    <td id="no" class="text-center">
                        <?= $i ?>.
                    </td>
                    <td id="name">
                        <?= $cf["name"] ?>
                    </td>
                    <td id="email">
                        <?= $cf["email"] ?>
                    </td>
                    <td id="message">
                        <?= $cf["message"] ?>
                    </td>
                    <td id="action" class="text-center">
                        <a href="/Web-Dealer/chatForm-admin?id=<?= $cf["id"] ?>">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php $i++;
            endforeach ?>
        </table>
    </div>
</body>

</html>