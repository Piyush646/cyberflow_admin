<?php
require_once '../lib/core.php';

//deleting from table
if (isset($_POST['deleteEmp'])) {
    $id = $_POST['deleteEmp'];
    $sql = "delete  from employee where id=$id";
    if ($conn->query($sql)) {
        $sql = "delete  from admin where e_id=$id";
        if ($conn->query($sql)) {
            $sql = "delete  from assigned_employees where e_id=$id";
            if ($conn->query($sql)) {
                $sql = "delete  from assigned_milestones where e_id=$id";
                if ($conn->query($sql)) {
                    echo "ok";
                } else {
                    echo "not ok";
                }
            } else {
                echo $conn->error;
            }
        } else {
            echo $conn->error;
        }
    } else {
        echo $conn->error;
    }
}
