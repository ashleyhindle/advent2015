<?php
$r = count_chars(str_replace("\n", '', file_get_contents('input')), 1);

print_r($r[40] - $r[41]);
