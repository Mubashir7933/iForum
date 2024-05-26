<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php 
    include('partials/dbconnect.php');
    include('partials/header.php');
    ?>

<?php 
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($connection,$sql);

    while( $row = mysqli_fetch_assoc($result) ){
        $threadTitle = $row["thread_title"];
        $threadDesc = $row["thread_desc"];
        $commented  = $row["thread_user_id"];
       
        $sql2 = "SELECT user_email FROM `users` WHERE sno = '$commented'";
        $result2 = mysqli_query($connection,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted = $row2['user_email'];

    }
    ?>
    <?php
    
    $alert = false;
$method = $_SERVER['REQUEST_METHOD'];
if( $method == 'POST'){
    $comment = $_POST['comment'];
    $comment = str_replace("<","&lt",$comment);
    $comment = str_replace(">","&gt",$comment);
    $sno = $_POST['sno'];
    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno',current_timestamp())";
$result = mysqli_query($connection,$sql);
$alert = true;
if($alert){
    echo '<div class="alert alert-success  alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You entered your thread successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

}
   
    ?>

  <div class ="container">
<div class="bg-light p-5 rounded-lg m-3">
<h1 class="display-4"><?php echo $threadTitle?></h1>
<p class="lead"> <?php echo $threadDesc?></p>
<hr class="my-4">
<p>no spam, advertising allowed.</p>
<p>Posted by :<?php echo $posted; ?></p>
</div>
        
        
        <?php 
//session_start();

?>

<?php
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
echo'
        <div class="container">
        <form action="'. $_SERVER['REQUEST_URI'].'"  method="post">
        <div class="mb-3">
        <div class="mb-3">
        <label for="exampleFormControlTextarea1" name="desc" class="form-label" required>Enter your comments</label>
        <textarea class="form-control" id="comment" type="text"  name="comment"  rows="3"></textarea>
        <input type="hidden" name="sno" value= "' .$_SESSION["sno"]. '" >
        
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
     
        </div>
        ';
    }
    else{
        echo '
        <p>Please login to continue</p>
        ';
    }
                ?>
    <div class="container">
        <?php 
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id = $id ";
    $result = mysqli_query($connection,$sql);
    $noResult = true;
    while( $row = mysqli_fetch_assoc($result) ){
        $noResult = false;
        $id =   $row['comment_id'];
        $content = $row['comment_content'];
        $time = $row['comment_time'];
        $threadUserId = $row['comment_by'];

        $sql2 = "SELECT user_email FROM `users` WHERE sno = '$threadUserId'";
        $result2 = mysqli_query($connection,$sql2);
        $row2 = mysqli_fetch_assoc($result2);

        echo '
        <div class="d-flex mt-5 ">
        <div class="flex-shrink-0">
        <img src="images/download.jpeg" width="60" alt="...">
        </div>
        <div class="flex-grow-1 ms-3 clearfix">
        <p class="fw-bold my-0">'.$row2 ['user_email'].'. at '.$time.'</p>
        <p>'.$content.'</p>
        </div>
        </div>
        ';
    }
    if($noResult){
        echo '<div class="container mt-3">
        <div class="mt-4 p-5 bg-primary text-white rounded">
          <h1>NO Queries yet</h1> 
          <p>Please be the first one to add query</p> 
        </div>
      </div>';
    }
    
            ?>
    </div>
    <?php 
echo '<div class="text-center container-fluid bg-dark text-light fixed-bottom my-10">2024|All rights reserved</div>'
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>