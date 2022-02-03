<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

include_once __DIR__ . '/../classes/ActionHandler.class.php';

// Grab and decode json formatted input
$array = json_decode(file_get_contents('php://input'), true);

(new ActionHandler(null, $array))->handleDelete();