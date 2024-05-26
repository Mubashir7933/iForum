<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>

            .container{
                min-height:30vh;
            }
            </style>
</head>

<body>
    <?php 
    include('partials/dbconnect.php');
    include('partials/header.php');
    ?>
<?php 
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `forum` WHERE category_id = $id ";
    $result = mysqli_query($connection,$sql);
    while( $row = mysqli_fetch_assoc($result) ){
        $nameTitle = $row["category_name"];
    }
    ?>

<?php 
$alert = false;
$method = $_SERVER['REQUEST_METHOD'];
if( $method == 'POST'){
    $th_title = $_POST['title'];
    $th_desc = $_POST['desc'];

    $th_title = str_replace("<","&lt",$th_title);
    $th_title = str_replace(">","&gt",$th_title);

    $th_desc = str_replace("<","&lt",$th_desc);
    $th_desc = str_replace(">","&gt",$th_desc);
    $sno = $_POST['sno'];
    $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', ' $th_desc', '$id', '$sno', current_timestamp());";
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




<div class="container mb-5">
    <div class="bg-light p-5 rounded-lg m-3">
        <h1 class="display-4">Welcome to <?php echo $nameTitle ?> forums!</h1>
        <p class="lead">here you can discuss your quries regarding coding and software developement, community like
            home, helping each other make us grow.</p>
        <hr class="my-4">
        <p>no spam, advertising allowed.</p>
    </div>
</div>



    <?php
    if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']) == true ){
echo '
<div class="container">
<form action="'.$_SERVER["REQUEST_URI"].'"method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Enter your title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="title"
                placeholder="Write your concern title">
            </div>
            <div class="mb-3">
            <label for="exampleFormControlTextarea1" name="desc" class="form-label" required>Explain your query here</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" type="text"  name="desc"  rows="3"></textarea>
            <input type="hidden" name="sno" value= "' . $_SESSION["sno"]. '" >
            
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            ';
        }
        else{
            echo '<div class="container mb-5">
            <div class="bg-light p-5 rounded-lg m-3">
                <h4 class="lead">Please login or Signup to join discussion.</h4>
                <hr class="my-4">
                <p>no spam, advertising allowed.</p>
            </div>
        </div>';
        }
        ?>
        

    <div class="container">
        <h2 class="ms-3">Browse for questions</h2>
        <?php 
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id ";
    $result = mysqli_query($connection,$sql);
    $noResult = true;
    while( $row = mysqli_fetch_assoc($result) ){
        $noResult = false;
        $id =   $row['thread_id'];
        $mediaTitle = $row['thread_title'];
        $media_discuss = $row['thread_desc'];
        $time = $row['timestamp'];
        $threadUserId = $row['thread_user_id'];
        $sql2 = "SELECT user_email FROM `users` WHERE sno = '$threadUserId'";
        $result2 = mysqli_query($connection,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        
        echo '
        <div class="d-flex mt-5 ">
        <div class="flex-shrink-0">
        <img src="images/download.jpeg" width="60" alt="...">
        </div>
        <div class="flex-grow-1 ms-3">
        <p class="fw-bold my-0">'.$row2['user_email'].'. at '.$time.'</p>
        <h5><a class="text-dark " href="threadDetai.php?threadid='.$id.'">'.$mediaTitle.'</a></h5>
        <p class="mb-10">'.$media_discuss.'</p>
        </div>
        </div>
        ';
    }
    if($noResult){
        echo '<div class="container mt-3">
        <div class="mt-4 p-5 bg-primary text-white rounded">
          <h1>No Comments yet</h1> 
          <p>Please be the first one to add your comment or concern.</p> 
        </div>
      </div>';
    }
            ?>
    </div>
    <?php
include('partials/footer.php');
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>