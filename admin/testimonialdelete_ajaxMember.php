<?php
include_once "../lib/core.php";
if(isset($_POST['deleteTestimonial']))
{
    $id=$_POST['deleteTestimonial'];
     $sql = "delete  from testimonials where id=$id";
    if ($conn->query($sql)) {
        echo "ok";
    } else {
        echo "not ok";
}
}
?>