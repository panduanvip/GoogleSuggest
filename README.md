# Keyword Generator Base On Google Suggest

Web extractor for Google Suggest

## Installation:

```bash
composer require panduanvip/google-suggest
```

### Usage:

```php
<?php

include 'vendor/autoload.php';

use PanduanVIP\WebExtractor\GoogleSuggest;

$keyword = 'sepatu roda';
$results = json_decode(GoogleSuggest::get($keyword));

echo '<pre>';
print_r($results);
```

**Result:** 
```
Array
(
    [0] => sepatu roda
    [1] => sepatu roda dewasa
    [2] => sepatu roda 4
    [3] => sepatu roda anak perempuan
    [4] => sepatu roda di gbk
    [5] => sepatu roda bajaj
    [6] => sepatu roda anak-anak
    [7] => sepatu roda bahasa inggrisnya
    [8] => sepatu roda anak 3 tahun
    [9] => sepatu roda frozen
)
```
