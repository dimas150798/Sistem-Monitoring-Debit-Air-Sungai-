<?php
    $lokasi1 = "Data Master";
    $lokasi2 = "Dashboard";
    $linklokasi2 = "index.php";

    include "../data_korwil/template/header.php";   
    include "../data_korwil/template/menu.php";
    include "../data_korwil/template/lokasi.php";
    include "../data_korwil/fungsi.php";


    $q1 = mysqli_query($koneksi, "SELECT count(id_user) as jumlah1 from db_user WHERE id_akses = 3 AND id_daerah='$_SESSION[id_daerah]'");
    $data1 = mysqli_fetch_assoc($q1);

    $jumlahpengawas = $data1['jumlah1']; 
    
    $q2 = mysqli_query($koneksi, "SELECT count(id_user) as jumlah2 from db_user WHERE id_akses = 2 AND id_daerah='$_SESSION[id_daerah]'");
    $data2 = mysqli_fetch_assoc($q2);

    $jumlahkordinatorwilayah = $data2['jumlah2'];  
        
?>
    <div class="container-fluid">
        <h1 align="center" class="pt-3">Selamat datang di Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Probolinggo</h1>
        <br><br><br>
        <div class="row pt-6">

            <div class="col-sm-12 col-lg-12">
                <div class="brand-card">
                    <div class="brand-card-header bg-facebook">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="card-body pb-0">
                        <div class="text-value" align="center">Jumlah Pegawai Pengawas Lapangan</div>
                    </div>
                    <div class="brand-card-body">
                        <div>
                            <div class="text-value"><?=$jumlahpengawas?></div>
                            <div class="text-uppercase text-muted small">Orang</div>
                        </div>
                    </div>
                </div>
            </div>            


<?php
    include "template/footer.php";
?>