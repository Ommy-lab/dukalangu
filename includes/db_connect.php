<?php

$host = "db.fr-pari1.bengt.wasmernet.com";
$username = "user_bcc36531";
$password = "pw_BeOuLvzbhrYjHIgGfQUmHqtDIi8IZnHu";
$port = "10272";
$database = "db_7e0820ef";

$conn = mysqli_connect($host, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>