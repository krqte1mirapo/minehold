<?php

require 'db.php';

$shopsettings = R::findOne('shopsettings', ' id = ? ', [ '1' ]);

$color = R::findOne('color', ' id = ? ', [ '1' ]);

$date = R::findOne('stats', ' date = ? ', [ date("m.d.y") ]);

if ($date) {
  $date->play = $date->play+1;
  $date->all = $date->all+1;
  R::store($date);
} else {
  $ss = R::dispense('stats');
  $ss->all = 1;
  $ss->main = 0;
  $ss->rules = 0;
  $ss->donate = 0;
  $ss->play = 1;
  $ss->docs = 0;
  $ss->date = date("m.d.y");
  R::store($ss);
}

?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title><?php echo $shopsettings->name; ?> - как начать играть?</title>

  <link href="css/style.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/18d0e7723d.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <link rel="shortcut icon" href="img/favicon.png" type="image/png">

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

<div class="info">
  <h1 align="center" class="logo">Как зайти на сервер?</h1>


    
<div class="row">
      <div class="col">

  <div class="step">
                <h1 class="logo <?php echo $color->color; ?>">#1</h1>

    <p><a href="https://www.tlauncher.org/" target="_BLANK">Скачайте игру</a>, после чего откройте ее и нажмите на кнопку "Сетевая игра".</p>

  </div>

  <div class="step">
                <h1 class="logo <?php echo $color->color; ?>">#3</h1>

    <p>В поле "Адрес сервера" введите айпи <?php echo $shopsettings->ip; ?></p>

  </div>
      </div>
      <div class="col">
          <div class="step">
                <h1 class="logo <?php echo $color->color; ?>">#2</h1>

    <p>Нажмите на кнопку "Добавить". 
    </p>

  </div>
    <div class="step">
                <h1 class="logo <?php echo $color->color; ?>">#4</h1>

    <p>Чтобы зайти нажмите на появившийся сервер два раза.</p>

  </div>
      </div>
  </div>



</div>
</div>
<div class="footer">
  <div class="row">
    <div class="col">
      <h1 class="logo">
        <?php echo $shopsettings->name; ?>
      </h1>
      <p>Copyright © <?php echo $shopsettings->name; ?> 2022. Все права защищены. Сервер <?php echo $shopsettings->name; ?> не относятся к Mojang Studios.</p>
      <h5>Почта для связи: <a href="mailto:<?php echo $shopsettings->mail; ?>"><?php echo $shopsettings->mail; ?></a></h5>
    </div>
    <?php $docs = R::findOne('docs', 'id = ?', ['1']); ?>
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