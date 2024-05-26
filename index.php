<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <style>

     .container{
         min-height: 85vh;
        }
        </style>
</head>

<bod2>
    <?php
    include('partials/dbconnect.php');
    include('partials/header.php');
    ?>
    <!-- slider starts here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://source.unsplash.com/random?javaScripT" width="200" height="700" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://source.unsplash.com/random?javaScript" width="200" height=700" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src=https://source.unsplash.com/random?javaScript" width="200" height="700" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <div class="container">
            <h1 class="text-center">iForums-Browse for categories</h1>
            <div class="row">
                <!-- use forloop to iterate through categories -->
                <!-- category container starts here -->
                <?php
                $sql = "SELECT * FROM forum";
                $result = mysqli_query($connection, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row ["category_id"];    
                    $cat = $row["category_name"];
                    $desc = $row["category_desc"];
                    echo ' <div class="col-md-4 my-2">
      
<div class="card" style="width: 18rem;">
    <img src="images/python.jpg" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title"><a href="threads.php?catid='.$id.'">' . $cat . '</a></h5>
        <p class="card-text">' . substr($desc, 0, 20) . '</p>
        <a href="threads.php?catid='. $id .' " class="btn btn-primary">View threads</a>
    </div>
</div>
</div>';
                }
                ?>

            </div>
        </div>
        <?php
        include('partials/footer.php');
        ?>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"> </script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>