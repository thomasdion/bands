<?php
include("sqlconnect.php");
class DeleteEvent extends sqlconnect
{
	function DeleteFunction()
	{
		$this->connection();
		
		$id = $_GET['id'];
		
		$sql = "DELETE FROM eventcalender WHERE evt_id = '$id'";
		
		$query = $this->ExecuteDelete($sql);
		
		if($query)
			{
				header("Location:../index.php");
			}
	}
}
$obj = new DeleteEvent();
$obj->DeleteFunction();
?>