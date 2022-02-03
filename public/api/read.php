<?php
    
header('Access-Control-Allow-Origin: *');

include_once __DIR__ . '/../classes/Queries.class.php';

(new Queries)->read();
