<?php
    $url = dirname(__FILE__);   //for not exposing administrator folder
    $array = explode('\\',$url);
    $count = count($array);
    define('ROOT_URL', 'http://localhost/boilerplate/'.$array[$count-1].'/'); //for URLs!
    define('ABS_PATH', $url.'/');  //For Includes Require!    
    /*Constants used for pagination*/    
    define('_ADJACENTS_', 3);    // How many adjacent pages should be shown on each side?       
    define('_LIMIT_', 5);	//how many items to show per page    

    function set_params(){        
        
        $page = basename($_SERVER['PHP_SELF']);    
        switch ($page) {
           case 'insertnew.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_insert_new.php",
                    "TITLE"=>"AOS Insert New");
                 return $params;    
           case 'index.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_admin_index.php",
                    "TITLE"=>"AOS Administrator Login");
                  return $params;  
            case 'controlpanel.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_controlpanel.php",
                    "TITLE"=>"AOS ControlPanel");
                  return $params;  
            case 'controlnews.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_controlnews.php",
                    "TITLE"=>"AOS News Administration");
            return $params;   
            case 'updatenew.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_update_new.php",
                    "TITLE"=>"AOS Update New");
            return $params;  
            case 'deletenew.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_delete_new.php",
                    "TITLE"=>"AOS Delete New");
            return $params;
            case 'controltours.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_controltours.php",
                    "TITLE"=>"AOS Tours Administration");
            return $params;  
            case 'inserttour.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_insert_tour.php",
                    "TITLE"=>"AOS Insert Tour");
            return $params; 
            case 'updatetour.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_update_tour.php",
                    "TITLE"=>"AOS Update Tour");
            return $params;  
            case 'deletetour.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_delete_tour.php",
                    "TITLE"=>"AOS Delete Tour");
            return $params;
            case 'controlusers.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_controlusers.php",
                    "TITLE"=>"AOS USERS Administration");
            return $params;
            case 'updateuser.php':
                 $params = array("HEADER"=>'admin_header.php',
                    "FOOTER"=>'admin_footer.php',
                    "TEMPLATE"=>'template_update_user.php',
                    "TITLE"=>'AOS Update USER');
            return $params;
            case 'controlcomments.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_controlcomments.php",
                    "TITLE"=>"AOS Comments Administration");
            return $params; 
            case 'controlcommentnews.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_controlcommentnews.php",
                    "TITLE"=>"AOS Comments Administration");
            return $params;    
            case 'updatecommentnew.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_update_commentnew.php",
                    "TITLE"=>"AOS Update News Comments");
            return $params;    
            case 'deletecommentnew.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_delete_commentnew.php",
                    "TITLE"=>"AOS Delete News Comments");
            return $params; 
            case 'insertcommentnew.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_insert_commentnew.php",
                    "TITLE"=>"AOS Make Comment");
            return $params; 
            case 'banned.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_banned.php",
                    "TITLE"=>"AOS Banned");
            return $params;  
            case 'controlbanned.php':
                 $params = array("HEADER"=>"admin_header.php",
                    "FOOTER"=>"admin_footer.php",
                    "TEMPLATE"=>"template_controlbanned.php",
                    "TITLE"=>"AOS Banned Control");
            return $params;             
           default:
               header("Location:../404.html");
               exit();
        }
    }
?>
