<?php
	require_once "assets/php/db/config.php";
	session_start();
    $mail = $_SESSION['ffmail'];
    $cond = "SELECT * FROM `user` WHERE `Mail` = '$mail'";
    $chck = mysqli_query($link, $cond);
    if($chck){
     	$data = mysqli_fetch_array($chck);
    	$cart = $data['cart'];
    	$arr = explode(",",$cart);
    	$id = $_GET['id'];
    	if (count($arr) <= 1) {
			$updated = 0;
		}else{
    	echo $key = array_search($id, $arr);
    	unset($arr[$key]);
		#unset($arr[$key]);
		
		/*if ($arr[$key] === null) {
			while ($key < count($arr)) {
				$arr[$key] = $arr[$key+1];
				$key += 1;
			}
		}*/
		#array_pop($arr);
		print_r($arr);
		
		
			$updated = implode(",",$arr);
		}
		$cond = "UPDATE `user` SET `cart`='$updated' WHERE `Mail` = '$mail'";
	    $chck = mysqli_query($link, $cond);
    	if($chck){
    		header('Location: ' . $_SERVER['HTTP_REFERER']);
    		echo "Done";
    	}
    }
?>