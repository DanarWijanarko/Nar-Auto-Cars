<?php

// Jika "Admin" Belum Login Akan Diarahkan ke Halaman Login
// Jika yang Login "Admin" maka Admin Dapat Masuk Ke Halaman Admin maupun User
// jika yang Login "User" maka User Tidak Akan Bisa Masuk Ke Halaman Admin
if ($_SESSION["level"] != "admin") {
    header("Location: /Web-Dealer/login");
    exit;
}

$productList = showData("SELECT * FROM productlist");

// Jika 'id' Sudah Ada Pada Url Jalankan Function Didalamnya
if (isset($_GET["id"])) {
    $getId = $_GET["id"];
    $queryImg = "SELECT * FROM productlist WHERE id= $getId";
    $query = "DELETE FROM productlist WHERE id = $getId";
    // Jika Data yang Terpengaruh Lebih dari 0 Maka Jalankan Function
    if (deleteDataNImg($query, $queryImg) > 0) {
        header("Location: /Web-Dealer/productList-admin");
    } else {
        // Delete Gagal
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $title = "Welcome Admin"; ?>
    <?php include("partials/Head-admin.php"); ?>
</head>

<body>
    <?php include("partials/NavBar-admin.php"); ?>

    <h1>Halaman
        <?= ucfirst($_SESSION["level"]) ?>
    </h1>

    <div class="table-responsive-xxl px-5">
        <table class="table table-striped table-hover">
            <tr>
                <th class="text-center">No.</th>
                <th>Image</th>
                <th>Car Name</th>
                <th>Year</th>
                <th>Type</th>
                <th>Harga</th>
                <th class="text-center">Action</th>
            </tr>

            <?php $i = 1;
            foreach ($productList as $list): ?>
                <tr class="align-middle">
                    <td id="no" class="text-center">
                        <?= $i; ?>.
                    </td>
                    <td id="img">
                        <img src="<?= "Assets/Upload/" . $list["image"]; ?>">
                    </td>
                    <td>
                        <?= $list["name"]; ?>
                    </td>
                    <td id="year">
                        <?= $list["year"]; ?>
                    </td>
                    <td>
                        <?= $list["type"]; ?>
                    </td>
                    <td>
                        <?= "Rp. " . number_format($list["price"]); ?>
                    </td>
                    <td id="action">
                        <div class="hstack gap-2 mx-auto">
                            <a href="" class="btn p-0" data-bs-toggle="tooltip" 
                                data-bs-placement="top" data-bs-title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <div class="vr"></div>
                            <a href="/Web-Dealer/productList-admin?id=<?= $list["id"] ?>" class="btn p-0" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="Delete">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php $i++;
            endforeach ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
        crossorigin="anonymous"></script>

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>