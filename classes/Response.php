<?php

class Response {
    private $errors;
    public function __construct() {
        $this->errors = array();
    }

    public function add($error) {
        array_push($this->errors, $error);
    }
    public function json() {
        if(empty($this->errors)) {
            return json_encode(["success" => true], JSON_UNESCAPED_UNICODE);
        } else {
            return json_encode(["success" => false, "errors" => $this->errors], JSON_UNESCAPED_UNICODE);
        }
    }

    public function successful() {
        return empty($this->errors);
    }
}

?>