<?php 

$Title = "Logout";
include('Header.php');
unset($_SESSION['login_user']);
session_destroy();

?>

          <div id="LoginContent">
          	
    				<h1 class="Status">You Logged out Succefully </h1>
                   
          </div>
          
<?php include('Footer.php');  ?>