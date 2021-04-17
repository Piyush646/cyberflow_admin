<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';

// //inserting
// if (isset($_POST['add']) && isset($_POST['name']) && isset($_POST['sort_order']) && isset($_POST['position']) && isset($_POST['des'])) {
//     $name = $_POST['name'];
//     $sort_order = $_POST['sort_order'];
//     $position = $_POST['position'];
//     $des = $_POST['des'];
//     $sql = "insert into testimonials (name,position,sort_order,des) values ('$name','$position','$sort_order','$des')";
//     if ($conn->query($sql)) {
//         $query = true;
//     } else {
//         echo $conn->error;
//     }
// }


// //deleting
// if (isset($_POST['del'])) {
//     $id = $_POST['del'];
//     $sql = "delete  from testimonials where id=$id";
//     if ($conn->query($sql)) {
//         $query = true;
//     } else {
//         echo $conn->error;
//     }
// }

//editing
if (isset($_POST['edit']) || isset($_POST['des'])) {
    
    $des = $_POST['des'];
    $sql = "update about set des='$des'";
    if ($conn->query($sql)) {
        $id=$_POST['edit'];
        if(upload_imageUpdate($conn,"about","img",'id',$id,"files"))
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
$sql = "select * from about";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $about = $res->fetch_assoc();
}


?>

<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pr-3">About Us</div>
                <div class="pl-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Our Vision</li>
                        </ol>
                    </nav>
                </div>
                <div class="ml-auto">
                    <!-- <div class="btn-group">
                        <button type="submit" class="btn btn-primary m-1" data-toggle="modal" data-target="#exampleModal5"><i class=" fadeIn animated bx bx-plus"></i></button>
                    </div> -->
                </div>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                        <div>

                            <div class="card radius-15">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom01">
                                                <h6>Description</h6>
                                            </label>
                                            <textarea style="height:100%;width:100%;" type="text" class="form-control" id="about_des" name="des" required><?= $about['des'] ?></textarea>
                                            <div class="valid-feedback">Looks good!</div>
                                            <script>
                                                // CKEDITOR.instances.edesc.setData('<p>yesss</p>');
                                                // CKEDITOR.instances.edesc.getData();
                                                CKEDITOR.replace('about_des');
                                            </script>
                                        </div>
                                    </div>
                                </div><br>
                                <!--end page-content-wrapper-->
                            </div>
                            <div class="card radius-15">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h4 class="mb-0">Image</h4>
                                    </div>
                                    <hr />
                                    <!-- <input id="fancy-file-upload" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" multiple><br> -->
                                    <div class="col-md-2" id="file">
                                        <div class="col-md-8">
                                            <a href="<?= $about['img'] ?>" target="_blank"><img src="<?= $about['img'] ?>" width="100px" height="100px" /></a>
                                        </div>
                                    </div><br>
                                    <div class="col-md-2" style="margin-left:18px;">
                                    <input id="fancy-file-upload" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png"><br>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" name="edit" value="<?= $about['id'] ?>" class="btn btn-primary m-1 btn-lg px-5">Save Changes</button>
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
<!-- <script>
    $('#fancy-file-upload').FancyFileUpload({
        params: {
            action: 'fileuploader'
        },
        maxfilesize: 1000000
    });
</script> -->

<!-- <script>
    function editSetValues(id, count) {
        $("#eid").val(id);
        $("#validationCustom01").val($("#name" + count).html());
        $("#validationCustom02").val($("#position" + count).html());
        $("#validationCustom03").val($("#sort_order" + count).html());
        $("#edesc").val($("#des" + count).html());

    }
</script> -->