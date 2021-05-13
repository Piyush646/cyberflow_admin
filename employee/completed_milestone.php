<?php
include_once "../lib/core.php";
if(isset($_POST['assignedId']))
{
    $id=$_POST['assignedId'];
    $sql="update assigned_milestones set status=3 where id='$id'";
    if($conn->query($sql))
    {
        echo "ok";
    }
    else
    {
        echo "not_ok";
    }
}
?>