<?php
    
    function sanitize($row, $level){
        
        if($level==1) //sanitize output for admin 
           foreach ($row as $key=>$value)
              $row[$key] = htmlentities($value);
        else //sanitize output for user          
           foreach ($row as $key=>$value)
              $row[$key] = strip_tags($value);
    
        return $row;
    }
    
   function sanitize_upload_image(){
       
       switch($_FILES['image']['type'])
       {
            case 'image/gif': $ext = '.gif'; break;
            case 'image/jpeg': $ext = '.jpg'; break;
            case 'image/png': $ext = '.png'; break;
            case 'image/tiff': $ext = '.tif'; break;
            default: $ext = ''; break;
        }
       if ($ext){ 
            do {
                $img_name = random_name().time()."$ext";
                $file = "$_SERVER[DOCUMENT_ROOT]/boilerplate/img/news/$img_name";
            }while(file_exists($file));    
            if(move_uploaded_file($_FILES['image']['tmp_name'], $file))
                return $img_name;
        }
        return '';
   }
    function random_name(){
        
        $characters = "0123456789abcdefghijklmnopqrstuvwyz";
        $char_length = strlen($characters);
        $length = 3;
        $name = "img";
        
        for($i=1;$i<=$length;$i++){
            $name.= $characters[mt_rand(0,$char_length-1 )];
        }
        return $name;
    }
    
/** PBKDF2 Implementation (described in RFC 2898)
 *
 *  @param string p password
 *  @param string s salt
 *  @param int c iteration count (use 1000 or higher)
 *  @param int kl derived key length
 *  @param string a hash algorithm
 *
 *  @return string derived key
*/
function pbkdf2($a, $p, $s, $c, $kl) {
 
    $hl = strlen(hash($a, null, true)); # Hash length
    $kb = ceil($kl / $hl);              # Key blocks to compute
    $dk = '';                           # Derived key
 
    # Create key
    for ( $block = 1; $block <= $kb; $block ++ ) {
 
        # Initial hash for this block
        $ib = $b = hash_hmac($a, $s . pack('N', $block), $p, true);
 
        # Perform block iterations
        for ( $i = 1; $i < $c; $i ++ )
 
            # XOR each iterate
            $ib ^= ($b = hash_hmac($a, $b, $p, true));
 
        $dk .= $ib; # Append iterated block
    }
 
    # Return derived key of correct length
    return substr($dk, 0, $kl);
}    

?>
