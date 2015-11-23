<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace gmk\view;

/**
 * Description of DTemplateBoard
 *
 * @author user
 */
class DTemplateBoard {
    public static function sendBoardHeaders()
    {
        ?>
        
        <link rel="Stylesheet" type="text/css" href="public/css/board.css" />
<?php
    }
    public static function sendBoard()
    {
        ?>
        
        <div id="board">
            
            <div id="left-board" >
                
                
                
                <div id="player1-block" class="player-block">
                    <div class="left-player-block">
                        <div class="player-logo">
                            jakies logo
                        </div>
                    </div>
                    <div class="right-player-block">
                        <div class="player-score-block">
                            <div class="score-block-in">0</div>  
                        </div>
                        <div class="player-lives">
                            <div class="player-live">x</div>
                            <div class="player-live">x</div>
                                 
                        </div>
                        
                    </div>
                    <div class="player-info">
                        <span id="player2-name">{none}</span>
                    </div>
                </div>
                
                <div id="environment-block" class="card-holder" >
                    karty pogody
                </div>
                
                
                <div id="player2-block" class="player-block">
                    <div class="left-player-block">
                        <div class="player-logo">
                            jakies logo
                        </div>
                    </div>
                    <div class="right-player-block">
                        <div class="player-score-block">
                            <div class="score-block-in">0</div>  
                        </div>
                        <div class="player-lives">
                            <div class="player-live">x</div>
                            <div class="player-live">x</div>
                                 
                        </div>
                        
                    </div>
                    <div class="player-info">
                        <span id="player2-name">{none}</span>
                    </div>
                </div>     
                    

                
            </div>
            <div id="battlefield" >
                <div id="player1-battlefield" class="player-battlefield">
                    <div id="player1-field3-block" class="field3-block field-block">
                        <div id="player1-field3-left" class="field-left card-holder">
                            
                        </div>
                        <div id="player1-field3-in" class="field-in card-holder">
                            
                        </div>
                    </div>
                    <div id="player1-field2-block" class="field2-block field-block">                        
                        <div id="player1-field2-left" class="field-left card-holder">
                            
                        </div>
                        <div id="player1-field2-in" class="field-in card-holder">
                            
                        </div>
                    </div>
                    <div id="player1-field1-block" class="field1-block field-block">                        
                        <div id="player1-field1-left" class="field-left card-holder">
                            
                        </div>
                        <div id="player1-field1-in" class="field-in card-holder">
                            
                        </div>
                    </div>    
                </div>
                
                <div id="player2-battlefield" class="player-battlefield">
                    <div id="player1-field1-block" class="field1-block field-block">                        
                        <div id="player1-field1-left" class="field-left card-holder">
                            
                        </div>
                        <div id="player1-field1-in" class="field-in card-holder">
                            
                        </div>
                    </div>  
                    <div id="player1-field2-block" class="field2-block field-block">                        
                        <div id="player1-field2-left" class="field-left card-holder">
                            
                        </div>
                        <div id="player1-field2-in" class="field-in card-holder">
                            
                        </div>
                    </div>
                    <div id="player1-field3-block" class="field3-block field-block">
                        <div id="player1-field3-left" class="field-left card-holder">
                            
                        </div>
                        <div id="player1-field3-in" class="field-in card-holder">
                            
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <div id="right-board" >
                222 <br>
                222<br>
                <br>
                <br><br>
                <br>
                <br>
                <br>
            </div>
            
        
        </div>
        <?php
    }

}
