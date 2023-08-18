<?php 
class InvalidCredentialsException extends Exception {
    public function __construct($message = 'Invalid username or password', $code = 401, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
