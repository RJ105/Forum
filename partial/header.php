<?php

session_start();

echo '
<style>
.current {
    color:red; 
  }
  a, u{
    text-decoration : none;
  }

</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/forumajax" style="margin-right: 100px"> CS Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul id="navbarid" class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link" href="/forumajax/categories.php">Categories</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/forumajax/mostliked.php">Most-liked</a>
        </li>
        
        
        <li class="nav-item">
          <a class="nav-link" href="/forumajax/unanswered.php">Unanswered</a>
        </li>

      </ul>
        ';

        if(isset($_SESSION['username']))
        {
          echo '
          <div class="mx-2">
            <button class="btn btn-danger ml-3"  >'.$_SESSION['username'].'</button>
            <a class="btn btn-success mx-2 " href="partial/logout.php">Logout</a>
          </div>
          ';
        }
        else
        { 
          echo'
          <div class="mx-2">
            <button class="btn btn-danger ml-3" data-bs-toggle="modal" data-bs-target="#loginmodal" >login</button>
            <button class="btn btn-success mx-2 " data-bs-toggle="modal" data-bs-target="#signupmodal">signup</button>
          </div>
          ';
        }


echo'
    </div>
  </div>
</nav>
';


include 'partial/loginmodal.php';
include 'partial/signupmodal.php';
?>

<script>

    var parser = document.createElement('a');
parser.href =  window.location.href;
var navLinks = document.getElementsByTagName("ul")[0].getElementsByTagName("a");
// var now = parser.pathname;
for(i=0;i<navLinks.length;i++)
{
   if(navLinks[i].href == parser.href)
   {
    console.log(parser.href);
    navLinks[i].className = "current";
    }
}

</script>