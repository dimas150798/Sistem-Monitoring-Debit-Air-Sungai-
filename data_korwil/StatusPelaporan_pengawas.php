<?php
    function getStatus($kode = NULL){
                                        $label = NULL;
                                        if($kode < 20){
                                            $label = "Rendah";
                                        }
                                        else if($kode >=20 and $periodestats1 <= 100){
                                            $label = "Stabil";
                                        }
                                        else if($kode > 100){
                                            $label = "Tinggi";
                                        }    
                                        return $label;
                                    }
        $lokasi1 = "Data Master";
        $lokasi2 = "Grafik Debit Air";
        $lokasi3 = "";
        $linklokasi2 = "StatusPelaporan_pengawas.php";
        $linklokasi3 = "";

        include "../data_korwil/template/header.php";   
        include "../data_korwil/template/menu.php";
        include "../data_korwil/template/lokasi.php";
        include "../data_korwil/fungsi.php";

        //Pembagian Debit Air
        $data1 = mysqli_query($koneksi, "SELECT a.id_laporan FROM cth_laporan a 
        INNER JOIN cth_hari b ON a.id_hari = b.id_hari 
        WHERE b.periode = 'Periode 3' 
        AND a.status_laporan = 'Dikonfirmasi' 
        AND a.id_daerah='$_SESSION[id_daerah]'");
        $pembagian = mysqli_num_rows($data1);
        
        // $data2 = mysqli_query($koneksi, "SELECT a.nama_sungai, a.nama_bendungan FROM cth_laporan a WHERE a.id_daerah='$_SESSION[id_daerah]' GROUP BY a.nama_sungai, a.nama_bendungan");
        
        //Debit Rata - Rata Dalam 1 Bulan
            
    ?>

    <!DOCTYPE html>
    <html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="../data_korwil/chartjs/Chart.bundle.js"></script>
    <style>

    table, th, td {
    border: 1px solid black;
        } 

    div.d{
        position: absolute;
            right: 0;
            width: 100px;
            height: 220px;
            padding-top: 154px;
            padding-bottom: 20px;
            padding-right: 460px;
    } 

    div.e{
        position: absolute;
            right: 0;
            width: 100px;
            height: 120px;
            padding-top: 154px;
            padding-bottom: 20px;
            padding-right: 310px;
    } 
    div.f{
        position: absolute;
            right: 0;
            width: 100px;
            height: 120px;
            padding-top: 154px;
            padding-bottom: 20px;
            padding-right: 169px;
    }
     .wrapper{
    width: 350px;
    height: 450px;
    margin: 0 auto;
    } 
    </style>
    </head>
    <body>

    <div class="container-fluid">

        <br>
        <center> <h3>GRAFIK DEBIT SUNGAI</h3> </center>
        <center> <h3></h3> </center>

        <div class="form-group">
        <option value="">Pilih Nama bendungan : </option><br>
        <form method="get" action="StatusPelaporan_pengawas.php">
        <div class="dropdown">
        <select name="nama_bendungan">
        <option value="">Nama Bendung</option>
        <?php 
        $key = $_SESSION[id_daerah];
        $data2 = mysqli_query($koneksi, "SELECT nama_sungai,nama_bendungan FROM cth_laporan WHERE id_daerah='$key' GROUP BY nama_sungai,nama_bendungan");
            while ($show = mysqli_fetch_assoc($data2)) {
            echo "<option value='$show[nama_bendungan]'>$show[nama_bendungan]</option>";
            }
        ?>
         
        </select>
             &nbsp;&nbsp;&nbsp;
        <input type="submit" class="btn btn-primary" value="Pilih bendungan">
        </form>
       </div>
       <br>
       
       <?php if(isset($_GET['nama_bendungan']) && $_GET['nama_bendungan']!=""){ 
            ?>

            <?php
            $query1 = query("SELECT a.nama_sungai, a.nama_bendungan,

             ROUND(SUM(IF(b.periode = 'Periode 1', a.intake_kanan, NULL)/10)) AS intake_kanan1, 
             ROUND(SUM(IF(b.periode = 'Periode 1', a.intake_kiri, NULL)/10)) AS intake_kiri1,
             ROUND(SUM(IF(b.periode = 'Periode 1', a.intake_kanan + a.intake_kiri, NULL)/10)) AS jumlah_debit1,
        
             ROUND(SUM(IF(b.periode = 'Periode 2', a.intake_kanan, NULL)/10)) AS intake_kanan2, 
             ROUND(SUM(IF(b.periode = 'Periode 2', a.intake_kiri, NULL)/10)) AS intake_kiri2,
             ROUND(SUM(IF(b.periode = 'Periode 2', a.intake_kanan + a.intake_kiri, NULL)/10)) AS jumlah_debit2,
        
             ROUND(SUM(IF(b.periode = 'Periode 3', a.intake_kanan, NULL)/$pembagian)) AS intake_kanan3, 
             ROUND(SUM(IF(b.periode = 'Periode 3', a.intake_kiri, NULL)/$pembagian)) AS intake_kiri3,
             ROUND(SUM(IF(b.periode = 'Periode 3', a.intake_kanan + a.intake_kiri, NULL)/$pembagian)) AS jumlah_debit3,

             GROUP_CONCAT(a.l_total) as l_total, GROUP_CONCAT(a.l_eff) as l_eff, GROUP_CONCAT(a.status_laporan) as status_laporan
        
             FROM cth_laporan a 
             INNER JOIN cth_hari b ON a.id_hari = b.id_hari
             WHERE a.nama_bendungan='$_GET[nama_bendungan]'
             GROUP BY a.nama_sungai, a.nama_bendungan");


            foreach ($query1 as $data2) :
              $periodestats11 = $data2['intake_kanan1'] + $data2['intake_kiri1'];
              $periodestats22 = $data2['intake_kanan2'] + $data2['intake_kiri2'];
              $periodestats33 = $data2['intake_kanan3'] + $data2['intake_kiri3'];
        ?>

        <div class="wrapper">
            <canvas id="myChart" width="10" height="10"></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Periode 1", "Periode 2", "Periode 3"],
                    datasets: [{
                            label: 'Grafik Debit Bendungan <?=$data2['nama_bendungan']?>',
                            data: [<?=$periodestats11 ?>,<?=$periodestats22 ?>, <?=$periodestats33 ?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
         <?php endforeach; ?>
        <?php } ?>
    </div>

    <?php
        include "template/footer.php";
    ?>
    </div>

</body>