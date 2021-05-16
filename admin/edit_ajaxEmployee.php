<?php
require_once '../lib/core.php';

//editing
if (isset($_POST['edit']) || isset($_POST['ename']) || isset($_POST['eemail']) || isset($_POST['econtact']) || isset($_POST['epassword']) && !empty($_POST['epassword'])) {
    
    $id = $_POST['eid'];
    $name = $conn->real_escape_string($_POST['ename']);
    $email = $conn->real_escape_string($_POST['eemail']);
    $contact = $conn->real_escape_string($_POST['econtact']);
    $password = $conn->real_escape_string($_POST['epassword']);
    $sql = "update employee set name='$name',email='$email',contact='$contact',password=MD5('$password') where id='$id'";
    if ($conn->query($sql)) {
        echo "ok";
    } else {
        echo "not ok";
    }
    
}
?>