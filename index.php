<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/controller/User.php';
require_once __DIR__ . '/controller/Customer.php';


if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$userController = new UserController($pdo);
$message = "";

// Handle Login Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if ($userController->loginUser($email, $password)) {
        header("Location: dashboard.php"); // Redirect to dashboard
        exit();
    } else {
        $message = "<p class='text-red-500'>Invalid email or password!</p>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Login - HoldCompany</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link rel="icon" href="./assets/images/logo-icon.png" type="image/x-icon">

</head>

<body class="w-full h-screen" style="background-color: #f74780;display: flex;justify-content: center;">

    <div class="w-full h-full flex flex-col justify-center items-center gap-4">
        <div class="container-descontin-image">
            <img src="./assets/images/logo.png" alt="Hold Company Logo"
                style="width: 100%; max-width: 300px; height: auto; ">
        </div>
        <div class="w-full max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md">
            <form action="/" method="POST">
                <h5 class="text-xl font-medium text-gray-900 mb-4">Acesse sua conta</h5>
                <?= $message ?>
                <!-- Show error message -->

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 border-gray-100">Email</label>
                    <input type="email" name="email" id="email" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" name="password" id="password" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700">Entrar</button>
                <p class="mt-4 text-sm text-gray-600">Não tem uma conta? <a href="register.php"
                        class="text-blue-600 hover:underline">Crie uma</a></p>

            </form>
        </div>
    </div>
</body>

</html>