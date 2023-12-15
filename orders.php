<?php

include 'components/connect.php';

session_start();
if (isset($_SESSION['user_name'])) {
   $user_name = $_SESSION['user_name'];
   $password = $_SESSION['password'];
} else {
   $user_name = "";
   $password = "";
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- header section starts  -->
   <?php include 'components/user_header.php'; ?>
   <!-- header section ends -->

   <div class="heading">
      <h3>orders</h3>
      <p><a href="html.php">home</a> <span> / orders</span></p>
   </div>

   <section class="orders">

      <h1 class="title">your orders</h1>

      <div class="box-container">

         <?php
         if ($user_name == '') {
            echo '<p class="empty">please login to see your orders</p>';
         } else {
            $conn = connect_orc($user_name, $password);
            $query = "SELECT o.id, DATE_CREATED, TOTAL_PRICES, \"NUMBER\", ADDRESS, b.NAME as BRANCH_NAME, s.USERNAME as STAFF_NAME, p.NAME as PRODUCT_NAME, c.USERNAME as CUSTOMER_NAME, STATUS FROM SHOP.ORDERS o
            LEFT JOIN (SELECT ID, NAME FROM SHOP.BRANCHES) b ON b.ID=o.BRANCH_ID
            LEFT JOIN (SELECT ID, USERNAME FROM SHOP.STAFF) s ON s.ID=o.STAFF_ID
            LEFT JOIN (SELECT ID, NAME FROM SHOP.PRODUCTS) p ON p.ID=o.PRODUCT_ID
            LEFT JOIN (SELECT ID, USERNAME FROM SHOP.CUSTOMERS) c ON c.ID=o.CUSTOMER_ID";
            $stid = oci_parse($conn, $query);
            oci_execute($stid, OCI_DEFAULT);
            // echo oci_num_rows($stid);
            if (true) {
               while ($row = oci_fetch_object($stid)) {
         ?>
                  <div class="box">
                     <p>Customer : <span><?= $row->CUSTOMER_NAME; ?></span></p>
                     <p>Product : <span><?= $row->PRODUCT_NAME; ?></span></p>
                     <p>Branch : <span><?= $row->BRANCH_NAME; ?></span></p>
                     <p>Number : <span><?= $row->NUMBER; ?></span></p>
                     <p>Totale Price : <span><?= $row->TOTAL_PRICES; ?></span></p>
                     <p>Staff : <span><?= $row->STAFF_NAME; ?></span></p>
                     <p>Address : <span><?= $row->ADDRESS; ?></span></p>
                     <p>Date : <span><?= $row->DATE_CREATED; ?></span></p>
                     <p>Status : <span style="color:<?php if ($row->STATUS == 'T1') {
                                                         echo 'red';
                                                      } else {
                                                         echo 'green';
                                                      }; ?>"><?php if ($row->STATUS == 'T1') {
                                                                  echo 'New';
                                                               } else {
                                                                  echo 'Received';
                                                               }; ?></span> </p>
                     <a type="button" class="btn" href="order.php?id=<?= $row->ID ?>">EDIT</a>
                  </div>
         <?php
               }
            } else {
               echo '<p class="empty">no orders placed yet!</p>';
            }
         }
         ?>

      </div>
      <div class="box"><a type="button" class="btn" href="insert_order.php">+</a></div>

   </section>










   <!-- footer section starts  -->
   <?php include 'components/footer.php'; ?>
   <!-- footer section ends -->






   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>