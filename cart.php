<?php include('header.php'); ?>
<?php require_once "assets/php/db/config.php"; ?>
		<div class="main">
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
          <header>
            <div class="shopcontent">
              <div class="shopinner">
                <h3>Cart</h3>
                <div class="prod-cart">
                  <?php
                    session_start();
                    $mail = $_SESSION['ffmail'];
                    $cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
                    $chck = mysqli_query($link, $cond);
                    if($chck){
                      $data = mysqli_fetch_array($chck);
                      $cart = $data['cart'];
                      $arr = explode(",",$cart);

                      $cnt = array_count_values($arr);
                      $count = count($arr);
                      if ($count === 1 and intval($cart) === 0) {
                        echo '<b>Oops! </b>Your cart is empty<br><a href="/shopping/shop.php"><button class="btn">Shop Now</button></a>';
                      }else{
                        echo '<a href="checkout.php"><button class="btn">Checkout</button></a> <a href="/shopping/shop.php"><button class="btn">Shop More</button></a><br><br>';
                        foreach (array_unique($arr) as $i) {
                          $cond = "SELECT * FROM `products` WHERE `id` = '$i'";
                          $chck1 = mysqli_query($link, $cond);
                          if ($chck1) {
                            $prod = mysqli_fetch_array($chck1);
                            $title = $prod['title'];
                            $price = $prod['price'];
                            $tb = $prod['thumbnail'];
                            $qty = $cnt[$i];
                            echo '<div class="Product-cart">
                      <img src="assets/img/products/'.$tb.'">
                      <div class="prod-desp">
                        <b>'.$title.'</b><br>
                        QTY '.$qty.'<br>
                        Price ₹ '.$price.'<br>
                        <a href="removecart.php?id='.$i.'"><button class="btn">Remove Item</button></a>
                      </div>
                    </div>';
                          }
                        }
                      }
                    }
                    else{
                      echo '<b>Oops! </b>Your cart is empty<br><a href="/shopping/shop.php"><button class="btn">Shop Now</button></a>';
                    }
                  ?>

                </div>
              </div>
            </div>
          </header>
        </div>

        <div class="shadow one"></div>
        <div class="shadow two"></div>

<?php include('footer.php'); ?>