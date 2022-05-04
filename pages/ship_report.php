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
    <title>Shipment Report | <?php include('../dist/includes/title.php');?></title>
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
				    <h5><b>Shipment Report</b></h5>
        
          <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
          <th>Shipment to</th>
            <th>Order NO:</th>
            <th>Invoice</th>
            <th>Ord.Qty</th>
                
          	<th>Transaction ID</th>
            <th>Transaction Date</th>
            <th>Trans. Complite</th>
		    <th>Receivable</th>        
		  </tr>
          </thead>
          
          <tbody>
		  <?php
			$branch=$_SESSION['branch'];
			$sql="SELECT * FROM `payment` natural join sales left join inv_details on sales.invcode=inv_details.invcode left join handler on inv_details.hand_id=handler.hand_id where payment.branch_id='1' order by inv_details.invcode";
			//echo $sql;
			$query=mysqli_query($con,$sql)or die(mysqli_error());
			$qty=0;$grand=0;$discount=0;$pgrand=0;
			while($row=mysqli_fetch_array($query)){
				$total=$row['payment_paid'];
				
				//set timezone
				date_default_timezone_set('GMT');
				//display the converted time
				$tdate = date("M j, Y H:i:s",strtotime($row['trans_date']));			
				$ddate = strtotime("+21 day",strtotime($tdate));
				$cdate = date('M j, Y H:i:s', $ddate);
			
				$grand=$grand+$total;
			    $discount=$discount+$row['discount'];			
				$pgrand=$pgrand+$row['ship_fee'];
		  ?>
          <tr>
            <td><?php echo $row['hand_first']." ".$row['hand_mi']." ".$row['hand_last'];?></td>
            <td><?php echo $row['or_no'];?></td>
            <td><?php echo $row['invcode'];?></td>
            <td class="text-center"><?php echo $row['item_qty'];?></td>
         	<td><?php echo $row['trans_id'];?></td>
            <td><?php echo $tdate ;?></td>
            <td><?php echo $cdate;?></td>
          	<td class="text-center">
				<?php if ($row['payment_fund']=='0.00') 
							echo "<span class='badge bg-red'><i class='glyphicon glyphicon-refresh'></i>Waiting</span>";
					  else
						 	echo "<span class='badge bg-green'><i class='glyphicon glyphicon-saved'></i>Paid Fund</span>";
				?>
            </td>
          </tr>
			<?php }?>			  
          </tbody>
          </table>
             
            </div><!-- /.box-body -->
            </div><!-- /.col -->
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
    <script src="../dist/js/demo.js"></script>
    
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    <!-- USE FOR LOAD TIME -->
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
