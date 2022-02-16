<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

include_once __DIR__ . '/../classes/ProductFactory.class.php';

$input = json_decode(file_get_contents('php://input'), true);

ProductFactory::makeProduct($input);