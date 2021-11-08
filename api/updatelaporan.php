<?php
    header("Content-type:application/json");
    require ('koneksi.php');
    
    $id_lap = htmlspecialchars($_POST['id_laporan']);
    $idus=htmlspecialchars($_POST['id_user']);
    $pass=htmlspecialchars($_POST['password']);
    $idaer=htmlspecialchars($_POST['id_daerah']);
    $idperi=htmlspecialchars($_POST['id_hari']);
    $nsung=htmlspecialchars($_POST['nama_sungai']);
    $nbend=htmlspecialchars($_POST['nama_bendungan']);
    $intaka=htmlspecialchars($_POST['jumlah_intake_kanan']);
    $intaki=htmlspecialchars($_POST['jumlah_intake_kiri']);
    $jumde=htmlspecialchars($_POST['jumlah_debit']);
    $ltot=htmlspecialchars($_POST['l_total']);
    $leff=htmlspecialchars($_POST['l_eff']);

    $foto_lap = ""; //insertgambar

    $loka=htmlspecialchars($_POST['lokasi_laporan']);
    
    $q = mysqli_query($conn, "SELECT id_user,password from db_user where id_user = '$idus' AND password = '$pass'");
    $cek = mysqli_num_rows($q);
    if($cek == 1){
        $datalap = "SELECT * FROM `cth_laporan` WHERE id_laporan='$id_lap'";
        $exelap = mysqli_query($conn,$datalap);
        $ceklap = mysqli_num_rows($exelap);

        if($ceklap==0){
        echo json_encode(array("response"=>"Data tidak ditemukan","status"=>false));
        }else{
        
        $response = array(
            "response"=>"Gagal",
            "status"=>false
        );

        if (isset($_FILES['files'])) {
            $foto_lap = $_FILES['files']['name'];
            $file    = $_FILES['files']['tmp_name'];
            $filedest = dirname(__FILE__) . '/images/' . $foto_lap;
            if(move_uploaded_file($file, $filedest)){
                $response = array("response"=>"Sukses upload file","status"=>true);
            }else{
                $response = array("response"=>"Gagal upload file","status"=>false);
            }
        }
        
            $queri=mysqli_query($conn,"UPDATE `cth_laporan` SET `id_user`='$idus',`id_daerah`='$idaer', `id_hari` = '$idperi', `nama_sungai` = '$nsung', `nama_bendungan` = '$nbend', `intake_kanan` = '$intaka', 
            `intake_kiri` = '$intaki', `jumlah_debit` = '$jumde', `l_total` = '$ltot', `l_eff` = '$leff', `date_laporan` = CURRENT_DATE(), `jam_laporan` = CURRENT_TIME(), `foto_laporan` = '$foto_lap', 
            `lokasi_laporan` = '$loka', `status_laporan` = 'Belum dikonfirmasi' WHERE `cth_laporan`.`id_laporan` = $id_lap");
        
            if($queri){
            $response = array("response"=>"Sukses upload data","status"=>true);
            echo json_encode($response);
            }else{
            $response = array("response"=>"Gagal upload data","status"=>false);
            echo json_encode($response);
            }
        }
    }else{
        $response = array("response"=>"Silahkan login terlebih dahulu","status"=>false);
        echo json_encode($response);  
    }
?>