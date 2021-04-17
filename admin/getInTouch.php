<?php
require_once "header.php";
require_once "navbar.php";
require_once "left_navbar.php";

//fetching
$sql="select * from getintouch";
$res=$conn->query($sql);
if($res->num_rows)
{
    while($row=$res->fetch_assoc())
    {
        $touch[]=$row;
    }
}
?>


<div class="page-wrapper">
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                <div class="breadcrumb-title pr-3">Get In Touch</div>
                <div class="pl-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Messages</li>
                        </ol>
                    </nav>
                </div>
                <div class="ml-auto">
                    <!-- <div class="btn-group">
                        <button type="submit" class="btn btn-primary m-1" data-toggle="modal" data-target="#exampleModal5"><i class=" fadeIn animated bx bx-plus"></i></button>
                    </div> -->
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
                                        <th scope="col">Email</th>
                                        <th scope="col">Date</th>
                                        
                                        <th scope="col">Contact</th>
                                        <th scope="col">Message</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($touch)) {
                                        $i = 1;
                                        foreach ($touch as $t) {
                                            $timestamp = strtotime($r['time_stamp']);
                                    ?>
                                            <tr>
                                                <th scope="row"><?= $i ?></th>
                                                
                                                <td id="name<?= $i ?>"><?= $t['name'] ?></td>
                                                <td id="position<?= $i ?>"><?= $t['email'] ?></td>
                                                <td id="name<?= $i ?>"><?= date("M-d-Y", $timestamp) ?></td>
                                                <td id="sort_order<?= $i ?>"><?= $t['phn'] ?></td>
                                                <td id="sort_order<?= $i ?>"><?= $t['message'] ?></td>
                                                <!-- <td><a href="<?=$t['image']?>" target="_blank"><img src="<?=$t['image']?>" width="100px" height="100px"/></a></td> -->
                                                <!-- <form method="post">
                                                    <td><button type="button" class="btn btn-success m-1 px-3" onclick="editSetValues(<?= $t['id'] ?>,<?= $i ?>)" data-toggle="modal" data-target="#exampleModal6">Edit</button>
                                                        <button type="submit" class="btn btn-danger m-1 px-3" value="<?= $t['id'] ?>" name="del">Delete</button>
                                                    </td>
                                                </form> -->
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
require_once "js_links.php";
require_once "footer.php";
?>