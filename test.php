<?php

include 'vendor/autoload.php';

use PanduanVIP\WebExtractor\GoogleSuggest;

$keyword = 'sepatu roda';
$results = json_decode(GoogleSuggest::get($keyword));

echo '<pre>';
print_r($results);