<?php


interface Type{

public function switch();

}

class DVD implements type {
public function switch() {
    echo ("<tr>
    <td>Size</td>
        <td><input type='number' id='size' name='size' class='form-control' required></td>
        </tr>");
}
}
class Forniture implements type {
public function switch() {
    echo ("<tr>
    <td>Height</td>
        <td><input type='number' id='height' name='height' class='form-control' required></td>
        </tr>
        <tr>
        <td>Width</td>
        <td><input type='number' id='width' name='width' class='form-control' required></td>
        </tr>
        <tr>
        <td>Length</td>
        <td><input type='number' id='length' name='length' class='form-control' required></td>
        </tr>");
}
}


class Book implements type {
public function switch() {
    echo ("<tr>
    <td>Weight</td>
        <td><input type='number' id='weight' name='weight' class='form-control' required></td>
        </tr>");
}
}

function typeSwitch (Type $type){

    return $type->switch();
}



if (isset($_POST['type_id'])){
    // include database and object file
    include_once 'config/database.php';
    include_once 'objects/product.php';
    include_once 'objects/productType.php';
    
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    
    // prepare product object
    $productType = new ProductType($db);
        
    // set product id to be deleted
    $productType->id = $_POST['type_id'];

    $productType->readName();
    $type = $productType->name;

    $form = typeSwitch(new $type);

    return $form;


}


?>