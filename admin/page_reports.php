<?php include 'header.php';
$branch_id = $_GET['id'];
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       <?php include 'main_sidebar.php';?>

        <!-- top navigation -->
       <?php include 'top_nav.php';?>
        <!-- /top navigation -->

        <!-- page content -->
        <div role="main"> 
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">	
					<div class = "x-panel">
						<div class="right_col" role="main">
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

			 <div class="row tile_count">
			 
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 tile_stats_count">
			 <span class="count_top"><i class="fa fa-money"></i> Total Sales</span>
             
             
                
                
			 <?php 
				$year1 = date("Y");
				$month = date("m");
				$branch_id = $_GET['id'];
				$sql0="select SUM(payment_paid) as total_payment from payment where YEAR(trans_date)='$year1' and branch_id ='$branch_id'";
				$query = mysqli_query($con,$sql0) or die(mysqli_error($con));
				$row=mysqli_fetch_array($query);
			 ?> 
                <div class="count">
					<?php echo $row['total_payment'];?>
				</div>
             <span class="count_bottom"><i class="green"></i>For the month of <?php echo date("F",strtotime($month));?>, <?php echo $year1;?></span>
			 </div>
			 
             <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
			 <span class="count_top"><i class="fa fa-money"></i> Total Receivables(USD)</span>
			 <?php 
					$date = date("M. d, Y");
					$branch_id = $_GET['id'];
					$query = mysqli_query($con,"select SUM(payment_fund) as `payment_fund` from  payment where branch_id ='$branch_id' ") or die(mysqli_error($con));
					$row1=mysqli_fetch_array($query);
			 ?>
			 <div class="count green"><?php echo $row1['payment_fund'];?></div>
			 <span class="count_bottom"><i class="green">Total Receivables as of</i> <?php echo $date;?></span>
			 </div>
			
             <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
			 <span class="count_top"><i class="fa fa-user"></i> Active Customers</span>
			 <?php 
			 	$sql2 = "select COUNT(*) as cust_id from sales where branch_id='".$_GET['id']."' group by cust_id;";
				$query = mysqli_query($con,$sql2) or die(mysqli_error($con));
				$row2=mysqli_fetch_array($query);
			 ?>
			 <div class="count"><?php echo $row2['cust_id'];?></div>
			 <span class="count_bottom"><i class="red">as of today</i></span>
			 </div>
			 
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 tile_stats_count">
			 <span class="count_top"><i class="fa fa-user"></i> Number of products Sales</span>
			 <?php 
			 	$sql3 = "select COUNT(*) as sales_details_id from sales_details where branch_id='".$_GET['id']."'";
				$query = mysqli_query($con,$sql3) or die(mysqli_error($con));
				$row3=mysqli_fetch_array($query);
			 ?>
			 <div class="count"><?php echo $row3['sales_details_id'];?></div>
			 <span class="count_bottom"><i class="green">as of today</i></span>
			 </div>
			 
             <div class="col-md-12 col-sm-12 col-xs-12">
			 <div class="x_panel">
				
                <div class="x_title">
					<h2>Total Monthly Sales <small></small></h2>
                    <?php //echo $sql0;?>
					<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				
                <div class="x_content">
				<div id="graph"></div>
									
                <table id="example1" class="table table-bordered table-striped">
				<tr>
					<th>MONTH</th>
   					
   					<th class="text-right">Stone Price</th>
   					<th class="text-right">Discount</th>
                    <th class="text-right">Ship Fee</th>
					<th class="text-right">Total SALES</th>
                    <th class="text-right">RECEIVABLES</th>
				</tr>
			    
                <tbody>
				
                
                <?php
					$_SESSION['branch']=$_GET['id'];
					$year=date("Y");
					$sql4="select *,SUM(payment_paid) as payment_tot1, SUM(ship_fee) as fee_tot3, SUM(sales_price) as sales_tot4, SUM(discount) as discount_tot5, DATE_FORMAT(trans_date,'%b') as month, SUM(payment_fund) as payment_tot2 from payment natural join sales where YEAR(trans_date)='$year' and branch_id='$branch' group by MONTH(trans_date)";
					$query=mysqli_query($con,$sql4)or die(mysqli_error($con));
					$tot1=0; $tot2=0; $tot3=0; $tot4=0; $tot5=0;
					while($row=mysqli_fetch_array($query)){
					$tot1=$tot1+$row['payment_tot1'];		
					$tot2=$tot2+$row['payment_tot2'];
					$tot3=$tot3+$row['fee_tot3'];
					$tot4=$tot4+$row['sales_tot4'];
					$tot5=$tot5+$row['discount_tot5'];
				?>
                
                
            
				<tr>
             	<th><?php echo $row['month'];?></th>                    
                    <td class="text-right"><b><?php echo number_format($row['sales_tot4'],2);?></b></td>
                    <td class="text-right"><b><?php echo number_format($row['discount_tot5'],2);?></b></td>
                    <td class="text-right"><b><?php echo number_format($row['fee_tot3'],2);?></b></td>
					<td class="text-right"><b><?php echo number_format($row['payment_tot1'],2);?></b></td>
                	<td class="text-right"><b><?php echo number_format($row['payment_tot2'],2);?></b></td>
                   
				</tr>
				<?php }?>	
			
            	<tr>
                	<th><h2>TOTAL</h2></th>                  	
                  	<th class="text-right"><h2><b><?php echo number_format($tot4,2);?></b></h2></td>
                    <th class="text-right"><h2><b><?php echo number_format($tot5,2);?></b></h2></td>
                    <th class="text-right"><h2><b><?php echo number_format($tot3,2);?></b></h2></td>
					<th class="text-right"><h2><b><?php echo number_format($tot1,2);?></b></h2></td>
                	<th class="text-right"><h2><b><?php echo number_format($tot2,2);?></b></h2></td>
                   
				</tr>
	            </tbody>
                            
       </table>
											
										  </div>
										</div>
							</div>
							</div>
					</div> 
						
						
						
						
						
						
						
						
					</div>								
				</div>
			</div>
        </div>		
        <!-- /page content -->

        <!-- footer content -->
      
        <!-- /footer content -->
      </div>
    </div>
	 <script src="new_js/jquery/dist/jquery.min.js"></script>
	<script src="js/highcharts.js"></script>
    <!-- Bootstrap -->
    <script src="js/exporting.js"></script>
	 
    <!-- FastClick -->
   
	<script type="text/javascript">
    $(document).ready(function() {
      var options = {
              chart: {
                  renderTo: 'graph',
                  type: 'column',
                  marginRight: 20,
                  marginBottom: 25
              },
              title: {
                  text: '',
                  x: -20 //center
              },
              subtitle: {
                  text: '',
                  x: -10
              },
              xAxis: {
                  categories: []
              },
              yAxis: {
                  
                  title: {
                      text: 'Total Monthly Sales'
                  },
                  plotLines: [{
                      value: 0,
                      width: 1,
                      color: '#808080'
                  }]
              },
              tooltip: {
                  formatter: function() {
                          return '<b>'+ this.series.name +'</b><br/>'+  Highcharts.numberFormat(this.y, 0)
                          this.x +': '+ this.y
                          
                  ;
                  }
              },
              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'top',
                  x: 0,
                  y: 100,
                  borderWidth: 0
              },
              series: []
          }
          
          $.getJSON("data.php", function(json) {
			options.xAxis.categories = json[0]['name'];
            options.series[0] = json[1];
            //options.series[1] = json[2];
            
            
            
            chart = new Highcharts.Chart(options);
          });
      });
    </script>
	<?php include 'datatable_script.php';?>
    <!-- /gauge.js -->
  </body>
</html>
