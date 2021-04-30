<?php

class Agent {
    
    public function app() {
        $bool = parent::app();
        if (!$bool) {
            return ['code' => 12, 'msg' => 'request params error'];
        }

    }

    public function get() {

    }

    public function post() {

    }

    public function put() {

    }

    public function delete() {
        
    }

}