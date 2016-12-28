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
<table>
<tr><td><label for="DNS">DNS: </label></td><td><input type="text" id="DNS" name="DNS" value="' . $dns . '" /></td></tr>';

    if ($synclibrary == 'True') {
        $body = $body . '<tr><td><label for="synclibrary">Sync Library Enabled:</label></td>
        <td><input type="checkbox" name="synclibrary" id="synclibrary" value="True" checked /></td></tr>';
    }else {
        $body = $body . '<tr><td><label for="synclibrary">Sync Library Enabled:</label></td>
        <td><input type="checkbox" name="synclibrary" id="synclibrary" value="True" /></td></tr>';
    }

    if ($syncmedia == 'True') {
        $body = $body . '<tr><td><label for="syncmedia">Sync Media Enabled:</label></td>
        <td><input type="checkbox" name="syncmedia" id="syncmedia" value="True" checked /></td></tr>';
    }else {
        $body = $body . '<tr><td><label for="syncmedia">Sync Media Enabled:</label></td>
        <td><input type="checkbox" name="syncmedia" id="syncmedia" value="True" /></td></tr>';
    }

    if ($syncmedia == 'True') {
        $body = $body . '<tr><td><label for="syncpref">Sync Preferences/Playlists Enabled:</label></td>
        <td><input type="checkbox" name="syncpref" id="syncpref" value="True" checked /></td></tr>';
    }else {
        $body = $body . '<tr><td><label for="syncpref">Sync Preferences/Playlists Enabled:</label></td>
        <td><input type="checkbox" name="syncpref" id="syncpref" value="True" /></td></tr>';
    }

    if ($automode == 'True') {
        $body = $body . '<tr><td><label for="automode">Auto Mode Enabled:</label></td>
        <td><input type="checkbox" name="automode" id="automode" value="True" checked /></td></tr>';
    }else {
        $body = $body . '<tr><td><label for="automode">Auto Mode Enabled:</label></td>
        <td><input type="checkbox" name="automode" id="automode" value="True" /></td></tr>';
    }

    $body = $body . '<td><td><input type="submit" id="submit" name="submit" value="Save settings" /></td><td></td></tr>
    </table>
    </form>
    <h2>Add a new user:</h2>
    <form id="newuser" action="adduser.php" method="post">
    <table>
    <tr><td><label for="username">Username (no spaces):</label></td>
    <td><input type="text" id="username" name="username" /></td></tr>
    <tr><td><label for="password1">Password:</label></td>
    <td><input type="password" id="password1" name="password1" /></td></tr>
    <tr><td><label for="password2">Confirm password:</label></td>
    <td><input type="password" id="password2" name="password2" /></td></tr>
    <tr><td></td><td><input type="submit" name="submit" id="submit" value="Add User" /></td></tr>
    </table>
    </form>
    
    <h2>Edit user:</h2>
    <p>(Enter passwords only if you want to reset the password for the user)</p>
    <form id="edituser" action="edituser.php" method="post">
    <table>
    <tr>
    <td><label for="un">Username:</label></td><td><input type="text" id="un" name="username" /></td>
    </tr>
    <tr>
    <td><label for="pw1">Password</label></td><td><input type="password" id="pw1" name="password1" /></td>
    </tr>
    <tr>
    <td><label for="pw2">Confirm password:</label></td><td><input type="password" id="pw2" name="password2" /></td>
    </tr>
    <tr>
    <td><label for="account_enabled-yes">Account status:</label></td><td><input type="radio" id="account_enabled-yes" name="account_enabled" value="true" checked /> Enabled</td>
    </tr>
    <tr><td></td><td><input type="radio" id="account_enabled-no" name="account_enabled" value="false" /> Disabled</td></tr>
    <tr><td></td><td><input type="submit" id="submit" name="submit" value="Save user" /></td></tr>
    </table>
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
