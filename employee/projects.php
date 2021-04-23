<?php

include_once "header.php";
include_once "navbar.php";
include_once "left_navbar.php";

//fetching
// echo $eid=$_SESSION['e_id'];
$eid = 22;
// $sql="select assign_project.name,assign_project.due_date,assign_project.description,project_files.img from assign_project inner join project_files on assign_project.id='$eid' and project_files.p_id='$eid'";
// $res = $conn->query($sql);
// if($res->num_rows>0)
// {
//     while($row=$res->fetch_assoc())
//     {
//         $empProject[]=$row;
//     }
// }
// print_r($empProject);
$sql = "select * from assigned_employees where e_id='$eid'";
$res = $conn->query($sql);
if ($res->num_rows) {
    while ($row = $res->fetch_assoc()) {
        $empDetail[] = $row;
    }
}

if (isset($empDetail)) {
    foreach ($empDetail as $e) {
        $p_id = $e['project_id'];
        $sql = "select * from assign_project where id='$p_id'";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $empProject[] = $res->fetch_assoc();
        }
        
        $sql2 = "select * from project_files where p_id='$p_id'";
        $res2 = $conn->query($sql2);
        if ($res2->num_rows > 0) {
            while($row2 = $res2->fetch_assoc())
            {
            $p_files[] = $row2;
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
                <div class="breadcrumb-title pr-3">Projects</div>
                <div class="pl-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Assigned</li>
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
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>


                                        <th scope="col">Due Date</th>
                                        <th scope="col">Files</th>


                                        <th name="bstable-actions">More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($empProject)) {
                                        $i = 1;
                                        foreach ($empProject as $e) {
                                            $timestamp = strtotime($e['due_date']);
                                    ?>
                                            <tr>
                                                <th scope="row"><?= $i ?></th>
                                                <td id="name<?= $i ?>"><?= $e['name'] ?></td>
                                                <td id="position<?= $i ?>"><?= $e['description'] ?></td>

                                                <td id="sort_order<?= $i ?>"><?=date("M-d-Y", $timestamp) ?></td>
                                                <td>
                                                    <?php
                                                    if (isset($p_files)) {
                                                        foreach ($p_files as $p) {
                                                           
                                                            if($p['p_id'] == $e['id'])
                                                                {
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
                                                <form method="post">
                                                    
                                                    <td><a type="submit" class="btn btn-info m-1 px-3" href="milestones.php?token=<?= $e['id'] ?>">Milestones</a>
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
include_once "js_links.php";
include_once "footer.php";
?>