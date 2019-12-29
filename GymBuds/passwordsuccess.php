<?php
session_start();
if(isset($_SESSION['firstName'])){

$name = $_SESSION['firstName'];

header("refresh:30; url=login.php");
session_destroy();
}

else{
       header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<style>
@import url('https://fonts.googleapis.com/css?family=Baloo+Bhaina&display=swap');
@import url('https://fonts.googleapis.com/css?family=Fjalla+One&display=swap');
@import url('https://fonts.googleapis.com/css?family=M+PLUS+1p&display=swap');
@import url('https://fonts.googleapis.com/css?family=Arimo&display=swap');

</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GymBuds: Account Created!</title>
    <script src="scripts/script-login.js"></script>
    <link rel="stylesheet" href="styles/style-success.css">
</head>
<body>
<header>
        <h1>
                <a href="login.php">GxmBxds</a>
        </h1>

        <div id = "verify-acct-wrapper">
        <h3>Thanks <?php echo $name; ?>,
         your password has been reset. You may <a href="login.php">login here</a>.
        </h3> 
        </div>
        
        <footer>
            Website made by Cayfabe Studios &copy;
</footer>
    
</body>
</html>