<?php
    header("Content-type:application/json");
    require 'koneksi.php';

    $idus=htmlspecialchars($_POST['id_user']);
    $pass=htmlspecialchars($_POST['password']);
    $jenis=htmlspecialchars($_POST['jenis']);
    $id_jenis=htmlspecialchars($_POST['id_jenis']);

    $table = ($jenis == "laporan" ? 'cth_laporan' : 'db_pengaduan'); 
    //  ifelse kondisi ? true : false 

    $q = mysqli_query($conn, "SELECT id_user,password from db_user where id_user = '$idus' AND password = '$pass'");
    $cek = mysqli_num_rows($q);
    if($cek == 1){
        $query = "SELECT status_".$jenis." FROM `".$table."` WHERE id_".$jenis."='$id_jenis';";
        $result = mysqli_query($conn,$query);
        $hasil = "";
        while($baris = mysqli_fetch_assoc($result))
        {
            $hasil=$baris['status_'.$jenis];
        }

        echo json_encode($hasil);
    }else{
        $response = array("response"=>"Silahkan login terlebih dahulu","status"=>false);
        echo json_encode($response); 
    }
?>
