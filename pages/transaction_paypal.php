<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
if(empty($_SESSION['branch'])):
header('Location:../index.php');
endif;
	
	include('../dist/includes/dbcon.php');
	$year = date("Y");
	$month = date("m");	
	$query = mysqli_query($con,"SELECT * FROM `ordercode` ORDER BY order_incre DESC ") or die (mysqli_error($con));
	$fetch = mysqli_fetch_array($query);
	$ord_incre = $fetch['order_incre'];
						
	$new_barcode =  $ord_incre + 1;
	$y_ordcode = "PD"."$year";
	$m_ordcode = "$month";
	$generate_barcode = $y_ordcode.$m_ordcode.$new_barcode;
	
	
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home | <?php include('../dist/includes/title.php');?></title>
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
    <script src="../dist/js/jquery.min.js"></script>
</head>

  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav" onLoad="myFunction()">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
              
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Product</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
	      <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Sales Transaction</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="transaction_add.php">
				  <div class="row" style="min-height:400px">
					<div class=" col-md-4">
						<div class="form-group">
						<label for="date">Serial No:</label>
							<select class="form-control select2" name="prod_id" tabindex="1" autofocus required>
                            <option value=""></option>
							<?php
                  				$branch=$_SESSION['branch'];
								$cid=$_REQUEST['cid'];
								include('../dist/includes/dbcon.php');
								
				  				$query2=mysqli_query($con,"select * from prod_scheduled where branch_id='$branch' and ebay_sold_id='0' order by serial DESC")or die(mysqli_error());
								while($row=mysqli_fetch_array($query2))	
								{
							?>
							<option value="<?php echo $row['sch_id'];?>"><?php echo $row['serial'];?></option>
							<?php }?>
							</select>
						    <input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>" required>   
				    </div><!-- /.form group -->
				    </div>
					<div class="col-md-2">
					 <div class="form-group">
							<label for="date"></label>
							<div class="input-group">
								<button class="btn btn-lg btn-primary" type="submit" tabindex="3" name="addtocart">+</button>
							</div>
						</div>	
					</form>	                 
                                  
			  </div>
			  <div class="col-md-12">
              <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Serial No:</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>eBay Item</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>		
		<?php
			$query=mysqli_query($con,"select * from temp_trans natural join prod_scheduled where branch_id='$branch'")or die(mysqli_error());
			$grand=0;
				while($row=mysqli_fetch_array($query)){
				$id=$row['temp_trans_id'];
				$pid=$row['sch_id'];
				$total= $row['price'];
				$grand=$grand+$total;
				
		?>
                    <tr>
						<td width="100px;"><?php echo $row['serial'];?></td>
                        <td width="400px;"><?php echo $row['prod_tname'];?></td>
						<td><?php echo number_format($row['price'],2);?></td>
						<td><?php echo $row['ebay_sold_id'];?></td>
                        
                        <td>
                        <a href="#updateordinance<?php echo $row['temp_trans_id'];?> " data-target="#updateordinance<?php echo $row['temp_trans_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
						<a href="#delete<?php echo $row['temp_trans_id'];?>" data-target="#delete<?php echo $row['temp_trans_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-trash text-red"></i></a>
              			</td>
                    </tr>
                    
                    <div id="updateordinance<?php echo $row['temp_trans_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
			<div class="modal-content" style="height:auto">
            <div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update eBay Sales</h4>
            </div>
            
            <div class="modal-body">
		  	<form class="form-horizontal" method="post" action="transaction_update.php" enctype='multipart/form-data'>
				<input type="hidden" class="form-control" name="pid" value="<?php echo $pid;?>" required>
                 <input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>" required>  
	
                <div class="form-group">
					<label class="control-label col-lg-3" for="itemNo">eBay Item NO:</label>
					<div class="col-lg-9">
					<input type="text" class="form-control" id="itemNo" name="itemNo" required>  
					</div>
			    </div>
		</div><br><br>
            
            <div class="modal-footer">
		    	<button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
			</form>
            </div>
		    </div><!--end of modal-dialog-->
			</div><!--end of modal-->
            
            
					
                   
 <!--end of modal-->  
<div id="delete<?php echo $row['temp_trans_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Item</h4>
              </div>
              <div class="modal-body">
        <form class="form-horizontal" method="post" action="transaction_del.php" enctype='multipart/form-data'>
          <input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>" required>   
          <input type="hidden" class="form-control" name="pid" value="<?php echo $pid;?>" required>   
          <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $row['temp_trans_id'];?>" required>  
        <p>Are you sure you want to remove....<br/><b><?php echo $row['serial'];?></b><br/><?php echo $row['prod_tname'];?>?</p>
        
              </div><br>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
        </form>
            </div>
      
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->  
<?php }?>					  
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->

				</div>	
               
                  
                  
				</form>	
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
            
            <div class="col-md-3">
              <div class="box box-primary">
               
                <div class="box-body">
                  <!-- Date range -->
          <form method="post" name="autoSumForm" action="sales_add.php">
          <input type="hidden" name="new_ordcode" value="<?php echo $new_barcode; ?>">
				  <div class="row">
					 <div class="col-md-12">
					 	<div class="form-group">
						<label for="date">Total</label>
						<input type="text" style="text-align:right" class="form-control" id="total" name="total" placeholder="Total" 
						value="<?php echo $grand;?>" onFocus="startCalc();" onBlur="stopCalc();"  tabindex="5" readonly>
						</div><!-- /.form group -->
						
                        <div class="form-group">
						<label for="date">Discount</label>
						<input type="text" class="form-control text-right" id="discount" name="discount" value="0" tabindex="6" placeholder="Discount (Php)" onFocus="startCalc();" onBlur="stopCalc();">
						<input type="hidden" class="form-control text-right" id="cid" name="cid" value="<?php echo $cid;?>">
						</div><!-- /.form group -->
						
                        <div class="form-group">
						<label for="date">Grand Total</label>
						<input type="text" style="text-align:right" class="form-control" id="amount_due" name="amount_due" placeholder="Amount Due" value="<?php echo number_format($grand,2);?>" readonly >
						</div><!-- /.form group -->
                         <div class="form-group" id="change">
	            		  <label for="date">Shipping Fee</label><br>
    		         	  <input type="text" style="text-align:right" class="form-control" id="ship_fee" name="ship_fee" placeholder="Shipping Fee" autofocus required>
            			  </div><!-- /.form group -->
                        <div class="form-group" id="change">
	            		  <label for="date">Transaction ID</label><br>
    		         	  <input type="text" style="text-align:left" class="form-control" id="trans_id" name="trans_id" placeholder="Transaction ID" autofocus required>
            			  </div><!-- /.form group -->
                          <div class="form-group" id="change">
	            		  <label for="date">Transaction Date</label><br>
    		         	  <input type="text" style="text-align:left" class="form-control" id="trans_date" name="trans_date" placeholder="Transaction Date" autofocus required>
            			  </div><!-- /.form group -->
              	     </div>
					</div>	
               
                  
                 
                      <button class="btn btn-lg btn-block btn-primary" id="daterange-btn" name="cash" type="submit"  tabindex="7">
                        Complete Sales
                      </button>
					  <button class="btn btn-lg btn-block" id="daterange-btn" type="reset"  tabindex="8">
                        <a href="cancel.php">Cancel Sale</a>
                      </button>
              
				</form>		
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
					
          </div><!-- /.row -->
	              
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

<script>
    
      $("#cash").click(function(){
          $("#tendered").show('slow');
          $("#change").show('slow');
      });

    $(function() {

      $(".btn_delete").click(function(){
      var element = $(this);
      var id = element.attr("id");
      var dataString = 'id=' + id;
      if(confirm("Sure you want to delete this item?"))
      {
	$.ajax({
	type: "GET",
	url: "temp_trans_del.php",
	data: dataString,
	success: function(){
		
	      }
	  });
	  
	  $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
	  .animate({ opacity: "hide" }, "slow");
      }
      return false;
      });

      });
    </script>
	
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
    
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,x`
          "info": true,
          "autoWidth": false
        });
      });
    </script>
     <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
  </body>
</html>
