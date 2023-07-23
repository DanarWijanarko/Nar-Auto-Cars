<?php

// Connection
$conn = mysqli_connect("localhost", "root", "");
if (!$conn) {
    die("Koneksi ke Database Gagal : "
        . mysqli_connect_error());
}

// Create Database
$query = "CREATE DATABASE IF NOT EXISTS nar_auto_cars";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query Error : "
        . mysqli_connect_error());
} else {
    echo "Database <b>'nar_auto_cars'</b> Berhasil Dibuat !!! <br>";
}

// Select Database
$result = mysqli_select_db($conn, "nar_auto_cars");
if (!$result) {
    die("Query Error : "
        . mysqli_error($conn));
} else {
    echo "Database <b>'nar_auto_cars'</b> Berhasil Dipilih !!! <br>";
}

// Drop Table Chat If Exists
$query = "DROP TABLE IF EXISTS chat";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query Error: "
        . mysqli_error($conn));
} else {
    echo "Tabel <b>'chat'</b> Berhasil Dihapus !!! <br>";
}

// Create Table Chat
$query = "CREATE TABLE chat
            (id INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            message TEXT(999) NOT NULL,
            PRIMARY KEY (id)
        )";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query Error: "
        . mysqli_error($conn));
} else {
    echo "Tabel <b>'chat'</b> Berhasil Dibuat !!! <br>";
}

// Insert Data Table Chat
$query = "INSERT INTO chat VALUES
            ('', 'Lala', 'lala@gmail.com', 'Halooo')";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query Error: "
        . mysqli_error($conn));
} else {
    echo "Tabel <b>'chat'</b> Berhasil Diisi !!! <br>";
}

// Drop Table productlist If Exists
$query = "DROP TABLE IF EXISTS productlist";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query Error: "
        . mysqli_error($conn));
} else {
    echo "Tabel <b>'productlist'</b> Berhasil Dihapus !!! <br>";
}

// Create Table productlist
$query = "CREATE TABLE productlist
            (id INT(11) NOT NULL AUTO_INCREMENT,
            image TEXT(255) NOT NULL,
            name VARCHAR(255) NOT NULL,
            year VARCHAR(11) NOT NULL,
            type VARCHAR(255) NOT NULL,
            price INT(50) NOT NULL,
            PRIMARY KEY (id)
        )";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query Error: "
        . mysqli_error($conn));
} else {
    echo "Tabel <b>'productlist'</b> Berhasil Dibuat !!! <br>";
}

// Insert Data Table productlist
$query = "INSERT INTO productlist VALUES
            ('', 'img/brio/brio-car-type-smt.png', 'New Honda Brio Satya', '2023', 'S M/T', 165900000),
            ('', 'img/brio/brio-car-ecvt.png', 'New Honda Brio Satya', '2023', 'E CVT', 191900000),
            ('', 'img/brio/brio-car-type-rscvt.png', 'New Honda Brio Satya', '2023', 'RS CVT', 243900000),
            ('', 'img/brv/brv-car-type-smt.png', 'All New Honda BR-V', '2023', 'S M/T', 287800000),
            ('', 'img/brv/brv-car-type-ecvt.png', 'All New Honda BR-V', '2023', 'E CVT', 312000000),
            ('', 'img/brv/brv-car-type-prescvt.png', 'All New Honda BR-V', '2023', 'Prestige CVT', 335000000),
            ('', 'img/brv/brv-car-type-presSensing.png', 'All New Honda BR-V', '2023', 'Prestige with Honda Sensing', 355000000),
            ('', 'img/civic/civic-ourProduct.png', 'All New Honda Civic Type R', '2023', '6 M/T', 1399000000),
            ('', 'img/crv/crv-car-type-vtec.png', 'New Honda CR-V', '2023', '2.0L i-VTEC', 525300000),
            ('', 'img/crv/crv-car-type-turbo.png', 'New Honda CR-V', '2023', '1.5L Turbo', 606300000),
            ('', 'img/crv/crv-car-type-presTurbo.png', 'New Honda CR-V', '2023', 'Prestige Turbo', 669600000),
            ('', 'img/crv/crv-car-type-black.png', 'New Honda CR-V', '2023', 'Black Edition', 684600000),
            ('', 'img/hrv/hrv-car-type-scvt.png', 'All New Honda HR-V', '2023', 'S CVT', 375900000),
            ('', 'img/hrv/hrv-car-type-ecvt.png', 'All New Honda HR-V', '2023', 'E CVT', 395900000),
            ('', 'img/hrv/hrv-car-type-secvt.png', 'All New Honda HR-V', '2023', 'SE CVT', 416100000),
            ('', 'img/hrv/hrv-car-type-turbo.png', 'All New Honda HR-V', '2023', 'TURBO RS', 529900000),
            ('', 'img/mobilio/mobilio-car-type.png', 'New Honda Mobilio', '2023', 'S M/T', 235900000)";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query Error: "
        . mysqli_error($conn));
} else {
    echo "Tabel <b>'productlist'</b> Berhasil Diisi !!! <br>";
}

// Drop Table users If Exists
$query = "DROP TABLE IF EXISTS users";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query Error: "
        . mysqli_error($conn));
} else {
    echo "Tabel <b>'users'</b> Berhasil Dihapus !!! <br>";
}

// Create Table users
$query = "CREATE TABLE users
            (id INT(11) NOT NULL AUTO_INCREMENT,
            username VARCHAR(50) NOT NULL,
            password VARCHAR(50) NOT NULL,
            level VARCHAR(10) NOT NULL,
            PRIMARY KEY (id)
        )";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query Error: "
        . mysqli_error($conn));
} else {
    echo "Tabel <b>'users'</b> Berhasil Dibuat !!! <br>";
}

// Insert Data Table users
$query = "INSERT INTO users VALUES
            ('', 'admin', 'admin', 'admin'),
            ('', 'user', 'user', 'user')";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query Error: "
        . mysqli_error($conn));
} else {
    echo "Tabel <b>'users'</b> Berhasil Diisi !!! <br>";
}

mysqli_close($conn);