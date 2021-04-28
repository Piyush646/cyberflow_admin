<?php
require_once '../lib/core.php';

//editing
if (isset($_POST['ename']) || isset($_POST['esort_order']) || isset($_POST['eposition'])) {
    $id=$_POST['eid'];
    $name = $_POST['ename'];
    $sort_order = $_POST['esort_order'];
    $position = $_POST['eposition'];
    $sql = "update team set name='$name',position='$position',sort_order='$sort_order' where id='$id'";
    if ($conn->query($sql)) {
        $id=$_POST['eid'];
        if(upload_imageUpdate($conn,"team","image",'id',$id,"files"))
        {
        echo "ok";
        // $id=$_POST['eid'];
        // $sql="select * from team where id='$id'";
        // $res = $conn->query($sql);
        // if($res->num_rows > 0)
        // {
        //     $selectedMember=$res->fetch_assoc();
        // }
        // else{
        //     echo $conn->error;
        // }
    } else {
        echo "not ok";
    }}
        else {
        echo "not very ok";
    }
}
?>