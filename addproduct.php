<?php
header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");

// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/productType.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$product = new Product($db);
$productType = new ProductType($db);

// set page headers
$page_title = "Product Add";
include_once "layout_header.php";



// check if the form was submitted
if($_POST){
  
    // set product property values
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->sku = $_POST['sku'];
    $product->productType_id = $_POST['productType_id'];
    if (array_key_exists('size', $_POST)){
        $product->size =($_POST['size']);
    }

    if(array_key_exists('height', $_POST)){
        $product->height = $_POST['height'];
        $product->width = $_POST['width'];
        $product->length = $_POST['length'];

    }

    if(array_key_exists('weight', $_POST)){
        $product->weight = ($_POST['weight']);
    }
  
    // create the product
    if($product->create()){
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    }else{
        echo("Please provide require data.");
    }
    
}
?>
  
<!-- HTML form for creating a product -->
<form id="product_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

<div class="d-grid gap-2 d-md-block">
  <a href="index.php" class="btn btn-default pull-right" type="button">CANCEL</a>
  <button class="btn btn-default pull-right" type="submit">SAVE</button>
</div>
  
    <table class='table table-hover table-responsive table-bordered'>
  
        <tr>
            <td>Sku</td>
            <td><input placeholder="Type sku code..." type='text' name='sku' id="sku" class='form-control' required></td>
           
        </tr>
            <td>Name</td>
            <td><input placeholder="Type name product..." type='text' id="name" name='name' class='form-control'required></td>
            
        <tr>
            
        </tr>
            <td>Price ($)</td>
            <td><input placeholder="Type product price..." type='text'  id="price" name='price' class='form-control'required></td>
            
        <tr>
            
        </tr>
  
        <tr>
            <td>Type Switcher</td>
            <td>
                <select class='form-control' id="productType" name='productType_id' onchange=getID(this.value) required>
                <option value="">Type Switcher...</option required>
            <?php
                // read the product categories from the database
                $stmt = $productType->read();
        
                
                    while ($row_type = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row_type);
                        echo "<option value='{$id}' id='{$id}'>{$name}</option>";
                        
                    }
                echo "</select>";
                ?>
            </td>
        </tr>
        <tbody id="switch">
            
        </tbody>
  
    </table>
</form>

<?php
  
// footer
include_once "layout_footer.php";
?>