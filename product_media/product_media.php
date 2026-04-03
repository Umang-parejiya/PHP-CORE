<?php

include_once __DIR__ . "/../raw.php";

class ProductMedia extends Row {
    protected $tableName = 'product_media';
    protected $primaryKey = 'product_media_id';

    public function getProducts($db) {
        return $db->fetchAll("SELECT * FROM product ORDER BY name ASC");
    }
}
