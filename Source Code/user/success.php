<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['uid'])==0){
header('location:logout.php');
} else {
	$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
$paypal_email ='sb-wzlda6377784@business.example.com';

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>Student Admission Management System | Dashboard</title>
 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/morris.css">
  <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <!-- fixed-top-->
   <?php include_once('includes/header.php');?>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
 <?php include_once('includes/leftbar.php');?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!-- Revenue, Hit Rate & Deals -->
                         <?php
$uid=$_SESSION['uid'];
$ret=mysqli_query($con,"select FirstName from tbluser where ID='$uid'");
$row=mysqli_fetch_array($ret);
$name=$row['FirstName'];

?>
<h3><font color="red">Welcome Back :</font> <?php echo $name;?> </h3>
<hr />

<?php 
$uid=$_SESSION['uid'];


$rtp =mysqli_query($con ,"SELECT ID from tbladmapplications where UserID='$uid' and paymentstatus='Unpaid'");
$row=mysqli_fetch_array($rtp);
if($row>0){
$ret=mysqli_query($con,"select AdminStatus from  tbladmapplications join tbldocument on tbldocument.UserID=tbladmapplications.UserID where tbldocument.UserID='$uid' and  tbladmapplications.AdminStatus='1'");
$num=mysqli_fetch_array($ret);
$ret1=mysqli_query($con,"SELECT tblcourse.ID,tblcourse.Admfees,tblcourse.Coursename FROM tbladmapplications join tblcourse on tbladmapplications.CourseID=tblcourse.ID WHERE tbladmapplications.UserId = '$uid'");
$row1=mysqli_fetch_array($ret1);
$fee=$row1['Admfees'];
$cname=$row1['Coursename'];
$cid=$row1['ID'];
$txn_id =  uniqid('pyp');
$qt=mysqli_query($con, "INSERT INTO tblpayments(userID,item_number,txn_id,payment_gross,currency_code,payment_status) VALUES('$uid','$cid','$txn_id','$fee','USD','Success')");
if($qt)
{
mysqli_query($con,"update tbladmapplications set Paymentstatus='Paid' where ID='$uid'");	
}
if($num>0  )
{ ?>

        <div class="row" >
          <div class="col-xl-10 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                   <a href="dashboard.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">




                      <h4 align="center">Payment successful. Click to return to dashboard</h4>
       


                    </div>
                    <div>
         <i class="icon-file success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">

                 
                    <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>


                  </div>
                </div>
              </a>
			
              </div>
            </div>
          </div>
        </div>
		
         
<?php }?>
        <?php }  
         ?>

        
        </div>
       </div></div></div>
<?php include('includes/footer.php');?>
  <!-- BEGIN VENDOR JS-->
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"
  type="text/javascript"></script>
  <script src="app-assets/data/jvector/visitor-data.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="app-assets/js/scripts/pages/dashboard-sales.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>
<?php } ?>