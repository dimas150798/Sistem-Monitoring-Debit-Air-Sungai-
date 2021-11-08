<?php
    $lokasi1 = "Data Master";
    $lokasi2 = "Kelola Akun Pegawai Kordinator Wilayah";
    $lokasi3 = "Update Akun Pegawai Kordinator WIlayah";
    $linklokasi2 = "KelolaAKun_korwil.php";
    $linklokasi3 = "";

    include "template/header.php";   
    include "template/menu.php";
    include "template/lokasi.php";
    include "fungsi.php";

    $kodekorwil = kodekorwil();

    $id = $_GET['id'];


    $data = query("SELECT a.id_user, a.nip_user, a.nama_user, a.username, a.tgl_lahir_user, a.alamat_user, b.nama_akses, c.daerah_tugas FROM db_user a
                   INNER JOIN db_akses b ON a.id_akses = b.id_akses
                   INNER JOIN daerah_tugas c ON a.id_daerah = c.id_daerah WHERE id_user = '$id'")[0]; 


?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Edit Akun Pegawai Kordinator Wilayah</h2>
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
                        <input type="number" class="form-control" name="nip_user" value="<?=$data['nip_user']?>" placeholder="Ketikan NIP Pegawai" required>
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
                    
                    <?php
                        $q = "SELECT * FROM `db_user` INNER JOIN daerah_tugas ON db_user.id_daerah = daerah_tugas.id_daerah WHERE db_user.id_user = '$id'";
                        $res = mysqli_query($koneksi,$q);
                        $view = mysqli_fetch_assoc($res);
                    ?>
                    <div class="form-group">
                        <label for="">Daerah Tugas Pegawai</label>
                        <select name="id_daerah"style="text-align:center;" class="form-control select-dropdown" required>
                            <?php
                            include "../koneksi/koneksi.php";
                            $notId = $view["id_daerah"];
                            $newQ = "SELECT * FROM daerah_tugas WHERE daerah_tugas.id_daerah != '$notId'";
                            $query = mysqli_query($koneksi, $newQ);
                            echo "<option value='$view[id_daerah]' selected
                            hidden>$view[daerah_tugas]</option>";
                            while ($show = mysqli_fetch_assoc($query)) {
                                echo "<option value='$show[id_daerah]'>$show[daerah_tugas]</option>";
                            }
                            ?>
                    </select>
                    </div>             
                    
                    <div class="form-group ">
                        <label for="">Tipe Akses</label>
                        <input type="text" class="form-control" name="" value="Kordinator Wilayah" readonly>
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
            if (editakunkorwil($_POST) > 0){
                echo "
                <script>
                alert('Akun Pegawai Kordinator Wilayah Berhasil Diupdate');
                document.location.href = 'KelolaAkun_korwil.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Akun Pegawai Kordinator Wilayah Gagal Diupdate');history.go(-1)
                dcocument.location.href = 'EditAkun_korwil.php?id=$id';            
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
