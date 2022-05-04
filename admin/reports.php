<?php include('header.php');?>
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
					<?php 
						include('dbcon.php');
						$query1=mysqli_query($con,"select * from branch ORDER BY ebay_name")or die(mysqli_error($con));
						while ($row=mysqli_fetch_array($query1)){
						$id=$row['branch_id'];?>
						<a href  = "page_reports.php?id=<?php echo $row['branch_id'];?>">
						<div class = "col-md-6 col-6-12 col-6">
							<div class = "panel panel-success">
								<div class = "panel-heading">
									<i class = "center fa fa-building"></i>
								</div>
								<div class = "panel-body">
										<h1 class = ""><?php echo $row['ebay_name'];?></h1>
								</div>
							</div>
						</div>
						</a>
						<?php } ?>						
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
	
<?php /*?>	<?php include('datatable_script.php');?><?php */?>
    <!-- /gauge.js -->
    
    	<!-- This is over_all.php script -->
	<script type="text/javascript"src="js_new/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript"src="js_new/highcharts.js"></script>
	<script type="text/javascript"src="js_new/exporting.js"></script>
        
	
	<script src="js_new/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="js_new/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="js_new/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="css_new/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="css_new/iCheck/icheck.min.js"></script>
    
    
    <!-- Datatables -->
    <script src="js_new/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="js_new/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="js_new/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="js_new/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="js_new/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="js_new/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="js_new/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="js_new/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="js_new/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="js_new/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="js_new/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="js_new/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="js_new/jszip/dist/jszip.min.js"></script>
    <script src="js_new/pdfmake/build/pdfmake.min.js"></script>
    <script src="js_new/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <script>
	function show2(){
		if (!document.all&&!document.getElementById)
		return
		thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
		var Digital=new Date()
		var hours=Digital.getHours()
		var minutes=Digital.getMinutes()
		var seconds=Digital.getSeconds()
		var dn="PM"
		if (hours<12)
		dn="AM"
		if (hours>12)
		hours=hours-12
		if (hours==0)
		hours=12
		if (minutes<=9)
		minutes="0"+minutes
		if (seconds<=9)
		seconds="0"+seconds
		var ctime=hours+":"+minutes+":"+seconds+" "+dn
		thelement.innerHTML=ctime
		setTimeout("show2()",1000)
		}
		window.onload=show2
				//-->
</script>


  </body>
</html>
