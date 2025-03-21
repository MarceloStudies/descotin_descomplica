<?php

function renderFloatingMenuButton()
{
    ob_start();
?>
<div class="floatingButtonWrap">
    <div class="floatingButtonInner">
        <a href="#" class="floatingButton">
            <i class="fa-solid fa-bars"></i>
        </a>
        <ul class="floatingMenu">
            <li>
                <a href="logout.php" class="text-gray-200  px-4 py-2 border rounded-md"><i
                        class="fa-solid fa-door-open"></i>
                    Logout</a>
            </li>
            <li>
                <?php if ($_SESSION['user_level'] === 'admin') : ?>
                <a href="customer_form.php" class="text-gray-200  px-4 py-2 border rounded-md"><i
                        class="fa-solid fa-person-circle-plus"></i> Add Customer</a>
                <?php endif; ?>

            </li>

            <!-- <li>
                <a href="user_form.php" class="text-gray-200  px-4 py-2 border rounded-md">Add User</a>
            </li> -->
            <li>
                <a href="dashboard.php" class="text-gray-200  px-4 py-2 border rounded-md"><i
                        class="fa-solid fa-house"></i> Home</a>
            </li>

        </ul>
    </div>
</div>

<?php
    return ob_get_clean();
}
?>