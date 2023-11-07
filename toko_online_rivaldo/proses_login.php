<?php 
    if($_POST){
      $username = $_POST['username'];
      $password = $_POST['password'];
      if(empty($username)){
        echo "<script> alert('Maaf username Tidak Boleh Kosong');location.href='login.php' </script>";
      }
      elseif(empty($password)){
        echo "<script> alert('Maaf password Tidak Boleh Kosong');location.href='login.php' </script>";
        
      }
      else{
        
        include "koneksi.php";
        $qry_login = mysqli_query($conn,"select * from pelanggan where username = '".$username."' and password = '".$password."'");
        if(mysqli_num_rows($qry_login)>0){
          $dt_login = mysqli_fetch_array($qry_login);
          session_start();
          $_SESSION['id_pelanggan'] = $dt_login['id_pelanggan'];
              $_SESSION['nama'] = $dt_login['nama'];
              $_SESSION['status_login'] = "true";
              
              if($dt_login['role']=="pelanggan"){
                  header("location: index.php");
              }
              elseif($dt_login['role']=="petugas"){
                  header("location: ../toko_online_rivaldo/akses_petugas/index.php");
              }
              
            }
            else{
              echo "<script> alert('username dan password tidak benar');location.href='login.php'; </script>";
              session_destroy();
            }
        }
    }   
?>
