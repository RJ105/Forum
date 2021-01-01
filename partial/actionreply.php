 

 <?php 

 include 'dbconnect.php';
            if(isset($_POST['reply']))
            {
              // $reply = $_POST['reply'];

              // $sql = "INSERT INTO `Reply` (`reply_description`, `reply_thread_id`, `reply_user_id`, `reply_time`) VALUES ( '$reply', '9', '0', current_timestamp())";
              // $result = mysqli_query($conn,$sql);
              // printf("error: %s\n", mysqli_error($conn));
            
            exit('success');

            }



          else{

                    if(isset($_POST['commented']))
                    {
                      $content = $_POST['content'];

                      $sql = "INSERT INTO `Comments` (`comment_content`, `comment_thread_id`, `comment_user_id`, `comment_time`) VALUES ( '$content','9', '0', current_timestamp())";
                      $result = mysqli_query($conn, $sql);
                      exit("success on comment");

                    }

              }


          ?>