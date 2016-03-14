 <?php

require_once __DIR__ . '/Category.php';
require_once __DIR__ . '/TableAbstract.php';

class CategoryTable extends TableAbstract {

    protected $name = 'hampson_wbsd14_ass2_category';
    protected $primaryKey = 'id';
    
    public function fetchAllCategories() {
        $results = $this->fetchAll();
        $categoryArray = array();
        while ($row = $results->fetch()) {
            $categoryArray[] = new Category($row);
        }
        return $categoryArray;
    }
    
    
    public function fetchCategorybyId($data) {
         
      $sql = "SELECT id, category, description, cat_image 
              FROM $this->name
              WHERE id = :cat_id
              ORDER BY id ASC";  
      
        $results = $this->dbh->prepare($sql); 
      
        $results->execute(array(
                    ':cat_id' => $data['cat_id']
                ));
             
        $categoryArray = array();
        while ($row = $results->fetch()) {
            $categoryArray[] = new Category($row);
        }
        return $categoryArray;
         
     }

}