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


    $body = $_POST["automode"];

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
