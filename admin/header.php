<?php

ob_start();
require_once '../lib/core.php';


$id = $_SESSION['id'];
if (!admin_auth()) {

  header("location: logout.php");
}



//fetching
$sql="select * from web_config";
$res= $conn->query($sql);
if($res->num_rows > 0)
{
    $config=$res->fetch_assoc();
}
?>
<!doctype html>
<html lang="en">



<head>
<style>


.col-md-1
{
	margin-top:2vh !important;
}
.custom-control-input:focus:not(:checked) ~ .custom-control-label::before {
    border-color: #1fcecb !important;
	box-shadow:0 0 0 0.05rem #1fcecb !important;
}


.custom-control-input:checked ~ .custom-control-label::before {
    color: #fff !important;
    border-color: #1fcecb !important;
	background-color:#1fcecb !important; 
    box-shadow:0 0 0 0.05rem #1fcecb !important;
}



.btn-primary
{
	background-color:#1fcecb !important;
	border-color:#1fcecb !important;
  box-shadow:0 0 0 0.05rem #1fcecb !important;
}
.bx-home-alt
{
	color:#1fcecb;
}
	 .form-control:focus{
  border-color:#1fcecb !important;
  box-shadow:0 0 0 0.05rem #1fcecb !important;
}


.sidebar-wrapper .metismenu a:hover, .sidebar-wrapper .metismenu a:focus, .sidebar-wrapper .metismenu a:active, .sidebar-wrapper .metismenu .mm-active>a {
    color: #1fcecb !important;
    text-decoration: none !important;
    background: rgb(103 58 183 / 10%) !important;
}
</style>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>CyberFlow</title>
	<!--favicon-->
	<link rel="icon" href="<?=$config['logo']?>"></link>
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&amp;family=Roboto&amp;display=swap" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="assets/css/app.css" />
	<link rel="stylesheet" href="assets/css/dark-sidebar.css" />
	<link rel="stylesheet" href="assets/css/dark-theme.css" />
	<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
</head>
<body>

<div class="wrapper">
<!--sidebar-wrapper-->

 