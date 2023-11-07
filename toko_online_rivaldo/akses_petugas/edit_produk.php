<?php 
    include '../koneksi.php';
    session_start();
    $qry_i = mysqli_query($conn,"select * from pelanggan where id_pelanggan = '".$_SESSION['id_pelanggan']."'");
    $fetch_i = mysqli_fetch_array($qry_i);
    if($fetch_i['role']=="pelanggan"){
        echo "<script> alert('Anda Bukan Petugas');location.href='index.php' </script>";
    }

    if(isset($_POST['edit_product'])){
        $id_produk = $_POST['edit_product'];
        $nama_barang = $_POST['nama_barang'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $jenis = $_POST['jenis'];
        
        // Handle photo update
        if(isset($_FILES['foto']) && !empty($_FILES['foto']['tmp_name'])) {
            $foto_tmp = $_FILES['foto']['tmp_name'];
            $nama_foto = uniqid() . '.jpg';
            $dir = "../foto_produk/" . $nama_foto;
            move_uploaded_file($foto_tmp, $dir);
        } else {
            // If no new photo is uploaded, use the existing photo filename
            $nama_foto = $_POST['existing_foto'];
        }

        if(empty($nama_barang) || empty($deskripsi) || empty($harga)){
            echo "<script> alert('Maaf, Nama, Deskripsi, dan Harga tidak boleh kosong.');location.href='produk.php' </script>";
        } else {
            $update_produk = mysqli_query($conn, "UPDATE produk SET nama_produk='$nama_barang', deskripsi='$deskripsi', harga='$harga', jenis='$jenis', foto_produk='$nama_foto' WHERE id_produk='$id_produk'");
            if($update_produk){
                echo "<script> alert('Edit produk berhasil');location.href='index.php' </script>";
            } else {
                echo "<script> alert('Edit produk gagal');location.href='produk.php' </script>";
            }
        }
    }

    // Load product data for editing
    $edit_id = $_GET['id_produk'];
    $qry_edit = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$edit_id'");
    $fetch_edit = mysqli_fetch_array($qry_edit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit Produk</title>
</head>
<body>
<div class="card">
    <h4 class="card-header">Edit Produk</h4>
    <div class="card-body">
        <form action="edit_produk.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="edit_product" value="<?php echo $edit_id; ?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                <input name="nama_barang" type="text" class="form-control" value="<?php echo $fetch_edit['nama_produk']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Deskripsi</label>
                <input name="deskripsi" type="text" class="form-control" value="<?php echo $fetch_edit['deskripsi']; ?>">
            </div>
            <div class="mb-3">
        <label class="form-label">Foto</label>
        <input type="file" multiple="multiple" name="foto" id="foto" value="<?php echo $fetch_edit['foto_produk']?>" class="form-control" accept=".jpg .jpeg .png">
      </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Harga</label>
                <input name="harga" type="text" class="form-control" value="<?php echo $fetch_edit['harga']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Jenis</label>
                <select name="jenis">
                    <option value="fashion" <?php if($fetch_edit['jenis'] == 'fashion') echo 'selected'; ?>>Fashion</option>
                    <option value="elektronik" <?php if($fetch_edit['jenis'] == 'elektronik') echo 'selected'; ?>>Elektronik</option>
                    <option value="makanan/minuman" <?php if($fetch_edit['jenis'] == 'makanan/minuman') echo 'selected'; ?>>Makanan / Minuman</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
</body>
</html>
