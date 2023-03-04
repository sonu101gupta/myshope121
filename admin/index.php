<?php include('header.php'); ?>
<?php require_once "../assets/php/db/config.php"; ?>
<?php
  session_start();
  if(($_SESSION['role'] === "admin")){
    $cond = "SELECT * FROM `orders`";
    $chck = mysqli_query($link, $cond);
    $amt = 0;
    if ($chck) {
      if (mysqli_num_rows($chck) > 0) {
        while ($data = mysqli_fetch_array($chck)) {
          $price = $data['price'];
          $amt += intval($price);
        }
      }
    }
?>

  <center><div class="sales">
    <span>₹ <?php echo $amt; ?></span>
    Total Sales
  </div></center>

  <?php }elseif(($_SESSION['role'] === "order_manager")){
    $cond = "SELECT * FROM `orders`";
    $chck = mysqli_query($link, $cond);
    if ($chck) {
      if (mysqli_num_rows($chck) > 0) {
        $order = 0;
        while ($data = mysqli_fetch_array($chck)) {
          $order += 1;
        }
      }
    }
    ?>
      <center><div class="sales">
    <span><?php echo $order; ?></span>
    Total Orders
  </div></center>
    <?php
  }elseif(($_SESSION['role'] === "product_manager")){
    $cond = "SELECT * FROM `products`";
    $chck = mysqli_query($link, $cond);
    if ($chck) {
      if (mysqli_num_rows($chck) > 0) {
        $product = 0;
        while ($data = mysqli_fetch_array($chck)) {
          $product += 1;
        }
      }
    }
    ?>
      <center><div class="sales">
    <span><?php echo $product; ?></span>
    Total Products
  </div></center>
    <?php
  } ?>
<?php include('footer.php'); ?>