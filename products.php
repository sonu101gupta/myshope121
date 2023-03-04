
<!DOCTYPE html>
<?php require_once "assets/php/db/config.php"; ?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fresh Farm Grocery</title>
    <link rel="icon" href="assets/img/favicon.jpg">
    <link rel="stylesheet" href="assets/css/style.css" />
    <style type="text/css">
      .quantity-control {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: fit-content;
        margin: 0 auto;
        background: #eaeaea;
        border-radius: 10px;
        padding: 0.5rem 0.4rem;
        margin-top: 0.5rem;
      }

      .quantity-btn {
        background: transparent;
        border: none;
        outline: none;
        margin: 0;
        padding: 0px 8px;
        cursor: pointer;
      }
      .quantity-btn svg {
        width: 15px;
        height: 15px;
      }
      .quantity-input {
        outline: none;
        user-select: none;
        text-align: center;
        width: 47px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
      }
      .quantity-input::-webkit-inner-spin-button,
      .quantity-input::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }
      a[disabled="disabled"] {
        pointer-events: none;
      }
      .mycart:after{
        content: <?php
          session_start();
          $mail = $_SESSION['ffmail'];
          $cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
          $chck = mysqli_query($link, $cond);
          if($chck){
            $data = mysqli_fetch_array($chck);
            $cart = $data['cart'];
            $arr = explode(",",$cart);
            $count = count($arr);
            if ($count < 10) {
              if ($count === 1 and intval($cart) === 0) {
                echo '"0"';
              }
              else{
                echo '"0'.$count.'"';
              }
            }
            else{
              echo '"'.$count.'"';
            }
          }
          else{
            echo '"0"';
          }
        ?>;
        font-size: 15px;
        background: red;
        border-radius: 50%;
        background: #000;
        color: #fff;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="navbar">
        <div class="menu">
          <a style="color: white;text-decoration: none;" href="/shopping"><h3 class="logo">Fresh<span>Farm</span></h3></a>
          <div class="hamburger-menu">
            <div class="bar"></div>
          </div>
        </div>
      </div>

      <div class="main-container">

    <div class="main">
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
          <header>
            <div class="shopcontent">
              <div class="shopinner">
                <h3>Products</h3>
                <a href="cart.php" class="mycart"><ion-icon name="cart"></ion-icon></a>
                <div class="prodlist" style="text-align: center;">
                  
                    <?php
                      $category = $_GET['category'];
                      $user_id = $_SESSION['id'];
                      $cond = "SELECT * FROM `user` WHERE `id`='$user_id'";
                      $chck = mysqli_query($link, $cond);
                      $user_data = mysqli_fetch_array($chck);
                      $cart = $user_data['cart'];
                      $arr = explode(",",$cart);
                      $cnt = array_count_values($arr);
                      $cond = "SELECT * FROM `products` WHERE `category`='$category'";
                      $chck = mysqli_query($link, $cond);
                      if($chck){
                        if(mysqli_num_rows($chck)>0){
                          while ($data = mysqli_fetch_array($chck)) {
                            $title = $data['title'];
                            $img = $data['thumbnail'];
                            $price = $data['price'];
                            $prodqty = $data['qty'];
                            $id = $data['id'];
                            
                            echo '<div class="Product">';
                            echo '<img src="assets/img/Products/'.$img.'" width="100%" height="70%">';
                            echo '<b>'.$title.'</b><br>';
                            echo 'Price ₹ '.$price.'<br>';
                            if ($prodqty > 0) {
                              if ((count($arr) <= 1) and (intval($arr[0]) === 0)) {
                                $value = 0;
                              }else{
                                $value = $cnt[$id];
                              }
                              if($value == ""){$value = 0;}
                              if((intval($value) === 0) or ($value == "")){$disabled="disabled";}else{$disabled="none";}
                              if(intval($value) === intval($prodqty)){$maxprod = "disabled";}else{$maxprod = "none";}
                              echo '<div class="quantity-control" data-quantity="">
    <a href="removecart.php?id='.$id.'" disabled="'.$disabled.'" ><button class="quantity-btn"><svg viewBox="0 0 409.6 409.6">
        <g>
          <g>
            <path d="M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467 c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z" />
          </g>
        </g>
      </svg></button></a>
    <input type="number" class="quantity-input" value="'.$value.'" step="0.1" min="1" max="" name="quantity">
    <a href="addcart.php?id='.$id.'&category='.$category.'" disabled="'.$maxprod.'"><button class="quantity-btn"><svg viewBox="0 0 426.66667 426.66667">
        <path d="m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437 0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031 21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344 9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344 0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0" /></svg>
    </button></a>
  </div>';
                            }else{

                              echo '<button class="btn-out">Out of Stock</button>';

                            }
                            echo '</div>';
                            
                          }
                        }
                        else{
                          echo 'No Products Available...';
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