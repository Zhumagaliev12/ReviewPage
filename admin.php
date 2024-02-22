<?php
session_start();

// Проверяем, если администратор уже вошел в систему, перенаправляем его на административную панель
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_panel.php");
    exit();
}

// Проверяем, если данные формы отправлены
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем введенные администратором учетные данные
    if ($_POST['username'] === 'admin' && $_POST['password'] === '123') { // Здесь логин и пароль администратора
        // Устанавливаем сессию для аутентификации администратора
        $_SESSION['admin_logged_in'] = true;
        // Перенаправляем администратора на административную панель
        header("Location: admin_panel.php");
        exit();
    } else {
        // Если введены неверные учетные данные, показываем сообщение об ошибке
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h3><a class="nav" href="index.php">Main page</a></h3>
        <h2>Admin Login</h2>
        <?php if (isset($error_message)) { ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>