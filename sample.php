<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, HEAD, OPTIONS, POST,  PUT");
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Headers: Authorization");

die(file_get_contents('sample.json'));
