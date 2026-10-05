//Logout និងបញ្ចប់ Session
<?php

session_start();

session_unset();

session_destroy();

header("Location: login.php");

exit;