
<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "products";
  
    // object properties
    public $id;
    public $name;
    public $price;
    public $sku;
    public $productType_id;
    public $size;
    public $height;
    public $width;
    public $length;
    public $weight;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // create product
    function create(){
  
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, price=:price, sku=:sku, productType_id=:productType_id, size=:size, height=:height,
                    width=:width, length=:length, weight=:weight";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->sku=htmlspecialchars(strip_tags($this->sku));
        $this->size=htmlspecialchars(strip_tags($this->size));
        $this->height=htmlspecialchars(strip_tags($this->height));
        $this->width=htmlspecialchars(strip_tags($this->width));
        $this->length=htmlspecialchars(strip_tags($this->length));
        $this->weight=htmlspecialchars(strip_tags($this->weight));
  
  
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":productType_id", $this->productType_id);
        $stmt->bindParam(":size", $this->size);
        $stmt->bindParam(":height", $this->height);
        $stmt->bindParam(":width", $this->width);
        $stmt->bindParam(":length", $this->length);
        $stmt->bindParam(":weight", $this->weight);
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
    function readAll(){
  
        $query = "SELECT
                    id, name, sku, price, productType_id, size, weight, height, width, length
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name ASC";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
      
        return $stmt;
    }

    // delete the product
    function delete(){
    
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
    
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}

?>