<?php
include_once __DIR__ . "/product_media.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $db->connect();

    $media = new ProductMedia($db);

    $id = $_POST['product_media_id'] ?? null;
    $data = $_POST;

    if ($id) {
        $media->load($id);
        $data['updated_date'] = date('Y-m-d H:i:s');
    } else {
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['updated_date'] = date('Y-m-d H:i:s');
    }

    $media->setData($data);

    if ($media->save()) {
        header("Location: list.php?success=1");
    } else {
        header("Location: list.php?error=1");
    }
} else {
    header("Location: list.php");
}
exit();
