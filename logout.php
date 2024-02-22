<?php
session_start();

// Удаляем сессию администратора
session_destroy();

// Перенаправляем администратора на страницу входа
header("Location: admin.php");
exit();
?>