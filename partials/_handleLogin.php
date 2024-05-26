<?php $showAlert = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include("dbconnect.php");

    // Check if form fields are set before accessing them
    if (isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
        $userEmail = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];

        $existSql = "SELECT * FROM users WHERE user_email = '$userEmail'";
        $result = mysqli_query($connection, $existSql);
        $numRows = mysqli_num_rows($result);

        if ($numRows == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["user_password"])) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION['sno'] = $row['sno'];
                $_SESSION["user_email"] = $userEmail; // Corrected session variable name
                header("Location: /forum/index.php?loginsuccess=true");
            } else {
                $showError = "Invalid Credentials";
            }
        } else {
            $showError = "Invalid Credentials";
        }

        if (isset($showError)) {
            header("Location: /forum/index.php?loginsuccess=false&error=$showError");
            exit();
        }
    } 
}
?>
