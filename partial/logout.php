<?php
session_start();

session_destroy();

header("Location:/forumajax/index.php");

?>