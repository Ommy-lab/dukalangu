<?php
include 'includes/db_connect.php';

$id=intval($_GET['id']);

if(isset($_POST['update']))
{
$name=trim($_POST['name']);
$price=floatval($_POST['price']);
$stock=intval($_POST['stock']);

$sql="UPDATE products
SET name='$name',
price='$price',
stock_qty='$stock'
WHERE product_id=$id";

if(mysqli_query($conn,$sql)){
    header("Location: products.php?updated=1");
    exit();
    $messageType = "success";
} else {
    $message = "Error";
    $messageType = "error";
    }
}


$product=mysqli_query($conn,"SELECT * FROM products WHERE product_id=$id");
$row=mysqli_fetch_assoc($product);

$pageTitle = "Edit Product";
$activePage = "products";
include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Edit Product</h1>
        <p>Update the details for <?php echo $row['name']; ?>.</p>
    </div>
</div>

<div class="form-card">

    <form method="POST">

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="price">Price (TZS)</label>
                <input type="number" step="0.01" id="price" name="price" value="<?php echo $row['price']; ?>" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock Quantity</label>
                <input type="number" id="stock" name="stock" value="<?php echo $row['stock_qty']; ?>" required>
            </div>
        </div>

        <div class="form-actions">
            <input type="submit" name="update" class="btn btn-primary" value="Update Product">
            <a href="products.php" class="btn btn-outline">Cancel</a>
        </div>

    </form>

</div>

<?php include 'includes/footer.php'; ?>