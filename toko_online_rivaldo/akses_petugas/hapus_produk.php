<?php
include "../koneksi.php";
session_start();
if($_SESSION['status_login']!="true"){
    header("location: ../login.php");
}
$qry_i = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '" . $_SESSION['id_pelanggan'] . "'");
$fetch_i = mysqli_fetch_array($qry_i);
if ($fetch_i['role'] == "pelanggan") {
    echo "<script> alert('Anda Bukan Petugas');location.href='../index.php' </script>";
}
$qry_p = mysqli_query($conn, "SELECT * FROM pelanggan WHERE role='petugas'");
$fetch_p = mysqli_fetch_array($qry_p);

// Mengambil id_produk yang akan dihapus
if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];

    // Hapus produk dari database
    $delete_query = "DELETE FROM produk WHERE id_produk='$id_produk'";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        echo "<script>alert('Produk berhasil dihapus');location.href='edit_produk.php'</script>";
    } else {
        echo "<script>alert('Gagal menghapus produk');</script>";
    }
}
?>
