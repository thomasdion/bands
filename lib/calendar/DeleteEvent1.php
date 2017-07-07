<?php
include("sqlconnect.php");
class DeleteEvent1 extends sqlconnect
{
	function DeleteFunction1()
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
$obj = new DeleteEvent1();
$obj->DeleteFunction1();
?>