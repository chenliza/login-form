<?php

require "config.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($name === "" || $email === "" || $password === "") {

        $message = "Please fill in all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Invalid email.";

    } elseif (strlen($password) < 6) {

        $message = "Password must be at least 6 characters.";

    } else {

        // Check if email already exists
        $checkSql = "SELECT id FROM users WHERE email = ?";

        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$email]);

        if ($checkStmt->fetch()) {

            $message = "Email already exists.";

        } else {

            // Hash password
            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            // Insert user
            $sql = "INSERT INTO users (name, email, password)
                    VALUES (?, ?, ?)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $name,
                $email,
                $hashedPassword
            ]);

            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="login-container">

    <h2>Register</h2>

    <?php if ($message !== ""): ?>
        <p class="error-message">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        <div class="input-group">

            <label for="name">Name</label>

            <input
                type="text"
                id="name"
                name="name"
                placeholder="Enter your name"
            >

        </div>

        <div class="input-group">

            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
            >

        </div>

        <div class="input-group">

            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
            >

        </div>

        <button type="submit" class="submit-btn">
            Register
        </button>

    </form>

    <p class="signup-text">
        Already have an account?
        <a href="login.php">Login</a>
    </p>

</div>

</body>
</html>