<?php
include_once "../lib/core.php";
if(isset($_POST['deletePortfolio']))
{
        $id = $_POST['deletePortfolio'];
        $sql = "delete from portfolio_img where p_id=$id";
        if ($conn->query($sql)) {
            $sql = "delete from portfolio where id=$id";
        if ($conn->query($sql)) {
            echo "ok";
        } else {
            echo "not ok";
        }
        } else {
            echo "not very ok";
        }
    }
