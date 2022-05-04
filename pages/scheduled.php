<?php 
	session_start();
	if(empty($_SESSION['id'])):
	header('Location:../index.php');
	endif;
	include('../dist/includes/dbcon.php');
	$year = date("Y");
	$month = date("m");	
	$query = mysqli_query($con,"SELECT * FROM `barcode` ORDER BY item_incre DESC ") or die (mysqli_error($con));
	$fetch = mysqli_fetch_array($query);
	$item_incre = $fetch['item_incre'];
						
	$new_barcode =  $item_incre + 1;
	$y_barcode = "PD"."$year";
	$m_barcode = "$month";
	$generate_barcode = $y_barcode.$m_barcode.$new_barcode;
	
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
          <h1><a class="btn btn-lg btn-warning" href="home.php">Back</a>
              <a class="btn btn-lg btn-primary" href="#add" data-target="#add" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-plus text-blue"></i></a>
          </h1>
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
                  <h3 class="box-title">Product List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                	<th>Picture</th>
                    <th>Item Number</th>
                    <th>Title Name</th>                   
            		<th>Weight / Ct.</th>
            		<th>Approx Size / mm.</th>
            		<th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                
                <tbody>
				<?php
					$query=mysqli_query($con,"select * from prod_scheduled natural join supplier natural join category where branch_id='$branch' order by serial DESC")or die(mysqli_error());
					while($row=mysqli_fetch_array($query)){
				?>
                <tr>
                	<td><img style="width:80px;height:60px" src="../dist/uploads/<?php echo $row['prod_pic'];?>"></td>
                    <td><a href="#details<?php echo $row['prod_id'];?>" data-target="#details<?php echo $row['sch_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon-list text-blue"><?php echo $row['serial'];?></i></a></td>
                    <td><?php echo $row['prod_tname'];?></td>
					<td><?php echo $row['prod_weight'];?></td>
            		<td><?php echo $row['prod_size'];?></td>
            		<td><?php echo $row['prod_price'];?></td>
                    <td><?php if ($row['ebay_sold_id']=='0')
								echo "<span class='label label-info'>unsold</span>";
							  else if($row['ebay_sold_id']=='NULL')
							  	echo "<span class='label label-danger'>waiting</span>";
							  else	
								echo "<span class='label label-danger'>sold</span>";
						?></td>
                    <td><a href="#updateordinance<?php echo $row['sch_id'];?>" data-target="#updateordinance<?php echo $row['sch_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
                   </td>
                </tr>
				
              <!-- Items update ./ start --> 
              <!--<div id="updateordinance<?php //echo $row['prod_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">-->  
              
              <div id="updateordinance<?php if ($row['ebay_sold_id']=='NULL') echo $row['sch_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
			  <div class="modal-content" style="height:auto">
              <div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update eBay Sales</h4>
              </div>
              
              <div class="modal-body"><!--./ modal-body -->
			  <form class="form-horizontal" method="post" action="scheduledID_update.php" enctype='multipart/form-data'>
			  <input type="hidden" class="form-control" id="pid" name="pid" value="<?php echo $row['sch_id'];?>" readonly>
                   
              <div class="form-group">
				<label class="control-label col-lg-3" for="itemNo">eBay Item NO:</label>
				<div class="col-lg-9">
					<input type="text" class="form-control" id="itemNo" name="itemNo" required>  
				</div>
			  </div>
              
              </div><!--./ modal-body end--><br><br>
              
              <div class="modal-footer">
				<button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			  </form>
            
              </div>
			  </div><!--end of modal-dialog-->
			  </div><!--end of modal-->
              <!-- Items update ./ end --> 
              
              
              
              
              <!-- Items details ./ start -->
              <div id="details<?php echo $row['sch_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
			  <div class="modal-content" style="height:auto">
              <div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Product Details</h4>
              </div>
              
              <div class="modal-body"><!--./ modal-body -->
			  <form class="form-horizontal" method="post" action="#" enctype='multipart/form-data'>
        
        <div class="form-group">
          <label class="control-label col-lg-3" for="item_num">Item Number</label>
          <div class="col-lg-9">
          <input type="text" class="form-control" id="item_num" name="item_num" value="<?php echo $row['serial'];?>" readonly>  
          </div>
        </div>
                       
        <div class="form-group">
          <label class="control-label col-lg-3" for="tit_name">Title Name</label>
          <div class="col-lg-9">
          <textarea class="form-control" id="tit_name" name="tit_name"><?php echo $row['prod_tname'];?></textarea>  
          </div>
        </div>
        
        <div class="form-group">
				<label class="control-label col-lg-3" >Category</label>
				<div class="col-lg-9">
				<select class="form-control select2" style="width: 100%;" name="category" required>
                <option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></option>
                <?php
            	    $queryc=mysqli_query($con,"select * from category order by cat_name")or die(mysqli_error());
	                while($rowc=mysqli_fetch_array($queryc)){
                ?>
                <option value="<?php echo $rowc['cat_id'];?>"><?php echo $rowc['cat_name'];?></option>
                	<?php }?>
              	</select>
				</div><!-- /.input group -->
			  </div><!-- /.form group -->
                       
         <div class="form-group">
          <label class="control-label col-lg-3" for="size">Size / mm.</label>
          <div class="col-lg-9">
          <input type="text" class="form-control" id="size" name="size" value="<?php echo $row['prod_size'];?>">  
          </div>
        </div>
        
         <div class="col-md-6">  
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="weight">Weight / Ct.</label>
                <div class="input-group col-md-13">
                <input type="text" class="form-control pull-right" id="weight" name="weight" value="<?php echo $row['prod_weight'];?>">
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
                    
        <div class="col-md-6">
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="num_gems">Number of Gems</label>
                <div class="input-group col-sm-13">
                <input type="text" class="form-control pull-right" id="num_gems" name="num_gems" value="<?php echo $row['item_qty'];?>">
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
        
          
        <div class="col-md-6">  
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="color">Color</label>
                <div class="input-group col-md-13">
                <input type="text" class="form-control pull-right" id="color" name="color" value="<?php echo $row['prod_color'];?>">
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
                    
        <div class="col-md-6">
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="shape">Shape</label>
                <div class="input-group col-sm-13">
                <input type="text" class="form-control pull-right" id="shape" name="shape" value="<?php echo $row['prod_shape'];?>">
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
        
        <div class="col-md-6">  
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="clarity">Clarity</label>
                <div class="input-group col-md-13">
                <input type="text" class="form-control pull-right" id="clarity" name="clarity" value="<?php echo $row['prod_clarity'];?>">
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
                    
        <div class="col-md-6">
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="luster">Luster</label>
                <div class="input-group col-sm-13">
                <input type="text" class="form-control pull-right" id="luster" name="luster" value="<?php echo $row['prod_luster'];?>">
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
        
        <div class="col-md-6">  
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="hardness">Hardness</label>
                <div class="input-group col-md-13">
                <input type="text" class="form-control pull-right" id="hardness" name="hardness" value="<?php echo $row['prod_hardness'];?>">
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
                    
        <div class="col-md-6">
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="region">Region</label>
                <div class="input-group col-sm-13">
                <input type="text" class="form-control pull-right" id="region" name="region" value="<?php echo $row['prod_region'];?>">
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
        
        <div class="col-md-6">  
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="treatment">Treatment</label>
                <div class="input-group col-md-13">
                <input type="text" class="form-control pull-right" id="treatment" name="treatment" value="<?php echo $row['prod_treat'];?>">
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
                    
        <div class="col-md-6">
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="price">Price</label>
                <div class="input-group col-sm-13">
                <input type="text" class="form-control pull-right" id="price" name="price" value="<?php echo $row['prod_price'];?>" readonly>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
            
         <div class="form-group">
				<label class="control-label col-lg-3" for="file">Supplier</label>
				<div class="col-lg-9">
				<select class="form-control select2" style="width: 100%;" name="supplier" required>
				<option value="<?php echo $row['supplier_id'];?>"><?php echo $row['supplier_name'];?></option>
				<?php
					$query2=mysqli_query($con,"select * from supplier")or die(mysqli_error());
					while($row2=mysqli_fetch_array($query2)){
				?>
				<option value="<?php echo $row['supplier_id'];?>"><?php echo $row2['supplier_name'];?></option>
			    	<?php }?>
				</select>
				</div>
			  </div>      
                    
       
        
       <div class="form-group">
          <label class="control-label col-lg-3" for="picture">Picture</label>
          <div class="col-lg-9">
          <input type="file" class="form-control" id="picture" name="image">  
          </div>
        </div>
        
        <div class="modal-footer">
    	 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
            
              </div>
			  </div><!--end of modal-dialog-->
			  </div><!--end of modal-->           
              <!-- Items details ./ end -->
              
              
                       
					<?php }?>					  
                    </tbody>
                    
                    <!--<tfoot>
                    <tr>
                    	<th>Picture</th>
                        <th>Serial #</th>
                        <th>Product Name</th>
                        <th>Description</th>
						<th>Category</th>
                        <th>Qty</th>
						<th>Price</th>
						<th>Category</th>
						<th>Reorder</th>
                        <th>Action</th>
                    </tr>					  
                    </tfoot>-->
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
   
	
    
    
    <div id="add" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
 	<div class="modal-dialog">
    <div class="modal-content" style="height:auto">
    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">×</span></button>
    	    <h4 class="modal-title">Add New Scheduled Product</h4>
	    </div>
        
        <div class="modal-body">
        <form class="form-horizontal" method="post" action="scheduled_add.php" enctype='multipart/form-data'>
        <input type="hidden" name="new_barcode" value="<?php echo $new_barcode; ?>">
        <!--<div class="form-group">
          <label class="control-label col-lg-3" for="item_num">Item Number</label>
          <div class="col-lg-9">
          <input type="text" class="form-control" id="item_num" name="item_num" placeholder="Item Number" required>  
          </div>
        </div>-->
                       
        <div class="form-group">
          <label class="control-label col-lg-3" for="tit_name">Title Name</label>
          <div class="col-lg-9">
          <textarea class="form-control" id="tit_name" name="tit_name" placeholder="Title Name" required></textarea>  
          </div>
        </div>
        
        <div class="form-group">
        	<label class="control-label col-lg-3" for="gems_type">Gems Type</label>
            <div class="col-lg-9">
            <select class="form-control select2" style="width: 100%;" name="gems_type" name="gems_type" placeholder="Gems Type" required>
            <option></option>
            <?php
            	$queryc=mysqli_query($con,"select *,SUM(prod_qty-prod_status) as tot_qty from stockin natural join category where prod_qty<>prod_status and branch_id = '".$_SESSION['branch']."' group by cat_name ASC")or die(mysqli_error());
                while($rowc=mysqli_fetch_array($queryc)){
            ?>																					
            <option value="<?php echo $rowc['cat_id'];?>"><?php echo $rowc['cat_name']." Available(".$rowc['tot_qty'].")";?></option>
                <?php }?>
            </select>
            </div><!-- /.input group -->
        </div><!-- /.form group -->
        
         <div class="form-group">
          <label class="control-label col-lg-3" for="size">Size / mm.</label>
          <div class="col-lg-9">
          <input type="text" class="form-control" id="size" name="size" placeholder="Size" required>  
          </div>
        </div>
        
         <div class="col-md-6">  
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="weight">Weight / Ct.</label>
                <div class="input-group col-md-13">
                <input type="text" class="form-control pull-right" id="weight" name="weight" placeholder="Weight" required>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
                    
        <div class="col-md-6">
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="num_gems">Number of Gems</label>
                <div class="input-group col-sm-13">
                <input type="text" class="form-control pull-right" id="num_gems" name="num_gems" placeholder="Number of Gems" required>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
        
          
        <div class="col-md-6">  
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="color">Color</label>
                <div class="input-group col-md-13">
                <input type="text" class="form-control pull-right" id="color" name="color" placeholder="Color" required>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
                    
        <div class="col-md-6">
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="shape">Shape</label>
                <div class="input-group col-sm-13">
                <input type="text" class="form-control pull-right" id="shape" name="shape" placeholder="Shape" required>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
        
        <div class="col-md-6">  
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="clarity">Clarity</label>
                <div class="input-group col-md-13">
                <input type="text" class="form-control pull-right" id="clarity" name="clarity" placeholder="Clarity" required>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
                    
        <div class="col-md-6">
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="luster">Luster</label>
                <div class="input-group col-sm-13">
                <input type="text" class="form-control pull-right" id="luster" name="luster" placeholder="Luster" required>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
        
        <div class="col-md-6">  
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="hardness">Hardness</label>
                <div class="input-group col-md-13">
                <input type="text" class="form-control pull-right" id="hardness" name="hardness" placeholder="Hardness" required>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
                    
        <div class="col-md-6">
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="region">Region</label>
                <div class="input-group col-sm-13">
                <input type="text" class="form-control pull-right" id="region" name="region" placeholder="Region" required>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
        
        <div class="col-md-6">  
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="treatment">Treatment</label>
                <div class="input-group col-md-13">
                <input type="text" class="form-control pull-right" id="treatment" name="treatment" placeholder="Treatment" required>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>
                    
        <div class="col-md-6">
            	<div class="form-group">
                <label class="col-sm-5 control-label" for="price">Price</label>
                <div class="input-group col-sm-13">
                <input type="text" class="form-control pull-right" id="price" name="price" placeholder="Price" required>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
        </div>   
        
        <div class="form-group">
          <label class="control-label col-lg-3" for="supplier">Supplier</label>
          <div class="col-lg-9">
          <select class="form-control select2" style="width: 100%;" id="supplier" name="supplier" required>
          <option></option>
          <?php
          	$query2=mysqli_query($con,"select * from supplier")or die(mysqli_error());
            while($row2=mysqli_fetch_array($query2)){
          ?>
          <option value="<?php echo $row2['supplier_id'];?>"><?php echo $row2['supplier_name'];?></option>
            <?php }?>
          </select>
          </div>
        </div> 
        
       <div class="form-group">
          <label class="control-label col-lg-3" for="picture">Picture</label>
          <div class="col-lg-9">
          <input type="file" class="form-control" id="picture" name="image">  
          </div>
        </div>
        
        <div class="modal-footer">
    	  <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
        </div>
        </div><!--end of modal-dialog-->
 		</div><!--end of modal--> 
        </div>
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
