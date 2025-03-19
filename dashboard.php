<?php
session_start();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/controller/Customer.php';

//✅ Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}



$customerController = new CustomerController($pdo);
$customers = []; // Default empty
$search = "";

// Handle Search
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = trim($_POST['search']);
    if (!empty($search)) {
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE name LIKE '%$search%' OR code LIKE '%$search%' ");
        $stmt->execute();
        $customers = $stmt->fetchAll();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
    .status-active {
        color: #5f7861;
        font-weight: bold;
    }

    .status-inactive {
        color: #f74780;
        font-weight: bold;
    }

    .container-descontin {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        flex-direction: column;
        height: 76%;
        width: 100%;
        max-width: 920px;
        background-color: #f74780;
        border-radius: 40px;


    }

    .container-descontin img {
        width: 100%;
        max-width: 300px;
        height: auto;
    }

    .container-descontin .title {
        color: white;
        font-size: 20px;
        font-weight: bold;
        margin-top: 20px;
    }

    .container-descontin input {
        width: 100%;
        /* max-width: 300px; */
        padding: 10px;
        border-radius: 10px;
        border: none;
        margin-top: 10px;
    }
    </style>
</head>

<body class="w-full h-screen bg-gray-200 flex justify-center items-center">
    <div class="container-descontin">
        <img src="./assets/images/logo.png" alt="">
        <div class="" style="width:72%">
            <span class="title"> Digite o nome ou o código do usuário:</span>
            <form class="w-full flex flex-row gap-3" action="dashboard.php" method="POST">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
                    class="p-2 border rounded-md w-1/3">
                <!-- <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Search</button> -->
            </form>
            <?php if (!empty($customers)) : ?>
            <table class=" w-full mt-6">
                <thead>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer) : ?>
                    <tr class="bg-gray-200 flex flex-row gap-3 py-2 rounded-md " style="justify-content: space-around;">
                        <td class=""><span class="font-bold text-gray-600">Nome:
                            </span><?= htmlspecialchars($customer['name']) ?></td>
                        <td class=""><span class="font-bold text-gray-600">Codigo:
                            </span><?= htmlspecialchars($customer['code']) ?></td>
                        <td class=""><span class="font-bold text-gray-600">Empresa:
                            </span><?= htmlspecialchars($customer['company_name']) ?></td>
                        <td class=" <?= ($customer['status'] === 'active') ? 'status-active' : 'status-inactive' ?>">
                            <span class="font-bold text-gray-600">Status: </span>
                            <?= strtoupper(htmlspecialchars($customer['status'])) ?>
                        </td>
                        <?php if ($_SESSION['user_level'] === 'admin') : ?>
                        <td class="">
                            <a href="customer_form.php?id=<?= $customer['id'] ?>"
                                class="  px-3 py-1 text-green-600">Edit</a>
                        </td>

                        <?php endif; ?>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>



        <?php if ($_SESSION['user_level'] === 'admin') : ?>
        <div class="mt-14">
            <a href="customer_form.php" class="text-gray-200  px-4 py-2 border rounded-md">Add Customer</a>
        </div>
        <?php endif; ?>

    </div>



</body>

</html>