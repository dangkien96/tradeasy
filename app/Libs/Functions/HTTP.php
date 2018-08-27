<?php

namespace App\Libs\Functions;


class HTTP {
	
	const API_URL = 'http://profi.bkav.ooo/api/';
	const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_PUT = 'PUT';
    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_DELETE = 'DELETE';

    public function __construct() {
    	}

    private function _getheaderToSend(){
        $retData = [];
        foreach($this->header as $key => $val)
        {
            $retData[] = "$key: $val";
        }
        
        return $retData;
    }

	public function _send($method, $url, $header = [], $params = []) {
        //khoi tao curl
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        
        // neu la post and put se them data
        if(in_array(strtolower($method), [strtolower(self::HTTP_METHOD_POST), strtolower(self::HTTP_METHOD_PUT)]))
        {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params); // $params = array
        }
        // neu co auth
        // if(!empty($this->user) && !empty($this->password))
        // {
        //     curl_setopt($ch, CURLOPT_USERPWD, $this->user.':'.$this->password); 
        // }
        //them header
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); // $header = "key: value"
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($ch);
        return $result;
        $info = curl_getinfo($ch);
        curl_close($ch);
    }

    // public function
}



    
