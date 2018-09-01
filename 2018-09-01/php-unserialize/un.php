<?php 
error_reporting(0); 
if(empty($_GET['code'])) die(show_source(__FILE__)); 
class Example{ 
    var $var=""; 
    function __destruct(){ 
        eval($this->var); 
    } 
} 

$ob = new Example(); 
$ob->var = unserialize($_GET['code']); 
echo '__FILE__:' . __FILE__; 
echo '<br />' . '?code='; 
unset($ob); 
?> 1