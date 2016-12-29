<?php
    $auth_value = $_COOKIE['ProPsAUTH'].trim();
    if ((file_exists('/var/www/auths/' . $auth_value)) && ($auth_value != "")){
        //Unauthorized
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <title>ProPsync</title>
        <link rel="stylesheet" href="css/screen.css">
        <meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form id="login" action="login.php" method="post">
            <img src="images/ppslogo.png" alt="" />
            <div id="loginun">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username" />
            </div>
            <div id="loginpw">
                <label for="pw">Password: </label>
                <input type="password" id="pw" name="pw" />
            </div>
            <div id="loginsubmit">
                <input type="submit" id="submit" name="submit" value="submit" />
            </div>
        </form>
    </body>
</html>