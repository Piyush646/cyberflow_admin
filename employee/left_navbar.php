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
            <a href="team.php">
                <div class="parent-icon icon-color-4"><i class="fadeIn animated bx bx-group"></i>
                </div>
                <div class="menu-title">Team</div>
            </a>
        </li>
        <li>
            <a href="#" class="has-arrow">
                <div class="parent-icon icon-color-2"> <i class="fadeIn animated bx bx-cookie"></i>
                </div>
                <div class="menu-title">Management</div>
            </a>
            <ul>
                <li> <a href="employee.php"><i class="bx bx-right-arrow-alt"></i>Employee</a>
                </li>
                <li> <a href="assign_project.php"><i class="bx bx-right-arrow-alt"></i>Assign Project</a>
                </li>
            </ul>

        </li>
        <li>
            <a href="testimonials.php">
                <div class="parent-icon icon-color-3"> <i class="fadeIn animated bx bx-clipboard"></i>
                </div>
                <div class="menu-title">Testimonials</div>
            </a>
        </li>
        <li>
            <a href="web_config.php">
                <div class="parent-icon icon-color-2"><i class="fadeIn animated bx bx-highlight"></i>
                </div>
                <div class="menu-title">Web Configuration</div>
            </a>
        </li>
        <li>
            <a href="about.php">
                <div class="parent-icon icon-color-3"> <i class="fadeIn animated bx bx-list-ul"></i>
                </div>
                <div class="menu-title">About</div>
            </a>
        </li>
        <li>
            <a href="portfolio.php">
                <div class="parent-icon icon-color-4"><i class="fadeIn animated bx bx-folder-plus"></i>
                </div>
                <div class="menu-title">Portfolio</div>
            </a>
        </li>

        <li>
            <a href="recruitment.php">
                <div class="parent-icon icon-color-3"><i class="fadeIn animated bx bx-cart"></i>
                </div>
                <div class="menu-title">Recruitment</div>
            </a>
        </li>

        <li>
            <a href="getInTouch.php">
                <div class="parent-icon icon-color-2"><i class="fadeIn animated bx bx-notification"></i>
                </div>
                <div class="menu-title">Get In Touch</div>
            </a>
        </li>

    </ul>
</div>