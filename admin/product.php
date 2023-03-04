<?php include('header.php'); ?>
<?php require_once "../assets/php/db/config.php"; ?>
	<a href="addprod.php"><button class="btn">Add Product</button></a>  
	<a href="addcategory.php"><button class="btn">Add Category</button></a><br/><br/>
	<?php
		$cond = "SELECT * FROM `products`";
  		$chck = mysqli_query($link, $cond);
  		if ($chck) {
  			if (mysqli_num_rows($chck) > 0) {
  				$cond = "SELECT * FROM `products` WHERE `qty` = 0";
  				$chck = mysqli_query($link, $cond);
  				while ($data = mysqli_fetch_array($chck)) {
  					$title = $data['title'];
  					$qty = $data['qty'];
  					$price = $data['price'];
  					$tb = $data['thumbnail'];
  					$id = $data['id'];
  					echo '<div class="Product-cart">';
  					echo '<img src="../assets/img/products/'.$tb.'">';
  					echo '<div class="prod-desp">';
  					echo '<b>'.$title.'</b><br>';
  					echo '<i style="color:red">OUT OF STOCK</i><br>';
  					echo 'Price ₹ '.$price.'<br>';
  					echo '<a href="editprod.php?id='.$id.'"><button class="btn">Edit Item</button></a>  ';
            		echo '<a href="removeprod.php?id='.$id.'"><button class="btn" style="background:red;">Remove Item</button></a>';
            		echo '</div>';
            		echo '</div>';
  				}
  				$cond = "SELECT * FROM `products` WHERE `qty` > 0";
  				$chck = mysqli_query($link, $cond);
  				while ($data = mysqli_fetch_array($chck)) {
  					$title = $data['title'];
  					$qty = $data['qty'];
  					$price = $data['price'];
  					$tb = $data['thumbnail'];
  					$id = $data['id'];
  					echo '<div class="Product-cart">';
  					echo '<img src="../assets/img/products/'.$tb.'">';
  					echo '<div class="prod-desp">';
  					echo '<b>'.$title.'</b><br>';
  					echo 'QTY '.$qty.'<br>';
  					echo 'Price ₹ '.$price.'<br>';
  					echo '<a href="editprod.php?id='.$id.'"><button class="btn">Edit Item</button></a>  ';
            		echo '<a href="removeprod.php?id='.$id.'"><button class="btn" style="background:red;">Remove Item</button></a>';
            		echo '</div>';
            		echo '</div>';
  				}
  			}
  			else{
  				echo '<b>Oops! </b>No Products Available!<br>';
  			}
  		}

	?>
	<!--<div class="Product-cart">
		<img src="../assets/img/products/banana.jpg">
		<div class="prod-desp">
			<b>Banana</b><br>
            QTY 10<br>
            Price ₹ 100<br>
            <a href="removecart.php?id='.$i.'"><button class="btn">Edit Item</button></a>
            <a href="removecart.php?id='.$i.'"><button class="btn">Remove Item</button></a>
		</div>
	</div>-->
<?php include('footer.php'); ?>