<?php
    $lokasi1 = "Data Master";
    $lokasi2 = "Kelola Akun Pegawai Dinas PUPR";
    $lokasi3 = "";
    $linklokasi2 = "KelolaAkun_pupr.php";
    $linklokasi3 = "";

    include "../data_pupr/template/header.php";   
    include "../data_pupr/template/menu.php";
    include "../data_pupr/template/lokasi.php";
    include "../data_pupr/fungsi.php";

    $db_pegawai = query("SELECT a.id_user, a.nip_user, a.nama_user, a.username, a.tgl_lahir_user, a.alamat_user, b.nama_akses FROM db_user a
                        INNER JOIN db_akses b ON a.id_akses = b.id_akses WHERE a.id_akses = 1");

    ?>

<div class="container-fluid">
    <h2 align="center" class="pt-3 pb-3">Data Akun Pegawai Dinas PUPR</h2>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-12 ">
            <a href="registrasi_pupr.php" class="btn btn-primary mb-2">Registrasi Akun</a>

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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($db_pegawai as $data) {
                        ?>
                <tr align="center">
                    <td><?=$i++?>.</td>
                    <td><?=$data['nip_user']?></td>
                    <td><?=$data['nama_user']?></td>
                    <td><?=$data['username']?></td>
                    <td><?php echo date('d - m - Y', strtotime($data["tgl_lahir_user"]));?></td>
                    <td><?=$data['alamat_user']?></td>
                    <td><?=$data['nama_akses']?></td>
                    <td>
                        <div class="btn-group">
                            <a href="EditAkun_pupr.php?id=<?=$data['id_user']?>"  class="btn btn-info">Edit</a>
                            <a href="DeleteAkun_pupr.php?id=<?=$data['id_user']?>" onclick="return confirm('Apakah anda ingin menghapus data ini ?')" class="btn btn-danger">Hapus</a>
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
