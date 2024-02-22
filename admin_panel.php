<?php
session_start();

include 'db_functions.php'; // Подключение к базе данных и определение функций

// Проверяем, если администратор не вошел в систему, перенаправляем его на страницу входа
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin.php");
    exit();
}

// Если был изменен статус отзыва, обновляем его в базе данных
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['review_id']) && isset($_POST['status'])) {
    $review_id = $_POST['review_id'];
    $status = $_POST['status'];
    updateReviewStatus($review_id, $status);
}

// Получаем список отзывов из базы данных
$reviews = getReviews();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-panel">
        <h2>Welcome, Admin!</h2>
        <a href="logout.php">Logout</a>

        <!-- Отображаем отзывы -->
        <h3>Reviews:</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($reviews as $review) { ?>
            <tr>
                <td><?php echo $review['name']; ?></td>
                <td><?php echo $review['email']; ?></td>
                <td><?php echo $review['message']; ?></td>
                <td><img src="<?php echo $review['image']; ?>" alt="Review Image" style="max-width: 100px;"></td>
                <td><?php echo $review['status']; ?></td>
                <td>
                    <!-- Форма для изменения статуса отзыва -->
                    <form method="post">
                        <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                        <select name="status">
                            <option value="accepted">Accept</option>
                            <option value="rejected">Reject</option>
                        </select>
                        <button type="submit">Save</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>