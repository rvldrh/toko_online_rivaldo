<?php 
    include "../koneksi.php";
    session_start();
    $qry_i = mysqli_query($conn,"select * from pelanggan where id_pelanggan = '".$_SESSION['id_pelanggan']."'");
    $fetch_i = mysqli_fetch_array($qry_i);
    if($_SESSION['status_login']!="true"){
        header("location: ../login.php");
    }
    if($fetch_i['role']=="pelanggan"){
        echo "<script> alert('Anda Bukan Petugas');location.href='../index.php' </script>";
    }
    $qry_p = mysqli_query($conn,"select * from pelanggan where role='petugas'");
    $fetch_p = mysqli_fetch_array($qry_p);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../akses_petugas/../css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Akses Petugas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../produk.php">Tambah Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="../petugas.php">Tambah Petugas</a></li>
                        <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <header class="bg-light py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder" style="color: black;" >Selamat Datang <?=$fetch_p['nama']?></h1>
                    <p class="lead fw-normal mb-0" style="color: black;" >Silahkan pilih menu untuk bertugas</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                        
                        include "../koneksi.php";
                        $qry_produk = mysqli_query($conn,"select * from produk");
                        while($arr_produk=mysqli_fetch_array($qry_produk)){?>
                        <form action="in_ker.php?id_produk=<?=$arr_produk['id_produk']?>" method="post">
                            <div class="col mb-5" style="box-shadow: 4px 4px 5px -4px";>
                                <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="../foto_produk/<?=$arr_produk['foto_produk']?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?=$arr_produk['nama_produk']?></h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <p>Rp <?= number_format($arr_produk['harga'], 0, ',', '.') ?></p>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center d-flex justify-content-center">
                                <a href="edit_produk.php?id_produk=<?= $arr_produk['id_produk'] ?>" class="btn btn-outline-dark mt-auto mx-2" type="submit">Edit</a>
                                <a href="hapus_produk.php?id_produk=<?= $arr_produk['id_produk'] ?>" class="btn btn-outline-dark mt-auto mx-2" type="submit">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                    <?php
                        }?>
                </div>
            </div>
        </section>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
