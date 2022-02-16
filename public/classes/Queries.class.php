<?php

include_once __DIR__ . '/../config/Database.php';

class Queries extends Database
{
    private $conn;
    private $table = 'products';

    protected $sku, $name, $price, $type, $description, $deleteValues;

    public function __construct()
    {
        $this->conn = parent::connect();
    }

    public function setProperties($sku = null, $name = null, $price = null, $type = null, $description = null)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->description = $description;
        return $this;
    }

    protected function setDeleteValues($array)
    {
        $this->deleteValues = $array;
    }

    public function create()
    {
        try {
            $query = 'INSERT INTO ' . $this->table . '
                (sku, name, price, type, description)
                VALUES (:sku, :name, :price, :type, :description)';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':sku', $this->sku);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':description', $this->description);

            $stmt->execute();

            echo "Product added successfully";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
        $this->conn = null;
    }

    public function read()
    {
        try {
            $query = 'SELECT * FROM ' . $this->table;
            $stmt = $this->conn->query($query);

            while($row = $stmt->fetch()) {
                $response[] = $row;
            }
        } catch(PDOException $e) {
            echo($query);
            echo "Error: " . $e->getMessage();
        }

        if (empty($response)) {
            $response = false;
        }

        echo json_encode($response);

        $this->conn = null;
    }

    public function delete()
    {
        foreach ($this->deleteValues['data'] as $value) {
            try {
                $query = 'DELETE FROM ' . $this->table . ' 
                        WHERE sku=:sku;';
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':sku', $value);
                $stmt->execute();
                
            } catch(PDOException $e) {
                echo($query);
                echo "Error: " . $e->getMessage();
            }
        }
        
        echo "Products deleted successfully";
        
        $this->conn = null;
    }

    public function findSku()
    {
        try {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE sku=:sku';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':sku', $this->sku);
            $stmt->execute();

        } catch(PDOException $e) {
            echo($query);
            echo "Error: " . $e->getMessage();
        }

        $result = $stmt->fetch();

        echo json_encode($result);

        $this->conn = null;
    }
}