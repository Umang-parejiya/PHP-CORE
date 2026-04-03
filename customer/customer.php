<?php

include_once __DIR__ . "/../raw.php";

class Customer extends Row {
    protected $tableName = 'customer';
    protected $primaryKey = 'customer_id';

    public function getGroups($db) {
        return $db->fetchAll("SELECT * FROM customer_group ORDER BY group_name ASC");
    }
}
