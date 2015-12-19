<?php
require_once __DIR__ . '/vendor/autoload.php';

$lines = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);
$inputParser = new InputParser();
$parsed = $inputParser->parseArray($lines);



echo "Shortest route distance: {$shortestRouteDistance}" . PHP_EOL;