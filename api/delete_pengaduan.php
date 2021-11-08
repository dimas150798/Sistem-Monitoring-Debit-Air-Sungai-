<?php
    header("Content-type:application/json");
    require 'koneksi.php';
    $idpengadu = htmlspecialchars($_POST['id_pengaduan']);
    $idus=htmlspecialchars($_POST['id_user']);
    $pass=htmlspecialchars($_POST['password']);
    $q = mysqli_query($conn, "SELECT id_user,password from db_user where id_user = '$idus' AND password = '$pass'");
    $cek = mysqli_num_rows($q);
    if($cek == 1){
        $delete = "DELETE FROM `db_pengaduan` WHERE id_pengaduan='$idpengadu'";
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
    