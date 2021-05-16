<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';

//editing
if (isset($_POST['edit'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $contact = $conn->real_escape_string($_POST['phn']);
    $address = $conn->real_escape_string($_POST['address']);
    $fb = $conn->real_escape_string($_POST['fb']);
    $twi = $conn->real_escape_string($_POST['twi']);
    $insta = $conn->real_escape_string($_POST['insta']);
    $linkedin = $conn->real_escape_string($_POST['linkedin']);
    $sql = "update web_config set title='$title',phn='$contact',address='$address',facebook='$fb',twitter='$twi',instagram='$insta',linkedin='$linkedin'";
    if ($conn->query($sql) == true) {
        $sql = "select id from web_config";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $id = $res->fetch_assoc();


            if (upload_imageUpdate($conn, "web_config", "logo", 'id', $id['id'], "files")) {
                $editquery = true;
            } else {
                $noquery = true;
            }
        } else {
            $no=true;
        }
    }
}
//fetching
$sql = "select * from web_config";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $config = $res->fetch_assoc();
}
?>
<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pr-3">Web Configuration</div>
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
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary m-1" onclick="editWeb()"><i class="fadeIn animated bx bx-edit-alt"></i></button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <?php
                if(isset($editquery))
                {
                    if ($editquery) {
                    ?>
                        <div class="alert alert-success"><strong>Your request executed successfully !!</strong></div>
                    <?php
                    }
                 }

                 if(isset($noquery))
                {
                    if ($noquery) {
                    ?>
                        <div class="alert alert-success"><strong>Your request executed successfully !!</strong></div>
                    <?php
                    }
                 }

                  if(isset($no)) 
                 {
                     if($no)
                     {
                    ?>
                        <div class="alert alert-danger"><strong>Your request was declined!!</strong></div>
                    <?php
                    }
                }
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card radius-15">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">
                                            Title
                                        </label>
                                        <input type="text" class="form-control" id="validationCustom01" name="title" value="<?= $config['title'] ?>" disabled required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">
                                            Contact Number
                                        </label>
                                        <input type="text" class="form-control" id="validationCustom02" name="phn" value="<?= $config['phn'] ?>" disabled required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom03">
                                            Address
                                        </label>
                                        <input type="text" class="form-control" id="validationCustom03" name="address" value="<?= $config['address'] ?>" disabled required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card radius-15">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4 class="mb-0">Social Media Links</h4><br>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">
                                            Facebook
                                        </label>
                                        <input type="link" class="form-control" id="validationCustom01" name="fb" value="<?= $config['facebook'] ?>" disabled required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">
                                            Twitter
                                        </label>
                                        <input type="link" class="form-control" id="validationCustom02" name="twi" value="<?= $config['twitter'] ?>" disabled required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom03">
                                            Instagram
                                        </label>
                                        <input type="link" class="form-control" id="validationCustom03" name="insta" value="<?= $config['instagram'] ?>" disabled required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom03">
                                            LinkedIn
                                        </label>
                                        <input type="link" class="form-control" id="validationCustom03" name="linkedin" value="<?= $config['linkedin'] ?>" disabled required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>

                            <div class="card radius-15">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h4 class="mb-0">Logo</h4>
                                    </div>
                                    <hr />
                                    <div class="col-md-2" id="file">
                                        <div class="col-md-8">
                                            <a href="<?= $config['logo'] ?>" target="_blank"><img src="<?= $config['logo'] ?>" width="100px" height="100px" /></a>
                                        </div><br>
                                        <div class="col-md-2" style="margin-left:4px;">
                                            <input id="fancy-file-upload" type="file" style="visibility:hidden" name="files" accept=".jpg, .png, image/jpeg, image/png"><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button id="edit" type="submit" style="visibility:hidden" name="edit" class="btn btn-primary m-1 btn-lg px-5">Save Changes</button>
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
        setTimeout(function() {
            $(".alert").hide();
        }, 4000);

        function editWeb() {
            $("input").removeAttr("disabled");
            // $("#fancy-file-upload").
            document.getElementById("edit").style.visibility = "visible";
            document.getElementById("fancy-file-upload").style.visibility = "visible";
        }
    </script>