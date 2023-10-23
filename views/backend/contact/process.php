<?php
use App\Models\contact;
use App\Libraries\MyClass;
use App\Models\Contact;

if (isset($_POST['THEM'])) {
    $contact = new Contact();
    //Lấy từ form
    $contact->name= $_POST['name'];
    $contact->slug = (strlen($_POST['slug']) >0) ? $_POST['slug'] : MyClass::str_slug($_POST['name']);
    $contact->description= $_POST['description'];
    $contact->status= $_POST['status'];
    //Xử lý upload file
    if (strlen($_FILES['image']['name']) > 0) {
        $target_dir = "../public/images/contact";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($extension,['jpg','jpeg','png','gif','webp'])) {
            $filename = $contact->slug . '.' . $extension;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename);
            $contact->image = $filename;
        }
    }
    //Tự sinh ra
    $contact->created_at = date('Y-m-d H:i:s');
    $contact->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    var_dump($contact);
    //Lưu vào CSDL
    //INSERT INTO contact 
    $contact->save();
    //Chuyển hướng về index
    header("location:index.php?option=contact");
}