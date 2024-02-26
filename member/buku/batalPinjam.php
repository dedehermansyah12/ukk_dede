<?php
require "../../config.php";

$Id = $_GET["id"];
if(batalPinjam($Id)) {
    echo "<script>
    alert('peminjaman berhasil dibatalkan!');
    document.location.href = 'daftarPinjam.php';
    </script>";
  }else {
    echo "<script>
    alert('peminjaman gagal dibatalkan!');
    document.location.href = 'daftarPinjam.php';
    </script>";
}
?>