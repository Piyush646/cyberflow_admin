<?php
require_once '../lib/core.php';

//deleting from table
if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
    $sql = "delete  from milestones where id=$id";
    if ($conn->query($sql)) {
        $sql = "delete  from milestone_files where m_id=$id";
        if ($conn->query($sql)) {
            $sql = "delete  from assigned_milestones where m_id=$id";
            if($conn->query($sql))
            {
                    echo "ok";
                }
             else {
                    echo "not ok";
                }
            }
            else
            {
                echo $conn->error;
            }
        }
             else {
                echo $conn->error;
            }
        }
