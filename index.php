<?php

date_default_timezone_set('Asia/Shanghai');
error_reporting(E_ALL & ~ (E_NOTICE));

// print_r($_SERVER); die;
require 'app/config/config.php';
require 'app/library/common.php';
require 'app/crud/icrud.php';
require 'app/crud/crud.php';

(new Crud())->exec()->output();
