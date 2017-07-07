<?php

class PdoDbException extends PDOException{
    
        public function __construct(PDOException $e, $error) { 
        if(strstr($e->getMessage(), 'SQLSTATE[')) { 
            preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', $e->getMessage(), $matches); 
            $this->code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]); 
            $this->message = $matches[3]; 
            $this->errorInfo = $error;
        } 
    }
}

?>
