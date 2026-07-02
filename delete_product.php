<?php
include 'includes/db_connect.php';

$id=intval($_GET['id']);

mysqli_query($conn,
"DELETE FROM products
WHERE product_id=$id");

mysqli_query($conn,$sql);
    header("Location: products.php?updated=1");
    exit();
?>
