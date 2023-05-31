<?php
 // Create a new Razorpay payment
 require('razorpay-php/Razorpay.php');
 use Razorpay\Api\Api;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Include your custom dbconfig file
include 'config.php';

// Get the currently logged in user's ID
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Get the form data and store everything into session
    if(isset($_POST['order_btn'])){

      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $number = $_POST['number'];
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
      $placed_on = date('d-M-Y');
      
      
      $cart_total = 0;
      $cart_products[] = '';
   
      $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($cart_query) > 0){
         while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
         }
      }
      $_SESSION['email']=$email;
      $_SESSION['name']=$name;
      $_SESSION['price']=$cart_total;
   
      $total_products = implode(', ',$cart_products);
   
      $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');
   


    // Check if there are enough products/quantity available and handle
    

   
    $api_key = 'rzp_test_xwIpNJsn43cAV7';
    $api_secret = 'MXVHLxYxM9naOExYLNbr0zQH';
    $api = new Api($api_key, $api_secret);
    $order = $api->order->create(array(
        'amount' => $cart_total * 100, // amount in paise
        'currency' => 'INR',
        'payment_capture' => 1 // auto capture payment
    ));
    $payment_id = '';

    // Insert the order records into table
    if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         $order_id = mysqli_insert_id($conn);
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
    // Update the product quantity


    // Redirect to the Razorpay payment page
    $payment_id = $order['id'];
    $amount = $cart_total * 100;
    $currency = 'INR';
    $name = $name;
    $email = $email;
    $number= $number;
    $callback_url = 'razorpay_callback.php';
    $razorpay_key = 'rzp_test_xwIpNJsn43cAV7';//RAZORPAY API KEY
    $razorpay_secret = 'MXVHLxYxM9naOExYLNbr0zQH';//RAZORPAY SECRET KEY
    $hash = hash_hmac('sha256', $payment_id . '|' . $amount . '|' . $currency . '|' . $name . '|' . $email . '|', $razorpay_secret);//ADD MORE CONTENTS TO THE HAS USING OTHER FACTORS LIKE ADDRESS IF NEEDED
    header("Location: pay.php?checkout=manual");
    exit();
    //https://checkout.razorpay.com/v1/checkout/payment?razorpay_key=$razorpay_key&razorpay_payment_id=$payment_id&razorpay_amount=$amount&razorpay_currency=$currency&razorpay_name=$name&razorpay_email=$email&razorpay_callback_url=$callback_url&razorpay_signature=$hash
}
?>
         </form>
         <?php
      }
   

// this is the manual payment goes to



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">home</a> / checkout </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo 'Rs '.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span>Rs <?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" required placeholder="e.g. mumbai">
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" required placeholder="e.g. maharashtra">
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" required placeholder="e.g. india">
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>