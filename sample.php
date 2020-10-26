<?php
header('Access-Control-Allow-Origin: https://app2.abtasty.com');
header('Content-Type: application/json; charset=utf-8');
die(file_get_contents('sample.json'));
