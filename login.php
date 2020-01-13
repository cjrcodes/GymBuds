<?php

//Config file, separate for security reasons
include 'resources/config.php';

//Message that updates when an error occurs i.e Username taken, email taken
$msg = "";
$msgClass = "";
try {
    //Submit button has been clicked
    if (filter_has_var(INPUT_POST, 'submit')) {

        //Database credentials
        $DB_HOST = $config['DB_HOST'];
        $DB_USER = $config['DB_USERNAME'];
        $DB_PASSWORD = $config['DB_PASSWORD'];
        $DB_NAME = $config['DB_DATABASE'];

        //Connection to MySQL database
        $connection = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

        //Connection failure
        if ($connection->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // All form inputs
        $email = $connection->real_escape_string($_POST['email']);
        $password = $connection->real_escape_string($_POST['password']);

        //Check if any input field is empty
        if (!empty($email) && !empty($password)) {

            //Is the input email in a proper format i.e abc123@x.com
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $msg = 'Please use a valid email';
            }

            //Valid email format
            else {

                //Check if given email exists
                $sql = "SELECT password FROM user WHERE email = '$email'";
                $result = $connection->query($sql);
                $row = $result->fetch_assoc();
                $hashedPassword = $row["password"];

                //Email does not exist
                if ($row["password"] == null && strlen($email) > 0) {
                    $msg = "Email does not exist";
                }

                //Email exists
                else {
                    //Is the user account verified?
                    $sql = "SELECT isEmailConfirmed FROM user WHERE email = '$email'";
                    $result = $connection->query($sql);
                    $row = $result->fetch_assoc();
                    $confirmed = $row["isEmailConfirmed"];

                    //User account has not been verified
                    if ($confirmed == 0) {
                        $msg = "Please verify your email";
                    }

                    //User account verified, check password input
                    else if (Sodium_crypto_pwhash_scryptsalsa208sha256_str_verify($hashedPassword, $password)) {
                        // recommended: wipe the plaintext password from memory
                        Sodium_memzero($password);
                        Sodium_memzero($hashedPassword);

                        //Login works
                        echo "Login successful!";
                        $msg = "Login successful!";

                        //Start a session to send data to the dashboard page
                        session_start();

                        $_SESSION['name'] = htmlentities($_POST['first-name']);
                        $_SESSION['email'] = htmlentities($_POST['email']);

                        //Redirects the page to the dashboard page
                        header('Location: dashboard.php');
                    } else {
                        Sodium_memzero($password);
                        Sodium_memzero($hashedPassword);

                        //SQL connection error
                        $msg = "Password is incorrect";
                        echo "Error: " . $sql . "<br>" . $connection->error;
                    }

                    $connection->close();
                }
            }
        }

        //Empty input field found
        else {
            $msg = 'Please fill in all fields';
            $msgClass = 'alert-danger';
        }
    }
}
//Error has occurred
catch (PDOException $e) {
    $msg = "Error:" . $e->getMessage();
    echo "Error:" . $e->getMessage();
    $connection->close();
}

?>

<!DOCTYPE html>
<html>
<style>
   
</style>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <script src="scripts/script-login.js"></script>
    <link rel="stylesheet" href="styles/fonts.css">
    <link rel="stylesheet" href="styles/style-login.css">
    <title>
        GymBuds
    </title>
</head>

<body>
    <header>
        
        <h1>
            <a href="login.php">GymBuds</a>
        </h1>


        <img src="images/dumbbell.png" height="128" width="128" alt="No dumbbell!">
        <h3>Gym together, Gain together!</h3>
    </header>

    <?php if ($msg != '') : ?>
        <div id="login-wrapper">
            <h3> <?php echo $msg; ?> </h3>
        </div>
    <?php endif; ?>

    <div id="login-wrapper">

        <form name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="login-labels">

                <h3>
                    Login
                </h3>

                <input type="email" 
                ondblClick="this.select();" 
                name=email 
                id="email" 
                size="25" required 
                placeholder="Email">

               <br>
               <br>

                <input type="password" 
                ondblClick="this.select();" 
                name=password 
                id="password" 
                minlength="5" 
                maxlength="20" 
                size="25" required 
                placeholder="Password">

            </div>
            <br>
            <button name="submit" value="submit" type="submit">Log in</button>
            <br><br>
            <div id="links-wrapper">
                <a href="register.php">Sign Up</a>
                <br>
                <a href="forgotpassword.php">Forgot password</a>
            </div>
        </form>

    </div>

    <footer>
        Website made by Christian Rodriguez (<a href="https://github.com/cjrcodes">cjrcodes on GitHub</a>)
    </footer>
</body>

</html>