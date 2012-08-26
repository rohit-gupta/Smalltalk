<?php
	function get_sport($athlete)
	{
	$sports=array("football","cricket","badminton","tennis","golf");
	$max_count=array(0,0,0,0,0);
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
		foreach($athlete as $var)
		{
			$url="http://en.wikipedia.org/wiki/".preg_replace("/ /",'_',$var['name']);
			$long_url="http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20html%20where%20url%3D%22".rawurlencode($url)."%22%20and%0A%20%20%20%20%20%20xpath%3D'%2F%2Fdiv%5B%40id%3D%22mw-content-text%22%5D%2Fp%5B1%5D'&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=";
			$result=curl_get($long_url);
			$result=preg_split('/([\s\-_,:;?!\/\(\)\[\]{}<>\r\n"]|(?<!\d)\.(?!\d))/',$result, null, PREG_SPLIT_NO_EMPTY);
			$count=array(0,0,0,0,0);
			foreach($result as $str)
			{
				for($i=0;$i<5;$i++)
					if($sports[$i]==$str)
						$count[$i]++;
			}
			$pos=0;
			for($i=0;$i<5;$i++) if($count[$i]>$count[$pos]) $pos=$i;
			if($count[$pos]) $max_count[$pos]++;
		}
		$pos=0;
		for($i=0;$i<5;$i++) if($max_count[$i]>$max_count[$pos]) $pos=$i;
		return $sports[$pos];
	}
?>
