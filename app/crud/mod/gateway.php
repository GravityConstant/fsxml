<?php

class Gateway extends Base implements iCRUD {
    
    public function app() {
        $bool = parent::app();
        if (!$bool) {
            return ['code' => 12, 'msg' => 'request params error'];
        }
        $func = strtolower($this->request['method']);
        return $this->$func();
    }

    // curl -X GET http://192.168.1.184:8000/gateway/trunk.3.xml
    public function get() {
        $file = GATEWAY_HOME . $this->request['resource'];
        if (!file_exists($file)) {
            return ['code' => 21, 'msg' => 'get resource error'];
        }
        $fp = fopen($file, 'r');
        if ($fp === false) {
            return ['code' => 22, 'msg' => 'open resource error'];
        }
        $data = fread($fp, filesize($file));
        if ($data === false) {
            return ['code' => 23, 'msg' => 'read resource error'];
        }
        fclose($fp);

        return $data;
    }

    // curl -X POST -H '{Content-Type: text/xml}' http://192.168.1.184:8000/gateway/trunk.1.xml -d '<include></include>'
    public function post() {
        $file = GATEWAY_HOME . $this->request['resource'];
        $fp = fopen($file, 'w');
        if ($fp === false) {
            return ['code' => 22, 'msg' => 'open resource error'];
        }
        $data = fwrite($fp, filterData($this->request['data']));
        if ($data === false) {
            return ['code' => 24, 'msg' => 'write resource error'];
        }
        fclose($fp);

        return $data;
    }

    // curl -X PUT -H '{Content-Type: text/xml}' http://192.168.1.184:8000/gateway/trunk.1.xml -d '<include></include>'
    public function put() {
        $file = GATEWAY_HOME . $this->request['resource'];
        $fp = fopen($file, 'w');
        if ($fp === false) {
            return ['code' => 22, 'msg' => 'open resource error'];
        }
        $data = fwrite($fp, filterData($this->request['data']));
        if ($data === false) {
            return ['code' => 24, 'msg' => 'put resource error'];
        }
        fclose($fp);

        return $data;
    }

    // curl -X DELETE  http://192.168.1.184:8000/gateway/trunk.1.xml
    public function delete() {
        $file = GATEWAY_HOME . $this->request['resource'];
        if (!file_exists($file)) {
            return ['code' => 21, 'msg' => 'get resource error'];
        }
        if (!unlink($file)) {
            return ['code' => 25, 'msg' => 'delete resource error'];
        }
        return true;
    }
}