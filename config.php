<?php
    define('ROOT_URL', 'http://localhost/boilerplate/'); //for URLs!
    define('ABS_PATH',  dirname(__FILE__).'/');  //For Includes Require!
    define('_ADJACENTS_', 3);    // How many adjacent pages should be shown on each side?       
    define('_LIMIT_', 5);	//how many items to show per page    

    function set_params(){
        
        $page = basename($_SERVER['PHP_SELF']);
        $params = array("HEADER"=>"header.php",
                    "FOOTER"=>"footer.php",
                    "TEMPLATE"=>"",
                    "TITLE"=>"Art Of Simplicity");
        if(isset($_GET['page'])&&$page=='index.php') {
           $page_param = trim($_GET['page']);
           switch ($page_param) {              
              case 'about':
                 $params["TEMPLATE"]="template_band.php";
                 $params["TITLE"]="Art Of Simplicity";
                 return $params; 
              case 'band':
                 $params["TEMPLATE"]="template_band.php";
                 $params["TITLE"]="Art of Simplicity News";                  
                  return $params;
              case 'kounelis':
                 $params["TEMPLATE"]="template_kounelis.php";
                 $params["TITLE"]="Art Of Simplicity:Chris Kounelis";
                 return $params;   
              case 'miras':
                 $params["TEMPLATE"]="template_miras.php";
                 $params["TITLE"]="Art Of Simplicity:Nikos Miras";
                 return $params;  
              case 'pagidas':
                 $params["TEMPLATE"]="template_pagidas.php";
                 $params["TITLE"]="Art Of Simplicity:George Pagidas";
                 return $params;                  
              case 'dakoutros':
                 $params["TEMPLATE"]="template_dakoutros.php";
                 $params["TITLE"]="Art Of Simplicity:Matthew Dakoutros";
                 return $params;   
              case 'koskinas':
                 $params["TEMPLATE"]="template_koskinas.php";
                 $params["TITLE"]="Art Of Simplicity:Dim Koskinas";
                 return $params;                  
              case 'disc':
                 $params["TEMPLATE"]="template_discography.php";
                 $params["TITLE"]="Discography";                    
                 return $params;  
              case 'asymetric':
                 $params["TEMPLATE"]="template_asymetric.php";
                 $params["TITLE"]="Asymetric";                    
                 return $params;   
              case 'caught':
                 $params["TEMPLATE"]="template_caught.php";
                 $params["TITLE"]="Caught in this less storm";                    
                 return $params;      
              case 'search':
                 $params["TEMPLATE"]="template_search.php";
                 $params["TITLE"]="Search Event";
                 return $params;                                    
              default:
                  header("Location:../404.html");
                  exit();                  
            }
        }else {    
            switch ($page) {   
               case 'index.php':
                     $params = array("HEADER"=>"header.php",
                        "FOOTER"=>"footer.php",
                        "TEMPLATE"=>"template_index.php",
                        "TITLE"=>"Art Of Simplicity");
                      return $params;  
                case 'news.php':
                     $params = array("HEADER"=>"header.php",
                        "FOOTER"=>"footer.php",
                        "TEMPLATE"=>"template_news.php",
                        "TITLE"=>"AOS News");
                      return $params;  
                case 'news2.php':
                     $params = array("HEADER"=>"header.php",
                        "FOOTER"=>"footer.php",
                        "TEMPLATE"=>"template_news2.php",
                        "TITLE"=>"AOS News");
                         return $params;   
                case 'tours.php':
                     $params = array("HEADER"=>"header.php",
                        "FOOTER"=>"footer.php",
                        "TEMPLATE"=>"template_tours.php",
                        "TITLE"=>"AOS Tours");
                        return $params;       
                case 'photos.php':
                     $params = array("HEADER"=>"header.php",
                        "FOOTER"=>"footer.php",
                        "TEMPLATE"=>"template_photos.php",
                        "TITLE"=>"Art Of Simplicity:photos");
                         return $params;        
                case 'contact.php':
                     $params = array("HEADER"=>"header.php",
                        "FOOTER"=>"footer.php",
                        "TEMPLATE"=>"template_contact.php",
                        "TITLE"=>"Contact Art of Simplicity");
                         return $params;                 
                case 'deletetour.php':
                     $params = array("HEADER"=>"admin_header.php",
                        "FOOTER"=>"admin_footer.php",
                        "TEMPLATE"=>"template_delete_tour.php",
                        "TITLE"=>"AOS Delete Tour");
                         return $params;  
                case 'searchResultPage.php':
                     $params = array("HEADER"=>"header.php",
                        "FOOTER"=>"footer.php",
                        "TEMPLATE"=>"template_searchResultPage.php",
                        "TITLE"=>"Events");
                    @define('_LIMIT_', 10);
                      return $params;   
                case 'saveEvent.php':
                     $params = array("HEADER"=>"header.php",
                        "FOOTER"=>"footer.php",
                        "TEMPLATE"=>"template_saveEvent.php",
                        "TITLE"=>"New Event");
                         return $params;                       
               default:
                   header("Location:../404.html");
                   exit();
            }
         }
    }
?>
