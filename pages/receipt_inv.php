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
    <title>Receipt | <?php include('../dist/includes/title.php');?></title>
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
      tr td{
        padding-top:-10px!important;
        border: 1px solid #000;
      }
      @media print {
          .btn-print {
            display:none !important;
          }
      }
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">

          <section class="content">
            <div class="row">
	      <div class="col-md-12">
              <div class="col-md-12">

              </div>
                
                <div class="box-body">

                  <!-- Date range -->
                  <form method="post" action="">
<?php
		include('../dist/includes/dbcon.php');
		$query = mysqli_query($con,"SELECT max(inv_incre) FROM `invoicecode` ORDER BY `invcode_id` DESC") or die (mysqli_error());
		$row=mysqli_fetch_array($query);
		$inv_no=$row['max(inv_incre)'];
		if($inv_no==0)
		{
			$inv_no=1;
		}
		else
		{
			$inv_no=$inv_no+1;	
		}
	
		$year = date("Y");
		$month = date("m");	
		$date = date("d");
		$y_ordcode = "INV"."$year";
		//$m_ordcode = "-"."$month"."-";
		$d_ordcode = "-"."$month"."-"."$date"."-";
		//$generate_barcode = $y_barcode.$m_barcode.$code;
		$invno = $y_ordcode.$d_ordcode.$inv_no;
		$id=$_SESSION['id'];
		$branch=$_SESSION['branch'];
    	$queryb=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());
    	$rowb=mysqli_fetch_array($queryb);
		      	        
?>		
		<h5 align="center"><b><?php echo $rowb['ebay_name'];?></b> </h5>  
        <h6 align="center">Address: <?php echo $rowb['ebay_address'];?></h6>
        <h6 align="center">Contact mail: <?php echo $rowb['ebay_mail'];?></h6>
        <h6 align="center"><b>Today, <?php echo date("M d, Y");?> <span id="tick2"></span></b></h6>
	  	<h5 align="center"><b>SHIPPING INVOICE</b></h5>
        	
                 
<?php

    	$branch=$_SESSION['branch'];
    	$query=mysqli_query($con,"select * from sales natural join customer where branch_id='$branch' order by sales_id desc LIMIT 0,1")or die(mysqli_error($con));
        $row=mysqli_fetch_array($query);
      
	  	$sales_id=$row['sales_id'];
        $name=$row['cust_name'];
	    $address=$row['shipping_address'];
        $contact=$row['cust_contact'];
        $sid=$row['sales_id'];     
        $discount=$row['discount'];       

        $query1=mysqli_query($con,"select * from payment where sales_id='$sales_id'")or die(mysqli_error($con));
        $row1=mysqli_fetch_array($query1);
		
				
		$code1= date("Y-m-d");
		$inv="INV";
		$code2= ($inv."".$code1);
		
?>    
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Shipment to Name</th>
                        <th><?php //echo $name;?></th>
                        <th>Invoice</th>
                        <th><?php echo"<img src = 'BCG/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=10&text=".$invno."&thickness=25&start=NULL&code=BCGcode128' />";?></th>
                      </tr>
                      <tr>
                        <th>Address to Ship</th>
                        <th><u><?php //echo $address;?></u></th>
                        <th></th>
                        <th></th>
                      </tr>
                      
                      <!--<tr>
                        <th>Transaction ID</th>
                        <th><?php //echo $trans_id ; ?></th>
                        <th>Transaction Date</th>
                        <th><?php //echo $trans_date; ?></th>
                      </tr>-->
                      
                    </thead>
                  </table>
                  
                  <table class="table">
                    <thead>
                   
                      <tr style="border: solid 1px #000">
							<th>Order No</th> 
		                    <th>Shipping Address</th>
		                    <th>Item(Qty)</th>         
		                	<th>S-Cost(TK)</th>
        	    			<th>Status</th>
            	      
                     </tr >
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
                      <tr >
            			<td><?php echo $row['or_no'];?></td>
                    	<td><?php echo $row['shipping_address'];?></td>
                    	<td><?php echo $row['item_qty'];?></td>
						<td></td>
                    	<td></td>
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
                    <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Confirm Print</a>
  		 	<!--<a class = "btn btn-primary btn-print" href = "home.php"><i class ="glyphicon glyphicon-arrow-left"></i> Clsoe</a>-->
            <a href = "javascript:window.close();"><button type="button" class="btn btn-danger btn-danger"><i class ="glyphicon glyphicon-remove"></i> Close</button></a>
                </div><!-- /.box-body -->
				</div>  
                
				</form>	
               
                           
                </div><!-- /.box-body -->
                  </div><!-- /.box -->
                             
                            
            </div><!-- /.col (right) -->
           
          </div><!-- /.row -->
	  
             
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
     
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
    <!-- date_time -->
    <script src="../dist/js/date_time.js"></script>
         
  </body>
</html>
