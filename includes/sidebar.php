<?php
// includes/sidebar.php
// Expects (optional): $activePage — set by the including page.
if (!isset($activePage)) { $activePage = ""; }

function navClass($key, $activePage) {
    return $key === $activePage ? "active" : "";
}
?>
<aside class="sidebar" id="sidebar">

    <div class="sidebar-brand">
        <div class="logo-mark">DB</div>
        <div class="brand-text">
            <strong>Duka Bora</strong>
            <span>Inventory System</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Main</div>

        <a href="dashboard.php" class="<?php echo navClass('dashboard', $activePage); ?>">
            <span class="nav-icon">&#9783;</span> Dashboard
        </a>

        <div class="nav-label">Inventory</div>

        <a href="products.php" class="<?php echo navClass('products', $activePage); ?>">
            <span class="nav-icon">&#128230;</span> Products
        </a>

        <a href="add_product.php" class="<?php echo navClass('add_product', $activePage); ?>">
            <span class="nav-icon">&#10133;</span> Add Product
        </a>

        <div class="nav-label">Sales</div>

        <a href="record_sale.php" class="<?php echo navClass('record_sale', $activePage); ?>">
            <span class="nav-icon">&#128176;</span> Record Sale
        </a>

        <a href="sales_history.php" class="<?php echo navClass('sales_history', $activePage); ?>">
            <span class="nav-icon">&#128202;</span> Sales History
        </a>

        <div class="nav-label">Insights</div>

        <a href="report.php" class="<?php echo navClass('reports', $activePage); ?>">
            <span class="nav-icon">&#128200;</span> Reports
        </a>
    </nav>

    <div class="sidebar-foot">
        Duka Bora &copy; <?php echo date("Y"); ?>
    </div>

</aside>
