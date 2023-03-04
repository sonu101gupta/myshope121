<?php include('header.php'); ?>
<?php require_once "../assets/php/db/config.php"; ?>
<?php
	$id = $_GET['id'];
	$status = $_GET['status'];
	if ($status === "Ordered") {
		$cond = "UPDATE `orders` SET `status`='Shipped' WHERE `id`='$id'";
	}elseif ($status === "Shipped"){
		$cond = "UPDATE `orders` SET `status`='Delivered' WHERE `id`='$id'";
	}
	$chck = mysqli_query($link, $cond);
	header('location:order.php');
?>
<?php include('footer.php'); ?>