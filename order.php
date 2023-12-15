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

$order_id = $_GET['id'];
$conn = connect_orc($user_name, $password);
$query = "SELECT o.id, DATE_CREATED, TOTAL_PRICES, \"NUMBER\", ADDRESS, b.NAME as BRANCH_NAME, s.USERNAME as STAFF_NAME, p.NAME as PRODUCT_NAME, c.USERNAME as CUSTOMER_NAME, STATUS FROM SHOP.ORDERS o
LEFT JOIN (SELECT ID, NAME FROM SHOP.BRANCHES) b ON b.ID=o.BRANCH_ID
LEFT JOIN (SELECT ID, USERNAME FROM SHOP.STAFF) s ON s.ID=o.STAFF_ID
LEFT JOIN (SELECT ID, NAME FROM SHOP.PRODUCTS) p ON p.ID=o.PRODUCT_ID
LEFT JOIN (SELECT ID, USERNAME FROM SHOP.CUSTOMERS) c ON c.ID=o.CUSTOMER_ID WHERE o.ID = $order_id";
$stid = oci_parse($conn, $query);
oci_execute($stid, OCI_DEFAULT);
$row = oci_fetch_object($stid);

if (isset($_POST['submit'])) {
    $address = $_POST['address'];
    $address = filter_var($name, 513);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>

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
            <h3>update order</h3>
            <input type="text" name="customer" placeholder="Customer" class="box" maxlength="50" value="<?= $row->CUSTOMER_NAME ?>">
            <input type="text" name="product" placeholder="Product" class="box" maxlength="50" value="<?= $row->PRODUCT_NAME ?>">
            <input type="text" name="branch" placeholder="Branch" class="box" maxlength="50" value="<?= $row->BRANCH_NAME ?>">
            <input type="number" name="number" placeholder="Number" class="box" maxlength="50" value=<?= $row->NUMBER ?>>
            <input type="number" name="total_price" placeholder="Total Price" class="box" maxlength="50" value=<?= $row->TOTAL_PRICES ?>>
            <input type="text" name="staff" placeholder="Staff" class="box" maxlength="50" value="<?= $row->STAFF_NAME ?>">
            <input type="text" name="address" placeholder="Address" class="box" value="<?= strval($row->ADDRESS) ?>">
            <input type="text" name="date" placeholder="Date" class="box" value="<?= $row->DATE_CREATED ?>">
            <input type="submit" value="update now" name="submit" class="btn">
        </form>

    </section>
    <?php include 'components/footer.php'; ?>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>