<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';

//inserting
print_r($_POST);
if (isset($_POST['add']) && isset($_POST['title']) && isset($_POST['due_date']) && isset($_POST['description'])) {
    $title = $_POST['title'];
    $due_date = $_POST['due_date'];
    $description = $_POST['description'];
    $id = $_GET['token'];
    $sql = "insert into milestones(title,due_date,description,p_id) values ('$title','$due_date','$description','$id'";
    if ($conn->query($sql)) {
    }
    //     $id=$conn->insert_id;
    //     if(upload_imageUpdate($conn,"team","image",'id',$id,"files"))
    //     {
    //     $query = true;
    // } else {
    //     $query=false;
    // }}
    else {
        echo $conn->error;
    }
}

//fetching
$id = $_GET['token'];
$sql = "select * from assigned_employees where project_id='$id'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $employee[] = $row;
    }
}
print_r($employee);

//fetching
if(isset($employee))
{
    foreach($employee as $e)
    {
        $employeeId=$e['e_id'];
        $sql="select * from employee where id='$employeeId'";
        $res= $conn->query($sql);
        if($res->num_rows>0)
        {
            $employeeName[]=$res->fetch_assoc();
        }
    }
}
print_r($employeeName);

if (isset($_GET['token'])) {
    $id = $_GET['token'];
    $sql = "select * from milestones where p_id='$id'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $milestones[] = $row;
        }
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
                            <li class="breadcrumb-item active" aria-current="page">Milestones</li>
                        </ol>
                    </nav>
                </div>
                <div class="ml-auto">
                    <div class="btn-group">
                        <button data-toggle="modal" data-target="#exampleModal5" type="button" class="btn btn-primary m-1"><i class=" fadeIn animated bx bx-plus"></i></button>
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
                                        <th scope="col">Title</th>
                                        <th scope="col">Due Date</th>


                                        <th scope="col">Description</th>
                                        <th scope="col">Assigned To</th>
                                        <th scope="col">Excuses</th>
                                        <th scope="col">Comments</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($milestones)) {
                                        $i = 1;
                                        foreach ($milestones as $m) {
                                    ?>
                                            <tr id="tr<?= $i ?>">
                                                <th scope="row"><?= $i ?></th>
                                                <td id="name<?= $i ?>"><?= $m['title'] ?></td>
                                                <td id="contact<?= $i ?>"><?= $m['due_date'] ?></td>

                                                <td id="email<?= $i ?>"><?= $m['description'] ?></td>
                                                <td id="email<?= $i ?>"><?= $m[''] ?></td>
                                                <td id="password<?= $i ?>"><?= $m['excuses'] ?></td>
                                                <td id="password<?= $i ?>"><?= $m['comments'] ?></td>
                                                <form method="post">
                                                    <td><a type="button" data-toggle="modal" data-target="#exampleModal6" class="btn btn-success m-1 px-2" onclick="editSetValues(<?= $m['id'] ?>,<?= $i ?>)">Edit</a>
                                                        <button type="button" class="btn btn-danger m-1 px-2" onclick="deleteEmp(<?= $m['id'] ?>,'tr<?= $i ?>')">Delete</button>
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
                    <h5 class="modal-title">Add Milestone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01">Title</label>
                                    <input type="text" class="form-control" id="validationCustom0s" name="title" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Due Date</label>
                                    <input type="date" class="form-control" id="validationCustom" name="contact" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03">Description</label>

                                    <textarea type="text" class="form-control" id="validationCusto" name="description" required></textarea>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="card-title">

                                <h4 style="display:inline; margin-right:4px;" class="mb-0">Add Files</h4>



                                <div style="display:inline;" class="form-group">
                                    <button type="button" class="btn btn-primary m-1" onclick="addFilesField()"><i class=" fadeIn animated bx bx-plus"></i></button>
                                </div>
                            </div>
                            <hr />

                            <div class="row">
                                <div class="col-md-4" id="filesDiv2">


                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">
                                            Assign To:
                                        </label>
                                        <!-- <input type="link" class="form-control" id="validationCustom01" name="fb" value="<?= $config['facebook'] ?>" required> -->
                                        <select id="prim_skills" name="employees[]" multiple>
                                            <?php
                                            if ( isset($employee)) {
                                                foreach ( $employeeName as $e) {
                                            ?>

                                                    <option value="<?= $e['id'] ?>"><?= $e['name'] ?></option>

                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>

                                        <div class="valid-feedback">Looks good!</div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" name="add">Add</button>

                    </div>
                </div>
            </div>
        </div>
</form>

<!--edit modal-->
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
                    <button type="button" class="btn btn-primary" name="edit">Save changes</button>

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
    $(document).ready(function() {
        $('#prim_skills').multiselect({
            nonSelectedText: 'Select Employees',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '400px'
        });
    })
    var coun = 1;

    function addFilesField() {

        var inhtml = `<div class="row" style="margin-top:20px" >    
                            <div class="col-md-10">
                                <input   type="file" id='projectfile${coun}' name="projectFile[]" class="form-control"/>
                            </div> 
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger" onclick="removeField('projectfile${coun}')"><i class="fadeIn animated bx bx-trash"></i></button>
                            </div> 
                        </div>`;
        $("#filesDiv2").append(inhtml);
        coun++;

    }

    function removeField(id) {
        $("#" + id).parent().parent().remove();


    }

    function deleteFile(id, divId, path) {
        $.ajax({
            url: "files_ajax.php",
            type: "POST",
            data: {
                deleteFile: id,
                delpath: path
            },
            success: function(data) {

                if (data.trim() == "ok") {
                    $("#" + divId).remove();

                } else {
                    console.log(data);
                }
            },
            error: function() {

            }

        })
    }

    function editSetValues(id, count) {
        $("#eid").val(id);
        $("#validationCustom01").val($("#name" + count).html());
        $("#validationCustom02").val($("#contact" + count).html());
        $("#validationCustom03").val($("#email" + count).html());
        $.ajax({
            url: "edit_ajaxEmployee.php",
            type: "POST",
            data: {
                editEmp: id,

            },
            success: function(data) {

                if (data.trim() == "ok") {
                    // $("#"+trId).remove();



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