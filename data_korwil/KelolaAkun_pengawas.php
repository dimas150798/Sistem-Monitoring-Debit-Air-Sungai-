<?php
    $lokasi1 = "Data Master";
    $lokasi2 = "Kelola Akun Pengawas Lapangan";
    $lokasi3 = "";
    $linklokasi2 = "KelolaAkun_pengawas.php";
    $linklokasi3 = "";

    include "../data_korwil/template/header.php";   
    include "../data_korwil/template/menu.php";
    include "../data_korwil/template/lokasi.php";
    include "../data_korwil/fungsi.php";

    $db_pengawas = query("SELECT a.id_user, a.nip_user, a.nama_user, a.username, 
    a.tgl_lahir_user, a.alamat_user, b.nama_akses, c.daerah_tugas 
    
    FROM db_user a

    INNER JOIN db_akses b ON a.id_akses = b.id_akses
    INNER JOIN daerah_tugas c ON a.id_daerah = c.id_daerah 
    WHERE a.id_akses = 3 AND a.id_daerah='$_SESSION[id_daerah]'");

?>

<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Data Akun Pegawai Pengawas Lapangan</h2>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-12 ">
            <a href="registrasi_pengawas.php" class="btn btn-primary mb-2">Registrasi Akun</a>

            <?php
            if (($_SESSION['id_daerah'])) {
    }

?>

            <table class="table table-striped table-hover table-bordered table-align-middle" id="data">
                <thead >
                    <tr align="center">
                    <th>No</th>
                    <th width="30px">NIP Pegawai</th>
                        <th width="180px">Nama Lengkap Pegawai</th>
                        <th width="100px">Username</th>
                        <th width="120px">Tanggal Lahir </th>
                        <th width="200px">Alamat Pegawai</th>
                        <th width="70px">Akses Akun </th>
                        <th width="70px">Daerah Tugas </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($db_pengawas as $data) {
                        ?>
                <tr align="center">
                    <td><?=$i++?>.</td>
                    <td><?=$data['nip_user']?></td>
                    <td><?=$data['nama_user']?></td>
                    <td><?=$data['username']?></td>
                    <td><?php echo date('d - m - Y', strtotime($data["tgl_lahir_user"]));?></td>
                    <td><?=$data['alamat_user']?></td>
                    <td><?=$data['nama_akses']?></td>
                    <td><?=$data['daerah_tugas']?></td>
                    <td>
                        <div class="btn-group">
                            <a href="EditAkun_pengawas.php?id=<?=$data['id_user']?>"  class="btn btn-info">Edit</a>
                            <a href="DeleteAkun_pengawas.php?id=<?=$data['id_user']?>" onclick="return confirm('Apakah anda ingin menghapus data ini ?')" class="btn btn-danger">Hapus</a>
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
