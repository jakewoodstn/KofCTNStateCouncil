<?php
class data{
public $req;
public $_err;
public $this;
 public function __construct($req){
  $this->_err = '';
  $this->_req = $req;
}

//Alphabetic
public function alpha($arr){
  foreach($arr as $key){ 
   if(isset($this->_req[$key]))
  {
   $this->_req[$key] = str_replace(' ','',$this->_req[$key]); 
   if(!ctype_alpha($this->_req[$key]) && !empty($this->req[$key])) $this->_err .= " ".$key;
  }
  }
 }

//Numeric
public function num($arr,$len=0){
  foreach($arr as $key){ 
   if(isset($this->_req[$key]))
   {  
        $this->_req[$key] = str_replace(' ','',$this->_req[$key]); 
	if((!ctype_digit($this->_req[$key]) || strlen($this->_req[$key]) < $len) && !empty($this->req[$key])) $this->_err .= " ".$key;}
  }
}

//Alph-numeric
 public function alNum($arr){
  foreach($arr as $key){ 
   if(isset($this->_req[$key]))
   { 
      $this->_req[$key] = str_replace(' ','',$this->_req[$key]); 
      if(!ctype_alnum($this->_req[$key]) && !empty($this->req[$key])) $this->_err .= " ".$key;}
  }
 }

//Allowable chars in alpha
public function alExc($arr,$exc){
  foreach($arr as $key){ 
   if(isset($this->_req[$key]))
   { 
      $this->_req[$key] = str_replace(' ','',$this->_req[$key]); 
      $this->_req[$key] = str_replace($exc,'',$this->_req[$key]);	 
      if(!ctype_alpha($this->_req[$key]) && !empty($this->req[$key])) $this->_err .= " ".$key;
   }
  }
 }

//Allowable chars in numeric
public function numExc($arr,$exc,$len=0){
  foreach($arr as $key){ 
   if(isset($this->_req[$key]))
   { 
      $this->_req[$key] = str_replace(' ','',$this->_req[$key]); 
      $this->_req[$key] = str_replace($exc,'',$this->_req[$key]);	 
      if((!ctype_digit($this->_req[$key]) || strlen($this->_req[$key])< $len) && !empty($this->req[$key])) $this->_err .= " ".$key;
   }
  }
 }

//Allowable chars in alpha-numeric
public function alNumExc($arr,$exc){
  foreach($arr as $key){ 
   if(isset($this->_req[$key]))
   { 
      #preg_match($exc,$this->$key = str_replace(' ','',$this->_req[$key])); 
      $this->_req[$key] = str_replace($exc,'',$this->_req[$key]);	 
      if(!ctype_alnum($this->_req[$key]) && !empty($this->req[$key])) $this->_err .= " ".$key;
   }
  }
 }

//Email
public function email($arr){
  foreach($arr as $key){ 
   if(isset($this->_req[$key]))
   { 
      $this->_req[$key] = str_replace(' ','',$this->_req[$key]); 
     if(!preg_match('^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}(\.[a-zA-Z]{2,3})?(\.[a-zA-Z]{2,3})?$^i',$this->_req[$key]) && !empty($this->req[$key]) )
      $this->_err .= " ".$key;
   }
  }
 }

//URL
public function url($arr){
  foreach($arr as $key){ 
   if(isset($this->_req[$key]))
   { 
      $this->_req[$key] = str_replace(' ','',$this->_req[$key]); 
      $urlregex = "^(https?|ftp)\:\/\/([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*(\:[0-9]{2,5})?(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?\$^i";
     if (!preg_match($urlregex, $this->_req[$key]) && !empty($this->req[$key])) $this->_err .= " ".$key;
   }
  }
 }

//Error Return
function returnError(){
return $this->_err;
}

}
?>
