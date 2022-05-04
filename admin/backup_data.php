  <div class="x_panel">
                  <div class="x_title">
                    <h2>Backup DataBase <i class = "fa fa-hdd-o"></i></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    	<li><a href="backup.php" id="sss"><img src="images/backup.png" height="30px;" alt="backup" /></a></li>
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </ul>
                    <div class="clearfix"></div>
                    
                    <ul class="nav navbar-right panel_toolbox"> 
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>File Name</th>
                                                <th>Download</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>

<?php 
// List the files
$dir = opendir ("./include"); 
while (false !== ($file = readdir($dir))) { 

	// Print the filenames that have .sql extension
	if (strpos($file,'.sql',1)) { 

	// Remove the sql extension part in the filename delete("target.txt");
	$filenameboth = str_replace('.sql', '', $file);
                        
	// Print the cells
?>
		<tr>
			<td><?php echo $filenameboth.'.sql'; ?></td>
		    <td><span class="glyphicon glyphicon-download"></span><a href="<?php echo 'include/'.$filenameboth.'.sql'; ?>"> Download</a></td>
			<td><form action="backup_del.php" method="post">
            	<input type="hidden" name="fileToRemove" value="<?php echo 'include/'.$filenameboth.'.sql'; ?>"><br><br>
                <input type="submit" name="remve_file" value="Delete">
            	</form></td>
           </tr>

<?php		
	} 
} 
?>
	
                          </tbody>
                                    </table>
                            
                   
                   
                   
                   
                   
                  </div>
                </div>