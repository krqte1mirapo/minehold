<?php
ini_set('error_reporting', E_WARNING);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require 'db.php';
require 'admin/rcon/rcon/rcon.php';

if ($_POST['id'] == null) {
  header("Location: /");
}

$freekassa = R::findOne('freekassa', ' id = ? ', ['1']);
$shopsettings = R::findOne('shopsettings', ' id = ? ', [ '1' ]);
$rcon = R::findOne('rcon', ' id = ? ', [ '1' ]);
$product = R::findOne('donate', ' id = ? ', [ $_POST['id'] ]);
$promo = ($_POST['promo'] != null) ? R::findOne('promo', ' promo = ? ', [ $_POST['promo'] ]) : "";
$timeout = 3;

$rcon1 = new Rcon($rcon->host, $rcon->port, $rcon->password, $timeout);

function subtract_percent($price, $percent) {
    return $price * ($percent / 100);
}

$shop_id = $freekassa->shop_id;
$word = $freekassa->word;
$nick = $_POST['nick']." ".$_POST['id'];
$price = ($promo != "") ? subtract_percent($product->price, $promo->sale) : $product->price;
$email = ($_POST['mail'] != null) ? "&em=".$_POST['mail'] : "";
$curr = $product->curr;

$finalPrice = $price;
$t = false;
if (R::count('payments', 'nick = ?', [$_POST['nick']]) > 0) {
    // Получение последней записи из таблицы по столбцу nick
    $lastRow = R::findOne('payments', 'nick = ? ORDER BY id DESC', [$_POST['nick']]);
    $product1 = R::findOne('donate', ' id = ? ', [ $lastRow->donate_id ]);
    if ($lastRow->donate_id != $_POST['id'] and $product1->price < $product->price) {
        $r = $product->price - $product1->price;
        $finalPrice = ($promo != "") ? subtract_percent($r, $promo->sale) : $r;
    } else {
        $t = true;
    }
}

$hash = md5($shop_id.":".$finalPrice.":".$word.":".$curr.":".$nick);

 ?>

<?php if (isset($freekassa)): ?>
  <?php if($rcon1->connect()): ?>
      <?php if ($t == true): ?>
        <!DOCTYPE html>
<html>
<head>

<!-- Менять тут -->
  <title>Ой....</title>

  <link href="css/style.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/18d0e7723d.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <link rel="shortcut icon" href="img/favicon.png" type="image/png">

</head>
<body class="bg">

<div class="menu">
  <div style="margin: auto;">
    <!-- Менять тут -->
    <?php $static = R::findAll('static'); ?>
    
    <h1 class="list logo"><?php echo $shopsettings->name; ?></h1>
    <a class="list a" href="/">Главная</a>
    <a class="list a" href="/#go">О нас</a>
    <a class="list a" href="/donate">Описание доната</a>
    <a class="list a" href="/rules">Правила</a>
    <?php foreach($static as $sta): ?>
      <a class="list a" href="/<?php echo $sta->name; ?>"><?php echo $sta->title; ?></a>
  <?php endforeach; ?>
  </div>
</div>

<div class="container" style="align-items: center; align-content: center; width: 100%; height:100%;">
  <div style="margin: 30px;" align="center">
    <img src="img/allay.png" style="margin-top: 60px;">
      <h1 class="logo" align="center" style="font-size: 60px;">
    Упс...
  </h1>
  <h3 align="center">Вы уже купили этот товар.</h3>
  </div>
</div>

</body>
</html>
      <?php else: ?>
    <?php 
    header("Location: https://pay.freekassa.ru/?m=".$shop_id."&oa=".$finalPrice."&currency=".$curr."&o=".$nick.$email."&s=".$hash);
    ?>
    <?php endif; ?>
  <?php else: ?>
    <!DOCTYPE html>
<html>
<head>

<!-- Менять тут -->
  <title>Ой....</title>

  <link href="css/style.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/18d0e7723d.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <link rel="shortcut icon" href="img/favicon.png" type="image/png">

</head>
<body class="bg">

<div class="menu">
  <div style="margin: auto;">
    <!-- Менять тут -->
    <?php $static = R::findAll('static'); ?>
    
    <h1 class="list logo"><?php echo $shopsettings->name; ?></h1>
    <a class="list a" href="/">Главная</a>
    <a class="list a" href="/#go">О нас</a>
    <a class="list a" href="/donate">Описание доната</a>
    <a class="list a" href="/rules">Правила</a>
    <?php foreach($static as $sta): ?>
      <a class="list a" href="/<?php echo $sta->name; ?>"><?php echo $sta->title; ?></a>
  <?php endforeach; ?>
  </div>
</div>

<div class="container" style="align-items: center; align-content: center; width: 100%; height:100%;">
  <div style="margin: 30px;" align="center">
    <img src="img/allay.png" style="margin-top: 60px;">
      <h1 class="logo" align="center" style="font-size: 60px;">
    Упс...
  </h1>
  <h3 align="center">Ошибка подключения RCON.</h3>
  </div>
</div>

</body>
</html>
 <?php endif; ?>
<?php else: ?>
<!DOCTYPE html>
<html>
<head>

<!-- Менять тут -->
  <title>Ой....</title>

  <link href="css/style.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/18d0e7723d.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <link rel="shortcut icon" href="img/favicon.png" type="image/png">

</head>
<body class="bg">

<div class="menu">
  <div style="margin: auto;">
    <!-- Менять тут -->
    <?php $static = R::findAll('static'); ?>
    
    <h1 class="list logo"><?php echo $shopsettings->name; ?></h1>
    <a class="list a" href="/">Главная</a>
    <a class="list a" href="/#go">О нас</a>
    <a class="list a" href="/donate">Описание доната</a>
    <a class="list a" href="/rules">Правила</a>
    <?php foreach($static as $sta): ?>
      <a class="list a" href="/<?php echo $sta->name; ?>"><?php echo $sta->title; ?></a>
  <?php endforeach; ?>
  </div>
</div>

<div class="container" style="align-items: center; align-content: center; width: 100%; height:100%;">
  <div style="margin: 30px;" align="center">
    <img src="img/allay.png" style="margin-top: 60px;">
      <h1 class="logo" align="center" style="font-size: 60px;">
    Упс...
  </h1>
  <h3 align="center">Ошибка подключения кассы.</h3>
  </div>
</div>

</body>
</html>
<?php endif; ?>