<?php
$file = file('input', FILE_IGNORE_NEW_LINES);
$nice = 0;
foreach ($file as $line) {
	if (isNice($line)) {
		$nice++;
	}
}
echo $nice . PHP_EOL;

function isNice($string) {
	$hasDouble = false;
	$vowelCount = 0;
	$hasDisallowed = false;

	$vowelCount = preg_match_all('/[aeiou]/i', $string, $matches);

	$alphabet = range('a', 'z');
	array_walk($alphabet, function(&$val) { $val .= $val; }); // double them up
	foreach ($alphabet as $a) {
		if (strpos($string, $a) !== false) {
			$hasDouble = true;
			break;
		}	
	}

	if (strpos($string, 'ab') !== false || strpos($string, 'cd') !== false || strpos($string, 'pq') !== false || strpos($string, 'xy') !== false) {
		$hasDisallowed = true;
	}
	return ($hasDouble === true && $vowelCount >= 3 && $hasDisallowed === false);
}
