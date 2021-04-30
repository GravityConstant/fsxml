<?php

interface iCRUD {
    // public function get($type, $resource);
    // public function post($type, $resource, $data);
    // public function put($type, $resource, $data);
    // public function delete($type, $resource, $data);

    public function get();
    public function post();
    public function put();
    public function delete();
}