<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';




//deleting


if (isset($_POST['del'])) {
    $id = $_POST['del'];
    $sql = "delete from portfolio_img where p_id=$id";
    if ($conn->query($sql)) {
    } else {
        echo $conn->error;
    }
}

if (isset($_POST['del'])) {
    $id = $_POST['del'];
    $sql = "delete from portfolio where id=$id";
    if ($conn->query($sql)) {
        $query = true;
    } else {
        echo $conn->error;
    }
}



//fetching
$sql = "select * from portfolio";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $projects[] = $row;
    }
}

?>

<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <form method="post" enctype="multipart/form-data">
            <div class="page-content">

                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                    <div class="breadcrumb-title pr-3">Portfolio</div>
                    <div class="pl-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Projects</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ml-auto">
                        <div class="btn-group">
                            <a href="addEditPortfolio.php" type="button" class="btn btn-primary m-1"><i class=" fadeIn animated bx bx-plus"></i></a>
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
                                            <th scope="col">Link</th>
                                            <th scope="col">Description</th>
                                            <th name="bstable-actions">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($projects)) {
                                            $i = 1;
                                            foreach ($projects as $p) {
                                        ?>
                                                <tr id="tr<?= $i ?>">
                                                    <th scope="row"><?= $i ?></th>
                                                    <td id="title<?= $i ?>"><?= $p['title'] ?></td>
                                                    <td id="link<?= $i ?>"><?= $p['link'] ?></td>
                                                    <td id="des<?= $i ?>"><?= $p['des'] ?></td>

                                                    <td><a href="addEditPortfolio.php?token=<?= $p['id'] ?>" type="button" class="btn btn-success m-1 px-3">Edit</a>
                                                        <button type="button" class="btn btn-danger m-1 px-3" onclick="deletePortfolio(<?= $p['id'] ?>,'tr<?= $i ?>')"  name="del">Delete</button>
                                                    </td>

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
        </form>
    </div>
</div>
<!--end page-content-wrapper-->
<!-- Modal -->

<?php
require_once 'js_links.php';
require_once 'footer.php';

?>
<script>
function deletePortfolio(id, trId) {
        if (confirm("Are you sure to delete?")) {
            $.ajax({
                url: "portfoliodelete_ajax.php",
                type: "POST",
                data: {
                    deletePortfolio: id,

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