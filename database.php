<?php
const DB_HOST = 'localhost';
const DB_USER = 'test';
const DB_PASS = '123';
const DB_NAME = 'test';

$link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($link->connect_error) { 
   die('Connect Error ('	.$link->connect_errno.') '.$link->connect_error);
}
$link->set_charset("utf8"); 
?>