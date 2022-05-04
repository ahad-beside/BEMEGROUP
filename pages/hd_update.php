<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['id'];
	$ci =$_POST['ci'];
	$nid =$_POST['nid'];
	$photo = $_POST['photo'];
	$cert = $_POST['cert'];
	$other_doc = $_POST['other_doc'];
	$income = $_POST['income'];
	$name = $_POST['name'];
	$date = $_POST['date'];

	
	mysqli_query($con,"update customer set ci_remarks='$ci',nid='$nid',
	photo='$photo',certificate='$cert',other_document='$other_doc',income='$income',ci_name='$name',ci_date='$date' where cust_id='$id'")or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Successfully added creditor details!');</script>";
	echo "<script>document.location='creditor.php'</script>";  

	
?>

