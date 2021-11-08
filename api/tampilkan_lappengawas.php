<?php
    header("Content-type:application/json");
    require 'koneksi.php';
    $idus=htmlspecialchars($_POST['id_user']);
    
    $q = mysqli_query($conn, "SELECT id_user from db_user where id_user = '$idus'");
    $cek = mysqli_num_rows($q);
    if($cek == 1){
        $query = "SELECT * FROM `cth_laporan` WHERE id_user='$idus' AND status_laporan IN ('Belum dikonfirmasi','Salah')";
        $result = mysqli_query($conn,$query);
        $array_data = array();
        while($baris = mysqli_fetch_assoc($result))
        {
            $array_data[]=$baris;
        }

        echo json_encode($array_data); 
    }else{
        $response = array("response"=>"Silahkan login terlebih dahulu","status"=>false);
        echo json_encode($response);        
    }
?>