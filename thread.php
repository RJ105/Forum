<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
  </script>

  <!--  jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<!--     font css -->
<link rel="stylesheet" type="text/css" href="css/all.css">

  <title>forum</title>
</head>

<body>
  <?php include 'partial/dbconnect.php';?>
  <?php include 'partial/header.php';?>
  

  <!-- this php is for fetching the top question  --> 
  <?php
        $currentuserid = 0;
        $id = $_GET['thread_id'];
        $sql = "SELECT `thread_title`,`thread_desc`,`thread_user_id`,`likes`, DATE_FORMAT(timestamp,'%d-%m-%y') AS timestamp FROM `Threads` WHERE thread_id = $id";
        $result = mysqli_query($conn,$sql);
        // printf("error: %s\n", mysqli_error($conn));

        if($result)
        {
          while($row = mysqli_fetch_assoc($result))
          {
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $userid = $row['thread_user_id'];
            $time = $row['timestamp'];
            $likes = $row['likes'];
                            $namesql = "SELECT `user_name` FROM `User` where user_id = $userid";
                            $nameresult = mysqli_query($conn,$namesql);
                            $namerow = mysqli_fetch_assoc($nameresult);
                            $username = $namerow['user_name'];
          }
        }

        function getlikesforthread($threadid)
         {
          global $conn;
            $ratingsql = "SELECT count(*) FROM `Thread_rating` where tr_thread_id = $threadid and tr_action = 'like'";
            $ratingresult = mysqli_query($conn,$ratingsql);
            $ratingrow = mysqli_fetch_array($ratingresult);
             return $ratingrow[0];
         }

         function userlikedforthread($userid,$threadid)
         {
            global $conn;
            $sql = " SELECT * FROM `Thread_rating` where tr_user_id = $userid and tr_thread_id = $threadid";
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
  ?>
    <!--     container starts from here--> 

  <div class="container my-2">


            <div class="card text-dark bg-light mb-3 my-4">
              <div class="card-header"><h3>Title: <?php echo $title; ?></h3>
<?php
             if(isset($_SESSION['username']))
              {       
                  $current_userid = $_SESSION['user_id'];
                        if(userlikedforthread($current_userid, $id)) 
                             echo'<a href="javascript:void(0)"><i class="fas fa-thumbs-up like-btn"  onclick="likefunctionforthread('.$id.',this)" ></i></a>';
                        else echo'<a href="javascript:void(0)"><i class="far fa-thumbs-up like-btn"  onclick="likefunctionforthread('.$id.',this)"></i></a>';
                echo'   <span id="likesspanforthread">'.getlikesforthread($id).'</span>';
              }

              else
              {
                echo '<i class="fas fa-thumbs-up"></i>&nbsp<span  id="likesspanforthread">'.getlikesforthread($id).'</span>';
              }
?>
              </div>
              <div class="card-body">
                <p class="card-text"> Description: <?php echo $desc; ?></p>
                <p class="card-text"> ~ <small class="text-muted">posted by <b><?php echo $username;?></b> on <?php echo $time; ?></small>
                </p>
              </div>
            </div>

        <!-- comment box  start from here -->

            <?php
              if(isset($_SESSION['username']))
              { 
                $currentuserid = $_SESSION['user_id'];
               echo' 
                        <div class="mb-3">
                          <label for="exampleFormControlTextarea1" class="form-label"><h4>Comment</h4></label>
                          <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                        </div>
                        <div class="text-danger"><span id="commentwarn" ></span></div>
                        <button type="submit" class="btn btn-primary" id="submit" name="submit">Post</button>
                      ';
              }

              else
              {
                echo '<p class="alert alert-danger" role="alert">please login to post comment and reply </P>';
              }
            ?>
                      


          <!--    comments  section starts from here-->

           <h2 class="text-center">Discussions</h2>
           <hr>


            <?php
              $sql = "SELECT * FROM `Comments` where comment_thread_id = $id";
              $result = mysqli_query($conn,$sql);
              $totalcomments = mysqli_num_rows($result);
            ?>
           <h3 id="totalcomments"><?php echo $totalcomments?> comments</h3>
            <!--  loading the comments -->
            <div id="loadcomments">
              
            </div>
            


        <!--      div for reply -->
            <div class="row replyRow" style="display:none;">
              <div class="col-md-12" >
                  <textarea class="form-control" id="reply"  rows="3"></textarea><br>
                  <div class="text-danger"><span id="replywarn" ></span></div>
                  <button type="submit" class="btn btn-primary btn-sm " id="addreply"  style="float: right" >Add reply</button>
                  <button style="float:right" class="btn-default btn" onclick="$('.replyRow').hide();">Close</button>
              </div>
              <hr>
            </div>              

          <div id="loadreplies"></div>

       <!--  container ends here -->
  </div>



<div class="card-footer text-center">
  <p>copyright 2020</p>
</div>


<script type="text/javascript">

      var comment_id;
      var thread_id = <?php echo $id ?>;
      var user_id = <?php echo $currentuserid ?>;


      function reply(caller)
        {
          $(".replyRow").insertAfter($(caller));
          $(".replyRow").show();
        }

      function viewreplies(id,caller)
      {
          $("#loadreplies").load('partial/actionthread.php', {loadreplies : 1, comment_id : id });
          $("#loadreplies").insertAfter($(caller));
          $("#loadreplies").show();
          
       }

        // like function for thread
               function likefunctionforthread(threadid, caller){
                var action;
                $clicked_btn = $(caller);

                if ($clicked_btn.hasClass('fas fa-thumbs-up')){
                  action = 'unlike';
                  // alert(action);
                } else if($clicked_btn.hasClass('far fa-thumbs-up')){
                  action = 'like';
                  // alert(action);
                }
                    $.ajax({
                        url : 'partial/actionthread.php',
                        method : 'POST',
                        dataType : 'text',
                        data : { threadliked:1, action: action, threadid : threadid, userid : user_id},
                        success : function(response){
                          console.log(response);
                            res = JSON.parse(response);
                            if (action == "like"){
                              $clicked_btn.removeClass('far fa-thumbs-up');
                              $clicked_btn.addClass('fas fa-thumbs-up');
                            } else if(action == "unlike"){
                              $clicked_btn.removeClass('fas fa-thumbs-up');
                              $clicked_btn.addClass('far fa-thumbs-up');
                            }

                            $("#likesspanforthread").text(res.likes);
                            // $("#dislikesspan").text(res.dislikes);

                            
                        }
                    });
                 return false;   
               }

       // like function for comments
               function likefunction(commentid, caller){
                var action;
                $clicked_btn = $(caller);

                if ($clicked_btn.hasClass('fas fa-thumbs-up')){
                  action = 'unlike';
                  // alert(action);
                } else if($clicked_btn.hasClass('far fa-thumbs-up')){
                  action = 'like';
                  // alert(action);
                }
                    $.ajax({
                        url : 'partial/actionthread.php',
                        method : 'POST',
                        dataType : 'text',
                        data : { commentliked: 1, action: action, commentid : commentid, userid : user_id},
                        success : function(response){
                          console.log(response);
                            res = JSON.parse(response);
                            if (action == "like"){
                              $clicked_btn.removeClass('far fa-thumbs-up');
                              $clicked_btn.addClass('fas fa-thumbs-up');
                            } else if(action == "unlike"){
                              $clicked_btn.removeClass('fas fa-thumbs-up');
                              $clicked_btn.addClass('far fa-thumbs-up');
                            }

                            $clicked_btn.parent().parent().children("#likesspan").text(res.likes);
                            // $("#dislikesspan").text(res.dislikes);

                            
                        }
                    });
                 return false;   
               }


      // dislike function
               // function dislikefunction(commentid, caller){
               //  var action;
               //  $clicked_btn = $(caller);

               //  if ($clicked_btn.hasClass('fas fa-thumbs-down')){
               //    action = 'undislike';
               //    // alert(action);
               //  } else if($clicked_btn.hasClass('far fa-thumbs-down')){
               //    action = 'dislike';
               //    // alert(action);
               //  }
               //      $.ajax({
               //          url : 'partial/actionthread.php',
               //          method : 'POST',
               //          dataType : 'text',
               //          data : { action: action, commentid : commentid, userid : user_id},
               //          success : function(response){
               //            console.log(response);
               //              res = JSON.parse(response);
               //              if (action == "dislike"){
               //                $clicked_btn.removeClass('far fa-thumbs-down');
               //                $clicked_btn.addClass('fas fa-thumbs-down');
               //              } else if(action == "undislike"){
               //                $clicked_btn.removeClass('fas fa-thumbs-down');
               //                $clicked_btn.addClass('far fa-thumbs-down');
               //              }

               //              $("#likesspan").text(res.likes);
               //              $("#dislikesspan").text(res.dislikes);

               //              // $("#lmistake").removeClass("fas fa-thumbs-up").addClass("far fa-thumbs-up");
               //          }
               //      });
               //   return false;   
               // }               



      $(document).ready(function(){


          $("#loadcomments").load('partial/actionthread.php',{loadcomments : 1, id : thread_id});
          // $("#totalcomments").load('partial/actionthread.php',{totalcomments : 1, id : id});

          $("#submit").on('click',function(){
              var max = <?php echo $totalcomments ?>;
              var content = $("#content").val();
             if(content.search("'") != -1){
                $("#commentwarn").text("Please remove ' (single quote) from the comment !! ");
             }
             else if(content!= ""){
                  $.ajax({

                      url : 'partial/actionthread.php',
                      method : 'POST',
                      dataType : 'text',
                      data : { commented : 1, content : content, thread_id : thread_id, user_id : user_id },
                      success : function(response){
                          $("#content").val("");
                          $("#default_card").hide();
                          max++;
                          $("#loadcomments").prepend(response);
                          $("#totalcomments").text(max + " comments") 
                      }
                  });

                }
             
              

              else{
                    $("#commentwarn").text(" please give some input !!");
                return false;
              }
          });


               $("#addreply").on('click',function(){
                var reply = $("#reply").val();
                if(reply!= ""){

                  $.ajax({
                      url : 'partial/actionthread.php',
                      method : 'POST',
                      dataType : 'text',
                      data : { replied : 1, reply : reply, comment_id : comment_id, user_id : user_id},
                      success : function(response){
                        $("#reply").val("");
                        $(".replyRow").hide();
                      }

                  });
                }
                else{
                    $("#replywarn").text(" please give some input !!");
                  return false;
                }
              });

              

      });
</script>
</body>

</html>