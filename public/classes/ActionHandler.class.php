<?php

include_once __DIR__ . '/Queries.class.php';

class ActionHandler extends Queries
{
    public $sku, $delete;

    public function __construct(string $sku = null, array $delete = null)
    {
        parent::__construct();
        if ($sku !== null) {
            parent::setProperties($sku);
        }
        if ($delete !== null) {
            parent::setDeleteValues($delete);
        }
    }

    public function handleDelete()
    {
        parent::delete();
    }

    public function handleSkuCheck()
    {
        parent::findSku();
    }
}