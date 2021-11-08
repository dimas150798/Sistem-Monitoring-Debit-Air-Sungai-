<?php
    $lokasi1 = "Data Master";
    $lokasi2 = "Contoh Laporan Pengawas";
    $lokasi3 = "Tambah Laporan Pengawas ";
    $linklokasi2 = "KelolaAkun_pengawas.php";
    $linklokasi3 = "";

    include "../data_korwil/template/header.php";   
    include "../data_korwil/template/menu.php";
    include "../data_korwil/template/lokasi.php";
    include "../data_korwil/fungsi.php";

    $kodelaporanpengawas = kodelaporanpengawas();
                            

?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Contoh Tambah Data Laporan Pengawas</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="">ID Laporan</label>
                        <input type="text" class="form-control" name="id_laporan" value="<?=$kodelaporanpengawas?>" readonly>
                    </div>
                    <div class="form-group ">
                        <input type="hidden" class="form-control" name="id_user" value="<?=$_SESSION['id_user']?>" readonly>
                    </div>                
                    <div class="form-group ">
                        <label for="">Nama Lengkap Pengawas</label>
                        <input type="text" class="form-control" name="" value="<?=$_SESSION['nama_user']?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="">Pendataan Hari Ke-</label>
                        <select name="id_periode"style="text-align:center;" class="form-control select-dropdown" required>
                            <option value="" selected disabled>Hari Ke-</option>
                            <?php
                            include "../koneksi/koneksi.php";
                            $query = mysqli_query($koneksi, "select * from cth_hari");
                            while ($show = mysqli_fetch_assoc($query)) {
                                echo "<option value='$show[id_hari]'>$show[hitungan_hari]</option>";
                            }
                            ?>
                    </select>
                    </div> 

                    <div class="form-group ">
                        <label for="">Nama Sungai</label>
                        <input type="text" class="form-control" name="nama_sungai" placeholder="Ketikan Nama Sungai" required>
                    </div>
                    <div class="form-group ">
                        <label for="">Nama Bendungan</label>
                        <input type="text" class="form-control" name="nama_bendungan" placeholder="Ketikan Nama Bendungan" required>
                    </div> 
                    <div class="form-group ">
                        <label for="">Jumlah Intake Kanan</label>
                        <input type="text" class="form-control" name="intake_kanan" placeholder="Ketikan Jumlah Intake Kanan">
                    </div>   
                    <div class="form-group ">
                        <label for="">Jumlah Intake Kiri</label>
                        <input type="text" class="form-control" name="intake_kiri" placeholder="Ketikan Jumlah Intake Kiri">
                    </div>                 
                    <div class="form-group ">
                        <label for="">Jumlah Debit</label>
                        <input type="text" class="form-control" name="jumlah_debit" placeholder="Ketikan Jumlah Debit" required>
                    </div>
                    <div class="form-group ">
                        <label for="">L Total Bendungan</label>
                        <input type="text" class="form-control" name="l_total" placeholder="Ketikan Total Bendungan" required>
                    </div>                  
                    <div class="form-group ">
                        <label for="">L eff Bendungan</label>
                        <input type="text" class="form-control" name="l_eff" placeholder="Ketikan eff Bendungan" required>
                    </div>
                    <div class="form-group">
                        <label for="tempat">Tanggal Input Laporan</label>
                        <div class="input-group">
                            <input type="date" class="form-control" placeholder="Tanggal Input" name="date_laporan" required>
                        </div>
                    </div>  
                    <div class="form-group ">
                        <label for="">Foto Laporan</label>
                        <input type="text" class="form-control" name="foto_laporan" placeholder="Foto Laporan" required>
                    </div>                  
                    <div class="form-group ">
                        <label for="">Lokasi Laporan</label>
                        <input type="text" class="form-control" name="lokasi_laporan" placeholder="Ketikan Lokasi" required>
                    </div>
                    <div class="form-group ">
                        <label for="">Status Laporan</label>
                        <input type="text" class="form-control" name="status_laporan" placeholder="Status Laporan" required>
                    </div>
  
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-success" name="submit" value="Simpan">
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
            if (tambahlaporanpengawas($_POST) > 0){
                echo "
                <script>
                alert('Tambah Laporan Berhasil');
                document.location.href = 'KelolaPelaporan_pengawas.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Tambah Laporan Gagal');history.go(-1)
                // document.location.href = 'laporan_pengawas.php';            
                </script>
                ";
                echo("<br>");
                echo mysqli_error($koneksi); 
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