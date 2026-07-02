<?php
include 'includes/db_connect.php';
include 'includes/functions.php';

$sql = "SELECT
sales.sale_id,
products.name,
sales.qty_sold,
sales.total_price,
sales.sale_date

FROM sales

INNER JOIN products
ON sales.product_id = products.product_id

ORDER BY sales.sale_date DESC";

$result = mysqli_query($conn,$sql);

$pageTitle = "Sales History";
$activePage = "sales_history";
include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Sales History</h1>
        <p>A complete record of every sale, most recent first.</p>
    </div>
    <a href="record_sale.php" class="btn btn-primary">
        <span>&#128176;</span> Record New Sale
    </a>
</div>

<div class="table-card">
    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Sale ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row=mysqli_fetch_assoc($result))
                {
                ?>
                <tr>
                    <td>#<?php echo $row['sale_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['qty_sold']; ?></td>
                    <td><?php echo formatCurrency($row['total_price']); ?></td>
                    <td><?php echo formatDate($row['sale_date']); ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
