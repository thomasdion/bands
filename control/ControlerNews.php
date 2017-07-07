<?php
include_once dirname(__FILE__).'/Controler.php';
include_once ABS_PATH.'/lib/News.php';

class ControlerNews extends Controler{

    public $news;

    function __construct() {
        parent::__construct(); 
        $this->news = new News(); 
    }
    function setNews($array){
        $this->news->set_nea($array);
    }
    function select_news(){
        $this->news->set_con($this->connection);
        $this->news->extract_news();
    }
    function select_new($id){
        $this->news->set_con($this->connection);
        $this->news->extract_new($id);
    }
}

?>
