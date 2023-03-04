<?php
  session_start();
  if($_SESSION['Freshfarmloggedin'] === true){
    header("location: /shopping");
  }
  if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $mob = $_POST['mob'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];
    if ($pwd === $cpwd) {
      require_once "assets/php/db/config.php";
      $cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
      $chck = mysqli_query($link, $cond);
      if($chck){
        if(!(mysqli_num_rows($chck)>0)){
          $pwdhash = password_hash($pwd, PASSWORD_DEFAULT);
          $cond = "INSERT INTO `user`(`Name`, `Mail`, `Mobile`, `Password`, `role`, `cart`) VALUES ('$name','$mail','$mob','$pwdhash','customer','0')";
          $chck = mysqli_query($link, $cond);
          if($chck){
            $msg = "Account Created Successfully";
          }
          else{
            $msg = "Account Not Created";
          }
        }
        else{
          $msg = "Account Already exists with this mail";
        }
      }
    }
    else{
      $msg = "Password Missmatch";
    }
  }
?>
<?php include('header.php'); ?>

		<div class="main">
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
          <header>
            <div class="shopcontent">
              <div class="shopinner">
                <center>
                  <div class="form-back">
                <h3>Register an Account</h3>
                <center>
                <form method="post" action="">
                  <table>
                    <tr>
                      <td class="form-row"><label for="">Name</label></td>
                      <td class="form-row"><input type="text" name="name" class="form-inp" required autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">Mail</label></td>
                      <td class="form-row"><input type="text" name="mail" class="form-inp" required autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">Mobile</label></td>
                      <td class="form-row"><input type="text" maxlength="10" name="mob" required class="form-inp" autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">Password</label></td>
                      <td class="form-row"><input type="password" name="pwd" class="form-inp" required autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">Confirm Password</label></td>
                      <td class="form-row"><input type="password" name="cpwd" class="form-inp" required autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row" colspan="2" align="center"><span style="color: red;"><?php echo $msg; ?></span></td>
                    </tr>
                    <tr>
                      <td class="form-row" colspan="2" align="center"><input type="submit" name="create" class="form-btn" value="Create Now"></td>
                    </tr>
                    <tr>
                      <td class="form-row form-acc" colspan="2" align="center">Have an Account? <a href="login.php">Login</a></td>
                    </tr>
                  </table>
                </form>
              </center>
              </div>
                </center>
              </div>
            </div>
          </header>
        </div>

        <div class="shadow one"></div>
        <div class="shadow two"></div>

<?php include('footer.php'); ?>