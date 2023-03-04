<?php include('header.php'); ?>
<?php require_once "../assets/php/db/config.php"; ?>
<?php
	$id = $_GET['id'];
	$cond = "DELETE FROM `products` WHERE `id`='$id'";
	$chck = mysqli_query($link, $cond);
	header('location:product.php');
?>
<?php include('footer.php'); ?>