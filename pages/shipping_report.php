<?php session_start();
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
    <title>Product Inventory Report | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    
	<style type="text/css">
    	h5,h6{
        	text-align:center;
      	}
		
		@media print {
        .btn-print {
        	display:none !important;
		}
		.main-footer	{
			display:none !important;
		}
		.box.box-primary {
			border-top:none !important;
		}
		}
    </style>
    
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php 
	  	include('../dist/includes/header.php');
	    include('../dist/includes/dbcon.php');
      ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
        <!-- Content Header (Page header) -->
         
          <!-- Main content -->
          <section class="content">
          <div class="row"><!-- ./row -->
	      	<div class="col-xs-12"><!-- ./ col -->
          		<div class="box box-primary">
				<div class="box-body"><!-- ./box-body-->
				<?php
					include('../dist/includes/dbcon.php');
					$branch=$_SESSION['branch'];
				    $query=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());
  			        $row=mysqli_fetch_array($query);
					
					$code1= date("Y-m-d");
					$inv="INV";
					$code2= ($inv."".$code1);
					
        		?>      
                  
        <h5 align="center"><b><?php echo $row['ebay_name'];?></b> </h5>  
        <h6 align="center">Address: <?php echo $row['ebay_address'];?></h6>
        <h6 align="center">Contact mail: <?php echo $row['ebay_mail'];?></h6>
        <h6 align="center"><b>Today, <?php echo date("M d, Y");?> <span id="tick2"></span></b></h6>
	  	<h5 align="center"><b>SHIPPING INVOICE <?php //echo"<img src = 'BCG/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=10&text=".$code2."&thickness=25&start=NULL&code=BCGcode128' />";?></b></h5>
        <a class = "btn btn-success btn-print" href = "receipt_inv.php" target="_blank"><i class ="glyphicon glyphicon-print"></i> Invoice print</a>
  		<a class = "btn btn-primary btn-print" href = "home.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Homepage</a>
					
                  <table class="table table-bordered table-striped">
                  <thead>
				  <tr>
					<th>Order No</th> 
                    <th>Shipping Address</th>
                    <th>Item(Qty)</th>         
                	<th>S-Cost(TK)</th>
            		<th style="text-align:center">Status</th>
                  </tr>
                  </thead>
                  
                  <tbody>
				  <?php
					$branch=$_SESSION['branch'];
					$query=mysqli_query($con,"select * from sales left join payment on sales.sales_id = payment.sales_id left join customer on payment.cust_id = customer.cust_id where sales.ship_cost = '0.00' and payment.branch_id='$branch'")or die(mysqli_error());
						
					while($row=mysqli_fetch_array($query)){
						$payment_id = $row['payment_id'];
						$total=$row['payment_paid'];
						$item_qty=$row['item_qty'];
						$cc=$row['ship_cost'];
						
						//$grand=$total;
			      ?>
                  <tr>
                  	<td><?php echo $row['or_no'];?></td>
                    <td><?php echo $row['shipping_address'];?></td>
                    <td><?php echo $row['item_qty'];?></td>
					<td><?php echo $row['ship_cost'];?></td>
					
					<td class="text-center"><?php if ( $cc='0.00')echo "<span class='badge bg-red'><i class='glyphicon glyphicon-refresh'></i>Shipping Reset</span>";?></td>
                  </tr>
				  <?php }?>					  
                  </tbody>
                  
                  <tfoot>
                  <tr>
                 	<th colspan="3"></th>
                    <th colspan="2"></th>
				  </tr>	
                  
                  <tr>
                  	<th colspan="5"></th>
                  </tr> 
                  
                  <tr>
                  	<th colspan="5">Prepared by:</th>
                  </tr> 
				
				<?php
				    $id=$_SESSION['id'];
				    $query=mysqli_query($con,"select * from user where user_id='$id'")or die(mysqli_error($con));
				    $row=mysqli_fetch_array($query);
 				?>                      
                  <tr>
                  	<th colspan="7"><?php echo $row['name'];?></th>
                  </tr>  				  
                  </tfoot>
                  
                  </table>
                </div><!-- /.box-body end-->
				</div><!-- /.box -->
                               
        
            </div><!-- /.col -->
          </div><!-- /.row -->

          </div><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    
    <!-- AdminLTE for demo purposes -->
	<!--<script src="../dist/js/demo.js"></script>-->

    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- date time -->
    <script src="../dist/js/date_time.js"></script>
    
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
