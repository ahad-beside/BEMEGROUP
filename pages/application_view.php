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
    <title>Shipment Handler | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
 
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body>
    <div class="wrapper">
      <?php 
      include('../dist/includes/dbcon.php');
      ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          
          <section class="content-header">
          <h1><a href = "javascript:window.close();"><button type="button" class="btn btn-lg btn-danger"><i class ="glyphicon glyphicon-remove"></i> Close</button></a></h1>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
	           <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Creditor Application</h3>
                </div>
  <?php          
      $cid=$_GET['cid'];
      $query=mysqli_query($con,"select * from handler where hand_id='$cid'")or die(mysqli_error());  
        $row=mysqli_fetch_array($query);
        
  ?>      

                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="creditor_add.php" enctype="multipart/form-data" class="form-horizontal">
                  <div class="row">
                    <div class="col-md-6">
          					  <label for="date">First Name</label>
                      <div class="input-group col-md-12">
            						<div class="input-group col-sm-12">
            						  <?php echo $row['hand_first'];?>
            						</div><!-- /.input group -->
          					  </div><!-- /.form group -->
                    </div>
                    
                    <div class="col-md-2">
          					  <label for="date">Middle Name</label>
                      <div class="input-group col-md-12">
            						<div class="input-group col-sm-12">
            						  <?php echo $row['hand_mi'];?>
            						</div><!-- /.input group -->
          					  </div><!-- /.form group -->
                    </div>
                    
                    <div class="col-md-4">  
                      <label for="date">Last Name</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['hand_last'];?>
                      </div><!-- /.input group -->
                      
                    </div>
                  </div><!--row-->
                  
                  <div class="row">
                    <div class="col-md-3">
                      <label for="date">Nick Name</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['nickname'];?>
                        </div>
                    </div>
                    <div class="col-md-3">  
                      <label for="date">Birthday</label>
                      <div class="input-group col-md-12">
                          <?php echo date("M d, Y",strtotime($row['bday']));?>
                      </div><!-- /.input group -->
                    </div>
                    
                    <div class="col-md-2">  
                      <label for="date">Tel # and Cellphone #</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['hand_contact'];?>
                      </div><!-- /.input group -->
                    </div>
                    
                    <div class="col-md-4">  
                      <label for="date">Picture</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['hand_pic'];?>
                      </div><!-- /.input group -->
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-md-12">  
                      <label for="date">Present Home Address</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['hand_address'];?>
                      </div><!-- /.input group -->
                    </div>
                  </div><!--row-->  
                  
                  <div class="row">
                    <div class="col-md-3">  
                      <label for="date">House Status</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['house_status'];?>
                          <?php echo $row['years'];?>
                      </div>

                    </div>
                    

                    <div class="col-md-12">
                      <label for="date">If renting</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['rent'];?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                      <label for="date">Occupation</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['occupation'];?>
                        </div>  
                      </div>
                      
                      <div class="col-md-6">
                      <label for="date">Monthly Salary/ Net Business Income</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['salary'];?>
                        </div>  
                      </div>
                      
                      <div class="col-md-12">
                      <label for="date">Employer or Business Address & Telephone Number</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['emp_address'];?>
                        </div>  
                      </div>
                    
                   <div class="col-md-6">
                      <label for="date">Spouse Name</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['spouse'];?>
                        </div>  
                      </div>
                    <div class="col-md-6">
                      <label for="date">Cellphone Number</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['spouse_no'];?>
                        </div>  
                      </div>    
                    <div class="col-md-6">
                      <label for="date">Spouse Employer or Business</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['spouse_emp'];?>
                        </div>  
                      </div>
                    <div class="col-md-6">
                      <label for="date">Spouse Monthly Income</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['spouse_income'];?>
                        </div>  
                      </div>  
                    <div class="col-md-12">
                      <label for="date">Spouse Employer or Business Address & Telephone Number</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['spouse_details'];?>
                        </div>  
                      </div>  
                    
                    <div class="col-md-3">
                      <label for="date">Name of Co-Maker (If required)</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['comaker'];?>
                        </div>  
                      </div>
                      
                    <div class="col-md-9">
                      <label for="date">Present Home Address & Telephone # of Co-Maker</label>
                      <div class="input-group col-md-12">
                          <?php echo $row['comaker_details'];?>
                      </div>  
                    </div>    
                    
                  </div><!--row-->     
                    
					
				  </form>	

                
        
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           
          
            </div></div>
            

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
