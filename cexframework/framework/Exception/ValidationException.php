<?php

namespace Framework\Exception;

class ValidationException extends Exception
{
 protected $errors = [];

 public function __construct(array $errors = [])
 {
  $this->errors = $errors;
 }

 public function render()
 {
  http_response_code(422);

  header('Content-Type: application/json');

  echo json_encode([
   'message' => (object)$this->errors
  ]);
 }
}
