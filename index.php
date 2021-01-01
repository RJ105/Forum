<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

   <!-- Option 1: Bootstrap Bundle with Popper, difference is it include collapse and popup like modal-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
  </script>

  <!--  jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  

  <title>forum</title>
</head>

<body>
  <?php 
    if(isset($_GET['signup']))
    {
      $signup = $_GET['signup'];
      if($signup ==1)
      {
        echo '<div class="alert alert-success"><strong>Acoount created successfully !</strong> now login to access all functionalities </div>';
      }
      if($signup == 0){
        echo '<div class="alert alert-danger"><strong>password doesnt matched !</strong> please enter same password in both inputs on signup page</div>';
      }
    }

    if(isset($_GET['login']))
    {
      $login = $_GET['login'];
      if($login == 1)
      {
          echo '<div class="alert alert-success"><strong>successfully logged in !</strong></div>';
      }
      if($login  ==2)
      {
          echo '<div class="alert alert-danger"><strong>Invalid password !</strong> please enter a valid password on login page</div>';
      }
      if($login ==3)
      {
          echo '<div class="alert alert-danger" role="alert"><strong>Invalid Email !</strong> please enter a valid Email id on login page</div>';
      }
  
    }

  ?>
  <?php include 'partial/dbconnect.php';?>
  <?php include 'partial/header.php';?>


  <!--     carousel slideshow with indicator-->

  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
      <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
      <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
      <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">


      <div class="carousel-item active">
        <img src="image/smiling_person.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1>Welcome To Worlds Fastest Growing Programmers Community</h1>
        </div>
      </div>
      
      <div class="carousel-item">
        <img src="image/img_2_computer_dark.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1>A Free Platform To Share, Ask and Solve Queries </h1>
          <p></p>
        </div>
      </div>
      
      <div class="carousel-item">
        <img src="image/person_comp_1.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1>Got Stuck and Don't Know What To Do? </h1>
          <h3>Get Help From Some Of The Best Coders Across the world </h3>
        </div>
      </div>
    
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </a>
  </div>

  <!--     main contianer starts from here-->


<div class="container my-3">
    <div><h2 class="text-center">Welcome To CS Forum</h2></div> 
    <div style="display: table; margin-left: auto; margin-right: auto;">
        <a class="btn btn-primary" href="categories.php" role="button">Get Started</a>
    </div>
     
</div>

<div class="card-footer text-center">
  <p>copyright 2020</p>
</div>

<script type="text/javascript">
  $(".alert").fadeOut(10000);

</script>


</body>

</html>