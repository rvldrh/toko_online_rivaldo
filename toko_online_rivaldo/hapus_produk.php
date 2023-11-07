<?php
include "koneksi.php";

// Periksa apakah ada ID keranjang yang akan dihapus di URL
if (isset($_GET['id_keranjang'])) {
    $idKeranjangYangDihapus = $_GET['id_keranjang'];

    // Query DELETE untuk menghapus produk dari tabel keranjang berdasarkan ID keranjang
    $query = mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = '$idKeranjangYangDihapus'");

    if ($query) {
        // Redirect kembali ke halaman keranjang belanja atau halaman lain jika penghapusan berhasil
        header('Location: tampil2.php'); // Ganti "tampil2.php" dengan halaman yang sesuai
    } else {
        // Redirect dengan pesan kesalahan jika penghapusan gagal
        header('Location: tampil2.php?error=1'); // Ganti "tampil2.php" dengan halaman yang sesuai
    }
} else {
    // Redirect dengan pesan kesalahan jika ID keranjang tidak ada di URL
    header('Location: tampil2.php?error=2'); // Ganti "tampil2.php" dengan halaman yang sesuai
}
?>
