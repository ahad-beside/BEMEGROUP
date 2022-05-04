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
          
          <section class="content-header">
          <h1><a class="btn btn-lg btn-warning" href="home.php">Back</a>
             <a class="btn btn-lg btn-primary" href="application.php">Apply as Shipment Handler</a>
          </h1>
          <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Creditor</li>
          </ol>
          </section>

          <!-- Main content -->
          <section class="content">
          <div class="row">
	        <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Shipment Handler List</h3>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                	<th>Full Name</th>
                    <th>Address</th>
					<th>Contact #</th>
                    <th>CI Name</th>
                    <th>CI Date</th>
                    <th>Remarks</th>
					<th>Application Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                
                <tbody>
				<?php
					$branch=$_SESSION['branch'];
					$query=mysqli_query($con,"select * from handler where branch_id='$branch' and hand_status <>''")or die(mysqli_error());
					$i=1;
					while($row=mysqli_fetch_array($query)){
				      $cid=$row['hand_id'];
					  $ci=$row['ci_remarks'];
				      $nid=$row['nid']; if($nid==1) $nid1='checked';
				      $photo=$row['photo'];if($photo==1) $photo1='checked';
				      $cert=$row['cert'];if($cert==1) $cert1='checked';
				      $other_document=$row['other_document'];if($other_document==1) $other_document1='checked';
				      $income=$row['income'];if($income==1) $income1='checked';
				?>
                <tr>
					<td><?php echo $row['hand_first']." ".$row['hand_mi']." ".$row['hand_last'];?></td>
                    <td><?php echo $row['hand_address'];?></td>
				    <td><?php echo $row['hand_contact'];?></td>
                    <td><?php echo $row['ci_name'];?></td>
                    <td><?php echo $row['ci_date'];?></td>
                    <td><?php echo $row['ci_remarks'];?></td>
					<td><?php echo $row['hand_status'];//if ($row['balance']==0) 
						//echo "<span class='label label-danger'>inactive</span>";
						//else echo "<span class='label label-info'>active</span>";
						?></td>
                    <td>
                    	<a href="#updateordinance<?php echo $row['hand_id'];?>" data-target="#updateordinance<?php echo $row['hand_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-orange"></i></a>
 		                <a href="application_view.php?cid=<?php echo $row['hand_id'];?>" class="small-box-footer" target="_blank"><i class="glyphicon glyphicon-eye-open text-primary"></i></a></td>
                </tr>
				<div id="updateordinance<?php echo $row['hand_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
				  <div class="modal-content" style="height:400px">
	              <div class="modal-header">
    	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  	<span aria-hidden="true">×</span></button>
                	<h4 class="modal-title">Update CI Details</h4>
	              </div>
              
              	<div class="modal-body">
			  	<form class="form-horizontal" method="post" action="hd_update.php" enctype='multipart/form-data'>
		    
                <div class="form-group">
        	  		<label class="control-label col-lg-3" for="name">CI Name</label>
			        <div class="col-lg-9">
            		<input type="text" class="form-control" id="id" name="name" value="<?php echo $row['ci_name'];?>" placeholder="Name of CI" required> 
			        </div>
		        </div>        
				
                <div class="form-group">
					<label class="control-label col-lg-3" for="name">CI Remarks</label>
					<div class="col-lg-9">
					<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['hand_id'];?>">  
					<textarea class="form-control" id="name" name="ci" required><?php echo $ci;?></textarea> 
					</div>
				</div>
		
                <div class="form-group">
          			<label class="control-label col-lg-3" for="name">CI Date</label>
          			<div class="col-lg-9">
		            <input type="date" class="form-control" id="date" name="date" value="<?php echo $row['ci_date'];?>" placeholder="YYYY-MM-DD" required> 
        		  	</div>
        		</div>
                        
				<div class="form-group">
					<label class="control-label col-lg-3" for="name">Requirements</label>
					<div class="col-lg-9"></div>
				</div>				
        
        		<div class="form-group">
		          	<label class="control-label col-lg-3" for="name"></label>
        		  	<div class="col-lg-9">
		          	<input type="checkbox" class="form-check" id="name" name="nid" value="1" <?php echo $nid;?>>  NID Copy
          			</div>
        		</div>        
        		
                <div class="form-group">
          			<label class="control-label col-lg-3" for="name"></label>
			        <div class="col-lg-9">
            		<input type="checkbox" class="form-check" id="name" name="photo" value="1" <?php echo $photo;?>> 2 Copy Photo 
          			</div>
        		</div>        
                
        		<div class="form-group">
          			<label class="control-label col-lg-3" for="name"></label>
		        	<div class="col-lg-9">
            		<input type="checkbox" class="form-check" id="name" name="cert" value="1" <?php echo $cert;?>> Certificate 
          			</div>
       	 		</div>        
                
        		<div class="form-group">
		        	<label class="control-label col-lg-3" for="name"></label>
          			<div class="col-lg-9">
            		<input type="checkbox" class="form-check" id="name" name="other_doc" value="1" <?php echo $other_document;?>> Other Document
          			</div>
        		</div>        
                
        		<div class="form-group">
          			<label class="control-label col-lg-3" for="name"></label>
          			<div class="col-lg-9">
            		<input type="checkbox" class="form-check" id="income" name="income" value="1" <?php echo $income;?>>  Proof of Income
          			</div>
        		</div>        
				
				</div><br><br><br><hr>
              	
                <div class="modal-footer">
					<button type="submit" class="btn btn-primary">Save changes</button>
		            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              	</div>
			    
                </form>
                </div>
		        </div><!--end of modal-dialog-->
 				</div><!--end of modal-->   	  
 					  <?php $i++;}?>					  
                </tbody>
                
                <!--<tfoot>//USE OPTIONAL
                <tr>
                	<th>Customer Full Name</th>
                    <th>Address</th>
					<th>Contact #</th>
                    <th>CI Name</th>
                    <th>CI Date</th>
                    <th>Remarks</th>
					<th>Application Status</th>
                    <th>Action</th>
                </tr>					  
                </tfoot>-->
                </table>
             </div><!-- /.box-body -->
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
