<?php
// Row then column

$file = file('input', FILE_IGNORE_NEW_LINES);
$zeroToThousand = range(0, 999);
$lights = array_fill_keys($zeroToThousand, array_fill_keys($zeroToThousand, 0));

foreach ($file as $cmd) {
	preg_match('/([a-z ]{4,9})([0-9]{1,3}\,[0-9]{1,3}) through ([0-9]{1,3}\,[0-9]{1,3})/', $cmd, $matches);
	array_shift($matches);
	list($command, $startCoords, $endCoords) = $matches;
	$command = trim($command);
	$startCoords = explode(',', $startCoords);
	$endCoords = explode(',', $endCoords);

	$lightsToSet = getCoordsBetweenInRectangle($startCoords, $endCoords);

	foreach ($lightsToSet as $light) {
		$lights[$light[0]][$light[1]] = whatSetTo($command, $light);	
	}
}


echo countOn($lights) . PHP_EOL;

function getCoordsBetweenInRectangle($startCoords, $endCoords) {
	$coords = [];
	
	for ($row = $startCoords[0]; $row <= $endCoords[0]; $row++) {
		for ($column = $startCoords[1]; $column <= $endCoords[1]; $column++) {
			$coords[] = [$row, $column];
		}
	}

	return $coords;
}

function whatSetTo($command, $coords) {
	global $lights;

	switch($command) {
		case 'turn on':
			return $lights[$coords[0]][$coords[1]] + 1;
		case 'turn off':
			return ($lights[$coords[0]][$coords[1]] > 0) ? $lights[$coords[0]][$coords[1]] - 1 : 0;
		case 'toggle':
			return $lights[$coords[0]][$coords[1]] + 2;
		default:
			die('What is "' . $command . '"');
	}	
}

function countOn($lights) {
	$count = 0;
	foreach ($lights as $k=>$v) {
		foreach ($v as $kk=>$vv) {
			$count+=$vv;
		}
	}
	return $count;
}
