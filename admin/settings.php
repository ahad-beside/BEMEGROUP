<?php 
include('header.php');
include('dbcon.php');
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       <?php include('main_sidebar.php');?>

        <!-- top navigation -->
       <?php include('top_nav.php');?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main"> 
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class = "col-md-6 col-lg-6 col-xs-6">
						<?php include('currency.php');?>
					</div>
					
                    <div class = "col-md-6 col-lg-6 col-xs-6">
						<div class = "x-panel">
						 <?php include('backup_data.php');?>
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

	<?php include('datatable_script.php');?>
    <!-- /gauge.js -->
  </body>
</html>
