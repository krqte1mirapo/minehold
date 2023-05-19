<?php

require 'db.php';

$shopsettings = R::findOne('shopsettings', ' id = ? ', [ '1' ]);
$color = R::findOne('color', ' id = ? ', [ '1' ]);
$docs = R::findOne('docs', 'id = ?', ['1']);

$privacy = R::findOne('privacy', ' id = ? ', [ '1' ]);

$date = R::findOne('stats', ' date = ? ', [ date("m.d.y") ]);

if ($date) {
  $date->docs = $date->docs+1;
  $date->all = $date->all+1;
  R::store($date);
} else {
  $ss = R::dispense('stats');
  $ss->all = 1;
  $ss->main = 0;
  $ss->rules = 0;
  $ss->donate = 0;
  $ss->play = 0;
  $ss->docs = 1;
  $ss->date = date("m.d.y");
  R::store($ss);
}

?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">

  <!-- Менять тут -->
	<title><?php echo $shopsettings->name; ?> - Документы</title>

	<link href="css/style.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
 <link rel="shortcut icon" href="img/allay.png" type="image/png">

  <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/18d0e7723d.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script src="https://mcapi.us/scripts/minecraft.min.js"></script>

</head>
<body class="bg">
  <?php $preloader = R::findOne('preloader', 'id = ?', ['1']); ?>
  <?php if ($preloader->on == "on"): ?>
<div class="<?php  echo $color->color; ?> preloader">
<div align="center" style="margin-top: 260px;">
  <h1 class="logo" style="font-size: 60px;"><?php echo $shopsettings->name; ?></h1>
  <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
</div>
</div>
<?php endif; ?>
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
<script>
  window.onload = function () {
    document.body.classList.add('loaded_hiding');
    window.setTimeout(function () {
      document.body.classList.add('loaded');
      document.body.classList.remove('loaded_hiding');
    }, 500);
  }
</script>
<div class="container">
  <div class="<?php  echo $color->color; ?> poster ">
    <h1 class="logo" style="text-transform: uppercase;">Политика в отношении обработки персональных данных</h1>

  </div>
     <p>
      <?php echo nl2br($privacy->text);  ?>
    </p>
</div>

<!-- Менять тут -->
<div class="footer">
  <div class="row">
    <div class="col">
      <h1 class="logo">
        <?php echo $shopsettings->name; ?>
      </h1>
      <p>Copyright © <?php echo $shopsettings->name; ?> 2022. Все права защищены. Сервер <?php echo $shopsettings->name; ?> не относятся к Mojang Studios.</p>
      <h5>Почта для связи: <a href="mailto:<?php echo $shopsettings->mail; ?>"><?php echo $shopsettings->mail; ?></a></h5>
    </div>
    <?php if ($docs->on == "on"): ?>
    <div class="col">
      <h3><strong>Документы</strong></h3>
      <a href="/oferta" style="margin-top: 20px;">Договор-оферта</a><br>
      <a href="/privacy" style="margin-top: 20px;">Политика в отношении обработки персональных данных</a><br>
    </div>
  <?php endif; ?>
  </div>
</div>

</body>
</html>