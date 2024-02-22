$(document).ready(function() {
    // Обработчик отправки формы обратной связи
    $('#feedbackForm').submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: 'submit_feedback.php', // Путь к файлу обработчику на сервере
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Обновляем список отзывов после успешной отправки
                updateFeedbackList();
            }
        });
    });

    // Функция для обновления списка отзывов
    function updateFeedbackList() {
        $.ajax({
            url: 'get_feedback.php', // Путь к файлу для получения списка отзывов
            type: 'GET',
            success: function(response) {
                $('#feedbackList').html(response); // Обновляем содержимое списка отзывов
            }
        });
    }

    // Вызываем функцию обновления списка отзывов при загрузке страницы
    updateFeedbackList();
});