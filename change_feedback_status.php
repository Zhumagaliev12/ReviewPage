<?php
include 'db_functions.php'; // Подключение к базе данных и определение функций

// Обработка отправки формы обратной связи
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message']) && isset($_FILES['image'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $image = $_FILES['image']['name'];

        // Проверка размера и типа изображения
        if ($_FILES['image']['size'] > 1000000) { // Ограничение до 1MB
            echo "Error: Image size exceeds the limit of 1MB.";
        } elseif (!in_array($_FILES['image']['type'], array('image/jpeg', 'image/png', 'image/gif'))) {
            echo "Error: Invalid image format. Only JPG, PNG, and GIF are allowed.";
        } else {
            // Сохранение изображения в папке на сервере
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);

            // Добавление отзыва в базу данных
            addFeedback($name, $email, $message, $image);

            echo "Feedback submitted successfully.";
        }
    } else {
        echo "Missing data.";
    }
}

// Обработка изменения статуса отзыва
if (isset($_GET['feedback_id']) && isset($_GET['new_status'])) {
    $feedbackId = $_GET['feedback_id'];
    $newStatus = $_GET['new_status'];

    changeFeedbackStatus($feedbackId, $newStatus);
}
?>