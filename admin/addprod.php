<?php include('header.php'); ?>
<?php require_once "../assets/php/db/config.php"; ?>
<?php
	if (isset($_POST['add'])) {
		$file = $_FILES["thumbnail"];
		$title = $_POST['title'];
		$price = $_POST['price'];
		$qty = $_POST['qty'];
		$category = $_POST['category'];
		$file_name = basename($file['name']);
		$file_size = $file['size'];
		$file_type = $file['type'];
		$file_temp = $file['tmp_name'];
		$file_store = "../assets/img/products/".$file_name;
		if(move_uploaded_file($file_temp, $file_store)){
			$cond = "INSERT INTO `products`(`title`, `price`, `qty`, `category`, `thumbnail`) VALUES ('$title','$price','$qty','$category','$file_name')";
	  		$chck = mysqli_query($link, $cond);
	  		if ($chck) {
	  			$msg = "product Added Successfully..";
	  		}else{
	  			$msg = "Something went Worng";
	  		}
		}
		else{
			$msg = "Thumbnail not Uploaded max upload size 2MB";
		}
	}
?>
<h3>Add Product</h3>
<form class="form-back" method="POST" enctype="multipart/form-data" action="addprod.php">
	<input type="text" name="title" placeholder="Product Name" required class="form-inp"><br>
	<input type="number" name="price" placeholder="Product Price" required class="form-inp"><br>
	<input type="number" name="qty" placeholder="Product Quantity" required class="form-inp"><br>
	<select name="category" required class="form-inp">
		<?php
			$cond = "SELECT * FROM `categories`";
	  		$chck = mysqli_query($link, $cond);
	  		if ($chck) {
	  			if (mysqli_num_rows($chck) > 0) {
	  				while ($data = mysqli_fetch_array($chck)) {
	  					$name = $data['name'];
	  					echo '<option value="'.$name.'">'.$name.'</option>';
	  				}
	  			}
	  		}
		?>
	</select><br>
	<input type="file" name="thumbnail" required accept="image/*"><br>
	<input type="submit" name="add" class="form-btn"><br>
	<span style="color:red;"><?php echo $msg; ?></span>
</form>
<?php include('footer.php'); ?>