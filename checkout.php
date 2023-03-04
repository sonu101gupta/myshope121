<?php include('header.php'); ?>
<?php
  session_start();
  if(!$_SESSION['Freshfarmloggedin'] === true){
    header("location: /shopping/login.php");
  }
  $msg = "";
  require_once "assets/php/db/config.php";
?>
		<div class="main">
          <header>
            <div class="shopcontent">
              <div class="shopinner">
                <h3>Checkout</h3><br>
                <?php
                  
                  $amount = 0;
                  $mail = $_SESSION['ffmail'];
                  
                  $cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
                  $chck = mysqli_query($link, $cond);
                  if($chck){
                    $data = mysqli_fetch_array($chck);
                    $cart = $data['cart'];
                    $add1 = $data['Address'];
                    $city = $data['City'];
                    $state = $data['State'];
                    $zip = $data['Pincode'];
                    $address = $add1 . ', ' . $city . ', ' . $state . ', ' . $zip;
                    $arr = explode(",",$cart);
                    $count = count($arr);
                    $cnt = array_count_values($arr);
                    echo '<div class="checkout">
                  <table>
                    <tr>
                      <th>Item</th>
                      <th>Unit Price</th>
                      <th>Qty</th>
                      <th>Price</th>
                    </tr>';
                    foreach (array_unique($arr) as $i){
                      $cond = "SELECT * FROM `products` WHERE `id` = '$i'";
                      $chck1 = mysqli_query($link, $cond);
                      if ($chck1) {
                        $prod = mysqli_fetch_array($chck1);
                        $title = $prod['title'];
                        $price = $prod['price'];
                        $Prodqty = $prod['qty'];
                        $qty = $cnt[$i];
                        echo '<tr>
                      <td>'.$title.'</td>
                      <td>₹ '.$price.'</td>
                      <td>'.$qty.'</td>
                      <td>₹ '. intval($price)*intval($qty) .'</td>
                    </tr>';
                        $amount += intval($price)*intval($qty);
                      }
                    }
                    
                    if (isset($_POST['place']) || $_GET['mode'] === "online") {
                      $mode = $_POST['mode'];
                    if ($mode === "online" and $_GET['mode'] != "online") {
                      header("location: gateway.php?id=$mail");
                    }else{
                      if ($_GET['mode'] === "online") {
                        $mode = "online";
                      }
                      $cond = "INSERT INTO `orders`(`receiver`, `address`, `price`, `items`, `orderedon`, `Mode`, `status`) VALUES ('$mail','$address','$amount','$cart',CURRENT_TIMESTAMP,'$mode','Ordered')";
                    $ord = mysqli_query($link, $cond);
                    if ($ord) {
                      $Prodqty = intval($Prodqty) - intval($qty);
                      foreach (array_unique($arr) as $i){
                        $cond = "SELECT * FROM `products` WHERE `id` = '$i'";
                        $ord1 = mysqli_query($link, $cond);
                        $prod = mysqli_fetch_array($ord1);
                        $Prodqty = $prod['qty'];
                        $prodid = $prod['id'];
                        $qty = $cnt[$i];
                        $Prodqty = intval($Prodqty) - intval($qty);
                        if($Prodqty < 0){
                          $Prodqty = 0;
                        }
                        $cond = "UPDATE `products` SET `qty`='$Prodqty' WHERE `id`='$prodid'";
                        $chck3 = mysqli_query($link, $cond);
                      }
                      $cond = "UPDATE `user` SET `cart`='0' WHERE `Mail` = '$mail'";
                      $chck2 = mysqli_query($link, $cond);
                      if($chck2){
                        $msg = "Ordered Placed";
                      }
                    }
                    }
                  }
                    echo '<tr><th colspan="3">Total</th><td>₹ '.$amount.'</td></tr>';
                    echo '</table>';
                    if ($data['Pincode'] != 0) {
                      
                    }else{
                      
                    }
                    echo '<span style="color:red;padding:10px;">'.$msg.'</span><br><br>';
                    if (isset($_POST['place'])  || $_GET['mode'] === "online") {
                      echo '<div style="margin:20px;font-size:14px;"><b>Shipping Address</b><br>'; 
                      echo $data['Address'] . ",<br>" . $data['City'] . ", " . $data['State'] . ",<br>" . $data['Pincode'] . "</div>";
                      if ($_GET['mode'] === "online") {
                        $mode_print = "Online Payment";
                      }
                      else{
                        $mode_print = "Cash on Delivery";
                      }
                      echo '<b style="font-size:14px;margin:20px;">Payment Mode</b>
                        <span style="font-size:14px;margin:20px;">'.$mode_print.'</span><br><br>';
                      echo '<button class="btn-pay" onclick="window.print();">Print</button>';
                    }else{
                      if ($data['Pincode'] != 0) {
                        echo '<div style="margin:20px;font-size:14px;"><b>Shipping Address</b><br>'; 
                      echo $data['Address'] . ",<br>" . $data['City'] . ", " . $data['State'] . ",<br>" . $data['Pincode'] . "</div>";
                      echo '<a href="updateadd.php"><button class="btn" style="margin-left:20px;">Update Shipping Address</button></a>';
                        echo '<form method="post" action="">
                        <b style="font-size:14px;margin:20px;">Payment Mode</b><br>
                        <input type="radio" name="mode" value="COD" style="margin:20px;" checked /><span style="font-size:14px;">Cash on Delivery</span><input type="radio" name="mode" value="online" style="margin:20px;" /><span style="font-size:14px;">Online Payment</span><br>
                      <input type="submit" name="place" value="Place Order" class="btn-pay" />
                    </form>';
                      }else{
                        echo '<a href="updateadd.php"><button class="btn" style="margin-left:20px;">Add Shipping Address</button></a>';
                        echo '<form method="post" action="">
                        <b style="font-size:14px;margin:20px;">Payment Mode</b>
                        <input type="radio" name="mode" value="COD" style="margin:20px;" checked /><span style="font-size:14px;">Cash on Delivery</span><input type="radio" name="mode" value="online" style="margin:20px;" /><span style="font-size:14px;">Online Payment</span><br>
                      <input type="submit" disabled style="cursor:no-drop;" name="place" value="Place Order" class="btn-pay" />
                    </form><br><br>';
                      }
                      
                    }
                echo '</div>';
                  }
                  
                ?>
                
                    
                  
              </div>
            </div>
          </header>
        </div>

        <div class="shadow one"></div>
        <div class="shadow two"></div>

<?php include('footer.php'); ?>