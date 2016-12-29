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
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" />
            <label for="pw">Password: </label>
            <input type="password" id="pw" name="pw" />
            <input type="submit" id="submit" name="submit" value="submit" />
        </form>
    </body>
</html>