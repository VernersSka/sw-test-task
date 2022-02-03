<?php

include_once __DIR__ . '/Product.class.php';

class DVD extends Product
{
    public function validateDescription()
    {
        if (!is_numeric($this->description)) {
            $this->error = ['error_msg' => 'Please, provide the data of indicated type'];
        }
    }
}