<?php
    include "fungsi.php";

    // $row = count($_POST["datalaporan"]);
    // for($i=0; $i<$row.length ;$i++) {
    // mysqli_query($koneksi,"DELETE FROM cth_laporan WHERE id_laporan='" . $_POST["datalaporan"][$i] . "'");
    // }

    $id=$_GET['id'];
    
    mysqli_query($koneksi,"DELETE FROM cth_laporan WHERE id_daerah='$id'");


    header("location:KelolaPelaporan_pengawas.php");
?>