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
$rtp =mysqli_query($con ,"SELECT AdminStatus from tbladmapplications where UserID='$uid'");
$row=mysqli_fetch_array($rtp);
$adsts=$row['AdminStatus'];
if($row>0){

?>

        <div class="row" >
          <div class="col-xl-10 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                   <a href="admission-form.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">



<?php if($adsts==1) {?>
                      <h4 align="center">Your Application has been  selected</h4>
                    <?php } ?>

                    <?php if($adsts==2) {?>
                      <h4 align="center">Your Application has been  rejected</h4>
                    <?php } ?>
<?php if($adsts=="") {?>
                      <h4 align="center">Your Application has been pending with admin for review</h4>
                    <?php } ?>

                    </div>
                    <div>
         <i class="icon-file success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">

                    <?php if($adsts=="") {?>
                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div> <?php } ?>
                          <?php if($adsts=="2") {?>
                    <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div> <?php } ?>
 <?php if($adsts=="1") {?>
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div> <?php } ?>

                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>
        </div>
<?php } else{?>
     
        <div class="row" >
          <div class="col-xl-10 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                   <a href="admission-form.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h4 align="center">You have not applied for admission. Please fill the admission form.</h4>
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
    <?php } ?>
<?php 
$rtp =mysqli_query($con ,"SELECT payment_ID from tblpayments where UserID='$uid'");
$row=mysqli_fetch_array($rtp);
if($row>0){ ?>
<div class="row" >
          <div class="col-xl-10 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                   <a href="print.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">

                      <h4 align="center">You have completed all the steps for admission</h4>
                  

                    </div>
                    <div>
         <i class="icon-file success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>

                  </div>
                </div>
              </a>
              </div>
            </div>
          </div></div>
<?php }?>        


<?php 
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

if($num>0  )
{ ?>

        <div class="row" >
          <div class="col-xl-10 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                   <a href="admission-form.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">




                      <h4 align="center">Your Application has been  selected and documents also uploaded please proceed with payment</h4>
       


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
			  <form action="<?php echo $paypal_url; ?>" method="post">			
			<!-- Paypal business test account email id so that you can collect the payments. -->
			<input type="hidden" name="business" value="<?php echo $paypal_email; ?>">			
			<!-- Buy Now button. -->
			<input type="hidden" name="cmd" value="_xclick">			
			<!-- Details about the item that buyers will purchase. -->
			<input type="hidden" name="item_name" value="<?php echo $cname; ?>">
			<input type="hidden" name="item_number" value="<?php echo 1; ?>">
			<input type="hidden" name="amount" value="<?php echo $fee; ?>">
			<input type="hidden" name="currency_code" value="USD">			
			<!-- URLs -->
			<input type='hidden' name='cancel_return' value='http://localhost/paypal_integration_php/cancel.php'>
			<input type='hidden' name='return' value='http://localhost/sams2/user/success.php'>						
			<!-- payment button. -->
			<input type="image" name="submit" border="0" align="center"
			src="https://www.paypalobjects.com/webstatic/icon/pp32.png" alt="PayPal - The safer, easier way to pay online"> This is for testing purposes only
			<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >    
			</form>
              </div>
            </div>
          </div>
        </div>
		
         
<?php } else if ($adsts==1){?>
     
 <div class="row" >
          <div class="col-xl-10 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                   <a href="upload-doc.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">

                      <h4 align="center">Your Application has been  selected. Please Upload your documents</h4>
                  

                    </div>
                    <div>
         <i class="icon-file success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>

                  </div>
                </div>
              </a>
              </div>
            </div>
          </div></div>
        <?php }  }
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