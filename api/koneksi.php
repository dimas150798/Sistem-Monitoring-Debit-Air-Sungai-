<?php

define('HOST', 'localhost');
define('USER', '*usernamePHPMYSQL');
define('PASS', '*passwordPHPMYSQL');
define('DB', '*database');

$conn = mysqli_connect(HOST, USER, PASS, DB) or die ('Tidak terhubung');
date_default_timezone_set("Asia/Jakarta");

?>
