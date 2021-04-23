<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';


//fetching
$sql = "select * from employee";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $employee[] = $row;
    }
}
//inserting
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $due_date = $_POST['due_date'];
    $description = $_POST['description'];
    $sql = "insert into assign_project(name,due_date,description) values('$name','$due_date','$description')";
    if ($conn->query($sql)) {
        $id = $conn->insert_id;
        if (upload_imagesInsert($conn, "project_files", "p_id", 'img', $id, "projectFile")) {
            $query = true;
        } else {
            $query = false;
        }
        $employees = $_POST['employees'];
        $sql = "insert into assigned_employees(e_id,project_id) values";
        foreach ($employees as $emp) {
            $sql .= "('$emp','$id'),";
        }
        
         $sql = rtrim($sql, ",");
        $conn->query($sql);
    } else {
        echo $conn->error;
    }
}
//editing
if (isset($_POST['edit'])) {
    $id = $_GET['token'];
    $name = $_POST['name'];
    $due_date = $_POST['due_date'];
    $description = $_POST['description'];
    $sql = "update assign_project set name='$name',due_date='$due_date',description='$description' where id='$id'";
    if ($conn->query($sql)) {
        $id = $_GET['token'];
        if (upload_imagesInsert($conn, "project_files", 'p_id', 'img', $id, "projectFile")) {
            $query = true;
        $employees = $_POST['employees'];
        $sql = "update assigned_employees";
        foreach ($employees as $emp) {
            $sql .= "(set e_id='$emp',project_id='$id')";
        }
        
         $sql = rtrim($sql, ",");
        } else {
            $query = false;
        }
    } else {
        echo $conn->error;
    }
}

//fetching
if (isset($_GET['token'])) {
    $id = $_GET['token'];
    $sql = "select * from assign_project where id='$id'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $project = $res->fetch_assoc();
    }
}

//fetching images
if (isset($_GET['token'])) {
$id = $_GET['token'];
$sql = "select * from project_files where p_id='$id'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $project_img[] = $row;
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

                <?php
                if (isset($project)) {
                ?>
                    <div class="breadcrumb-title pr-3">Edit Project</div>
                <?php
                } else {
                ?>
                    <div class="breadcrumb-title pr-3">Add Project</div>
                <?php
                }
                ?>

                <div class="pl-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Details</li>
                        </ol>
                    </nav>
                </div>
                <div class="ml-auto">
                    <!-- <div class="btn-group">
                        <button type="button" class="btn btn-primary m-1" onclick="editWeb()" ><i class="fadeIn animated bx bx-edit-alt"></i></button>
                    </div> -->
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form  method="post" enctype="multipart/form-data">
                        <div class="card radius-15">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">
                                            Name
                                        </label>
                                        <input type="text" class="form-control" id="validationCustom01" name="name" value="<?= $project['name'] ?>" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">
                                            Due Date
                                        </label>
                                        <input type="date" class="form-control" id="validationCustom02" name="due_date" value="<?= $project['due_date'] ?>" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom03">
                                            Description
                                        </label>
                                        <textarea class="form-control" id="validationCustom03" name="description" value="" required><?= $project['description'] ?></textarea>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card radius-15">
                            <div class="card-body">
                                <div class="card-title">
                                    <?php
                                    if (isset($project)) {
                                    ?>
                                        <h4 style="display:inline; margin-right:4px;" class="mb-0">Edit Images</h4>
                                    <?php
                                    } else {
                                    ?>
                                        <h4 style="display:inline; margin-right:4px;" class="mb-0">Add Images</h4>
                                    <?php
                                    }
                                    ?>


                                    <div style="display:inline;" class="form-group">
                                        <button type="button" class="btn btn-primary m-1" onclick="addFilesField()"><i class=" fadeIn animated bx bx-plus"></i></button>
                                    </div>
                                </div>
                                <hr />
                                <div class="row" style="margin-bottom:20px">

                                    <?php
                                    if (isset($project_img)) {
                                        $counter = 0;
                                        foreach ($project_img as $file) {

                                    ?>
                                            <div class="col-md-2" id="file<?= $counter ?>">
                                                <div class="col-md-8">
                                                    <?php
                                                $file_parts = pathinfo($file['img']);
                                                            
                                                            switch ($file_parts['extension']) {
                                                                case "jpg":
                                                    ?>
                                                                    <a href=" ./uploads/<?= $file['img'] ?>" target="_blank"><img src="./uploads/<?= $file['img'] ?>" width="120px" height="120px" /></a>
                                                                <?php
                                                                    break;
                                                                case "jpeg":
                                                                ?>
                                                                    <a href=" ./uploads/<?= $file['img'] ?>" target="_blank"><img src="./uploads/<?= $file['img'] ?>" width="120px" height="120px" /></a>
                                                                <?php
                                                                    break;
                                                                case "png":
                                                                ?>
                                                                    <a href=" ./uploads/<?= $file['img'] ?>" target="_blank"><img src="./uploads/<?= $file['img'] ?>" width="120px" height="120px" /></a>
                                                                <?php
                                                                    break;
                                                                case "bmp":
                                                                ?>
                                                                    <a href=" ./uploads/<?= $file['img'] ?>" target="_blank"><img src="./uploads/<?= $file['img'] ?> " width="120px" height="120px" /></a>
                                                                <?php
                                                                    break;
                                                                case "JPG":
                                                                ?>
                                                                    <a href=" ./uploads/<?= $file['img'] ?>" target="_blank"><img src="./uploads/<?= $file['img'] ?> " width="120px" height="120px" /></a>
                                                                <?php
                                                                    break;
                                                                case "pdf":
                                                                ?>
                                                                    <a href=" ./uploads/<?= $file['img'] ?>" target="_blank"><img src="./uploads/379099.png ?>" width="120px" height="120px" /></a>
                                                    <?php
                                                                    break;
                                                            }
                                                            ?>
                                                    <!-- <a href="./uploads/<?= $file['img'] ?>" target="_blank"><img src="./uploads/<?= $file['img'] ?>" width="120px" height="120px" /></a> -->
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-danger" onclick="deleteFile(<?= $file['id'] ?>,'file<?= $counter ?>','./uploads/<?= $file['img'] ?>')"><i class="fadeIn animated bx bx-trash"></i></button>
                                                </div>
                                            </div>
                                    <?php
                                            $counter++;
                                        }
                                    }

                                    ?>


                                </div>

                                <div class="row">
                                    <div class="col-md-4" id="filesDiv2">


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card radius-15">
                            <div class="card-body">
                                <!-- <div class="card-title">
                                    <h4 class="mb-0">Social Media Links</h4><br>
                                </div> -->
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">
                                            Assign To:
                                        </label>
                                        <!-- <input type="link" class="form-control" id="validationCustom01" name="fb" value="<?= $config['facebook'] ?>" required> -->
                                        <select id="prim_skills" name="employees[]" multiple>
                                            <?php
                                            if (isset($employee)) {
                                                foreach ($employee as $e) {
                                            ?>

                                                    <option value="<?=$e['id']?>"><?= $e['name'] ?></option>
                                                    
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
                        <div>
                            <?php
                            if (isset($project)) {
                            ?>
                                <button type="submit" name="edit" class="btn btn-primary m-1 btn-lg px-5">Save Changes</button>
                            <?php
                            } else {
                            ?>
                                <button type="submit" name="add" class="btn btn-primary m-1 btn-lg px-5" value="submit">Add Project</button>
                            <?php
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once 'js_links.php';
    require_once 'footer.php';

    ?>
    <script>
        $(document).ready(function() {
            $('#prim_skills').multiselect({
                nonSelectedText: 'Select Employees',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth: '400px'
            });
        })

        var counter = 1;

        function addFilesField() {

            var inhtml = `<div class="row" style="margin-top:20px" >    
                            <div class="col-md-10">
                                <input   type="file" id='projectfile${counter}' name="projectFile[]" class="form-control"/>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger" onclick="removeField('projectfile${counter}')"><i class="fadeIn animated bx bx-trash"></i></button>
                            </div> 
                        </div>`;
            $("#filesDiv2").append(inhtml);
            counter++;

        }

        function removeField(id) {
            $("#" + id).parent().parent().remove();


        }

        function deleteFile(id, divId, path) {
            $.ajax({
                url: "files_ajaxEmployee.php",
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
    </script>