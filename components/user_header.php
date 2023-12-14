<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">Shop &#8364;</a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="about.php">about</a>
         <a href="menu.php">menu</a>
         <a href="orders.php">orders</a>
         <a href="contact.php">contact</a>
      </nav>

      <div class="icons">
         <a href="search.php"><i class="fas fa-search"></i></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
         $user_name = '';
         if (isset($_SESSION['user_name'])) {
            $user_name = $_SESSION['user_name'];
         };
         if (true) {
         ?>
            <p class="name">
               <?= $user_name ?>
            </p>
            <div class="flex">
               <a href="profile.php" class="btn">profile</a>
               <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
            </div>
            <p class="account">
               <a href="login.php">login</a> or
               <a href="register.php">register</a>
            </p>
         <?php
         } else {
         ?>
            <p class="name">please login first!</p>
            <a href="login.php" class="btn">login</a>
         <?php
         }
         ?>
      </div>

   </section>

</header>