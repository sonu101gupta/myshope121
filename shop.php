
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
                <h3>Categories</h3>
                <a href="cart.php" class="mycart"><ion-icon name="cart"></ion-icon></a>
                <div class="prodlist" style="text-align: center;">
                  
                    <?php
                      $cond = "SELECT * FROM `categories`";
                      $chck = mysqli_query($link, $cond);
                      if($chck){
                        if(mysqli_num_rows($chck)>0){
                          while ($data = mysqli_fetch_array($chck)) {
                            $title = $data['name'];
                            $img = $data['thumbnail'];
                            $id = $data['id'];
                            echo '<a href="products.php?category='.$title.'"><div class="Product">';
                            echo '<img src="assets/img/categories/'.$img.'" width="100%" height="70%">';
                            echo '<br><br>';
                            echo '<b>'.$title.'</b><br>';
                            echo '</div></a>';
                          }
                        }
                        else{
                          echo 'No categories Available...';
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