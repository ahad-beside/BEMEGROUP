<?php 
	session_start();
	if(empty($_SESSION['id'])):
	header('Location:../index.php');
	endif;
	if(empty($_SESSION['branch'])):
	header('Location:../index.php');
	endif;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home | <?php include('../dist/includes/title.php');?></title>
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    
     <!-- PAGE progress bar -->
	<script src="../dist/js/nprogress.js"></script>
	<script>
        NProgress.start();
	</script>

    <style>.col-lg-3{margin:50px 0px;}</style>

 </head>
 
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav" onLoad="myFunction()">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
        <!-- Content Header (Page header) -->
        
          <!-- Main content -->
          <section class="content">
          <div class="row"><!-- ./row -->
	      <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Transactions</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                      
                      <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                          <div class="inner">
                            <h3>Purchase</h3>
                            <p>For PayPal</p>
                          </div>
                          <div class="icon" style="margin-top:10px">
                            <i class="glyphicon glyphicon-user"></i>
                          </div>
                          <a href="cust_new.php" class="small-box-footer">
                            Go <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div><!-- ./col -->

                      <div class="col-lg-4 col-xs-6">
                       <!-- small box -->
                        <div class="small-box bg-orange">
                          <div class="inner">
                            <h3>Scheduled</h3>
                            <p>Add/View</p>
                          </div>
                          <div class="icon" style="margin-top:10px">
                            <i class="glyphicon glyphicon-shopping-cart"></i>
                          </div>
                          <a href="scheduled.php" class="small-box-footer">
                            Go <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
		         	  </div><!-- ./col -->
                      
                      <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                          <div class="inner">
                            <h3>Shipment</h3>
                            <p>Shipping Reset</p>
                          </div>
                          <div class="icon" style="margin-top:10px">
                          <!--<i class="ion-android-mail"></i>-->
                          <i class="glyphicon glyphicon-refresh"></i>
                          </div>
                          <a href="ship.php" class="small-box-footer">
                            Go <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div><!-- ./col -->
                      
                      <div class="col-lg-4 col-xs-6">
                       <!-- small box -->
                        <div class="small-box bg-red">
                          <div class="inner">
                            <h3>Invoice</h3>
                            <p>Add Invoice/View</p>
                          </div>
                          <div class="icon" style="margin-top:10px">
                            <i class="glyphicon glyphicon-usd"></i>
                          </div>
                          <a href="invoice.php" class="small-box-footer">
                            Go <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div><!-- ./col -->
                      
                       <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                          <div class="inner">
                            <h3>Handling</h3>
                            <p>Add user/View</p>
                          </div>
                          <div class="icon" style="margin-top:10px">
                            <i class="glyphicon glyphicon-user"></i>
                          </div>
                          <a href="handler.php" class="small-box-footer">
                            Go <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div><!-- ./col -->
                      
                      <div class="col-lg-4 col-xs-6">
                       <!-- small box -->
                        <div class="small-box bg-orange">
                          <div class="inner">
                            <h3>Product</h3>
                            <p>Add/View</p>
                          </div>
                          <div class="icon" style="margin-top:10px">
                            <i class="glyphicon glyphicon-shopping-cart"></i>
                          </div>
                          <a href="product.php" class="small-box-footer">
                            Go <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
		         	  </div><!-- ./col -->
                      
                      
                      <div class="col-lg-4 col-xs-6">
                      <!-- small box -->
                        <div class="small-box bg-red">
                          <div class="inner">
                            <h3>Stockin</h3>
                            <p>Products</p>
                          </div>
                          <div class="icon" style="margin-top:10px">
                            <i class="glyphicon glyphicon-share-alt"></i>
                          </div>
                          <a href="stockin.php" class="small-box-footer">
                            Go <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div><!-- ./col -->  
                      
                       		  
                  </div><!--row-->
                </div><!-- /.box-body -->
                
          </div><!-- /.box -->
          </div><!-- /.col (right) -->
            
          <div class="col-md-4">
          <!-- About Me Box -->
          <div class="box box-primary"><!-- ./ box -->
          	<div class="box-header with-border">
          		<h3 class="box-title">About Us</h3>
	        </div><!-- /.box-header -->
		    <?php
    			$branch=$_SESSION['branch'];
			    $query=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());
			    $row=mysqli_fetch_array($query);
      		?>
            <div class="box-body">
            <strong><i class="glyphicon glyphicon-map-marker margin-r-5"></i> eBay Address</strong>
            <p class="text-muted"><?php echo $row['ebay_address'];?></p><hr>
            <strong><i class="glyphicon glyphicon-phone-alt margin-r-5"></i> eBay Mail</strong>
            <p class="text-muted"><?php echo $row['ebay_mail'];?></p><hr>
            <strong><i class="glyphicon glyphicon-phone-alt margin-r-5"></i> PayPal Mail</strong>
            <p class="text-muted"><?php echo $row['paypal_mail'];?></p><hr>
            <strong><i class="glyphicon glyphicon-user margin-r-5"></i> Auctiva username</strong>
            <p class="text-muted"><?php echo $row['auctiva_name'];?></p><hr>
            </div><!-- /.box-body end-->
          </div><!-- /.box end-->
          </div><!-- /.col-->   
		  </div><!-- /.row end-->
	      </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->
	
	<script type="text/javascript" src="autosum.js"></script>
  
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="../dist/js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/select2/select2.full.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    
  </body>
</html>
