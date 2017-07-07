<?php                        
    if(!isset($this)) {                      //If template isnt loaded from controler redirect,
        header("Location:../../404.html");  //aditional protection that Prevents direct display of template.
        exit();
    }       // print_r($_SESSION)."<h1>OOOO</h1>";
?>
<div id ="wrapper">
      <div id="content">
          <section>
            <h1>YOUR ACCOUNT IS BANNED!</h1>
            <p>Pleace contact aos@mail for information.</p>
          </section>
      </div>
</div>
