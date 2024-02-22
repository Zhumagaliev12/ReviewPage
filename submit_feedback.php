<?php
include 'db_functions.php'; // Подключение к базе данных и определение функций

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, что все необходимые поля заполнены
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message']) && isset($_FILES['image'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $image = $_FILES['image']['name'];

        // Проверяем размер и тип изображения
        if ($_FILES['image']['size'] > 1000000) { // Ограничение до 1MB
            echo "Error: Image size exceeds the limit of 1MB.";
        } elseif (!in_array($_FILES['image']['type'], array('image/jpeg', 'image/png', 'image/gif'))) {
            echo "Error: Invalid image format. Only JPG, PNG, and GIF are allowed.";
        } else {
            // Сохраняем изображение в папке на сервере
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);

            // Добавляем отзыв в базу данных
            addFeedback($name, $email, $message, $image);

            header("Location: index.php?status=success");
            setcookie('feedback_success', 'true', time() + 5, '/');
            exit();
        }
    } else {
        echo "Missing data.";
    }
}
?>