<?php
// check if value was posted
if($_POST){
  
    // include database and object file
    include_once 'config/database.php';
    include_once 'objects/product.php';
    include_once 'objects/productType.php';
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare product object
    $product = new Product($db);
      
    // set product id to be deleted
    if(isset($_POST['massDelete'])){
        $selected_id = $_POST['delete_id'];
        foreach($selected_id as $product->id){
            $product->delete();
        }
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    }

}
?>