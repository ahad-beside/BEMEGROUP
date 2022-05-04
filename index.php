<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
   	<title>Login - <?php include('dist/includes/title.php');?></title>
    <link rel="shortcut icon" href="dist/img/calculator.png">
    
    <!--  Bootstrap Style -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
    
    <!--  Font-Awesome Style -->
<!--<link href="dist/css/font-awesome.min.css" rel="stylesheet" />-->
    
    <!--  Animation Style -->
<!--    <link href="dist/css/animate.css" rel="stylesheet" />-->
    
    <!--  Pretty Photo Style -->
<!--    <link href="dist/css/prettyPhoto.css" rel="stylesheet" />-->
    
    <!--  Google Font Style -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <!--  Custom Style -->
    <link href="dist/css/style.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body style="background:url(dist/img/head1.jpg) no-repeat center center fixed;
		-webkit-background-size: cover !important;
		-moz-background-size: cover !important;
		-o-background-size: cover !important;
		background-size: cover !important;
	">
    <div id="pre-div">
        <div id="loader">
        </div>
    </div>
    <!--/. PRELOADER END -->
    
    <!--./ NAV BAR END -->
    <div id="home" ><!-- ./home -->
        <div class="overlay"><!-- ./overlay-->
            <div class="container"><!-- ./container-->
                <div class="span3"><!-- ./span3-->
				<div class="title_index">
					<div class="row-fluid"></div>
                </div>
                    <div class="col-lg-4 col-md-5">
 						<div class="div-trans text-center"> <!-- ./trans -->
						   <h3>Please Login</h3>
						   <br><br>
                           <div class="col-lg-12 col-md-12 col-sm-12" >
                           <form action="login.php" class="form-signin" method="post" role="form">
                                <div class="form-group">
                                    <input type="text" class="form-control input-md" name="username" id="username" placeholder="Username" required autofocus>
                                </div>
                                
                                <div class="form-group">
                                    <input type="password" class="form-control input-md" name="password" id="password" placeholder="Password" required>
                                </div>
                                
                                <div class="form-group">
					            	<select class="form-control select2" style="width:100%" name="branch" required>
				                	<?php
									   include('dist/includes/dbcon.php');
			                		   $query3=mysqli_query($con,"select * from branch order by ebay_name")or die(mysqli_error($con));
    	    			               while($row3=mysqli_fetch_array($query3)){
				                	?>
                			    	<option value="<?php echo $row3['branch_id'];?>"><?php echo $row3['ebay_name'];?></option>
				                  	<?php }?>
                					</select>
				          		</div>
                                
								<br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block" id="login" name="login">Login</button>
									<button type="reset" class="btn btn-warning btn-block">Clear</button>
                                </div>
	                       </form>
                           </div>	
						</div><!-- ./trans end -->
                    </div>
				</div><!-- ./span3 end-->

				<br><br><br><br><br>
				<div class="row-fluid">
					<div class="col-md-6 col-md-offset-1">
						<div class="span3"><img class="index_logo img-responsive" height="500" width="700" src="dist/img/head1.jpg"></div>
					</div>
                </div>
				
                <br><br><br><br><br><br><br><br><br><br><br><br><br>
				<div class="row-fluid">
					<div class="col-md-5 col-md-offset-1">
					<h4><span id=tick2></span>&nbsp;| 
				    	<?php
			            	$date = new DateTime();
	            			echo $date->format('l, F jS, Y');
				         ?>
                    <h4>
            	</div>
                
            </div><!-- ./container end-->
        </div><!-- ./overlay end-->
	</div><!-- ./home end-->
     	
    <div id="footser-end"><!-- ./footer -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                   <center>Copyright &copy; <?php echo date('Y');?> <a href="">Sales and Inventory with Credit Management System.</a></strong> All rights reserved.</center>
                </div>
            </div>
        </div>
    </div>
    <!--./ FOOTER SECTION END -->
    
    <!--  Jquery Core Script -->
    <script src="dist/js/jquery-1.10.2.js"></script>
    <!--  Core Bootstrap Script -->
    <script src="dist/js/bootstrap.js"></script>
    <!--  WOW Script -->
    <!--<script src="dist/js/wow.min.js"></script>-->
    <!--  Scrolling Script -->
    <!--<script src="dist/js/jquery.easing.min.js"></script>-->
    <!--  PrettyPhoto Script -->
    <!--  Custom Scripts -->
  	<script src="dist/js/custom.js"></script>
    <script src="dist/js/date_time.js"></script>
     
</body>
</html>
