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
        
         <section class="content-header">
          <h1><a class="btn btn-lg btn-warning" href="home.php">Back</a></h1>
          <ol class="breadcrumb">
          	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Shipment Report</li>
          </ol>
          </section>
         
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
        		?>      
                   	<h5 align="center"><b><?php echo $row['ebay_name'];?></b> </h5>  
        			<h6 align="center">Address: <?php echo $row['ebay_address'];?></h6>
			        <h6 align="center">Contact mail: <?php echo $row['ebay_mail'];?></h6>
			        <h6 align="center"><b>Today, <?php echo date("M d, Y");?> <span id="tick2"></span></b></h6>
				    <h5><b>Product Inventory</b></h5>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
				  <tr>
                    <th>Serial No</th> 
					<th>eBay Item No</th>
                    <th>Product Name</th>
                    <th>Supplier</th>
                    <th>Weight/Ct.</th>
                  	<th>Price(USD)</th>
	              	<th class="text-center">Action</th>
            		</tr>
                  </thead>
                  
                  <tbody>
				  <?php
					$branch=$_SESSION['branch'];
					//select * from prod_scheduled left join sales_details on prod_scheduled.sch_id=sales_details.sch_id left join category on prod_scheduled.cat_id=category.cat_id left join supplier on prod_scheduled.supplier_id=supplier.supplier_id where sales_details.branch_id='1' order by sales_details.sch_id DESC
				   $sql="select * from prod_scheduled natural join supplier natural join category where branch_id='$branch' order by sch_id DESC";
				   $query=mysqli_query($con,$sql)or die(mysqli_error());
					$grand=0;
					while($row=mysqli_fetch_array($query)){
						$total=$row['prod_price'];
						$grand+=$total;
			      ?>
                  <tr>
                  	<td><?php echo $row['serial'];?></td>
                  	<td><?php echo $row['ebay_sold_id'];?></td>
                    <td><?php echo $row['cat_name'];?></td>
                    <td><?php echo $row['supplier_name'];?></td>
                    <td class="text-center"><?php echo $row['prod_weight'];?></td>                   
					<td><?php echo number_format($total,2);?></td>
                    <td class="text-center"><?php if ($row['ebay_sold_id']<>'0') echo "<span class='badge bg-red'><i class='glyphicon glyphicon-refresh'></i>Sold</span>";?></td>					
                  </tr>
				  <?php }?>					  
                  </tbody>
                  <tfoot>
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
