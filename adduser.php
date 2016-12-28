<?php
    $body = '';
    $auth_value = $_COOKIE['ProPsAUTH'].trim();
    if (!(file_exists('/var/www/auths/' . $auth_value))){
        //Unauthorized
        header('Location: index.php');
    }

    $username = $_POST["username"];
    $pw1 = $_POST["password1"];
    $pw2 = $_POST["password2"];

    if ($pw1 == $pw2) {
        $output = 'Adding user... <br />';
        $output = $output . shell_exec('adduser ' . $username) . '<br />';
        $output = $output . 'Setting password... <br />';
        $output = $output . shell_exec('echo ' . $username . ':' . $pw1 . ' | chpasswd') . '<br />';
        $body = '<h3>Result</h3><p>' . $output . '</p>';
    }else {
        $body = "<h1>Error: Passwords do not match.</h1>";
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
        <?php echo $body ?>
        <p><a href="admin.php">Go Back</a></p>
    </body>
</html>

