<?php 

class allInfoSet {


    public function isLogginInfoSet ($UserName, $Password) {
    
            if(!$this->isItSet($UserName)){
                    if(!$this->isItSet($Password)) {
                        return true;
            }else {
                throw new Exception("password is missing");
            }
          } else {
              throw new exception("username is missing");
          }
        }
    
        private function isItSet($input){
        return empty($input);
    }
}