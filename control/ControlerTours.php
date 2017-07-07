<?php
include_once dirname(__FILE__).'/Controler.php';
include_once ABS_PATH.'/lib/Tours.php';

class ControlerTours extends Controler{

    public $tours;

    function __construct() {
        parent::__construct(); 
        $this->tours = new Tours();
    }
    function setTours($array){
        $this->tours->set_tour($array);
    }
    function select_tours(){
        $this->tours->set_con($this->connection);
        $this->tours->extract_tours();
    }
    function select_tour($id){
        $this->tours->set_con($this->connection);
        $this->tours->extract_tour($id);
    }
}

?>
