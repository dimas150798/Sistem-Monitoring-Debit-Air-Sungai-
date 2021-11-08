<?php
    header("Content-type:application/json");
    require 'koneksi.php';
    $idaer=htmlspecialchars($_POST['id_daerah']);
    $idus=htmlspecialchars($_POST['id_user']);
    $pass=htmlspecialchars($_POST['password']);
    $q = mysqli_query($conn, "SELECT id_user,password from db_user where id_user = '$idus' AND password = '$pass'");
    $cek = mysqli_num_rows($q);
    if($cek == 1){
        $query = mysqli_query($conn,"SELECT * FROM `db_pengaduan` JOIN `db_user` ON db_pengaduan.id_user = db_user.id_user 
        WHERE db_pengaduan.id_daerah='$idaer' AND db_pengaduan.status_pengaduan='Belum Direspon'");
        $ceklap = mysqli_num_rows($query);
        if($ceklap!=0){
            $array_data = array();
            while($data = mysqli_fetch_assoc($query)){
            $array_data[]=$data;}
            echo json_encode($array_data);
        }else{
        echo json_encode(array());
        }

    }else{
        $response = array("response"=>"Silahkan login terlebih dahulu","status"=>false);
        echo json_encode($response); 
    }
    
    // query lain 
     
    // SELECT * FROM `db_pengaduan` JOIN `db_user` ON db_pengaduan.id_user = db_user.id_user 
    // WHERE db_pengaduan.id_daerah='$idaer' AND db_pengaduan.status_pengaduan='Belum direspon';
    
?>