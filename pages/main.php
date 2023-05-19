<?php

require 'db.php';

$shopsettings = R::findOne('shopsettings', ' id = ? ', [ '1' ]);
$color = R::findOne('color', ' id = ? ', [ '1' ]);
$text = R::findOne('maintext', ' id = ? ', [ '1' ]);
$o_nas = R::findOne('onas', 'id = ?', ['1']);
$socials = R::findOne('socials', 'id = ?', ['1']);
$donate = R::findAll('donate');

$status = json_decode(file_get_contents('https://api.mcsrvstat.us/2/'.$shopsettings->ip));

$docs = R::findOne('docs', 'id = ?', ['1']);

$date = R::findOne('stats', ' date = ? ', [ date("m.d.y") ]);

if ($date) {
  $date->main = $date->main+1;
  $date->all = $date->all+1;
  R::store($date);
} else {
  $ss = R::dispense('stats');
  $ss->all = 1;
  $ss->main = 1;
  $ss->rules = 0;
  $ss->donate = 0;
  $ss->play = 0;
  $ss->docs = 0;
  $ss->date = date("m.d.y");
  R::store($ss);
}

$links = R::findAll('links');

$payments = R::findAll('payments', 'ORDER BY id DESC LIMIT 6');

?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">

  <!-- Менять тут -->
	<title><?php echo $shopsettings->name; ?> - Главная</title>

	<link href="css/style.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
 <link rel="shortcut icon" href="img/favicon.png" type="image/png">

  <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/18d0e7723d.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script src="https://mcapi.us/scripts/minecraft.min.js"></script>

</head>
<body class="bg">

<!-- 


Не обращайте внимание на гразь в коде, скоро все будет исправлено :З


 -->






  <?php $preloader = R::findOne('preloader', 'id = ?', ['1']); ?>
  <?php if ($preloader->on == "on"): ?>
<div class="<?php  echo $color->color; ?> preloader">
<div align="center" style="margin-top: 260px;">
  <h1 class="logo" style="font-size: 60px;"><?php echo $shopsettings->name; ?></h1>
  <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
</div>
</div>
<?php endif; ?>

<script>
  window.onload = function () {
    document.body.classList.add('loaded_hiding');
    window.setTimeout(function () {
      document.body.classList.add('loaded');
      document.body.classList.remove('loaded_hiding');
    }, 500);
  }
</script>
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

<div class="mobile-menu" >
  <div style="margin-bottom: 50px;" align="center">
    <!-- Менять тут -->
    <h1 class="list logo"><?php echo $shopsettings->name; ?></h1>
    <div class="burger list">
      <i class="fa-solid fa-bars"></i>
    </div>
  </div>
  <div style="margin-left: 60px; height: 100%; width: 100%;">
        <?php $static = R::findAll('static'); ?>
    <a class="list a" href="/">Главная</a><br><br>
    <a class="list a" href="/#go">О нас</a><br><br>
    <a class="list a" href="/donate">Описание доната</a><br><br>
    <a class="list a" href="/rules">Правила</a><br><br>
    <?php foreach($static as $sta): ?>
      <a class="list a" href="/<?php echo $sta->name; ?>"><?php echo $sta->title; ?></a><br><br>
  <?php endforeach; ?>
  </div>
</div>

<script type="text/javascript">
  $(function() {
    // @media only screen and (max-width: 600px)
    if (window.matchMedia("(max-width: 980px)").matches) {
      $(".mobile-menu").hide();
      $(".menu").hide();
    let numOfClicks = 0;
    $(".burger").click(function(){
                      
                      ++numOfClicks;
                      if(numOfClicks % 2 !== 0) $(".mobile-menu").show();
                      else $(".mobile-menu").hide();
                  });
    $(".chicken").hide();
    $(".adapt").removeClass("container");
    $(".adapt").addClass("container-fluid");
    $('.gf').replaceWith(function(){
    return $("<h2 />", {html: $(this).html()});
});
    $('.fg').replaceWith(function(){
    return $("<h1 />", {html: $(this).html()});
});


    } else {
      $(".mobile-menu").hide();
    $(".mobile-menu1").hide();
    }

    
  });
</script>

<div class="mobile-menu1">
  <div style="margin: auto;" align="center">
    <!-- Менять тут -->
    <h1 class="list logo"><?php echo $shopsettings->name; ?></h1>
    <div class="burger list">
      <i class="fa-solid fa-bars"></i>
    </div>
  </div>
</div>

<style type="text/css">
  .ssd {
    font-size: 60px;
  }
  @media screen and (max-width: 980px) {
  .mobile-menu {
    z-index: 1001;
    width: 100%;
    position: fixed;
    height: 100%;
    padding:40px;
    background: rgba( 34, 34, 34, 0.5 );
  backdrop-filter: blur( 20px );
  -webkit-backdrop-filter: blur( 20px );
  margin-top: 0px;
  }
  .mobile-menu a {
    padding: 25px;
    border-radius: 30px;
    background: rgba( 55, 55, 55, 0.25 );
  backdrop-filter: blur( 10px );
  -webkit-backdrop-filter: blur( 10px );
  font-size: 50px;
  padding-left: 55px;
  margin-bottom: 20px;
  padding-right: 55px;
  }
  .mobile-menu1 {
    background: rgba( 34, 34, 34, 0.25 );
  backdrop-filter: blur( 10px );
  -webkit-backdrop-filter: blur( 10px );
  z-index: 1000;
    width: 100%;
    padding:40px;
    position: fixed;
    margin-top: 0px;
  }
  .mobile-menu1 h1 {
    font-size: 70px;
  }
  .mobile-menu h1 {
    font-size: 70px;
  }
  .burger {
    padding: 10px;
    padding-left: 30px;
    padding-right: 30px;
    background: rgba( 55, 55, 55, 0.25 );
  backdrop-filter: blur( 10px );
  -webkit-backdrop-filter: blur( 10px );
  color: white;
  font-size: 60px;
  border-radius: 20px;
    margin-left: 180px;
  }
  .adapt {
    padding-top: 190px;
  }
  .poster {
    padding: 70px;
    border-radius: 45px;
  }
  .poster h1 {
    font-size: 90px;
  }
  .poster h5, h6 {
    font-size: 40px;
  }
  .ip {
    height: 85px;
    border-radius: 30px;
  }
  .ico {
    height: 85px;
    border-radius: 30px;
    width: 85px;
  }
  .go {
    font-size: 30px;
    border-radius: 50px;
    padding-left: 60px;
    padding-right: 60px;
  }
  .info .logo {
    font-size: 55px;
    margin-top: 40px;
  }
  .info-text-adapt {
    font-size: 28px;
  }
  .social h1 {
  color: rgb( 34, 34, 34);
  z-index: 100;
  margin-inline: 0px;
  display: inline;
  font-family: 'Unbounded', cursive;
  text-transform: uppercase;
  z-index: 100;
  position: relative;
  bottom: 25px;
  transition: 0.25s;
}
.social h2 {
  color: #FFF;
  z-index: 100;
  margin-inline: 0px;
  display: inline;
  font-family: 'Unbounded', cursive;
  text-transform: uppercase;
  z-index: 200;
  position: relative;
  top: 25px;
  transition: 0.25s;
}

.l {
  display: inline-block;
}

.social:hover h2 {
  color: rgba( 255, 255, 255, 0.1);
}
.social:hover {
  background-color: rgba( 46, 46, 46, 0.3);
}
}
</style>

<div class="container adapt" style="color:white;">
  <div class="<?php  echo $color->color; ?> poster ">
    <div class="row">
      <div class="col chicken" style="display: flex; align-items: center; ">
        <img src="img/art.png">
      </div>
      <div class="col">
        <!-- Менять тут -->
        <h1 class="logo ssd"><?php echo $shopsettings->name; ?></h1>
        <h5><?php echo $text->text; ?></h5>
        <p><h6 class="ip m" id="ip"><?php echo $shopsettings->ip; ?></h6> <h5 class="ico m" onclick="copyText('ip')"><i class="fa-solid fa-copy "></i></h5></p>
        <a href="/play" style="color: black; text-decoration: none;"><button class="go" id="go">Начать играть</button></a>
      </div>
    </div>
  </div>
  <div class="info">
    <hr>
    <h1 class="logo" id="info">О нас</h1>
    <!-- Менять тут -->
    <p class="info-text-adapt"><?php echo nl2br($o_nas->text); ?>
      </p>
      <h1 class="logo">Мы в соц. сетях</h1>  
      <!-- Менять тут -->
      <?php foreach($links as $dsgf): ?>

              <a href="<?php echo $dsgf->link; ?>" class="l" target="_blank">
                <div class="social link<?php echo $dsgf->id; ?>">
                  <div class="name l">
                    <h3 class="gf cl<?php echo $dsgf->id; ?>"><?php echo $dsgf->title; ?></h3><br>
                    <h2 class="fg"><?php echo $dsgf->title; ?></h2>
                  </div>
                </div>
              </a>

      <?php endforeach; ?>

      <hr>
      <h1 class="logo" align="center" id="shop">Магазин привилегий</h1> 
      <!-- Менять тут -->
      
      <div class="row">
        <div class="col">
          <div class="tovars">

            <?php foreach ($donate as $don): ?>
              <div class="tovar" id="d<?php echo $don->id; ?>">
                <h4><?php echo $don->name; ?></h4>
                <p><?php echo $don->price; ?> <?php
                if ($don->curr == "USD") {
                  echo '<i class="fa-solid fa-dollar-sign"></i>';
                } if ($don->curr == "EUR") {
                  echo '<i class="fa-solid fa-euro-sign"></i>';
                } if ($don->curr == "UAH") {
                  echo '<i class="fa-solid fa-hryvnia-sign"></i>';
                } if ($don->curr == "KZT") {
                  echo '<i class="fa-solid fa-tenge-sign"></i>';
                } if ($don->curr == "RUB") {
                  echo '<i class="fa-solid fa-ruble-sign"></i>';
                }

              ?></p>
              </div>

              <script type="text/javascript">
                $(function() {
                  $("#d<?php echo $don->id; ?>").click(function() {
                    $("#iframe").attr("src", "/buy?id=<?php echo $don->id; ?>");
                  });
                });
              </script>

            <?php endforeach; ?>

          </div>
        </div>
        <div class="col-md-9" >
          <?php
$pageid = R::getCell('SELECT id FROM donate LIMIT 1');
           ?>
          <iframe src="/buy?id=<?php echo $pageid; ?>" width="100%" height="700px" id="iframe" style="border-radius: 20px5;"></iframe>
        </div>

          
      </div>

      <div class="row" style="margin-top: -150px;"> 
        <div class="col">
          <h2 align="center" class="logo" style="margin-top:20px;">Онлайн на сервере</h2> 
          <div class="online">
            <div class="row">
              <div class="col">
                <div align="center" class="om">
                  <p><h6 class="ip m je" id="ip"></h6> <h5 class="ico m" onclick="copyText('ip')"><i class="fa-solid fa-copy "></i></h5><br><span class="status">
                    <?php if ($status->online): ?>
                      Онлайн <?php echo $status->players->online." из ".$status->players->max; ?>
                    <?php else: ?>
                      Оффлайн
                    <?php endif; ?>
                  </span><br>
                  <span class="version">
                    <?php if ($status->online): ?>
                      Версия <?php echo $status->version; ?>
                    <?php endif; ?>
                  </span></p>
                  
                </div>
              </div>
              <div class="col">
                <div class="cycl">
                  <h3 class="logo circle-online" align="center">
                    <?php if ($status->online): ?>
                      <?php  echo $status->players->online; ?>
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </h3>
                </div>
                <div class="cycl1 <?php  echo $color->color; ?>">

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h2 align="center" class="logo" style="margin-top: 20px;">Последние покупки</h2>
          <div class="pok">
            <?php if (R::count('payments') > 0): ?>
              <?php foreach($payments as $yggfy): ?>
            <div class="pokupka">
              <div class="skin">
                <img src="img/steve.png">
              </div>
              <div class="sel">
                <h5 class="logo" align="center"><?php echo $yggfy->nick ?></h5>
                <p align="center"><?php echo $yggfy->date; ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <br><br><br><div style="margin: auto;"><h4 align="center">Пусто...</h4></div>
        <?php endif; ?>
          </div>
        
          
        </div>
      </div>

  </div>
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
<style>
  <?php foreach($links as $rgres): ?>
    .link<?php echo $rgres->id; ?>:hover .cl<?php echo $rgres->id; ?> {
      color: <?php echo $rgres->color; ?>;
      text-shadow: 0px 0px 10px <?php echo $rgres->color; ?>;
    }
  <?php endforeach; ?>
</style>
</body>
</html>