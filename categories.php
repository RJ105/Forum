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
  

  <title>Categories</title>
</head>

<body>
  <?php include 'partial/dbconnect.php';?>
  <?php include 'partial/header.php';?>



  <div class="container my-3">


    <!--         use for loop and fetch all the categories -->

                    
    <div class="row">
      <?php
            $sql = "SELECT * FROM `Categories`";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
              while($row = mysqli_fetch_assoc($result))
              {
                $id = $row['id'];
                $cat = $row['name'];
                $des = $row['description'];
                  echo '
                        <div class="col-md-4 my-2">

                          <!-- card -->
                          <div class="card" style="width: 18rem;">
                            <img src="https://source.unsplash.com/300x200/?'. $cat .',coding,programming" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">'.$cat.'</h5>
                              <p class="card-text">'.substr($des,0,50).'...</p>
                              <a href="threadlist.php?catid='.$id.' " class="btn btn-primary">Explore</a>
                            </div>
                          </div>
                        </div>
                ';
              }
            }

      ?>
    </div>
</div>


<div class="card-footer text-center">
  <p>copyright 2020</p>
</div>
</body>

</html>