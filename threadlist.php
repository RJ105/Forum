
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
  <?php include 'partial/dbconnect.php';?>
  <?php include 'partial/header.php';?>


  <?php
    $user_id = 010;
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `Categories` WHERE id = $id";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
      while($row = mysqli_fetch_assoc($result))
      {
        $name = $row['name'];
        $des = $row['description'];
      }
    }

  ?>


<!--     container starts from here--> 
 <div class="container my-2">


        <!--   card with image used instead of jumbotron -->
        <div class="card mb-3">
          <img src="https://source.unsplash.com/1600x400/?programming,coding" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?php echo $name; ?></h5>
            <p class="card-text"><?php echo $des; ?></p>
          </div>
        </div>



<!--         collapse form for asking question -->
           
    <?php
      if(isset($_SESSION['username']))
      {
        $user_id = $_SESSION['user_id'];

        echo '
           <p>
              <button class="btn btn-primary" id="togglebtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseform" aria-expanded="false" aria-controls="collapseform">
                Ask a question
              </button>
            </p>
            <div class="collapse" id="collapseform">
                  <div class=" card card-body bg-light my-4 "> 

                      <div>                     
                          <label for="exampleInputEmail1" class="form-label"><h4>Problem Title</h4></label>
                          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Title should be more than 10 letters">
                      
                          <label for="exampleFormControlTextarea1" class="form-label"><h4>Elaborate your problem</h4></label>
                          <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="Description should be more than 25 letters"></textarea>
                          <div class="text-danger"><span id="questionwarn" ></span></div>
                        
                          <button type="submit" class="btn btn-primary mx-4 my-2" id="querypost"  >Submit</button>
                      </div>
                  </div>
            </div>

            <div id="formresponse" class="text-success"></div>

        ';
      }

      else
      {
        echo '<p class="alert alert-danger" role="alert">please login to post a question</p>';
      }
    ?>

         

            <!-- fecthing threads Question  asked -->
            <hr>
            <div><h2 class="text-center">Browse Question</h2></div>
            <hr>
          
            <?php
              $sql = "SELECT * FROM `Threads` where thread_cat_id = $id";
              $result = mysqli_query($conn,$sql);
              $totalthreads = mysqli_num_rows($result);
            ?>
            <div><h3 id="totalthreads"><?php echo $totalthreads?> questions</h3></div>
            <div id="loadthreads"> </div>
           
              


       <!--  container ends here -->
  </div>

<div class="card-footer text-center">
  <p>copyright 2020</p>
</div>

<script type="text/javascript">
  
  $(document).ready(function(){

      var cat_id = <?php echo $id ?>;
      $("#loadthreads").load('partial/actionthreadlist.php',{loadthreads: 1, cat_id: cat_id})

      $("#querypost").on('click',function(){

          var title = $("#title").val();
          var desc = $("#desc").val();
          if(title <10 || desc <25)
          {
            $("#questionwarn").text("Please check your input and increase its length !! ");
          }
          else{
                  if(title.search("'") != -1 )
                  {
                    $("#questionwarn").text("Please remove ' (single quote) from the title ");
                  }
                else if( desc.search("'") != -1)
                   {
                    $("#questionwarn").text("Please remove ' (single quote) from the description ");
                   }
                else
                   {
                      var userid = <?php echo $user_id ?>;

                      $.ajax({

                          url : 'partial/actionthreadlist.php',
                          method : 'POST',
                          dataType : 'text',
                          data : { submitted : 1, title : title, desc: desc, catid : cat_id, userid : userid },
                          success : function(response){
                              $("#title").val("");
                              $("#desc").val("");
                              $("#togglebtn").click();
                              if(response == 0){
                                  $("#formresponse").html('<p class="alert alert-success"> Enter Text data only !</p>');
                              }
                              else
                              {
                                $("#formresponse").html('<p class="alert alert-success"> question posted Successfully !</p>');
                                max = <?php echo $totalthreads ?>;
                                max++;
                                $("#loadthreads").prepend(response);
                                $("#totalthreads").text(max+ " Question");
                              }
                          }
                      });
                   }
                }
          return false;
        });
  });


</script>

</body>

</html>