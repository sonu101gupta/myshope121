<?php include('header.php'); ?>
<?php
    require_once "../assets/php/db/config.php"; 
    if(isset($_POST['add'])){
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $mob = $_POST['mob'];
        $role = $_POST['role'];
        $pwd = $_POST['pwd'];
        $cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
        $chck = mysqli_query($link, $cond);
        if($chck){
            if(!(mysqli_num_rows($chck)>0)){
            $pwdhash = password_hash($pwd, PASSWORD_DEFAULT);
            $cond = "INSERT INTO `user`(`Name`, `Mail`, `Mobile`, `Password`, `role`, `cart`) VALUES ('$name','$mail','$mob','$pwdhash','$role','0')";
            $chck = mysqli_query($link, $cond);
            if($chck){
                $msg = "Employee Added Successfully";
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
?>
<h3>Add Employee</h3>
<form class="form-back" method="POST" action="">
	<input type="text" name="name" placeholder="Employee Name" required class="form-inp"><br>
	<input type="text" name="mail" placeholder="Employee Email" required class="form-inp"><br>
	<input type="number" name="mob" placeholder="Employee Mobile Number" required class="form-inp"><br>
    <select required class="form-inp" name="role">
        <option value="order_manager">Order Manager</option>
        <option value="product_manager">Product Manager</option>
    </select></br>
    <input type="password" name="pwd" placeholder="Enter Password" required class="form-inp"><br>
    <input type="submit" name="add" class="form-btn" value="Add Employee"><br>
	<span style="color:red;"><?php echo $msg; ?></span>
</form>
<?php include('footer.php'); ?>