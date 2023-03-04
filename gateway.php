<?php
  $card = "4000120347381047";
  $card_name = "Freshfarm Test";
  $cvv = "001";
  $expiry = "1226";
  $mail = $_GET['id'];
  require_once "assets/php/db/config.php";
  $cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
  $chck = mysqli_query($link, $cond);
  if($chck){
    $data = mysqli_fetch_array($chck);
    $cart = $data['cart'];
    $arr = explode(",",$cart);
    $count = count($arr);
    $cnt = array_count_values($arr);
    $amount = 0;
    foreach (array_unique($arr) as $i){
      $cond = "SELECT * FROM `products` WHERE `id` = '$i'";
      $chck1 = mysqli_query($link, $cond);
      if ($chck1) {
        $prod = mysqli_fetch_array($chck1);
        $price = $prod['price'];
        $Prodqty = $prod['qty'];
        $qty = $cnt[$i];
        $amount += intval($price)*intval($qty);
      }
    }

  }
?>
<!DOCTYPE html>
<html lang='en' class=''>

<head>

  <meta charset='UTF-8'>
  <title>Payments Gateway | Fresh Farm</title>

  <meta name="robots" content="noindex">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">
  <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">
  <link rel="canonical" href="https://codepen.io/RajRajeshDn/pen/OBGjML">
  <style class="INLINE_PEN_STYLESHEET_ID">
    @import url('https://fonts.googleapis.com/css?family=Baloo+Bhaijaan|Ubuntu');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Ubuntu', sans-serif;
}

body{
  background: #2196F3;
  margin: 0 10px;
}

.payment{
  background: #f8f8f8;
  max-width: 360px;
  margin: 80px auto;
  height: auto;
  padding: 35px;
  padding-top: 70px;
  border-radius: 5px;
  position: relative;
}

.payment h2{
  text-align: center;
  letter-spacing: 2px;
  margin-bottom: 40px;
  color: #0d3c61;
}

.form .label{
  display: block;
  color: #555555;
  margin-bottom: 6px;
}

.input{
  padding: 13px 0px 13px 25px;
  width: 100%;
  text-align: center;
  border: 2px solid #dddddd;
  border-radius: 5px;
  letter-spacing: 1px;
  word-spacing: 3px;
  outline: none;
  font-size: 16px;
  color: #555555;
}

.card-grp{
  display: flex;
  justify-content: space-between;
}

.card-item{
  width: 48%;
}

.space{
  margin-bottom: 20px;
}

.icon-relative{
  position: relative;
}

.icon-relative .fas,
.icon-relative .far{
  position: absolute;
  bottom: 12px;
  left: 15px;
  font-size: 20px;
  color: #555555;
}

.btn{
  margin-top: 40px;
  background: #2196F3;
  padding: 12px;
  text-align: center;
  color: #f8f8f8;
  border-radius: 5px;
  cursor: pointer;
}


.payment-logo{
  position: absolute;
  top: -50px;
  left: 50%;
  transform: translateX(-50%);
  width: 100px;
  height: 100px;
  background: #f8f8f8;
  border-radius: 50%;
  box-shadow: 0 0 5px rgba(0,0,0,0.2);
  text-align: center;
  line-height: 85px;
}

.payment-logo:before{
  content: "";
  position: absolute;
  top: 5px;
  left: 5px;
  width: 90px;
  height: 90px;
  background: #2196F3;
  border-radius: 50%;
}

.payment-logo p{
  position: relative;
  color: #f8f8f8;
  font-family: 'Baloo Bhaijaan', cursive;
  font-size: 58px;
  margin-top: 20px;
}


@media screen and (max-width: 420px){
  .card-grp{
    flex-direction: column;
  }
  .card-item{
    width: 100%;
    margin-bottom: 20px;
  }
  .btn{
    margin-top: 20px;
  }
}
  </style>

  
<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeConsoleRunner-7549a40147ccd0ba0a6b5373d87e770e49bb4689f1c2dc30cccc7463f207f997.js"></script>
<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-4793b73c6332f7f14a9b6bba5d5e62748e9d1bd0b5c52d7af6376f3d1c625d7e.js"></script>
<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRuntimeErrors-4f205f2c14e769b448bcf477de2938c681660d5038bc464e3700256713ebe261.js"></script>
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">

<div class="wrapper">
  <div class="payment">
    <div class="payment-logo">
      <p><ion-icon name="cart"></ion-icon></p>
    </div>
    
    
    <h2>Fresh Farm Cart Value ₹ <?php echo $amount; ?> /-</h2>
    <div class="form">
      <div class="card space icon-relative">
        <label class="label">Card holder:</label>
        <input type="text" class="input" placeholder="Card Holder Name" value="<?php echo $card_name; ?>">
        <i class="fas fa-user"></i>
      </div>
      <div class="card space icon-relative">
        <label class="label">Card number:</label>
        <input type="text" class="input" data-mask="0000 0000 0000 0000" placeholder="Card Number" value="<?php echo $card; ?>">
        <i class="far fa-credit-card"></i>
      </div>
      <div class="card-grp space">
        <div class="card-item icon-relative">
          <label class="label">Expiry date:</label>
          <input type="text" name="expiry-data" class="input"  placeholder="00 / 00" value="<?php echo $expiry; ?>">
          <i class="far fa-calendar-alt"></i>
        </div>
        <div class="card-item icon-relative">
          <label class="label">CVV:</label>
          <input type="text" class="input" data-mask="000" placeholder="000" value="<?php echo $cvv; ?>">
          <i class="fas fa-lock"></i>
        </div>
      </div>
        
      <a href="checkout.php?id=<?php echo $mail . '&mode=online';?>" style="text-decoration: none;"><div class="btn">
        Pay
      </div></a>
      
    </div>
  </div>
</div>
  
<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script type="text/javascript">
    $("input[name='expiry-data']").mask("00 / 00");
  </script>
</body>

</html>