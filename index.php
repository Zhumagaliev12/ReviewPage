<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Feedback Form</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="feedback-form">


     <h2>Leave Feedback</h2>
     <h3><a class="nav" href="admin.php">Admin</a></h3>


    <?php 
    //     if (isset($_GET['status']) && $_GET['status'] == 'success') {
    // echo "Feedback submitted successfully.";

    if (isset($_COOKIE['feedback_success'])) {
    // Отображаем сообщение
        echo "Feedback submitted successfully.";
    // Удаляем куку, чтобы сообщение исчезло после обновления страницы
    setcookie('feedback_success', '', time() - 300, '/');
}

    ?>
    <br>
    <br>
    <form action="submit_feedback.php" enctype="multipart/form-data" method="post">
        <div class="input-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        <div class="input-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/jpeg, image/png, image/gif" required>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>

<div class="feedback-list">
    <h2>Feedback List</h2>
    <ul id="feedbackList"></ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
</body>
</html>