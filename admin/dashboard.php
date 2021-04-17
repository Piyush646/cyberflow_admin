<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left_navbar.php';

//fetching team members
$sql = "select count(id) as count from team";
$res = $conn->query($sql);
$idCount = $res->fetch_assoc();


//fetching testimonials
$sql2 = "select count(id) as count from testimonials";
$res2 = $conn->query($sql2);
$idCount2 = $res2->fetch_assoc();


//fetching portfolio
$sql3 = "select count(id) as count from portfolio";
$res3 = $conn->query($sql3);
$idCount3 = $res3->fetch_assoc();

//fetching
$sql4 = "select * from getintouch limit 4";
$res4 = $conn->query($sql4);
if ($res4->num_rows) {
    while ($row = $res4->fetch_assoc()) {
        $touch[] = $row;
    }
}

//fetching
$sql5 = "select * from recruitment limit 4";
$res5 = $conn->query($sql5);
if ($res5->num_rows) {
    while ($row = $res5->fetch_assoc()) {
        $recruit[] = $row;
    }
}
echo ($touch);
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<style>
    .box-body {
        overflow: auto !important;
    }
</style>
<!-- Content Wrapper. Contains page content -->

<div class="page-wrapper">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
        //   title: 'My Daily Activities',
          pieHole: 0.5,
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart5'));
        chart.draw(data, options);
      }
    </script>
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card-deck flex-column flex-lg-row">
                        <div class="card radius-15 bg-info" style="border-radius: 20px;">
                            <a href="team.php">
                                <div class="card-body text-center">
                                    <div class="widgets-icons mx-auto rounded-circle bg-white"><i class="fadeIn animated bx bx-group"></i>
                                    </div>
                                    <h4 class="mb-0 font-weight-bold mt-3 text-white"><?= $idCount['count'] ?></h4>
                                    <h6 style="margin-top:8px;" class="mb-0 text-white">Team </h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card-deck flex-column flex-lg-row">
                        <div class="card radius-15 bg-success" style="border-radius: 20px;">
                            <a href="testimonials.php">
                                <div class="card-body text-center">
                                    <div class="widgets-icons mx-auto bg-white rounded-circle"><i class="fadeIn animated bx bx-clipboard"></i>
                                    </div>
                                    <h4 class="mb-0 font-weight-bold mt-3 text-white"><?= $idCount2['count'] ?></h4>
                                    <h6 style="margin-top:8px;" class="mb-0 text-white">Testimonials</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card-deck flex-column flex-lg-row">
                        <div class="card radius-15 bg-primary" style="border-radius: 20px;">
                            <a href="portfolio.php">
                                <div class="card-body text-center">
                                    <div class="widgets-icons mx-auto bg-white rounded-circle"><i class="fadeIn animated bx bx-folder-plus"></i>
                                    </div>
                                    <h4 class="mb-0 font-weight-bold mt-3 text-white"><?= $idCount3['count'] ?></h4>
                                    <h6 style="margin-top:8px;" class="mb-0 text-white">Portfolio</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card-deck flex-column flex-lg-row">
                        <div class="card radius-15 bg-rose" style="border-radius: 20px;">
                            <a href="portfolio.php">
                                <div class="card-body text-center">
                                    <div class="widgets-icons mx-auto bg-white rounded-circle"><i class="fadeIn animated bx bx-folder-plus"></i>
                                    </div>
                                    <h4 class="mb-0 font-weight-bold mt-3 text-white">5</h4>
                                    <h6 style="margin-top:8px;" class="mb-0 text-white">Get In Touch</h6>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- <div class="col-6 col-lg-12 col-xl-6">
                            <div class="card-deck flex-column flex-lg-row">
                                <div class="card radius-15 bg-danger" style="border-radius: 20px;">
                                    <a href="appointments?token=3">
                                        <div class="card-body text-center">
                                            <div class="widgets-icons mx-auto rounded-circle bg-white"><i class="bx bx-loader-circle"></i>
                                            </div>
                                            <h4 class="mb-0 font-weight-bold mt-3 text-white">1</h4>
                                            <p class="mb-0 text-white">Pending Appointments</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="card radius-15 bg-primary" style="border-radius: 20px;">
                                    <a href="appointments?token=5">
                                        <div class="card-body text-center">
                                            <div class="widgets-icons mx-auto bg-white rounded-circle"><i class="fadeIn animated bx bx-x"></i>
                                            </div>
                                            <h4 class="mb-0 font-weight-bold mt-3 text-white">0</h4>
                                            <p class="mb-0 text-white">Cancelled Appointments</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="card radius-15 bg-success" style="border-radius: 20px;">
                                    <a href="appointments?token=6">
                                        <div class="card-body text-center">
                                            <div class="widgets-icons mx-auto bg-white rounded-circle"><i class="bx bx-save"></i>
                                            </div>
                                            <h4 class="mb-0 font-weight-bold mt-3 text-white">0</h4>
                                            <p class="mb-0 text-white">Today's Appointments</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div> -->

            </div>
            <div class="row">
                <div class="card radius-15 col-7 col-lg-7 col-md-7" style="
    margin-right: 25px;
">
                    <div class="card-header border-bottom-0">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-0">Get In Touch</h5>
                            </div>
                            <div class="ml-auto">
                                <a href="getInTouch.php" class="btn btn-white radius-15">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <!-- <th>S.No</th> -->
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($touch)) {
                                        $i = 1;
                                        foreach ($touch as $t) {
                                    ?>
                                            <tr>
                                                <!-- <th scope="row"><?= $i ?></th> -->
                                                <td id="name<?= $i ?>"><?= $t['name'] ?></td>
                                                <td id="position<?= $i ?>"><?= $t['email'] ?></td>

                                                <td id="sort_order<?= $i ?>"><?= $t['phn'] ?></td>
                                                <td id="sort_order<?= $i ?>"><?= $t['message'] ?></td>

                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>



                            </table><br>
                        </div>
                    </div>


                </div>


                <!--Pie chart 1-->
                <div class="card radius-15 col-4 col-lg-4 col-md-4">
                    <!-- <div class="card-body" style="position: relative;"> -->
                        <div class="d-lg-flex align-items-center"><br>
                            <div>
                                <h5 class="mb-4">Devices of Visitors</h5>
                            </div>
                        </div>
                        <div id="chart5" class="col-12 col-lg-12 col-md-12" >
                             <!--style="width: 300px; height: 350px;"
                        
                             <div id="apexchartsz5ttgghvh" class="apexcharts-canvas apexchartsz5ttgghvh apexcharts-theme-light" style="width: 741px; height: 240.7px;">
                            <svg id="SvgjsSvg3095" width="741" height="240.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                    <g id="SvgjsG3097" class="apexcharts-inner apexcharts-graphical" transform="translate(263.5, 0)">
                                        <defs id="SvgjsDefs3096">
                                            <clipPath id="gridRectMaskz5ttgghvh">
                                                <rect id="SvgjsRect3099" width="100" height="100" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMaskz5ttgghvh">
                                                <rect id="SvgjsRect3100" width="120" height="120" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                        </defs>
                                        <g id="SvgjsG3102" class="apexcharts-pie">
                                            <g id="SvgjsG3103" transform="translate(0, 0) scale(1)">
                                                <circle id="SvgjsCircle3104" r="30.0780487804878" cx="108" cy="119" fill="transparent"></circle>
                                                <g id="SvgjsG3105" class="apexcharts-slices">
                                                    <g id="SvgjsG3106" class="apexcharts-series apexcharts-pie-series" seriesName="Mobile" rel="1" data:realIndex="0">
                                                        <path id="SvgjsPath3107" d="M 108 8.902439024390233 A 110.09756097560977 110.09756097560977 0 0 1 218.09756097560978 119 L 196.0780487804878 119 A 88.0780487804878 88.0780487804878 0 0 0 108 30.921951219512195 L 108 8.902439024390233 z" fill="rgba(240,39,105,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="90" data:startAngle="0" data:strokeWidth="2" data:value="25" data:pathOrig="M 108 8.902439024390233 A 110.09756097560977 110.09756097560977 0 0 1 218.09756097560978 119 L 196.0780487804878 119 A 88.0780487804878 88.0780487804878 0 0 0 108 30.921951219512195 L 108 8.902439024390233 z" stroke="#ffffff"></path>
                                                    </g>
                                                    <g id="SvgjsG3108" class="apexcharts-series apexcharts-pie-series" seriesName="Desktop" rel="2" data:realIndex="1">
                                                        <path id="SvgjsPath3109" d="M 218.09756097560978 119 A 110.09756097560977 110.09756097560977 0 1 1 43.28627734516526 29.929202131499693 L 56.22902187613221 47.74336170519976 A 88.0780487804878 88.0780487804878 0 1 0 196.0780487804878 119 L 218.09756097560978 119 z" fill="rgba(103,58,183,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="234" data:startAngle="90" data:strokeWidth="2" data:value="65" data:pathOrig="M 218.09756097560978 119 A 110.09756097560977 110.09756097560977 0 1 1 43.28627734516526 29.929202131499693 L 56.22902187613221 47.74336170519976 A 88.0780487804878 88.0780487804878 0 1 0 196.0780487804878 119 L 218.09756097560978 119 z" stroke="#ffffff"></path>
                                                    </g>
                                                    <g id="SvgjsG3110" class="apexcharts-series apexcharts-pie-series" seriesName="Tablet" rel="3" data:realIndex="2">
                                                        <path id="SvgjsPath3111" d="M 43.28627734516526 29.929202131499693 A 110.09756097560977 110.09756097560977 0 0 1 107.98078435072314 8.90244070127197 L 107.98462748057851 30.92195256101759 A 88.0780487804878 88.0780487804878 0 0 0 56.22902187613221 47.74336170519976 L 43.28627734516526 29.929202131499693 z" fill="rgba(255,193,7,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="36" data:startAngle="324" data:strokeWidth="2" data:value="10" data:pathOrig="M 43.28627734516526 29.929202131499693 A 110.09756097560977 110.09756097560977 0 0 1 107.98078435072314 8.90244070127197 L 107.98462748057851 30.92195256101759 A 88.0780487804878 88.0780487804878 0 0 0 56.22902187613221 47.74336170519976 L 43.28627734516526 29.929202131499693 z" stroke="#ffffff"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                        <line id="SvgjsLine3112" x1="0" y1="0" x2="216" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine3113" x1="0" y1="0" x2="216" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                    </g>
                                    <g id="SvgjsG3098" class="apexcharts-annotations"></g>
                                </svg>
                                <div class="apexcharts-legend"></div>
                                <div class="apexcharts-tooltip apexcharts-theme-dark" style="left: 308.305px; top: 3px;">
                                     <div class="apexcharts-tooltip-series-group apexcharts-active" style="display: flex; background-color: rgb(240, 39, 105);"><span class="apexcharts-tooltip-marker" style="background-color: rgb(240, 39, 105); display: none;"></span>
                                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Mobile: </span><span class="apexcharts-tooltip-text-value">25</span></div>
                                            <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div> 
                                    <div class="apexcharts-tooltip-series-group" style="display: none; background-color: rgb(240, 39, 105);"><span class="apexcharts-tooltip-marker" style="background-color: rgb(240, 39, 105); display: none;"></span>
                                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Mobile: </span><span class="apexcharts-tooltip-text-value">25</span></div>
                                            <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                    <div class="apexcharts-tooltip-series-group" style="display: none; background-color: rgb(240, 39, 105);"><span class="apexcharts-tooltip-marker" style="background-color: rgb(240, 39, 105); display: none;"></span>
                                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Mobile: </span><span class="apexcharts-tooltip-text-value">25</span></div>
                                            <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="resize-triggers">
                            <!-- <div class="expand-trigger">
                                 <div style="width: 782px; height: 330px;"></div> 
                            </div> -->
                            <div class="contract-trigger"></div>
                        </div>
                    <!-- </div> -->
                    <ul class="list-group list-group-flush mb-0">
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Mobile<span class="badge badge-danger badge-pill">25%</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Desktop<span class="badge badge-primary badge-pill">65%</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Tablet<span class="badge badge-warning badge-pill">10%</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="card radius-15 col-7 col-lg-7 col-md-7" style="
    margin-right: 25px;
">
                    <div class="card-header border-bottom-0">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-0">Recruitment</h5>
                            </div>
                            <div class="ml-auto">
                                <a href="recruitment.php" class="btn btn-white radius-15">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <!-- <th>S.No</th> -->
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Specialisation</th>
                                        <th>Resume</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($recruit)) {
                                        $i = 1;
                                        foreach ($recruit as $r) {
                                    ?>
                                            <tr>
                                                <!-- <th scope="row"><?= $i ?></th> -->
                                                <td id="name<?= $i ?>"><?= $r['name'] ?></td>
                                                <td id="position<?= $i ?>"><?= $r['email'] ?></td>

                                                <td id="sort_order<?= $i ?>"><?= $r['specialisation'] ?></td>
                                                <td id="sort_order<?= $i ?>"><a href="./uploads/<?= $r['resume'] ?>" target="_blank"><?= $r['resume'] ?></a></td>

                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>



                            </table><br>
                        </div>
                    </div>
                </div>
                                <!--Pie chart 1-->
                                <div class="card radius-15 col-4 col-lg-4 col-md-4">
                    <div class="card-body" style="position: relative;">
                        <div class="d-lg-flex align-items-center">
                            <div>
                                <h5 class="mb-4">Devices of Visitors</h5>
                            </div>
                        </div>
                        <div id="chart5" style="min-height: 30px;">
                            <!-- <div id="apexchartsz5ttgghvh" class="apexcharts-canvas apexchartsz5ttgghvh apexcharts-theme-light" style="width: 741px; height: 240.7px;">
                            <svg id="SvgjsSvg3095" width="741" height="240.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                    <g id="SvgjsG3097" class="apexcharts-inner apexcharts-graphical" transform="translate(263.5, 0)">
                                        <defs id="SvgjsDefs3096">
                                            <clipPath id="gridRectMaskz5ttgghvh">
                                                <rect id="SvgjsRect3099" width="100" height="100" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMaskz5ttgghvh">
                                                <rect id="SvgjsRect3100" width="120" height="120" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                        </defs>
                                        <g id="SvgjsG3102" class="apexcharts-pie">
                                            <g id="SvgjsG3103" transform="translate(0, 0) scale(1)">
                                                <circle id="SvgjsCircle3104" r="30.0780487804878" cx="108" cy="119" fill="transparent"></circle>
                                                <g id="SvgjsG3105" class="apexcharts-slices">
                                                    <g id="SvgjsG3106" class="apexcharts-series apexcharts-pie-series" seriesName="Mobile" rel="1" data:realIndex="0">
                                                        <path id="SvgjsPath3107" d="M 108 8.902439024390233 A 110.09756097560977 110.09756097560977 0 0 1 218.09756097560978 119 L 196.0780487804878 119 A 88.0780487804878 88.0780487804878 0 0 0 108 30.921951219512195 L 108 8.902439024390233 z" fill="rgba(240,39,105,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="90" data:startAngle="0" data:strokeWidth="2" data:value="25" data:pathOrig="M 108 8.902439024390233 A 110.09756097560977 110.09756097560977 0 0 1 218.09756097560978 119 L 196.0780487804878 119 A 88.0780487804878 88.0780487804878 0 0 0 108 30.921951219512195 L 108 8.902439024390233 z" stroke="#ffffff"></path>
                                                    </g>
                                                    <g id="SvgjsG3108" class="apexcharts-series apexcharts-pie-series" seriesName="Desktop" rel="2" data:realIndex="1">
                                                        <path id="SvgjsPath3109" d="M 218.09756097560978 119 A 110.09756097560977 110.09756097560977 0 1 1 43.28627734516526 29.929202131499693 L 56.22902187613221 47.74336170519976 A 88.0780487804878 88.0780487804878 0 1 0 196.0780487804878 119 L 218.09756097560978 119 z" fill="rgba(103,58,183,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="234" data:startAngle="90" data:strokeWidth="2" data:value="65" data:pathOrig="M 218.09756097560978 119 A 110.09756097560977 110.09756097560977 0 1 1 43.28627734516526 29.929202131499693 L 56.22902187613221 47.74336170519976 A 88.0780487804878 88.0780487804878 0 1 0 196.0780487804878 119 L 218.09756097560978 119 z" stroke="#ffffff"></path>
                                                    </g>
                                                    <g id="SvgjsG3110" class="apexcharts-series apexcharts-pie-series" seriesName="Tablet" rel="3" data:realIndex="2">
                                                        <path id="SvgjsPath3111" d="M 43.28627734516526 29.929202131499693 A 110.09756097560977 110.09756097560977 0 0 1 107.98078435072314 8.90244070127197 L 107.98462748057851 30.92195256101759 A 88.0780487804878 88.0780487804878 0 0 0 56.22902187613221 47.74336170519976 L 43.28627734516526 29.929202131499693 z" fill="rgba(255,193,7,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="36" data:startAngle="324" data:strokeWidth="2" data:value="10" data:pathOrig="M 43.28627734516526 29.929202131499693 A 110.09756097560977 110.09756097560977 0 0 1 107.98078435072314 8.90244070127197 L 107.98462748057851 30.92195256101759 A 88.0780487804878 88.0780487804878 0 0 0 56.22902187613221 47.74336170519976 L 43.28627734516526 29.929202131499693 z" stroke="#ffffff"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                        <line id="SvgjsLine3112" x1="0" y1="0" x2="216" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine3113" x1="0" y1="0" x2="216" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                    </g>
                                    <g id="SvgjsG3098" class="apexcharts-annotations"></g>
                                </svg>
                                <div class="apexcharts-legend"></div>
                                <div class="apexcharts-tooltip apexcharts-theme-dark" style="left: 308.305px; top: 3px;">
                                     <div class="apexcharts-tooltip-series-group apexcharts-active" style="display: flex; background-color: rgb(240, 39, 105);"><span class="apexcharts-tooltip-marker" style="background-color: rgb(240, 39, 105); display: none;"></span>
                                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Mobile: </span><span class="apexcharts-tooltip-text-value">25</span></div>
                                            <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div> 
                                    <div class="apexcharts-tooltip-series-group" style="display: none; background-color: rgb(240, 39, 105);"><span class="apexcharts-tooltip-marker" style="background-color: rgb(240, 39, 105); display: none;"></span>
                                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Mobile: </span><span class="apexcharts-tooltip-text-value">25</span></div>
                                            <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                    <div class="apexcharts-tooltip-series-group" style="display: none; background-color: rgb(240, 39, 105);"><span class="apexcharts-tooltip-marker" style="background-color: rgb(240, 39, 105); display: none;"></span>
                                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Mobile: </span><span class="apexcharts-tooltip-text-value">25</span></div>
                                            <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="resize-triggers">
                            <!-- <div class="expand-trigger">
                                 <div style="width: 782px; height: 330px;"></div> 
                            </div> -->
                            <div class="contract-trigger"></div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush mb-0">
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Sessions<span class="badge badge-danger badge-pill">25%</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Visitors<span class="badge badge-primary badge-pill">65%</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Page Views<span class="badge badge-warning badge-pill">10%</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="control-sidebar-bg"></div>
<?php
require_once 'js_links.php';
require_once 'footer.php';

?>