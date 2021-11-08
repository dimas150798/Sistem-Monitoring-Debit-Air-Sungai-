<?php
    $lokasi1 = "Data Master";
    $lokasi2 = "Pengaturan Akun";
    $lokasi3 = "Edit Password Pegawai PUPR";
    $linklokasi2 = "";
    $linklokasi3 = "ubahpassword.php";

    include "template/header.php";   
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";

?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Edit Akun Pegawai PUPR</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-12 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal" name="" enctype="multipart/form-data">

                    <div class="form-group row">
                    <div class="col-md-6">
                        <label for="">Password Baru</label>
                        <input type="password" class="form-control" name="password1" id="myInput1" placeholder="Ketikan Password Pegawai">
                        <input type="checkbox" onclick="myFunction1()"> Show password
                    </div>
                    <div class="col-md-6">
                        <label for="">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" name="password2" id="myInput2" placeholder="Ketikan Ulang Password" required>
                        <input type="checkbox" onclick="myFunction2()"> Show password
                    </div>  
                    </div>


                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" name="submit" value="Simpan">
                    </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include "template/footer.php";

    if (isset($_POST['submit'])) {
        if ($_POST['password_pengawas1']==$_POST['password_pengawas2']) {
            if (editpassword($_POST) > 0){
                echo "
                <script>
                alert('Akun Dinas PUPR Berhasil Diupdate');
                document.location.href = 'index.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Akun Dinas PUPR Gagal Diupdate');history.go(-1)
                dcocument.location.href = 'ubahpassword.php?id=$id';            
                </script>
                ";
                echo("<br>");
            }
        } else {
            echo "<script>alert('Password yang Anda Masukan Tidak Sama');history.go(-1)</script>";
        }
    }

?>

<script>
    function myFunction1() {
        var x = document.getElementById("myInput1");
            if (x.type == "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function myFunction2() {
        var x = document.getElementById("myInput2");
            if (x.type == "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

