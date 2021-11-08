<?php
    $lokasi1 = "Data Master";
    $lokasi2 = "Kelola Akun Pegawai Kordinator Wilayah";
    $lokasi3 = "Registrasi Akun Pegawai Kordinator Wilayah";
    $linklokasi2 = "KelolaAkun_korwil.php";
    $linklokasi3 = "registrasi_korwil.php";

    include "../data_pupr/template/header.php";   
    include "../data_pupr/template/menu.php";
    include "../data_pupr/template/lokasi.php";
    include "../data_pupr/fungsi.php";

    $kodekorwil = kodekorwil();

?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Registrasi Akun Pegawai Kordinator Wilayah</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-12 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="">ID Pegawai</label>
                        <input type="text" class="form-control" name="id_user" value="<?=$kodekorwil?>" readonly>
                    </div>
                    <div class="form-group ">
                        <label for="">NIP Pegawai</label>
                        <input type="number" class="form-control" name="nip_user" placeholder="Ketikan NIP Pegawai Kordinator Wilayah" required>
                    </div>

                    <div class="form-group row">
                    <div class="col-md-6">
                        <label for="">Nama Lengkap Pegawai</label>
                        <input type="text" class="form-control" name="nama_user" placeholder="Ketikan Nama Lengkap Pegawai" required>
                    </div> 
                    <div class="col-md-6">
                        <label for="">Username Pegawai</label>
                        <input type="text" class="form-control" name="username" placeholder="Ketikan Username Pegawai Kordinator Wilayah" required>
                    </div> 
                    </div>

                    <div class="form-group row">
                    <div class="col-md-6">
                        <label for="">Password Pegawai</label>
                        <input type="password" class="form-control" name="password1" id="myInput1" placeholder="Ketikan Password Pegawai Kordinator Wilayah">
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
                        <input type="text" class="form-control" name="alamat_user" placeholder="Ketikan Alamat Pegawai Kordinator Wilayah" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tempat">Tanggal Lahir</label>
                        <div class="input-group">
                            <input type="date" class="form-control" placeholder="Tanggal Input" name="tgl_lahir_user" required>
                        </div>
                    </div>
                    </div>  

                    
                    <div class="form-group">
                        <label for="">Daerah Tugas Pegawai  </label>
                        <select name="id_daerah"style="text-align:center;" class="form-control select-dropdown" required>
                            <option value="" selected disabled>Pilih daerah tugas   </option>
                            <?php
                            include "../koneksi/koneksi.php";
                            $query = mysqli_query($koneksi, "SELECT * FROM daerah_tugas ");
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
            if (tambahakunkorwil($_POST) > 0){
                echo "
                <script>
                alert('Registrasi Akun Pegawai Berhasil');
                document.location.href = 'KelolaAkun_korwil.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Registrasi Akun Pegawai Gagal');history.go(-1)
                // document.location.href = 'registrasi_korwil.php';            
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
