<?php
session_start();
if(isset($_SESSION['user_mail']) && isset($_SESSION['user_pass'])){
    session_destroy();
    setcookie('mail',$_SESSION['user_pass'],time()-3600);
	setcookie('pass',$_SESSION['user_pass'],time()-3600);
    header('location:index.php');
}

?>