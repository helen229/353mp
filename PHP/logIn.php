<html>
<head>
    <title>LogIn page</title>
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> <!--user need to key in the username and password of database.-->
    <label for = "username">UserName:</label>
    <input type="text", id="username" name="username"/><br/>
    <label for = "Password">Password:</label>
    <input type="password", id="Password" name="Password"><br/>
    <input type="submit" value="Submit" name="Submit">
</form>


</body>
</html>
<?php
    if (isset($_POST['Submit'])) // if user press the submit button isset will return true.
    {
        LogIn(); //run LogIn function.
    }

    function LogIn() //check whether the username and password is empty. If yes, throw exception.
    {
        try{
            if (empty($_POST['username']))
            {
                throw new mysqli_sql_exception("UserName is empty.");
            } elseif (empty($_POST['Password']))
            {
                throw new mysqli_sql_exception("Password is empty.");
            }else{
                LogInDB(); // If user name and password is not empty, run LogInDB().
            }
        } catch (mysqli_sql_exception $x)
        {
            echo $x->getMessage();
        }
    }

    function LogInDB() // this function will check the validation of username and password, if invalid, throw exception.
    {
        define('DB_HOST', 'localhost');
        define('DB_USER', $_POST['username']);
        define('DB_PASS', $_POST['Password']);
        define('DB_NAME', 'Main');
        try{
            $dbConnection = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$dbConnection) {
                throw new mysqli_sql_exception;
            }else{
                header("location: http://localhost:63342/PHP/check.php");
                setcookie('username', $_POST['username']);
                setcookie('password', $_POST['Password']);
                exit;
            }
        }catch (mysqli_sql_exception $e)
        {
            die("UserName or Password wrong.");
        }

    }
?>
