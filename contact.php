<?php include('header.php'); ?>
<?php
  if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $mob = $_POST['mob'];
    $query = $_POST['msgbody'];
      require_once "assets/php/db/config.php";
          $cond = "INSERT INTO `message`(`Name`, `Mail`, `Mobile`, `Message`) VALUES ('$name','$mail','$mob','$query')";
          $chck = mysqli_query($link, $cond);
          if($chck){
            $msg = "Thank You For Contacting Us, We will get Back to you Soon.";
          }
          else{
            $msg = "Message Not Sent!";
          }
    }
?>
		<div class="main">
          <header>
            <div class="shopcontent">
              <div class="shopinner">
                <center>
                  <div class="form-back">
                <h3>Contact Us</h3>
                <center>
                <form method="post" action="">
                  <table>
                    <tr>
                      <td class="form-row"><label for="">Name</label></td>
                      <td class="form-row"><input type="text" name="name" class="form-inp" required autocomplete="off" value="<?php session_start();
  if($_SESSION['Freshfarmloggedin'] === true){echo $_SESSION['ffname'];} ?>"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">Mail</label></td>
                      <td class="form-row"><input type="text" name="mail" class="form-inp" required autocomplete="off" value="<?php session_start();
  if($_SESSION['Freshfarmloggedin'] === true){echo $_SESSION['ffmail'];} ?>"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">Mobile</label></td>
                      <td class="form-row"><input type="text" maxlength="10" name="mob" required class="form-inp" autocomplete="off" value="<?php session_start();
  if($_SESSION['Freshfarmloggedin'] === true){echo $_SESSION['ffmob'];} ?>"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">Message</label></td>
                      <td class="form-row"><textarea name="msgbody" class="form-inp" required autocomplete="off"></textarea></td>
                    </tr>
                    <tr>
                      <td class="form-row" colspan="2" align="center"><span style="color: red;"><?php echo $msg; ?></span></td>
                    </tr>
                    <tr>
                      <td class="form-row" colspan="2" align="center"><input type="submit" name="create" class="form-btn" value="Send"></td>
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