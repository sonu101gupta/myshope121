<?php include('header.php'); ?>
<a href="addadminusers.php"><button class="btn">Add Employee</button></a><br><br>
<?php
    require_once "../assets/php/db/config.php";
    $cond = "SELECT * FROM `user` WHERE `role` = 'product_manager' OR `role` = 'order_manager'";
    $chck = mysqli_query($link, $cond);
    if ($chck) {
        if (mysqli_num_rows($chck) > 0) {
            while ($data = mysqli_fetch_array($chck)) {
                $name = $data['Name'];
                $mail = $data['Mail'];
                $mob = $data['Mobile'];
                $role = $data['role'];
                echo '<div class="user-row"><div class="user-desp">';
                echo '<b style="font-size:18px;">'.$name.'</b><br>';
                echo '<i style="font-size:12px;">'.$role.'</i><br>';
                echo $mail.' | '.$mob;
                echo '</div></div>';
            }
        }
    }
?>
<?php include('footer.php'); ?>