<?php

// http://127.0.0.1/gateway/xx/yy 一次获取
function get($name) {
    if ($name == 'method') {
        return $_SERVER['REQUEST_METHOD'];
    } else if ($name == 'data') {
        return file_get_contents("php://input");
    }

    $params = get_params($_SERVER['REQUEST_URI']);
    if (count($params) == 0) {
        return '';
    }

    if ($name == 'type') {
        return $params[0];
    } else if ($name == 'resource') {
        return count($params) > 0 ? $params[1] : '';
    } 

    return '';
}

function get_params($request_uri) {
    $request_uri = trim($request_uri, '/');
    $params = explode('/', $request_uri);
    return $params;
}

// 去掉转义
function filterData($data) {
    $arr = explode('\n', trim($data, '"'));
    $replace = preg_replace(['/\\\"/', '#\\\/#'], ['"', '/'], $arr);
    return implode("\n", $replace);
}