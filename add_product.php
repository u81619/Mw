<?php
// بدء الجلسة
session_start();

// التحقق مما إذا كان الأدمن قد سجل الدخول
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // إذا لم يكن الأدمن قد سجل الدخول، إعادة توجيه إلى صفحة تسجيل الدخول
    header("Location: login.php");
    exit;
}

// إعداد الاتصال بقاعدة البيانات
$host = "localhost";  // اسم الخادم
$dbname = "shop_db";  // اسم قاعدة البيانات
$username = "root";   // اسم المستخدم
$password = "";       // كلمة المرور

try {
    // الاتصال بقاعدة البيانات
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // التحقق من إرسال البيانات عبر POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // الحصول على القيم من النموذج
        $name = $_POST['name'];
        $price_usd = $_POST['price_usd'];
        $price_iqd = $_POST['price_iqd'];
        $description = $_POST['description'];

        // التعامل مع الصورة (رفعها إلى الخادم)
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);

        // التأكد من أن الصورة قد تم رفعها بنجاح
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // إدخال البيانات في قاعدة البيانات
            $stmt = $pdo->prepare("INSERT INTO products (name, image, price_usd, price_iqd, description) 
                                   VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $target_file, $price_usd, $price_iqd, $description]);

            echo "تم إضافة المنتج بنجاح!";
        } else {
            echo "فشل رفع الصورة!";
        }
    }
} catch (PDOException $e) {
    echo "فشل الاتصال بقاعدة البيانات: " . $e->getMessage();
}
?>
