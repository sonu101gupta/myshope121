    </div>

      <div class="links">
        <ul>
          <li>
            <a href="/shopping" style="--i: 0.05s;">Home</a>
          </li>
          <li>
            <a href="/shopping/shop.php" style="--i: 0.1s;">Shop</a>
          </li>
          <li>
            <a href="/shopping/order.php" style="--i: 0.15s;">Orders</a>
          </li>
          <li>
            <a href="/shopping/account.php" style="--i: 0.2s;">My Account</a>
          </li>
          <li>
            <a href="/shopping/contact.php" style="--i: 0.25s;">Contact</a>
          </li>
          <li>
            <?php
              session_start();
              if($_SESSION['Freshfarmloggedin'] === true){
                echo '<a href="/shopping/logout.php" style="--i: 0.3s;">Logout</a>';
              }
              else{
                echo '<a href="/shopping/login.php" style="--i: 0.3s;">Login</a>';
              }
            ?>
          </li>
        </ul>
      </div>
    </div>
    <script src="assets/js/app.js"></script>

  </body>
</html>