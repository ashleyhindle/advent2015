<?php
$fc = str_split(trim(file_get_contents('input')));
$location = [0, 0];
$map = [
	'0x0' => 1
];

foreach ($fc as $direction) {
	switch($direction) {
		case '^': $location[0] += 1; break;
		case 'v': $location[0] -= 1; break;
		case '>': $location[1] += 1; break;
		case '<': $location[1] -= 1; break;
	}

	$map[$location[0].'x'.$location[1]] = 1;
}
echo count($map) . PHP_EOL;
