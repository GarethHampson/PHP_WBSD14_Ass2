<?php

require_once __DIR__ . '/Product.php';
require_once __DIR__ . '/TableAbstract.php';

class ProductsTable extends TableAbstract {

    protected $name = 'hampson_wbsd14_ass2_products';
    protected $primaryKey = 'id';

    public function fetchAllProducts() {
        $results = $this->fetchAll();
        $productsArray = array();
        while ($row = $results->fetch()) {
            $productsArray[] = new Product($row);
        }
        return $productsArray;
    }

    public function fetchBasicProductData() {

        $sql = "SELECT p.id, p.cat_id, p.name, b.brand_image, p.price, pi.image_url, p.introduction, p.description 
               FROM `hampson_wbsd14_ass2_products` AS p, `hampson_wbsd14_ass2_brands` AS b, `hampson_wbsd14_ass2_product_images` AS pi
               WHERE p.brand_id = b.id AND pi.product_id = p.id AND pi.image_order = 1
               ORDER BY p.id ASC";

        $results = $this->dbh->prepare($sql);
        $results->execute();

        $productsArray = array();
        while ($row = $results->fetch()) {
            $productsArray[] = new Product($row);
        }
        return $productsArray;
    }
    
    public function fetchBrowsingProductData() {

        $sql = "SELECT p.id, p.cat_id, p.name, b.brand_image, p.price, pi.image_url, p.introduction, p.description 
               FROM `hampson_wbsd14_ass2_products` AS p, `hampson_wbsd14_ass2_brands` AS b, `hampson_wbsd14_ass2_product_images` AS pi
               WHERE p.brand_id = b.id AND pi.product_id = p.id AND pi.image_order = 1
               ORDER BY p.id ASC
               LIMIT :count, :offset";
        
        $count = 10;
        $offset = 1;
        $results = $this->dbh->prepare($sql);
        $results->bindParam(':count', $count);
        $results->bindParam(':offset', $offset);
        
        $results->execute();

        $productsArray = array();
        while ($row = $results->fetch()) {
            $productsArray[] = new Product($row);
        }
        return $productsArray;
    }
    

    public function fetchProductByCategory($data) {

        $sql = "SELECT p.id, p.cat_id, p.name, b.brand_image, p.price, pi.image_url, p.introduction, p.description
               FROM `hampson_wbsd14_ass2_products` AS p, `hampson_wbsd14_ass2_brands` AS b, `hampson_wbsd14_ass2_product_images` AS pi
               WHERE p.brand_id = b.id AND pi.product_id = p.id AND pi.image_order = 1 AND cat_id = :cat_id 
               ORDER BY p.id ASC";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':cat_id' => $data['cat_id']
        ));

        $productsArray = array();
        while ($row = $results->fetch()) {
            $productsArray[] = new Product($row);
        }
        return $productsArray;
    }

    public function fetchProductById($data) {

        $sql = "SELECT p.id, p.cat_id, p.name, p.introduction, p.description, b.brand_image, p.price, pi.image_url 
               FROM `hampson_wbsd14_ass2_products` AS p 
               INNER JOIN `hampson_wbsd14_ass2_brands` AS b ON p.brand_id = b.id 
               INNER JOIN `hampson_wbsd14_ass2_product_images` AS pi ON  p.id = pi.product_id
               WHERE pi.image_order = 1 AND p.id = :id";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':id' => $data['id']
        ));

        $productsArray = array();
        while ($row = $results->fetch()) {
            $productsArray[] = new Product($row);
        }
        return $productsArray;
    }
    
//    public function fetchProductById($data) {
//
//        $sql = "SELECT p.id, p.cat_id, p.name, p.introduction, p.description, b.brand_image, p.price, pi.image_url 
//               FROM `hampson_wbsd14_ass2_products` AS p, `hampson_wbsd14_ass2_brands` AS b, `hampson_wbsd14_ass2_product_images` AS pi
//               WHERE p.brand_id = b.id AND pi.product_id = p.id AND pi.image_order = 1 AND p.id = :id";
//
//        $results = $this->dbh->prepare($sql);
//
//        $results->execute(array(
//            ':id' => $data['id']
//        ));
//
//        $productsArray = array();
//        while ($row = $results->fetch()) {
//            $productsArray[] = new Product($row);
//        }
//        return $productsArray;
//    }

    public function fetchProductImages($data) {
        $sql = "SELECT pi.image_url, pi.id , pi.image_order
               FROM `hampson_wbsd14_ass2_product_images` AS pi
               WHERE pi.product_id = :id
               ORDER BY image_order ASC";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':id' => $data['id']
        ));

        $productImages = array();
        while ($row = $results->fetch()) {
            $productImages[] = new Product_Images($row);
        }
        return $productImages;
    }

    public function fetchProductColours($data) {

        $sql = "SELECT DISTINCT(s.colour_id), c.colour_name
                FROM hampson_wbsd14_ass2_product_colour AS c, hampson_wbsd14_ass2_product_stock as s
                WHERE c.id = s.colour_id AND  s.product_id = :id
                ORDER BY c.colour_order ASC";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':id' => $data['id']
        ));

        $productColours = array();
        while ($row = $results->fetch()) {
            $productColours[] = new Product_Colour($row);
        }
        return $productColours;
    }

    public function fetchProductSizes($data) {


        $sql = "SELECT DISTINCT(s.size_id), siz.size_name
                FROM hampson_wbsd14_ass2_product_sizes AS siz, hampson_wbsd14_ass2_product_stock as s
                WHERE siz.size_id = s.size_id AND s.product_id = :id
                ORDER BY siz.size_order ASC";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':id' => $data['id']
        ));

        $productSizes = array();
        while ($row = $results->fetch()) {
            $productSizes[] = new Product_Size($row);
        }
        return $productSizes;
    }

    public function insertProductImages($data) {

        $sql = "INSERT INTO hampson_wbsd14_ass2_product_images (product_id, image_url, image_order) 
                VALUES (:product_id, :image_url, :image_order) ";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':product_id' => $data['product_id'],
            ':image_url' => $data['image_url'],
            ':image_order' => $data['image_order']
        ));

        return $this->dbh->lastInsertID();
    }

    public function deleteProductImages($data) {
        $sql = "DELETE FROM hampson_wbsd14_ass2_product_images WHERE id = :image_id";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':image_id' => $data['image_id'],
        ));
    }

    public function editProduct($data) {

        $sql = "UPDATE $this->name SET cat_id = :cat_id, name = :name, price = :price, introduction = :introduction, description = :description
                WHERE id = :id";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':id' => $data['prod_id'],
            ':cat_id' => $data['cat_id'],
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':introduction' => $data['introduction'],
            ':description' => $data['description']
        ));
    }

    public function addProduct($data) {

        $sql = "INSERT INTO hampson_wbsd14_ass2_products (cat_id, name, price, brand_id, introduction, description) 
                VALUES (:cat_id, :name, :price, :brand_id, :introduction, :description)";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':cat_id' => $data['cat_id'],
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':brand_id' => $data['brand_id'],
            ':introduction' => $data['introduction'],
            ':description' => $data['description']
         ));
        
        return $this->dbh->lastInsertID();
    }
    
    public function deleteProduct($data) {
        $sql = "DELETE FROM hampson_wbsd14_ass2_products WHERE id = :id";

        $results = $this->dbh->prepare($sql);

        $results->execute(array(
            ':id' => $data['id']
               ));
    }

}
