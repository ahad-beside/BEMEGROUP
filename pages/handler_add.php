<?php 
	session_start();
	include('../dist/includes/dbcon.php');
	$branch=$_SESSION['branch'];
	$first = $_POST['first'];
	$middle = $_POST['mi'];
	$last = $_POST['last'];
	$bday = $_POST['bday'];
	$nickname = $_POST['nickname'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];	
	$house_status = $_POST['house_status'];
	$years = $_POST['years'];
	$rent = $_POST['rent'];
	$occupation = $_POST['occupation'];
	$salary = $_POST['salary'];
	$emp_address = $_POST['emp_address'];
	$spouse = $_POST['spouse'];
	$spouse_no = $_POST['spouse_no'];
	$spouse_emp = $_POST['spouse_emp'];
	$spouse_details = $_POST['spouse_details'];
	$spouse_income = $_POST['spouse_income'];
	$comaker = $_POST['comaker'];
	$comaker_details = $_POST['comaker_details'];
	
	$pic = $_FILES["image"]["name"];
	if ($pic=="")
	{	
		if ($_POST['image1']<>"")
		{
			$pic=$_POST['image1'];
		}
		else
		{
			$pic="default.gif";
		}
	}
	else
	{
		$pic = $_FILES["image"]["name"];
		$type = $_FILES["image"]["type"];
		$size = $_FILES["image"]["size"];
		$temp = $_FILES["image"]["tmp_name"];
		$error = $_FILES["image"]["error"];
	
		if ($error > 0)
		{
			die("Error uploading file! Code $error.");
		}
		else
		{
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
	
	$query2=mysqli_query($con,"select * from handler where hand_first='$first' and hand_last='$last' and hand_contact='$contact' and branch_id='$branch'")or die(mysqli_error($con));
	$count=mysqli_num_rows($query2);
	$row=mysqli_fetch_array($query2);
	$id=$row['hand_id'];
	if ($count>0)
	{
		//mysqli_query($con,"update handler set hand_contact='$contact',credit_status='pending' where hand_id='$id'")or die(mysqli_error());
		echo "<script type='text/javascript'>alert('Application resubmitted for approval!');</script>";
		echo "<script>document.location='handler.php'</script>";  
	}
	else
	{	
	mysqli_query($con,"INSERT INTO 
	handler(hand_first,hand_last,hand_mi,hand_address,hand_contact,branch_id,hand_status,bday,nickname,house_status,years,rent,occupation,salary,emp_address,spouse,spouse_no,spouse_emp,spouse_details,spouse_income,comaker,comaker_details,hand_pic) 
VALUES('$first','$last','$middle','$address','$contact','$branch','pending','$bday','$nickname','$house_status','$years','$rent','$occupation','$salary','$emp_address','$spouse','$spouse_no','$spouse_emp','$spouse_details','$spouse_income','$comaker','$comaker_details','$pic')")or die(mysqli_error($con));

			$id=mysqli_insert_id($con);
			$_SESSION['cid']=$id;
			echo "<script type='text/javascript'>alert('Successfully added new Shimpmet Handler! Waiting for admin approval.');</script>";
			echo "<script>document.location='handler.php'</script>";  
		}
	
?>