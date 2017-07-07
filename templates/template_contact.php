      <section>
          <form id ="contact" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
            <hgroup>
                <h1>Contact Art Of Simplicity</h1>
                <h2>Contact us via Email</h2>
            </hgroup>
            <div>
                <label>
                    <span>Message: <i>(required)</i></span>
                    <textarea name='text' placeholder="Include all the details you can" tabindex="5" required></textarea>
                </label>
            </div>
            <div>
                 <img id="captcha" src="<?php echo ROOT_URL.'securimage/securimage_show.php';?>" alt="CAPTCHA Image" />
                <label>
                    <p>* Enter the text above</p>
                    <input type="text" name="captcha_code" size="10" maxlength="6">
                    <a href="#" onclick="document.getElementById('captcha').src = '<?php echo ROOT_URL.'securimage/securimage_show.php?';?>' + Math.random(); return false">[ Different Image ]</a></label>                
                 <input type="hidden" name="send" value="send">
                 <input type="submit" name="submit" value="Send"> 
                <p><?php echo $data; ?></p>
            </div>    
         </form>    
      </section>

      

