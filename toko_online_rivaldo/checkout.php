<?php
include "koneksi.php";
session_start();

// Initialize the $id_pelanggan variable
$id_pelanggan = $_SESSION['id_pelanggan'];

// Initialize an array to store the selected product IDs
$selectedProductIds = [];
$totalPriceChecked = 0;

// Check if there's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_products'])) {
    $selectedProductIds = $_POST['selected_products'];

    // Loop through the selected products and insert them into the detail_transaksi table and delete them from the keranjang table
    foreach ($selectedProductIds as $selectedProductId) {
        // You should validate $selectedProductId to ensure it's a valid product ID
        // You should also validate other inputs if needed

        // Fetch the product details from the keranjang table
        $query_cart = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_pelanggan = '$id_pelanggan' AND id_produk = '$selectedProductId'");
        $cartItem = mysqli_fetch_array($query_cart);
        print_r($cartItem);
        $qty = $cartItem['qty'];
        $subtotal = $cartItem['subtotal'];

        $totalPriceChecked += $subtotal;

        // Insert the product into detail_transaksi
        $query_insert = mysqli_query($conn, "INSERT INTO detail_transaksi (id_produk, qty, subtotal, id_pelanggan) VALUES ('$selectedProductId', '$qty', '$subtotal', '$id_pelanggan')");

        if (!$query_insert) {
            // Handle errors if insertion fails
            echo "Terjadi kesalahan dalam memasukkan detail transaksi.";
            exit();
        }

        // Delete the product from the keranjang
        $query_delete = mysqli_query($conn, "DELETE FROM keranjang WHERE id_pelanggan = '$id_pelanggan' AND id_produk = '$selectedProductId'");

        if (!$query_delete) {
            // Handle errors if deletion fails
            echo "Terjadi kesalahan dalam menghapus produk.";
            exit();
        }
    }
}

// Fetch data from the keranjang table based on the $id_pelanggan
// $query_cart = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_pelanggan = '$id_pelanggan");

// Fetch data from the keranjang table based on the $id_pelanggan
// $query_cart = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_pelanggan = '$id_pelanggan");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../toko_online_rivaldo/css/styles.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <title>Document</title>
    <style>
        @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}

.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;
}

.card-registration .select-arrow {
top: 13px;
}

.bg-grey {
background-color: #eae8e8;
}

@media (min-width: 992px) {
.card-registration-2 .bg-grey {
border-top-right-radius: 16px;
border-bottom-right-radius: 16px;
}
}

@media (max-width: 991px) {
.card-registration-2 .bg-grey {
border-bottom-left-radius: 16px;
border-bottom-right-radius: 16px;
}
}
    </style>
</head>
<body>
    <form action="histori.php" method="post" >

        <div class="col-lg-4 bg-grey">
            <div class="p-5">
                <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                <hr class="my-4">
                
                
                <h5 class="text-uppercase mb-3">Shipping</h5>

                <div class="mb-4 pb-2">
                    <select class="select">
                        <option value="1">Standard-Delivery- 20.000</option>
                        <option value="2">Cargo - 18.000</option>
                        <option value="3">Same Day - 40.000 </option>
                        <option value="4">Gak Di Kirim - Gratis</option>
                    </select>
                </div>
                
                <h5 class="text-uppercase mb-3">Masukkan alamat</h5>
                
                <div class="mb-5">
                    <div class="form-outline">
                        <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplea2">Masukkan alamat rumah anda</label>
                    </div>
                  </div>
                  
                  <hr class="my-4">
                  
                  <div class="d-flex justify-content-between mb-5">
                      <h5 class="text-uppercase">Harga total</h5>
                      <h5>Rp <?=number_format($totalPriceChecked, 0, ',', '.')?></h5>
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-dark btn-block btn-lg"
                    data-mdb-ripple-color="dark">Checkout</button>
                </form>

                </div>
              </div>
</body>
</html>
