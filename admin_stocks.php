<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}
else
{

    if(isset($_POST['add_product']))
    {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $weight = $_POST['weight'];
        $bprice = $_POST['bprice'];
        $sprice = $_POST['sprice'];

        $select_product_name = mysqli_query($conn, "SELECT name FROM `inventory` WHERE name = '$name'") or die('query failed');;
        
        if(mysqli_num_rows($select_product_name) > 0){
            $message[] = 'stock name already added';
        }
        else
        {
            $add_product_query = mysqli_query($conn, "INSERT INTO `inventory`(name, weight, bprice, sprice) VALUES('$name', '$weight', '$bprice', '$sprice')") or die('query failed');

            if($add_product_query){
                $message[] = 'stock added successfully!';
            }
            else{
                $message[] = 'stock could not be added!';
            }
        }
    }
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `inventory` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_stocks.php');
}

if(isset($_POST['update_product'])){

    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_weight = $_POST['update_weight'];
    $update_bprice = $_POST['update_bprice'];
    $update_sprice = $_POST['update_sprice'];
   
    mysqli_query($conn, "UPDATE `inventory` SET name = '$update_name', bprice = '$update_bprice', sprice = '$update_sprice', weight = '$update_weight' WHERE id = '$update_p_id'") or die('query failed');
 
    header('location:admin_stocks.php');
 
 }
 
       
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
    /* Style for table */
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 30px;
  font-size: 2rem;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #8e44ad;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

/* Style for edit and delete links */
a {
  text-decoration: none;
  color: #4CAF50;
}

a:hover {
  text-decoration: underline;
}

  </style>
</head>
<body>
<?php include 'admin_header.php'; ?>


<section class="add-products">

   <h1 class="title">Offline Stocks</h1>

   <form action="" method="post" enctype="multipart/form-data">
  <h3>Add Stocks</h3>
  <input type="text" name="name" class="box" placeholder="enter product name" required>
  <!-- <textarea id="description" class="box" name="description" placeholder="enter product description" required></textarea>  -->
  <input type="number" min="1" name="weight" class="box" placeholder="enter product weight" required>
  <input type="number" min="1" name="bprice" class="box" placeholder="enter product buying price" required>
  <input type="number" min="1" step="1" name="sprice" class="box" placeholder="enter product selling price" required>
  <!-- set the min value to 0.01 and the step value to 0.01 to allow values like 0.10 -->
  <input type="submit" value="add stock" name="add_product" class="btn">
</form>

</section>


<!-- show products  -->
<section class="show-products">
   <div class="products-container">
      
      <div class="product-card">
        <table >
          <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Weight</th>
            <th>Buying Price</th>
            <th>Selling Price</th>
            <th>Actions</th>
          </tr>
            <?php
                $select_stock = mysqli_query($conn, "SELECT * FROM `inventory`") or die('query failed');
                if(mysqli_num_rows($select_stock) > 0){
                while($fetch_stock = mysqli_fetch_assoc($select_stock)){
            ?>
          <tr>
            <td><?php echo $fetch_stock['id'];?></td>
            <td><?php echo $fetch_stock['name'];?></td>
            <td><?php echo $fetch_stock['weight'];?></td>
            <td><?php echo $fetch_stock['bprice'];?></td>
            <td><?php echo $fetch_stock['sprice'];?></td>
            <td>
              <a href="admin_stocks.php?update=<?php echo $fetch_stock['id']; ?>">Update</a>
              <a href="admin_stocks.php?delete=<?php echo $fetch_stock['id']; ?>" onclick="return confirm('Delete this stock?');" class="delete-btn">Delete</a>
            </td>
            <?php
                }
            ?>
          </tr>
        </table>
      </div>
      <?php
         
      }else{
         echo '<p class="empty">No stocks added yet!</p>';
      }
      ?>
   </div>
</section>


<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `inventory` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">
      <input type="number" min="1" name="update_weight" value="<?php echo $fetch_update['weight']; ?>" min="0" class="box" required placeholder="enter product weight">
      <input type="number" min="1" name="update_bprice" value="<?php echo $fetch_update['bprice']; ?>" min="0" class="box" required placeholder="enter product buying price">
      <input type="number" min="1" name="update_sprice" value="<?php echo $fetch_update['sprice']; ?>" min="0" class="box" required placeholder="enter product selling price">
      <input type="submit" value="update" name="update_product" class="btn">    
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>

</body>