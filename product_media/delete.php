<?php
include_once __DIR__ . "/product_media.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $db->connect();

    $media = new ProductMedia($db);
    $id = $_POST['product_media_id'] ?? null;

    if ($id && $media->delete([$id])) {
        header("Location: list.php?deleted=1");
    } else {
        header("Location: list.php?error=no_selection");
    }
} else {
    header("Location: list.php");
}
exit();
