<?php
// بدء الجلسة
session_start();

// التحقق مما إذا كان الأدمن قد سجل الدخول مسبقًا
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    // إذا كان الأدمن قد سجل الدخول بالفعل، إعادة توجيهه إلى صفحة إضافة المنتج
    header("Location: add_product.html");
    exit;
}

// التحقق من تسجيل الدخول
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // كلمة السر التي نريد أن يتحقق منها الأدمن
    $correct_password = "uu81619";

    // التحقق من كلمة السر المدخلة
    if ($_POST['password'] === $correct_password) {
        // إذا كانت كلمة السر صحيحة، تعيين الجلسة
        $_SESSION['admin_logged_in'] = true;
        header("Location: add_product.html");
        exit;
    } else {
        // إذا كانت كلمة السر غير صحيحة
        $error_message = "كلمة السر غير صحيحة!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول الأدمن</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>تسجيل دخول الأدمن</h1>

    <!-- نموذج تسجيل الدخول -->
    <form action="login.php" method="POST">
        <label for="password">كلمة السر:</label>
        <input type="password" id="password" name="password" required><br><br>

        <?php
        if (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
        ?>

        <button type="submit">تسجيل الدخول</button>
    </form>
</body>
</html>
