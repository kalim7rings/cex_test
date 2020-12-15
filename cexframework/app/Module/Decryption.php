<?php

namespace App\Module;

class Decryption
{

 protected $alphabets = [];
 protected $inputs = [];
 
 public function __construct(array $inputs)
 {
  $this->alphabets = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
  $this->inputs = $inputs;
 }

 public function __invoke()
 {
  foreach ($this->inputs as $key => $value) {
   $this->inputs[$key] = $this->decrypt(strtolower($value));
  }
  
  return $this->inputs;
 }

 public function decrypt($string)
 {
  $decryptedString = '';
  $stringLength = strlen($string);
  
  for ($i = 0; $i < $stringLength; $i++) {
   $index = array_search($string[$i], $this->alphabets);

   if ($index !== false) {

    $decryptedString .= $this->alphabets[(($index - $stringLength) + 26) % 26];
   } else {
    $decryptedString .= $string[$i];
   }
  }

  return $decryptedString;
 }
}
