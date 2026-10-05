<?php

session_start();

require "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($email === "" || $password === "") {

        $error = "Please fill in all fields.";
    } else {

        // Find user by email
        $sql = "SELECT * FROM users WHERE email = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (
            $user &&
            password_verify($password, $user["password"])
        ) {

            // Create session
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_email"] = $user["email"];

            header("Location: dashboard.php");
            exit;
        } else {

            $error = "Incorrect email or password.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="login-container">

        <h2>Login</h2>

        <?php if ($error !== ""): ?>

            <p class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </p>

        <?php endif; ?>

        <form id="loginForm" method="POST">

            <div class="input-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email">

                <small
                    class="error-message"
                    id="emailError"></small>

            </div>

            <div class="input-group">

                <label for="password">
                    Password
                </label>

                <div class="password-wrapper">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password">

                    <button
                        type="button"
                        id="togglePassword">
                        Show
                    </button>

                </div>

                <small
                    class="error-message"
                    id="passwordError"></small>

            </div>


            <div class="form-action">

                <label class="remember-me">

                    <input
                        type="checkbox"
                        id="rememberMe">

                    Remember me

                </label>

                <a href="#">
                    Forgot password?
                </a>

            </div>


            <button
                type="submit"
                class="submit-btn">
                Login
            </button>

        </form>


        <p class="signup-text">

            Don't have an account?

            <a href="index.php">
                Sign up
            </a>

        </p>

    </div>

    <script src="script.js"></script>

</body>

</html>