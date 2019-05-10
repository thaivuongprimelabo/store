<?php

namespace App\Helpers;

class SendSMS {
    
    private $phone_number = '';
    private $message = '';
    
    public function setPhoneNumber($phoneNumber) {
        $this->phone_number = $phoneNumber;
    }
    
    public function setMessage($message) {
        $this->message = $message;
    }
    
    public function send() {
        
    }
}
?>