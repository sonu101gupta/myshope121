<?php
  include('header.php');
  session_start();
  if($_SESSION['Freshfarmloggedin'] === true){
    header("location: /shopping");
  }
  if (isset($_POST['login'])) {
    $mail = $_POST['mail'];
    $pwd = $_POST['pwd'];
    require_once "assets/php/db/config.php";
    $cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
    $chck = mysqli_query($link, $cond);
    if($chck){
      if(mysqli_num_rows($chck)>0){
        $data = mysqli_fetch_array($chck);
        $hashed_password = $data['Password'];
        if(password_verify($pwd, $hashed_password)){
          $_SESSION['Freshfarmloggedin'] = true;
          $_SESSION['ffname'] = $data['Name'];
          $_SESSION['ffmail'] = $data['Mail'];
          $_SESSION['ffmob'] = $data['Mobile'];
          $_SESSION['id'] = $data['id'];
          $_SESSION['role'] = $data['role'];
          $admin_role = array("admin", "order_manager", "product_manager");
          if ($data['role'] === "customer"){
            header("location: /shopping");
          }
          elseif (in_array($data['role'], $admin_role)) {
            $_SESSION['Freshfarmloggedinadmin'] = true;
            header("location: /shopping/admin");
          }
        }
        else{
          $msg = "Wrong Password";
        }
      }
      else{
        $msg = "No Account linked with this Account";
      }
    }
  }
?>

		<div class="main">
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
          <header>
            <div class="shopcontent">
              <div class="shopinner">
                <center>
                  <div class="form-back">
                <h3>Login</h3>
                <center>
                <form method="post" action="">
                  <table>
                    <tr>
                    <tr>
                      <td class="form-row"><label for="">Mail</label></td>
                      <td class="form-row"><input type="text" required name="mail" class="form-inp" value="<?php echo $mail; ?>" autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">Password</label></td>
                      <td class="form-row"><input type="password" required name="pwd" class="form-inp" autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row" colspan="2" align="center"><span style="color: red;"><?php echo $msg; ?></span></td>
                    </tr>
                    <tr>
                      <td class="form-row" colspan="2" align="center"><input type="submit" name="login" class="form-btn" value="Login"></td>
                    </tr>
                    <tr>
                      <td class="form-row form-acc" colspan="2" align="center">Don't have an Account? <a href="register.php">Create Now</a></td>
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
