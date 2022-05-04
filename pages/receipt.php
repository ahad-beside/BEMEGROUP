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
$id=$_SESSION['id'];
$branch=$_SESSION['branch'];
    $queryb=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());
  
        $rowb=mysqli_fetch_array($queryb);
        
?>		
<h5 align="center"><b><?php echo $rowb['ebay_name'];?></b> </h5>  
        <h6 align="center">Address: <?php echo $rowb['ebay_address'];?></h6>
        <h6 align="center">Contact mail: <?php echo $rowb['ebay_mail'];?></h6>
        <h6 align="center"><b>Today, <?php echo date("M d, Y");?> <span id="tick2"></span></b></h6>
	  	<h5 align="center"><b>SALES INVOICE of today, <?php echo date("M d, Y");?><span id="tick2"></span></b></h5>
        	<a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
  		 	<a class = "btn btn-primary btn-print" href = "home.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Homepage</a>
                 
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
		
		$code = $_GET['sid'];
		$result2= mysqli_query($con,"select * from payment where sales_id = '$code' ") or die (mysqli_error($con));
		$row2=(mysqli_fetch_array($result2));
		$code2=$row2['or_no'];
		$trans_id=$row2['trans_id'];
		$trans_date=$row2['trans_date'];
		
?>    
                  <table class="table">
                    <thead>
                      <tr>
                        <th>SOLD to</th>
                        <th><?php echo $name;?></th>
                        <th>Date</th>
                        <th><?php echo date("M d, Y h:m:s a",strtotime($row1['date']));?></th>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <th><u><?php echo $address;?></u></th>
                        <th>Order</th>
                        <th><?php echo "<img src = 'BCG/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=10&text=".$code2."&thickness=25&start=NULL&code=BCGcode128' />";?></th>
                      </tr>
                      <tr>
                        <th>Transaction ID</th>
                        <th><?php echo $trans_id ; ?></th>
                        <th>Transaction Date</th>
                        <th><?php echo $trans_date; ?></th>
                      </tr>
                    </thead>
                  </table>
                  
                  <table class="table">
                    <thead>
                      <tr style="border: solid 1px #000">
                        <th>Serial NO</th>
                        <th>ARTICLES</th>
                        <th>UNIT</th>
            			<th>Unit Price</th>
            			<th>AMOUNT</th>
                      </tr>
                    </thead>
                    
                    <tbody>
					<?php
						$query=mysqli_query($con,"SELECT * FROM prod_scheduled LEFT JOIN sales_details ON prod_scheduled.sch_id=sales_details.sch_id left join sales on sales_details.sales_id= sales.sales_id where sales_details.sales_id = '$sid'")or die(mysqli_error($con));
						$grand=0;
						while($row=mysqli_fetch_array($query)){
						//$id=$row['temp_trans_id'];
						$ship_fee = $row['ship_fee'];
						$discount = $row['discount'];
						$total= $row['price'];
						$total_add=$row['sales_price'];
						$total_paid=$row['total_paid'];
						
						$sub_total=$total_add+$discount;
						$grand_total=$sub_total+$ship_fee;
						
					?>
                      <tr>
            			<td><?php echo $row['serial'];?></td>
                        <td><?php echo $row['prod_tname'];?></td>
                        <td><?php echo $row['item_qty'];?>pc/s</td>
            			<td><?php echo number_format($row['price'],2);?></td>
            			<td style="text-align:right"><?php echo number_format($row['price'],2);?></td>
                      </tr>
						<?php }?>					
                      
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right">Subtotal</td>
                        <td style="text-align:right"><?php echo number_format($sub_total,2);?></td>
                      </tr>
                      
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right">Shipping</td>
                        <td style="text-align:right"><?php echo number_format($ship_fee,2);?></td>
                      </tr>
                      
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right"><b>Total</b></td>
                        <td style="text-align:right"><b><?php echo number_format($grand_total,2);?></b></td>
                      </tr>
                      
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right">Discount(-)</td>
                        <td style="text-align:right"><?php echo number_format($discount,2);?></td>
                      </tr>                      
                      
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right"><b>Payment</b></td>
                        <td style="text-align:right"><b><?php echo number_format($total_paid,2);?></b></td>
                      </tr>
                      
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="">&nbsp;</td>
                        <td style="text-align:right"><b><?php //echo number_format($change,2);?></b></td>
                      </tr> 
                      
                      <tr>
                        <th>Prepared by:</th>
                        <th></th>
                        <th></th>
                        <th>_________________________</th>
                      </tr> 
					
					<?php
					    $query=mysqli_query($con,"select * from user where user_id='$id'")or die(mysqli_error($con));
						$row=mysqli_fetch_array($query);
 					?>                      
                    
                      <tr>
                        <th><?php echo $row['name'];?></th>
                        <th></th>
                        <th></th>
                        <th>Customer's Signature</th>
                      </tr>  
                    </tbody>
                  
                  </table>
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
