<?php
 
include "websocket.class.php";
 
class Chat extends WebSocket{
        function process($user,$msg){
                $this->say("< ".$msg);
                $msg = htmlspecialchars($msg);
                foreach($this->users as $buf){
                        $this->send($buf->socket,$user->id."&gt; ".$msg);
                }
        }
};
 
$master = new Chat("<server ip here>",12345);

?>
