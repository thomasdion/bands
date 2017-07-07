    <section>
        <?php 
              $data = sanitize($data,2); //sanitize all data
              $temp = $data[0];
              $temp = explode('/', $temp);
              $folder = $temp[count($temp)-2]; //the folder in which the photos r ?>
        <header class="<?php echo $folder.'PhotosTab'?>">
            <h1><a href="<?php echo ROOT_URL.'photos.php'?>">Asymmetric</a>  <a href="<?php echo ROOT_URL.'photos.php?album=caught'?>">Caught</a>   <a href="<?php echo ROOT_URL.'photos.php?album=intermission'?>">Intermission</a></h1>            
        </header>  
        <ul id="gallery">               
  <?php foreach($data as $img) {
             $img = explode('/', $img);
             $imgName = $img[count($img)-1]; ?> 
             <li class='pholder'>
                 <a href=""><img src='<?php echo ROOT_URL."img/$folder/$imgName";?>'><div><?php echo preg_replace('/(.jpg|.gif|.png)/','',$imgName); ?></div></a>
             </li>
   <?php } ?>   
        </ul>                   
    </section>    
