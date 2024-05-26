<?php
$showAlert = "false";
$showError = '';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    include('dbconnect.php');

    // Check if form fields are set before accessing them
    if (isset($_POST['signUpEmail']) && isset($_POST['emailPassword']) && isset($_POST['emailCPassword'])) {
        $userEmail = $_POST['signUpEmail'];
        $password = $_POST['emailPassword'];
        $cpassword = $_POST['emailCPassword'];

        // Check if user already exists
        $existSql = "SELECT * FROM `users` WHERE user_email = '$userEmail'";
        $result = mysqli_query($connection, $existSql);
        $numRows = mysqli_num_rows($result);

        if ($numRows > 0) {
            $showError = "This user already exists";
        } else if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_password`, `time`) VALUES ('$userEmail', '$hash', current_timestamp())";
            $result = mysqli_query($connection, $sql);

            if ($result) {
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            } else {
                $showError = "Signup failed, please try again.";
            }
        } else {
            $showError = "Passwords do not match";
        }
    } else {
        $showError = "All fields are required.";
    }
}?>
