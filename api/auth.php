<?php
    header("Content-type:application/json");
    
    require ('koneksi.php');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * from db_user where username = '$username'"); //Cek Username
    $cek = mysqli_num_rows($q);

    if ($cek == 1) {
        $data = mysqli_fetch_assoc($q);
          if (password_verify($password, $data['password'])) { //Mengecek password
              $akses = $data['id_akses'];
                  if ($akses == 2) {
                    echo json_encode(array(
                        "response"=>"success",
                        "akses"=>"Kordinator wilayah",
                        "data"=>$data
                    ));
                  }else if($akses == 3){
                    echo json_encode(array(
                        "response"=>"success",
                        "akses"=>"Pengawas Lapangan","status"=>true,
                        "data"=>$data
                    ));
                  } else if ($akses == 1) {
                    echo json_encode(array("response"=>"Anda tidak punya akses","status"=>false));
                  }
          }else{
            echo json_encode(array("response"=>"Username atau password salah","status"=>false));
          }
    }else{
        echo json_encode(array("response"=>"Anda tidak terdaftar silahkan hubungi admin","status"=>false));
    }
?>