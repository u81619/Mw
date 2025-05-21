<?php
// تعريف المنتجات في ملف JSON
$products = [
    [
        "id" => 1,
        "name" => "حاسب محمول 1",
        "image" => "uploads/laptop1.jpg",
        "price_usd" => 500,
        "price_iqd" => 750000,
        "description" => "حاسب محمول بمواصفات عالية."
    ],
    [
        "id" => 2,
        "name" => "حاسب محمول 2",
        "image" => "uploads/laptop2.jpg",
        "price_usd" => 700,
        "price_iqd" => 1050000,
        "description" => "حاسب محمول ممتاز للعمل والدراسة."
    ],
    [
        "id" => 3,
        "name" => "حاسب محمول 3",
        "image" => "uploads/laptop3.jpg",
        "price_usd" => 650,
        "price_iqd" => 975000,
        "description" => "حاسب محمول مع تصميم مميز."
    ]
];
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الحسيني لتجارة الحاسبات</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>الحسيني لتجارة الحاسبات</h1>
    <nav>
        <a href="index.php">الرئيسية</a>
        <a href="admin.php">لوحة التحكم</a>
    </nav>
</header>

<div class="products-container">
    <h2>المنتجات المتاحة</h2>

    <div class="products-list">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                <h3><?php echo $product['name']; ?></h3>
                <p class="product-price">السعر بالدولار: $<?php echo $product['price_usd']; ?></p>
                <p class="product-price">السعر بالدينار العراقي: <?php echo $product['price_iqd']; ?> IQD</p>
                <p class="product-description"><?php echo $product['description']; ?></p>
                <a href="order.php?product_id=<?php echo $product['id']; ?>" class="order-button">اطلب الآن</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<footer>
    <p>&copy; 2025 الحسيني لتجارة الحاسبات. جميع الحقوق محفوظة.</p>
</footer>

</body>
</html>
