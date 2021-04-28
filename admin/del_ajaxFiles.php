<?php

require_once '../lib/core.php';

if(isset($_POST['deleteId']))
{
    $id =$_POST['deleteId'];
    $sql ="delete from project_files where id=$id";
    if($conn->query($sql))
    {
        // unlink($_POST['delpath']);
        echo "ok";
    }else
    {
        echo $conn->error;
    }
}
?>