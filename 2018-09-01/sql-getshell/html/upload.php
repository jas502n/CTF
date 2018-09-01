<?php
session_start();
include_once 'lib/clean.php';
include_once 'lib/database.php';

if (isset($_FILES['upfile'])) {
    $file = $_FILES['upfile'];
    if ($file ['error'] > 0) {
        switch ($file ['error']) {
            case 1 :
                $mes = 'The uploaded file exceeds the value of the upload_max_filesize option in the PHP configuration file';
                break;
            case 2 :
                $mes = 'Exceeded the size of the form MAX_FILE_SIZE limit';
                break;
            case 3 :
                $mes = 'File section was uploaded';
                break;
            case 4 :
                $mes = 'No upload file selected';
                break;
            case 6 :
                $mes = 'No temporary directory found';
                break;
            case 7 :
            case 8 :
                $mes = 'System error';
                break;
        }
        die($mes);
    }
    $content = file_get_contents($file['tmp_name']);
    checkMIME($file);
    if (checkContent($content) && checkExts($file['name'])) {
        upload($file);
    } else {
        die('attack detected');
    }
} else {
    die('file not found');
}

function upload($file)
{
    $savepath = dirname(__file__) . '/uploads/';
    $filename = explode('.', $file['name']);
    $newname = rand_name() . "." . trim(end($filename));
    $finalname = $savepath . $newname;
    if (move_uploaded_file($file['tmp_name'], $finalname)) {
        $db = new Database();
        //,1,(select substring(filename,10,10) from(select filename from picture limit 0,1)x))#
        if ($db->insert($_SESSION['username'], getip(), $newname)) {
            header('location: index.php');
            exit();
        }
    }
}

function rand_name($l = 64)
{
    $str = null;
    $Pool = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz_";
    $max = strlen($Pool) - 1;
    for ($i = 0; $i < $l; $i++) {
        $str .= $Pool[rand(0, $max)];
    }
    return $str;
}

function checkExts($filename)
{
    $AllowedExt = array('php', 'php3', 'php4', 'php5', 'pht', 'phtml', 'inc');
    $filename = explode('.', $filename);
    if (in_array(strtolower($filename[count($filename) - 1]), $AllowedExt)) {
        return false;
    }
    return true;
}

function checkMIME($file)
{
    // text/php text/x-php
    $php_ext = array("text/php", "text/x-php");
    $type = mime_content_type($file['tmp_name']);
    if(!in_array(strtolower($type), $php_ext)){
        die("i need php file");
    }
}

function checkContent($content)
{
    if (stripos($content, '<?') === 0) {
        return false;
    }
    return true;
}