<?php

   function selectPage()
   {
      $html =
<<<HEREDOC
      <div class="flex-horizontal">
         <button class="flex-horizontal select-button player-one-button" onclick="window.location='index.php?player=robo1'">Player One</button>
         <button class="flex-horizontal select-button player-two-button" onclick="window.location='index.php?player=robo2'">Player Two</button>
      </div>
HEREDOC;

      
      return ($html);
   }
   
   function playPage($player)
   {
      $html =
<<<HEREDOC
         <!--  Controller -->
         <div class="flex-horizontal controller-div">
            <!--  D-Pad -->
            <div class="flex-vertical dpad-div">
         	   <div class="flex-horizontal">
         	      <div class="flex-horizontal dpad-button-spacer"></div>
         	      <button id="up-button" class="flex-horizontal dpad-button" onmousedown="input.onPress(this)" onmouseup="input.onRelease(this)"><i class="material-icons button-icon button-icon">keyboard_arrow_up</i></button>
         	      <div class="flex-horizontal dpad-button-spacer"></div>
         	   </div>
         	   <div class="flex-horizontal">
         	      <button id="left-button" class="flex-horizontal dpad-button" onmousedown="input.onPress(this)" onmouseup="input.onRelease(this)"><i class="material-icons button-icon button-icon">keyboard_arrow_left</i></button>
         		   <div class="flex-horizontal dpad-button-spacer"></div>
         		   <button id="right-button" class="flex-horizontal dpad-button" onmousedown="input.onPress(this)" onmouseup="input.onRelease(this)"><i class="material-icons button-icon button-icon">keyboard_arrow_right</i></button>
         	   </div>
         	   <div class="flex-horizontal">
         	      <div class="flex-horizontal dpad-button-spacer"></div>
         	      <button id="down-button" class="flex-horizontal dpad-button" onmousedown="input.onPress(this)" onmouseup="input.onRelease(this)"><i class="material-icons button-iconv button-icon">keyboard_arrow_down</i></button>
         	      <div class="flex-horizontal dpad-button-spacer"></div>
         	   </div>
            </div>
            <!-- Button 1 -->
            <div class="flex-horizontal button-div">
               <button id="slap-button" class="flex-horizontal attack-button" onmousedown="input.onPress(this)" onmouseup="input.onRelease(this)">Slap</button>
            </div>
               <!-- Button 2 -->
            <div class="flex-horizontal button-div">
               <button id="slash-button" class="flex-horizontal attack-button" onmousedown="input.onPress(this)" onmouseup="input.onRelease(this)">Slash</button>
            </div>
         </div>

         <!-- Back -->
         <div class="flex-horizontal">
            <button class="flex-horizontal select-button back-button" onclick="window.location='index.php'">Back</button>
         </div>
HEREDOC;
      
      return ($html);
   }
   
   // ****************** Begin ***********************

   $player = null;
   $content = null;

   if (isset($_GET["player"]))
   {
      $player = $_GET["player"];

      $content = playPage($player); 
   }
   else
   {
      $content = selectPage();
   }
?>

<html>

<!--  https://github.com/orbitbot/web-mqtt-client -->

<head>
   <link rel="stylesheet" type="text/css" href="flex.css"/>
   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>

   <script src="mqtt-client.js"></script>
   <script src="mqttws31.js"></script>
   <script src="input.js"></script>
   <script src="robox.js"></script>
   
   <?php 
   if ($player)
   {
      echo
<<<HEREDOC
      <script>
         var robox = new Robox("broker.hivemq.com", 8000, "robox/jasontost@gmail.com/$player");
         robox.connect();

         robox.servo("servo1", 180);
         robox.servo("servo2", 180);
         
         var input = new Input(robox);
      </script>
HEREDOC;
   }
   ?>
   
	<style>
	
	   .content-div
	   {
	      height:100%;
	   }
	
	   .select-button {
         border-width: 0;
         outline: none;
         box-shadow: 0 1px 4px rgba(0, 0, 0, .6);
         background-color: #ebebeb;
         
         cursor: pointer;
         
         color: #ffffff;
         font-family:"lucida grande",tahoma,verdana,arial,sans-serif;
         font-size: 25px;
         
         height: auto;
         width: 150px;
      
         padding: 20px 20px;
         
         margin-right: 20px;
         margin-left: 20px;
      }
      
      .player-one-button {
         background-color: #FF4633;
      }
      
      .player-two-button {
         background-color: #3361FF;
      }
      
      .player-three-button {
         background-color: #DA33FF;
      }
      
      .back-button {
         color: #000000;
         background-color: #ebebeb;
         width: 100px;
         font-size: 15px;
      }

	   .controller-div {
	      border-style: solid;
	      border-weight: 1px;
	      padding: 20px;
	      margin-bottom: 50px;
	   }
		
		.dpad-button-spacer {
		   width: 100px;
		   height: 100px;
		}
		
		.dpad-button {
		   width: 100px;
		   height: 100px;
		   
		   border-width: 0;
         outline: none;
         border-radius: 25px;
         box-shadow: 0 1px 4px rgba(0, 0, 0, .6);
         background-color: #3B5998;
         color: #ecf0f1;
         font-family:"lucida grande",tahoma,verdana,arial,sans-serif;
		}
		
		.dpad-button:active {
         background-color: #3e8e41;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
      }
		
		.button-icon {
		   font-size: 4vw;
		}
		
		.dpad-div {
		   flex-grow: 1;
		}
		
		.button-div {
		   flex-grow: 1;
		}
		
		.attack-button {
		   width: 50%;
		   
		   font-family:"lucida grande",tahoma,verdana,arial,sans-serif;
		   color: #ecf0f1;

		   border-radius: 50%;
	      border-width: 0;
		   outline: none;
		   box-shadow: 0 1px 4px rgba(0, 0, 0, .6);
		   background-color: #3B5998;
		   
		   font-size: 3vw;
		}
		
		.attack-button:active {
         background-color: #3e8e41;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
      }
		
		.attack-button:after {
		  content: "";
		  display: block;
		  padding-bottom: 100%;
	   }
}
	</style>
</head>

<body>
   <?php echo $content;?>
</body>

</html>