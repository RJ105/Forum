


<?php 
include 'dbconnect.php';

session_start();

         


 function userliked($userid,$commentid){
    global $conn;
    $sql = " SELECT * FROM `Comment_rating` where cr_user_id = $userid and cr_comment_id = $commentid";
    $result = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($result);
        if($rows > 0)
        {
          return true;
        } 
        else
        {
          return false;
        }
    }

// function userdisliked($userid,$commentid){
//     global $conn;
//     $sql = " SELECT * FROM `Comment_rating` where cr_user_id = $userid and cr_comment_id = $commentid";
//     $result = mysqli_query($conn,$sql);
//     $rows = mysqli_num_rows($result);
//         if($rows > 0)
//         {
//           return true;
//         } 
//         else
//         {
//           return false;
//         }
//     }


       if(isset($_POST['loadcomments']))
          {
                    $id = $_POST['id'];
                    $sql = "SELECT `comment_id`,`comment_content`,`comment_user_id`,DATE_FORMAT(comment_time, '%d-%m-%y') AS comment_time FROM `Comments` where comment_thread_id = $id";
                    $result = mysqli_query($conn,$sql);
                    $totalcomment = mysqli_num_rows($result);
                    // printf("error: %s\n", mysqli_error($conn));
                    $noresult = true;
                    if($result)
                    {
                      while($row = mysqli_fetch_assoc($result))
                      {
                        $noresult = false;
                        $commentid = $row['comment_id'];
                        $userid = $row['comment_user_id'];
                        $content = $row['comment_content'];
                        $posted = $row['comment_time'];

                            $namesql = "SELECT `user_name` FROM `User` where user_id = $userid";
                            $nameresult = mysqli_query($conn,$namesql);
                            $namerow = mysqli_fetch_assoc($nameresult);
                            $username = $namerow['user_name'];

                                  $ratingsql = "SELECT count(*) FROM Comment_rating where cr_comment_id = $commentid and cr_action = 'like'";
                                  $ratingresult = mysqli_query($conn,$ratingsql);
                                  $ratingrow = mysqli_fetch_array($ratingresult);
                                  $totallikes = $ratingrow[0];

                                  // $ratingsql = "SELECT count(*) FROM Comment_rating where cr_comment_id = $commentid and cr_action = 'dislike'";
                                  // $ratingresult = mysqli_query($conn,$ratingsql);
                                  // $ratingrow = mysqli_fetch_array($ratingresult);
                                  // $totaldislikes = $ratingrow[0];
                                  

                        echo '
                              <div class="card mb-3" >
                                <div class="row g-0">
                                      <div class="col-md-1">
                                          <img src="image/userdefault.jpg" style="max-width: 80px;">
                                          <p id="parentpara">&nbsp &nbsp &nbsp';

                                if(isset($_SESSION['username']))
                                {       
                                    $current_userid = $_SESSION['user_id'];
                                          if(userliked($current_userid, $commentid)) 
                                               echo'<a href="javascript:void(0)"><i class="fas fa-thumbs-up like-btn"  onclick="likefunction('.$commentid.',this)" ></i></a>';
                                          else echo'<a href="javascript:void(0)"><i class="far fa-thumbs-up like-btn"  onclick="likefunction('.$commentid.',this)"></i></a>';
                                  echo'   <span class="likes" id="likesspan">'.$totallikes.'</span>';
                                }

                                else
                                {
                                  echo '<i class="fas fa-thumbs-up"></i>&nbsp<span class="likes" id="likesspan">'.$totallikes.'</span>';
                                }
                        //                if(userdisliked($userid, $commentid)) 
                        //                        echo'<a href="javascript:void(0)"><i class="fas fa-thumbs-down dislike-btn"  onclick="dislikefunction('.$commentid.',this)"></i></a>';
                        // else echo '&nbsp &nbsp &nbsp<a href="javascript:void(0)"><i class="far fa-thumbs-down dislike-btn"  onclick="dislikefunction('.$commentid.',this)"></i></a>';
                                
                        //           echo'     <span class="dislikes" id="dislikesspan">'.$totaldislikes.'</span>&nbsp';

                                    echo '</p>
                                      </div>
                                      <div class="col-md-8">
                                          <div class="card-body">
                                                <h5 class="card-title">'.$content.'</h5>
                                                <p><small class="text-muted"> ~  <strong>'.$username.'</strong> posted on '.$posted.'</small></p>
                                                ';

                                    if(isset($_SESSION['username'])){
                                            echo '
                                                <div> 
                                                    <a href="javascript:void(0)" onclick="reply(this); comment_id = '.$commentid.'" class="btn btn-primary btn-sm my-2"  style="margin-right : 20px;" >Reply</a>
                                                    <a href="javascript:void(0)"  onclick="viewreplies('.$commentid.',this)" class="btn btn-success btn-sm" >view replies</a>
                                                </div> ';
                                    }
                                     else {
                                            echo '
                                               <div> 
                                                    <a href="javascript:void(0)"  onclick="viewreplies('.$commentid.',this)" class="btn btn-success btn-sm" >view replies</a>
                                                </div> ';
                                     }

                          echo '
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
                        <div class="card text-dark bg-light mb-3" id="default_card">
                          <div class="card-header">No comment Found</div>
                          <div class="card-body">
                            <p class="card-text">Be the first to comment</p>
                          </div>
                        </div>
                        ';
                  }
          }


          if(isset($_POST['totalcomments']))
          {
              $id = $_POST['id'];
              $sql = "SELECT * FROM `Comments` where comment_thread_id = $id";
              $result = mysqli_query($conn,$sql);
              $totalcomment = mysqli_num_rows($result);
              echo '<h3>'.$totalcomment.' Comments</h3>';
          }


           if(isset($_POST['commented']))
          {
            $content = $_POST['content'];
            $thread_id = $_POST['thread_id'];
            $user_id = $_POST['user_id'];

            $sql = "INSERT INTO `Comments` (`comment_content`, `comment_thread_id`, `comment_user_id`, `comment_time`) VALUES('$content','$thread_id', '$user_id', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            // printf("error: %s\n", mysqli_error($conn));

            $sql = "SELECT `comment_id`,`comment_content`,`comment_user_id`,DATE_FORMAT(comment_time, '%d-%m-%y') AS comment_time FROM `Comments` order by comment_id DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $commentid = $row['comment_id'];
            $userid = $row['comment_user_id'];
            $content = $row['comment_content'];
            $posted = $row['comment_time'];

                            $namesql = "SELECT `user_name` FROM `User` where user_id = $userid";
                            $nameresult = mysqli_query($conn,$namesql);
                            $namerow = mysqli_fetch_assoc($nameresult);
                            $username = $namerow['user_name'];
            echo '
                  <div class="card mb-3" >
                    <div class="row g-0">
                      <div class="col-md-1">
                        <img src="image/userdefault.jpg" style="max-width: 100px;">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">'.$content.'</h5>
                          <p><small class="text-muted"> ~  <strong>'.$username.'</strong> posted on '.$posted.'</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
                 ';
            exit();
          }

          if (isset($_POST['replied']))
          {
              $reply = $_POST['reply'];
              $comment_id = $_POST['comment_id'];
              $user_id = $_POST['user_id'];

              $sql = "INSERT INTO `Reply` (`reply_description`, `reply_comment_id`, `reply_user_id`, `reply_time`) VALUES ( '$reply', '$comment_id', '$user_id', current_timestamp())";
              $result = mysqli_query($conn,$sql);

              exit("success on inserting reply");
          }


          if (isset ($_POST['loadreplies']))
          {
               $comment_id = $_POST['comment_id'];
               $sql = "SELECT `reply_description`, `reply_user_id`, DATE_FORMAT(reply_time,'%d-%m-%y') AS reply_time FROM `Reply` where reply_comment_id = $comment_id";
               $result = mysqli_query($conn,$sql);
                // printf("error: %s\n", mysqli_error($conn));
               $nums_of_rows = mysqli_num_rows($result);
                if($nums_of_rows)
                {
                  while($row = mysqli_fetch_assoc($result))
                  {
                        $desc = $row['reply_description'];
                        $userid = $row['reply_user_id'];
                        $posted = $row['reply_time'];

                        $namesql = "SELECT `user_name` FROM `User` where user_id = $userid";
                        $nameresult = mysqli_query($conn,$namesql);
                        $namerow = mysqli_fetch_assoc($nameresult);
                        $username = $namerow['user_name'];
                        echo'
                          <div class="card card-body bg-light my-2">
                            <p>'.$desc.'<small class="text-muted" style="float: right"> <strong > ~ '.$username.'</strong> posted on '.$posted.'</small></p>
                          </div>
                        ';

                  }
                }
                else
                {
                  echo '<div id="replyalert"><p class="alert alert-danger text-center my-1" role="alert" >No Reply found</P></div>';
                }          
          }

// action on liking or unliking a thread

           if(isset($_POST['threadliked']))
          {
            $action = $_POST['action'];
            $threadid = $_POST['threadid'];
            $userid = $_POST['userid'];

                switch($action)
                {
                  case 'like': $sql = " INSERT INTO `Thread_rating` (`tr_user_id`, `tr_thread_id`, `tr_action`) VALUES ('$userid', '$threadid', '$action') ";
                               $threadsql =  "UPDATE `Threads` SET `likes` = `likes` + '1' WHERE `Threads`.`thread_id` = $threadid";
                    break;
          
                  case 'unlike': $sql = "DELETE FROM `Thread_rating` where tr_user_id = $userid and tr_thread_id = $threadid"; 
                                 $threadsql =  "UPDATE `Threads` SET `likes` = `likes` - '1' WHERE `Threads`.`thread_id` = $threadid";
                    break;

                  default :
                    break;
                }

            mysqli_query($conn,$sql);
            mysqli_query($conn,$threadsql);
            echo getratingforthread($threadid);
            exit();
          }


          function getratingforthread($threadid)
          {
            global $conn;
            $likequery = "SELECT count(*) FROM `Thread_rating` where tr_thread_id = $threadid and tr_action = 'like'";
            $like_rs = mysqli_query($conn,$likequery);
            $likes = mysqli_fetch_array($like_rs);
            $rating = array('likes' => $likes[0] );
            return json_encode($rating);
          }


 // action on liking or unliking a comment 
          if(isset($_POST['commentliked']))
          {
            $action = $_POST['action'];
            $commentid = $_POST['commentid'];
            $userid = $_POST['userid'];
                switch($action)
                {
                  case 'like': $sql = " INSERT INTO `Comment_rating` (`cr_user_id`, `cr_comment_id`, `cr_action`) VALUES ('$userid', '$commentid', '$action') ON DUPLICATE KEY UPDATE cr_action = '$action'";
                    break;

                  // case 'dislike': $sql = " INSERT INTO `Comment_rating` (`cr_user_id`, `cr_comment_id`, `cr_action`) VALUES ('$userid', '$commentid', '$action') ON DUPLICATE KEY UPDATE cr_action = '$action'";
                  //   break;

                  case 'unlike': $sql = "DELETE FROM `Comment_rating` where cr_user_id = $userid and cr_comment_id = $commentid"; 
                    break;

                  // case 'undislike':$sql =  "DELETE FROM `Comment_rating` where cr_user_id = $userid and cr_comment_id = $commentid";
                  //   break;

                  default :
                    break;
                }

            mysqli_query($conn,$sql);
            echo getrating($commentid);
            exit();
          }


          function getrating($commentid)
          {
            global $conn;
            $likequery = "SELECT count(*) FROM `Comment_rating` where cr_comment_id = $commentid and cr_action = 'like'";
            // $dislikequery = "SELECT count(*) FROM `Comment_rating` where cr_comment_id = $commentid and cr_action = 'dislike'";

            $like_rs = mysqli_query($conn,$likequery);
            // $dislike_rs = mysqli_query($conn,$dislikequery);

            $likes = mysqli_fetch_array($like_rs);
            // $dislikes = mysqli_fetch_array($dislike_rs);

            $rating = array('likes' => $likes[0] );
            return json_encode($rating);
          }

 ?>
