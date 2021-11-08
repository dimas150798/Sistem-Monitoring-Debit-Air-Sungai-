<?php
    header("Content-type:application/json");
    require ('koneksi.php');
    $period=mysqli_query($conn, "SELECT * from cth_hari");
    $array_data = array();
    while($baris = mysqli_fetch_assoc($period))
    {
        $array_data[]=$baris;
    }

    echo json_encode($array_data);
?>