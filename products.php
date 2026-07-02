<?php
include 'includes/db_connect.php';
include 'includes/functions.php';

$sql = "SELECT
            products.product_id,
            products.name,
            categories.category_name,
            suppliers.supplier_name,
            products.price,
            products.stock_qty
        FROM products
        INNER JOIN categories
            ON products.category_id = categories.category_id
        INNER JOIN suppliers
            ON products.supplier_id = suppliers.supplier_id";

$result = mysqli_query($conn, $sql);

$pageTitle = "Products";
$activePage = "products";
include 'includes/header.php';
?>

<?php
if (isset($_GET['added']))
    {
        echo "<div class='alert alert-success'>
        Product added successfully.
        </div>";
    }
?>

<?php
if (isset($_GET['Updated']))
    {
        echo "<div class='alert alert-success'>
        Product updated successfully.
        </div>";
    }
?>

<?php
if (isset($_GET['deleted']))
    {
        echo "<div class='alert alert-success'>
        Product deleted successfully.
        </div>";
    }
?>

<div class="page-header">
    <div>
        <h1>Product List</h1>
        <p>Browse, search, and manage every item in your inventory.</p>
    </div>
    <a href="add_product.php" class="btn btn-primary">
        <span>&#10133;</span> Add New Product
    </a>
</div>

<div class="table-card">

    <div class="table-toolbar">
        <div class="search-box">
            <span class="search-icon">&#128269;</span>
            <input type="text" id="productSearch" placeholder="Search products, category or supplier...">
        </div>
    </div>

    <div class="table-scroll">
        <table class="data-table" id="productsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td>#<?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td><?php echo $row['supplier_name']; ?></td>
                    <td><?php echo formatCurrency($row['price']); ?></td>
                    <td><?php echo renderStockBadge($row['stock_qty']); ?></td>
                    <td>
                        <div class="row-actions">
                            <a class="btn btn-success btn-sm" href="edit_product.php?id=<?php echo $row['product_id']; ?>">
                                &#9998; Edit
                            </a>
                            <a class="btn btn-danger btn-sm"
                               href="delete_product.php?id=<?php echo $row['product_id']; ?>"
                               onclick="return confirmDelete('Are you sure you want to delete this product?')">
                                &#128465; Delete
                            </a>
                        </div>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
