<?php
include 'includes/db_connect.php';
include 'includes/header.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Reports</title>
<style>

table{
width:100%;
border-collapse:collapse;
margin-bottom:30px;
}

th,td{
border:1px solid black;
padding:10px;
text-align:center;
}

th{
background:#ddd;
}

</style>

</head>

<body>

<h2>Inventory Reports</h2>

<?php

$total=mysqli_query($conn,"
SELECT SUM(total_price) AS total_sales
FROM sales
WHERE DATE(sale_date)=CURDATE()
");

$row=mysqli_fetch_assoc($total);

echo "<h3>Today's Sales: Tsh ".$row['total_sales']."</h3>";

?>

<h3>Top 3 Best Selling Products</h3>

<table>

<tr>

<th>Product</th>
<th>Total Sold</th>

</tr>

<?php

$top=mysqli_query($conn,"
SELECT
products.name,
SUM(sales.qty_sold) AS sold

FROM sales

INNER JOIN products

ON sales.product_id=products.product_id

GROUP BY products.product_id

ORDER BY sold DESC

LIMIT 3
");

while($r=mysqli_fetch_assoc($top))
{

?>

<tr>

<td><?php echo $r['name']; ?></td>

<td><?php echo $r['sold']; ?></td>

</tr>

<?php
}
?>

</table>

<h3>Low Stock Products</h3>

<table>

<tr>

<th>Product</th>
<th>Stock</th>

</tr>

<?php

$low=mysqli_query($conn,"
SELECT name,stock_qty

FROM products

WHERE stock_qty<5
");

while($r=mysqli_fetch_assoc($low))
{

?>

<tr>

<td><?php echo $r['name']; ?></td>

<td><?php echo $r['stock_qty']; ?></td>

</tr>

<?php
}
?>

</table>

<?php include 'includes/footer.php'; ?>
</body>
</html>