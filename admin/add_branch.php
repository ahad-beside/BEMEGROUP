<?php 
	include 'dbcon.php';
	$ebay_name = $_POST['ebay_name'];
	$ebay_mail = $_POST['ebay_mail'];
	$auctiva_name = $_POST['auctiva_name'];
	$auctiva_mail = $_POST['auctiva_mail'];
	$paypal_mail = $_POST['paypal_mail'];
	$ebay_address = $_POST['address'];
	$skin = $_POST['skin'];
	
	mysqli_query($con,"INSERT INTO branch(ebay_name,ebay_mail,auctiva_mail,auctiva_name,paypal_mail,ebay_address,skin) 
	VALUES('$ebay_name','$ebay_mail','$auctiva_name','$auctiva_mail','$paypal_mail','$ebay_address','$skin')")or die(mysqli_error($con));  
	
	echo "<script type='text/javascript'>alert('Data Successfully Saved!');</script>";
	echo "<script>window.location='branch.php'</script>";   

?>