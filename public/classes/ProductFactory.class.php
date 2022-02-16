<?php

include_once __DIR__ . '/../classes/DVD.class.php';
include_once __DIR__ . '/../classes/Book.class.php';
include_once __DIR__ . '/../classes/Furniture.class.php';

class ProductFactory
{
    public static function makeProduct($input)
    {
        $type = $input['type'];
        if (class_exists($type)) {
            return new $type($input);
        } else {
            echo 'Given class does not exist';
        }
    }
}