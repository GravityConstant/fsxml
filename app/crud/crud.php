<?php

require 'mod/base.php';

class Crud {

    private $obj = null;

    private $result = ['code' => 0, 'msg' => 'success', 'info' => []];

    public $request = [];

    public function __construct($params = null) {
        $this->request = $params;
        if ($this->request == null) {
            $this->request['method']   = get('method');
            $this->request['type']     = get('type');
            $this->request['resource'] = get('resource');
            $this->request['data']     = get('data');
        }
        $this->createObj();
    }

    public function createObj() {
        $type = $this->request['type'];
        if ($type == 'gateway') {
            require 'mod/gateway.php';
            $this->obj = new Gateway($this->request);
        } else if ($type == 'queue') {
            require 'mod/queue.php';
            $this->obj = new Queue($this->request);
        } else if ($type == 'user') {
            require 'mod/user.php';
            $this->obj = new User($this->request);
        } else if ($type == 'agent') {
            require 'mod/agent.php';
            $this->obj = new Agent($this->request);
        } else if ($type == 'tier') {
            require 'mod/tier.php';
            $this->obj = new Tier($this->request);
        }
    }

    public function exec() {
        if ($this->obj) {
            $result = $this->obj->app();
            if (is_array($result)) {
                $this->result['code'] = $result['code'];
                $this->result['msg'] = $result['msg'];
            } else {
                $this->result['info'] = $result;
            }
        } else {
            $this->result['code'] = 11;
            $this->result['msg'] = 'unkonw request type';
        }
        return $this;
    }

    public function output() {
        header("Content-Type: application/json");
        echo json_encode($this->result);
    }
}