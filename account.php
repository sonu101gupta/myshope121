<?php include('header.php'); ?>
<?php
  session_start();
  if(!$_SESSION['Freshfarmloggedin'] === true){
    header("location: /shopping/login.php");
  }
  $mail = $_SESSION['ffmail'];
  $cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
  $chck = mysqli_query($link, $cond);
  if($chck){
    $data = mysqli_fetch_array($chck);
  }
  if (isset($_POST['update'])) {
    $upname = $_POST['name'];
    $upmail = $_POST['mail'];
    $upmob = $_POST['mob'];
    $pwd = $_POST['pwd'];
    $hashed_password = $data['Password'];
    if(password_verify($pwd, $hashed_password)){
      $cond = "UPDATE `user` SET `Name`='$upname',`Mail`='$upmail',`Mobile`='$upmob' WHERE `Mail` = '$mail'";
      $chck1 = mysqli_query($link, $cond);
      if($chck1){
        
        $cond = "SELECT * FROM `user` WHERE `Mail` = '$upmail'";
        $chck = mysqli_query($link, $cond);
        if($chck){
          $data = mysqli_fetch_array($chck);
          $_SESSION['Freshfarmloggedin'] = true;
          $_SESSION['ffname'] = $data['Name'];
          $_SESSION['ffmail'] = $data['Mail'];
          $_SESSION['ffmob'] = $data['Mobile'];
        }
        $msg = "Profile Updated";
      }
    }else{
      $msg = "Wrong Password";
    }
  }
?>
		<div class="main">
          <header>
            <div class="shopcontent">
              <div class="shopinner">
                <div class="Account">
                  <div class="form-back">
                <h3>My Account</h3>
                  <form method="post" action="">
                  <table>
                    <tr>
                      <td class="form-row"><label for="">Name</label></td>
                      <td class="form-row"><input type="text" name="name" class="form-inp" value="<?php echo $data['Name']; ?>" required autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">Mail</label></td>
                      <td class="form-row"><input type="text" name="mail" class="form-inp" value="<?php echo $data['Mail']; ?>" required autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">Mobile</label></td>
                      <td class="form-row"><input type="text" maxlength="10" name="mob" required value="<?php echo $data['Mobile']; ?>" class="form-inp" autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">Password</label></td>
                      <td class="form-row"><input type="password" name="pwd" class="form-inp" required autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row" colspan="2" align="center"><span style="color: red;"><?php echo $msg; ?></span></td>
                    </tr>
                    <tr>
                      <td class="form-row" colspan="2" align="center"><input type="submit" name="update" class="form-btn" value="Update Profile"></td>
                    </tr>
                  </table>
                </form>
              </div>
                  <?php
                    if ($data['Pincode'] != 0) {
                      echo '<div style="margin:20px;font-size:14px;"><b>Shipping Address</b><br>'; 
                      echo $data['Address'] . ",<br>" . $data['City'] . ", " . $data['State'] . ",<br>" . $data['Pincode'] . "</div>";
                      echo '<a href="updateadd.php"><button class="btn" style="margin-left:20px;">Update Shipping Address</button></a>';
                    }else{
                      echo '<a href="updateadd.php"><button class="btn" style="margin-left:20px;">Add Shipping Address</button></a>';
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