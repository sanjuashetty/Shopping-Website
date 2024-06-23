<?php 
if(!isset($_SESSION['auth']))
{
header('Location: login.php');
redirect("login.php",'Login to continue');
}





?>