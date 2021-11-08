<?php
    header("Content-type:application/json");
    require('koneksi.php');
    $id_lap = htmlspecialchars($_POST['id_laporan']);
    $idus=htmlspecialchars($_POST['id_user']);
    $pass=htmlspecialchars($_POST['password']);
    $q = mysqli_query($conn, "SELECT id_user,password from db_user where id_user = '$idus' AND password = '$pass'");
    $cek = mysqli_num_rows($q);
    if($cek == 1){
        $queri=mysqli_query($conn,"UPDATE cth_laporan SET `status_laporan`='Salah' WHERE id_laporan=$id_lap");
        
        if($queri){
           echo json_encode(array("response"=>"Data terkirim untuk diperbarui","status"=>true));
        }else{
            echo json_encode(array("response"=>"Gagal, Silahkan coba lagi","status"=>false));
        } 
    }else{
        $response = array("response"=>"Silahkan login terlebih dahulu","status"=>false);
        echo json_encode($response); 
    }
    
?>