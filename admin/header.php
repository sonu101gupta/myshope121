<?php
  session_start();
  if(!$_SESSION['Freshfarmloggedin'] === true){
    header("location: /shopping/login.php");
  }elseif (!$_SESSION['Freshfarmloggedinadmin'] === true) {
    header("location: /shopping/");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="../assets/img/favicon.jpg">
<style>
  @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");
body {
  margin: 0;
  font-family: "Poppins", sans-serif;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 20%;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

li a.active {
  background-color: #000;
  color: white;
}

li a:hover:not(.active) {
  background-color: #000;
  color: white;
}
header{
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 10;
  height: 4rem;
  background-color: #000;
}
header .menu{
  max-width: 72rem;
  width: 100%;
  margin: 0 auto;
  padding: 0 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #fff;
}
.logo {
  font-size: 1.1rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.logo span {
  font-weight: 300;
}
</style>
<title>Fresh Farm Admin Dashboard</title>
<link rel="stylesheet" href="assets/style.css" />
</head>
<body>
<header>
  <div class="menu">
    <h3 class="logo">Fresh<span>Farm</span></h3>
  </div>
  
</header>
<ul>
  <li><a href="index.php">Dashboard</a></li>
  <?php
    session_start();
    if(($_SESSION['role'] === "admin") or ($_SESSION['role'] === "product_manager")){
      ?>
        <li><a href="product.php">Products</a></li>
      <?php
    }
    if(($_SESSION['role'] === "admin") or ($_SESSION['role'] === "order_manager")){
      ?>
        <li><a href="order.php">Orders</a></li>
      <?php
    }
    if($_SESSION['role'] === "admin"){
      ?>
        <li><a href="employees.php">Employees</a></li>
      <?php
    }
  ?>
  <li><a href="../logout.php">Logout</a></li>
</ul>

<div class="main" style="margin-left:20%;margin-top: 4rem;padding:5px;">