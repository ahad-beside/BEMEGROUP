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
    <title>Customer Account | <?php include('../dist/includes/title.php');?></title>
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
    <style>
    img.profile_pic {
    width: 152px;
    height: 125px;
    border: 5px solid #ccc;
	}
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');
      include('../dist/includes/dbcon.php');
      ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
        
          <?php
          if(isset($_REQUEST['cid']))
            {
              $cid=$_REQUEST['cid'];
			  $sid=$_REQUEST['sid'];
            }
            else
            {
            $cid=$_POST['cid'];
 		    $sid=$_REQUEST['sid'];
          }
          ?>
            <h1>
              <a class="btn btn-lg btn-warning" href="ship.php">Back</a>
              
            </h1>
            
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
	      <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="" enctype="multipart/form-data">
		  <?php
		    
		      $query=mysqli_query($con,"select * from sales left join customer on sales.cust_id=customer.cust_id where sales.sales_id='$sid'")or die(mysqli_error());
			  $row=mysqli_fetch_array($query);
			 
		  ?>	
		    <img class = "profile_pic" src = "../dist/uploads/<?php echo $row['cust_pic'];?>">
                  <div class="form-group">
                    <label for="date">Customer Name</label>
                    <div class="input-group col-md-12">
                      <h3><?php echo $row['cust_name'];?></h3>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <label for="date">eBay Name</label>
                    <div class="input-group col-md-12">
                      <?php echo $row['cust_ebay_name'];?>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <label for="date">PayPal Mail</label>
                    <div class="input-group col-md-12">
                      <?php echo $row['cust_paypal_name'];?>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
		  
                  <div class="form-group">
                    <label for="date">Address</label>
                    <div class="input-group col-md-12">
                      <?php echo $row['shipping_address'];?>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <label for="date"><h3>Total sold&nbsp;&nbsp;<?php echo number_format($row['total_paid'],2);?>USD</h3></label>
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <table>
                    <tr>
                    	<td><h4>Stone Prince:</h4></td>
                        <td><h4><?php echo number_format($row['sales_price']+$row['discount'],2);?>USD</h4></td>
                    </tr>
                    <tr>
                    	<td><h4>Shipping fee:</h4></td>
                        <td><h4><?php echo number_format($row['ship_fee'],2);?>USD</h4></td>
                    </tr>
                    <tr>
                    	<td><h4>Discount:(-)</h4></td>
                        <td><h4>&nbsp;<?php echo number_format($row['discount'],2);?>USD</h4></td>
                    </tr>
                    </table>
                  </div><!-- /.form group -->
                  
               </form>	
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
            
            
            <div class="col-xs-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class=""><a href="#sales" data-toggle="tab" aria-expanded="true">Sales History</a></li>                 
                  <li class=""><a href="#payment" data-toggle="tab" aria-expanded="false">Payments</a></li>
                </ul>
                <div class="tab-content">
                  <!-- Font Awesome Icons -->
                  <div class="tab-pane active" id="sales">
                  <table id="" class="table table-bordered table-striped">
                  <thead>
                  	<tr>
                    	<th>Serial</th>                      
                        <th>Producrt Name</th>
                        <th>Oty</th>
                        <th>Price</th>
                    </tr>
                  </thead>
                  
                  <tbody>
		<?php
   			
    		$query1=mysqli_query($con,"select * from sales_details left join prod_scheduled on sales_details.sch_id=prod_scheduled.sch_id where sales_details.sales_id='$sid';")or die(mysqli_error($con));
    		while($row1=mysqli_fetch_array($query1)){
			$pid=$row1['payment_id'];
    	?>
                  <tr>
                  		<td><?php echo $row1['serial'];?></td>
                        <td><?php echo $row1['prod_tname'];?></td>
                        <td><?php echo $row1['item_qty'];?></td>
                        <td><?php echo $row1['prod_price'];?></td>
                  </tr>
    	<?php }?>       
                  </tbody>
                  </table>
                  </div><!-- /#fa-icons -->

                  
                  <!-- glyphicons-->
                  <div class="tab-pane" id="payment">
                  <table id="" class="table table-bordered table-striped">
                  <thead>
                  	<tr>
                    	<th>Order NO #</th>
                        <th>Item Qty</th>
                        <th>Transcation ID</th>
                        <th>Transcation Date</th>
                        <th>Paid Avaiable</th>
                        <th>Paid Fund</th>
                    </tr>
                  </thead>
                  
                  <tbody>
		<?php
    		$query3=mysqli_query($con,"select * from payment where payment_id='$pid'")or die(mysqli_error());
    		while($row3=mysqli_fetch_array($query3)){
    	?>
                  	<tr>
                    	<td><?php echo $row3['or_no'];?></td>
                        <td><?php echo $row3['item_qty'];?></td>
                        <td><?php echo $row3['trans_id'];?></td>
                        <td><?php echo $row3['trans_date'];?></td>
                        <td><?php echo $row3['payment_paid'];?></td>
						<td><?php echo $row3['payment_fund'];?></td>
                    </tr>
    	<?php }?>       
                  </tbody>
                  </table>
                    
                  </div><!-- /#ion-icons -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div>
          </div><!-- /.row -->
	  
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->
 
<!--end of teacherreg modal-->
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
    
    <!-- Table plug-in for jQuery-->
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
