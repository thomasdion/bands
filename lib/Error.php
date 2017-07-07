<?php
Class Error {

        public $errorID;
	public $date;
	public $message;
	public $action;    
	
	function __construct($id, $dat, $mes, $act) {
		
		$this->errorID = $id;
		$this->date = $dat;
		$this->message = $mes;
		$this->action = $act;
	}
	
	function get_errorID() {
	
		return $this->errorID;
	}

	
	function write_log_error() {
		
		$filename =  "$_SERVER[DOCUMENT_ROOT]/files/errors.txt";
		if(is_writeable($filename)) {		
			$handle = fopen($filename,"a");
			$value =  "ID)$this->errorID DATE)$this->date MSG)$this->message ACT)$this->action".PHP_EOL;
			fwrite($handle, $value);
			fclose($handle);
		}
	}

}
?>