<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';


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
                                                                    case "pdf":
                                                    ?>
                                                                        <a href=" ./uploads/<?= $p['img'] ?>" target="_blank"><img src="./uploads/379099.png ?>" width="33px" height="33px" /></a>
                                                                    <?php
                                                                        break;
                                                                    default:
                                                                    ?>
                                                                        <a href=" ./uploads/<?= $p['img'] ?>" target="_blank"><img src="./uploads/image.png ?>" width="33px" height="33px" /></a>
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
                                                    if (isset($assigned_emp)) {
                                                        foreach ($assigned_emp as $a) {
                                                            if ($t['id'] == $a['project_id']) {
                                                                $eid = $a['e_id'];
                                                                $sql = "select * from employee where id='$eid'";
                                                                $res = $conn->query($sql);
                                                                if ($res->num_rows > 0) {
                                                                    $ename = $res->fetch_assoc();
                                                                }
                                                    ?>

                                                                <p style="display:inline"><?= $ename['name'] ?> ,<br></p>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <form method="post">
                                                    <td><a href="addEditProject.php?token=<?= $t['id'] ?>" class="btn btn-success m-1 px-3">Edit</a>
                                                        <button type="button" class="btn btn-danger m-1 px-3" onclick="deleteProject('<?= $t['id'] ?>','tr<?= $i ?>')">Delete</button>
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


  
<?php
require_once 'js_links.php';
require_once 'footer.php';

?>
<script>
    function deleteProject(id, trId) {
        if (confirm("Are you sure to delete?")) {
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

    }
</script>