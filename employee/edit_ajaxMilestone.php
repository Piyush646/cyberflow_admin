<?php
require_once '../lib/core.php';

//editing
if (isset($_POST['edit']) || isset($_POST['comments']) || isset($_POST['excuses'])) {
    $count= $_POST['count'];
    $id = $_POST['eid'];
    $comments = $_POST['comments'];
    $excuses = $_POST['excuses'];
    $sql = "update assigned_milestones set excuse='$excuses',comments='$comments' where m_id='$id' and e_id=22";
    if ($conn->query($sql)) {
        echo "ok";
    } else {
        echo "not ok";
    }
    
}
?>