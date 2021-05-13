<?php
include_once "../lib/core.php";

print_r($_FILES);
if (isset($_POST['title']) || isset($_POST['due_date']) || isset($_POST['description'])) {
    $result = [];
    $id = $_POST['eid'];
    $id2=$_POST['projectId'];
    $title = $_POST['title'];
    $due_date = $_POST['due_date'];
    $description = $_POST['description'];
    $sql = "update milestones set title='$title',due_date='$due_date',description='$description' where id='$id'";
    if ($conn->query($sql)) {
        
        $projectArr = ["p_id" => $id2];
        $image=upload_imageNcolumn($conn, "milestone_files", "m_id", 'img', $id, "projectFile", $projectArr);
        if($image!='err')
        {
        $result['msg']= "ok";
        $result['image']='./uploads/'.$image;
        } 
        
        else {
            $result['msg']= "image_not_ok";     
        }

        // $sql = "delete from assigned_milestones where m_id='$id'";
        // if($conn->query($sql))
        // {
        $sql = "delete from assigned_milestones where m_id='$id'";
        if ($conn->query($sql)) {
            $employees = $_POST['employees2'];
             $sql = "insert into assigned_milestones(e_id,m_id,p_id) values";
            foreach ($employees as $emp) {
                $sql .= "('$emp','$id','$id2'),";
            }
            $sql = rtrim($sql, ",");
            $conn->query($sql);
        // }
    }
}
else
{
    $result['msg']= "not_very_ok";
}
echo json_encode($result);
}
    ?>