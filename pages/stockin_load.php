<?php 
session_start();
include('../dist/includes/dbcon.php');

$parent_cat = $_GET['parent_cat'];
$branch=$_SESSION['branch'];

$query=mysqli_query($con,"SELECT SUM(`reorder`-`pre_reorder`)as rod FROM `stockin` WHERE `prod_id`= {$parent_cat} and branch_id = '$branch' ");
while($row = mysqli_fetch_array($query)) {
	echo "<option value='$row[rod]'>$row[rod]</option>";
}
?>