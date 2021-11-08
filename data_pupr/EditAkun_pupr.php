<?php
    $lokasi1 = "Data Master";
    $lokasi2 = "Kelola Akun Pegawai Dinas PUPR";
    $lokasi3 = "Update Akun Pegawai Dinas PUPR";
    $linklokasi2 = "KelolaAKun_pupr.php";
    $linklokasi3 = "";

    include "template/header.php";   
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";

    $kodepupr = kodepupr();
    $id = $_GET['id'];
    $data = query("SELECT a.id_user, a.nip_user, a.nama_user, a.username, a.tgl_lahir_user, a.alamat_user, b.nama_akses FROM db_user a
                   INNER JOIN db_akses b ON a.id_akses = b.id_akses WHERE id_user = '$id'")[0];   


?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Edit Akun Pegawai Dinas PUPR</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-12 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal" name="tambahbarang" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="">ID Pegawai</label>
                        <input type="text" class="form-control" name="id_user" value="<?=$data['id_user']?>" readonly>
                    </div>    
                    <div class="form-group ">
                        <label for="">NIP Pegawai</label>
                        <input type="text" class="form-control" name="nip_user" value="<?=$data['nip_user']?>" placeholder="Ketikan NIP Pegawai" required>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-6">
                        <label for="">Nama Lengkap Pegawai</label>
                        <input type="text" class="form-control" name="nama_user" value="<?=$data['nama_user']?>" placeholder="Ketikan Nama Pegawai" required>
                    </div>  
                    <div class="col-md-6">
                        <label for="">Username Pegawai</label>
                        <input type="text" class="form-control" name="username" value="<?=$data['username']?>" placeholder="Ketikan Username Pegawai" required>
                    </div>  
                    </div>

                    <div class="form-group row">
                    <div class="col-md-6">
                        <label for="">Password Pegawai</label>
                        <input type="password" class="form-control" name="password1" id="myInput1" placeholder="Ketikan Password Pegawai">
                        <input type="checkbox" onclick="myFunction1()"> Show password
                    </div>
                    <div class="col-md-6">
                        <label for="">Konfirmasi Password Pegawai</label>
                        <input type="password" class="form-control" name="password2" id="myInput2" placeholder="Ketikan Ulang Password" required>
                        <input type="checkbox" onclick="myFunction2()"> Show password
                    </div>  
                    </div>

                    <div class="form-group row">
                    <div class="col-md-6">
                        <label for="">Alamat Pegawai</label>
                        <input type="text" class="form-control" name="alamat_user" value="<?=$data['alamat_user']?>" placeholder="Ketikan Alamat Pegawai" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tempat">Tanggal Lahir</label>
                        <div class="input-group">
                            <input type="date" class="form-control" placeholder="Tanggal Input" value="<?=$data['tgl_lahir_user']?>" name="tgl_lahir_user" required>
                        </div>
                    </div>
                    </div>
                   <div class="form-group ">
                        <label for="">Tipe Akses</label>
                        <input type="text" class="form-control" name="" value="Dinas PUPR" readonly>
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
        if ($_POST['password1']==$_POST['password2']) {
            if (editakunpupr($_POST) > 0){
                echo "
                <script>
                alert('Akun Pegawai Dinas PUPR Berhasil Diupdate');
                document.location.href = 'KelolaAkun_pupr.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Akun Pegawai Dinas PUPR Gagal Diupdate');history.go(-1)
                dcocument.location.href = 'EditAkun_pupr.php?id=$id';            
                </script>
                ";
                echo("<br>");
                echo mysqli_error($koneksi); 
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
