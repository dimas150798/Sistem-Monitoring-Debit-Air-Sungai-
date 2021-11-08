<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header('Location: ../');
  }else if($_SESSION['id_akses'] != 2){
    if ($_SESSION['id_akses'] == 1) {
      header('Location: ../data_pupr/');
    }
  }
?>