<?php
    
// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/productType.php';
  
// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
  
$product = new Product($db);
$productType = new productType($db);
  

$stmt = $product->readAll();


$page_title = "Product List";
include_once "layout_header.php";
include_once "switch.php";
?>
<form action="delete_product.php" method="POST">
    <div class="d-grid gap-2 d-md-block">
    <a href="addproduct.php" class="btn btn-default pull-right" type="button">ADD</a>
    <button class="btn btn-default pull-right delete" id="delete-product-btn" name="massDelete" type="submit">MASS DELETE</button>
    </div>

<?php
echo "<br>";
echo "<br>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        echo "<div row view-group>";
        echo "<div class='item col-xs-3 col-lg-3'>";
        echo "<div class='group card-title inner list-group-item-heading thumbnail card'>";
        echo "<input class='delete-checkbox' type='checkbox' name='delete_id[]' value='{$id}'>";


        echo "<h4>{$sku}</h4>";
        echo "<h4>{$name}</h4>";
        echo "<h4>{$price}$</h4>";

        if ($productType_id == 1){
            echo "<h4>Size:{$size}Mb</h4>";

        }elseif($productType_id == 2){
            echo "<h4>Dimension:{$height}x{$width}x{$length}</h4>";

        }elseif($productType_id == 3){

            echo "<h4>Weight:{$weight}Kg</h4>";
        }
        
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

?>
</form>

<?php
// set page footer
include_once "layout_footer.php";
?>