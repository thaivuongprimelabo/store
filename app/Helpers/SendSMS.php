<?php

namespace App\Helpers;

class SendSMS {
    
    private $to = '';
    private $from = '+18562813488';
    private $message = '';
    private $api_key = 'AC7da1d307957e0ef7c227ce2ebd48f174';
    private $api_token = '3a76d394548ea8225f454e815c3a15ac';
    private $url = '';
    private $method = 'post';
    private $country_code = '+84';
    
    public function __construct($api_key = '', $api_token = '') {
        if(!Utils::blank($api_key) && !Utils::blank($api_token)) {
            $this->api_key = $api_key;
            $this->api_token = $api_token;
        }
        $this->url = 'https://api.twilio.com/2010-04-01/Accounts/' . $this->api_key . '/Messages.json';
    }
    
    public function setTo($to) {
        $this->to = $this->formatTwilioPhoneNumber($to);
    }
    
    public function setFrom($from) {
        $this->from = $this->formatTwilioPhoneNumber($from);
    }
    
    public function setMessage($message) {
        $this->message = $message;
    }
    
    public function send() {
        
        $authen = ['username' => $this->api_key, 'password' => $this->api_token];
        
        $params = [
            'To' => $this->to,
            'From' => $this->from,
            'Body' => $this->message
        ];
        
        $json = $this->curl($this->method, $this->url, $params, $authen);
        $result = json_decode($json);
        if(isset($result->code)) {
            \Log::Error($json);
            return false;
        }
        return true;
    }
    
    private function curl($method = 'post', $url = "", $params = [], $authen = [], $header = 'default') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        
        // use a proxy
        if (env('CURLOPT_HTTPPROXYTUNNEL')) {
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, env('CURLOPT_HTTPPROXYTUNNEL'));
            curl_setopt($ch, CURLOPT_PROXY, env('CURLOPT_PROXY'));
            curl_setopt($ch, CURLOPT_PROXYPORT, env('CURLOPT_PROXYPORT'));
        }
        
        
        // neu ko dung POST, mac dinh method cua curl la GET
        if ($method == 'post') {
            if ($header == 'default') {
                // ko dung header, mac dinh header la application/x-www-form-urlencoded
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            } elseif ($header == 'json') {
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            }
        }
        
        if (!empty($authen)) {
            curl_setopt($ch, CURLOPT_USERPWD, $authen['username'] . ":" . $authen['password']);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        }
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $result = curl_exec($ch);
        if (curl_errno($ch) !== 0) {
            \Log::Info('cURL error when connecting to ' . $url . ': ' . curl_error($ch));
        }
        
        curl_close($ch);
        return $result;
    }
    
    private function formatTwilioPhoneNumber($phoneNumber) {
        // remove hyphen
        $formatted = str_replace('-', '', $phoneNumber);
        if (substr($formatted, 0, 1) == '0') {
            $formatted = $this->country_code . substr($formatted, 1, strlen($formatted));
        }
        return $formatted;
    }
}
?>