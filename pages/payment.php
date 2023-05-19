<?php

require 'db.php';
require 'admin/rcon/rcon/rcon.php';

$freekassa = R::findOne('freekassa', 'id = ?', ['1']);

$merchant_id = $freekassa->shop_id;
$merchant_secret = $freekassa->word2;

  function getIP() {
    if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
    return $_SERVER['REMOTE_ADDR'];
  }

  if (!in_array(getIP(), array('168.119.157.136', '168.119.60.227', '138.201.88.124', '178.154.197.79'))) header("Location: /");

  $sign = md5($merchant_id.':'.$_REQUEST['AMOUNT'].':'.$merchant_secret.':'.$_REQUEST['MERCHANT_ORDER_ID']);

  if ($sign != $_REQUEST['SIGN']) die('wrong sign');

  //Оплата прошла успешно, можно проводить операцию.
  $donate = $_REQUEST['MERCHANT_ORDER_ID'];
  $donate1 = explode(" ", $donate);
  $product = R::findOne('donate', ' id = ? ', [ $donate1[1] ]);
  $post = R::dispense('payments');
  $post->operation_id = $_REQUEST['intid'];
  $post->nick = $donate1[0];
  $post->donate_id = $donate1[1];
  $post->curr = $product->curr;
  $post->amount = $_REQUEST['AMOUNT'];
  $post->date = date("d.m.Y");
  R::store($post);
  $rcon = R::findOne('rcon', ' id = ? ', [ '1' ]);
  $timeout = 3;
  $rcon1 = new Rcon($rcon->host, $rcon->port, $rcon->password, $timeout);
    $cmd = str_replace("%ИГРОК%", $donate1[0], $product->cmd);
    if($rcon1->connect()) {
    $rcon1->send_command($cmd);
  }

  die("YES");

 ?>