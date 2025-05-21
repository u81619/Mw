<?php
// بدء الجلسة
session_start();

// تدمير الجلسة وتسجيل الخروج
session_destroy();

// إعادة توجيه المستخدم إلى صفحة تسجيل الدخول بعد الخروج
header("Location: login.php");
exit;
?>
