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
    <title>Creditor Application | <?php include('../dist/includes/title.php');?></title>
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
    <!--Datepicker in Birthday -->
    <link rel="stylesheet" href="../dist/js/jquery-ui-1.11.4.custom/jquery-ui.min.css">

  
    <style></style>
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
            <li class="active">Customer</li>
          </ol>
          </section>

          <!-- Main content -->
          <section class="content">
          <div class="row">
	      <div class="col-md-12">
          <div class="box box-primary">
          	<div class="box-header with-border">
            	<h3 class="box-title">Apply As New Shipment Handler</h3>
            </div>
            
            <div class="box-body">
            <!-- Date range -->
            <form method="post" action="handler_add.php" enctype="multipart/form-data" class="form-horizontal">
            
            <div class="row">
            	<div class="col-md-6">  
                <label for="date">First Name</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="first" name="first" placeholder="First Name" required>
                </div><!-- /.input group -->
            	</div>
                
                <div class="col-md-2">  
                <label for="date">Middle Name</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="mi" name="mi" placeholder="Middle Initial">
                </div><!-- /.input group -->
                </div><!-- /.form group -->
                    
                <div class="col-md-4">
          		<label for="date">Last Name</label>
                <div class="input-group col-md-12">
            	<div class="input-group col-sm-12">
            	<input type="text" class="form-control pull-right" id="last" name="last" placeholder="Last Name" required>
            	</div><!-- /.input group -->
          		</div><!-- /.form group -->
                </div>
            </div><!--row-->
                 
            <div class="row">
            	<div class="col-md-3">
                <label for="date">Nick Name</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="nickname" name="nickname" placeholder="Nicknamer" >
                </div>
                </div>
            	<div class="col-md-3">  
                <label for="date">Birthday</label>
                <div class="input-group col-md-12">
                <input type="date" class="form-control pull-right" id="datepicker" name="bday" placeholder="YYYY-MM-DD" required>
                </div><!-- /.input group -->
                </div>
                <div class="col-md-2">  
                <label for="date">Cellphone</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="contact" name="contact" placeholder="Cellphone" required>
                </div><!-- /.input group -->
                </div>
                <div class="col-md-4">
          		<label for="date">Picture</label>
                <div class="input-group col-md-12">
            	<div class="input-group col-sm-12">
            	<input type="hidden" class="form-control" id="slip" name="image1" > 
						<input type="file" class="form-control" id="slip" name="image">
            	</div><!-- /.input group -->
          		</div><!-- /.form group -->
                </div>
            </div>
            
            <div class="row">
            	<div class="col-md-12">  
                <label for="date">Present Home Address</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="address" name="address" placeholder="Customer Complete Address" required>
                </div><!-- /.input group -->
                </div>
                
            </div><!--row-->  
            
            <div class="row">
            	<div class="col-md-3">  
                <label for="date">House Status</label>
                <div class="input-group col-md-12">
                <input type="radio" name="house_status" value="owned">Owned
                <input type="text" class="form-control pull-right" id="years" name="years" placeholder="# of years" required>
                </div>
                </div>
                <div class="col-md-3">  
                <label for="date"></label>
                <div class="input-group col-md-12">
                <input type="radio" name="house_status" value="rent">Rent
                <input type="text" class="form-control pull-right" id="years" name="years" placeholder="# of years" required>
                </div>
                </div>
                <div class="col-md-12">
                <label for="date">If renting</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="rentname" name="rent" placeholder="Landlord Name, Address, Contact Number">
                </div>
                </div>
                 
                <div class="col-md-6">
                <label for="date">Occupation</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="occupation" name="occupation" placeholder="Creditor's Occupation">
                </div>  
                </div>
                <div class="col-md-6">
                <label for="date">Monthly Salary/ Net Business Income</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="salary" name="salary" placeholder="Employer Name or Business">
                </div>  
                </div>
                <div class="col-md-12">
                <label for="date">Employer or Business Address & Telephone Number</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="emp_address" name="emp_address" placeholder="Employer or Business Address & Telephone Number">
                 </div>  
                 </div>    
                <div class="col-md-6">
                <label for="date">Spouse Name</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="spouse" name="spouse" placeholder="Complete Name of Spouse">
                </div>  
                </div>
                <div class="col-md-6">
                <label for="date">Cellphone Number</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="spouse_no" name="spouse_no" placeholder="Spouse Contact Number">
                </div>  
                </div>    
                <div class="col-md-6">
                <label for="date">Spouse Employer or Business</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="spouse_emp" name="spouse_emp" placeholder="Spouse Employer or Business">
                </div>  
                </div>
                <div class="col-md-6">
                 <label for="date">Spouse Monthly Income</label>
                 <div class="input-group col-md-12">
                 <input type="text" class="form-control pull-right" id="spouse_income" name="spouse_income" placeholder="Spouse Monthly Income">
                 </div>  
                 </div>                
                <div class="col-md-12">
                <label for="date">Spouse Employer or Business Address & Telephone Number</label>
                <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="spouse_details" name="spouse_details" placeholder="Spouse Employer or Business Address & Telephone Number">
                 </div>  
                 </div>   
                 <div class="col-md-3">
                 <label for="date">Name of Co-Maker (If required)</label>
                 <div class="input-group col-md-12">
                 <input type="text" class="form-control pull-right" id="comaker" name="comaker" placeholder="Name of Co-Maker">
                 </div>  
                 </div>
                 <div class="col-md-9">
                 <label for="date">Present Home Address & Telephone # of Co-Maker</label>
                 <div class="input-group col-md-12">
                 <input type="text" class="form-control pull-right" id="comaker_details" name="comaker_details" placeholder="Present Home Address & Telephone # of Co-Maker">
                 </div>  
                 </div>    
            </div><!--row-->     
            
            <div class="col-md-12">
            	<div class="col-md-12">
            	<button class="btn btn-lg btn-primary pull-right" id="daterange-btn" name="">Submit</button>
				</div>	
            </div>  
			</form>	
            </div><!-- /.box-body -->
            </div><!-- /.box -->
            </div>
 		  </div>
        </section><!-- /.content -->
      </div><!-- /.container -->
    </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

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
    <!--<script src="../dist/js/demo.js"></script>-->
    
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!--Datepicker in Birthday -->
    <script src="../dist/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    
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
    
    <script>
  $(document).ready(function() {
	$.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });
    $("#datepicker").datepicker();
  });
  </script>
    
  </body>
</html>
