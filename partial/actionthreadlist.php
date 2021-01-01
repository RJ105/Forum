 
<!--         php form for submitting the post request-->        

 <?php 

 include 'dbconnect.php';


 function getlikes($threadid)
 {
  global $conn;
    $ratingsql = "SELECT count(*) FROM `Thread_rating` where tr_thread_id = $threadid and tr_action = 'like'";
    $ratingresult = mysqli_query($conn,$ratingsql);
    $ratingrow = mysqli_fetch_array($ratingresult);
     return $ratingrow[0];
 }

      // for loading the thread from database

       if(isset($_POST['loadthreads']))
      {
          $cat_id = $_POST['cat_id'];
          $sql = "SELECT `thread_id`, `thread_title`,`thread_user_id`,DATE_FORMAT(timestamp,'%d-%m-%y') AS timestamp FROM `Threads` where thread_cat_id = $cat_id";
          $result = mysqli_query($conn,$sql);
          // printf("error: %s\n", mysqli_error($conn));
          $noresult = true;
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

          if($noresult)
          {
            echo'
                <div class="card text-dark bg-light mb-3">
                  <div class="card-header">No Thread Found</div>
                  <div class="card-body">
                    <p class="card-text">Be the first to create a Thread</p>
                  </div>
                </div>
                ';
          }
      }


        // on submitting the question 
      if(isset($_POST['submitted']))
      {
          $title = $_POST['title'];
          $desc = $_POST['desc'];
          $catid = $_POST['catid'];
          $userid = $_POST['userid'];

          $sql = "INSERT INTO `Threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$title', '$desc', '$catid', '$userid', current_timestamp())";
          $result = mysqli_query($conn,$sql);
          if($result)
          {
                 // printf("error: %s\n", mysqli_error($conn));
              
              $sql = "SELECT `user_name` FROM `User` where user_id = $userid";
              $result = mysqli_query($conn,$sql);
              $row = mysqli_fetch_assoc($result);
                        // printf("error: %s\n", mysqli_error($conn));
              $username = $row['user_name'];

                $sql = "SELECT `thread_id`, `thread_title`, `thread_user_id`,DATE_FORMAT(timestamp,'%d-%m-%y') AS timestamp  FROM `Threads` order by thread_id DESC LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                          // printf("error: %s\n", mysqli_error($conn));
                  $threadid = $row['thread_id'];
                  $user = $row['thread_user_id'];
                  $title = $row['thread_title'];
                  $posted = $row['timestamp'];
                        echo '
                              <div class="card mb-3" >
                                <div class="row g-0">
                                  <div class="col-md-1">
                                    <img src="image/userdefault.jpg" style="max-width: 80px;">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title"><a href="thread.php?thread_id='.$threadid.'">'.$title.'</a></h5>
                                      <p class="card-text"><small class="text-muted"> ~ <strong> '.$username.'</strong> on '.$posted.'</small></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                             ';

              }
              else
              {
                 exit(0);
              }
          exit();
      }



?>