<?php
    header("Content-type:application/json");
    require ('koneksi.php');
    
    $idus=htmlspecialchars($_POST['id_user']); //form laporan
    $pass=htmlspecialchars($_POST['password']); //form laporan
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
        if($nsung==null || $nbend==null || $intaka==null || $intaki==null || $ltot==null || $leff==null){
    
            echo json_encode(array("response"=>"Mohon lengkapi data"));
        
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
    
            $queri=mysqli_query($conn,"INSERT INTO cth_laporan VALUES (null, '$idus','$idaer', '$idperi', '$nsung', '$nbend', '$intaka', '$intaki', '$jumde', 
            '$ltot', '$leff', curdate(),CURRENT_TIME(), '$foto_lap', '$loka','Belum dikonfirmasi')");
            
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