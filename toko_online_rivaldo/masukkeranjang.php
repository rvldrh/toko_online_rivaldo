<?php 
    // session_start();
    // if($_POST){
    //     include "koneksi.php";
    //     $qry_get_buku = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk = '".$_GET['id_produk']."'");
    //     $dt_buku = mysqli_fetch_array($qry_get_buku);
    //     $total = $dt_buku['harga'] * $_POST['qty'];
    //     $_SESSION['troli'][]=array(
    //         'id_produk'=>$dt_buku['id_produk'],
    //         'nama_produk'=>$dt_buku['nama_produk'],
    //         'harga' => $dt_buku['harga'],
    //         'foto' => $dt_buku['foto_produk'],
    //         'jenis' => $dt_buku['jenis'],
    //         'qty'=>$_POST['qty'],
    //         'total' => $total
    //     );
    // }
    
    // header('location: tampil.php');
    include "koneksi.php";
    session_start(); // Mulai session
    if($_SESSION['status_login']!="true"){
        echo "<script>alert('Silahkan login dulu');location.href='login.php'</script>";

    }
    else{
        $qry_p = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk = '".$_GET['id_produk']."'");
        $fetch = mysqli_fetch_array($qry_p);            // Ambil data produk yang dikirimkan melalui formulir
            $id_produk = $_GET['id_produk'];
            $qty = $_POST['qty'];
            $id_pelanggan = $_SESSION['id_pelanggan'];
            $harga = $fetch['harga'];
            $total = $harga * $qty;
        
            // Query untuk menambahkan produk ke tabel keranjang
            $query = mysqli_query($conn, "INSERT INTO keranjang (id_produk, subtotal, qty, id_pelanggan) VALUES ('$id_produk', '$total','$qty', '$id_pelanggan')");
        
        if ($_POST) {
            // Ambil informasi produk dari formulir atau database (jika menggunakan database)
            $productInfo = [
                'id_pelanggan' => $_SESSION['id_pelanggan'],
                'id_produk' => $_GET['id_produk'], // Menggunakan $_GET untuk mengambil id_produk dari URL
                'nama_produk' => $fetch['nama_produk'],
                'harga' => $fetch['harga'],
                'qty' => $_POST['qty'], // Perbaiki atribut type menjadi "number"
                'foto' => $fetch['foto_produk'], // Perbaiki nama kolom jika perlu
                'jenis' => $fetch['jenis'], // Perbaiki nama kolom jika perlu
                'total' => $fetch['harga'] * $_POST['qty']
                // Informasi lainnya sesuai kebutuhan
            ];
        // Simpan produk ke dalam session
        $_SESSION['cart'][] = $productInfo;
        
        header("location: tampil2.php");
    }
}
?>