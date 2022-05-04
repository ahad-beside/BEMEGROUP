<?php 
	session_start();
	if(empty($_SESSION['id'])):
	header('Location:../index.php');
	endif;
	include('../dist/includes/dbcon.php');
	
	//$id = $_POST['id'];
	$catid = $_POST['catid'];
	$reorder = $_POST['reorder'];
	$branch = $_SESSION['branch'];
	
	$query = mysqli_query($con,"SELECT * FROM stockin where cat_id='$catid'") or die(mysqli_error($con));
	$row = mysqli_fetch_array($query);
	$reord=$row['reorder'];
	$pre_ord=$row['pre_reorder'];
	//echo $reorder;
	
	if($reorder>$reord)
	{
		mysqli_query($con,"update stockin set reorder='$reorder', pre_reorder='$reord' where cat_id='$catid' and branch_id='$branch' ")or die(mysqli_error($con));
		echo "<script type='text/javascript'>alert('Successfully updated product details!');</script>";
		echo "<script>document.location='stockin.php'</script>"; 
	}
	else
	{
		echo "<script type='text/javascript'>alert('Reorder add to previous reorder & Greather than !');</script>";
		echo "<script>document.location='product.php'</script>";
	}
	
?>
