function Robox(initHost, initPort, initTopic)
{
   var client = new MqttClient({
                   host : initHost,
                   port: initPort,
                   clientId: "roboxclient"});
                   
   var sendTopic = initTopic + "/to";
   var receiveTopic = initTopic + "/from";
   
   var servoLimits = {'servo1' : {'min' : 0, 'max': 180, 'reverse': false}, 
                      'servo2' : {'min' : 0, 'max': 180, 'reverse': false}};
   
   client.on('connecting', function() { console.log('connecting...'); });
   client.on('connect',    function() { console.log('connect...'); });
   client.on('disconnect', function() { console.log('disconnect...'); });
   client.on('offline',    function() { console.log('offline...'); });
   
   Robox.prototype.connect = function()
   {
      client.connect();
   }
   
   Robox.prototype.disconnect = function()
   {
      client.disconnect();
   }
   
   Robox.prototype.sendMessage = function(message)
   {
      if (client.connected)
      {
         client.publish(sendTopic, message);
         console.log(message);
      }
   }
   
   Robox.prototype.drive = function(speed, yaw)
   {
      if (client.connected)
      {
         var message = 
            "{\"messageId\":\"drive\", \"destination\":\"motorPair\", \"speed\":" + speed + ", \"yaw\":" + yaw + "}";
            
         this.sendMessage(message);
      }
   }
   
   Robox.prototype.rotate = function(speed)
   {
      if (client.connected)
      {
         var message = 
            "{\"messageId\":\"rotate\", \"destination\":\"motorPair\", \"speed\":" + speed + "}";
            
         this.sendMessage(message);
      }
   }
   
   Robox.prototype.servo = function(servoId, angle)
   {
      if (client.connected)
      {
         if (angle < servoLimits[servoId].min)
         {
            angle = servoLimits[servoId].min;
         }
         else if (angle > servoLimits[servoId].max)
         {
            angle = servoLimits[servoId].max;
         }
         
         if (servoLimits[servoId].reverse == true)
         {
            if (angle > 90)
            {
               angle = 90 - (angle - 90);
            }
            else if (angle < 90)
            {
               angle = (180 - angle);
            }
         }
         
         var message = 
            "{\"messageId\":\"servo\", \"destination\":\"" + servoId + "\", \"angle\":" + angle + "}";
            
         this.sendMessage(message);
      }
   }
}