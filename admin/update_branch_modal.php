<div id = "update<?php echo $id;?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
					 <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Edit Branch Details</h4>
                        </div>
                        <div class="modal-body">
                         <form method = "POST" action = "update_branch.php"> 
						   <input type="hidden" name="branch_id" value="<?php echo $id;?>">
								<label>Auctiva Name</label>
									<input type="text" id="auctiva_name" name = "auctiva_name" class="form-control" value = "<?php echo $row1['auctiva_name'];?>">
									<br/>								
								<label>Auctiva Mail</label>
									<input type="text" id="auctiva_mail" name = "auctiva_mail" class="form-control" value = "<?php echo $row1['auctiva_mail'];?>">
									<br/>
								<label>PayPal Mail</label>
									<input type="text" id="paypal_mail" name = "paypal_mail" class="form-control" value = "<?php echo $row1['paypal_mail'];?>">
									<br/>
								<label>Skin</label>
									<select name = "skin" class = "form-control">
										<option value = "<?php echo $row1['skin'];?>"><?php echo $row1['skin'];?></option>
										<option>red</option>
										<option>purple</option>	
										<option>black</option>
										<option>blue</option>
										<option>green</option>
										<option>yellow</option>
									</select>
									<br/>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button  name = "update" class="btn btn-primary">Save changes</button>
						</form>
						</div>
                        <div class="modal-footer">
                          
                        </div>
                      </div>
                    </div>
				</div>