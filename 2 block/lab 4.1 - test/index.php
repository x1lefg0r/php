//1
<?php
$string = 'a1b2c3';

$result = preg_replace_callback(
    '/\d/',
    function ($matches) {
        return $matches[0] . $matches[0]; // Удваиваем цифру
    },
    $string
);

echo $result;
?>

//4
<?php
function isThirdLevelDomain($domain) {
    if (!preg_match('/^[a-z0-9-]+(\.[a-z0-9-]+){2}$/i', $domain)) {
        return false;
    }
    
    if (strpos($domain, '..') !== false || 
        $domain[0] === '.' || 
        $domain[0] === '-' || 
        $domain[strlen($domain)-1] === '.' || 
        $domain[strlen($domain)-1] === '-') {
        return false;
    }
    
    $parts = explode('.', $domain);
    if (count($parts) !== 3) {
        return false;
    }
    
    foreach ($parts as $part) {
        if (strlen($part) < 1 || strlen($part) > 63) {
            return false;
        }
    }
    
    if (preg_match('/[0-9]/', $parts[2])) {
        return false;
    }
    
    return true;
}

$domains = [
    'hello.site.ru',
    'hello.site.com',
    'hello.my-site.com',
    'test.domain.co.uk',
    'hello..site.ru',
    '-hello.site.ru',
    'hello.site.123',
    'hello.site',
    'a.b.c.d'
];

foreach ($domains as $domain) {
    echo "$domain - " . (isThirdLevelDomain($domain) ? 'valid' : 'invalid') . "\n";
}
?>

//9
<?php
$string = 'aae xxz 33a';

$result = preg_replace('/(.)\1/', '!', $string);

echo $result;
?>

//16
<?php
$string = 'xbx aca aea abba adca abea';

$result = preg_replace('/\b(\w+)\b/', '!$1!', $string);

echo $result;
?>

//25
<?php
$string = 'aaa * bbb ** eee * **';

$result = preg_replace('/(?<!\*)\*(?!\*)/', '!', $string);

echo $result;
?>

//36
<?php
$string = '23 2+3 2++3 2+++3 345 567';

preg_match_all('/2\++3/', $string, $matches);

print_r($matches[0]);
?>