<?php
//______________________Delete pictures from server & database_________________________________

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
require_once($path . 'wp-load.php');
require_once(dirname(__FILE__) . '/functions.php');

if(photoDelete($_POST['item_id'])){
    wp_send_json_success();
}
