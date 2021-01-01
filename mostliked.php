<!DOCTYPE html>
<html>

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
<?php include 'partial/dbconnect.php';?>
 <?php include 'partial/header.php';?>

 <div class="container ">
 	<br>
	
<?php 
function getlikes($threadid)
 {
  global $conn;
    $ratingsql = "SELECT count(*) FROM `Thread_rating` where tr_thread_id = $threadid and tr_action = 'like'";
    $ratingresult = mysqli_query($conn,$ratingsql);
    $ratingrow = mysqli_fetch_array($ratingresult);
     return $ratingrow[0];
 }


		$sql = "SELECT `thread_id`, `thread_title`,`thread_user_id`,DATE_FORMAT(timestamp,'%d-%m-%y') AS timestamp FROM `Threads` ORDER BY likes DESC ";
          $result = mysqli_query($conn,$sql);

          if($result)
          {
            while($row = mysqli_fetch_assoc($result))
            {
              $noresult = false;
              $threadid = $row['thread_id'];
              $userid = $row['thread_user_id'];
              $title = $row['thread_title'];
              $posted = $row['timestamp'];

                $namesql = "SELECT `user_name` FROM `User` where user_id = $userid";
                $nameresult = mysqli_query($conn,$namesql);
                $namerow = mysqli_fetch_assoc($nameresult);
                $username = $namerow['user_name'];


              echo '
                    <div class="card mb-3" >
                      <div class="row g-0">
                        <div class="col-md-1">
                          <img src="image/userdefault.jpg" style="max-width: 60px;">
                          <p class="text-muted"> &nbsp';  

                  echo '<span> '.getlikes($threadid).'</span>';

                echo    ' Likes </p>
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title"><a href="thread.php?thread_id='.$threadid.'">'.$title.'</a></h5>
                            <p class="card-text"><small class="text-muted"> ~<strong> '.$username.'</strong> on '.$posted.'</small></p>
                          </div>
                        </div>
                      </div>
                    </div>
                   ';
            }
          }

?>
 </div>

</body>
</html>