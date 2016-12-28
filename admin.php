<?php

    $body = '';
        $auth_value = $_COOKIE['ProPsAUTH'].trim();
        if (!(file_exists('/var/www/auths/' . $auth_value))){
            //Unauthorized
            header('Location: index.php');
        }

    $config = shell_exec('cat ./config.txt');

    $dns = between($config, '<dns>', '</dns>');

    $mediarepo = between($config, '<mediarepo>', '</mediarepo>');

    $libraryrepo = between($config, '<libraryrepo>', '</libraryrepo>');

    $prefrepo = between($config, '<prefrepo>', '</prefrepo>');

    $syncmedia = between($config, '<syncmedia>', '</syncmedia>');

    $synclibrary = between($config, '<synclibrary>', '</synclibrary>');

    $syncpref = between($config, '<syncpref>', '</syncpref>');

    $automode = between($config, '<automode>', '</automode>');


    $body = '<h2>Edit global preferences:</h2>
<form id="preferences" action="savepref.php" method="post">
<label for="DNS">DNS: </label><input type="text" id="DNS" name="DNS" value="' . $dns . '" />';

    if ($synclibrary == 'True') {
        $body = $body . '<label for="synclibrary">Sync Library Enabled:</label><input type="checkbox" name="synclibrary" id="synclibrary" value="True" checked />';
    }else {
        $body = $body . '<label for="synclibrary">Sync Library Enabled:</label><input type="checkbox" name="synclibrary" id="synclibrary" value="True" />';
    }

    if ($syncmedia == 'True') {
        $body = $body . '<label for="syncmedia">Sync Media Enabled:</label><input type="checkbox" name="syncmedia" id="syncmedia" value="True" checked />';
    }else {
        $body = $body . '<label for="syncmedia">Sync Media Enabled:</label><input type="checkbox" name="syncmedia" id="syncmedia" value="True" />';
    }

    if ($syncmedia == 'True') {
        $body = $body . '<label for="syncpref">Sync Preferences/Playlists Enabled:</label><input type="checkbox" name="syncpref" id="syncpref" value="True" checked />';
    }else {
        $body = $body . '<label for="syncpref">Sync Preferences/Playlists Enabled:</label><input type="checkbox" name="syncpref" id="syncpref" value="True" />';
    }

    if ($automode == 'True') {
        $body = $body . '<label for="automode">Auto Mode Enabled:</label><input type="checkbox" name="automode" id="automode" value="True" checked />';
    }else {
        $body = $body . '<label for="automode">Auto Mode Enabled:</label><input type="checkbox" name="automode" id="automode" value="True" />';
    }

    $body = $body . '<input type="submit" id="submit" name="submit" value="Save settings">
    </form>
    <h2>Add a new user:</h2>
    <form id="newuser" action="adduser.php" method="post">
    <label for="username">Username (no spaces):</label>
    <input type="text" id="username" name="username" />
    <label for="password1">Password:</label>
    <input type="password" id="password1" name="password1" />
    <label for="password2">Confirm password:</label>
    <input type="password" id="password2" name="password2" />
    <input type="submit" name="submit" id="submit" value="Add User" />
    </form>';



    function between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
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
    </body>
</html>
