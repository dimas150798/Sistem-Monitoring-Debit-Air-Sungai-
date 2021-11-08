<?php
    $lokasi1 = "Data Master";
    $lokasi2 = "Kelola Daerah Tugas Pegawai";
    $lokasi3 = "Edit Daerah Tugas Pegawai";
    $linklokasi2 = "KelolaDaerah_tugas.php";
    $linklokasi3 = "EditDaerah_tugas.php";

    include "../data_pupr/template/header.php";   
    include "../data_pupr/template/menu.php";
    include "../data_pupr/template/lokasi.php";
    include "../data_pupr/fungsi.php";

    $kodedaerahtugas = kodedaerahtugas();
    $id = $_GET['id'];
    $data = query("SELECT * FROM daerah_tugas where id_daerah = '$id'")[0];    
?>
<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Edit Daerah Tugas Pegawai</h2>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-lg-5 ">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal" name="tambahbarang" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="">ID Daerah Tugas</label>
                        <input type="text" class="form-control" name="id_daerah" value="<?=$data['id_daerah']?>" readonly>
                    </div>    
                    <div class="form-group ">
                        <label for="">Daerah Tugas Pegawai</label>
                        <input type="text" class="form-control" name="daerah_tugas" value="<?=$data['daerah_tugas']?>"placeholder="Ketikan Daerah Tugas Pegawai" required>
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
            if (editdaerahtugas($_POST) > 0){
                echo "
                <script>
                alert('Daerah Tugas Berhasil Diupdate');
                document.location.href = 'KelolaDaerah_tugas.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Daerah Tugas Gagal Diupdate');history.go(-1)
                dcocument.location.href = 'EditDaerah_tugas.php?id=$id';            
                </script>
                ";
                echo("<br>");
                echo mysqli_error($koneksi); 
            }
        } 
?>
