<?php
    $lokasi1 = "Data Master";
    $lokasi2 = "Kelola Daerah Tugas";
    $lokasi3 = "Tambah Daerah Tugas";
    $linklokasi2 = "KelolaDaerah_tugas.php";
    $linklokasi3 = "TambahDaerah_tugas.php";

    include "../data_pupr/template/header.php";   
    include "../data_pupr/template/menu.php";
    include "../data_pupr/template/lokasi.php";
    include "../data_pupr/fungsi.php";

    $kodedaerahtugas = kodedaerahtugas();

?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Tambah Daerah Tugas</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="">ID Daerah Tugas</label>
                        <input type="text" class="form-control" name="id_daerah" value="<?=$kodedaerahtugas?>" readonly>
                    </div>
                    <div class="form-group ">
                        <label for="">Daerah Tugas Pegawai</label>
                        <input type="text" class="form-control" name="daerah_tugas" placeholder="Ketikan Daerah Tugas Pegawai" required>
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
            if (tambahdaerahtugas($_POST) > 0){
                echo "
                <script>
                alert('Data berhasil ditambahkan');
                document.location.href = 'KelolaDaerah_tugas.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Data gagal ditambahkan');
                // document.location.href = 'TambahDaerah_tugas.php';            
                </script>
                ";
                echo("<br>");
                echo mysqli_error($koneksi);  
            }
        } 
?>
