<?php

//curl模拟提交cookie

$url = "http://local1.hiselling.com/bg_os/index.php?com=index";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);

curl_setopt($ch,CURLOPT_COOKIE,'_ga=GA1.2.1527754502; _bgLang=en-GB; __unam=311f179-1636d889e74-7ce142e4-86; sg_center_SID=f579726c73aebbfec3e4f6827b842b1b');

$content = curl_exec($ch);

var_dump($content);

curl_close($ch);




