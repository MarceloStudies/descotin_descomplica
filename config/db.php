<?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    exit("Access denied!");
}

// Database configuration
$host = 'mysql'; // or 'localhost'
$dbname = 'descontin_holdcompany'; // Change this to your database name
$username = 'root'; // Default XAMPP MySQL user
$password = 'rootpassword'; // Default XAMPP MySQL password (empty)

// PDO Connection
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions for errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as an associative array
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
    ];

    $pdo = new PDO($dsn, $username, $password, $options);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Optional: Uncomment for debugging (Will print if connection is successful)
// echo "Connected successfully!";
?>
