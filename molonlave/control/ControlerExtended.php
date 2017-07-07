<?php
include_once dirname(__FILE__).'/Controler.php';
include_once ABS_PATH.'/lib/News.php';
include_once ABS_PATH.'lib/Pagination.php';

class ControlerExtended extends Controler{

    protected $data;
    public $pagination=NULL;
    public $insert=FALSE;
    public $update=FALSE;
    public $delete=FALSE;    
    
    function __construct($type) {
        
        parent::__construct(); 
        $this->data = NULL;
        if(!file_exists(ABS_PATH.'lib/'.$type.'.php')) {
            throw new Exception('CLASS DOESNT EXIST:'.$type);
        } else {
            require_once(ABS_PATH.'lib/'.$type.'.php');                
            switch ($type) {
                case 'News':
                    $this->data = new News();
                    break;
                case 'Tours':
                    $this->data = new Tours();
                    break;                    
                case 'Users':
                    $this->data = new Users(); 
                    break;                    
                case 'CommentsNews':   
                    $this->data = new CommentsNews();         
                    break;      
                case 'Banned':   
                    $this->data = new Banned();         
                    break;                
            }
        }
    }  
    
    function checkUpdate(){
        return $this->update;
    }  
    function checkDelete(){
        return $this->delete;
    } 
    function checkInsert(){
        return $this->insert;
    }
    function loadPage($data) {
        parent::loadPage($data);
    }
    function getData(){
        return  $this->data->get_data();
    }    
    function getPagination(){
        return $this->pagination['pagination'];
    }
    function setData($array){
        $this->data->set_data($array);
    }
    function insert(){
        $this->data->set_con($this->connection);        
        $this->insert = $this->data->insert();;
    }
    function select_data($page, $pageName){
        $this->data->set_con($this->connection);
        $total_data = $this->data->countData();
        $this->pagination = pagination($total_data, $page, $pageName);
        $this->data->extract_data($this->pagination['start'],(int)_LIMIT_);
    }
    function select_dataArgs($page, $args, $pageName){
        $this->data->set_con($this->connection);
        $total_data = $this->data->countDataType($args);
        $this->pagination = paginationArgs($total_data, $page, $args, $pageName);            
        $this->data->extract_dataType($this->pagination['start'],(int)_LIMIT_,$args);                    
    }    
    function select($id){
        $this->data->set_con($this->connection);
        $this->data->extract($id);
    }
    function update(){
        $this->data->set_con($this->connection);
        $this->update = $this->data->update();
    }
    function delete($id){
        $this->data->set_con($this->connection);
        $this->delete = $this->data->delete($id);
    }
}

?>
