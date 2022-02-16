<?php

include_once __DIR__ . '/Queries.class.php'; 

abstract class Product
{
    public $sku, $name, $price, $type, $description;
    public $error = ['error_msg' => ''];

    public function __construct($input)
    {
        $this->sku = trim($input['sku']);
        $this->name = trim($input['name']);
        $this->price = trim($input['price']);
        $this->type = $input['type'];
        $this->description = trim($input['description']);

        $this->validateDescription();
        $this->validate();
    }

    abstract public function validateDescription();

    protected function validate()
    {
        if (empty($this->sku || empty($this->name)) || empty($this->price)) {
            $this->error = ['error_msg' => 'Please, submit required data'];
        }
        
        if (!is_numeric($this->price)) {
            $this->error = ['error_msg' => 'Please, provide the data of indicated type'];
        }

        if (empty($this->error['error_msg'])) {
            // Validation passed
            $this->handleQuery();
        } else {
            // Validation not passed, send error_msg to client
            echo json_encode($this->error);
        }
    }

    public function handleQuery()
    {
        $queriesInstance = new Queries;
        $queriesInstance->setProperties($this->sku, $this->name, $this->price, $this->type, $this->description);
        $queriesInstance->create();
    }
}