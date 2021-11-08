<?php
    $lokasi1 = "Data Master";
    $lokasi2 = "Kelola Daerah Tugas Pegawai";
    $lokasi3 = "";
    $linklokasi2 = "KelolaDaerah_tugas.php";
    $linklokasi3 = "";

    include "../data_pupr/template/header.php";   
    include "../data_pupr/template/menu.php";
    include "../data_pupr/template/lokasi.php";
    include "../data_pupr/fungsi.php";

    $db_korwil = query("SELECT a.id_daerah, a.daerah_tugas FROM daerah_tugas a");

    ?>

<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Data Daerah Tugas Pegawai</h2>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-12 ">
            <a href="TambahDaerah_tugas.php" class="btn btn-primary mb-2">Tambah Daerah Tugas</a>

            <table class="table table-striped table-hover table-bordered table-align-middle" id="data">
                <thead >
                    <tr align="center">
                        <th>No</th>
                        <th>Daerah Tugas Pegawai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($db_korwil as $data) {
                        ?>
                <tr align="center">
                    <td><?=$i++?>.</td>
                    <td><?=$data['daerah_tugas']?></td>
                    <td>
                        <div class="btn-group">
                            <a href="EditDaerah_tugas.php?id=<?=$data['id_daerah']?>"  class="btn btn-info">Edit</a>
                            <a href="DeleteDaerah_tugas.php?id=<?=$data['id_daerah']?>" onclick="return confirm('Apakah anda ingin menghapus data ini ?')" class="btn btn-danger">Hapus</a>
                        </div>
                    </td>
                </tr>
                    <?php } ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
    include "template/footer.php";
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#data').DataTable();
    });
</script>
