<?php

header('Access-Control-Allow-Origin: *');

include_once __DIR__ . '/../classes/ActionHandler.class.php';

$sku = $_GET['value'];

(new ActionHandler($sku))->handleSkuCheck();