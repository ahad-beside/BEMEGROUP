<?php include('header.php');
$branch_id = $_GET['id'];
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include('main_sidebar.php');?>

        <!-- top navigation -->
       <?php include('top_nav.php');?>      <!-- /top navigation -->
       
       

        <!-- page content -->
        <div class="right_col" role="main"> 
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">		
                
               
          			
						<div class = "x-panel">
                        
                       
	<?php					 
			$branch=$_GET['id'];
			$query=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());  
			$row=mysqli_fetch_array($query);
	
  	?>  
			 	    
      
                  <h5 align="center"><b><?php echo $row['ebay_name'];?></b> </h5>  
        		  <h6 align="center">Address: <?php echo $row['ebay_address'];?></h6>
		          <h6 align="center">Contact mail: <?php echo $row['ebay_mail'];?></h6>
		          <h6 align="center"><b>Product Inventory as Today, <?php echo date("M d, Y");?> <span id="tick2"></span></b></h6>
                 
				  <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
				  <a class = "btn btn-primary btn-print" href = "reports.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Homepage</a>   
						
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
					<tr>
					    <th>Product Name</th>
                        <th>Stockin Qty</th>
                        <th>Sched.Qty</th>
                        <th>Unsold Qty</th>
                        <th>Sold Qty</th>
						<th>Total Price(USD)</th>
            		</tr>
                    </thead>
                    <tbody>
					<?php
						$branch=$_GET['id'];
						$sql="SELECT *,SUM(price) as price, SUM(prod_status-sold_status) as unsold FROM stockin natural join stockin_details natural join category WHERE branch_id ='$branch' group by cat_id ASC";					
						$query=mysqli_query($con,$sql)or die(mysqli_error());
						$grand=0; $qty1=0; $qty2=0; $qty3=0; $qty4=0; 
						while($row=mysqli_fetch_array($query)){
						$unsold=$row['prod_status']-$row['sold_status'];
												
						$grand+=$row['prod_qty'];
						$qty1+=$row['prod_status'];
						$qty2+=$row['sold_status'];
						$qty4+=$row['price'];
						
						$qty3=$qty1-$qty2;
						
				 	?>
                      <tr>
                        <td><?php echo $row['cat_name'];?></td>
                        <td><?php echo $row['prod_qty'];?></td>
                        <td><?php echo $row['prod_status'];?></td>
						<td><?php echo $row['unsold'];?></td>
                        <td><?php echo $row['sold_status'];?></td>
                        <td><?php echo $row['price'];?></td>						
					  </tr>
<?php }?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Total</th>
                        <th><?php echo $grand;?></th>
                        <th><?php echo $qty1;?></th>
                        <th><?php echo $qty3;?></th>
                        <th><?php echo $qty2;?></th>
                        <th><?php echo number_format($qty4,2);?>&nbsp;USD</th>
					  </tr>					  
                    </tfoot>
                  </table>
                </div>
						</div>
				</div>
			</div>
        </div>		
        <!-- /page content -->
	
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Sales and Inventory System <a href="#"></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

	<?php include 'datatable_script.php';?>
    <!-- /gauge.js -->
       
  </body>
</html>
