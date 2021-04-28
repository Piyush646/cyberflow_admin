<?php
include_once "../lib/core.php";
if(isset($_POST['deleteMem']))
{
    $id=$_POST['deleteMem'];
     $sql = "delete  from team where id=$id";
    if ($conn->query($sql)) {
        echo "ok";
    } else {
        echo "not ok";
}
}
?>