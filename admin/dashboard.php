<?php

include '../include/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../include/admin_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">


      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pending']);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
         ?>
        <?php
            $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = 'completed' ");
            $select_completed->execute();
            $number_of_completed = $select_completed->rowCount()
         ?>
         <h3><span><?= $number_of_completed; ?></h3>
         <p>payment completed</p>
         <a href="paid_orders.php" class="btn">see paid orders</a>
      </div>

      <div class="box">
        <?php
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = 'pending' ");
            $select_pendings->execute();
            $number_of_pendings = $select_pendings->rowCount()
         ?>
         <h3><span><?= $number_of_pendings; ?></h3>
         <p>payment remaining</p>
         <a href="unpaid_orders.php" class="btn">see unpaid orders</a>
      </div>

      <div class="box">
         <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
         ?>
         <h3><?= $number_of_orders; ?></h3>
         <p>orders placed</p>
         <a href="placed_orders.php" class="btn">see all orders</a>
      </div>

      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>products added</p>
         <a href="products.php" class="btn">see products</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>normal users</p>
         <a href="users_accounts.php" class="btn">see users</a>
      </div>

      <div class="box">
         <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
         ?>
         <h3><?= $number_of_admins; ?></h3>
         <p>admin users</p>
         <a href="admin_accounts.php" class="btn">see admins</a>
      </div>

      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>new messages</p>
         <a href="messages.php" class="btn">see messages</a>
      </div>

   </div>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>