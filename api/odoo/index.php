<?php
$url = "https://cergos-kms.odoo.com";
$db = "cergos-kms";
$email = "reggie@kmsapeldoorn.nl";
$password = "5dbd93c180b3dd7f1631409a4c725c5447d0b502";

// 5dbd93c180b3dd7f1631409a4c725c5447d0b502 reggie@kmsapeldoorn

require_once('ripcord/ripcord.php');
// $info = ripcord::client('https://cergos-kms.odoo.com/start')->start();
// list($url, $db, $username, $password) = array($info['host'], $info['database'], $info['user'], $info['password']);

$common = ripcord::client("$url/xmlrpc/2/common");
$uid = $common->authenticate($db, $email, $password, []);
    
if(!empty($uid)){
    echo "Successfully sign in with the user id of : " . var_dump($uid) . '</br>';
}else{
    echo "Failed to sign in";
}

$models = ripcord::client("$url/xmlrpc/2/object");
$models->execute_kw($db, $uid, $password, 'res.partner', 'name_search', array('foo'), array('limit' => 10));