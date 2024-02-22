<?php
function connectToDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "A123456a";
    $dbname = "feedback_db";

    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function addFeedback($name, $email, $message, $image) {
    $conn = connectToDatabase();


    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $message, $image);

    $stmt->execute();

 
    $stmt->close();
    $conn->close();
}



function getReviews() {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM feedback";

    $result = $conn->query($sql);

    $reviews = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
    }

    $conn->close();

    return $reviews;
}


function updateReviewStatus($review_id, $status) {
    $conn = connectToDatabase();
    $sql = "UPDATE feedback SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $review_id);
    
    if ($stmt->execute() === TRUE) {
        echo "Review status updated successfully.";
    } else {
        echo "Error updating review status: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}


?>