<?php
include 'includes/db_connect.php';

$message = "";
$messageType = "";

if(isset($_POST['save']))
{
    $name = trim($_POST['name']);
    $category = intval($_POST['category']);
    $supplier = intval($_POST['supplier']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    if($name != "" && $price > 0 && $stock >= 0)
    {
        $sql = "INSERT INTO products(name,category_id,supplier_id,price,stock_qty)
                VALUES('$name','$category','$supplier','$price','$stock')";

        if(mysqli_query($conn,$sql)) {
            header("Location: products.php?added=1");
            exit();
            $messageType = "success";
        } else {
            $message = "Error.";
            $messageType = "error";
        }
    }
}

$categories=mysqli_query($conn,"SELECT * FROM categories");
$suppliers=mysqli_query($conn,"SELECT * FROM suppliers");

$pageTitle = "Add Product";
$activePage = "add_product";
include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Add Product</h1>
        <p>Register a new item into your inventory catalog.</p>
    </div>
</div>

<div class="form-card">

    <?php if ($message !== ""): ?>
        <div class="alert <?php echo $messageType === 'success' ? 'alert-success' : 'alert-error'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" placeholder="e.g. Samsung 32&quot; LED TV" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category">
                    <?php while($c=mysqli_fetch_assoc($categories)){ ?>
                    <option value="<?php echo $c['category_id']; ?>">
                        <?php echo $c['category_name']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="supplier">Supplier</label>
                <select id="supplier" name="supplier">
                    <?php while($s=mysqli_fetch_assoc($suppliers)){ ?>
                    <option value="<?php echo $s['supplier_id']; ?>">
                        <?php echo $s['supplier_name']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="price">Price (TZS)</label>
                <input type="number" step="0.01" id="price" name="price" placeholder="0.00" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock Quantity</label>
                <input type="number" id="stock" name="stock" placeholder="0" required>
            </div>
        </div>

        <div class="form-actions">
            <input type="submit" name="save" class="btn btn-primary" value="Save Product">
            <a href="products.php" class="btn btn-outline">Cancel</a>
        </div>

    </form>

</div>

<?php include 'includes/footer.php'; ?>
