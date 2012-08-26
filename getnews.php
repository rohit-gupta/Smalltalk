<?php
$q=$_REQUEST['q'];

function curl_get($url){
    $return = '';
    (function_exists('curl_init')) ? '' : die('cURL Must be installed!');

    $curl = curl_init();
    $header[0] = "Accept: text/xml,application/xml,application/json,application/xhtml+xml,";
    $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
    $header[] = "Cache-Control: max-age=0";
    $header[] = "Connection: keep-alive";
    $header[] = "Keep-Alive: 300";
    $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $header[] = "Accept-Language: en-us,en;q=0.5";

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
$data=curl_get("http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20boss.search%20where%20q%3D'".rawurlencode($q)."'%20and%20ck%3D'dj0yJmk9YWF3ODdGNWZPYjg2JmQ9WVdrOWVsWlZNRk5KTldFbWNHbzlNVEEyTURFNU1qWXkmcz1jb25zdW1lcnNlY3JldCZ4PTUz'%20and%20secret%3D'a3d93853ba3bad8a99a175e8ffa90a702cd08cfa'%20and%20service%3D'news'&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=");
if(strpos($data,'"count":"0"')===FALSE) {
	echo "N*<br/><br/>".var_dump($data["results"]);
}
else {
	$data=curl_get("http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20boss.search%20where%20q%3D'".rawurlencode($q)."'%20and%20ck%3D'dj0yJmk9YWF3ODdGNWZPYjg2JmQ9WVdrOWVsWlZNRk5KTldFbWNHbzlNVEEyTURFNU1qWXkmcz1jb25zdW1lcnNlY3JldCZ4PTUz'%20and%20secret%3D'a3d93853ba3bad8a99a175e8ffa90a702cd08cfa'%20and%20service%3D'web'&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=");
	echo "W*<br/><br/>".var_dump($data["results"]);
}

?>