<?php
session_start();

// Database configuration
$servername = "localhost:3307";
$username = "root"; // Default username for XAMPP, MAMP, etc.
$password = ""; // Default password for XAMPP, MAMP, etc.
$dbname = "user_registration"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate inputs
    if (!empty($email) && !empty($password)) {
        // Prepare and execute SQL query
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirect to home page
                header("Location: ../home.html");
                exit();
            } else {
                echo "Invalid email or password!";
            }
        } else {
            echo "No user found with this email!";
        }

        $stmt->close();
    } else {
        echo "All fields are required!";
    }
}

$conn->close();
?>
