<?php
header('Access-Control-Allow-Origin: https://app2.abtasty.com');
header("Access-Control-Allow-Methods: GET, OPTIONS");
header('Content-Type: application/json; charset=utf-8');
die(file_get_contents('sample.json'));
