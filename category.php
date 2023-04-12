<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="products">
   <h1 class="title">Latest Category</h1>
   <div class="box-container">
       <?php  
         $select_category = mysqli_query($conn, "SELECT * FROM `category`") or die('query failed');
         if(mysqli_num_rows($select_category) > 0){
            while($fetch_category = mysqli_fetch_assoc($select_category)){
               $id = $fetch_category['id'];
               $name = $fetch_category['name'];
               $image_name = $fetch_category['image'];
      ?>
      <a href="<?php echo SITEURL; ?>category-product.php?category_id=<?php echo $id; ?>">
      <div class="box-3 float-container">
         <?php 
            //check whether image is available or not
              if($image_name=="")
              {
               //display error message
               echo "<div class='error'>Image Not Available.</div>";
              }
              else
              {
               //image available
               ?>
              <img src="<?php echo SITEURL; ?>uploaded_img/<?php echo $image_name; ?>" class="img-responsive img-curve">
               <?php
                 }
              ?>
      </div>
      </a>
      <?php
         }
      }else{
         echo '<p class="empty">no catagories added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">

   </div>
   </div>
</section>
<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>