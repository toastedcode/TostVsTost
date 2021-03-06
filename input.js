function Input(initRobox)
{
   var robox = initRobox;
   
   Input.prototype.onPress = function(element)
   {
      switch (element.id)
      {
         case "up-button":
         {
            robox.drive(-100, 0);
            break;
         }
         
         case "down-button":
         {
            robox.drive(100, 0);
            break;
         }
         
         case "left-button":
         {
            robox.rotate(100, 0);
            break;
         }
         
         case "right-button":
         {
            robox.rotate(-100, 0);
            break;
         }
         
         case "slash-button":
         {
        	 robox.servo("servo2", 90);
        	 break;
         }
         
         case "slap-button":
         {
        	 robox.servo("servo1", 90);
        	 break;
         }
         
         default:
         {
        	 break;
         }
      }
   }
   
   Input.prototype.onRelease = function(element)
   {
      switch (element.id)
      {
         case "up-button":
         {
            robox.drive(0, 0);
            break;
         }
         
         case "down-button":
         {
            robox.drive(0, 0);
            break;
         }
         
         case "left-button":
         {
            robox.rotate(0);
            break;
         }
         
         case "right-button":
         {
            robox.rotate(0);
            break;
         }
         
         case "slash-button":
         {
        	 robox.servo("servo1", 0);
        	 break;
         }
         
         case "slap-button":
         {
        	 robox.servo("servo2", 0);
        	 break;
         }
         
         default:
         {
        	 break;
         }
      }
   }
}