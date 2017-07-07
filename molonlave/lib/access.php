<?php    
    function controlerLoad($redirect) {
    //If template isnt loaded from controler redirect
        if(!isset($this)) {
            header("Location:../../404.html");
            exit();
        }
    }
?>

