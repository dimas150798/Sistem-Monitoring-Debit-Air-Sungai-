<?php
    header("Content-type:application/json");
    require ('koneksi.php');
    $idus=htmlspecialchars($_POST['id_user']);
    $pass=htmlspecialchars($_POST['password']);
    $idaer=htmlspecialchars($_POST['id_daerah']);
    $nsung=htmlspecialchars($_POST['nama_sungaiPeng']);
    $nbend=htmlspecialchars($_POST['nama_bendunganPeng']);
    $peng = htmlspecialchars($_POST['pengaduan']);
    $gambarpeng    = "";
    $lokasi = htmlspecialchars($_POST['lokasi_pengaduan']);

    $q = mysqli_query($conn, "SELECT id_user,password from db_user where id_user = '$idus' AND password = '$pass'");
    $cek = mysqli_num_rows($q);
    if($cek == 1){
        
        if($nbend == null || $nsung==null || $peng==null){
            echo json_encode(array("response"=>"Mohon lengkapi data","status"=>false));
        }else{
        
            $response = array(
                "response"=>"Gagal",
                "status"=>false
            );
        if (isset($_FILES['files'])) {
            $gambarpeng = $_FILES['files']['name'];
            $file    = $_FILES['files']['tmp_name'];
            $filedest = dirname(__FILE__) . '/images/' . $gambarpeng;
            if(move_uploaded_file($file, $filedest)){
                $response = array("response"=>"Sukses upload file","status"=>true);
            }else{
                $response = array("response"=>"Gagal upload file","status"=>false);
            }
        }
        $queri=mysqli_query($conn,"INSERT INTO `db_pengaduan` 
        (`id_pengaduan`, `id_user`, `id_daerah`,`nama_sungaiPeng`, `nama_bendungPeng`, `pengaduan`, `foto_pengaduan`,`lokasi_pengaduan` , `respon_pengaduan`, `date_pengaduan`, `waktu_pengaduan`, `status_pengaduan`) 
        VALUES (null, '$idus', '$idaer','$nsung', '$nbend', '$peng', '$gambarpeng','$lokasi', ' ', curdate(), CURRENT_TIME(),'Belum Direspon')");

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

