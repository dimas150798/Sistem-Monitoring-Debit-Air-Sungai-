<?php
    header("Content-type:application/json");
    require 'koneksi.php';
    $idus=htmlspecialchars($_POST['id_user']);
    $pass=htmlspecialchars($_POST['password']);
    $id_lap = htmlspecialchars($_POST['id_laporan']);

    $q = mysqli_query($conn, "SELECT id_user,password from db_user where id_user = '$idus' AND password = '$pass'");
    $cek = mysqli_num_rows($q);
    if($cek == 1){
        $delete = "DELETE FROM `cth_laporan` WHERE id_laporan=$id_lap";
        $exedelete = mysqli_query($conn,$delete);

        $respose = array();
        if($exedelete > 0){
        echo json_encode(array("response"=>"Success","status"=>true));
        }else{
        echo json_encode(array("response"=>"Data tidak ditemukan","status"=>false));
        }
    }else{
        $response = array("response"=>"Silahkan login terlebih dahulu","status"=>false);
        echo json_encode($response);
    }
    
    
?>