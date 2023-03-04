<?php include('header.php'); ?>
<?php require_once "../assets/php/db/config.php"; ?>
<?php
	$id = $_GET['id'];
	$cond = "SELECT * FROM `products` WHERE `id`='$id'";
	$chck = mysqli_query($link, $cond);
	if ($chck) {
		$data = mysqli_fetch_array($chck);
		$title = $data['title'];
		$price = $data['price'];
		$qty = $data['qty'];
	}
	if (isset($_POST['update'])) {
		$updated_price = $_POST['price'];
		$updated_qty = $_POST['qty'];
		$cond = "UPDATE `products` SET `price`='$updated_price',`qty`='$updated_qty' WHERE `id`='$id'";
		$chck = mysqli_query($link, $cond);
		if ($chck) {
			header('location:product.php');
		}else{
			$msg = "Something went Worng..";
		}
	}
?>
<h3><?php echo $title; ?></h3>
<form method="post" action="" class="form-back">
	<input type="number" name="price" placeholder="Product Price" value="<?php echo $price; ?>" class="form-inp"><br>
	<input type="number" name="qty" placeholder="Product Quantity" value="<?php echo $qty; ?>" class="form-inp"><br>
	<input type="submit" name="update" value="Update Changes" class="form-btn"><br>
	<span style="color:red;"><?php echo $msg; ?></span>
</form>
<?php include('footer.php'); ?>