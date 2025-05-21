<?php
// جلب بيانات المنتج من ملف JSON
$products = json_decode(file_get_contents('products.json'), true);

// التحقق من وجود المنتج
$product_id = $_GET['product_id'];
$product = null;

foreach ($products as $p) {
    if ($p['id'] == $product_id) {
        $product = $p;
        break;
    }
}

if (!$product) {
    echo "المنتج غير موجود.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب المنتج | الحسيني لتجارة الحاسبات</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>طلب المنتج - الحسيني لتجارة الحاسبات</h1>
</header>

<div class="order-container">
    <h2><?php echo $product['name']; ?></h2>
    <p>السعر بالدولار: $<?php echo $product['price_usd']; ?></p>
    <p>السعر بالدينار العراقي: <?php echo $product['price_iqd']; ?> IQD</p>
    <p><?php echo $product['description']; ?></p>
    <form action="submit_order.php" method="POST">
        <label for="quantity">الكمية:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <button type="submit">إتمام الطلب</button>
    </form>
</div>

<footer>
    <p>&copy; 2025 الحسيني لتجارة الحاسبات. جميع الحقوق محفوظة.</p>
</footer>

</body>
</html>
