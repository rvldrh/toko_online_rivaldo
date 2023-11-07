<?php
    session_start();
    if($_SESSION['status_login']!="true"){
        echo "<script>alert('Anda belom login kok minta log out ');location.href='login.php'</script>";
    }
    else{
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
            session_destroy();
            echo "<script>alert('Anda berhasil logout ');location.href='index.php'</script>";
        } else {
            echo "<script>
                  if (confirm('Apakah Anda yakin ingin logout?')) {
                      location.href = 'logout.php?confirm=yes';
                  } else {
                      location.href = 'index.php';
                  }
                  </script>";
        }
    }
?>
