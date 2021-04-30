<?php

class Base {

    protected $request;

    public function __construct($request) {
        $this->request = $request;
    }

    protected function app() {
        if (!isset($this->request['method'])) {
            return false;
        }
        if (!isset($this->request['resource'])) {
            return false;
        }
        if ($this->request['method'] == 'POST' || $this->request['method'] == 'PUT') {
            if (!isset($this->request['data'])) {
                return false;
            }
        }

        return true;
    }
}