<?php
//session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
date_default_timezone_set("Asia/Manila"); 
?>
<?php
include('../dist/includes/dbcon.php');

$branch=$_SESSION['branch'];
$query=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error($con));
  $row=mysqli_fetch_array($query);
           $ebay_name=$row['ebay_name'];
?>

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header" style="padding-left:20px">
              <a href="home.php" class="navbar-brand"><b><i class="glyphicon glyphicon-home"></i> <?php echo $ebay_name;?> </b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
				  <li class="">
                
                    <a href="log.php" class="dropdown-toggle">
                      <i class="glyphicon glyphicon-list-alt"></i>
                      History Log
                    </a>
                  </li>
                  
                  <!-- Notifications Menu -->
                  <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-refresh text-red"></i> Shipping Reset
                      <span class="label label-danger">
                      <?php 
                      $query=mysqli_query($con,"select COUNT(*) as count from sales where ship_cost = '0.00' and  `branch_id` = '$branch'")or die(mysqli_error());
                			$row=mysqli_fetch_array($query);
                			echo $row['count'];
                			?>	
                      </span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have <?php echo $row['count'];?>  that needs Shipment Reset</li>
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                        <?php
                        $queryprod=mysqli_query($con,"select * from sales left join payment on sales.sales_id = payment.sales_id left join customer on payment.cust_id = customer.cust_id where sales.ship_cost = '0.00' and payment.branch_id='$branch'")or die(mysqli_error());
			  while($rowprod=mysqli_fetch_array($queryprod)){
			?>
                          <li><!-- start notification -->
                            <a href="shipping.php">
                              <i class="glyphicon glyphicon-refresh text-red"></i> <?php echo $rowprod['or_no'];?>
                            </a>
                          </li><!-- end notification -->
                          <?php }?>
                    	</ul>
                      </li>
                      <li class="footer"><a href="shipping_report.php">View all</a></li>
                    </ul>
                  </li>
                    
                  <!-- Tasks Menu -->
                  
				  <!-- Notifications Menu -->
                  <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-refresh text-red"></i> Stockin Reset
                      <span class="label label-danger">
                      <?php 
                        //$query1=mysqli_query($con,"select COUNT(*) as count from product where prod_qty<=reorder and branch_id='$branch'")or die(mysqli_error());
						$query1=mysqli_query($con,"select COUNT(*) as count from stockin where prod_qty<>reorder and branch_id='$branch'")or die(mysqli_error());
                		$row1=mysqli_fetch_array($query1);
                		echo $row1['count'];
                	  ?>	
                      </span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have <?php echo $row1['count'];?>  that needs Stockin Reset</li>
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                       <?php
                        //$queryprod=mysqli_query($con,"select cat_name from product natural join category where prod_qty<=reorder and branch_id='$branch'")or die(mysqli_error());
						$queryprod=mysqli_query($con,"select cat_name from stockin natural join category where prod_qty<>reorder and branch_id='$branch'")or die(mysqli_error());
			  while($rowprod=mysqli_fetch_array($queryprod)){
			?>
                         <li><!-- start notification -->
                            <a href="reorder.php">
                              <i class="glyphicon glyphicon-refresh text-red"></i> <?php echo $rowprod['cat_name'];?>
                            </a>
                          </li><!-- end notification -->
                          <?php }?>
                    	</ul>
                      </li>
                      <li class="footer"><a href="inventory.php">View all</a></li>
                    </ul>
                  </li>
                    
                  <!-- Tasks Menu -->
                  
                  
                   <!-- Notifications Menu -->
                   <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-wrench"></i> Maintenance
                      
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
						  <li><!-- start notification -->
                            <a href="category.php">
                              <i class="glyphicon glyphicon-user text-green"></i> Category
                            </a>
                          </li><!-- end notification -->
						              <li><!-- start notification -->
                            <a href="cust_new.php">
                              <i class="glyphicon glyphicon-user text-green"></i> Customer
                            </a>
                          </li><!-- end notification -->
                          <li><!-- start notification -->
                            <a href="invoice.php">
                              <i class="glyphicon glyphicon-user text-green"></i> Invoice (view)
                            </a>
                          </li><!-- end notification -->
						  <li><!-- start notification -->
                            <a href="product.php">
                              <i class="glyphicon glyphicon-cutlery text-green"></i> Product
                            </a>
                          </li><!-- end notification -->
						 
						  <li><!-- start notification -->
                            <a href="supplier.php">
                              <i class="glyphicon glyphicon-send text-green"></i> Supplier
                            </a>
                          </li><!-- end notification -->
                         
						 
                        </ul>
                      </li>
                     
                    </ul>
                  </li>
                  <!-- Tasks Menu -->
                  
                  
                  
                  <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-stats text-red"></i> Report
                     
                    </a>
                    <ul class="dropdown-menu">
                     <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                        
                          <li><!-- start notification -->
                            <a href="inventory.php">
                              <i class="glyphicon glyphicon-ok text-green"></i>Inventory
                            </a>
                          </li><!-- end notification -->
                           <li><!-- start notification -->
                         <a href="ship_report.php">
                              <i class="glyphicon glyphicon-ok text-green"></i>Shipment Report
                            </a>
                          </li><!-- end notification -->
                          <li><!-- start notification -->
                         <a href="receivables.php">
                              <i class="glyphicon glyphicon-usd text-blue"></i>Payment Receivables
                            </a>
                          </li><!-- end notification -->                          
						 <li><!-- start notification -->
                         <a href="sales.php">
                              <i class="glyphicon glyphicon-th-list text-redr"></i>Sales
                            </a>
                          </li><!-- end notification -->
					    
						  <li><!-- start notification -->
                         <a href="income.php">
                              <i class="glyphicon glyphicon-th-list text-redr"></i>Branch Income
                            </a>
                          </li><!-- end notification -->
                         
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <!-- Tasks Menu -->
				  <li class="">
                    <!-- Menu Toggle Button -->
                    <a href="profile.php" class="dropdown-toggle">
                      <i class="glyphicon glyphicon-cog text-orange"></i>
                      <?php echo $_SESSION['name'];?>
                    </a>
                  </li>
                  <li class="">
                    <!-- Menu Toggle Button -->
                    <a href="logout.php" class="dropdown-toggle">
                      <i class="glyphicon glyphicon-off text-red"></i> Logout 
                      
                    </a>
                  </li>
                  
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>