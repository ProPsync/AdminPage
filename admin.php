<?php
    error_reporting( E_ALL );
    ini_set('display_errors', 'On');
    $body = '';
    $auth_value = $_COOKIE['ProPsAUTH'];
    if ((!(file_exists('/var/www/auths/' . $auth_value))) || ($auth_value == "")){
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

    $df = disk_free_space("/");
    $dfg = round(($df / 1073741824),2);

    $ds = disk_total_space("/");
    $dsg = round(($ds / 1073741824),2);


    $du = ($ds - $df);
    $dug = round(($du / 1073741824),2);


    $dup = (($du / $ds) * 100);



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
    </form>';

    if ($dup < 75) {
        $body = $body . '<h3>Disk space used:</h3>
    <p>' . $dug . 'GB / ' . $dsg . 'GB (' . $dfg . 'GB free)</p>
    <div class="meter">
        <span style="width: ' . $dup . '%"></span>
    </div>';
    }else {
        if ($dup < 90) {
            $body = $body . '<h3>Disk space used:</h3>
    <p>' . $dug . 'GB / ' . $dsg . 'GB (' . $dfg . 'GB free)</p>
    <div class="meter orange">
        <span style="width: ' . $dup . '%"></span>
    </div>';
        } else {

                $body = $body . '<h3>Disk space used:</h3>
    <p>' . $dug . 'GB / ' . $dsg . 'GB (' . $dfg . 'GB free)</p>
    <div class="meter red">
        <span style="width: ' . $dup . '%"></span>
    </div>';
        }
    }




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
