<?php
require_once '../lib/core.php';

//deleting
if (isset($_POST['deleteEmp'])) {
    $id = $_POST['deleteEmp'];
    $sql = "delete  from employee where id=$id";
    if ($conn->query($sql)) {
        echo "ok";
    } else {
        echo "not ok";
    }
}
?>