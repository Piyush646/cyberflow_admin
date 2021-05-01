<?php
session_start();
require_once 'config.php';

//login admin
function login($email,$password,$conn)
{
    echo $sql="select id from admin where email='$email' and password='$password' and status= 0";
    $res=$conn->query($sql);
    if($res->num_rows>0)
    {
        echo "admin done";
        $row=$res->fetch_assoc();
        $id=$row['id'];
        header("location: dashboard.php");
        $_SESSION['admin_signed_in']=$email;
        $_SESSION['id']=$id;
    }
    else
    {
        echo "admin not done";
        return false;
    }
}

//login employee
function login_employee($email,$password,$conn)
{
    $sql="select id from admin where email='$email' and password='$password' and status= 1";
    $res=$conn->query($sql);
    if($res->num_rows>0)
    {
        $row=$res->fetch_assoc();
        $id=$row['id'];
        $eid=$row['e_id'];
        header("location: ../employee/projects.php");
        $_SESSION['employee_signed_in']=$email;
        $_SESSION['id']=$id;
        $_SESSION['e_id']=$eid;
    }
    else
    {
        return false;
    }
}

//admin_auth
function admin_auth()
{
    if(isset($_SESSION['admin_signed_in']))
    {
        return true;
    }
    else
    {
        return false;
    }
}

//employee_auth
function employee_auth()
{
    if(isset($_SESSION['employee_signed_in']))
    {
        return true;
    }
    else
    {
        return false;
    }
}

//admin_in password change
function password_change($newPass,$curPass,$conn)
{
    $email=$_SESSION['admin_signed_in'];
    $sql="select password from users where email='$email' and password='$curPass'";
    $res=$conn->query($sql);
    if($res->num_rows>0)
    {
        $sql="update users set password='$newPass' where email='$email'";
        if($conn->query($sql))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}

//single image upload

function upload_imageUpdate($conn,$table,$column,$id_columnka_naam,$id,$image)
{
    $uploadedFile = 'err';
    // print_r($_FILES);
    if(!empty($_FILES[$image]["type"]))
    {
            $fileName = time().'_'.str_replace(' ', '',$_FILES[$image]['name']);
        $valid_extensions = array("jpeg", "jpg", "png","bmp","JPG");
        $temporary = explode(".", $_FILES[$image]["name"]);
         $file_extension = end($temporary);
        
        if((($_FILES[$image]["type"] == "image/png") || ($_FILES[$image]["type"] == "image/bmp") || ($_FILES[$image]["type"] == "image/jpg") || ($_FILES[$image]["type"] == "image/JPG") || ($_FILES[$image]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions))
        {
            $sourcePath = $_FILES[$image]['tmp_name'];
            $targetPath = "uploads/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath))
            {
                $uploadedFile = $fileName;
                if(isset($table))
                {
                    $sql="update $table set $column='$targetPath' where $id_columnka_naam=$id";
                    if($conn->query($sql)===true)
                    {
                        return $uploadedFile;
                    }
                    else
                    {
                        echo $fileName;
                        unlink("uploads/".$fileName);
                        return 'err';
                    }
                }
                return $uploadedFile;
            }
            else
            {
                $uploadedFile="err";
                 return $uploadedFile;
            }
        }
        else
        { 
            $uploadedFile="err";
            return $uploadedFile;
        }
       
    }
    else
    {
            $uploadedFile="err";
            return $uploadedFile;
    }
}


//upload
function upload_imagesInsert($conn,$table,$id_col,$column,$id,$images)
{
    // print_r($_FILES);
	if(isset($_FILES[$images]))
    {
        $extension=array("jpeg","jpg","png","gif","pdf","PDF","JPG");
        foreach($_FILES[$images]["tmp_name"] as $key=>$tmp_name) 
        {
            $file_name=$_FILES[$images]["name"][$key];
            $file_tmp=$_FILES[$images]["tmp_name"][$key];
            echo $ext=pathinfo($file_name,PATHINFO_EXTENSION); 
            if(in_array(strtolower($ext),$extension)) 
            {
                $filename=basename($file_name,$ext);
                $newFileName=$filename.time().".".$ext;
                if(move_uploaded_file($file_tmp=$_FILES[$images]["tmp_name"][$key],"uploads/".$newFileName))
                {
                   echo  $sql="insert into $table($id_col, $column) values($id,'$newFileName')";
                      $conn->query($sql);
                    if($conn->query($sql)===true)
                    {
                        $status=true;
                    }
                    else
                    {
                        $status=false;
                        break;
                    }
                }
                else
        
                {
                    $status=false;
                    break;
                }
            }
            else 
            {
                array_push($error,"$file_name, ");
            }
        }
        return $status;
    }
}


//velidation for input type
function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>