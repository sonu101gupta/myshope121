<?php
  session_start();
  if(!$_SESSION['Freshfarmloggedin'] === true){
    header("location: /shopping/login.php");
  }
  if (isset($_POST['create'])) {
    $add = $_POST['add'];
    $mail = $_SESSION['ffmail'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $msg = "";
    require_once "assets/php/db/config.php";
    $pin = $_POST['pin'];
    $cond = "UPDATE `user` SET `Address` = '$add', `City` = '$city', `State` = '$state', `Pincode` = '$pin' WHERE `Mail` = '$mail'";
    $chck = mysqli_query($link, $cond);
    if($chck){
      $msg = "Address Updated Successfully";
      header("location: /shopping/checkout.php");
    }
    else{
      $msg = "Address not Updated";
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
                <h3>Update Address</h3>
                <center>
                <form method="post" action="">
                  <table>
                    <tr>
                      <td class="form-row"><label for="">Address</label></td>
                      <td class="form-row"><input type="text" name="add" class="form-inp" required autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">City</label></td>
                      <td class="form-row"><input type="text" name="city" class="form-inp" required autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">State</label></td>
                      <td class="form-row"><input type="text" maxlength="10" name="state" required class="form-inp" autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row"><label for="">Pincode</label></td>
                      <td class="form-row"><input type="text" maxlength="10" name="pin" required class="form-inp" autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td class="form-row" colspan="2" align="center"><span style="color: red;"><?php echo $msg; ?></span></td>
                    </tr>
                    <tr>
                      <td class="form-row" colspan="2" align="center"><input type="submit" name="create" class="form-btn" value="Update"></td>
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