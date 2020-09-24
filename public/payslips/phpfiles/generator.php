
<?php


$url1 = $_SERVER['REQUEST_URI'];
//header("Refresh: 15; URL=$url1");
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://happydelivery.at/instrumententafel/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: happydelivery.at';
$headers[] = 'Cache-Control: max-age=0';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'User-Agent: Mozilla/5.0 (iPad; CPU OS 11_0 like Mac OS X) AppleWebKit/604.1.34 (KHTML, like Gecko) Version/11.0 Mobile/15A5341f Safari/604.1';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'Sec-Fetch-Mode: navigate';
$headers[] = 'Sec-Fetch-User: ?1';
$headers[] = 'Sec-Fetch-Dest: document';
$headers[] = 'Referer: https://happydelivery.at/anmeldung/';
$headers[] = 'Accept-Language: en-US,en;q=0.9,de;q=0.8,fa;q=0.7';
$headers[] = 'Cookie: quform_session_7f3a382ed44e2fcfacd16e84e2379108=MtmfYDk59Y2cd3nlJcLLDBbdS3Da9UnGl3bBku8o; wordpress_logged_in_7f3a382ed44e2fcfacd16e84e2379108=Farzad.saghaee%7C1599845800%7CSBHpID23TavgtptEl1WeaUhj2VFZ3GFKjmTuHSITB53%7C99807ec9bb8e08bed87272ae39122eed156bb4c30c597da044b8f22a4228a9f0; _icl_current_language=de';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$element01= 'style="color:#1abc9c">';

$temp = get_string_between($result,$element01,"<");
echo $result;
if($temp != 407) {
   // telegram($temp);
}

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);



function telegram($msg) {
    $telegrambot='1269954450:AAE8Tq3LvGHWcaD5tQxxzFK2F__huENebug';
    $telegramchatid=100085200;
    $url='https://api.telegram.org/bot'.$telegrambot.'/sendMessage';$data=array('chat_id'=>$telegramchatid,'text'=>$msg);
    $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);
    $context=stream_context_create($options);
    $result=file_get_contents($url,false,$context);
    return $result;
}





function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
?>
