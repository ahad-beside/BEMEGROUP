<?php include('header.php');?>

<style type="text/css">
	h5,h6{
    	text-align:center;
    }
	@media print {
    .btn-print {
    	display:none !important;
	}
	.main-footer{
		display:none !important;
	}
	.box.box-primary {
		border-top:none !important;
	}
	.angel{
		display:none !important;
	}
	.hide-section{
		display:none; 
	}
	}
</style>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       <?php include('main_sidebar.php');?>
       <?php include('top_nav.php');?><!-- /top navigation -->
        
        <!-- page content -->
        <div class="right_col" role="main"> 
			<div class = "row">
				<div class="col-md-12 col-sm-12 col-xs-12">
			<div class = "panel">
				<div class="panel-heading">
				  <h3 class="box-title">Select Date</h3>
				  <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
				  <a class = "btn btn-primary btn-print" href = "reports.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Homepage</a>
				</div>
				<div class="box-body">
				
				  <!-- /.form group -->
				  <form method="post" >
					<div class="form-group col-md-6">
						<label></label>

						<div class="input-group">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						<select class="form-control select2" name="month" tabindex="1" autofocus required>
							<option value="1">January</option>
							<option value="2">February</option>
							<option value="3">March</option>
							<option value="4">April</option>
							<option value="5">May</option>
							<option value="6">June</option>
							<option value="7">July</option>
							<option value="8">August</option>
							<option value="9">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
						</select>
						</div>
                		<!-- /.input group -->
					</div>
					
					<div class="form-group col-md-5">
						<label></label>
						<div class="input-group">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						<select class="form-control select2" name="year" tabindex="1" required>
							<option>2017</option>
							<option>2018</option>
                            <option>2019</option>
							<option>2020</option>
						</select>
					</div>
                <!-- /.input group -->
					</div>
              <!-- /.form group --><br>
					<button type="submit" class="btn btn-primary" name="display">Display</button>
				</form>
				
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->  
				
				</div>			
			</div>
			
			
			<div class="row">
								
				
				<div class="col-md-12 col-sm-12 col-xs-12">					
					<div id="graph"></div>
					<table id="example1" class="table table-bordered table-striped">
					<tr>
						<th>MONTH</th>
						<th>BRANCH</th>
                        <th class="text-right">SHIP FEE</th>
                        <th class="text-right">SALES</th>
					</tr>
			        <tbody>
		<?php
			if (isset($_POST['display'])){
			$year=$_POST['year'];
			$month=$_POST['month'];
			$_SESSION['year']=$year;
			$_SESSION['month']=$month;
			
			$sql="select *,SUM(payment_paid) as payment, SUM(ship_fee) as fee_tot, DATE_FORMAT(trans_date,'%b') as month from payment natural join sales natural join branch where YEAR(trans_date)='$year' and MONTH(trans_date)='$month' group by branch_id,MONTH(trans_date) order by  MONTH(trans_date)";
			$query=mysqli_query($con,$sql)or die(mysqli_error($con));
			$total=0;$fee=0;
			echo "<h2 style='text-align:center'><b>Monthly Sales</b></h2>";
			while($row=mysqli_fetch_array($query)){
				$total=$total+$row['payment'];	
				$fee=$fee+$row['fee_tot'];	
?>
            		<tr>
                		<th><?php echo $row['month']." ".$year;?></th>
						<th><?php echo $row['ebay_name'];?></th>
                        <td class="text-right"><b><?php echo number_format($row['fee_tot'],2);?></b></td>
						<td class="text-right"><b><?php echo number_format($row['payment'],2);?></b></td>
					</tr>
	<?php }
			  echo "<tr>
                	<th><h2>TOTAL</h2></th>   
					<th colspan='2'class='text-right'><h2><b>$fee</b></h2></td>
						<th class='text-right'><h2><b>$total</b></h2></td>
					</tr>";
	}?>	
			       	</tbody>
               		</table>
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
		
	<?php include('datatable_script.php');?>
    <!-- /gauge.js -->
  </body>
</html>
