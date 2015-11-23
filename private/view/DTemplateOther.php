<?php


namespace gmk\view;

/**
 * 
 *
 * @author Artur Czapla
 */
class DTemplateOther {
    public static function sendForm()
    {
        ?>
        <div class="block">
            <div class="block-title">
                Podaj login:
            </div>
            <div class="block-contents">
                <form action="<?php echo View::genRelativeLink("form"); ?>" method="post">
                    <fieldset>
                        <table>
                            <tr>
                                <td><label>Login:</label></td><td><input type="text" name="login" /></td>
                            </tr>
                            <tr style="display:none;">
                                <td><label>Hasło:</label></td><td><input type="password" name="password" /></td>
                            </tr>


                        </table>
                        <div class="login-bottom">
                            <div class="left" style="display:none;"><a href="index.php">Strona główna</a> </div>

                            <div class="right"><input type="submit" name="wyslij" value="ok" /> </div>
                        </div>
                    </fieldset>

                    </form>
            </div>
        </div>
<?php
    }
    
    public static function sendErrorSite($level, $errno, $title, $description)
    {
        ?>
        <div class="block error-block">
            <div class="block-title">
                <h2><?php echo $title; ?></h2>
            </div>
            <div class="block-contents">
                <span class="error-level"><?php echo $level;?></span>
                <span class="errno"><?php echo $errno ?></span>
                <span class="error-description"><?php echo $description ?></span>
            </div>
        </div>
<?php
    }
}
