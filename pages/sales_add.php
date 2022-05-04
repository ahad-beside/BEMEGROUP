<?php 
	session_start();
	$id=$_SESSION['id'];	
	include('../dist/includes/dbcon.php');

	$tot = $_POST['total'];
	$discount = $_POST['discount'];
	$pay_paid = $_POST['amount_due'];
	$ship_fee = $_POST['ship_fee'];
	$trans_id = $_POST['trans_id'];
	$t_date = $_POST['trans_date'];
	$ordcode = $_POST['new_ordcode'];
	
	//set timezone
	date_default_timezone_set('GMT');
	//display the converted time
	$trans_date = date("Y-m-d H:i:s",strtotime('+0 hour +0 minutes',strtotime($t_date)));
	
	$year = date("Y");
	$month = date("m");	
	$y_ordcode = "OR"."$year";
	$m_ordcode = "-"."$month"."-";
	//$generate_barcode = $y_barcode.$m_barcode.$code;
	$ordno = $y_ordcode.$m_ordcode.$ordcode;
	
	mysqli_query($con,"INSERT INTO ordercode (order_year,order_month,order_incre) values ('$y_ordcode', '$m_ordcode', '$ordcode')") or die (mysqli_error($con));
	
	$tot1=$pay_paid+$ship_fee;
	
	include('../dist/includes/asia_dhaka.php');
	$date = date("Y-m-d H:i:s");
	$cid=$_REQUEST['cid'];
	$branch=$_SESSION['branch'];
		
	mysqli_query($con,"INSERT INTO sales(cust_id,user_id,sales_price,discount,ship_fee,ship_file,invcode,date_added,branch_id,total_paid) 
	VALUES('$cid','$id','$pay_paid','$discount','$ship_fee','NULL','NULL','$date','$branch','$tot1')")or die(mysqli_error($con));
	
	$sales_id=mysqli_insert_id($con);
	$_SESSION['sid']=$sales_id;
	
	mysqli_query($con,"INSERT INTO payment(cust_id,sales_id,payment_paid,trans_id,trans_date,user_id,branch_id,date,or_no) 
	VALUES('$cid','$sales_id','$tot1','$trans_id','$trans_date','$id','$branch','$date','$ordno')")or die(mysqli_error($con));
	
	$payment_id=mysqli_insert_id($con);
	$_SESSION['payid']=$payment_id;
	$query=mysqli_query($con,"select * from temp_trans where branch_id='$branch'")or die(mysqli_error($con));
	while ($row=mysqli_fetch_array($query))
	{
		$pid=$row['sch_id'];	
 		$qty=$row['qty'];
		$price=$row['price'];
		$cat_id=$row['cat_id'];
		mysqli_query($con,"INSERT INTO sales_details(sch_id,price,sales_id,payment_id,branch_id) VALUES('$pid','$price','$sales_id','$payment_id','$branch')")or die(mysqli_error($con));
  	    mysqli_query($con,"UPDATE stockin SET sold_status='1' where cat_id='$cat_id' and branch_id='$branch'") or die(mysqli_error($con)); 
		
	}
	
	$query1=mysqli_query($con,"select count(sales_details_id) as count from sales_details where payment_id=$payment_id ") or die(mysqli_error());
	$row1=mysqli_fetch_array($query1);
	$count =  $row1['count'];
	
	mysqli_query($con,"UPDATE payment set item_qty='$count' where payment_id=$payment_id")or die(mysqli_error($con));
	
	$result=mysqli_query($con,"DELETE FROM temp_trans where branch_id='$branch'")or die(mysqli_error($con));
	echo "<script>document.location='receipt.php?sid=$sales_id&cid=$cid'</script>"; 
?>