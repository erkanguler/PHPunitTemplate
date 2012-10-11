<?php

class Car {

    private $model;
    
    
    function __construct() {
        
    }
    
    /**
     * @depends testSetModel
     * @assert () == 'Ford'
     */
    public function getModel(){
        return $this->model;
    }
    /**
     * 
     * @assert ('Ford') == 'Ford'
     */
    public function setModel($model){
        $this->model = $model;
    }

}
?>
