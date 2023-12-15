<?php

include 'components/connect.php';
include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- header section starts  -->
   <?php include 'components/user_header.php'; ?>
   <!-- header section ends -->

   <!-- search form section starts  -->

   <section class="search-form">
      <form method="post" action="">
         <input type="text" name="search_box" placeholder="search here..." class="box">
         <button type="submit" name="search_btn" class="fas fa-search"></button>
      </form>
   </section>

   <!-- search form section ends -->


   <section class="products" style="min-height: 100vh; padding-top:0;">

      <div class="box-container">
         <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
            <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
            <a href="#" class="cat"><?= $fetch_products['category']; ?></a>
            <div class="name"><?= $fetch_products['name']; ?></div>
         </form>
      </div>

   </section>











   <!-- footer section starts  -->
   <?php include 'components/footer.php'; ?>
   <!-- footer section ends -->







   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>