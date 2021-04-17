<?php 
require_once '../lib/core.php';
if(isset($_POST["prim_skills"]))
{
 $prim_skills = '';
 foreach($_POST["prim_skills"] as $row)
 {
  $prim_skills .= $row . ', ';
 }
 $prim_skills = substr($prim_skills, 0, -2);
 $query = "INSERT INTO assigned_employees(e_name) VALUES('$prim_skills')";
 if($conn->query($sql))
 {
  echo 'Data Inserted';
 }
}
?>