<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
    $password = $_SESSION['password'];
} else {
    $user_name = '';
    $password = '';
    header('location:home.php');
};

$conn = connect_orc($user_name, $password);

if (isset($_POST['submit'])) {
    $address = $_POST['address'];
    $address = filter_var($address, 513);
    $customer = $_POST['customer'];
    $customer = filter_var($customer, 513);
    $product = $_POST['product'];
    $product = filter_var($product, 513);
    $number = $_POST['number'];
    $number = filter_var($number, 513);


    $query = "SELECT PRICE FROM SHOP.PRODUCTS WHERE ID=$product";
    $stid = oci_parse($conn, $query);
    oci_execute($stid, OCI_DEFAULT);
    $row = oci_fetch_object($stid);
    $total_price = $row->PRICE * $number;

    $query = "SELECT ID, BRANCH_ID FROM SHOP.STAFF WHERE USERNAME='$user_name'";
    $stid = oci_parse($conn, $query);
    oci_execute($stid, OCI_DEFAULT);
    $row = oci_fetch_object($stid);
    $branch_id = $row->BRANCH_ID;
    $staff_id = $row->ID;

    $query = "INSERT INTO SHOP.ORDERS (TOTAL_PRICES, \"NUMBER\",ADDRESS, BRANCH_ID, STAFF_ID, PRODUCT_ID, CUSTOMER_ID) VALUES($total_price, $number, '$address', $branch_id, $staff_id, $product, $customer)";
    $stid = oci_parse($conn, $query);
    oci_execute($stid);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Order</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <!-- header section starts  -->
    <?php include 'components/user_header.php'; ?>
    <!-- header section ends -->

    <section class="form-container update-form">

        <form action="" method="post">
            <h3>insert order</h3>
            <select name="customer" class="box" required>
                <option value="" disabled selected>Select customer</option>
                <?php
                $query = "SELECT ID, USERNAME FROM SHOP.CUSTOMERS";
                $stid = oci_parse($conn, $query);
                oci_execute($stid, OCI_DEFAULT);
                while ($row = oci_fetch_object($stid)) {
                    echo "<option value=$row->ID>$row->USERNAME</option>";
                } ?>
            </select>
            <select name="product" class="box" required>
                <option value="" disabled selected>Select product</option>
                <?php
                $query = "SELECT ID, NAME FROM SHOP.PRODUCTS";
                $stid = oci_parse($conn, $query);
                oci_execute($stid, OCI_DEFAULT);
                while ($row = oci_fetch_object($stid)) {
                    echo "<option value=$row->ID>$row->NAME</option>";
                } ?>
            </select>
            <input type="number" name="number" placeholder="Number" class="box" maxlength="50" required>
            <input type="text" name="address" placeholder="Address" class="box" required>
            <input type="submit" value="insert now" name="submit" class="btn">
        </form>

    </section>
    <?php include 'components/footer.php'; ?>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>