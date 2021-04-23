<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';

//inserting
print_r($_POST);
if (isset($_POST['add']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['contact']) && isset(($_POST['password']))) 
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $sql = "insert into employee(name,email,contact,password) values ('$name','$email','$contact',MD5('$password'))";
    if ($conn->query($sql)) {
    
        $id=$conn->insert_id;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "insert into admin(email,e_id,password,status) values ('$email','$id',MD5('$password'),1)";
        if ($conn->query($sql)) {
        }
        else {
            echo $conn->error;
        }
    }
    
    else {
        echo $conn->error;
    }
}

// if (isset($_POST['add']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['contact']) && isset(($_POST['password']))) {
    
//     $email = $_POST['email'];
   
//     $password = $_POST['password'];
//     $sql = "insert into admin(email,password,status) values ('$email',MD5('$password'),1)";
//     if ($conn->query($sql)) {
//     }
    //     $id=$conn->insert_id;
    //     if(upload_imageUpdate($conn,"team","image",'id',$id,"files"))
    //     {
    //     $query = true;
    // } else {
    //     $query=false;
    // }}
//     else {
//         echo $conn->error;
//     }
// }




// print_r($selectedMember);


//fetching
$sql = "select * from employee";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $employee[] = $row;
    }
}

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
                            <li class="breadcrumb-item active" aria-current="page">Employees</li>
                        </ol>
                    </nav>
                </div>
                <div class="ml-auto">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary m-1" data-toggle="modal" data-target="#exampleModal5"><i class=" fadeIn animated bx bx-plus"></i></button>
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
                                        <th scope="col">Contact</th>


                                        <th scope="col">Email</th>
                                       
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($employee)) {
                                        $i = 1;
                                        foreach ($employee as $t) {
                                    ?>
                                            <tr id="tr<?= $i ?>">
                                                <th scope="row"><?= $i ?></th>
                                                <td id="name<?= $i ?>"><?= $t['name'] ?></td>
                                                <td id="contact<?= $i ?>"><?= $t['contact'] ?></td>

                                                <td id="email<?= $i ?>"><?= $t['email'] ?></td>
                                                
                                                <form method="post">
                                                    <td><button type="button" class="btn btn-success m-1 px-3" onclick="editSetValues(<?= $t['id'] ?>,<?= $i ?>)" data-toggle="modal" data-target="#exampleModal6">Edit</button>
                                                        <button type="button" class="btn btn-danger m-1 px-3" onclick="deleteEmp(<?= $t['id'] ?>,'tr<?= $i ?>')">Delete</button>
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
<form class="needs-validation" method="post">
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

<!--edit modal-->
<form method="post" id="editM" enctype="multipart/form-data">
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
                                    <input type="hidden" id="count" name="count">
                                    <input type="text" class="form-control" id="validationCustom03" name="eemail" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom04">Password</label>

                                    <input type="text" class="form-control" id="validationCustom04" name="epassword">
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
                    <button type="button" onclick="editValues()" data-dismiss="modal" class="btn btn-primary" name="edit">Save changes</button>

                </div>
            </div>
        </div>
    </div>
</form>
<?php
require_once 'js_links.php';
require_once 'footer.php';

?>
<!-- <script>
    $('#fancy-file-upload').FancyFileUpload({
        params: {
            action: 'fileuploader'
        },
        maxfilesize: 1000000
    });
</script> -->

<script>

    var counter=0;
console.log(counter);
    function editSetValues(id, count) {
        $("#count").val(count);
        $("#eid").val(id);
        $("#validationCustom01").val($("#name" + count).html());
        $("#validationCustom02").val($("#contact" + count).html());
        $("#validationCustom03").val($("#email" + count).html());
        $("#validationCustom04").val("");
        counter = count;
    }

    function editValues() {
        $.ajax({
            url: "edit_ajaxEmployee.php",
            type: "POST",
            data: $("#editM").serialize(),
            success: function(data) {

                if (data.trim() == "ok") {
                    {
                        $("#name"+ counter).html($("#validationCustom01").val());
                        $("#contact"+ counter).html($("#validationCustom02").val());
                        $("#email"+ counter).html($("#validationCustom03").val());

                        // $("#password"+ counter).html($("#validationCustom04").val());
                        
                    }
                } else {
                    console.log(data);
                }
            },
            error: function() {

            }

        })
    }

    function deleteEmp(id, trId) {
        $.ajax({
            url: "delete_ajaxEmployee.php",
            type: "POST",
            data: {
                deleteEmp: id,

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