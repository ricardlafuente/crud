<?php
class Curl {
	
    private $url;
    private $token;
    
    function __construct($url, $token) {
        $this->url = $url;
        $this->token = $token;
    }
    
    function send($call, $method, $data_string = false){
        
            $ch = curl_init($this->url . $call);                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            if($method != "GET"){
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
            }
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "User-Agent: php-curl",
                "Authorization: token ".$this->token,
                "Content-Length: 0"
                )
            );  
            
            $result = curl_exec($ch);
            
            return json_decode($result);
    }
    
}
