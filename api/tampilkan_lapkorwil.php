<?php
    header("Content-type:application/json");
    require 'koneksi.php';

    $idus=htmlspecialchars($_POST['id_user']);
    $pass=htmlspecialchars($_POST['password']);
    $idaer=htmlspecialchars($_POST['id_daerah']);

    $q = mysqli_query($conn, "SELECT id_user,password from db_user where id_user = '$idus' AND password = '$pass'");
    $cek = mysqli_num_rows($q);
    if($cek == 1){
        $query = "SELECT * FROM `cth_laporan` JOIN `db_user` ON cth_laporan.id_user = db_user.id_user 
              WHERE cth_laporan.id_daerah='$idaer' AND cth_laporan.status_laporan='Belum dikonfirmasi';";
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
    

    //  querylain

    //  SELECT * FROM `cth_laporan` JOIN `db_user` ON cth_laporan.id_user = db_user.id_user 
    //  WHERE cth_laporan.id_daerah='$idaer' AND cth_laporan.status_laporan='Belum dikonfirmasi';

    //test
    //SELECT * FROM `cth_laporan` WHERE id_daerah='$idaer' AND status_laporan='Belum dikonfirmasi'
?>