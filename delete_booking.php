<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "diary_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a delete statement
    $sql = "DELETE FROM diary_booking WHERE book_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("i", $param_id);

        // Set the parameter
        $param_id = $_POST['id'];

        // Attempt to execute the statement
        if ($stmt->execute()) {
            // Booking deleted successfully
            echo "Booking deleted successfully.";
        } else {
            echo "Error: Unable to delete the booking.";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
} else {
    echo "Error: Invalid request.";
}
?>
