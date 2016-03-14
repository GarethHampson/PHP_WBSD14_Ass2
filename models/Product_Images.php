<?php


class Product_Images {
    protected $images, $image_id;
    
    public function __construct($dbrow) {
        $this->images = $dbrow['image_url'];
        $this->image_id = $dbrow['id'];
        $this->image_order = $dbrow['image_order'];
    }
    
    public function getProductImages() {
        return $this->images;
    }
    public function getImageID() {
        return $this->image_id;
  }
   public function getImageOrder() {
        return $this->image_order;
  }
}