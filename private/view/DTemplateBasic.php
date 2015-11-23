<?php

namespace gmk\view;

/**
 * 
 *
 * @author Artur
 */

class DTemplateBasic {
    
    public static function openHTML()
    {
        ?>
<!DOCTYPE html>
<html>
    <head>
<?php   
    }
    
    public static function closeHead()
    {?>
    </head>
    <body>
        
<?php
    }
    
    public static function closeHTML()
    {
        ?>
    </body>
</html>
<?php
    }
    
    public static function sendBasicHeaders($data)
    {
        ?>

        <meta charset="UTF-8">
        <?php if(!empty($data['title'])) { echo '        <title>'.$data['title'].'</title>'.PHP_EOL; }
        if(!empty($data['css']))
        {
            foreach($data['css'] as $name)
            {
                echo '        <link rel="Stylesheet" type="text/css" href="public/css/'.$name.'.css" />'.PHP_EOL;
            }
        }
        //TODO: wypisywanie skryptów w head:
        if(!empty($data['js']))
        {
            foreach($data['js'] as $name)
            {
                echo '        <!--'.$name.'.-->'.PHP_EOL;
            }
        }
        ?>

<?php
        
    }
    
    
    
    public static function sendMsgBox($title, $msg)
    {
        ?>
        <div style="width: 600px; margin: 10px;">
            <div style="font-size: large;font-weight:bold;"><?php echo $title ?></div>
            <div><?php echo $msg ?></div>
        </div>
        
        <?php
    }

    
    
}


