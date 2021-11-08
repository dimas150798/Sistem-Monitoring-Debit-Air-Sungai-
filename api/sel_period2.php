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


    //SELECT a.id_hari,a.periode FROM cth_hari a JOIN cth_laporan b ON a.id_hari = b.id_hari WHERE b.id_laporan=$id_lap
?>