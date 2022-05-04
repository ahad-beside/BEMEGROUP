<?php session_start();
	if(empty($_SESSION['id'])):
	header('Location:../index.php');
	endif;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Reorder | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <style></style>
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
	      	<div class="col-xs-12">
              <div class="box box-primary">
              	<div class="box-header">
                  <h3 class="box-title">Reorder List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  	<th>Product Category</th>
                    <th>Qty Packet</th>           		
            		<th>Reorder Packet</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  
                  <tbody>
				  <?php  
					$query=mysqli_query($con,"SELECT * FROM `stockin` natural join category WHERE prod_qty<>reorder and branch_id='$branch' order by cat_name")or die(mysqli_error());
					while($row=mysqli_fetch_array($query)){
				  ?>
                  
                  <tr>
                  	<td><?php echo $row['cat_name'];?></td>
                    <td><?php echo $row['prod_qty'];?></td>
            		<td><?php echo $row['reorder'];?></td>
                    <td class="text-center"><?php if ($row['prod_qty']<>$row['reorder']) echo "<span class='badge bg-red'><i class='glyphicon glyphicon-refresh'></i>Reorder</span>";?></td>
                  </tr>
				 <?php }?>					  
                    </tbody>
                                       
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.box-primery -->
          </div><!-- /.col -->
 		</div><!-- /.row -->      
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
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
