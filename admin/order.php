<?php include('header.php'); ?>
<?php require_once "../assets/php/db/config.php"; ?>
  <?php
  	$cond = "SELECT * FROM `orders`";
  		$chck = mysqli_query($link, $cond);
  		if ($chck) {
  			if (mysqli_num_rows($chck) > 0) {
  				while ($data = mysqli_fetch_array($chck)) {
  					$receiver = $data['receiver'];
  					$price = $data['price'];
  					$status = $data['status'];
  					$id = $data['id'];
  					$items = $data['items'];
  					$arr = explode(",",$items);
  					$cnt = array_count_values($arr);
  					$ordername = "";
  					foreach (array_unique($arr) as $i){
  						$cond = "SELECT * FROM `products` WHERE `id` = '$i'";
                        $chck1 = mysqli_query($link, $cond);
                        if ($chck1) {
                        	$prod = mysqli_fetch_array($chck1);
                          	$title = $prod['title'];
                          	$qty = $cnt[$i];
                          	if ($ordername === "") {
                            	$ordername = $title.' (x'.$qty.')';
                        	}else{
                            	$ordername .= ", " . $title.' (x'.$qty.')'; 
                        	}
                        }
  					}
  					$address = $data['address'];
  					echo '<div class="Product-cart">';
  					echo '<img src="../assets/img/products/order.jpg">';
  					echo '<div class="prod-desp">';
  					echo '<b>'.$ordername.'</b><br>';
  					echo '<span style="font-size:14px;">'.$address.', '.$receiver.'<br>';
  					echo 'Price ₹ '.$price.'<br></span>';
  					echo $status.'<br>';
  					if ($status != "Delivered") {
              echo '<a href="updateorder.php?id='.$id.'&status='.$status.'"><button class="btn">Update Status</button></a>';
            }
  					echo '</div>';
  					echo '</div>';
  				}
  			}else{
  				echo '<b>Oops! </b>No Orders Available!<br>';
  			}
  		}
  ?>
  <!---<div class="Product-cart">
		<img src="../assets/img/products/banana.jpg">
		<div class="prod-desp">
			<b>Banana</b><br>
            <span style="font-size:14px;">Receiver<br>
            Price ₹ 100<br></span>
            Ordered<br>
            <a href="removecart.php?id='.$i.'"><button class="btn">Update Status</button></a>
		</div>
	</div>-->
<?php include('footer.php'); ?>