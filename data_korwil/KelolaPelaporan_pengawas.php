<?php

        function getStatus($kode = NULL){
                                        $label = NULL;
                                        if($kode < 20){
                                            $label = "Rendah";
                                        }
                                        else if($kode >=20 and isset($periodestats1) <= 100){
                                            $label = "Stabil";
                                        }
                                        else if($kode > 100){
                                            $label = "Tinggi";
                                        }    
                                        return $label;
                                    }
        $lokasi1 = "Data Master";
        $lokasi2 = "Kelola Pelaporan Pengawas Lapangan";
        $lokasi3 = "";
        $linklokasi2 = "KelolaPelaporan_pengawas.php";
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
        

        //Debit Rata - Rata Dalam 1 Bulan
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
        WHERE a.id_daerah='$_SESSION[id_daerah]'
        GROUP BY a.nama_sungai, a.nama_bendungan
        ");
    
    ?>


    <!DOCTYPE html>
    <html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>

    table, th, td {
    border: 1px solid black;
        } 

    div.d{
        position: absolute;
            right: 0;
            width: 100px;
            height: 120px;
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
    </style>
    </head>
    <body>

    <div class="container-fluid">


        <div class="f">
        <a type="button" name="delete" value="Delete"  onClick="setDeleteAction();" class="btn btn-danger"><i class="nav-icon fa fa-trash"></i>  Hapus Laporan</a></a>
        </div>

        <div class="e">
            <a class="btn btn-primary mb-2" onClick="setCetakAction();"><i class="nav-icon fa fa-print"></i>  Cetak Laporan</a></a>
        </div> 

        <div class="d">
            <a class="btn btn-primary mb-2" onClick="setUnduhAction();"><i class="nav-icon fa fa-download"></i>  Unduh Laporan</a></a>
        </div>  

        <br>
        <center> <h3>DATA DEBIT SUNGAI PADA DINAS PEKERJAAN UMUM DAN</h3> </center>
        <center> <h3>PENATAAN RUANG KABUPATEN PROBOLINGGO</h3> </center>
        <br><br><br><br><br>  
        <table class="table table-striped table-hover table-bordered table-align-middle" id="data"style="width:100%">
                
                <form name="frmUser" method="post" action="">
                    <thead >
                        <tr align="center">
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama Sungai</th>
                            <th rowspan="2">Nama Bendungan</th>
                            <th rowspan="2">Keadaan</th>
                            <th colspan="3">Debit Rata - Rata 10 Harian Ke-(I/det) </th>
                            <th rowspan="2">Keterangan</th> 
                            </tr>

                        <tr align="center">
                            <th>I</th>
                            <th>II</th>
                            <th>III</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                        $i = 1;
                        foreach ($query1 as $data) {

                ?>
                    <tr>
                            <td rowspan = "5"><?=$i++?>.</td>
                            <td rowspan = "5"><?=$data['nama_sungai']?></td>   
                            <td colspan = "1"><?=$data['nama_bendungan']?></td> 
                            <td colspan = "1"></td>
                            <td colspan = "1"></td>
                            <td colspan = "1"></td>
                            <td colspan = "1"></td>
                            <td colspan = "1">L Total Bendung&emsp;:  
                             <?php $total = explode(',',$data['l_total']); 
                             echo $total[0]?> 
                            m</td>
                            
                         
                            <tr>
                                <td colspan = "1">Intake Kanan</td>
                                <td colspan = "1">Normal Pagi</td>
                                <td colspan = "1"><?=$data['intake_kanan1']?></td>
                                <td colspan = "1"><?=$data['intake_kanan2']?></td>
                                <td colspan = "1"><?=$data['intake_kanan3']?></td>
                                <td colspan = "1">L eff. Bendung&emsp;&ensp;&nbsp;:  
                                <?php $leff = explode(',',$data['l_eff']); 
                                echo $leff[0] ?> 
                                m</td>
                                <!-- <td colspan = "1"></td> -->

                                <tr>
                                        <td colspan = "1">Intake Kiri</td>
                                        <td colspan = "1">Normal Pagi</td>
                                        <td colspan = "1"><?=$data['intake_kiri1']?></td>
                                        <td colspan = "1"><?=$data['intake_kiri2']?></td>
                                        <td colspan = "1"><?=$data['intake_kiri3']?></td>
                                        <td colspan = "1">Status Laporan&emsp;&ensp;&nbsp;: 
                                        <?php $status = explode(',',$data['status_laporan']);
                                        if (in_array("Belum dikonfirmasi", $status)){echo 'Belum dikonfirmasi';}                  
                                        else{echo'Dikonfirmasi';}
                                        ?>
                                        </td>
                                        <?php 
                                        //     $statusJmlDebit = $data["jumlah_debit1"] + $data["jumlah_debit2"] + $data["jumlah_debit3"];
                                        //     $labelJmlDebit = getStatus($statusJmlDebit);
                                        ?>
                                        <!-- <td colspan = "1"></td> -->

                                            <tr>
                                                <td colspan = "1">Jumlah Debiet</td>
                                                <td colspan = "1">Normal Pagi</td>
                                                <td colspan = "1"><?=$data['jumlah_debit1']?></td>
                                                <td colspan = "1"><?=$data['jumlah_debit2']?></td>
                                                <td colspan = "1"><?=$data['jumlah_debit3']?></td>
                                                <!--<td colspan = "1">Status Jumlah Debit : <?= $labelJmlDebit ?></td>-->
                                                <td colspan = "1"></td> 



                                            </tr>
                                </tr>
                                <?php
                                    $periodestats1 = $data['intake_kanan1'] + $data['intake_kiri1'];
                                    $labelperiod1 = getStatus($periodestats1);
                                    
                                    $periodestats2 = $data['intake_kanan2'] + $data['intake_kiri2'];
                                    $labelperiod2 = getStatus($periodestats2);
                                    
                                    $periodestats3 = $data['intake_kanan3'] + $data['intake_kiri3'];
                                    $labelperiod3 = getStatus($periodestats3);
                                ?>
                                <tr>
                                    <td colspan="2" style='text-align:center'>Status Debit </td>
                                    <td><?= $labelperiod1 ?></td>
                                    <td><?= $labelperiod2 ?></td>
                                    <td><?= $labelperiod3 ?></td>
                                    <td></td>
                                </tr>
                            </tr>      
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

<script>
    function setDeleteAction() {
        if(confirm("Apakah Data Laporan Sudah Di Unduh / Di Simpan ???")) {
        document.frmUser.action = "DeleteData_laporan.php?id=<?php echo $_SESSION['id_daerah'];?>";
        document.frmUser.submit();
        }
    }
</script>

<script>
    function setCetakAction() {
        if(confirm("Apakah Anda Ingin Mencetak / Print Laporan Bulan ini ???")) {
        document.frmUser.action = "CetakLaporan_pengawas.php";
        document.frmUser.submit();
        }
    }
</script>

<script>
    function setUnduhAction() {
        if(confirm("Apakah Anda Ingin Mengunduh Laporan Bulan ini ???")) {
        document.frmUser.action = "Unduh_laporan.php";
        document.frmUser.submit();
        }
    }
</script>

<!-- <script language="JavaScript">
	function check_toggle(source) {
		    checkboxes = document.getElementsByName('datalaporan[]');
		    for(var i=0, n=checkboxes.length; i<n ;i++) 
	    {
			checkboxes[i].checked = source.checked;
			}
		}
</script> -->

<script>
 $(document).ready(function () {
     $("#tombolExport").click(function () { // Jika tombol export diklik
          $("#tabelExport").btechco_excelexport({ // Definisikan tabel yang akan di export
               containerid: "tabelExport"
               , datatype: $datatype.Table
          });
     });
});
</script>
