<?php

    class Account {
        public $service;
        public $emailuid;
        public $pwd;
        public $extra;
        public $desc;
        public $userid;
        public $redirectPath;
        const SERVICE_REGEX = "/^[a-zA-Z0-9_\.]{1,20}$/";
        const EMAIL_REGEX = "/^([a-z\d-\.]{1,15})@([a-z\d-]{1,15})\.([a-z]{2,8})(\.[a-z]{2,8})?$/";
        const USERNAME_REGEX = "/^[a-zA-Z0-9_]{5,20}$/";
        const PWD_REGEX = "/^(.){1,50}$/";
        const TXT_AREA_REGEX = "/^(.){0,255}$/";

        public function __construct($service, $emailuid, $pwd, $extra, $desc, $userid, $redirectPath){
            $this->service = $service;
            $this->emailuid = $emailuid;
            $this->pwd = $pwd;
            $this->extra = $extra;
            $this->desc = $desc;
            $this->userid = $userid;
            $this->redirectPath = $redirectPath;
        }

        public function validateAccountData(){
            $this->validateEmptyness();
            $this->validateService();
            $this->validateEmailuid();
            $this->validatePwd();
            $this->validateExtra();
            $this->validateDesc();   
        }

        private function validateEmptyness(){
            if(empty($this->service) || empty($this->emailuid) || empty($this->pwd)){
                header("Location: ../".$this->redirectPath."?error=emptyfields&service=".$this->service."&emailuid=".$this->emailuid."&extra=".$this->extra."&desc=".$this->desc);
                exit();
            }
        }
    
        private function validateService(){
            if(!preg_match(self::SERVICE_REGEX, $this->service)){
                header("Location: ../".$this->redirectPath."?error=invalidservice&emailuid=".$this->emailuid."&extra=".$this->extra."&desc=".$this->desc);
                exit();
            }
        }
    
        private function validateEmailuid(){
            if(!preg_match(self::EMAIL_REGEX, $this->emailuid) && !preg_match(self::USERNAME_REGEX, $this->emailuid)){
                header("Location: ../".$this->redirectPath."?error=emailuidnotvalid&service=".$this->service."&extra=".$this->extra."&desc=".$this->desc);
                exit();
            }
        }
    
        private function validatePwd(){  
            if(!preg_match(self::PWD_REGEX, $this->pwd)){
                header("Location: ../".$this->redirectPath."?error=pwdtoolong&service=".$this->service."&emailuid=".$this->emailuid."&extra=".$this->extra."&desc=".$this->desc);
                exit();
            }
        }
    
        private function validateExtra(){
            if(!preg_match(self::TXT_AREA_REGEX, $this->extra)){
                header("Location: ../".$this->redirectPath."?error=extratoolong&service=".$this->service."&emailuid=".$this->emailuid."&desc=".$this->desc);
                exit();
            }
        }
    
        private function validateDesc(){
            if(!preg_match(self::TXT_AREA_REGEX, $this->desc)){
                header("Location: ../".$this->redirectPath."?error=desctoolong&service=".$this->service."&emailuid=".$this->emailuid."&extra=".$this->extra);
                exit();
            }
        }
    
    }
?>