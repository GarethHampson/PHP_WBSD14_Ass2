<?php


class Product {
    protected $id, $category, $name, $introduction, $description, $brand, $price, $image;
    protected $images = NULL;
    
    public function __construct($dbrow) {
        $this->id = $dbrow['id'];
        $this->category = $dbrow['cat_id'];
        $this->name = $dbrow['name'];
        $this->introduction = $dbrow['introduction'];
        $this->description = $dbrow['description'];
        $this->brand = $dbrow['brand_image'];
        $this->price = $dbrow['price'];
        $this->image = $dbrow['image_url'];
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getCategory() {
        return $this->category;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getIntroduction() {
        return $this->introduction;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function getBrand() {
        return $this->brand;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function getImage() {
        return $this->image;
    }
    
    public function getImages() {
        if ($this->images === NULL)
        {
            //retrieve images from DB
            $database = new ProductsTable();
            $this->images = $database->fetchProductImages($this->id);
        }
        return $this->images;
    }
}


