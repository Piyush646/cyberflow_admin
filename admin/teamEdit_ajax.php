<?php
require_once '../lib/core.php';
 
//editing
if (isset($_POST['ename']) || isset($_POST['esort_order']) || isset($_POST['eposition'])) {
    $result = [];
    $id=$_POST['eid'];
    $name = $_POST['ename'];

    $sort_order = $_POST['esort_order'];
    $position = $_POST['eposition'];
    $sql = "update team set name='$name',position='$position',sort_order='$sort_order' where id='$id'";
    if ($conn->query($sql)) {
        $id=$_POST['eid'];
        $image = upload_imageUpdate($conn,"team","image",'id',$id,"files");
        if($image !='err')
        {
            $result['msg']= "ok";
            $result['image']='./uploads/'.$image;
        
    } else {
       
        $result['msg']= "not ok";
    }}
        else { 
        $result['msg']= "not  very ok";
    }

    echo json_encode($result);
}
?>