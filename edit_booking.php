<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Edit Booking</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
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

            $id = $_GET['id'];

            // Fetch booking data from the database
            $sql = "SELECT * FROM diary_booking WHERE book_id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Display the form for editing using the fetched data
                ?>
                <form action="update_booking.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['book_id']; ?>">
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="pickup_date">Pick-up Date:</label>
                        <input type="date" class="form-control" id="pickup_date" name="pickup_date" value="<?php echo $row['pickup_date']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="return_date">Return Date:</label>
                        <input type="date" class="form-control" id="return_date" name="return_date" value="<?php echo $row['return_date']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="book_type">Book Type:</label>
                        <select class="form-control" id="book_type" name="book_type" required>
                            <option value="fiction" <?php echo ($row['book_type'] == 'fiction') ? 'selected' : ''; ?>>Fiction</option>
                            <option value="non_fiction" <?php echo ($row['book_type'] == 'non_fiction') ? 'selected' : ''; ?>>Non-Fiction</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                <?php
            } else {
                echo "Booking not found.";
            }

            // Close the connection
            $conn->close();
        } else {
            echo "Error: Invalid request.";
        }
        ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
