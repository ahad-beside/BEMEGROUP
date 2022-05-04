<?php 
include 'header.php';
//$branch_id = $_GET['id'];		//download first this code
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       <?php include 'main_sidebar.php';?>
       <?php include 'top_nav.php';?>      <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main"> 
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">					
						<div class = "x-panel">
	             <table id="example1" class="table table-bordered table-striped">
                 <thead>
                 <tr>
                 	<th>Full Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Application Status</th>
                    <th>Branch name</th>
                    <th>Action</th>
                 </tr>
                 </thead>
                 <tbody>
<?php
//$branch=$_SESSION['branch'];		//download fisrt this code
$query=mysqli_query($con,"select * from handler LEFT JOIN branch ON handler.branch_id = branch.branch_id where hand_status='pending' order by ebay_name ASC")or die(mysqli_error());
    $i=1;
    while($row=mysqli_fetch_array($query)){
    $hid=$row['hand_id'];
    $ci=$row['ci_remarks'];
    $nid=$row['nid']; if($nid==1) $nid1='checked';
    $photo=$row['photo'];if($photo==1) $photo1='checked';
    $cert=$row['cert'];if($cert==1) $cert1='checked';
    $other_document=$row['other_document'];if($other_document==1) $other_document1='checked';
    $income=$row['income'];if($income==1) $income1='checked';
?>
                 <tr>
                 	<td><?php echo $row['hand_first']." ".$row['hand_mi']." ".$row['hand_last']; ?></td>
                    <td><?php echo $row['hand_address'];?></td>
                    <td><?php echo $row['hand_contact'];?></td>
               		<td><?php echo $row['hand_status'];	//if ($row['balance']==0) 
                	//echo "<span class='label label-danger'>inactive</span>";
					//else echo "<span class='label label-info'>active</span>";?></td>
                    <td><?php echo $row['ebay_name'];?></td> 
                    <td>
               	<a href="#updateordinance<?php echo $row['hand_id'];?>" data-target="#updateordinance<?php echo $row['hand_id'];?>" data-toggle="modal" class="small-box-footer"><i class="glyphicon glyphicon-edit text-orange"></i></a>
        		<a href="application_view.php?hid=<?php echo $row['hand_id'];?>" class="small-box-footer" target="_blank"><i class="glyphicon glyphicon-eye-open text-primary"></i></a>
            		</td>
                 </tr>
<div id="updateordinance<?php echo $row['hand_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
      
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span></button>
      <h4 class="modal-title">Application Status</h4>
      </div>
      
      <div class="modal-body">
      <form class="form-horizontal" method="post" action="application_update.php" enctype='multipart/form-data'>
      <div class="form-group">
      	<label class="control-label col-lg-3" for="name">Application Status</label>
      	<div class="col-lg-9">
      	<input type="hidden" name="hid" value="<?php echo $hid;?>">
        	<select class="form-control" id="hid" name="status">  
        	<option>Approved</option>
            <option>Disapproved</option>
            <option>Pending</option>
        </select>
        </div>
      </div>
             
    </div><br>
    <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Save changes</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
      </form>
</div>
</div><!--end of modal-dialog-->
</div>
 <!--end of modal-->      
<?php $i++;}?>            
                 </tbody>
                 <!--<tfoot>		//ADDTION USE FOR NESSERY
                 <tr>
                 	<th>Customer Last Name</th>
                    <th>Customer First Name</th>
                    <th>Address</th>
                    <th>Contact #</th>
                    <th>Application Status</th>
                    <th>Action</th>
                 </tr>           
                 </tfoot>-->
                 </table>
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

	<?php include 'datatable_script.php';?>
    <!-- /gauge.js -->
  </body>
</html>
