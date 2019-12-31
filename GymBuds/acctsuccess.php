<?php
session_start();
//if(isset($_SESSION['name'])){

//Session variables for debugging and testing only, comment out after each use
$_SESSION['name'] = "Bob";
$_SESSION['email'] = "bob123@gmail.com";

$name = $_SESSION['name'];
$email = $_SESSION['email'];


//header("refresh:30; url=login.php");
session_destroy();
//}

//else{
    //   header("Location: login.php");
//}
?>

<!DOCTYPE html>
<html lang="en">
<style>
@import url('https://fonts.googleapis.com/css?family=Baloo+Bhaina&display=swap');
@import url('https://fonts.googleapis.com/css?family=Fjalla+One&display=swap');
@import url('https://fonts.googleapis.com/css?family=M+PLUS+1p&display=swap');
@import url('https://fonts.googleapis.com/css?family=Arimo&display=swap');
@import url('https://fonts.googleapis.com/css?family=Signika+Negative&display=swap');

</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GymBuds: Account Created!</title>
    <script src="scripts/script-login.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/style-success.css">
</head>
<body>
<header>
        <h1>
                <a href="login.php">GymBuds</a>
        </h1>
</header>
        <div id = "successTextWrapper">
        <h2>Thanks <?php echo $name; ?>,
         please check your email at <?php echo $email; ?>
          to verify your account.
        </h2> 
        </div>
        
        <footer>
            Website made by Cayfabe Studios &copy;
</footer>
    
</body>
</html>