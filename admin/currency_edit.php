<?php include 'header.php';

$borrow_id = $_REQUEST['borrow_id'];
$userid = $_REQUEST['user_id'];
	
	$borrow_query = mysql_query("SELECT * FROM borrow_book LEFT JOIN book ON borrow_book.book_id = book.book_id LEFT JOIN user ON borrow_book.user_id = user.user_id WHERE borrow_book.borrow_book_id = '$borrow_id' ORDER BY borrow_book.borrow_book_id DESC") or die(mysql_error());
 			$borrow_count = mysql_num_rows($borrow_query);
			$borrow_row = mysql_fetch_array($borrow_query);
			
			$duedate=$borrow_row['due_date'];
		    $dateborrowed=$borrow_row['date_borrowed'];
			
			
?>
<!-- HEARDER end -->
<div class="page-title">
	<div class="title_left">
    <h3><small>Home /  Borrowed List Reports / Returned Books / Penalty</small></h3></div>
    </div>
    <div class="clearfix"></div>
</div>
                
          
<!-- page content -->
<div class="left_col" role="main"><!-- ./left_col --> 
<div class="row"><!-- ./row --> 
<div class="col-md-12 col-sm-12 col-xs-12"><!-- ./col-md 12-->
<div class="x_panel"><!-- ./x_panel-->
<div class="x_title"><!-- ./x_title-->
 <?php
						
					?>
					<h2>
					Borrower Name : <span style="color:maroon;"><?php echo $borrow_row['firstname']." ".$borrow_row['middlename']." ".$borrow_row['lastname']; ?></span>,
                    &nbsp;SUB ID: <span style="color:maroon;"><?php echo $borrow_row['sub_number']; ?></span>
					</h2> 

                                   	<ul class="nav navbar-right panel_toolbox">
                           			 <li>
										<a href="penalted.php" style="background:none;">
										<button class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
										</a>
									</li>
                    		        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			                        <!-- If needed 
            		                <li class="dropdown">
                    	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-wrench"></i>
                        	        </a>
                            	    <ul class="dropdown-menu" role="menu">
                                		<li><a href="#">Settings 1</a></li>
                                    	<li><a href="#">Settings 2</a></li>
                                	</ul>
                            		</li>-->
                                    
                            		<li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        			</ul>
                                    <div class="clearfix"></div>
                                	</div><!-- ./x_title end--><br/>
                                    
                                  

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class = "col-md-4 col-lg-4 col-xs-4">
		<?php include('adjust_penalty.php');?>
        </div>
		<div class = "col-md-8 col-lg-8 col-xs-8">
		<div class = "x-panel">
        <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered table-responsive" >
		<thead>
		<tr>
			<th>Barcode</th>
			<th>prp NO</th>
			<th>Penalty</th>
			<th>prv.Penalty</th>
			<th>Reference</th>
			<th>Up.Date</th>									
		</tr>
		</thead>
				<?php 
				$borrow_query1 = mysql_query("SELECT * FROM borrow_book LEFT JOIN book ON borrow_book.book_id = book.book_id LEFT JOIN user ON borrow_book.user_id = user.user_id Where borrow_book.user_id = '$userid' and borrow_book.borrowed_status = 'returned' and borrow_book.book_penalty <> 'No Penalty' ORDER BY borrow_book.user_id") or die(mysql_error());
				
				
						while($borrow_row1 = mysql_fetch_array($borrow_query1)){
						$id = $borrow_row1 ['borrow_book_id'];
						$book_id = $borrow_row1 ['book_id'];
						$borrow_book_id = $borrow_row1 ['user_id'];
											
				?>
        <tbody>
		<tr>
			<td><a target="_blank" href="../extra/print_barcode_individual1.php?code=<?php echo $borrow_row1['book_barcode']; ?>"><?php echo $borrow_row1['book_barcode']; ?></a></td>
			<td><?php echo $borrow_row1['prp_no']; ?></td>
			<td><?php echo $borrow_row1['book_penalty'];?></td>
			<td><?php echo $borrow_row1['previous_penalty'];?></td>
			<td><?php echo $borrow_row1['reference'];?></td>
			<td><?php echo $borrow_row1['update_date'];?></td>
		</tr>
		</tbody>		
        <?php } ?>						
		</table>
        </div>
		<div>
		</div>
	</div>
 </div><!-- ./col-md 12 end-->    
</div>
</div><!-- ./row end--> 
</div><!-- ./left_col end--> 		
<!-- /page content -->


    <?php include('../footer.php')?>
	