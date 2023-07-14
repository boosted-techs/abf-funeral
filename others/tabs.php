<?php
  if($current_tab == "services"){
?>
  <ul>
   
    <li><a class="<?php echo ($this_tab == 'church')?'active':''; ?>" href="church.php">Packages</a></li>

  </ul>
<?php
  } elseif($current_tab == "transact"){
?>
  <ul>
    <li><a class="<?php echo ($this_tab == 'cart')?'active':''; ?>" href="cart.php">Pending</a></li>
    <li><a class="<?php echo ($this_tab == 'purchase')?'active':''; ?>" href="purchase.php">Cofirmed purchases</a></li>
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
