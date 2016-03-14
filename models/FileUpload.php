<?php

class FileUpload {
    
    protected $filetoupload;
    
    public function __construct($filetoupload) {
        $this->filetoupload = $filetoupload;
    }
    
    public function upload() {
        if ($this->filetoupload['error'] == UPLOAD_ERR_NO_FILE)
        {
            $result = true;
        }
        else if (is_uploaded_file($this->filetoupload['tmp_name']))
        {
            if ($this->filetoupload['type'] == 'image/jpeg' || $this->filetoupload['type'] == 'image/pjpeg' || $this->filetoupload['type'] == 'image/png')
            {
                $result = move_uploaded_file($this->filetoupload['tmp_name'], getcwd() . '/images/products/' . $this->filetoupload['name']);
            }
            else
            {
                $result = false;
            }
        }
        else
        {
            $result = false;
        }
        return $result;
    }
    
    public function getFileName() {
        return $this->filetoupload['name'];
    }
}