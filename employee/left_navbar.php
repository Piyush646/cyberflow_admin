<?php

//fetching
$sql = "select * from web_config";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $config = $res->fetch_assoc();
}
?>
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="">
            <img src="<?= $config['logo'] ?>" class="logo-icon-2" alt="" />
        </div>
        <div>
            <h4 class="logo-text">CyberFlow</h4>
        </div>
        <a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
        </a>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="dashboard.php">
                <div class="parent-icon icon-color-2"> <i class="fadeIn animated bx bx-cookie"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="projects.php">
                <div class="parent-icon icon-color-4"><i class="fadeIn animated bx bx-group"></i>
                </div>
                <div class="menu-title">Projects</div>
            </a>
        </li>
        
        <li>
            <a href="summary.php">
                <div class="parent-icon icon-color-3"> <i class="fadeIn animated bx bx-clipboard"></i>
                </div>
                <div class="menu-title">Summary</div>
            </a>
        </li>
        

    </ul>
</div>