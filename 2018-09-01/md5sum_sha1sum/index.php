<?php
error_reporting(0);
include('flag.php');

$a = $_GET['a'];
$b = $_GET['b'];
$c = $_GET['c']; 
$d = $_GET['d'];
if (empty($a) || empty($b)) 
{
    show_source(__FILE__);
    die();
}
elseif($a != $b && md5($a) == md5($b))
{
    if ($c != $d && sha1($c) == sha1($d)) 
    {
        echo $flag;
    }
}
?>
