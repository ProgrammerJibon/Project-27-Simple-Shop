<?php 
function request_url($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_DNS_SHUFFLE_ADDRESSES, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
    curl_setopt($ch, CURLOPT_COOKIESESSION, false);/*
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');*/
    $buffer = curl_exec($ch);
    curl_close($ch);
    return $buffer;
}

for ($i=0; $i < 1000; $i++) { 
	if (@request_url('https://mobileworksws.xyz/7675130517522') == false) {
		break;
		echo $i;
	}
}