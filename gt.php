#!/usr/bin/php
<?php

	//Defaults arguments
	$defaults 	= array(
					'i' => 'auto',		//source language (default is 'guessing mode')
					'o' => 'random',	//target language ('random' keyword for random pick from $langs)
				);

	//Just for knowledge
	$langs = array('af', 'sq', 'de', 'en', 'ar', 'hy', 'az', 'eu', 'bn', 'be', 'bs', 'bg', 'ca', 'ceb', 'zh-CN', 'ko', 'ht', 'hr', 'da', 'es', 'eo', 'et', 'fi', 'fr', 'gl', 'cy', 'ka', 'el', 'gu', 'iw', 'hi', 'hmn', 'hu', 'id', 'ga', 'is', 'it', 'ja', 'jw', 'kn', 'km', 'lo', 'la', 'lv', 'lt', 'mk', 'ms', 'mt', 'mr', 'nl', 'fi', 'fa', 'pl', 'pt', 'ro', 'ru', 'sk', 'sl', 'sv', 'sw', 'tl', 'ta', 'cs', 'te', 'th', 'tr', 'uk', 'ur', 'vi', 'yi');
 
	function curl($url, $data = array(), $is_coockie_set = false)
	{
		if(!$is_coockie_set)
		{
			$cookie = tempnam('/tmp', 'gt_cookie');

			$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_exec($curl);
		}

		$url = $url.'?'.http_build_query($data);
	 
		$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	 
		return curl_exec($curl);
	}

 	function translate($text, $from, $to)
 	{
 		$url 	= 'http://translate.google.com/translate_a/t';

 		$data = array();
 			$data['client'] 	= 't';
 			$data['hl']			= 'en';
 			$data['multires'] 	= 1;
 			$data['sc']			= 1;
 			$data['ie']		 	= 'UTF-8';
 			$data['oe']			= 'UTF-8';

 			$data['text']		= $text;
 			$data['sl']			= $from;
 			$data['tl']			= $to;

 		$data = curl($url, $data);
 		$text = explode('"',$data);

 		return $text[1];
 	}

 	$options = array_merge($defaults, getopt("i:o:"));

 	$arguments = array_merge($argv);
	 	array_shift($arguments);

	$string = "";

 	for ($i = 0, $l = count($arguments); $i < $l; $i++)
 	{
 		if ($arguments[$i]{0} == "-") { continue; }
 		$string .= " ".$arguments[$i];
 	}

 	$string = substr($string, 1);

 	if (!empty($string))
 	{
 		if ($options['o'] == 'random') { $options['o'] = $langs[array_rand($langs)]; }
 		echo translate($string, $options['i'], $options['o']);
 	}
 	else
 	{
 		echo '--- Not enough arguments ---'.PHP_EOL;
 		echo '\tUse : '.$argv[0].' <text> [<to> or "random"] [<from> or "auto"]'.PHP_EOL;
 	}

?>