<?php

namespace PanduanVIP\WebExtractor;

class GoogleSuggest
{
    public static function get($keyword='', $lang='', $country='', $source='', $proxy='')
    {
        $html = self::curl($keyword, $lang, $country, $source, $proxy);

        $dom = new \DOMDocument('1.0', 'UTF-8');
		@$dom->loadHTML($html);
		$xpath = new \DOMXPath($dom);

        $results = [];
        $blocks = $xpath->query('//suggestion');

        foreach($blocks as $block){
            $results[] = $block->getAttribute('data');
        }
        
        return json_encode($results);
    }
	
	private static function curl($keyword='', $lang='', $country='', $source='', $proxy='')
	{
		if (!function_exists('curl_version')) {
			die('cURL extension is disabled on your server!');
		}

		$keyword = str_replace(' ', '+', $keyword);
        $url = "http://google.com/complete/search?q=$keyword&hl=$lang&gl=$country&ds=$source&output=toolbar";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);	
		if(isset($_SERVER['HTTP_USER_AGENT'])){
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		}
		if (isset($_SERVER['HTTP_REFERER'])) {
			curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_REFERER']);
		}
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		if (!empty($proxy)) {
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
		}
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
  
}
