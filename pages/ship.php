<?php session_start();
	if(empty($_SESSION['id'])):
	header('Location:../index.php');
	endif;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Customer | <?php include('../dist/includes/title.php');?></title>
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
          <section class="content-header">
          <h1><a class="btn btn-lg btn-warning" href="home.php">Back</a></h1>
          <ol class="breadcrumb">
          	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Customer</li>
          </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
	        	<div class="col-xs-12">
	              <div class="box box-primary">
                    <div class="box-header">
                  	<h3 class="box-title">Shipment List</h3>
                	</div><!-- /.box-header -->
                  <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
   					<th>Order NO #</th>   					
                    <th>eBay Name</th>
                    <th>PayPal Mail</th>
                    <th>Address</th>
   					<th>S-Cost(TK)</th>
                    <th>Invoice</th>
                    <th>Status</th>
   					<th>Action</th>
				  </tr>
                  </thead>
                  
                  <tbody>
				  <?php
					$branch=$_SESSION['branch'];
					$query=mysqli_query($con,"select * from sales left join payment on sales.sales_id = payment.sales_id left join customer on payment.cust_id = customer.cust_id where payment.branch_id = '$branch'")or die(mysqli_error($con));
					$i=1;
					while($row=mysqli_fetch_array($query)){
						$cid=$row['cust_id'];
						$sid=$row['sales_id'];
				  ?>
                  
                  <tr>
					<td><?php echo $row['or_no'];?></td>
					<td><?php echo $row['cust_ebay_name'];?></td>
                    <td><?php echo $row['cust_paypal_name'];?></td>
                    <td><?php echo $row['shipping_address'];?></td>
					<td><?php echo number_format($row['ship_cost'],2);?></td>
					<td><?php echo $row['invcode'];?></td>
            		<td><?php 
							if ($row['ship_file']=='NULL')
								echo "<span class='label label-danger'>Awating</span>";
							else if ($row['ship_cost']=='0.00') 
								echo "<span class='label label-info'>shipping</span>";
							else if ($row['invcode']=='0') 
								echo "<span class='label label-info'>shipping</span>";
							else
								echo "<span class='label label-info'>Approved</span>"
						?>
                    </td>
					<td><a href="<?php if ($row['ship_cost']>'0.00') echo "account_summary.php?cid=$cid&sid=$sid";?>"><i class="glyphicon glyphicon-share-alt text-green"></i></a>
                    	<a href="#updateordinance<?php echo $row['payment_id'];?>" data-target="#updateordinance<?php echo $row['payment_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a></td>
                  </tr>
				  <div id="updateordinance<?php echo $row['payment_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				  <div class="modal-dialog">
				  <div class="modal-content" style="height:auto"><!-- ./modal-content-->
            	  <div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  	<span aria-hidden="true">×</span></button>
                	<h4 class="modal-title">Update Order Slip</h4>
              	  </div>
              	  <div class="modal-body"><!-- ./modal-body-->
				  <form class="form-horizontal" method="post" action="ship_update.php" enctype='multipart/form-data'>
                
                	<div class="form-group">
						<label class="control-label col-lg-3" for="name">Order No</label>
						<div class="col-lg-9">
           			    <input type="hidden" class="form-control" id="sid" name="sid" value="<?php echo $row['sales_id'];?>" required>  
						<input type="text" class="form-control" id="or_no" name="or_no" value="<?php echo $row['or_no'];?>" readonly>  
						</div>
					</div>
                    
                    <div class="form-group">
						<label class="control-label col-lg-3" for="price">Shipping Slip</label>
						<div class="col-lg-9">
						<input type="hidden" class="form-control" id="slip" name="image1" value="<?php echo $row['cust_pic'];?>" required> 
						<input type="file" class="form-control" id="slip" name="image" required>  
						</div>
			  		</div>				
                
	               <div class="form-group">
						<label class="control-label col-lg-3" for="cost">Shipping Cost</label>
						<div class="col-lg-9">
						<input type="text" class="form-control" id="cost" name="cost" placeholder="00.00" required> 
						</div>
			  		</div>
                    
                    <div class="form-group">
						<label class="control-label col-lg-3" for="name">Shipping Invoice</label>
						<div class="col-lg-9">
						<input type="text" class="form-control pull-right" id="datepicker" name="sdate" placeholder="YYYY-MM-DD-0" required>  
						</div>
					</div>	 
                                    
                   
			      </div><!-- ./modal-body end --><br><br><br><hr>
                  
              	  <div class="modal-footer">
					<button type="submit" class="btn btn-primary">Save changes</button>
            	    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             	  </div>
			 	  </form>
            	  </div><!-- ./modal-content end-->
			      </div><!--end of modal-dialog-->
 				  </div><!--end of modal-->   	  
                 	<?php $i++;}?>					  
                  </tbody>
                  
                  <!--<tfoot>//USE OPTIONAL
                  <tr>
                  	<th>#</th>
					<th>Picture</th>
                    <th>Customer Last Name</th>
                    <th>Customer First Name</th>
                    <th>Address</th>
  					<th>Contact #</th>
  					<th>Balance</th>
                    <th>Credit Status</th>
  					<th>Status</th>
                    <th>Action</th>
                  </tr>					  
                  </tfoot>-->
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.box-primery -->
          </div><!-- /.col -->
 		</div><!-- /.row -->      
	 </section><!-- /.content -->
    </div><!-- /.container -->
   </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
  </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
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
    <!--<script src="../dist/js/demo.js"></script>-->
    
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
