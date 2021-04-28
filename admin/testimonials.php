<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';

//inserting
if (isset($_POST['add']) && isset($_POST['name']) && isset($_POST['sort_order']) && isset($_POST['position']) && isset($_POST['des'])) {
    $name = $_POST['name'];
    $sort_order = $_POST['sort_order'];
    $position = $_POST['position'];
    $des = $_POST['des'];
    $sql = "insert into testimonials (name,position,sort_order,des) values ('$name','$position','$sort_order','$des')";
    if ($conn->query($sql)) {
        $insert_id = $conn->insert_id;
        if(upload_imageUpdate($conn,"testimonials","img",'id',$insert_id,"files"))
        {
        $query = true;
    } else {
        $query=false;
    }} else {
        echo $conn->error;
    }
}


//deleting
if (isset($_POST['del'])) {
    $id = $_POST['del'];
    $sql = "delete  from testimonials where id=$id";
    if ($conn->query($sql)) {
        $query = true;
    } else {
        echo $conn->error;
    }
}

//editing
if (isset($_POST['edit']) || isset($_POST['ename']) || isset($_POST['esort_order']) || isset($_POST['eposition']) || isset(($_POST['edesc']))) {
    $id = $_POST['eid'];
    $name = $_POST['ename'];
    $sort_order = $_POST['esort_order'];
    $position = $_POST['eposition'];
    $des = $_POST['edesc'];
    $sql = "update testimonials set name='$name',position='$position',sort_order='$sort_order',des='$des' where id='$id'";
    if ($conn->query($sql)) {
        $query = true;
        $id=$_POST['eid'];
        if(upload_imageUpdate($conn,"testimonials","img",'id',$id,"files"))
        {
        $query = true;
    } else {
        $query=false;
    }
    } else {
        echo $conn->error;
    }
}



//fetching
$sql = "select * from testimonials order by sort_order ASC";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $testimonials[] = $row;
    }
}

?>

<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pr-3">Testimonials</div>
                <div class="pl-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Members</li>
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
                                        <th scope="col">Position</th>

                                        
                                        <th scope="col">Sort Order</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Description</th>

                                        <th name="bstable-actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($testimonials)) {
                                        $i = 1;
                                        foreach ($testimonials as $t) {
                                    ?>
                                            <tr id="tr<?= $i ?>">
                                                <th scope="row"><?= $i ?></th>
                                                <td id="name<?= $i ?>"><?= $t['name'] ?></td>
                                                <td id="position<?= $i ?>"><?= $t['position'] ?></td>
                                                
                                                <td id="sort_order<?= $i ?>"><?= $t['sort_order'] ?></td>
                                                <td><a href="<?=$t['img']?>" target="_blank"><img src="<?=$t['img']?>" width="100px" height="100px"/></a></td>
                                                <td id="des<?= $i ?>"><?= $t['des'] ?></td>
                                                <form method="post">
                                                    <td><button type="button" class="btn btn-success m-1 px-3" value="<?= $t['id'] ?>" onclick="editSetValues(<?= $t['id'] ?>,<?= $i ?>)" data-toggle="modal" data-target="#exampleModal6">Edit</button>
                                                        <button type="button" class="btn btn-danger m-1 px-3" onclick="deleteTestimonial(<?=$t['id']?>,'tr<?=$i?>')" name="del">Delete</button>
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
<form class="needs-validation" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Member</h5>
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
                                    <label for="validationCustom02">Position</label>
                                    <input type="text" class="form-control" id="validationCustom" name="position" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03">Sort Order</label>

                                    <input type="number" class="form-control" id="validationCusto" name="sort_order" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03">Description</label>
                                    <textarea name="des" id='des'></textarea>
                                    <script>
                                        CKEDITOR.replace('des');
                                    </script>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end breadcrumb-->
                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="card-title">
                                <h4 style="display:inline; margin-right:4px;" class="mb-0">Add Image</h4>
                                <!-- <div style="display:inline;" class="form-group">
                                    <button type="button" class="btn btn-primary m-1" onclick="addFilesField()"><i class=" fadeIn animated bx bx-plus"></i></button>
                                </div><br> -->

                            </div>
                            <hr />
                            <input id="fancy-file-upload2" type="file" name="files"><br>
                            <div class="row" style="margin-bottom:20px">

                                <?php
                                if (isset($testimonial_image)) {
                                    

                                ?>
                                        <div class="col-md-2" id="file">
                                            <div class="col-md-8">
                                                <a href="<?= $file['img'] ?>" target="_blank"><img src="<?= $file['img'] ?>" width="100px" height="100px" /></a>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger" onclick="deleteFile(<?= $file['id'] ?>)"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                <?php

                                    }
                                

                                ?>


                            </div>
                            <!-- <div class="col-md-4" id="filesDiv">

                                </div> -->


                        </div>
                    </div>



                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add">Save changes</button>

                </div>
            </div>
        </div>
    </div>
</form>

<!--edit modal-->
<form method="post" enctype="multipart/form-data" id="editM">
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
                                    <label for="validationCustom02">Position</label>
                                    <input type="text" class="form-control" id="validationCustom02" name="eposition" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <input type="hidden" id="eid" name="eid">
                                    <label for="validationCustom03">Sort Order</label>
                                    <input type="number" class="form-control" id="validationCustom03" name="esort_order" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="edes">Description</label><br>
                                    <textarea name="edesc" id="edesc" style="width:100%;height:100%;" id="edesc"></textarea><br>
                                    <script>
                                        // CKEDITOR.instances.edesc.setData('<p>yesss</p>');
                                        // CKEDITOR.instances.edesc.getData();
                                        CKEDITOR.replace('edesc');
                                    </script>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end breadcrumb-->
                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="card-title">
                                <h4 class="mb-0">Image Upload</h4>
                            </div>
                            <hr />
                            <input id="fancy-file-upload2" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" ><br>
                        </div>
                    </div>



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
    function editSetValues(id, count) {
        $("#eid").val(id);
        $("#validationCustom01").val($("#name" + count).html());
        $("#validationCustom02").val($("#position" + count).html());
        $("#validationCustom03").val($("#sort_order" + count).html());
        $('#edesc').val(CKEDITOR.instances['edesc'].setData($("#des" + count).html()));
        counter=count;
    }



    function editValues() {
        $.ajax({
            url: "testimonialEdit_ajax.php",
            type: "POST",
            data: $("#editM").serialize(),
            success: function(data) {

                if (data.trim() == "ok") {
                    {
                        $("#name"+ counter).html($("#validationCustom01").val());
                        $("#position"+ counter).html($("#validationCustom02").val());
                        $("#sort_order"+ counter).html($("#validationCustom03").val());
                        // $("#des"+ counter).html($("#edesc").val());
                        
                    }
                } else {
                    console.log(data);
                }
            },
            error: function() {

            }

        })
    }



    function deleteTestimonial(id, trId) {
        $.ajax({
            url: "testimonialdelete_ajaxMember.php",
            type: "POST",
            data: {
                deleteTestimonial: id,

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