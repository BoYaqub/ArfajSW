<!DOCTYPE html>
<html>
  <head>
        <link href="css/font-awesome.css" rel="stylesheet" />
        <link href="css/font-awesome.min.css" rel="stylesheet"/>
        <link href="slick/slick.css" rel="stylesheet" />
        <link href="css/Styles.css" rel="stylesheet" />
      <meta charset="utf-8" />
      <title><?php echo $Title; ?></title>
      <?php session_start(); ?>
  </head>
  <body>
      <div id="Wrapper">
    <div id="Header">
        <div id="LogoDIV">  
        <a id="LogoA" href="index.php"><img src="Images/logo.png" id="Logo" alt="Logo" />
            <p id="WebSiteName">KFU-Events</p>
            </a>
            
            </div>
            <div id="Nav">
            <ul>
                <li class="li"><a href= "index.php" class="HeaderA">Home</a></li>
                <?php if(!isset($_SESSION['login_user'])){ ?>
                    <li class="li"> <a href= "Login.php" class="HeaderA">Login</a></li>
                <?php } ?>
                <?php if(isset($_SESSION['login_user']) and $_SESSION['login_user']=="Admin"){ ?>
                    <li class="li"> <a href= "Logout.php" class="HeaderA">Logout</a></li>
                <?php } ?>
                <li class="li"><a href= "Events.php" class="HeaderA">Events</a></li>
                <li class="li"><a href= "AboutUs.php" class="HeaderA">About Us</a></li>
                <li class="li"><a href= "ContactUs.php" class="HeaderA">Contact Us</a></li>

            </ul>
            </div>
        <div class="Clear"></div>
        </div>