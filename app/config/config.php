<?php
# General Config
$prod_env = true;

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'bookstore';
$urlroot = 'http://127.0.0.1/bookstore/';

if ($prod_env) {
  
    $host = 'localhost';
    $user = 'yuniwirh_bookstore';
    $pass = 'n*W#N(4T~PeJ';
    $dbname = 'yuniwirh_bookstore';
    $urlroot = 'https://yuniss.com/bookstore/';
}

// DB Params
define('DB_HOST', $host);
define('DB_USER', $user);
define('DB_PASS', $pass);
define('DB_NAME', $dbname);

// App Root
define('APPROOT', dirname(dirname(__FILE__)));
// URL Root
define('URLROOT', $urlroot);
define('ROOT', dirname(dirname(dirname(__FILE__))));

// SITE CONSTANTS
define('AUTHOR', 'author');
define('STATUS_PAIED', 100);
// Site Name
define('SITENAME', 'Book Store');
