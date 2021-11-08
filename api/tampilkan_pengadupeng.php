<?php
    header("Content-type:application/json");
    require 'koneksi.php';
    $idus=htmlspecialchars($_POST['id_user']);
    $pass=htmlspecialchars($_POST['password']);
    $q = mysqli_query($conn, "SELECT id_user,password from db_user where id_user = '$idus' AND password = '$pass'");
    $cek = mysqli_num_rows($q);
    if($cek == 1){
        $query = "SELECT * FROM `db_pengaduan` WHERE id_user='$idus' AND status_pengaduan IN ('Belum Direspon','Direspon')";
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