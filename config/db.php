<?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    exit("Access denied!");
}

// Database configuration
if ($_SERVER['SERVER_NAME'] === 'descontin_holdcompany.local') {
    $host = 'mysql';
    $dbname = 'descontin_holdcompany'; // Change this to your local database name
    $username = 'root'; // Default local MySQL user
    $password = 'rootpassword'; // Default local MySQL password (usually empty)
}else{
    
    $host = '162.241.2.123'; // or 'localhost'
    $dbname = 'carta070_descontin_descomplica'; // Change this to your database name
    $username = 'carta070_marcelo_dev'; // Default XAMPP MySQL user
    $password = '{4uv[ZhQ4.#}'; // Default XAMPP MySQL password (empty)
    
}

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