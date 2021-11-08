<?php
    header("Content-type:application/json");
    require ('koneksi.php');
    $idus=htmlspecialchars($_POST['id_user']);
    $usere=htmlspecialchars($_POST['username']);
    $password=htmlspecialchars($_POST['pass']);
    $pass1=htmlspecialchars($_POST['pass1']);
    $pass2=htmlspecialchars($_POST['pass2']);
    
    $dat = mysqli_query($conn, "SELECT * from `db_user` where `id_user`='$idus'");
    
    $data = mysqli_fetch_assoc($dat);
    if (password_verify($password, $data['password'])) {
        if ($pass1==$pass2) {
            $pass3 = password_hash($pass1,PASSWORD_DEFAULT);
            $query =mysqli_query($conn,"UPDATE `db_user` SET `username` = '$usere', `password` = '$pass3' WHERE `db_user`.`id_user` = '$idus';");
            if($query){
                echo json_encode(array("response"=>"Berhasil diperbarui","status"=>true));
            }else{
                    echo json_encode(array("response"=>"Gagal diperbarui","status"=>false));
            }
        }else{
            echo json_encode(array("response"=>"Password yang anda masukkan tidak sama","status"=>false));
        }
    }else{
        echo json_encode(array("response"=>"Anda salah memasukkan password lama","status"=>false));
    }
?>