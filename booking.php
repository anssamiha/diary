<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #e0e0e0; /* light grey */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #6a0dad; /* dark purple */
            margin-bottom: 20px;
        }
        label {
            color: #333; /* dark grey */
        }
        .form-control {
            border: 1px solid #ccc; /* light grey */
            border-radius: 5px;
        }
        .btn-submit {
            width: 100%;
            background: #6a0dad; /* dark purple */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-submit:hover {
            background: #5e0c9e; /* slightly darker purple */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Diary Booking Form</h1>
        <form id="bookingForm" action="booking.php" method="post">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="pickup_date">Pick-up Date:</label>
                <input type="date" class="form-control" id="pickup_date" name="pickup_date" required>
            </div>
            <div class="form-group">
                <label for="return_date">Return Date:</label>
                <input type="date" class="form-control" id="return_date" name="return_date" required>
            </div>
            <div class="form-group">
                <label for="book_type">Book Type:</label>
                <select class="form-control" id="book_type" name="book_type" required>
                    <option value="fiction">Fiction</option>
                    <option value="non_fiction">Non-Fiction</option>
                </select>
            </div>
            <button type="submit" class="btn btn-submit">Book Now</button>
        </form>
    </div>

    <?php
    $success = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pickup_date = $_POST['pickup_date'];
        $return_date = $_POST['return_date'];
        $book_type = $_POST['book_type'];

        // Connect to the database (you should replace the credentials with your own)
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

        // Insert the booking data into the database
        $sql = "INSERT INTO diary_booking (name, email, phone, pickup_date, return_date, book_type) 
                VALUES ('$name', '$email', '$phone', '$pickup_date', '$return_date', '$book_type')";

        if ($conn->query($sql) === TRUE) {
            $success = true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the connection
        $conn->close();

        // Redirect to list_booking.php after successful booking
        if ($success) {
            header("Location: list_booking.php");
            exit();
        }
    }
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var success = <?php echo json_encode($success); ?>;
            if (success) {
                alert("Booking successful!");
            }
        });
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
