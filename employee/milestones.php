<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';

//inserting

//fetching
$id = $_GET['token'];
$sql = "select * from assigned_milestones where p_id='$id' and e_id=22";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $milestoneIDS[] = $row;
    }
}

if(isset($milestoneIDS))
{
    foreach($milestoneIDS as $m)
    {
        $milestoneId=$m['m_id'];
        $sql="select * from milestones where id='$milestoneId'";
        $res= $conn->query($sql);
        if($res->num_rows > 0)
        {
            $milestone[]=$res->fetch_assoc();
        }
        $sql2 = "select * from milestone_files where m_id='$milestoneId'";
$res2 = $conn->query($sql2);
if ($res2->num_rows > 0) {
    while ($row2 = $res2->fetch_assoc()) {
        $m_files[] = $row2;
    }
    }
}
}



//fetching
// if (isset($employee)) {
//     foreach ($employee as $e) {
//         $employeeId = $e['e_id'];
//         $sql = "select * from employee where id='$employeeId'";
//         $res = $conn->query($sql);
//         if ($res->num_rows > 0) {
//             $employeeName[] = $res->fetch_assoc();
//         }
//     }
// }

// if (isset($_GET['token'])) {
//     $id = $_GET['token'];
//     $sql = "select * from milestones where p_id='$id'";
//     $res = $conn->query($sql);
//     if ($res->num_rows > 0) {
//         while ($row = $res->fetch_assoc()) {
//             $milestones[] = $row;
//         }
//     }
// }

// if (isset($milestones)) {
//     foreach ($milestones as $m) {
//         $m_id = $m['id'];
// $sql2 = "select * from milestone_files where m_id='$m_id'";
// $res2 = $conn->query($sql2);
// if ($res2->num_rows > 0) {
//     while ($row2 = $res2->fetch_assoc()) {
//         $m_files[] = $row2;
//     }

//     $sql3 = "select * from assigned_milestones where m_id='$m_id'";
//     $res3 = $conn->query($sql3);
//     if ($res3->num_rows > 0) {
//         while ($row3 = $res3->fetch_assoc()) {
//             $assigned_milestones[] = $row3;
//         }
//     }
// }

//     }
// }



?>

<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pr-3">Employee</div>
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
                                        <!-- <th scope="col">#</th> -->
                                        <th scope="col">Title</th>
                                        <th scope="col">Files</th>
                                        <th scope="col">Due Date</th>


                                        <th scope="col">Description</th>
                                        
                                       
                                        <th scope="col">Excuses</th>
                                        <th scope="col">Comments</th>
                                        <th scope="col">Actions</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($milestone)) {
                                        $i = 1;
                                        foreach ($milestone as $m) {
                                            $timestamp = strtotime($m['due_date']);
                                    ?>
                                            <tr id="tr<?= $i ?>">
                                                <!-- <th scope="row"><?= $i ?></th> -->
                                                <td id="name<?= $i ?>"><?= $m['title'] ?></td>
                                                <td>
                                                    <?php
                                                    if (isset($m_files)) {
                                                        foreach ($m_files as $p) {

                                                            if ($p['m_id'] == $m['id']) {
                                                                $file_parts = pathinfo($p['img']);

                                                                switch ($file_parts['extension']) {
                                                                    case "jpg":
                                                    ?>
                                                                        <a href=" ../admin/uploads/<?= $p['img'] ?>" target="_blank"><img src="../admin/uploads/image.png ?>" width="33px" height="33px" /></a>
                                                                    <?php
                                                                        break;
                                                                    case "jpeg":
                                                                    ?>
                                                                        <a href=" ../admin/uploads/<?= $p['img'] ?>" target="_blank"><img src="../admin/uploads/image.png ?>" width="33px" height="33px" /></a>
                                                                    <?php
                                                                        break;
                                                                    case "png":
                                                                    ?>
                                                                        <a href=" ../admin/uploads/<?= $p['img'] ?>" target="_blank"><img src="../admin/uploads/image.png ?>" width="33px" height="33px" /></a>
                                                                    <?php
                                                                        break;
                                                                    case "bmp":
                                                                    ?>
                                                                        <a href=" ../admin/uploads/<?= $p['img'] ?>" target="_blank"><img src="../admin/uploads/image.png ?>" width="33px" height="33px" /></a>
                                                                    <?php
                                                                        break;
                                                                    case "JPG":
                                                                    ?>
                                                                        <a href=" ../admin/uploads/<?= $p['img'] ?>" target="_blank"><img src="../admin/uploads/image.png ?>" width="33px" height="33px" /></a>
                                                                    <?php
                                                                        break;
                                                                    case "pdf":
                                                                    ?>
                                                                        <a href=" ../admin/uploads/<?= $p['img'] ?>" target="_blank"><img src="../admin/uploads/379099.png ?>" width="33px" height="33px" /></a>
                                                    <?php
                                                                        break;
                                                                }
                                                            }
                                                        }
                                                    }


                                                    ?>
                                                </td>
                                                
                                                <td id="contact<?= $i ?>"><?=date("M-d-Y", $timestamp) ?></td>

                                                <td id="email<?= $i ?>"><?= $m['description'] ?></td>
                                                
                                                
                                                <td id="excuse<?= $i ?>">
                                                    <?php 
                                                    if(isset($milestoneIDS))
                                                    {
                                                        foreach($milestoneIDS as $a)
                                                        {
                                                            if($m['id']==$a['m_id'])
                                                            {
                                                                if(!empty($a['excuse']))
                                                                {
                                                                ?>
                                                                <?=$a['excuse']?>
                                                                <?php
                                                                }
                                                            }
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td id="comments<?= $i ?>">
                                                    <?php 
                                                    if(isset($milestoneIDS))
                                                    {
                                                        foreach($milestoneIDS as $a)
                                                        {
                                                            if($m['id']==$a['m_id'])
                                                            {
                                                                if(!empty($a['comments']))
                                                                {
                                                                ?>
                                                                <?=$a['comments']?>
                                                                <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <form method="post">
                                                    <td><a type="button" data-toggle="modal" data-target="#exampleModal6" class="btn btn-success m-1 px-2" onclick="editSetValues(<?= $m['id'] ?>,<?= $i ?>)">Edit</a>
                                                       
                                                    </td>
                                                </form>
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


<!--edit modal-->
<form method="post" enctype="multipart/form-data" id="editM">
    <div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Provide feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom01">Excuses</label>
                                    <textarea type="text" class="form-control" id="validationCustom01" name="excuses"></textarea>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03">Comments</label>
                                    <input type="hidden" id="eid" name="eid">
                                    <input type="hidden" id="count" name="count">
                                    <textarea type="text" class="form-control" id="validationCustom03" name="comments"></textarea>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    



                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="editValues()" data-dismiss="modal"  class="btn btn-primary" name="edit">Save changes</button>

                </div>
            </div>
        </div>
    </div>
</form>
<?php
require_once 'js_links.php';
require_once '../admin/footer.php';

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

    function deleteFile(id, divId) {
        $.ajax({
            url: "del_ajaxMilestone.php",
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


    var counter=0;
console.log(counter);
    function editSetValues(id, count) {
        $("#count").val(count);
        $("#eid").val(id);
        $("#validationCustom01").val($("#excuse" + count).html().trim());
       
        $("#validationCustom03").val($("#comments" + count).html().trim());
        
        counter = count;
    }

    function editValues() {
        $.ajax({
            url: "edit_ajaxMilestone.php",
            type: "POST",
            data: $("#editM").serialize(),
            success: function(data) {

                if (data.trim() == "ok") {
                    {
                        $("#excuse"+ counter).html($("#validationCustom01").val());
                        
                        $("#comments"+ counter).html($("#validationCustom03").val());
                        
                        
                    }
                } else {
                    console.log(data);
                }
            },
            error: function() {

            }

        })
    }

    
</script>