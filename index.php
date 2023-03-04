<?php include('header.php'); ?>

		<div class="main">
          <header>
            <div class="overlay">
              <div class="inner">
                <h2 class="title">
                <?php
                  session_start();
                  if($_SESSION['Freshfarmloggedin'] === true){
                    echo "Welcome ".$_SESSION['ffname'];
                  }
                  else{
                    echo "We have it all!";
                  }
                ?>
                </h2>
                <p>
                  Do you like vegetables and essentials delivered to your doorstep without heading out? Then check out our Product and Order Now.
                </p>
                <a href="shop.php"><button class="btn">Shop Now</button></a>
              </div>
            </div>
          </header>
        </div>

        <div class="shadow one"></div>
        <div class="shadow two"></div>

<?php include('footer.php'); ?>