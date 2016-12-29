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


    if ($_POST["synclibrary" == "True"]) {
        $synclibrary = "True";
    }else {
        $synclibrary = "False";
    }

    if ($_POST["syncmedia" == "True"]) {
        $syncmedia = "True";
    }else {
        $syncmedia = "False";
    }

    if ($_POST["syncpref" == "True"]) {
        $syncpref = "True";
    }else {
        $syncpref = "False";
    }

    if ($_POST["automode" == "True"]) {
        $automode = "True";
    }else {
        $automode = "False";
    }

    $dns = $_POST["DNS"];


    shell_exec("echo '<dns>" . $dns . "</dns>'>/var/www/html/config.txt");
    shell_exec("echo '<mediarepo>" . $mediarepo . "</mediarepo>'>>/var/www/html/config.txt");
    shell_exec("echo '<libraryrepo>" . $libraryrepo . "</libraryrepo>'>>/var/www/html/config.txt");
    shell_exec("echo '<prefrepo>" . $prefrepo . "</prefrepo>'>>/var/www/html/config.txt");
    shell_exec("echo '<syncmedia>" . $syncmedia . "</syncmedia>'>>/var/www/html/config.txt");
    shell_exec("echo '<synclibrary>" . $synclibrary . "</synclibrary>'>>/var/www/html/config.txt");
    shell_exec("echo '<syncpref>" . $syncpref . "</syncpref>'>>/var/www/html/config.txt");
    shell_exec("echo '<automode>" . $automode . "</automode>'>>/var/www/html/config.txt");

    $body = "Completed.";

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
<p><a href="admin.php">Go Back</a></p>
</body>
</html>
