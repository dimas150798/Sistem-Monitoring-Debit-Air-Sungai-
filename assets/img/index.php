<?php
    ini_set("display_errors", 0);   
    include "template/header.php";
    include "template/menu.php";
    include "template/lokasi.php";
    include "../koneksi/koneksi.php";


	$barang = mysqli_query($koneksi, "SELECT * FROM m_barang");
	$banyakbarang = mysqli_num_rows($barang);

	$supplier = mysqli_query($koneksi, "SELECT * FROM m_supplier");
	$banyaksupplier = mysqli_num_rows($supplier);

	$mutasi = mysqli_query($koneksi, "SELECT * FROM m_mutasi");
	$banyakmutasi = mysqli_num_rows($mutasi);



        
?>
    <div class="container-fluid">
        <h1 align="center" class="pt-3">Selamat datang di Pergudangan Frozen Food</h1>
        <div class="row pt-5">

        <div class="container">
			<div class="card-group">
			  <div class="card">
			    <img class="card-img-top" src="assets/img/archive.png" alt="Card image cap" style="max-width: 150px; margin: auto; margin-top:20px;">
			    <div class="card-body">
			      <h5 class="card-title" align="center">Barang</h5>
			      <p class="card-text">Menu ini berisi daftar barang dan menu CRUD barang. Total barang yang saat ini ada yaitu <b><?php echo $banyakbarang; ?> Barang</b></p>
			    </div>
			  </div>
			  <div class="card">
			    <img class="card-img-top" src="assets/img/boy.png" alt="Card image cap" style="max-width: 150px; margin: auto; margin-top:20px;">
			    <div class="card-body">
			      <h5 class="card-title" align="center">Supplier</h5>
			      <p class="card-text">Menu ini berisi daftar supplier dan menu CRUD supplier. Banyak supplier yang sudah terdaftar yaitu <b><?php echo $banyaksupplier; ?> Supplier</b></p>
			    </div>
			  </div>
			  <div class="card">
			    <img class="card-img-top" src="assets/img/trolley2.png" alt="Card image cap" style="max-width: 150px; margin: auto; margin-top:20px;">
			    <div class="card-body">
			      <h5 class="card-title" align="center">Mutasi Barang</h5>
			      <p class="card-text">Menu ini adalah menu mutasi dimana data keluarnya barang dicatat. Total mutasi yang sudah dilakukan yaitu <b><?php echo $banyakmutasi; ?> kali mutasi</b></p>
			    </div>
			  </div>
			</div>
		</div>

<?php
    include "template/footer.php";
?>