<?php
// التحقق من كلمة السر
$password = "uu81619";
$success_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['password'] === $password) {
        if (isset($_POST['add_product'])) {
            $name = $_POST['name'];
            $price_usd = $_POST['price_usd'];
            $price_iqd = $_POST['price_iqd'];
            $description = $_POST['description'];

            // رفع الصورة
            $image = $_FILES['image']['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($image);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $new_product = [
                    "id" => rand(1, 1000),  // معرّف عشوائي للمنتج
                    "name" => $name,
                    "image" => $target_file,
                    "price_usd" => $price_usd,
                    "price_iqd" => $price_iqd,
                    "description" => $description
                ];

                // تخزين المنتج في ملف JSON
                $file_path = 'products.json';
                if (file_exists($file_path)) {
                    $products = json_decode(file_get_contents($file_path), true);
                } else {
                    $products = [];
                }
                $products[] = $new_product;
                file_put_contents($file_path, json_encode($products, JSON_PRETTY_PRINT));

                $success_message = "تم إضافة المنتج بنجاح!";
            } else {
                $error_message = "فشل رفع الصورة!";
            }
        }
    } else {
        $error_message = "كلمة السر غير صحيحة!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الأدمن | الحسيني لتجارة الحاسبات</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>لوحة تحكم الأدمن | الحسيني لتجارة الحاسبات</h1>
</header>

<?php if (!isset($_POST['password']) || $_POST['password'] !== $password): ?>
    <div class="login-container">
        <h2>تسجيل دخول الأدمن</h2>
        <form method="POST" action="admin.php">
            <label for="password">كلمة السر:</label>
            <input type="password" name="password" required>
            <button type="submit">تسجيل الدخول</button>
        </form>
        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="product-container">
        <h2>إضافة منتج جديد</h2>

        <?php if ($success_message): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label for="name">اسم الحاسب:</label>
            <input type="text" name="name" required><br>

            <label for="image">صورة الحاسب:</label>
            <input type="file" name="image" accept="image/*" required><br>

            <label for="price_usd">السعر بالدولار:</label>
            <input type="number" step="0.01" name="price_usd" required><br>

            <label for="price_iqd">السعر بالدينار العراقي:</label>
            <input type="number" step="0.01" name="price_iqd" required><br>

            <label for="description">وصف الحاسب:</label>
            <textarea name="description" rows="4" required></textarea><br>

            <button type="submit" name="add_product">إضافة المنتج</button>
        </form>
    </div>
<?php endif; ?>

<footer>
    <p>&copy; 2025 الحسيني لتجارة الحاسبات. جميع الحقوق محفوظة.</p>
</footer>

</body>
</html>
