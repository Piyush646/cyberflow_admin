<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';

//inserting
// print_r($_POST);
// if (isset($_POST['add']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['contact']) && isset(($_POST['password']))) {
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $contact = $_POST['contact'];
//     $password=$_POST['password'];
//     $sql = "insert into employee(name,email,contact,password) values ('$name','$email','$contact',MD5('$password'))";
//     if ($conn->query($sql)) {}
//     //     $id=$conn->insert_id;
//     //     if(upload_imageUpdate($conn,"team","image",'id',$id,"files"))
//     //     {
//     //     $query = true;
//     // } else {
//     //     $query=false;
//     // }}
//     else{
//         echo $conn->error;
//     }
// }


//deleting
if (isset($_POST['del'])) {
    $id = $_POST['del'];
    $sql = "delete from project_files where p_id=$id";
    if ($conn->query($sql)) {
    } else {
        echo $conn->error;
    }
}


if (isset($_POST['del'])) {
    $id = $_POST['del'];
    $sql = "delete  from assigned_employees where project_id='$id'";
    if ($conn->query($sql)) {
        $query = true;
    } else {
        echo $conn->error;
    }
}

//editing
// if (isset($_POST['edit']) || isset($_POST['ename']) || isset($_POST['eemail']) || isset($_POST['econtact']) || isset($_POST['epassword'])) {
//     $id=$_POST['eid'];
//     $name = $_POST['ename'];
//     $email = $_POST['eemail'];
//     $contact = $_POST['econtact'];
//     $password=$_POST['epassword'];
//     $sql = "update employee set name='$name',email='$email',contact='$contact' where id='$id'";
//     if ($conn->query($sql)) {
//         $sql = "insert into employee(password) values ('$name','$email','$contact',MD5('$password'))";
//     }

//         else {
//         echo $conn->error;
//     }
// }

// print_r($selectedMember);


//fetching
$sql = "select * from assign_project";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $project[] = $row;
    }
}

if (isset($project)) {
    foreach ($project as $p) {
        $p_id = $p['id'];
$sql2 = "select * from project_files where p_id='$p_id'";
$res2 = $conn->query($sql2);
if ($res2->num_rows > 0) {
    while ($row2 = $res2->fetch_assoc()) {
        $p_files[] = $row2;
    }

    $sql3 = "select * from assigned_employees where project_id='$p_id'";
    $res3 = $conn->query($sql3);
    if ($res3->num_rows > 0) {
        while ($row3 = $res3->fetch_assoc()) {
            $assigned_emp[] = $row3;
        }
    }
}

    }
}
// print_r($assigned_emp);




?>

<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pr-3">Employee Management</div>
                <div class="pl-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Assigned Projects</li>
                        </ol>
                    </nav>
                </div>
                <div class="ml-auto">
                    <div class="btn-group">
                        <a href="addEditProject.php" type="button" class="btn btn-primary m-1"><i class=" fadeIn animated bx bx-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div>
                        <hr />
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mb-0" id="table1">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>


                                        <th scope="col">Due Date</th>
                                        <th scope="col">Files</th>
                                        <th scope="col">Assigned To</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($project)) {
                                        $i = 1;
                                        foreach ($project as $t) {
                                            $timestamp = strtotime($t['due_date']);
                                    ?>
                                            <tr id="tr<?= $i ?>">
                                                <th scope="row"><?= $i ?></th>
                                                <td id="name<?= $i ?>"><?= $t['name'] ?></td>
                                                <td id="contact<?= $i ?>"><?= $t['description'] ?></td>

                                                <td id="email<?= $i ?>"><?= date("M-d-Y", $timestamp) ?></td>

                                                <td>
                                                    <?php
                                                    if (isset($p_files)) {
                                                        foreach ($p_files as $p) {

                                                            if ($p['p_id'] == $t['id']) {
                                                                $file_parts = pathinfo($p['img']);

                                                                switch ($file_parts['extension']) {
                                                                    case "jpg":
                                                    ?>
                                                                        <a href=" ./uploads/<?= $p['img'] ?>" target="_blank"><img src="./uploads/image.png ?>" width="33px" height="33px" /></a>
                                                                    <?php
                                                                        break;
                                                                    case "jpeg":
                                                                    ?>
                                                                        <a href=" ./uploads/<?= $p['img'] ?>" target="_blank"><img src="./uploads/image.png ?>" width="33px" height="33px" /></a>
                                                                    <?php
                                                                        break;
                                                                    case "png":
                                                                    ?>
                                                                        <a href=" ./uploads/<?= $p['img'] ?>" target="_blank"><img src="./uploads/image.png ?>" width="33px" height="33px" /></a>
                                                                    <?php
                                                                        break;
                                                                    case "bmp":
                                                                    ?>
                                                                        <a href=" ./uploads/<?= $p['img'] ?>" target="_blank"><img src="./uploads/image.png ?>" width="33px" height="33px" /></a>
                                                                    <?php
                                                                        break;
                                                                    case "JPG":
                                                                    ?>
                                                                        <a href=" ./uploads/<?= $p['img'] ?>" target="_blank"><img src="./uploads/image.png ?>" width="33px" height="33px" /></a>
                                                                    <?php
                                                                        break;
                                                                    case "pdf":
                                                                    ?>
                                                                        <a href=" ./uploads/<?= $p['img'] ?>" target="_blank"><img src="./uploads/379099.png ?>" width="33px" height="33px" /></a>
                                                    <?php
                                                                        break;
                                                                }
                                                            }
                                                        }
                                                    }


                                                    ?>
                                                </td>
                                                
                                                <td>
                                                    <?php 
                                                    if(isset($assigned_emp))
                                                    {
                                                        foreach($assigned_emp as $a)
                                                        {
                                                            if($t['id']==$a['project_id'])
                                                            {
                                                                $eid=$a['e_id'];
                                                                $sql="select * from employee where id='$eid'";
                                                                $res= $conn->query($sql);
                                                                if($res->num_rows > 0)
                                                                {
                                                                    $ename=$res->fetch_assoc();
                                                                }
                                                                ?>
                                                                
                                                                <p style="display:inline"><?=$ename['name']?> ,<br></p>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <form method="post">
                                                    <td><a href="addEditProject.php?token=<?= $t['id'] ?>" class="btn btn-success m-1 px-3">Edit</a>
                                                        <button type="button" class="btn btn-danger m-1 px-3" onclick="deleteProject('<?=$t['id']?>','tr<?=$i?>')">Delete</button>
                                                        <a href="milestone.php?token=<?= $t['id'] ?>" class="btn btn-info m-1 px-3">Milestones</a>
                                                    </td>
                                                </form>
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page-content-wrapper-->
<!-- Modal -->
<!-- <form class="needs-validation" method="post" >
    <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01">Name</label>
                                    <input type="text" class="form-control" id="validationCustom0s" name="name" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Contact</label>
                                    <input type="text" class="form-control" id="validationCustom" name="contact" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Email</label>
                                    
                                    <input type="text" class="form-control" id="validationCusto" name="email" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Password</label>
                                    
                                    <input type="text" class="form-control" id="validationCusto" name="password" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                               
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add">Add</button>

                </div>
            </div>
        </div>
    </div>
</form>

   edit modal-->
<form method="post" enctype="multipart/form-data">
    <div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01">Name</label>
                                    <input type="text" class="form-control" id="validationCustom01" name="ename" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Contact</label>
                                    <input type="text" class="form-control" id="validationCustom02" name="econtact" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Email</label>
                                    <input type="hidden" id="eid" name="eid">
                                    <input type="text" class="form-control" id="validationCustom03" name="eemail" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Password</label>
                                    <input type="hidden" id="eid" name="eid">
                                    <input type="text" class="form-control" id="validationCustom04" name="epassword" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end breadcrumb -->
                    <!-- <div class="card radius-15">
                        <div class="card-body">
                            <div class="card-title">
                                <h4 class="mb-0">Change Image</h4>
                            </div>
                            <hr />
                            <input id="fancy-file-upload2" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" multiple><br><br>
                        </div>
                        
                    </div> -->



                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="edit">Save changes</button>

                </div>
            </div>
        </div>
    </div>
</form>
<?php
require_once 'js_links.php';
require_once 'footer.php';

?>
 <script>
    

function deleteProject(id, trId) {
        $.ajax({
            url: "delete_ajaxProject.php",
            type: "POST",
            data: {
                deleteId: id,

            },
            success: function(data) {

                if (data.trim() == "ok") {
                    $("#" + trId).remove();



                } else {
                    console.log(data);
                }
            },
            error: function() {

            }

        })
    }
</script>