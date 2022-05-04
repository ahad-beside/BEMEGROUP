<?php 
	session_start();
	$branch=$_SESSION['branch'];
	include('../dist/includes/dbcon.php');

	$category = $_POST['category'];
	$reorder = $_POST['reorder'];
	//$serial = $_POST['serial'];
	
	$query2=mysqli_query($con,"select * from stockin where cat_id='$category' and branch_id='$branch'")or die(mysqli_error($con));
	$count=mysqli_num_rows($query2);

	if ($count>0)
	{
		echo "<script type='text/javascript'>alert('Product already exist!');</script>";
		echo "<script>document.location='product.php'</script>";  
	}
	else
	{
	
		$sql="INSERT INTO stockin(cat_id,reorder,branch_id)VALUES('$category','$reorder','$branch')";
		mysqli_query($con,$sql)or die(mysqli_error($con));

		echo "<script type='text/javascript'>alert('Successfully added new Product Packet!');</script>";
		echo "<script>document.location='stockin.php'</script>";  
	
	}
	
?>