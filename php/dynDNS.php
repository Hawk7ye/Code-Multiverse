<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	/*
	 * Example: mydomain.com
	 */
	$domain 		= "";
	/*
	 * Example: subdomain.mydomain.com
	 */
	$subdomain		= "";
	$password 		= "";
	$ip 			= exec("curl -6 https://ifconfig.co/");

	$url = $domain . ":" . $password . "@dyndns.strato.com/nic/update?hostname=";
	$send = $url . $subdomain . "&myip=" . $ip;

	$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt($ch, CURLOPT_URL,$send);
	$result=curl_exec($ch);
	curl_close($ch);