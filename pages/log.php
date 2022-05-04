<?php 
	session_start();
	if(empty($_SESSION['id'])):
	header('Location:../index.php');
	endif;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Creditor | <?php include('../dist/includes/title.php');?></title>
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
          <section class="content-header"><!--./content-header -->
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
              
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">History Log</li>
            </ol>
          </section><!--./content-header end-->

          <!-- Main content -->
          <section class="content">
            <div class="row"><!-- /.row-->
	     	<div class="col-xs-12"><!-- /.col-->
              <div class="box box-primary"><!-- /.box-body -->
              <div class="box-header">
              	<h3 class="box-title">History Log</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              	<thead>
                <tr>
                	<th>Log</th>
                </tr>
                </thead>
                
                <tbody>
		<?php
			$query=mysqli_query($con,"select * from history_log natural join user order by date desc")or die(mysqli_error());
			while($row=mysqli_fetch_array($query)){
		?>
        		<tr>
                	<td><?php echo $row['name']." ".$row['action']." last ".$row['date'];?></td>
                </tr>
		<?php }?>					  
                </tbody>
                
               
              </table>
              </div><!-- /.box-body end-->
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
     
	
  </body>
</html>
