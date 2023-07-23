<?php
session_start();

// Connection
$conn = mysqli_connect("localhost", "root", "", "nar_auto_cars");
if (!$conn) {
    die("Koneksi dengan Database Gagal: "
        . mysqli_connect_error());
}

// Function Login & Register
function register($data) {
    global $conn;

    // Inputan dari User di Masukkan Ke Variable
    // strtolowe untuk membuat semua huruf menjadi kecil
    $username = strtolower($data["username"]);
    // mysqli_real_escape_string untuk menampilkan karakter spesial ke database
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Query dari Database Untuk Mengecek Apakah Ada "Username" yang Sama atau Tidak
    $result = mysqli_query($conn, "SELECT username 
                                    FROM users
                                    WHERE username = '$username'");

    // Jika mysqli_fetch_assoc Menghasilkan nilai "True"
    if (mysqli_fetch_assoc($result)) {
        // echo "
        //     <script>
        //         alert('Username Sudah Terdaftar!')
        //     </script>
        // ";
        $_SESSION['errUser'] = "Username Sudah Terdaftar !!!";
        // Diberhentikan Fungsi if Agar Fungsi Dibawahnya Tidak Dijalankan
        return false;
    }

    // Mengecek Apakah Retype Password Sama atau Tidak
    if ($password !== $password2) {
        // echo "
        //     <script>
        //         alert('Confirm Password Tidak Sesuai!')
        //     </script>
        // ";
        $_SESSION['errPass'] = "Konfirmasi Password Tidak Sesuai !!!";
        // Diberhentikan Fungsi if Agar Fungsi Dibawahnya Tidak Dijalankan
        return false;
    }

    // Meng-enkripsi Password
    // $passwordEnkripsi = password_hash($password, PASSWORD_DEFAULT);
    
    // Menambahkan "User" Baru ke dalam Database
    $query = "INSERT INTO users
                VALUES
                ('', '$username', '$password', 'user')";

    mysqli_query($conn, $query);

    // Untuk Mengetahui Jumlah Baris pada Tabel, Jika berhasil Angka "1", Gagal Angka "0"
    return mysqli_affected_rows($conn);
}

function login($data) {
    global $conn;

    // Inputan dari User di Masukkan Ke Variable
    $username = $data["username"];
    $password = $data["password"];

    // Query dari Database Untuk Mengecek Apakah "Username" Sesuai Dengan yang di Database atau Tidak
    $result = mysqli_query($conn, "SELECT *
                                    FROM users
                                    WHERE username = '$username'");

    // Jika Ada Baris yang Sama Dengan "$result" Maka Akan di Cek Username Sama atau Tidak
    if (mysqli_num_rows($result) == true) {
        // Cek Apakah Password Sama atau Tidak
        $check = mysqli_fetch_assoc($result);
        if ($password == $check["password"]) {
            // Memasukkan "level" ke SESSION
            $_SESSION["level"] = $check["level"];
            // Cek Apakah yang Login "Admin" atau "User"
            if ("admin" == $check["level"]) {
                header("Location: /Web-Dealer/productList-admin");
                exit;
            } else if ("user" == $check["level"]) {
                header("Location: /Web-Dealer/");
                exit;
            }
        }
    }

    // Jika Ada Username atau Password yang Tidak Sesuai Dengan Database Maka Akan Menjalankan Return
    return false;
}

function addProduct($data) {
    global $conn;

    // Inputan dari User di Masukkan Ke Variable
    $name = $data["name"];
    $year = $data["year"];
    $type = $data["type"];
    $price = $data["price"];
    $image = uploadData();

    // Jika Gambar Gagal Diupload Maka Tidak akan Masuk ke Database
    if (!$image) {
        return false;
    }

    $query = "INSERT INTO productlist
                VALUES 
                ('', '$image', '$name', '$year', '$type', $price)";

    mysqli_query($conn, $query);

    // Untuk Mengetahui Jumlah Baris pada Tabel, Jika berhasil Angka "1", Gagal Angka "-1"
    return mysqli_affected_rows($conn);
}

function uploadData() {
    global $conn;

    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $error = $_FILES["image"]["error"];
    $tmpName = $_FILES["image"]["tmp_name"];

    // Mengecek Apakah Tidak Ada Gambar yang Diupload
    // 4 Adalah Error yang Menunjukkan Bahwa Tidak Ada Gambar Yang Diupload
    if ($error === 4) {
        // echo "<script>
        //         alert('Pilih Gambar Telebih Dahulu !!!');
        //     </script>";
        $_SESSION['errSelectImg'] = "Pilih Gambar Telebih Dahulu !!!";
        return false;
    }

    // Mengecek Apakah yang Diupload Berupa Gambar
    $validExt = ['jpg', 'jpeg', 'png'];
    // Mengambil Ekstensi Gambar
    $getExtFromFileName = explode('.', $fileName);
    // Lalu Diubah ke Huruf Kecil Semua
    // Mengambil String Paling Akhir == jpg/jpeg/png
    $getExtFromFileName = strtolower(end($getExtFromFileName));
    // Jika Extension dari User Tidak Sama Dengan '$validExt' Akan Menghasilkan False
    if (!in_array($getExtFromFileName, $validExt)) {
        // echo "<script>
        //         alert('Tolong Upload File Dengan Format jpg, jpeg, png !!!');
        //     </script>";
        $_SESSION['errTrueFormat'] = "Tolong Upload File Dengan Format '.jpg', '.jpeg' atau '.png' !!!";
        return false;
    }
    
    // Mengecek Jika Ukuran Gambar Terlalu Besar dari 1MB
    if ($fileSize > 999999) {
        // echo "<script>
        //         alert('Ukuran Gambar Terlalu Besar Maks. 1MB !!!');
        //     </script>";
        $_SESSION['errImgSize'] = "Ukuran Gambar Terlalu Besar Maks. 1MB !!!";
        return false;
    }

    // Mengecek Apakah Ada Nama Gambar yang Sama Dengan yang di Database
    $result = mysqli_query($conn, "SELECT image
                                    FROM productlist
                                    WHERE image = '$fileName'");
    // Jika Ada Nama yang Sama Maka Jalankan IF-nya
    if (mysqli_fetch_assoc($result)) {
        // Generate Nama Gambar Baru Agar Tidak Tertimpa
        $newFileName = uniqid() . '.' . $getExtFromFileName;
        move_uploaded_file($tmpName, 'Assets/Upload/' . $newFileName);

        return $newFileName;
    }
    // Jika Tidak Maka Akan Menggunakan Nama Tersebut Tanpa Merubah Nama File-nya
    move_uploaded_file($tmpName, 'Assets/Upload/' . $fileName);

    return $fileName;
}

function deleteDataNImg($queryData, $queryDelImg) {
    global $conn;

    // Memanggil Database 
    $file = mysqli_fetch_assoc(mysqli_query($conn, $queryDelImg));
    // Delete Gambar dari Folder Assets/Upload/
    unlink('Assets/Upload/' . $file['image']);

    // Delete Data di Database
    mysqli_query($conn, $queryData);

    return mysqli_affected_rows($conn);
}

// Function For Show Data
function showData($query) {
    global $conn;

    $result = mysqli_query($conn, $query);
    $resultset = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $resultset[] = $row;
    }

    return $resultset;
}

function deleteData($query) {
    global $conn;

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Function For Search Data
function searchData($table, $data) {
    $query = "SELECT * FROM $table
                WHERE  
                name LIKE '%$data%'
            ";
    return showData($query);
}

// Function For Chat Form
function message($data) {
    global $conn;

    // Inputan dari User di Masukkan Ke Variable
    $name = $data["name"];
    $email = $data["email"];
    $message = $data["message"];

    // Menambahkan "Pesan" Baru ke dalam Database
    $query = "INSERT INTO chat
                VALUES
                ('', '$name', '$email', '$message')";

    mysqli_query($conn, $query);

    // Untuk Mengetahui Jumlah Baris pada Tabel, Jika berhasil Angka "1", Gagal Angka "-1"
    return mysqli_affected_rows($conn);
}

//
function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}