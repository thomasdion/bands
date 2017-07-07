<?php //If tamplate isnt loaded from controler redirect
    if(!isset($this)) {
        header("Location:../../404.html");
        exit();
    }
?>
<div id ='wrapper'>
<div id='content'>    
<section>                                        
<form id='update_id' method='POST' action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
   <hgroup>
      <h1>Administrator</h1>
      <h2>Update User</h2>
   </hgroup>
    <fieldset>
        <legend>Update data</legend>
        <div><label for='name_id'>Name:</label>
             <input id='name_id' name='name' type='text' value='<?php echo $data['name'];?>' required aria-required='true'> 
             <?php if(isset($_POST['update']))if(trim($_POST['name'])=='') echo '*Name Required';?>             
        </div> 
        <div><label for='surname_id'>Surname:</label>
             <input id='surname_id' name='surname' type='text' value='<?php echo $data['surname'];?>' required aria-required='true'> 
             <?php if(isset($_POST['update']))if(trim($_POST['surname'])=='') echo '*Surname Required';?>             
        </div>                             
        <div><label for='email_id'>Email:</label>
             <input id='email_id' name='email' type='text' value='<?php echo $data['email'];?>' required aria-required='true'> 
             <?php if(isset($_POST['update']))if(trim($_POST['email'])=='') echo '*Email Required';?>             
        </div> 
        <div><label for='newsletter_id'>Newsletter:</label>  
          <?php
           $yes='';
           $no='';
           $nl = $data['newsletter']; 
           if($nl==1) 
              $yes='selected';
           else
               $no='selected'?>            
          <select id='newsletter_id' name='newsletter'>
              <option value='1' <?php echo $yes ?>>YES</option>
              <option value='0' <?php echo $no ?>>NO</option>
          </select>             
        </div>         
        <div><label for='role_id'>Type:</label>
          <?php
           $roles =  array('sadmin'=>'','admin'=>'','bloger'=>'','user'=>'','spammer'=>'');
           $role = (int)$data['role_id'];
           switch ($role) {
              case 1:
                  $roles['sadmin']='selected';
                  break;               
              case 2:
                  $roles['admin']='selected';
                  break;
              case 3:
                  $roles['bloger']='selected';
                  break;        
              case 4:
                  $roles['user']='selected';
                  break;      
              case 5:
                  $roles['spammer']='selected';
                  break;          
           }
           if($roles['sadmin']=='selected') {
               echo "SUPER ADMINISTRATOR";
              // echo "<input type='hidden' name='role_id' value='1'>"; IN CASE THAT THE SADMIN CAN BE UPDATED
           }else { ?>
          <select id='role_id' name='role_id'>
              <option value='2' <?php echo $roles['admin'] ?>>Administrator</option>
              <option value='3' <?php echo $roles['bloger'] ?>>Bloger</option>
              <option value='4' <?php echo $roles['user'] ?>>User</option>
              <option value='5' <?php echo $roles['spammer'] ?>>Spammer</option>            
          </select>
        <?php }?>
        </div>         
        <div>
            <h2><?php if($this->checkUpdate()) echo 'User Succesfully Updated'; ?></h2>
        </div>
    </fieldset>
    <?php if($role!=1) { ?>
    <input type='hidden' name='update'>
    <input type ="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">        
    <input type='submit' name='update' value='Update User'>
    <?php }?>
</form>        
</section>
  <p><a href='controlusers.php'><img src='../img/64x64/back.png' /><p>BACK</p></a></p>
</div>
</div>