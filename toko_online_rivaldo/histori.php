<?php 
  session_start();
  if($_SESSION['status_login']!="true"){
      header("location: login.php");
  }
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
</head>
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
<body>
<section class="h-100 h-custom" style="background-color: #d2c9ff;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Histori Pembelian</h1>
                  </div>
                  <hr class="my-4">
                  <?php
                    include "koneksi.php";
                    $qryT = mysqli_query($conn,"SELECT * from detail_transaksi join produk on produk.id_produk = detail_transaksi.id_produk where id_pelanggan='".$_SESSION['id_pelanggan']."'");
                    while($fetchT = mysqli_fetch_array($qryT)){
                    if($fetchT==null){
                    echo "<script>alert('histori anda kosong');location.href='index.php'</script>";
        
                    
                  }
                  
                    ?>
                  <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img
                        src="/toko_online_rivaldo/foto_produk/<?=$fetchT['foto_produk']?>"
                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-3">
                        <h6 class="text-muted"><?=$fetchT['jenis']?></h6>
                      <h6 class="text-black mb-0"><?=$fetchT['nama_produk']?></h6>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                        <input id="form1" min="<?=$qty?>" max="<?=$qty?>" name="quantity" value="<?=$fetchT['qty']?>" type="number"
                        class="form-control form-control-sm" readonly />
                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h6 class="mb-0"><?=number_format($fetchT['subtotal'], 0, ',', '.')?></h6>
                      </div>
                    </div>
                    <?php 
                    }
                    ?>
                    <?php $totalPrice = 0; // Initialize total price

$qryT = mysqli_query($conn,"SELECT * FROM detail_transaksi JOIN produk ON produk.id_produk = detail_transaksi.id_produk WHERE id_pelanggan='".$_SESSION['id_pelanggan']."'");
if(mysqli_num_rows($qryT) == 0){
    echo "<script>alert('Histori Anda kosong'); location.href='index.php'</script>";
} else {
    while($fetchT = mysqli_fetch_array($qryT)){
        $totalPrice += $fetchT['subtotal']; // Add subtotal to total price
    }
  }?>
<hr class="my-4">
<div class="d-flex justify-content-between align-items-center mb-5">
  <h6 class="mb-0 text-muted">Total: <?=$totalPrice?></h6>
</div>

                  

                  <div class="pt-5">
                    <h6 class="mb-0"><a href="index.php" class="text-body"><i
                          class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>