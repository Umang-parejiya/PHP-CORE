<?php 

include_once __DIR__ . "/category.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database("localhost","root","","internship_project");
    $db->connect();

    $category = new Category($db);

    $id = $_POST['category_id'] ?? null;
    $data = $_POST;

    if($id) {
        $category->load($id);
        $data['updated_date'] = date('Y-m-d H:i:s');
    }else {
        $data['created_date'] = date('Y-m-d H:i:s');
    }

    $category->setData($data);

    if($category->save()){
        header("Location:list.php?success=1");
    }else {
        header("Location: list.php?error=1");
    }
}else {
    header("Location:list.php");
}