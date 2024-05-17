<?php
// Establish database connection and other necessary configurations
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare the SQL statement
    $sql = "SELECT * FROM Users WHERE email = ? AND password = ? AND role = 'admin'";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        // User with admin role found, log them in
        session_start();
        $_SESSION["email"] = $email;
        $_SESSION["role"] = "admin";

        // Redirect the user to the admin dashboard or desired page
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // No user with admin role found, redirect back to login page with error message
        echo('loggin fail');
                exit();
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>
