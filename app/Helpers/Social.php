<?php

namespace App\Helpers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Constants\Status;
use App\Constants\UserRole;

class Social {
    
    // Facebook key
    private $fb_api_key = '135671569954053';
    private $fb_api_token = '4aa19ff93c2302d7b57435725c893c73';
    private $fb_callback_url = '';
    private $fb_url = 'https://www.facebook.com/dialog/oauth?client_id={0}&redirect_uri={1}&scope=email&user_likes&display=popup';
    
    // Google key
    private $gg_api_key = '941526340822-32psd1s8fm57jilrjbt1od46brdu2klj.apps.googleusercontent.com';
    private $gg_api_token = 'Hf6yAFzvyi8JM0X5o2TZ2R0Y';
    private $gg_callback_url = '';
    private $gg_url = 'https://accounts.google.com/o/oauth2/auth?scope=https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile&state=/profile&redirect_uri={0}&response_type=code&client_id={1}&access_type=offline&approval_prompt=force';
    
    // Twitter key
    private $tw_api_key = 'skIE1ivDGOyYSlF9Csyhh5aHh';
    private $tw_api_token = '1OCZNMuZkR1U2dHKZPkvfYe2vYw7OeUL3y0doXvA70PePj4ElZ';
    private $tw_callback_url = '';
    private $tw_url = '';
    
    public static $instance;
    
    /**
     * @return string
     */
    public function getFb_api_key()
    {
        return $this->fb_api_key;
    }

    /**
     * @return string
     */
    public function getFb_api_token()
    {
        return $this->fb_api_token;
    }

    /**
     * @param string $fb_api_key
     */
    public function setFb_api_key($fb_api_key)
    {
        $this->fb_api_key = $fb_api_key;
    }

    /**
     * @param string $fb_api_token
     */
    public function setFb_api_token($fb_api_token)
    {
        $this->fb_api_token = $fb_api_token;
    }
    
    /**
     * @return string
     */
    public function getFb_callback_url()
    {
        return route('social_facebook');
    }

    /**
     * @return string
     */
    public function getFb_url()
    {
        $this->fb_url = str_replace('{0}', $this->getFb_api_key(), $this->fb_url);
        $this->fb_url = str_replace('{1}', $this->getFb_callback_url(), $this->fb_url);
        return $this->fb_url;
    }

    /**
     * @param string $fb_callback_url
     */
    public function setFb_callback_url($fb_callback_url)
    {
        $this->fb_callback_url = $fb_callback_url;
    }

    /**
     * @param string $fb_url
     */
    public function setFb_url($fb_url)
    {
        $this->fb_url = $fb_url;
    }
    
    /**
     * @return string
     */
    public function getGg_api_key()
    {
        return $this->gg_api_key;
    }

    /**
     * @return string
     */
    public function getGg_api_token()
    {
        return $this->gg_api_token;
    }

    /**
     * @return string
     */
    public function getGg_callback_url()
    {
        return route('social_google');
    }

    /**
     * @param string $gg_api_key
     */
    public function setGg_api_key($gg_api_key)
    {
        $this->gg_api_key = $gg_api_key;
    }

    /**
     * @param string $gg_api_token
     */
    public function setGg_api_token($gg_api_token)
    {
        $this->gg_api_token = $gg_api_token;
    }

    /**
     * @param string $gg_callback_url
     */
    public function setGg_callback_url($gg_callback_url)
    {
        $this->gg_callback_url = $gg_callback_url;
    }
    
    /**
     * @return string
     */
    public function getGg_url()
    {
        $this->gg_url = str_replace('{0}', $this->getGg_callback_url(), $this->gg_url);
        $this->gg_url = str_replace('{1}', $this->getGg_api_key(), $this->gg_url);
        return $this->gg_url;
    }

    /**
     * @param string $gg_url
     */
    public function setGg_url($gg_url)
    {
        $this->gg_url = $gg_url;
    }
    
    /**
     * @return string
     */
    public function getTw_api_key()
    {
        return $this->tw_api_key;
    }

    /**
     * @return string
     */
    public function getTw_api_token()
    {
        return $this->tw_api_token;
    }

    /**
     * @return string
     */
    public function getTw_callback_url()
    {
        return route('social_twitter');
    }

    /**
     * @return string
     */
    public function getTw_url()
    {
        return $this->tw_url;
    }

    /**
     * @param string $tw_api_key
     */
    public function setTw_api_key($tw_api_key)
    {
        $this->tw_api_key = $tw_api_key;
    }

    /**
     * @param string $tw_api_token
     */
    public function setTw_api_token($tw_api_token)
    {
        $this->tw_api_token = $tw_api_token;
    }

    /**
     * @param string $tw_callback_url
     */
    public function setTw_callback_url($tw_callback_url)
    {
        $this->tw_callback_url = $tw_callback_url;
    }

    /**
     * @param string $tw_url
     */
    public function setTw_url($tw_url)
    {
        $this->tw_url = $tw_url;
    }

    public function __construct() {
        self::$instance = self::$instance;
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function view() {
        return view('shop.social.index');
    }
    
    public function facebook() {
        
        if(isset($_GET['code'])){
            $url = "https://graph.facebook.com/oauth/access_token?client_id=" . $this->getFb_api_key() . "&redirect_uri=" . $this->getFb_callback_url() . "&client_secret=" . $this->getFb_api_token() . "&code=" .$_GET['code'];
            $json = Utils::curl('get', $url);
            $obj1 = json_decode($json);
            
            $url2 = "https://graph.facebook.com/me?fields=id,name,email&access_token=".$obj1->access_token;
            $json2 = Utils::curl('get', $url2);
            $user_data = json_decode($json2);
            if($user_data) {
                $this->checkUser($user_data);
                echo "<script>window.opener.location = '". route('social_facebook', ['email' => $user_data->email]) ."';window.close();</script>";
                exit();
            } else {
                echo "<script>window.opener.location = '". route('home') ."';window.close();</script>";
            }
        }
        
        $url = $this->getFb_url();
        echo '<script>top.location="' . $url . '";</script>';
        exit();
    }
    
    public function google() {
        
        if(isset($_GET["code"])) {
            $url="https://accounts.google.com/o/oauth2/token";
            $data = array(
                "code"          =>  $_GET["code"],
                "client_id"     =>  $this->getGg_api_key(),
                "client_secret" =>  $this->getGg_api_token(),
                "redirect_uri"  =>  $this->getGg_callback_url(),
                "grant_type"    =>  "authorization_code"
            );
            $options=array(
                "http"  =>  array(
                    "header"    =>  "Content-type: application/x-www-form-urlencoded\r\n",
                    "method"    =>  "POST",
                    "content"   => http_build_query($data)
                ),
            );
            $context=  stream_context_create($options);
            //$result = file_get_contents($url, false, $context);
            $result = Utils::curl('post', $url, $data);
            $obj=  json_decode($result);
            
            $url="https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=".$obj->access_token;
            
            //$data=  file_get_contents($url);
            $data = Utils::curl('get', $url);
            $user_data =  json_decode($data);
            if($user_data) {
                $this->checkUser($user_data);
                echo "<script>window.opener.location = '". route('social_google', ['email' => $user_data->email]) ."';window.close();</script>";
                exit();
            } else {
                echo "<script>window.opener.location = '". route('home') ."';window.close();</script>";
            }
        }
        
        $url = $this->getGg_url();
        echo '<script>top.location="' . $url . '";</script>';
        exit();
    }
    
    public function twitter() {
        $output = array();
        $response = '';
        $parameters = [
            'oauth_nonce' => md5(uniqid()),
            'oauth_callback' => $this->getTw_callback_url(),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_consumer_key' => $this->getTw_api_key(), // consumer key from your twitter app: https://apps.twitter.com
            'oauth_version' => '1.0',
        ];
        
        if(isset($_GET['oauth_token'])) {
            $accessUrl = 'https://api.twitter.com/oauth/access_token';
            $parameters['oauth_verifier'] = $_GET['oauth_verifier'];
            $parameters['oauth_token']    = $_GET['oauth_token'];
            $parameters['oauth_signature']  =  $this->build_signature('GET', $accessUrl, $parameters, $this->getTw_api_token());
            
            $params = $this->build_http_query($parameters);
            $accessUrl = $this->to_url($accessUrl, $params);
            $response = file_get_contents($accessUrl);
            $access_token = $this->parse_parameters($response);
            
            $host = 'https://api.twitter.com/1.1/account/verify_credentials.json';
            $hostParams = array(
                "oauth_consumer_key"    =>  $this->getTw_api_key(),
                "oauth_nonce"			=>	$this->generate_nonce(),
                "oauth_signature_method"=>  "HMAC-SHA1",
                "oauth_timestamp"		=>	time(),
                "oauth_token"			=>	$access_token['oauth_token'],
                "oauth_version"			=>	"1.0",
                "oauth_token_secret"	=>	$access_token['oauth_token_secret'],
                "include_email"		    =>	'true',
            );
            
            $hostParams['oauth_signature'] = $this->build_signature('GET', $host, $hostParams, $this->getTw_api_token());
            $params = $this->build_http_query($hostParams);
            $host = $this->to_url($host, $params);
            $obj = file_get_contents($host);
            $user_data = json_decode($obj);
            if($user_data) {
                $this->checkUser($user_data);
                echo "<script>window.opener.location = '". route('social_twitter', ['email' => $user_data->email]) ."';window.close();</script>";
                exit();
            } else {
                echo "<script>window.opener.location = '". route('home') ."';window.close();</script>";
            }
        }
        
        $tokenUrl = 'https://api.twitter.com/oauth/request_token';
        $baseString = $this->buildBaseString($tokenUrl, $parameters);
        $compositeKey   = $this->getCompositeKey($this->getTw_api_token(), null);
        $parameters['oauth_signature']  =  base64_encode(hash_hmac('sha1', $baseString, $compositeKey, true));
        $response = Utils::curl('post', $tokenUrl, $parameters);
        
        $output = $this->parse_parameters($response);
        $url = '';
        if(isset($output['oauth_token'])) {
            $url = 'https://api.twitter.com/oauth/authorize?oauth_token='.$output['oauth_token'];
        } else {
            $url = 'https://api.twitter.com/oauth/authenticate?oauth_token='.$output['oauth_token'];
        }
        echo '<script>top.location="' . $url . '";</script>';
        exit();
    }
    
    private function checkUser($user_data) {
        $defaultPassword = '123456789';
        $user = User::where('email', $user_data->email)->first();
        if(!$user) {
            $user = new User();
            $user->name = $user_data->name;
            $user->email = $user_data->email;
            $user->password = bcrypt($defaultPassword);
            $user->role_id = UserRole::MEMBERS;
            $user->status = Status::ACTIVE;
            $user->created_at = Carbon::now();
            $user->updated_at = Carbon::now();
            $user->last_login = Carbon::now();
            $user->save();
        }
    }
    
    function buildBaseString($baseURI, $oauthParams){
        $baseStringParts = [];
        ksort($oauthParams);
        foreach($oauthParams as $key => $value){
            $baseStringParts[] = "$key=" . rawurlencode($value);
        }
        return 'POST&' . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $baseStringParts));
    }
    
    function getCompositeKey($consumerSecret, $requestToken){
        return rawurlencode($consumerSecret) . '&' . rawurlencode($requestToken);
    }
    
    private function parse_parameters($input) {
        
        if (!isset($input) || !$input) return array();
        
        $pairs = explode('&', $input);
        
        $parsed_parameters = array();
        foreach ($pairs as $pair) {
            $split = explode('=', $pair, 2);
            $parameter = $this->urldecode_rfc3986($split[0]);
            $value = isset($split[1]) ? $this->urldecode_rfc3986($split[1]) : '';
            
            if (isset($parsed_parameters[$parameter])) {
                // We have already recieved parameter(s) with this name, so add to the list
                // of parameters with this name
                
                if (is_scalar($parsed_parameters[$parameter])) {
                    // This is the first duplicate, so transform scalar (string) into an array
                    // so we can add the duplicates
                    $parsed_parameters[$parameter] = array($parsed_parameters[$parameter]);
                }
                
                $parsed_parameters[$parameter][] = $value;
            } else {
                $parsed_parameters[$parameter] = $value;
            }
        }
        return $parsed_parameters;
        
    }
    
    public static function urldecode_rfc3986($string) {
        return urldecode($string);
    }
    
    private function to_url($url,$parameters = array()) {
        $post_data = $parameters;
        $out = $this->get_normalized_http_url($url);
        if ($post_data) {
            $out .= '?'.$post_data;
        }
        return $out;
    }
    
    /**
     * parses the url and rebuilds it to be
     * scheme://host/path
     */
    private function get_normalized_http_url($url) {
        $parts = parse_url($url);
        
        $port = @$parts['port'];
        $scheme = $parts['scheme'];
        $host = $parts['host'];
        $path = @$parts['path'];
        
        $port or $port = ($scheme == 'https') ? '443' : '80';
        
        if (($scheme == 'https' && $port != '443')
            || ($scheme == 'http' && $port != '80')) {
                $host = "$host:$port";
            }
            return "$scheme://$host$path";
    }
    
    /**
     * util function: current nonce
     */
    private function generate_nonce() {
        $mt = microtime();
        $rand = mt_rand();
        
        return md5($mt . $rand); // md5s look nicer than numbers
    }
    
    private function build_signature($http_method, $http_url, $parameters, $consumerSecret) {
        
        $parts = array(
            $http_method,
            $http_url,
            $this->build_http_query($parameters)
        );
        
        for($i = 0; $i < count($parts); $i++) {
            $parts[$i] = str_replace('+',' ',str_replace('%7E', '~', rawurlencode($parts[$i])));
        }
        
        $tmp = implode('&', $parts);
        $key_parts = array(
            $consumerSecret,
            isset($parameters['oauth_token_secret']) ? $parameters['oauth_token_secret'] : ''
        );
        
        $key_parts = $this->urlencode_rfc3986($key_parts);
        $key = implode('&', $key_parts);
        return base64_encode(hash_hmac('sha1', $tmp, $key, true));
    }
    
    public function urlencode_rfc3986($input) {
        if (is_array($input)) {
            return array_map(array('App\Helpers\Social', 'urlencode_rfc3986'), $input);
        } else if (is_scalar($input)) {
            return str_replace(
                '+',
                ' ',
                str_replace('%7E', '~', rawurlencode($input))
                );
        } else {
            return '';
        }
    }
    
    private function build_http_query($params) {
        if (!$params) return '';
        
        // Urlencode both keys and values
        $keys = $this->urlencode_rfc3986(array_keys($params));
        $values = $this->urlencode_rfc3986(array_values($params));
        $params = array_combine($keys, $values);
        
        // Parameters are sorted by name, using lexicographical byte value ordering.
        // Ref: Spec: 9.1.1 (1)
        uksort($params, 'strcmp');
        
        $pairs = array();
        foreach ($params as $parameter => $value) {
            if (is_array($value)) {
                // If two or more parameters share the same name, they are sorted by their value
                // Ref: Spec: 9.1.1 (1)
                natsort($value);
                foreach ($value as $duplicate_value) {
                    $pairs[] = $parameter . '=' . $duplicate_value;
                }
            } else {
                $pairs[] = $parameter . '=' . $value;
            }
        }
        // For each parameter, the name is separated from the corresponding value by an '=' character (ASCII code 61)
        // Each name-value pair is separated by an '&' character (ASCII code 38)
        return implode('&', $pairs);
    }
}