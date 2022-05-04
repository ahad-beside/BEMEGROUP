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
    <title>Product | <?php include('../dist/includes/title.php');?></title>
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
    
    <!-- drop-down-selection-->
    <link rel="stylesheet" href="../dist/drop-down-selection/bootstrap.min.css" />  
    <script src="../dist/drop-down-selection/bootstrap.min.js"></script>  
    <script src="../dist/drop-down-selection/jquery.min.js"></script>
    
 </head>
 
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
          <h1><a class="btn btn-lg btn-warning" href="home.php">Back</a></h1>
          <ol class="breadcrumb">
          	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product</li>
          </ol>
          </section>

          <!-- Main content -->
          <section class="content">
          <div class="row">
	      <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Search Existing Shipping INVOICE</h3>
                </div>
                
                <div class="box-body">
                <!-- Date range -->
<?php
//load_data_select.php  
 include('../dist/includes/dbcon.php');
 function fill_brand($con)  
 {  
      $output = '';  
      $sql = "SELECT sales_id, invcode, sales_price, discount, ship_fee FROM sales where invcode <> 'NULL' and branch_id= '".$_SESSION['branch']."' group by invcode DESC ;";  
      $result = mysqli_query($con, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["invcode"].'">'.$row["invcode"].'</option>';  
      }  
      return $output;  
 }  
 function fill_product($con)  
 {  
      $output = '';  
      $sql = "select sales.sales_id, invcode, payment.or_no, payment.item_qty, customer.shipping_address from sales left join payment on sales.sales_id = payment.sales_id left join customer on payment.cust_id = customer.cust_id where sales.invcode";  
      $result = mysqli_query($con, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<div class="col-md-3">';  
           $output .= '<div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">'.$row["or_no"].'';  
           $output .=     '</div>';  
           $output .=     '</div>';  
      }  
      return $output;  
 }  
?>
		
        	<form action="invoice_add.php" method="post">
        	
            <div class="form-group">
            <label for="date">Invoice NO</label>
            	<div class="input-group col-md-12">
                <select name="brand" id="brand" class="form-control" autofocus required>
                	<option value="">Invoice No</option>  
                	<?php echo fill_brand($con); ?>  
                </select>  
                </div><!-- /.input group -->
            </div><!-- /.form group -->
            
            <div class="form-group">
            <label for="date">Handling Fee(TK)</label>
            	<div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="cost" name="cost" placeholder="0.00(TK)" required>
                </div><!-- /.input group -->
            </div><!-- /.form group -->
                
            <div class="form-group">
            <label for="date">Shipment to Name</label>
            	<div class="input-group col-md-12">
                <select name="hname" id="hname" class="form-control" autofocus required>
                <option value="">Name</option>
                	<?php
					$query2=mysqli_query($con,"select * from handler where hand_status <> 'pending'")or die(mysqli_error());
					while($row2=mysqli_fetch_array($query2)){
					?>
                	<option value="<?php echo $row2['hand_id'];?>"><?php echo $row2['hand_first']." ".$row2['hand_mi']." ".$row2['hand_last'];?></option>
			    	<?php }?>  
                </select>
                </div><!-- /.input group -->
            </div><!-- /.form group -->
            
           <div class="form-group">
            	<div class="input-group">
                <button type="submit" class="btn btn-primary" id="daterange-btn" name="">Save</button>
				<button class="btn" id="daterange-btn">Clear</button>
                </div>
            </div><!-- /.form group -->
			</form>		
                </div><!-- /.box-body -->
              </div><!-- /.box -->
          </div><!-- /.col (right) -->
            
          <div class="col-xs-8">
          <div class="box box-primary">
          
          		<h3 class="box-title">&nbsp;&nbsp;Shipment Invoice List</h3>
    	      <div class="box-header" id="show_product">             	
    
    			  <!--<div class="row" id="show_product">-->
                  <?php echo fill_product($con);?>  
             
              </div><!-- /.box-header -->              
              
              
              
          </div><!-- /.col -->
		  </div><!-- /.row -->
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
    
    
 <script>  
 $(document).ready(function(){  
      $('#brand').change(function(){  
           var brand_id = $(this).val();  
           $.ajax({  
                url:"invoice_data_load.php",  
                method:"POST",  
                data:{brand_id:brand_id},  
                success:function(data){  
                     $('#show_product').html(data);  
                }  
           });  
      });  
 });  
 </script>
 
 
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
