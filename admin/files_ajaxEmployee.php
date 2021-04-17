<?php

require_once '../lib/core.php';

if(isset($_POST['deleteFile']))
{
    $id =$_POST['deleteFile'];
    $sql ="delete from project_files where id=$id";
    if($conn->query($sql))
    {
        unlink($_POST['delpath']);
        echo "ok";
    }else
    {
        echo $conn->error;
    }
}
?>