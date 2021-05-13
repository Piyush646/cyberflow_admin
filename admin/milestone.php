<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';

//inserting

if (isset($_POST['add']) && isset($_POST['title']) && isset($_POST['due_date']) && isset($_POST['description']) && isset($_GET['token'])) {
    $title = $_POST['title'];
    $due_date = $_POST['due_date'];
    $description = $_POST['description'];
    $id = $_GET['token'];
    echo $sql = "insert into milestones(title,due_date,description,p_id) values ('$title','$due_date','$description','$id')";
    if ($conn->query($sql)) {
        $id = $conn->insert_id;
        $id2 = $_GET['token'];
        $projectArr = ["p_id" => $id2];
        if (upload_imageNcolumn($conn, "milestone_files", "m_id", 'img', $id, "projectFile", $projectArr)) {
            $query = true;
        } else {
            $query = false;
        }
        $employees = $_POST['employees'];
        $sql = "insert into assigned_milestones(e_id,m_id,p_id) values";
        foreach ($employees as $emp) {
            $sql .= "('$emp','$id','$id2'),";
        }

        $sql = rtrim($sql, ",");
        $conn->query($sql);
    } else {
        echo $conn->error;
    }
}

//fetching
$employee2 = [];
$id = $_GET['token'];
$sql = "select * from assigned_employees where project_id='$id'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        array_push($employee2, $row['e_id']);
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



//fetching
if (isset($employee)) {
    foreach ($employee as $e) {
        $employeeId = $e['e_id'];
        $sql = "select * from employee where id='$employeeId'";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $employeeName[] = $res->fetch_assoc();
        }
    }
}



if (isset($_GET['token'])) {
    $id = $_GET['token'];
    $sql = "select m.*,mf.id as m_file_id,mf.img,am.e_id from milestones m left join milestone_files mf on m.id=mf.m_id,assigned_milestones am where  am.m_id=m.id and m.p_id='$id'";
    if ($res = $conn->query($sql)) {


        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $milestones[$row['id']]['title'] = $row['title'];
                $milestones[$row['id']]['status'] = $row['status'];
                $milestones[$row['id']]['id'] = $row['id'];
                $milestones[$row['id']]['description'] = $row['description'];
                $milestones[$row['id']]['due_date'] = $row['due_date'];
                $milestones[$row['id']]['p_id'] = $row['p_id'];
                $milestones[$row['id']]['img'][$row['m_file_id']] = $row['img'];
                $milestones[$row['id']]['emp'][$row['e_id']] = $row['e_id'];
            }
        } else {
            echo "pancm";
        }
    } else {
        echo $conn->error;
    }
}
print_r($milestones);

if (isset($milestones)) {
    foreach ($milestones as $m) {
        $m_id = $m['id'];
        $sql2 = "select * from milestone_files where m_id='$m_id'";
        $res2 = $conn->query($sql2);
        if ($res2->num_rows > 0) {
            while ($row2 = $res2->fetch_assoc()) {
                $m_files[] = $row2;
            }
        }
        $sql3 = "select * from assigned_milestones where m_id='$m_id'";
        $res3 = $conn->query($sql3);
        if ($res3->num_rows > 0) {
            while ($row3 = $res3->fetch_assoc()) {
                $assigned_milestones[] = $row3;
            }
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
                <div class="card-body" id="card-body">
                    <div>
                        <hr />
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mb-0" id="table1">
                                <thead class="thead-dark">
                                    <tr>
                                        <!-- <th scope="col">#</th> -->
                                        <th scope="col">Title</th>
                                        <th scope="col">Files</th>
                                        <th scope="col">Due Date</th>


                                        <th scope="col">Description</th>
                                        <th scope="col">Assigned To</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Excuses</th>
                                        <th scope="col">Comments</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($milestones)) {
                                        $i = 1;
                                        foreach ($milestones as $m) {
                                            $timestamp = strtotime($m['due_date']);
                                    ?>
                                            <tr id="tr<?= $i ?>">
                                                <!-- <th scope="row"><?= $i ?></th> -->
                                                <td id="title<?= $i ?>"><?= $m['title'] ?></td>
                                                <td>
                                                    <?php
                                                    if (isset($m_files)) {
                                                        foreach ($m_files as $p) {

                                                            if ($p['m_id'] == $m['id']) {
                                                                $file_parts = pathinfo($p['img']);

                                                                switch ($file_parts['extension']) {
                                                                    case "pdf":
                                                    ?>
                                                                        <a href=" ./uploads/<?= $p['img'] ?>" target="_blank"><img src="./uploads/379099.png ?>" width="33px" height="33px" /></a>
                                                                        <input class="filess<?= $i ?>" type="hidden" value="<?= $p['img'] ?>" data-file-id="<?= $p['id'] ?>"></input>
                                                                    <?php
                                                                        break;
                                                                    default:
                                                                    ?>
                                                                        <a href=" ./uploads/<?= $p['img'] ?>" target="_blank"><img src="./uploads/image.png ?>" width="33px" height="33px" /></a>
                                                                        <input class="filess<?= $i ?>" type="hidden" value="<?= $p['img'] ?>" data-file-id="<?= $p['id'] ?>"></input>
                                                    <?php

                                                                }
                                                            }
                                                        }
                                                    }


                                                    ?>
                                                </td>

                                                <td id="due_date<?= $i ?>"><?= date("M-d-Y", $timestamp) ?></td>
                                                <input id="due_date2<?= $i ?>" type="hidden" value="<?= $m['due_date'] ?>"></input>
                                                <td id="description<?= $i ?>"><?= $m['description'] ?></td>
                                                <td>
                                                    <?php
                                                    if (isset($assigned_milestones)) {
                                                        foreach ($assigned_milestones as $a) {
                                                            if ($m['id'] == $a['m_id']) {
                                                                $eid = $a['e_id'];
                                                                $sql = "select * from employee where id='$eid'";
                                                                $res = $conn->query($sql);
                                                                if ($res->num_rows > 0) {
                                                                    $ename = $res->fetch_assoc();
                                                                }
                                                    ?>

                                                                <p style="display:inline"><?= $ename['name'] ?>,<br></p>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <form method="post">
                                                        <button type="button" data-toggle="modal" data-target="#exampleModal6" class="btn btn-success m-1 px-2" onclick="editSetValues(<?= $m['id'] ?>,<?= $i ?>)">Edit</button>
                                                        <button type="button" class="btn btn-danger m-1 px-2" onclick="deleteMilestone(<?= $m['id'] ?>,'tr<?= $i ?>')">Delete</button>
                                                        <?php
                                                            $pipeline='Pipeline';
                                                            $active='Active';
                                                            $hold='Hold';
                                                            $delayed='Delayed';
                                                            $complete='Complete';
                                                            $revision='Revision';
                                                            $mid=$m['id'];

                                                            $onclickPipe="pipeline( $mid,'b1$i','b2$i','b3$i','b4$i','b5$i','b6$i')";
                                                            $onclickActiv="active($mid,'b1$i','b2$i','b3$i','b4$i','b5$i','b6$i')";
                                                            $onclickHold="hold($mid,'b1$i','b2$i','b3$i','b4$i','b5$i','b6$i')";
                                                            $onclickDelayed="delayed($mid,'b1$i','b2$i','b3$i','b4$i','b5$i','b6$i')";
                                                            $onclickComplete="complete($mid,'b1$i','b2$i','b3$i','b4$i','b5$i','b6$i')";
                                                            $onclickRev="revision($mid,'b1$i','b2$i','b3$i','b4$i','b5$i','b6$i')";
                                    
                                                            switch($m['status'])
                                                            {
                                                            case 0:
                                                                $pipeline='In pipeline';
                                                                $onclickPipe="";
                                                                break;
                                                            case 1:
                                                                $active='Activated';
                                                                $onclickActiv="";
                                                                break;
                                                            case 2:
                                                                $hold='On hold';
                                                                $onclickHold="";
                                                                break;
                                                            case 3:
                                                                $delayed='Has delayed';
                                                                $onclickDelayed="";
                                                                break;
                                                            case 4:
                                                                $complete='Completed';
                                                                $onclickComplete="";
                                                                break;
                                                            case 5:
                                                                $revision='Revision sent';
                                                                $onclickRev="";
                                                                break;
                                                            }
                                                            
                                                        ?>
                                                                <button type="button" id="b1<?= $i ?>" class="btn btn-info m-1 px-1" onclick="<?=$onclickPipe?>" ><?=$pipeline?></button>
                                                                <button type="button" id="b2<?= $i ?>" class="btn btn-danger m-1 px-1" onclick="<?=$onclickActiv?>" ><?=$active?></button>
                                                                <button type="button" id="b3<?= $i ?>" class="btn btn-info m-1 px-1" onclick="<?=$onclickHold?>" ><?=$hold?></button>
                                                                <button type="button" id="b4<?= $i ?>" class="btn btn-warning m-1 px-1" onclick="<?=$onclickDelayed?>"><?=$delayed?></button>
                                                                <button type="button" id="b5<?= $i ?>" class="btn btn-secondary m-1 px-1" onclick="<?=$onclickComplete?>" ><?=$complete?></button>
                                                                <button type="button" id="b6<?= $i ?>" class="btn btn-danger m-1 px-1" onclick="<?=$onclickRev?>" ><?=$revision?></button>
                                                            <?php
                                                        
                                                            
                                                        

                                                        ?>
                                                    </form>
                                                </td>


                                                <td>
                                                    <?php
                                                    if (isset($assigned_milestones)) {
                                                        foreach ($assigned_milestones as $a) {
                                                            if ($m['id'] == $a['m_id']) {
                                                                $eid = $a['e_id'];
                                                                $sql = "select * from employee where id='$eid'";
                                                                $res = $conn->query($sql);
                                                                if ($res->num_rows > 0) {
                                                                    $ename = $res->fetch_assoc();
                                                                }
                                                                if (($a['status'] == 3)) {
                                                    ?>
                                                                    <p><?= $ename['name'] ?> : Completed<br></p>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <p><?= $ename['name'] ?> : Not Completed<br></p>
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </td>


                                                <td>
                                                    <?php
                                                    if (isset($assigned_milestones)) {
                                                        foreach ($assigned_milestones as $a) {
                                                            if ($m['id'] == $a['m_id']) {
                                                                $eid = $a['e_id'];
                                                                $sql = "select * from employee where id='$eid'";
                                                                $res = $conn->query($sql);
                                                                if ($res->num_rows > 0) {
                                                                    $ename = $res->fetch_assoc();
                                                                }
                                                                if (!empty($a['excuse'])) {
                                                    ?>
                                                                    <p><?= $ename['name'] ?> : <?= $a['excuse'] ?><br></p>
                                                        <?php
                                                                }
                                                            }
                                                        }

                                                        ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if (isset($assigned_milestones)) {
                                                            foreach ($assigned_milestones as $a) {
                                                                if ($m['id'] == $a['m_id']) {
                                                                    $eid = $a['e_id'];
                                                                    $sql = "select * from employee where id='$eid'";
                                                                    $res = $conn->query($sql);
                                                                    if ($res->num_rows > 0) {
                                                                        $ename = $res->fetch_assoc();
                                                                    }
                                                                    if (!empty($a['comments'])) {
                                                    ?>
                                                                    <p><?= $ename['name'] ?> : <?= $a['comments'] ?><br></p>
                                                    <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </td>




                                            </tr>
                                <?php
                                                        $i++;
                                                    }
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
<form method="post" enctype="multipart/form-data">
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
                                    <label for="validationCustom1">Title</label>
                                    <input type="text" class="form-control" id="validationCustom0s" name="title" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom2">Due Date</label>
                                    <input type="date" class="form-control" id="validationCustom" name="due_date" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom3">Description</label>
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

                                        <select id="prim_skills" name="employees[]" multiple>
                                            <?php
                                            if (isset($employeeName)) {
                                                foreach ($employeeName as $e) {
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
                        <button type="submit" class="btn btn-primary" name="add">Add</button>


                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<form method="post" enctype="multipart/form-data">
    <div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Milestone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01">Title</label>
                                    <input type="text" class="form-control" id="validationCustom01" name="title" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Due Date</label>
                                    <input type="hidden" name="eid" id="eid">
                                    <input type="date" class="form-control" id="validationCustom02" name="due_date" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03">Description</label>

                                    <textarea type="text" class="form-control" id="validationCustom03" name="description" required></textarea>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="card-title">

                                <h4 style="display:inline; margin-right:4px;" class="mb-0">Edit Files</h4>



                                <div style="display:inline;" class="form-group">
                                    <button type="button" class="btn btn-primary m-1" onclick="addFilesField2()"><i class=" fadeIn animated bx bx-plus"></i></button>
                                </div>
                            </div>
                            <hr />
                            <div class="row" id="row1" style="margin-bottom:20px">

                                <?php
                                // if (isset($project_img)) {
                                //$counter = 0;
                                // foreach ($project_img as $file) {

                                ?>
                                <!-- <div class="col-md-2" id="file<?= $counter ?>">
                                    
                                </div> -->
                                <?php
                                //$counter++;
                                //     }
                                // }

                                ?>


                            </div>


                            <div class="row">
                                <div class="col-md-4" id="filesDiv3">


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

                                        <select id="prim_skills2" name="employees2[]" multiple>
                                            <?php
                                            //if (isset($employeeName)) {
                                            //foreach ($employeeName as $e) {
                                            ?>

                                            <!-- <option value="<?= $e['id'] ?>"><?= $e['name'] ?></option> -->

                                            <?php
                                            //}
                                            //}
                                            ?>
                                            <?php
                                            if (isset($employeeName)) {

                                                foreach ($employeeName as $e) {
                                                    $selected = '';
                                                    if (in_array($e['id'], $employee2)) {
                                                        $selected = 'selected';
                                                    }
                                            ?>

                                                    <option value="<?= $e['id'] ?>" <?= $selected ?>><?= $e['name'] ?></option>
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
                        <button type="button" onclick="editValues(<?= $_GET['token'] ?>)" data-dismiss="modal" class="btn btn-primary" name="edit">Save changes</button>


                    </div>
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
    $(document).ready(function() {
        $('#prim_skills').multiselect({
            nonSelectedText: 'Select Employees',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '400px'
        });
    })

    $(document).ready(function() {
        $('#prim_skills2').multiselect({
            nonSelectedText: 'Select Employees',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '400px'
        });
    })
    var coun1 = 1;

    function addFilesField() {

        var inhtml = `<div class="row" style="margin-top:20px" >    
                            <div class="col-md-10">
                                <input   type="file" id='projectfile${coun1}' name="projectFile[]" class="form-control"/>
                            </div> 
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger" onclick="removeField('projectfile${coun1}')"><i class="fadeIn animated bx bx-trash"></i></button>
                            </div> 
                        </div>`;
        $("#filesDiv2").append(inhtml);
        coun1++;

    }

    var coun2 = 1;

    function addFilesField2() {

        var inhtml = `<div class="row" style="margin-top:20px" >    
                            <div class="col-md-10">
                                <input   type="file" class="milestonefile" id='projectfile${coun2}' name="projectFile[]" class="form-control"/>
                            </div> 
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger" onclick="removeField('projectfile${coun2}')"><i class="fadeIn animated bx bx-trash"></i></button>
                            </div> 
                        </div>`;
        $("#filesDiv3").append(inhtml);

        coun2++;

    }

    function removeField(id) {
        $("#" + id).parent().parent().remove();


    }

    function deleteFile(id, divId) {
        $.ajax({
            url: "del_milestonesFiles.php",
            type: "POST",
            data: {
                deleteId: id,

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
    var counter = 0;

    function editSetValues(id, count) {
        $("#eid").val(id);

        $("#validationCustom01").val($("#title" + count).html());

        $("#validationCustom02").val($("#due_date2" + count).val());
        $("#validationCustom03").val($("#description" + count).html());
        $(".filess" + count).each(function() {
            let extension = $(this).val().split('.').pop();
            // console.log(extension);
            // console.log(this);
            var file_id = $(this).attr('data-file-id');
            var counter2 = 0;
            if (extension == 'pdf') {
                var inhtml =
                    `<div class="col-md-3" style="margin-right:1.5vw;"id="file${counter2}"><div class="col-md-8">
            <a  href="./uploads/${$(this).val()}" target="_blank"><img src="./uploads/379099.png" width="120px" height="120px" /></a>
            </div>
            <div class="col-md-1">
            <button type="button" class="btn btn-danger" onclick="deleteFile(${file_id},'file${counter2}','./uploads/${$(this).val()}')"><i class="fadeIn animated bx bx-trash"></i></button>
             </div>
             </div>`;
            } else {
                var inhtml = `
            <div class="col-md-3" style="margin-right:1.5vw;"id="file${counter2}"><div class="col-md-8">
            <a  href="./uploads/${$(this).val()}" target="_blank"><img src="./uploads/${$(this).val()}" width="120px" height="120px" /></a>
            </div>
            <div class="col-md-1">
            <button type="button" class="btn btn-danger" onclick="deleteFile(${file_id},'file${counter2}','./uploads/${$(this).val()}')"><i class="fadeIn animated bx bx-trash"></i></button>
             </div>
             
             </div>`
            }
            counter2++;
            $('#row1').append(inhtml);
        });
        counter = count;

    }


    function editValues(pId) {
        console.log(counter)
        var fd = new FormData();

        // fd.append('files', $("#fancy-file-upload2")[0].files[0]);
        // fd.append('projectfile', $("#projectFile")[0].files[0]);
        $(".milestonefile").each(function() {

            fd.append('projectFile[]', $(this)[0].files[0]);
        })
        fd.append('eid', $("#eid").val());
        fd.append('title', $("#validationCustom01").val());
        fd.append('due_date', $("#validationCustom02").val());
        fd.append('description', $("#validationCustom03").val());
        fd.append('prjectId',pId)
        // fd.append('employees', $("#prim_skills2"));
        console.log($(".milestonefile"))
        $.ajax({
            url: "milestoneEdit_ajax.php",
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
                var obj = JSON.parse(data)
                if (obj.msg.trim() == "ok") {
                    {
                        $("#name" + counter).html($("#validationCustom01").val());
                        $("#position" + counter).html($("#validationCustom02").val());
                        $("#sort_order" + counter).html($("#validationCustom03").val());
                        console.log(obj.image)
                        // $("#imagesrc" + counter).attr("src", obj.image);
                        // $("#imagehref" + counter).attr("href", obj.image);
                        $("#card-body").prepend(`<div class="alert alert-success"><strong>Your request executed successfully !!</strong></div>`);
                        setTimeout(function() {
                            $(".alert").hide();
                        }, 4000);

                    }
                } else if (obj.msg.trim() == "image_not_ok") {
                    $("#title" + counter).html($("#validationCustom01").val());
                    $("#due_date" + counter).html($("#validationCustom02").val());
                    $("#description" + counter).html($("#validationCustom03").val());
                    $("#card-body").prepend(`<div class="alert alert-success"><strong>Your request executed successfully !!</strong></div>`);
                    setTimeout(function() {
                        $(".alert").hide();
                    }, 4000);
                } else {
                    $("#card-body").prepend(`<div class="alert alert-danger"><strong>Your request was declined !!</strong></div>`);
                    setTimeout(function() {
                        $(".alert").hide();
                    }, 4000);

                    console.log(obj);
                }
            },
            error: function() {

            }

        })
    }

    function deleteMilestone(id, trId) {
        $.ajax({
            url: "del_ajaxMilestone.php",
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


    function pipeline(mID, pipe, activ, hol, delay, complet, rev) {
        if(confirm("Are you sure to mark as In pipeline?")) 
        {
            $.ajax({
                url: "pipeline_milestone.php",
                type: "POST",
                data: {
                    milestoneId: mID,
                },
                success: function(data) {

                    if (data.trim() == "ok") {
                        $("#" + pipe).html(" In pipeline");
                        // $("#" + pipe).attr("onclick", "");
                        // $("#" + pipe).attr("class", "btn btn-success");
                        $("#" + activ).html("Active");
                        

                        $("#" + hol).html("Hold");
                        $("#" + delay).html("Delayed");
                        $("#" + complet).html("Complete");
                        $("#" + rev).html("Revision");

                       


                    } else {
                        console.log(data);
                    }
                },
                error: function() {

                }
            })
        }

    }

    function active(mID, pipe, activ, hol, delay, complet, rev) {
        if(confirm("Are you sure to mark as active?") )
        {
            $.ajax({
                url: "active_milestone.php",
                type: "POST",
                data: {
                    milestoneId: mID,
                },
                success: function(data) {

                    if (data.trim() == "ok") {
                        $("#" + pipe).html("Pipeline");
                        $("#" + activ).html("Activated");
                        // $("#" + activ).attr("onclick", "");
                        // $("#" + activ).attr("class", "btn btn-success");

                        $("#" + hol).html("Hold");
                        $("#" + delay).html("Delayed");
                        $("#" + complet).html("Complete");
                        $("#" + rev).html("Revision");

                        


                    } else {
                        console.log(data);
                    }
                },
                error: function() {

                }
            })
        }

    }


    function hold(mID, pipe, activ, hol, delay, complet, rev) {
        if(confirm("Are you sure to mark as on hold?") )
        {
            $.ajax({
                url: "onhold_milestone.php",
                type: "POST",
                data: {
                    milestoneId: mID,
                },
                success: function(data) {

                    if (data.trim() == "ok") {
                        $("#" + pipe).html("Pipeline");
                        $("#" + activ).html("Active");
                        

                        $("#" + hol).html("On hold");
                        // $("#" + hol).attr("onclick", "");
                        // $("#" + hol).attr("class", "btn btn-success");
                        $("#" + delay).html("Delayed");
                        $("#" + complet).html("Complete");
                        $("#" + rev).html("Revision");

                        


                    } else {
                        console.log(data);
                    }
                },
                error: function() {

                }
            })
        }

    }

    function delayed(mID, pipe, activ, hol, delay, complet, rev) {
        if(confirm("Are you sure to mark as has delayed?") )
        {
            $.ajax({
                url: "hasdelayed_milestone.php",
                type: "POST",
                data: {
                    milestoneId: mID,
                },
                success: function(data) {

                    if (data.trim() == "ok") {
                        $("#" + pipe).html("Pipeline");
                        $("#" + activ).html("Active");
                        

                        $("#" + hol).html("Hold");
                        // $("#" + hol).attr("onclick", "");
                        
                        $("#" + delay).html("Has delayed");
                        // $("#" + delay).attr("class", "btn btn-success");
                        $("#" + complet).html("Complete");
                        $("#" + rev).html("Revision");

                        


                    } else {
                        console.log(data);
                    }
                },
                error: function() {

                }
            })
        }

    }

    function complete(mID, pipe, activ, hol, delay, complet, rev) {
        if(confirm("Are you sure to mark as completed?") )
        {
            $.ajax({
                url: "completedd_milestone.php",
                type: "POST",
                data: {
                    milestoneId: mID,
                },
                success: function(data) {

                    if (data.trim() == "ok") {
                        $("#" + pipe).html("Pipeline");
                        $("#" + activ).html("Active");
                        

                        $("#" + hol).html("Hold");
                        // $("#" + hol).attr("onclick", "");
                        
                        $("#" + delay).html("delayed");
                        // $("#" + delay).attr("class", "btn btn-success");
                        $("#" + complet).html("Completed");
                        $("#" + rev).html("Revision");

                        


                    } else {
                        console.log(data);
                    }
                },
                error: function() {

                }
            })
        }

    }

    function revision(mID, pipe, activ, hol, delay, complet, rev) {
        if(confirm("Are you sure to mark as revision sent?") )
        {
            $.ajax({
                url: "revision_milestone.php",
                type: "POST",
                data: {
                    milestoneId: mID,
                },
                success: function(data) {

                    if (data.trim() == "ok") {
                        $("#" + pipe).html("Pipeline");
                        $("#" + activ).html("Active");
                        

                        $("#" + hol).html("Hold");
                        // $("#" + hol).attr("onclick", "");
                        
                        $("#" + delay).html("delayed");
                        // $("#" + delay).attr("class", "btn btn-success");
                        $("#" + complet).html("Complete");
                        $("#" + rev).html("Revision sent");

                        


                    } else {
                        console.log(data);
                    }
                },
                error: function() {

                }
            })
        }

    }
</script>