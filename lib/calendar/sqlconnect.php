<?php
/**
*This class is common for the date calender project 
*In this sqlconnect class contains the operations of the database
*/
class sqlconnect
{
            var $con;
            var $db;
             function connection()
                    {
                            $server='localhost';
                            $username='AjsQUare12';
                            $password='Nm53df35CVwe';
                            $database='AjsQUare12';
                            $this->con=mysql_connect($server,$username,$password);
                            $this->db=mysql_select_db($database,$this->con);
                    }

             function ExecuteQuery($sql)
                    {
                                    $result=mysql_query($sql);
                                    //while($row[]=mysql_fetch_assoc($result));
                                    return $result;
                    }
             function ExecuteDelete($sql)
                    {
                                    if(mysql_query($sql,$this->con))
                                    return $this->recordsaffected=mysql_affected_rows($this->con);
                    }
             function ExecuteInsert($sql)
                    {
                                    if(mysql_query($sql,$this->con))
                                            {
                                                    $this->newid=mysql_insert_id($this->con);
                                                    return $this->recordsaffected=mysql_affected_rows($this->con);
                                            }
                    }

             function ExecuteUpdate($sql)
                    {
                                    if(mysql_query($sql,$this->con))
                                    return $this->recordsaffected=mysql_affected_rows($this->con);
                    }
}		 
?>
