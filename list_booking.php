<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking List</title>
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
            padding: 20px;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
        }
        h1 {
            text-align: center;
            color: #6a0dad; /* dark purple */
            margin-bottom: 20px;
        }
        table {
            width: 100%;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #6a0dad; /* dark purple */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .action-icons {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .edit-icon,
        .delete-icon {
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .edit-icon:hover {
            color: blue;
        }
        .delete-icon:hover {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Booking List</h1>
        <!-- Back button -->
        <a href="booking.php" class="btn btn-secondary mb-3">Back</a>
        <!-- Search input -->
        <div class="mb-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Search...">
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Pick-up Date</th>
                    <th>Return Date</th>
                    <th>Book Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="bookingTableBody">
                <?php
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

                // Fetch booking data from the database
                $sql = "SELECT book_id, name, email, phone, DATE_FORMAT(pickup_date, '%d/%m/%Y') AS pickup_date, DATE_FORMAT(return_date, '%d/%m/%Y') AS return_date, book_type FROM diary_booking";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row["name"]) . "</td>
                                <td>" . htmlspecialchars($row["email"]) . "</td>
                                <td>" . htmlspecialchars($row["phone"]) . "</td>
                                <td>" . htmlspecialchars($row["pickup_date"]) . "</td>
                                <td>" . htmlspecialchars($row["return_date"]) . "</td>
                                <td>" . htmlspecialchars($row["book_type"]) . "</td>
                                <td class='action-icons'>
                                    <span class='edit-icon' onclick='editBooking(" . $row["book_id"] . ")'>✎</span>
                                    <span class='delete-icon' onclick='deleteBooking(" . $row["book_id"] . ")'>❌</span> 
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No bookings found</td></tr>";
                }

                // Close the connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to filter table rows based on search input
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var searchText = $(this).val().toLowerCase();
                $('#bookingTableBody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1)
                });
            });
        });

        function editBooking(id) {
            // Redirect to edit page with the booking ID
            window.location.href = "edit_booking.php?id=" + id;
        }

        function deleteBooking(id) {
            // Perform AJAX request to delete booking
            $.ajax({
                type: "POST",
                url: "delete_booking.php",
                data: { id: id },
                success: function(response) {
                    // Reload the page after successful deletion
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    alert("An error occurred while deleting the booking.");
                }
            });
        }
    </script>
</body>
</html>
