<?php
    header("Content-type:application/json");
    require ('koneksi.php');
    $idpengadu = htmlspecialchars($_POST['id_pengaduan']);
    $idus=htmlspecialchars($_POST['id_user']);
    $pass=htmlspecialchars($_POST['password']);
    $respon = htmlspecialchars($_POST['respon_pengaduan']);

    $q = mysqli_query($conn, "SELECT id_user,password from db_user where id_user = '$idus' AND password = '$pass'");
    $cek = mysqli_num_rows($q);
    if($cek == 1){
        $queri=mysqli_query($conn,"UPDATE `db_pengaduan` SET `respon_pengaduan`='$respon', `status_pengaduan`='Direspon' WHERE id_pengaduan='$idpengadu'");
        if($queri){
            echo json_encode(array("response"=>"Success","status"=>true));
        }else{
            echo json_encode(array("response"=>"Failed","status"=>false));
        }
    }else{
        $response = array("response"=>"Silahkan login terlebih dahulu","status"=>false);
        echo json_encode($response); 
    }

      
?>