<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controller/User.php';

// Initialize UserController
$userController = new UserController($pdo);
$message = "";

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Basic Validation
    if (empty($name) || empty($email) || empty($password)) {
        $message = "<p class='text-red-500'>All fields are required!</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<p class='text-red-500'>Invalid email format!</p>";
    } else {
        // Create User
        if ($userController->createUser($name, $email, $password)) {
            $message = "<p class='text-green-500'>Account created successfully!</p>";
        } else {
            $message = "<p class='text-red-500'>Error creating account!</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Register - HoldCompany</title>
    <link rel="icon" href="./assets/images/logo-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>

<body class="w-full h-screen bg-pink-500">
    <div class="w-full h-full flex justify-center items-center">
        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 ">
            <form class="space-y-6" action="<?php require_once  __DIR__ . '/../views/register.php' ?>?responde=success"
                method="POST">
                <h5 class="text-xl font-medium text-gray-900 ">Create an Account</h5>
                <?= $message ?>
                <!-- Show success/error message -->

                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Full Name</label>
                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="John Doe" required />
                </div>

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Your Email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="name@company.com" required />
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        required />
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                    Create Account
                </button>
            </form>
        </div>
    </div>
</body>

</html>