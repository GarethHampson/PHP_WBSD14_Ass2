<?php

class Category {
    protected $id, $category, $description, $cat_image, $date;
    
    public function __construct($dbrow) {
        $this->id = $dbrow['id'];
        $this->category = $dbrow['category'];
        $this->description = $dbrow['description'];
        $this->cat_image = $dbrow['cat_image'];
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getCategory() {
        return $this->category;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function getImage() {
        return $this->cat_image;
    }
    
}
