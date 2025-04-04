<?php
session_start();
require_once './config/db.php';
require_once './controller/Customer.php';
require_once __DIR__ . '/components/FloatingMenuButton.php';


// ✅ Check if user is logged in and is an admin (level 1)
if (!isset($_SESSION['user_id']) || $_SESSION['user_level'] !== 'admin') {
    header("Location: /dashboard");
    exit();
}

// Initialize Controller
$customerController = new CustomerController($pdo);
$message = "";

// Check if Editing
$customer_id = isset($_GET['id']) ? intval($_GET['id']) : null;

// Default values (for Create Mode)
$name = "";
$code = "";
$company_name = "";
$status = "active";

// If Editing, Fetch Existing Data
if ($customer_id) {
    $customer = $customerController->getCustomer($customer_id);
    if ($customer) {
        $name = $customer["name"];
        $code = $customer["code"];
        $company_name = $customer["company_name"];
        $status = $customer["status"];
    } else {
        $message = "<p class='text-red-500'>Customer not found!</p>";
    }
}

// Handle Form Submission (Create or Update)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $code = trim($_POST["code"]);
    $company_name = trim($_POST["company_name"]);
    $status = $_POST["status"];
    $customer_id = isset($_POST["customer_id"]) ? intval($_POST["customer_id"]) : null;

    // Validate Inputs
    if (empty($name) || empty($code) || empty($company_name) || empty($status)) {
        $message = "<p class='text-red-500'>All fields are required!</p>";
    } elseif (!ctype_digit($code)) {
        $message = "<p class='text-red-500'>Code must be a numeric value!</p>";
    } else {
        if ($customer_id) {
            // ✅ UPDATE CUSTOMER
            if ($customerController->updateCustomer($customer_id, $name, $code, $company_name, $status)) {
                $message = "<p class='text-green-500'>Customer updated successfully!</p>";
            } else {
                $message = "<p class='text-red-500'>Error updating customer!</p>";
            }
        } else {
            // ✅ CREATE CUSTOMER
            if ($customerController->createCustomer($name, $code, $company_name, $status)) {
                $message = "<p class='text-green-500'>Customer added successfully!</p>";
                // Clear form after successful insert
                $name = $code = $company_name = "";
                $status = "active";
            } else {
                $message = "<p class='text-red-500'>Error adding customer!</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Add Customer - Descontin</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" href="./assets/images/logo-icon.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"
        integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">

</head>

<body class="w-full h-screen" style="background-color: #f74780;">
    <div class="w-full h-full flex justify-center items-center">
        <div class="w-full max-w-md p-6 bg-white border border-gray-200 rounded-lg shadow-md">
            <h5 class="text-xl font-medium text-gray-900 mb-4">Add Customer</h5>
            <?= $message ?>
            <!-- Show success/error message -->

            <form action="/customer_form.php<?= $customer_id ? "?edit=?$customer_id" : "" ?>" method="POST">
                <input type="hidden" name="customer_id" value="<?= $customer_id ?>">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Customer Name</label>
                    <input type="text" name="name" id="name" required value="<?= $name ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                </div>

                <div class="mb-4">
                    <label for="code" class="block text-sm font-medium text-gray-700">Customer Code</label>
                    <input type="text" name="code" id="code" required value="<?= $code ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                </div>

                <div class="mb-4">
                    <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="company_name" id="company_name" required value="<?= $company_name ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" required value="<?= $status ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700">
                    <?= $customer_id ? "Update Customer" : "Add Customer" ?>
                </button>
            </form>
        </div>
    </div>

    <div class="nav-bar">
        <?= renderFloatingMenuButton() ?>
    </div>

</body>
<script src="script.js"></script>

</html>