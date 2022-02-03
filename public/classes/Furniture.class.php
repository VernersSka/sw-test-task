<?php

include_once __DIR__ . '/Product.class.php';

class Furniture extends Product
{
    public function validateDescription()
    {
       $dimensions = explode('x', $this->description);
       foreach ($dimensions as $dimension) {
           if (!is_numeric($dimension)) {
            $this->error = ['error_msg' => 'Please, provide the data of indicated type'];
           }
       }
    }
}