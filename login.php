<?php

include 'components/connect.php';

session_start();


if (isset($_POST['submit'])) {

   $user_name = $_POST['user_name'];
   $user_name = filter_var($user_name, 513);
   $pass = $_POST['password'];
   $pass = filter_var($pass, 513);
   $conn = connect_orc($user_name, $pass);

   if ($conn) {
      $_SESSION['user_name'] = $user_name;
      $_SESSION['password'] = $pass;
      header('location:home.php');
   } else {
      $message[] = 'incorrect username or password!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <!-- header section starts  -->
   <?php include 'components/user_header.php'; ?>
   <!-- header section ends -->
   <section class="form-container">
      <form action="" method="post">
         <h3>login now</h3>
         <input type="text" name="user_name" required placeholder="Enter your username" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="password" required placeholder="Enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="submit" value="login now" name="submit" class="btn">
         <p>don't have an account? <a href="register.php">register now</a></p>
      </form>
   </section>
   <?php include 'components/footer.php'; ?>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>
</body>

</html>