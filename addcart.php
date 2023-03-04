<?php
  session_start();
  if(!$_SESSION['Freshfarmloggedin'] === true){
    header("location: /shopping/login.php");
  }
  else{
    $id = $_GET['id'];
    $mail = $_SESSION['ffmail'];
    require_once "assets/php/db/config.php";
    $cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
    $chck = mysqli_query($link, $cond);
    if($chck){
      $data = mysqli_fetch_array($chck);
      $cart = $data['cart'];
      if (intval($cart) === 0) {
        $cart = $id;
      }
      else{
        echo $cart = strval($id) . ',' . strval($cart);
      }
      $cond = "UPDATE `user` SET `cart`='$cart' WHERE `Mail` = '$mail';";
      $chck = mysqli_query($link, $cond);
      if($chck){
        $category = $_GET['category'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    }
  }
?>