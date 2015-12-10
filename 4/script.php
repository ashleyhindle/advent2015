<?php
$input = trim(file_get_contents('input'));
echo 'Input: ' . $input . PHP_EOL;
$i = 0;

do {
	$hexed = md5($input . $i++);
} while (substr($hexed, 0, 5) !== '00000');

echo PHP_EOL . $i-1 . PHP_EOL;
