<?php
use App\Models\Category;
use App\Libraries\MyClass;

if (isset($_POST['THEM'])) {
    $category = new Category();
    //Lấy từ form
    $category->name= $_POST['name'];
    $category->slug = (strlen($_POST['slug']) >0) ? $_POST['slug'] : MyClass::str_slug($_POST['name']);
    $category->parent_id= $_POST['parent_id'];
    $category->status= $_POST['status'];
    //Xử lý upload file
    if (strlen($_FILES['image']['name']) > 0) {
        $target_dir = "../public/images/category";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($extension,['jpg','jpeg','png','gif','webp'])) {
            $filename = $category->slug . '.' . $extension;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename);
            $category->image = $filename;
        }
    }
    //Tự sinh ra
    $category->created_at = date('Y-m-d H:i:s');
    $category->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    var_dump($category);
    //Lưu vào CSDL
    //INSERT INTO category 
    $category->save();
    //Chuyển hướng về index
    header("location:index.php?option=category");
}