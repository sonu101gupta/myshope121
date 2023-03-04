<?php include('header.php'); ?>

		<div class="main">
          <header>
            <div class="shopcontent">
              <div class="shopinner">
                <h3>My Order</h3>
                <div class="prod-cart">
                  <?php
                    session_start();
                    if(!$_SESSION['Freshfarmloggedin'] === true){
                      header("location: /shopping/login.php");
                    }
                    $mail = $_SESSION['ffmail'];
                    $cond = "SELECT * FROM `orders` WHERE `receiver` = '$mail' ORDER BY `id` DESC";
                    $chck = mysqli_query($link, $cond);
                    $ordername = "";
                    if($chck){
                      if (!(mysqli_num_rows($chck)>0)) {
                        echo '<b>Oops! </b>You have not ordered any Product<br><a href="/shopping/shop.php"><button class="btn">Shop Now</button></a>';
                      }
                      while($data = mysqli_fetch_array($chck)){
                      $cart = $data['items'];
                      $arr = explode(",",$cart);
                      $cnt = array_count_values($arr);
                      $amt = $data['price'];
                      $address = $data['address'];
                      $status = $data['status'];
                      foreach (array_unique($arr) as $i){
                        $cond = "SELECT * FROM `products` WHERE `id` = '$i'";
                        $chck1 = mysqli_query($link, $cond);
                        if ($chck1) {
                          $prod = mysqli_fetch_array($chck1);
                          $title = $prod['title'];
                          $price = $prod['price'];
                          $qty = $cnt[$i];
                          if ($ordername === "") {
                            $ordername = $title.' (x'.$qty.')';
                          }else{
                            $ordername .= ", " . $title.' (x'.$qty.')'; 
                          }
                        }
                      }
                      // Status Order

                      if ($status === "Ordered") {
                        $ordertrack = 'done';
                      }elseif ($status === "Shipped") {
                        $ordertrack = 'done';
                      }elseif ($status === "Delivered") {
                        $ordertrack = 'done';
                      }else{
                        $ordertrack = 'todo';
                      }
                      // Status Shipped

                      if ($status === "Shipped") {
                        $shiptrack = 'done';
                      }elseif ($status === "Delivered") {
                        $shiptrack = 'done';
                      }else{
                        $shiptrack = 'todo';
                      }
                      // Status Delivered

                      if ($status === "Delivered") {
                        $delivertrack = 'done';
                      }else{
                        $delivertrack = 'todo';
                      }
                      echo '<a href="#"><div class="Product-cart" style="height:270px">
                    <img src="assets/img/products/order.jpg">
                    <div class="prod-desp">
                      <b>'.$ordername.'</b><br>
                      Price ₹ '.$amt.'<br>
                      Address : '.$address.'<br>
                    </div>
                    <div class="tracker">
                    <ol class="progress-meter">
                      <li class="progress-point '.$ordertrack.'">Ordered</li><li class="progress-point '.$shiptrack.'">Shipped</li><li class="progress-point '.$delivertrack.'">Delivered</li>
                    </ol>
                  </div>';
                    $ordername = "";
                  echo '</div></a>';
                    }
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