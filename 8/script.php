<?php
echo strlen(implode('', file('input', FILE_IGNORE_NEW_LINES))) - strlen(implode('', array_map(function($l) { return trim(preg_replace(['/"$/','/^"/'], '', stripslashes(preg_replace_callback('/\\\x[0-9a-f]{2}/', function ($m) { return chr(hexdec($m[0])); }, $l)), 1)); }, file('input', FILE_IGNORE_NEW_LINES))));