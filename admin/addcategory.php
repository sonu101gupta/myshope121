<?php include('header.php'); ?>
<?php require_once "../assets/php/db/config.php"; ?>
<?php
	if (isset($_POST['add'])) {
		$file = $_FILES["thumbnail"];
		$title = $_POST['title'];
		$file_name = basename($file['name']);
		$file_size = $file['size'];
		$file_type = $file['type'];
		$file_temp = $file['tmp_name'];
		$file_store = "../assets/img/categories/".$file_name;
		if(move_uploaded_file($file_temp, $file_store)){
			$cond = "INSERT INTO `categories`(`name`, `thumbnail`) VALUES ('$title','$file_name')";
	  		$chck = mysqli_query($link, $cond);
	  		if ($chck) {
	  			$msg = "category Added Successfully..";
	  		}else{
	  			$msg = "Something went Worng";
	  		}
		}
		else{
			$msg = "Thumbnail not Uploaded max upload size 2MB";
		}
	}
?>
<h3>Add Category</h3>
<form class="form-back" method="POST" enctype="multipart/form-data" action="addcategory.php">
	<input type="text" name="title" placeholder="Category Name" required class="form-inp"><br>
	<input type="file" name="thumbnail" required accept="image/*"><br>
	<input type="submit" name="add" class="form-btn"><br>
	<span style="color:red;"><?php echo $msg; ?></span>
</form>
<?php include('footer.php'); ?>
