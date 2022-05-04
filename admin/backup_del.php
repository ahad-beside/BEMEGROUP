 <?php

if(isset($_POST['remve_file']))
{
    $file_Path = $_POST['fileToRemove'];
    
    // check if the file exist
    if(file_exists($file_Path))
    {
        unlink($file_Path);
        
    }
	else
	{
        echo 'File Not Exist';
    }
}

echo "<script type='text/javascript'>alert('Successfully Delete backup for your select database!');</script>";
 echo "<script>document.location='settings.php'</script>"; 
?>
