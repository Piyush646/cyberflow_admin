<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';
//inserting
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $link = $_POST['link'];
    $des = $_POST['des'];
    $sql = "insert into portfolio(title,link,des) values('$title','$link','$des')";
    if ($conn->query($sql)) {
        $id = $conn->insert_id;
        if (upload_imagesInsert($conn, "portfolio_img", "p_id", 'img', $id, "projectFile")) {
            $query = true;
        } else {
            $query = false;
        }
    } else {
        echo $conn->error;
    }
}

//editing
if (isset($_POST['edit'])) {
    $id = $_GET['token'];
    $title = $_POST['title'];
    $link = $_POST['link'];
    $des = $_POST['des'];
    $sql = "update portfolio set title='$title',link='$link',des='$des' where id='$id'";
    if ($conn->query($sql)) {
        $id = $_GET['token'];
        if (upload_imagesInsert($conn, "portfolio_img", 'p_id', "img", $id, "projectFile")) {
            $query = true;
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
    $sql = "select * from portfolio where id='$id'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $project = $res->fetch_assoc();
    }
}

//fetching images
$id = $_GET['token'];
$sql = "select * from portfolio_img where p_id='$id'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $project_img[] = $row;
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
                    <div class="breadcrumb-title pr-3">Edit Portfolio</div>
                <?php
                } else {
                ?>
                    <div class="breadcrumb-title pr-3">Add Portfolio</div>
                <?php
                }
                ?>

                <div class="pl-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                            </li>
                            <?php
                            if (isset($project)) {
                            ?>
                                <li class="breadcrumb-item active" aria-current="page">Edit Project</li>
                            <?php
                            } else {
                            ?>
                                <li class="breadcrumb-item active" aria-current="page">Add Project</li>
                            <?php
                            }
                            ?>

                        </ol>
                    </nav>
                </div>
                <div class="ml-auto">
                    <!-- <div class="btn-group">
                        <a href="editWeb_config.php" type="button" class="btn btn-primary m-1" ><i class="fadeIn animated bx bx-edit-alt"></i></a>
                    </div> -->
                </div>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                    <?php
                        if (isset($query)) {
                            if ($query) {
                        ?>
                                <div class="alert alert-success"><strong>Your request executed successfully !!</strong></div>
                            <?php
                            } else {
                            ?>
                                <div class="alert alert-danger"><strong>Your request was declined!!</strong></div>
                        <?php
                            }
                        }
                        ?>
                        <div class="card radius-15">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">
                                            Title
                                        </label>
                                        <input type="text" class="form-control" id="validationCustom01" name="title" value="<?= $project['title'] ?>" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">
                                            Link
                                        </label>
                                        <input type="text" class="form-control" id="validationCustom02" name="link" value="<?= $project['link'] ?>" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom03">
                                            Description
                                        </label>
                                        <textarea type="text" style="height:100%;width:100%;" class="form-control" id="port_des" name="des" required><?= $project['des'] ?></textarea>
                                        <div class="valid-feedback">Looks good!</div>
                                        <script>
                                            // CKEDITOR.instances.edesc.setData('<p>yesss</p>');
                                            // CKEDITOR.instances.edesc.getData();
                                            CKEDITOR.replace('port_des');
                                        </script>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                        <div>

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
                                                        <a href="./uploads/<?= $file['img'] ?>" target="_blank"><img src="./uploads/<?= $file['img'] ?>" width="100px" height="100px" /></a>
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
                            <?php
                            if (isset($project)) {
                            ?>
                                <button type="submit" name="edit" class="btn btn-primary m-1 btn-lg px-5">Save Changes</button>
                            <?php
                            } else {
                            ?>
                                <button type="submit" name="add" class="btn btn-primary m-1 btn-lg px-5">Add Project</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php
require_once 'js_links.php';
require_once 'footer.php';

?>
<script>
    setTimeout(function() {
        $(".alert").hide();
    }, 4000);
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
</script>