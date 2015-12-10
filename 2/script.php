<?php
$file = file('input', FILE_IGNORE_NEW_LINES);
$input = '2x3x4';

$totalFeet = 0;
foreach ($file as $input) {
	list($length, $width, $height) = explode('x', $input);
	$lw1 = ($length * $width);
	$wh1 = ($width * $height);
	$hl1 = ($height * $length);
	$totalFeet += (2*$lw1 + 2*$wh1+ 2*$hl1)  + min([$lw1, $wh1, $hl1]);
}
echo $totalFeet . PHP_EOL;
