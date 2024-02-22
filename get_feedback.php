<?php
// Получение списка отзывов

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "A123456a";
$dbname = "feedback_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL запрос для получения отзывов
$sql = "SELECT * FROM feedback WHERE status = 'pending' ORDER BY created_at DESC";
$result = $conn->query($sql);

// Проверка наличия отзывов
if ($result->num_rows > 0) {
    // Вывод отзывов в виде списка
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["name"] . " - " . $row["email"] . " - " . $row["message"] . "</li>";
    }
} else {
    echo "No feedback available.";
}
$conn->close();
?>