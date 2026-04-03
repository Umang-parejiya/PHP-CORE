<?php

require_once __DIR__ . "/../raw.php";

class Product extends Row
{
    public $tableName = 'product';
    public $primaryKey = 'product_id';
}   