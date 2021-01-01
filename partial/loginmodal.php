<!-- Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginmodalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<!--         form-->
        <form action="partial/actionloginmodal.php" method="POST">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" autocomplete="off" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
          </div>

          <button type="submit" class="btn btn-primary" name="submit" >Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- 
<script type="text/javascript">
  
  function loginvalidation()
  {   
      console.log("hello this is login modal");
      var email = $("#loginemail").val();
      var password = $("#loginpassword").val();

      $.ajax({

          url : 'partial/actionloginmodal.php',
          method : 'POST',
          dataType : 'text',
          data : { loggedin: 1, email: email, password: password},
          success : function(response){

              if(response == "invlaid"){
                $("#validateresponse").html("Invalid email or passowrd");
              }
              if(response == "valid"){
                  window.location.assign(window.location.href);
              }
          }
      });

  }  
</script>

 -->