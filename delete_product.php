<?php
// التحقق من وجود معرّف المنتج
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // قراءة ملف المنتجات
    $file_path = 'products.json';

    if (file_exists($file_path)) {
        $products = json_decode(file_get_contents($file_path), true);

        // البحث عن المنتج وحذفه
        foreach ($products as $key => $product) {
            if ($product['id'] == $product_id) {
                unset($products[$key]);  // حذف المنتج من المصفوفة
                break;
            }
        }

        // إعادة ترتيب المصفوفة لإزالة الفجوات
        $products = array_values($products);

        // حفظ البيانات المحدثة إلى الملف
        file_put_contents($file_path, json_encode($products, JSON_PRETTY_PRINT));

        // إعادة التوجيه إلى الصفحة الرئيسية بعد الحذف
        header("Location: index.html");
        exit;
    } else {
        echo "فشل في تحميل بيانات المنتجات!";
    }
} else {
    echo "لم يتم تحديد المنتج لحذفه.";
}
?>
