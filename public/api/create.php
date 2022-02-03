<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

include_once __DIR__ . '/../classes/DVD.class.php';
include_once __DIR__ . '/../classes/Book.class.php';
include_once __DIR__ . '/../classes/Furniture.class.php';

$input = json_decode(file_get_contents('php://input'), true);

switch ($input['type']) {
    case 'DVD':
        $product = new DVD($input);
        break;

    case 'Book':
        $product = new Book($input);
        break;

    case 'Furniture':
        $product = new Furniture($input);
        break;
}