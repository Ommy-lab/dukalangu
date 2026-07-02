<?php
include 'includes/db_connect.php';

$errorMessage = "";

if(isset($_POST['save']))
{
    $product_id = intval($_POST['product']);
    $qty = intval($_POST['quantity']);

    $result = mysqli_query($conn,"SELECT * FROM products WHERE product_id=$product_id");
    $product = mysqli_fetch_assoc($result);

    $stock = $product['stock_qty'];
    $price = $product['price'];

    if($qty > 0 && $qty <= $stock)
    {
        $total = $qty * $price;

        mysqli_query($conn,"INSERT INTO sales(product_id,qty_sold,total_price)
        VALUES($product_id,$qty,$total)");

        mysqli_query($conn,"UPDATE products
        SET stock_qty = stock_qty - $qty
        WHERE product_id=$product_id");

        header("Location: sales_history.php");
        exit();
    }
    else
    {
        $errorMessage = "Insufficient stock!";
    }
}

$products = mysqli_query($conn,"SELECT * FROM products");

$pageTitle = "Record Sale";
$activePage = "record_sale";
include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Record Sale</h1>
        <p>Log a new sale and automatically update stock levels.</p>
    </div>
</div>

<div class="form-card">

    <?php if ($errorMessage !== ""): ?>
        <div class="alert alert-error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label for="product">Product</label>
            <select id="product" name="product">
                <?php while($row=mysqli_fetch_assoc($products)){ ?>
                <option value="<?php echo $row['product_id']; ?>">
                    <?php echo $row['name']; ?>
                </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" placeholder="0" required>
        </div>

        <div class="form-actions">
            <input type="submit" name="save" class="btn btn-primary" value="Record Sale">
            <a href="products.php" class="btn btn-outline">Cancel</a>
        </div>

    </form>

</div>

<?php include 'includes/footer.php'; ?>
