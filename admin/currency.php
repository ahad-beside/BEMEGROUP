  <div class="x_panel">
                  <div class="x_title">
                    <h2>Currency <i class = "fa fa-usd"></i><small>per 1.00 taka</small></h2>
                    <ul class="nav navbar-right panel_toolbox"> 
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    
                    <table class="table table-striped">
                    <thead>
                    <tr>
                    	<th>Amount (USD)</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    	<?php
							
							$sql1= mysqli_query($con,"select * from currency order by curr_id DESC ") or die (mysqli_error());
							while ($row1= mysqli_fetch_array($sql1) ){
							$curr_id=$row1['curr_id'];
							
						?>
                        <tr>
                            <td><?php echo $row1['curr_usd']; ?></td>
                            <td><a class="btn btn-primary" for="ViewAdmin" href="#currency_edit<?php echo $curr_id; ?>" data-toggle="modal" data-target="#currency_edit<?php echo $curr_id;?>"><i class="fa fa-edit"></i> Edit</a></td>
                            
                            <!-- edit modal -->
							<div class="modal fade" id="currency_edit<?php  echo $curr_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
								<div class="modal-content">
                                	<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Edit</h4>
									</div>
                                    <div class="modal-body">
									<?php
										$query2=mysqli_query($con,"select * from currency where curr_id='$curr_id'")or die(mysqli_error());
										$row2=mysqli_fetch_array($query2);
									?>
									<form method="post" enctype="multipart/form-data" class="form-horizontal">
									<div class="form-group" style="margin-left:170px;">
										<label class="control-label col-md-4" for="first-name">Amount <span class="required">*</span></label>
										<div class="col-md-3">
											<!--<input type="number" min="0" max="100" step="1" name="curr_usd" value="<?php echo $row2['curr_usd']; ?>" id="first-name2" class="form-control">-->
                                            <input type="text" name="curr_usd" value="<?php echo $row2['curr_usd']; ?>" id="first-name2" class="form-control">
                                        </div>
									</div>
									
                                    <div class="modal-footer" style="margin-top:50px;">
										<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> No</button>
                                        <button type="submit" style="margin-bottom:5px;" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Yes</button>
                                    </div>
									</form>
												
									<?php
										if (isset($_POST['submit'])) 
										{
											$curr_usd1 = $_POST['curr_usd'];
											{
												mysqli_query ($con,"UPDATE currency SET curr_usd='$curr_usd1' ") or die (mysqli_error());
											}
											
											{
												echo "<script>alert('Edit Successfully!'); window.location='settings.php'</script>";
											}
										}
									?>
												
										</div>
                                </div>
                            </div> 
                        </tr>
                        <?php } ?>    
                    </tbody>
                    </table>
                  </div>
                </div>