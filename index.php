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

            <table id="logintab">
                <img src="images/ppslogo.png" alt="" />
                <tr><td><label for="username">Username: </label></td>
                <td><input type="text" id="username" name="username" /></td></tr>

                <tr><td><label for="pw">Password: </label></td>
                <td><input type="password" id="pw" name="pw" /></td></tr>

                <tr><td></td><td><input type="submit" id="submit" name="submit" value="Login" /></td></tr>
            </table>
        </form>
    </body>
</html>