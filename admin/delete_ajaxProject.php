<?php
require_once '../lib/core.php';

//deleting from table
if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
    $sql = "delete  from assign_project where id=$id";
    if ($conn->query($sql)) {
        $sql = "delete  from project_files where p_id=$id";
        if ($conn->query($sql)) {
            $sql = "delete  from assigned_employees where project_id=$id";
            if ($conn->query($sql)) {
                $sql = "delete from milestones where p_id=$id";
                if ($conn->query($sql)) {
                    $sql = "delete  from assigned_milestones where p_id=$id";
                    if($conn->query($sql))
                    // {
                    //          $sql="delete milestone_files from milestone_files inner join milestones on milestones.id =  milestone_files.m_id
                    //         where milestones.p_id = '$id'";
                    $sql="delete from milestone_files where p_id=$id";
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
        } else {
            echo $conn->error;
        }
    } 
