<?php
  if($current_tab == "services"){
?>
  <ul>
    <li><a class="<?php echo ($this_tab == 'funeral')?'active':''; ?>" href="funeral.php">Packages</a></li>
    <li><a class="<?php echo ($this_tab == 'church')?'active':''; ?>" href="church.php">Church</a></li>
    <li><a class="<?php echo ($this_tab == 'headstone')?'active':''; ?>" href="headstone.php">Headstone Maker</a></li>
    <li><a class="<?php echo ($this_tab == 'candle')?'active':''; ?>" href="candle.php">Candle Maker</a></li>
    <li><a class="<?php echo ($this_tab == 'flower')?'active':''; ?>" href="flower.php">Flower Shop</a></li>
    <li><a class="<?php echo ($this_tab == 'food')?'active':''; ?>" href="food.php">Food Catering</a></li>
  </ul>
<?php
  } elseif($current_tab == "transact"){
?>
  <ul>
    <li><a class="<?php echo ($this_tab == 'cart')?'active':''; ?>" href="cart.php">My Cart</a></li>
    <li><a class="<?php echo ($this_tab == 'purchase')?'active':''; ?>" href="purchase.php">Purchases</a></li>
  </ul>
<?php
  } elseif($current_tab == "users"){
?>
  <ul>
    <li><a class="<?php echo ($this_tab == 'seeker')?'active':''; ?>" href="admin_users.php">Clients</a></li> <!-- DEFAULT -->
    <li><a class="<?php echo ($this_tab == 'provider')?'active':''; ?>" href="admin_users_provider.php">Providers</a></li>
  </ul>
<?php
  } elseif($current_tab == "transact_admin"){
?>
  <ul>
    <li><a class="<?php echo ($this_tab == 'seeker')?'active':''; ?>" href="admin_transact.php">Seekers</a></li> <!-- DEFAULT -->
    <li><a class="<?php echo ($this_tab == 'provider')?'active':''; ?>" href="admin_transact_provider.php">Providers</a></li>
  </ul>
<?php
  }
?>
