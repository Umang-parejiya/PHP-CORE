<?php
include_once __DIR__ . "/customer.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $db->connect();

    $customer = new Customer($db);

    $id = $_POST['customer_id'] ?? null;
    $data = $_POST;

    if ($id) {
        $customer->load($id);
        $data['updated_date'] = date('Y-m-d H:i:s');
    } else {
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['updated_date'] = date('Y-m-d H:i:s');
    }

    $customer->setData($data);

    if ($customer->save()) {
        header("Location: list.php?success=1");
    } else {
        header("Location: list.php?error=1");
    }
} else {
    header("Location: list.php");
}
exit();
