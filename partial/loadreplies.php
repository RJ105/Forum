 
<!--         php form for getting replies-->        

 <?php 

 include 'dbconnect.php';

   $sql = "SELECT * FROM `Reply` ";
   $result = mysqli_query($conn,$sql);
    // printf("error: %s\n", mysqli_error($conn));
   $nums_of_rows = mysqli_num_rows($result);
    if($nums_of_rows)
    {
      while($row = mysqli_fetch_assoc($result))
      {
        echo'
          <div>
          <p>'.$row['reply_description'].'</p>
          </div>
        ';

      }
    }
    else
    {
      echo "no reply found";
    }           



?>