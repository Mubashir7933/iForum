<?php

session_start();
include("dbconnect.php");
include('partials/loginModal.php');
include('partials/signupModal.php');
include('partials/_handleSignup.php');
include('partials/_handleLogin.php');
echo '<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="#">iForums</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         Top categories
        </a>
        <ul class="dropdown-menu">';
        $sql = "SELECT category_name, category_id FROM `forum`";
        $result = mysqli_query($connection,$sql);
        while($row = mysqli_fetch_assoc($result)){
         echo' <li><a class="dropdown-item" href="threads.php?catid='.$row['category_id'].'">' .$row['category_name']. '</a></li>';
        }
        echo '</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" >Contacts</a>
      </li>
    </ul>';
    if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])== true ) {
      echo'
      <form class="d-flex " role="search">
      <p class="text-light my-1 mx-2">'.$_SESSION['user_email'].'</p>
      <a href="partials/logout.php" role="button" class="btn btn-outline-success mr-3" type="submit">logout</a>
      </form>
      ';
    }
    else{
      echo '
      <div class="gap-3">
      <button class="btn btn-success ms-3" data-bs-toggle="modal" data-bs-target="#loginModal">login</button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">SignUp</button>
      </div>
      ';
    }
 echo '</div>
</div>
</nav>';



if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
  echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You can now login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
} elseif (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {
  $error = isset($_GET['error']) ? $_GET['error'] : "Unknown error";
  echo '<div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
    <strong>Error!</strong> ' . htmlspecialchars($error) . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true" && isset($_SESSION['loginEmail'])) {
  $userEmail = htmlspecialchars($_SESSION['loginEmail']);
  echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You are logged in as ' . $userEmail . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

if($alert){
  echo '<div class="alert alert-success  alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You entered your thread successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
}?>