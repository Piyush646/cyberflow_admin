<?php
include_once "../lib/core.php";
if(isset($_POST['milestoneId']))
{
    $id=$_POST['milestoneId'];
    $sql="update milestones set status=2 where id='$id'";
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