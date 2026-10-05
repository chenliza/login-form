//ទំព័រដែល User ចូលបានក្រោយ Login

<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit;
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="login-container">

        <h2>
            Welcome!
        </h2>

        <p>
            Hello,
            <strong>
                <?php
                echo htmlspecialchars($_SESSION["user_name"]);
                ?>
            </strong>
        </p>

        <p>
            Email:
            <?php
            echo htmlspecialchars($_SESSION["user_email"]);
            ?>
        </p>

        <a
            href="logout.php"
            class="submit-btn"
            style="display:block; text-align:center; text-decoration:none;">
            Logout
        </a>

    </div>

</body>

</html>