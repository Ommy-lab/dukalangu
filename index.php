<?php
include 'includes/db_connect.php';
include 'includes/functions.php';

// --- Today's Sales ---
$todayResult = mysqli_query($conn, "SELECT COALESCE(SUM(total_price),0) AS today_total, COUNT(*) AS today_count FROM sales WHERE DATE(sale_date) = CURDATE()");
$todayRow = mysqli_fetch_assoc($todayResult);

// --- Total Products ---
$totalProductsResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
$totalProductsRow = mysqli_fetch_assoc($totalProductsResult);

// --- Low Stock Products ---
$lowStockResult = mysqli_query($conn, "SELECT COUNT(*) AS low_stock FROM products WHERE stock_qty > 0 AND stock_qty < 10");
$lowStockRow = mysqli_fetch_assoc($lowStockResult);

// --- Out of Stock Products ---
$outOfStockResult = mysqli_query($conn, "SELECT COUNT(*) AS out_of_stock FROM products WHERE stock_qty = 0");
$outOfStockRow = mysqli_fetch_assoc($outOfStockResult);

// --- Recently added products ---
$recentResult = mysqli_query($conn, "SELECT product_id, name, price, stock_qty FROM products ORDER BY product_id DESC LIMIT 5");

$pageTitle = "Dashboard";
$activePage = "dashboard";
include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Welcome back, Omary</h1>
        <p>Here's what's happening at Duka Bora today.</p>
    </div>
</div>

<div class="stats-grid">

    <div class="stat-card stat-blue">
        <div class="stat-icon">&#128176;</div>
        <div>
            <div class="stat-value"><?php echo formatCurrency($todayRow['today_total']); ?></div>
            <div class="stat-label">Today's Sales</div>
        </div>
    </div>

    <div class="stat-card stat-purple">
        <div class="stat-icon">&#128230;</div>
        <div>
            <div class="stat-value"><?php echo intval($totalProductsRow['total']); ?></div>
            <div class="stat-label">Total Products</div>
        </div>
    </div>

    <div class="stat-card stat-orange">
        <div class="stat-icon">&#9888;</div>
        <div>
            <div class="stat-value"><?php echo intval($lowStockRow['low_stock']); ?></div>
            <div class="stat-label">Low Stock Products</div>
        </div>
    </div>

    <div class="stat-card stat-green">
        <div class="stat-icon">&#10060;</div>
        <div>
            <div class="stat-value"><?php echo intval($outOfStockRow['out_of_stock']); ?></div>
            <div class="stat-label">Out of Stock Products</div>
        </div>
    </div>

</div>

<div class="card card-hover">
    <h3 style="margin-top:0; font-size:15px; color: var(--secondary);">Recently Added Products</h3>

    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($recentResult) === 0): ?>
                <tr><td colspan="4" style="color: var(--text-muted);">No products yet.</td></tr>
                <?php else: ?>
                    <?php while ($row = mysqli_fetch_assoc($recentResult)) { ?>
                    <tr>
                        <td>#<?php echo $row['product_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo formatCurrency($row['price']); ?></td>
                        <td><?php echo renderStockBadge($row['stock_qty']); ?></td>
                    </tr>
                    <?php } ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
