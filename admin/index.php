<?php
session_start();
define('TEMPLATE', true);
include_once("../config/connect.php");
if(isset($_SESSION['user_mail']) && isset($_SESSION['user_pass'])){
    include_once('admin.php');
   }
else{
    include_once('login.php');
}
?>