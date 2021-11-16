<?php
    session_start();
    if(isset($_POST["judul_buku"])){
    include 'koneksi.php';

    $judul_buku = $_POST['judul_buku'];
    $penulis = $_POST['penulis'];
    $jenis_buku = $_POST['jenis_buku'];
    $gambar_buku = $_FILES['gambar_buku'];

    $message        = "";

    if($judul_buku==""){
        $message    = "Judul Buku di isi Bang!";
    }else if($penulis==""){
        $message    = "Penulis di isi Bang!";
    }else if($jenis_buku==""){
        $message    = "Jenis Buku di isi Bang!";
    }else if(isset($gambar_buku["tap_name"]) || $gambar_buku["tap_name"]==""){
        $message    = "Gambar Buku di isi Bang!";
    }else{

        $filePath = "upload".basename($gambar_buku["name"]);
        move_uploaded_file($gambar_buku["tap_name"], $filePath);

        $conn->query("INSERT INTO buku VALUES (null, '".$judul_buku."' , '".$penulis."' , '".$jenis_buku."' , '".$filePath."')");

        $message = "Buku berhasil ditambahkan";
    }
    $_SESSION["message"] = $message;
}

header("location:formulir.php");
exit();
?>