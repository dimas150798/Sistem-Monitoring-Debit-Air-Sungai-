<?php
    ini_set("display_errors", 0);
       
    $lokasi1 = "Data Master";
    $lokasi2 = "Dashboard";
    $linklokasi2 = "index.php";

    include "../data_pupr/template/header.php";   
    include "../data_pupr/template/menu.php";
    include "../data_pupr/template/lokasi.php";
    include "../data_pupr/fungsi.php";


    $q1 = mysqli_query($koneksi, "select count(id_user) as jumlah from db_user WHERE id_akses = 2");
    $data1 = mysqli_fetch_assoc($q1);
    $q2 = mysqli_query($koneksi, "select count(id_user) as jumlah from db_user WHERE id_akses = 1");
    $data2 = mysqli_fetch_assoc($q2);

    $jumlahkorwil = $data1['jumlah'];    
    $jumlahpupr = $data2['jumlah'];   
        
?>
    <div class="container-fluid">
        <h1 align="center" class="pt-3">Selamat datang di Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Probolinggo</h1>
        <div class="row pt-5">

        <div class="col-sm-6 col-lg-6">
                <div class="brand-card">
                    <div class="brand-card-header bg-facebook">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="card-body pb-0">
                        <div class="text-value" align="center">Jumlah Pegawai Dinas PUPR Probolinggo</div>
                    </div>
                    <div class="brand-card-body">
                        <div>
                            <div class="text-value"><?=$jumlahpupr?></div>
                            <div class="text-uppercase text-muted small">Orang</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-6">
                <div class="brand-card">
                    <div class="brand-card-header bg-facebook">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="card-body pb-0">
                        <div class="text-value" align="center">Jumlah Pegawai Kordinator Wilayah</div>
                    </div>
                    <div class="brand-card-body">
                        <div>
                            <div class="text-value"><?=$jumlahkorwil?></div>
                            <div class="text-uppercase text-muted small">Orang</div>
                        </div>
                    </div>
                </div>
            </div>
            

            

<?php
    include "template/footer.php";
?>