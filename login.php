<?php
    error_reporting( E_ALL );
    ini_set('display_errors', 'On');
    $user = $_POST["username"];
    $pw = $_POST["pw"];

    $result = "";

    try {
        $connection = ssh2_connect('127.0.0.1', 22);
        ssh2_auth_password($connection, $user, $pw);
        $stream = ssh2_exec($connection, 'ls ~');
        $result = 'authenticated';

        $auth_value = generateRandomString();

        shell_exec('echo ' . $auth_value . ' > ../auths/' . $auth_value);


        setcookie('ProPsAUTH', $auth_value, time() + 86400);

        //header('Location: admin.php');
    }catch (Exception $e) {
        $result = 'un-authenticated';
    }




    function generateRandomString($length = 64) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <title>ProPsync</title>
        <!--<link rel="stylesheet" href="css/screen.css">-->
        <meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php echo $result ?>
    </body>
</html>
