<?php
require_once '../lib/core.php';

//editing
if (isset($_POST['edit']) || isset($_POST['ename']) || isset($_POST['eemail']) || isset($_POST['econtact']) || isset($_POST['epassword'])) {
    $count= $_POST['count'];
    $id = $_POST['eid'];
    $name = $_POST['ename'];
    $email = $_POST['eemail'];
    $contact = $_POST['econtact'];
    $password = $_POST['epassword'];
    $sql = "update employee set name='$name',email='$email',contact='$contact',password=MD5('$password') where id='$id'";
    if ($conn->query($sql)) {
        echo "ok";
    } else {
        echo "not ok";
    }
    
}
?>