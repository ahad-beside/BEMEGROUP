<?php 
	session_start();
	$branch=$_SESSION['branch'];
	include('../dist/includes/dbcon.php');

	//$item_num = $_POST['item_num'];
	$tit_name = $_POST['tit_name'];
	$gems_type = $_POST['gems_type'];
	$item_size = $_POST['size'];
	$weight = $_POST['weight'];
	$num_gems = $_POST['num_gems'];
	$color = $_POST['color'];
	$shape = $_POST['shape'];
	$clarity = $_POST['clarity'];
	$luster = $_POST['luster'];
	$hardness = $_POST['hardness'];
	$region = $_POST['region'];
	$treatment = $_POST['treatment'];
	$price = $_POST['price'];
	$supplier = $_POST['supplier'];
	$code = $_POST['new_barcode'];
	
	$year = date("Y");
	$month = date("m");	
	
	$y_barcode = "PD"."$year";
	$m_barcode = "-"."$month"."-";
	//$generate_barcode = $y_barcode.$m_barcode.$code;
	$gen = $y_barcode.$m_barcode.$code;
	
	/*$year = date("Y");
	$month = date("m");	
	$query = mysqli_query($con,"SELECT * FROM `barcode` ORDER BY item_incre DESC ") or die (mysqli_error($con));
	$fetch = mysqli_fetch_array($query);
	$item_incre = $fetch['item_incre'];
						
	$new_barcode =  $item_incre + 1;
	$y_barcode = "PD"."$year";
	$m_barcode = "$month";
	$generate_barcode = $y_barcode.$m_barcode.$new_barcode;*/
	
	
	$query1=mysqli_query($con,"SELECT * FROM stockin where branch_id = '".$_SESSION['branch']."'");
	$row1=mysqli_fetch_array($query1);
	$qty1=$row1['prod_qty'];
	$qty2=$row1['prod_status'];
	
	$query2=mysqli_query($con,"select * from prod_scheduled where prod_tname='$tit_name' and branch_id='$branch'")or die(mysqli_error($con));
	$count=mysqli_num_rows($query2);
	
	if ($count>0)
	{
		echo "<script type='text/javascript'>alert('Item already exist!');</script>";
		echo "<script>document.location='scheduled.php'</script>";  
	}
	else
	{	

		$pic = $_FILES["image"]["name"];
		if ($pic=="")
		{
			$pic="default.gif";
		}
		else
		{
			$pic = $_FILES["image"]["name"];
			$type = $_FILES["image"]["type"];
			$size = $_FILES["image"]["size"];
			$temp = $_FILES["image"]["tmp_name"];
			$error = $_FILES["image"]["error"];
		
			if ($error > 0){
				die("Error uploading file! Code $error.");
				}
			else{
				if($size > 100000000000) //conditions for the file
					{
					die("Format is not allowed or file size is too big!");
					}
			else
			      {
				move_uploaded_file($temp, "../dist/uploads/".$pic);
			      }
				}
		}
		
		$ny = $y_barcode;
		$incre = $_POST['new_barcode'];
		$nm = $m_barcode;
		$gen = $ny.$nm.$incre;
					
		mysqli_query($con,"INSERT INTO prod_scheduled(prod_tname,cat_id,prod_size,prod_weight,item_qty,prod_color,prod_shape,prod_clarity,prod_luster,prod_hardness,prod_region,prod_treat,prod_price,prod_pic,ebay_sold_id,branch_id,supplier_id,serial)
VALUES('$tit_name','$gems_type','$item_size','$weight','$num_gems','$color','$shape','$clarity','$luster','$hardness','$region','$treatment','$price','$pic','0','$branch','$supplier','$gen')")or die(mysqli_error($con));
		
		mysqli_query($con,"INSERT INTO barcode (item_year,item_month,item_incre) values ('$y_barcode', '$m_barcode', '$code') ") or die (mysqli_error($con));
		mysqli_query($con,"UPDATE stockin SET prod_status=prod_status+'1' where cat_id='$gems_type' and branch_id='$branch'") or die(mysqli_error($con)); 
		echo "<script type='text/javascript'>alert('Successfully added new Item!');</script>";
		
		echo "<script>document.location='scheduled.php'</script>";  
		}
		
?>