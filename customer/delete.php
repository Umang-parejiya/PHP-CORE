<?php
include_once __DIR__ . "/customer.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $db->connect();

    $customer = new Customer($db);
    $id = $_POST['customer_id'] ?? null;

    if ($id && $customer->delete([$id])) {
        header("Location: list.php?deleted=1");
    } else {
        header("Location: list.php?error=no_selection");
    }
} else {
    header("Location: list.php");
}
exit();
