<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require "../db.php";
$data = $_POST;
ini_set('file_uploads', 'On');
require 'rcon/rcon/rcon.php';

$l = R::findOne('login', ' id = ? ', [ '1' ]);

$t = false;

if (isset($_COOKIE['login'])) {
    if($_COOKIE['login'] != $l->password){
        header("Location: /admin/login.php");
    }
} else {
    header("Location: /admin/login.php");
}




if (isset($data['shop-settings'])) {
    R::wipe('shopsettings');
    $sett = R::dispense('shopsettings');
    $sett->name = trim($data['name']);
    $sett->ip = trim($data['ip']);
    $sett->mail = trim($data['mail']);
    R::store($sett);
    $t = true;

}

$shopsettings = R::findOne('shopsettings', ' id = ? ', [ '1' ]);

if (isset($data['set-pass'])) {
    R::wipe('login');
    $sett1 = R::dispense('login');
    $sett1->login = trim($data['login']);
    $sett1->password = trim($data['password']);
    R::store($sett1);
    $t = true;
}

if (isset($data['shop-color'])) {
    R::wipe('color');
    $sett2 = R::dispense('color');
    $sett2->color = trim($data['color']);
    R::store($sett2);
$t = true;
}

if (isset($data['main-text'])) {
    R::wipe('maintext');
    $sett3 = R::dispense('maintext');
    $sett3->text = trim($data['text']);
    R::store($sett3);
    $t = true;
}

$text = R::findOne('maintext', ' id = ? ', [ '1' ]);

if (isset($data['o-nas-text'])) {
    R::wipe('onas');
    $sett4 = R::dispense('onas');
    $sett4->text = trim($data['o-nas']);
    R::store($sett4);
    $t = true;
}

$o_nas = R::findOne('onas', 'id = ?', ['1']);

if (isset($data['socials'])) {
    R::wipe('socials');
    $sett5 = R::dispense('socials');
    $sett5->telegram = trim($data['telegram']);
    $sett5->youtube = trim($data['youtube']);
    $sett5->tiktok = trim($data['tiktok']);
    R::store($sett5);
    $t = true;
}

$socials = R::findOne('socials', 'id = ?', ['1']);

if (isset($data['rules'])) {
    $sett6 = R::dispense('rules');
    $sett6->name = trim($data['kategory-name']);
    $sett6->text = trim($data['kategory-text']);
    R::store($sett6);
    $t = true;
}

$rules = R::findAll('rules');

if (isset($data['rules_del'])) {
    $post = R::findOne('rules', 'id = ?', array($data['id']));
    R::trash($post);
    header("Location: /admin/");
    $t = true;
}

if (isset($data['rules_prim'])) {
    $post1 = R::findOne('rules', 'id = ?', array($data['id']));
    $post1->name = $data['rul-name'];
    $post1->text = $data['rul-text'];
    R::store($post1);
 $t = true;
    header("Location: /admin/");
}

if (isset($data['donate'])) {
    
        $name = $_FILES["file12"]["name"];
        move_uploaded_file($_FILES["file12"]["tmp_name"], $name);
        $name2 = time();
        rename($name, "../img/".$name);
    $sett7 = R::dispense('donate');
    $sett7->name = trim($data['donate-name']);
    $sett7->price = trim($data['donate-price']);
    $sett7->text = trim($data['donate-text']);
    $sett7->curr = $data['donate-cur'];
    $sett7->cmd = trim($data['donate-cmd']);
    $sett7->img = $_FILES["file12"]["name"];
    R::store($sett7);
    $t = true;
}

$donate = R::findAll('donate');

if (isset($data['donate_del'])) {
    $post = R::findOne('donate', 'id = ?', array($data['id']));
    R::trash($post);
    header("Location: /admin/");
    $t = true;
}

if (isset($data['donate_prim'])) {
    $idf = "file13".$data['id'];
$name = $_FILES[$idf]["name"];
        move_uploaded_file($_FILES[$idf]["tmp_name"], $name);
        $name2 = time();
        rename($name, "../img/".$name);
    $post2 = R::findOne('donate', 'id = ?', array($data['id']));
    $post2t = R::findOne('donate', 'id = ?', array($data['id']));
    $post2->name = $data['donate-name'];
    $post2->price = $data['donate-price'];
    $post2->text = $data['donate-opis-text'];
    $post2->curr = $data['donate-cur'];
    $post2->cmd = trim($data['donate-cmd']);
    $post2->img = ($_FILES[$idf]["name"] != null) ? $_FILES[$idf]["name"] : $post2t->img;
    R::store($post2);
    header("Location: /admin/");
    $t = true;
}



if (isset($data['on-pages'])) {
    R::wipe('docs');
    $pag = R::dispense('docs');
    $pag->on = trim($data['is']);
    R::store($pag);
    header("Location: /admin/");
    $t = true;
}

$docs = R::findOne('docs', 'id = ?', ['1']);

if (isset($data['is-delete-code'])) {
    R::wipe('code');
    $pag1 = R::dispense('code');
    $pag1->on = trim($data['bv']);
    R::store($pag1);
    header("Location: /admin/");
    $t = true;
}

$code = R::findOne('code', 'id = ?', ['1']);

if (isset($data['on-preloader'])) {
    R::wipe('preloader');
    $pag12 = R::dispense('preloader');
    $pag12->on = trim($data['dd']);
    R::store($pag12);
    header("Location: /admin/");
    $t = true;
}

$preloader = R::findOne('preloader', 'id = ?', ['1']);

$color = R::findOne('color', ' id = ? ', [ '1' ]);

if (isset($data['add-obj'])) {
    R::wipe('obj');
    $pag14 = R::dispense('obj');
    $pag14->text = trim($data['obj-text']);
    R::store($pag14);
    
    $t = true;
}

$obj = R::findAll('obj');

if (isset($data['obj_del'])) {
    $post12 = R::findOne('obj', 'id = ?', ['1']);
    R::trash($post12);
    header("Location: /admin/");
    $t = true;
}

if (isset($data['oferta_prim'])) {
    R::wipe('oferta');
    $pag1d4 = R::dispense('oferta');
    $pag1d4->text = trim($data['text']);
    R::store($pag1d4);
    $t = true;
}

$oferta = R::findOne('oferta', ' id = ? ', [ '1' ]);
$privacy = R::findOne('privacy', ' id = ? ', [ '1' ]);

if (isset($data['privacy_prim'])) {
    R::wipe('privacy');
    $pag1ad4 = R::dispense('privacy');
    $pag1ad4->text = trim($data['text']);
    R::store($pag1ad4);
    $t = true;
}

$date = R::findOne('stats', ' date = ? ', [ date("m.d.y") ]);

if (!$date) {
    $ss = R::dispense('stats');
  $ss->all = 0;
  $ss->main = 0;
  $ss->rules = 0;
  $ss->donate = 0;
  $ss->play = 0;
  $ss->docs = 0;
  $ss->date = date("m.d.y");
  R::store($ss);
}

$date1 = R::findOne('stats', ' date = ? ', [ date("m.d.y") ]);

if (isset($data['add-rcon'])) {
        R::wipe('rcon');
    $pag1ad41 = R::dispense('rcon');
    $pag1ad41->host = trim($data['host']);
    $pag1ad41->port = trim($data['port']);
    $pag1ad41->password = trim($data['password']);
    R::store($pag1ad41);
    $t = true;
}

$rcon = R::findOne('rcon', 'id = ?', ['1']);

if (isset($data['add_promo'])) {
    $pr = R::dispense('promo');
    $pr->promo = trim($data['promo']);
    $pr->sale = trim($data['sale']);
    $pr->date = trim($data['date']);
    R::store($pr);
    $t = true;
}

$promo = R::findAll('promo');

if (isset($data['promo_del'])) {
    $g4 = R::findOne('promo', 'id = ?', array($data['id']));
    R::trash($g4);
    header("Location: /admin/");
    $t = true;
}

if (isset($data['set-favicon'])) {
    $name = $_FILES["file"]["name"];
    move_uploaded_file($_FILES["file"]["tmp_name"], $name);
    rename($_FILES["file"]["name"], "../img/favicon.png");
    $t = true;
}

if (isset($data['add-link'])) {
    $pr11 = R::dispense('links');
    $pr11->title = trim($data['title']);
    $pr11->link = trim($data['link']);
    $pr11->color = trim($data['color']);
    R::store($pr11);
    $t = true;
}

$links = R::findAll('links');

if (isset($data['set-link'])) {
    $pffgf = R::findOne('links', 'id = ?', array($data['id']));
    $pffgf->title = $data['title'];
    $pffgf->link = $data['link'];
    $pffgf->color = $data['color'];
    R::store($pffgf);
    header("Location: /admin/");
    $t = true;
}

if (isset($data['del-link'])) {
    $postdwdw = R::findOne('links', 'id = ?', array($data['id']));
    R::trash($postdwdw);
    header("Location: /admin/");
    $t = true;
}

if (isset($data['set-freekassa'])) {
    R::wipe('freekassa');
    $prffg11 = R::dispense('freekassa');
    $prffg11->shop_id = trim($data['shop_id']);
    $prffg11->key = trim($data['key']);
    $prffg11->word = trim($data['word']);
    R::store($prffg11);
    $t = true;
}

$freekassa = R::findOne('freekassa', 'id = ?', ['1']);

if (isset($data['set-new-freekassa'])) {
    $bdfdf = R::findOne('freekassa', 'id = ?', ['1']);
    $bdfdf->shop_id = $data['shop_id'];
    $bdfdf->word = $data['word'];
    $bdfdf->word2 = $data['word2'];
    R::store($bdfdf);
    header("Location: /admin/");
    $t = true;
}
if (isset($data['del-freekassa'])) {
    $b554e46 = R::findOne('freekassa', 'id = ?', ['1']);
    R::trash($b554e46);
    header("Location: /admin/");
    $t = true;
}

if (isset($data['add-page'])) {
    $feg = R::dispense('static');
    $feg->name = $data['name'];
    $feg->title = $data['title'];
    $feg->page = $data['page'];
    R::store($feg);
    header("Location: /admin/");
}

$pages = R::findAll('static');

if (isset($data['del-page'])) {
    $hthtd = R::findOne('static', 'id = ?', [$data['id']]);
    R::trash($hthtd);
    header("Location: /admin/");
}

$payments1 = R::findAll('payments', 'ORDER BY id DESC LIMIT 5');

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">

  <!-- Менять тут -->
    <title>Админ панель</title>

    <link href="css/style.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
 <link rel="shortcut icon" href="../img/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.4/font/bootstrap-icons.min.css" integrity="sha512-yU7+yXTc4VUanLSjkZq+buQN3afNA4j2ap/mxvdr440P5aW9np9vIr2JMZ2E5DuYeC9bAoH9CuCR7SJlXAa4pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/18d0e7723d.js" crossorigin="anonymous"></script>
  <script src="https://mcapi.us/scripts/minecraft.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>


</head>
<body class="bg">

<div class="<?php  echo $color->color; ?> preloader">
<div align="center" style="margin-top: 260px;">
  <h1 class="logo" style="font-size: 60px;"><?php echo $shopsettings->name; ?></h1>
  <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
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
<?php if($t): ?>
    <div id="snackbar" style="border-radius: 20px; padding: 30px;"><i class="fa-sharp fa-solid fa-circle-check <?php echo $color->color; ?>" style="padding: 10px;" id="rgrgr"></i>&nbsp;&nbsp; Изменения успешно применены.</div>

<script>
    $(function(){
        var x = document.getElementById("snackbar");
        var y = document.getElementById("rgrgr");

  // Add the "show" class to DIV
  x.className = "show";

  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  setTimeout(function(){ $("#rgrgr").hide(); }, 3000);
    });
</script>
<?php endif; ?>

<div class="sidenav">
    <h4 class="logo <?php echo $color->color; ?>" style="padding-left: 16px; border-radius: 0px; padding: 10px; "><?php echo $shopsettings->name; ?></h4>
    <a  class="eveve fffff" ><i class="bi bi-graph-down"></i> Статистика</a>
  <a  class="wefd fffff"><i class="bi bi-gear"></i> Настройки магазина</a>
  <a  class="wevd fffff"><i class="bi bi-person-badge"></i> Главная</a>
  <a  class="trtrtry fffff"><i class="bi bi-box-arrow-up-right"></i> Ссылки</a>
  <a  class="vtbd fffff"><i class="bi bi-book"></i> Правила</a>
  <a  class="wrgr fffff"><i class="bi bi-coin"></i> Товары</a>
  <a  class="abfs fffff"><i class="bi bi-card-text"></i> Объявление</a>
  <a  class="vedve fffff"><i class="bi bi-envelope-paper"></i> Документы</a>
  <a  class="rerere fffff"><i class="bi bi-terminal"></i> Ркон</a>
  <a  class="efegers fffff"><i class="bi bi-tags"></i> Промокоды</a>
  <a  class="gbvgbv fffff"><i class="bi bi-credit-card"></i> Платежные системы</a>
  <a  class="ghbtw436436 fffff" style="margin-bottom:0px;"><i class="bi bi-display"></i> Статические страницы</a>
<br><hr style="color: #FFF;"><br>
<a href="/" class="lllllll"><h6>В магазин</h6></a>
  <a href="https://discord.gg/EE5zASXUh3" target="_blank" class="lllllll"><h6>Дискорд сервер</h6></a>
  <a href="https://dr1ko-42.gitbook.io/dark./" target="_blank" class="lllllll"><h6>Вики</h6></a>
  <a href="/admin/logout.php" class="lllllll"><h6>Выйти</h6></a>
  <script type="text/javascript">
    
      $(function(){
        
    $(".onas1").hide();
    $(".rul1").hide();
    $("#wdwd").hide();
    $(".obj").hide();
    $(".m_doc").hide();
    $(".mag1").hide();
    $(".rcon").hide();
    $(".promo").hide();
    $(".links").hide();
    $(".paymants").hide();
    $(".statitic").hide();

$(".gbvgbv").click(function() {
            $(".mag1").hide();
            $(".onas1").hide();
            $(".rul1").hide();
            $("#wdwd").hide();
            $(".obj").hide();
            $(".m_doc").hide();
            $(".stat11").hide();
            $(".rcon").hide();
            $(".promo").hide();
            $(".links").hide();
            $(".paymants").show();
            $(".statitic").hide();
        });
$(".ghbtw436436").click(function() {
            $(".mag1").hide();
            $(".onas1").hide();
            $(".rul1").hide();
            $("#wdwd").hide();
            $(".obj").hide();
            $(".m_doc").hide();
            $(".stat11").hide();
            $(".rcon").hide();
            $(".promo").hide();
            $(".links").hide();
            $(".paymants").hide();
            $(".statitic").show();
        });


$(".trtrtry").click(function() {
            $(".mag1").hide();
            $(".onas1").hide();
            $(".rul1").hide();
            $("#wdwd").hide();
            $(".obj").hide();
            $(".m_doc").hide();
            $(".stat11").hide();
            $(".rcon").hide();
            $(".promo").hide();
            $(".links").show();
            $(".paymants").hide();
            $(".statitic").hide();
        });


    $(".efegers").click(function() {
            $(".mag1").hide();
            $(".onas1").hide();
            $(".rul1").hide();
            $("#wdwd").hide();
            $(".obj").hide();
            $(".m_doc").hide();
            $(".stat11").hide();
            $(".rcon").hide();
            $(".promo").show();
            $(".links").hide();
            $(".paymants").hide();
            $(".statitic").hide();

        });
        $(".wefd").click(function() {
            $(".mag1").show();
            $(".onas1").hide();
            $(".rul1").hide();
            $("#wdwd").hide();
            $(".obj").hide();
            $(".m_doc").hide();
            $(".stat11").hide();
            $(".rcon").hide();
            $(".promo").hide();
            $(".links").hide();
            $(".paymants").hide();
            $(".statitic").hide();
        });
        $(".rerere").click(function() {
            $(".mag1").hide();
            $(".onas1").hide();
            $(".rul1").hide();
            $("#wdwd").hide();
            $(".obj").hide();
            $(".m_doc").hide();
            $(".stat11").hide();
            $(".rcon").show();
            $(".promo").hide();
            $(".links").hide();
            $(".paymants").hide();
            $(".statitic").hide();
        });
        $(".eveve").click(function() {
            $(".mag1").hide();
            $(".onas1").hide();
            $(".rul1").hide();
            $("#wdwd").hide();
            $(".obj").hide();
            $(".m_doc").hide();
            $(".stat11").show();
            $(".rcon").hide();
            $(".promo").hide();
            $(".links").hide();
            $(".paymants").hide();
            $(".statitic").hide();
        });

        $(".abfs").click(function() {
            $(".mag1").hide();
            $(".onas1").hide();
            $(".rul1").hide();
            $("#wdwd").hide();
            $(".obj").show();
            $(".m_doc").hide();
            $(".stat11").hide();
            $(".rcon").hide();
            $(".promo").hide();
            $(".links").hide();
            $(".paymants").hide();
            $(".statitic").hide();
        });


$(".wevd").click(function() {
            $(".mag1").hide();
            $(".onas1").show();
            $(".rul1").hide();
            $("#wdwd").hide();
            $(".obj").hide();
            $(".m_doc").hide();
            $(".stat11").hide();
            $(".rcon").hide();
            $(".promo").hide();
            $(".links").hide();
            $(".paymants").hide();
            $(".statitic").hide();
        });

$(".vtbd").click(function() {
            $(".mag1").hide();
            $(".onas1").hide();
            $(".rul1").show();
            $("#wdwd").hide();
            $(".obj").hide();
            $(".m_doc").hide();
            $(".stat11").hide();
            $(".rcon").hide();
            $(".promo").hide();
            $(".links").hide();
            $(".paymants").hide();
            $(".statitic").hide();
        });

$(".wrgr").click(function() {
            $(".mag1").hide();
            $(".onas1").hide();
            $(".rul1").hide();
            $("#wdwd").show();
            $(".obj").hide();
            $(".m_doc").hide();
            $(".stat11").hide();
            $(".rcon").hide();
            $(".promo").hide();
            $(".links").hide();
            $(".paymants").hide();
            $(".statitic").hide();
        });

$(".vedve").click(function() {
            $(".mag1").hide();
            $(".onas1").hide();
            $(".rul1").hide();
            $("#wdwd").hide();
            $(".obj").hide();
            $(".m_doc").show();
            $(".stat11").hide();
            $(".rcon").hide();
            $(".promo").hide();
            $(".links").hide();
            $(".paymants").hide();
            $(".statitic").hide();
        });

      });
  </script>
</div>

<div class="menu">
  <div style="margin-left: 270px;">
    <h1 class="list logo" style="margin: auto; text-shadow: 0px 0px 6px white;">Админ панель</h1>
  </div>
</div>




   <div class="main-content">
        <div class="container" style="padding-top: 110px;">
        

       <div class="stat11">
    <div class="container">
        <h3 class="logo" style="margin-top: 20px; margin-left: 70px; margin-bottom: 30px;"><i class="bi bi-graph-down <?php echo $color->color; ?>" style="padding: 10px; padding-left: 15px; padding-right: 15px; border-radius: 15px;"></i>&nbsp;  Статистика</h3>
        <hr style="color: #FFF;">
        <div class="row">
            <div class="col">
                <div class="block">
                     <div class="<?php echo $color->color; ?>" style="padding: 20px; border-radius: 20px;">
                        <h3 class="logo">Посещения за сегодня:</h3>
                        
                     </div><br>
                     <b>Всего: <?php echo $date1->all; ?></b><br>
                        Главная: <?php echo $date1->main; ?><br>
                        Правила: <?php echo $date1->rules; ?><br>
                        Описание доната: <?php echo $date1->donate; ?><br>
                        Начать играть: <?php echo $date1->play; ?><br>
                        Документы: <?php echo $date1->docs; ?>
                </div>
                 <div class="block">
                    <div class="<?php echo $color->color; ?>" style="padding: 20px; border-radius: 20px;">
                        <h3 class="logo">Сервер:</h3>
                        
                     </div><br>
                      <?php

$status1 = json_decode(file_get_contents('https://api.mcsrvstat.us/2/'.$shopsettings->ip));
                        if ($status1->online) {
                            echo "Текущий онлайн: ".$status1->players->online;
                        } else {
                            echo "Оффлайн";
                        }
                      ?>
                </div>
            </div>
            <div class="col">
               <div class="block">
                   <div class="<?php echo $color->color; ?>" style="padding: 20px; border-radius: 20px;">
                        <h3 class="logo">Последние покупки:</h3>
                        
                     </div><br>
                     <?php if(R::count('payments') > 0): ?>
                     <?php foreach($payments1 as $hghjn): ?>
                        <div style="width: 100%; padding: 20px; border-radius: 15px; background-color: rgba( 46, 46, 46, 0.5); margin-bottom: 15px;">
                         <img src='../libs/face.php?u=<?php echo $hghjn->nick; ?>&s=50&v=f' class="list" style="margin-right: 0px; margin-left: 30px;" />
                         <div class="list">
                             <span style="margin-right: 70px;">Ник: <b><?php echo $hghjn->nick; ?></b><br></span>
                             <span style="margin-left: 35px;">Дата: <b style="margin-right:50px;"><?php echo $hghjn->date; ?></b><br></span>
                             Сумма: <b style="margin-right:0px;"><?php echo $hghjn->amount; ?> <?php echo $hghjn->curr; ?></b><br>
                             Статус: <b style="color: green;">Оплачено</b>
                         </div>
                         
                     </div>
                     <?php endforeach; ?>
                 <?php else: ?>
                    <br>
                    <h4 align="center">Пусто...</h4>
                 <?php endif; ?>




               </div>
            </div>
        </div>
    </div>
</div>


            <div class="mag1">
                <h3 class="logo" style=" margin-left: 70px; margin-bottom: 30px;"><i class="bi bi-gear <?php echo $color->color; ?>" style="padding: 10px; padding-left: 15px; padding-right: 15px; border-radius: 15px;"></i>&nbsp;  Настройки магазина</h3>
        <hr style="color: #FFF;">
        <div class="row" >
            <div class="col">
                <div class="block">
                    
                    <form action="/admin/" method="POST">
                        <label for="name" style="margin-bottom: 10px;">Название магазина</label><br>
                        <input type="text" name="name" required 
                        value="<?php echo $shopsettings->name; ?>"><br>
                        <label for="ip" style="margin-bottom: 10px; margin-top: 10px;">IP сервера</label><br>
                        <input type="text" name="ip" required value="<?php echo $shopsettings->ip; ?>"><br>
                        <label for="mail" style="margin-bottom: 10px; margin-top: 10px;">Почта для связи</label><br>
                        <input type="text" name="mail" required value="<?php echo $shopsettings->mail; ?>"><br>
                        <button type="submit" name="shop-settings" class="<?php echo $color->color; ?>">Применить</button>
                    </form>
                </div>
                <div class="block">
                    <form action="/admin/" method="POST">
                        <label for="login" style="margin-bottom: 10px;">Новый логин</label><br>
                        <input type="text" name="login" required ><br>
                        <label for="ip" style="margin-bottom: 10px; margin-top: 10px;">Новый пароль</label><br>
                        <input type="password" name="password" required ><br><br>
                        <button type="submit" name="set-pass" class="<?php echo $color->color; ?>">Применить</button>
                    </form>
                </div>

                <div class="block">
                    <form action="/admin/" method="POST">
                        <label for="bv" style="margin-bottom: 10px;">Включить/выключить проверочное слово для удаления блока</label><br>
                        <input type="checkbox" name="bv" class="input" <?php echo ($code->on == "on") ? "checked" : ""; ?>><br>
                        <button type="submit" name="is-delete-code" class="<?php echo $color->color; ?>">Применить</button>
                    </form>
                </div>

                <div class="block">
                    <form action="/admin/" method="POST" enctype="multipart/form-data">
                        <label for="dd" style="margin-bottom: 10px;">Изменить картинку в адресной строке</label><br>
                        <input type="file" name="file" id="file" class="inputfile" />
                        <label for="file" style="  color: white;
  outline: none;
  padding: 10px;
  padding-left: 20px;
  padding-right: 20px;
  border-radius: 15px;
  background-color: rgba( 46, 46, 46, 0.8);
  border: 0px;
  margin-top: 5px;
  cursor: pointer;
  margin-bottom: 5px;"><i class="bi bi-card-image"></i> Выбрать изображение</label>
                            <br>
                        <button type="submit" name="set-favicon" class="<?php echo $color->color; ?>">Применить</button>
                    </form>
                </div>



            </div>
            <div class="col">
                <div class="block">
                    <form action="/admin/" method="POST">
                        <label style="margin-bottom: 20px;">Выберите цвет магазина</label><br>
                        <div class="purple list1">
                            
                        </div>
                        <div class="green list1">
                            
                        </div>
                        <div class="orange list1">
                            
                        </div>
                        <div class="blue list1">
                            
                        </div>
                        <div class="red list1">
                            
                        </div><br><br>
                        <div class="yellow list1">
                            
                        </div>
                        <div class="cyan list1">
                            
                        </div>
                        <div class="pink list1">
                            
                        </div>
                        <div class="gray list1">
                            
                        </div>
                        <div>
                            <input type="radio" name="color" style="margin-top: 30px;" id="purple" value="purple" required>
                            <label for="purple">Фиолетовый</label><br>
                            <input type="radio" name="color" id="green" value="green" required>
                            <label for="green">Зеленый</label><br>
                            <input type="radio" name="color" id="orange" value="orange" required>
                            <label for="orange">Оранжевый</label><br>
                            <input type="radio" name="color" id="blue" value="blue" required>
                            <label for="blue">Синий</label><br>
                            <input type="radio" name="color" id="red" value="red" required>
                            <label for="red">Красный</label><br>
                            <input type="radio" name="color" id="yellow" value="yellow" required>
                            <label for="yellow">Желтый</label><br>
                            <input type="radio" name="color" id="cyan" value="cyan" required>
                            <label for="cyan">Бирюзовый</label><br>
                            <input type="radio" name="color" id="pink" value="pink" required>
                            <label for="pink">Розовый</label><br>
                            <input type="radio" name="color" id="gray" value="gray" required>
                            <label for="gray">Серый</label><br>
                        </div>

                        <button type="submit" name="shop-color" class="<?php echo $color->color; ?>">Применить</button>
                    </form>
                </div>

                <div class="block">
                    <form action="/admin/" method="POST">
                        <label for="is" style="margin-bottom: 10px;">Включить/выключить страницы с документами</label><br>
                        <input type="checkbox" name="is" class="input" <?php echo ($docs->on == "on") ? "checked" : ""; ?>><br>
                        <button type="submit" name="on-pages" class="<?php echo $color->color; ?>">Применить</button>
                    </form>
                </div>



                <div class="block">
                    <form action="/admin/" method="POST">
                        <label for="dd" style="margin-bottom: 10px;">Включить/выключить прелоадер</label><br>
                        <input type="checkbox" name="dd" class="input" <?php echo ($preloader->on == "on") ? "checked" : ""; ?>><br>
                        <button type="submit" name="on-preloader" class="<?php echo $color->color; ?>">Применить</button>
                    </form>
                </div>

            </div>
        </div>
            </div>

        
            <div class="onas1">
                <h3 class="logo" style="margin-top: 20px; margin-left: 70px; margin-bottom: 30px;"><i class="bi bi-person-badge <?php echo $color->color; ?>" style="padding: 10px; padding-left: 15px; padding-right: 15px; border-radius: 15px;"></i>&nbsp;  Главная страница</h3>
        <hr style="color: #FFF;">
        <div class="row" >
            <div class="col">
                <div class="block">
                    <form action="/admin/" method="POST">
                        <label for="text" style="margin-bottom: 10px;">Приветственный текст</label><br>
                        <script type="text/javascript">
                            $(function(){
                            $("#text").each(function () {
                              this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
                            }).on("input", function () {
                              this.style.height = 0;
                              this.style.height = (this.scrollHeight) + "px";
                            });
                            });
                                                    </script>
                        <textarea name="text" required id="text"><?php  
                        echo $text->text;
                    ?></textarea><br>
                        <button type="submit" name="main-text" class="<?php echo $color->color; ?>">Применить</button>
                    </form>
                </div>

            

            </div>
            <div class="col">
                <div class="block">
                    <form action="/admin/" method="POST">
                        <label for="o-nas" style="margin-bottom: 10px;">О нас</label><br>
                        <script type="text/javascript">
                            $(function(){
                            $("#text1").each(function () {
                              this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
                            }).on("input", function () {
                              this.style.height = 0;
                              this.style.height = (this.scrollHeight) + "px";
                            });
                            });
                                                    </script>
                        <textarea name="o-nas" required id="text1"><?php echo $o_nas->text; ?></textarea><br>                        <button type="submit" name="o-nas-text" class="<?php echo $color->color; ?>">Применить</button>
                    </form>
                </div>
            </div>
        </div>
            </div>



        <div class="rul1">
            <h3 class="logo" style="margin-top: 20px; margin-left: 70px; margin-bottom: 30px;"><i class="bi bi-book <?php echo $color->color; ?>" style="padding: 10px; padding-left: 15px; padding-right: 15px; border-radius: 15px;"></i>&nbsp;  Правила</h3>
        <hr style="color: #FFF;">
        <div class="row">
            <div class="row">
                <div class="col">
                    <div class="block">
                        <form action="/admin/" method="POST" >
                            
                            <label for="kategory-name" style="margin-bottom: 10px;">Заголовок</label><br>
                            <input type="text" name="kategory-name"><br>
                            <label for="kategory-text" style="margin-bottom: 10px; margin-top: 10px;">Текст</label><br>
                            <script type="text/javascript">
                            $(function(){
                            $("#text2").each(function () {
                              this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
                            }).on("input", function () {
                              this.style.height = 0;
                              this.style.height = (this.scrollHeight) + "px";
                            });
                            });
                                                    </script>
                            <textarea name="kategory-text" required id="text2"></textarea><br>
                        <button type="submit" name="rules" class="<?php echo $color->color; ?>">Создать</button>
                        </form>
                    </div>
                </div>
                <div class="col">
                    <?php foreach ($rules as $key): ?>

<div class="block">
                        <form method="POST" action="/admin/">
                            
                            <input type="text" name="rul-name" 
                            value="<?php echo $key->name; ?>"><br>
                            <script type="text/javascript">
                            $(function(){
                            $("#text<?php echo $key->id; ?>").each(function () {
                              this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
                            }).on("input", function () {
                              this.style.height = 0;
                              this.style.height = (this.scrollHeight) + "px";
                            });
                            });
                                                    </script>
                                                    
                            <textarea name="rul-text" required id="text<?php echo $key->id; ?>"><?php echo $key->text; ?></textarea><br>
                            <input type="mail" name="id" value="<?php echo $key->id; ?>" style="background-color: rgba(0, 0, 0, 0);
                                                    color:  rgba( 46, 46, 46, 0.3); border: 0px; outline: none; height: 1px; margin: 0px;"  >

                                                    <?php if ($code->on == "on"): ?>
                                                        <br><label for="kod" style="margin-bottom: 10px;">Введите слово "Код", чтобы удалить этот блок.</label><br>
                                                    <script type="text/javascript">
                                                        $(function() {
                                                            document.getElementById("isdel<?php echo $key->id; ?>").disabled = true;

                                                            $(".ada<?php echo $key->id; ?>").keyup(function(e){
                                                                if (e.target.value == "Код") {
                                                                    document.getElementById("isdel<?php echo $key->id; ?>").disabled = false;
                                                                }
                                                            });
                                                        });
                                                    </script>
                            <input type="text" name="kod" class="ada<?php echo $key->id; ?>" placeholder="Код"><br>
                        <?php endif; ?>


                        
                        <button type="submit" name="rules_prim" class="<?php echo $color->color; ?>">Применить</button>
                        <button type="submit" name="rules_del" id="isdel<?php echo $key->id; ?>" class="del-btn">Удалить</button>
                    </form>

                    </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
</div>


            <div class="d1on" id="wdwd">
                <h3 class="logo" style="margin-top: 20px; margin-left: 70px; margin-bottom: 30px;"><i class="bi bi-coin <?php echo $color->color; ?>" style="padding: 10px; padding-left: 15px; padding-right: 15px; border-radius: 15px;"></i>&nbsp;  Товары</h3>
        <hr style="color: #FFF;">
        <div class="row">
                <div class="col">
                    <div class="block">
                        <form action="/admin/" method="POST" enctype="multipart/form-data">
                            
                            <label for="donate-name" style="margin-bottom: 10px;">Название</label><br>
                            <input type="text" name="donate-name" required><br>
                            <label for="donate-price" style="margin-bottom: 10px;">Цена</label><br>
                            <input type="number" name="donate-price" required><br>
                            <label for="donate-cur" style="margin-bottom: 10px;">Валюта</label><br>
                            <select name="donate-cur" required>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="UAH">UAH</option>
                                <option value="KZT">KZT</option>
                                <option value="RUB">RUB</option>
                            </select><br>
                            <label for="donate-text" style="margin-bottom: 10px; margin-top: 10px;">Описание</label><br>
                            <script type="text/javascript">
                            $(function(){
                            $("#text4").each(function () {
                              this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
                            }).on("input", function () {
                              this.style.height = 0;
                              this.style.height = (this.scrollHeight) + "px";
                            });
                            });
                                                    </script>
                            <textarea name="donate-text" required id="text4"></textarea><br>
                            <label for="donate-cmd" style="margin-bottom: 10px;">Команда выдачи <b style="font-size:15px;">(Введите %ИГРОК% на том месте, куда надо вставить ник)</b></label><br>
                            <input type="text" name="donate-cmd" required><br>
                            <label for="donate-img" style="margin-bottom: 10px; margin-top: 10px;">Изображение <b style="font-size:15px;">(Размер: 124х128)</b></label><br>
                            <input type="file" name="file12" id="file12" class="inputfile" required />
                        <label for="file12" style="  color: white;
  outline: none;
  padding: 10px;
  padding-left: 20px;
  padding-right: 20px;
  border-radius: 15px;
  background-color: rgba( 46, 46, 46, 0.8);
  border: 0px;
  margin-top: 5px;
  cursor: pointer;
  margin-bottom: 5px;"><i class="bi bi-card-image"></i> Выбрать изображение</label>
                        <button type="submit" name="donate" class="<?php echo $color->color; ?>">Создать</button>
                        </form>
                    </div>
                </div>
                <div class="col">
                    <?php foreach ($donate as $value): ?>
<div class="block">
                        <form method="POST" action="/admin/" enctype="multipart/form-data">
                            
                            <input type="text" name="donate-name" value="<?php echo $value->name; ?>"><br>
                            <input type="number" name="donate-price" value="<?php echo $value->price; ?>"><br>
                            
                            <br><select name="donate-cur" >
                                <option value="USD" <?php echo ($value->curr == "USD") ? "selected" : ""; ?>>USD</option>
                                <option value="EUR" <?php echo ($value->curr == "EUR") ? "selected" : ""; ?>>EUR</option>
                                <option value="UAH" <?php echo ($value->curr == "UAH") ? "selected" : ""; ?>>UAH</option>
                                <option value="KZT" <?php echo ($value->curr == "KZT") ? "selected" : ""; ?>>KZT</option>
                                <option value="RUB" <?php echo ($value->curr == "RUB") ? "selected" : ""; ?>>RUB</option>
                            </select><br><br>
                            <script type="text/javascript">
                            $(function(){
                            $("#text5").each(function () {
                              this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
                            }).on("input", function () {
                              this.style.height = 0;
                              this.style.height = (this.scrollHeight) + "px";
                            });
                            });
                                                    </script>
                                                    <input type="hidden" name="id" value="<?php echo $value->id; ?>" style="background-color: rgba(0, 0, 0, 0);
                                                    color:  rgba( 46, 46, 46, 0.3); border: 0px; outline: none; height: 1px; margin: 0px;"  >
                            <textarea name="donate-opis-text"  id="text5"><?php echo $value->text; ?></textarea><br>
                            <input type="text" name="donate-cmd" value="<?php echo $value->cmd; ?>"><br>
                            <br>
                            <div class="row">
                                <?php if($value->img != NULL): ?>
                                    <div class="col">
                                      <div align="center">
                                          <img src="../img/<?php echo $value->img; ?>" style="height: 100px; margin: auto;"> 
                                      </div> 
                                    </div>
                                <?php endif; ?>
                                    <div class="col-md-8">
                                        <input type="file" name="file13<?php echo $value->id; ?>" id="file13<?php echo $value->id; ?>" class="inputfile" />
                                                                <label for="file13<?php echo $value->id; ?>" style="  color: white;
                                          outline: none;
                                          padding: 10px;
                                          padding-left: 20px;
                                          padding-right: 20px;
                                          border-radius: 15px;
                                          background-color: rgba( 46, 46, 46, 0.8);
                                          border: 0px;
                                          <?php if( $value->img != NULL): ?>
                                            margin-top: 30px;
                                        <?php else: ?>
                                            margin-top: 5px;
                                        <?php endif; ?>
                                          cursor: pointer;
                                          margin-bottom: 5px;"><i class="bi bi-card-image"></i> Изменить изображение</label>
                                    </div>
                            </div>
                            
                            <br>




                            <?php if ($code->on == "on"): ?>
                                                        <br><label for="kod" style="margin-bottom: 10px;">Введите слово "Код", чтобы удалить этот блок.</label><br>
                                                    <script type="text/javascript">
                                                        $(function() {
                                                            document.getElementById("wew<?php echo $value->id; ?>").disabled = true;

                                                            $(".ada<?php echo $value->id; ?>").keyup(function(e){
                                                                if (e.target.value == "Код") {
                                                                    document.getElementById("wew<?php echo $value->id; ?>").disabled = false;
                                                                }
                                                            });
                                                        });
                                                    </script>
                            <input type="text" name="kod" class="ada<?php echo $value->id; ?>" placeholder="Код"><br>
                        <?php endif; ?>
                        
                        <button type="submit" name="donate_prim" class="<?php echo $color->color; ?>">Применить</button>
                        <button type="submit" name="donate_del" id="wew<?php echo $value->id; ?>" class="del-btn">Удалить</button>
                        </form>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
            </div>
        
        <div class="obj">
            <div class="container">
                <h3 class="logo" style="margin-top: 20px; margin-left: 70px; margin-bottom: 30px;"><i class="bi bi-card-text <?php echo $color->color; ?>" style="padding: 10px; padding-left: 15px; padding-right: 15px; border-radius: 15px;"></i>&nbsp;  Объявление</h3>
        <hr style="color: #FFF;">
        <div class="row">
                <div class="col">
                    <div class="block">
                        <form action="/admin/" method="POST" >
                            
                            <label for="obj-text" style="margin-bottom: 10px;">Текст</label><br>
                            <input type="text" name="obj-text"><br>

                            
                        <button type="submit" name="add-obj" class="<?php echo $color->color; ?>">Написать</button>
                        </form>
                    </div>
                </div>
                <div class="col">
                    <?php foreach ($obj as $thd): ?>
                        <div class="block">
                            <p><?php echo $thd->text; ?></p>

<form action="/admin/" method="POST">
    <?php if ($code->on == "on"): ?>
                                                        <br><label for="kod" style="margin-bottom: 10px;">Введите слово "Код", чтобы удалить этот блок.</label><br>
                                                    <script type="text/javascript">
                                                        $(function() {
                                                            document.getElementById("dnh<?php echo $thd->id; ?>").disabled = true;

                                                            $(".ada<?php echo $thd->id; ?>").keyup(function(e){
                                                                if (e.target.value == "Код") {
                                                                    document.getElementById("dnh<?php echo $thd->id; ?>").disabled = false;
                                                                }
                                                            });
                                                        });
                                                    </script>
                            <input type="text" name="kod" class="ada<?php echo $thd->id; ?>" placeholder="Код"><br>
                        <?php endif; ?>

                            <button type="submit" name="obj_del" id="dnh<?php echo $thd->id; ?>" class="del-btn">Удалить</button>
</form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
            </div>
        


        <div class="m_doc">
            <div class="container">
                <h3 class="logo" style="margin-top: 20px; margin-left: 70px; margin-bottom: 30px;"><i class="bi bi-envelope-paper <?php echo $color->color; ?>" style="padding: 10px; padding-left: 15px; padding-right: 15px; border-radius: 15px;"></i>&nbsp;  Документы</h3>
        <hr style="color: #FFF;">
                <div class="row">
                    <div class="col">
                        <div class="block">
                             <form method="POST" action="/admin/">
                                 <label for="text" style="margin-bottom: 10px;">Оферта</label><br>
                        <script type="text/javascript">
                            $(function(){
                            $("#fds").each(function () {
                              this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
                            }).on("input", function () {
                              this.style.height = 0;
                              this.style.height = (this.scrollHeight) + "px";
                            });
                            });
                                                    </script>
                        <textarea name="text" required id="fds"><?php  
                        echo $oferta->text;
                    ?></textarea>
                    <button type="submit" name="oferta_prim" class="<?php echo $color->color; ?>">Применить</button>
                             </form>
                        </div>
                    </div>
                    <div class="col">
                        <div class="block">
                             <form method="POST" action="/admin/">
                                 <label for="text" style="margin-bottom: 10px;">Политика в отношении обработки персональных данных</label><br>
                        <script type="text/javascript">
                            $(function(){
                            $("#fds1").each(function () {
                              this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
                            }).on("input", function () {
                              this.style.height = 0;
                              this.style.height = (this.scrollHeight) + "px";
                            });
                            });
                                                    </script>
                        <textarea name="text" required id="fds1"><?php  
                        echo $privacy->text;
                    ?></textarea>
                    <button type="submit" name="privacy_prim" class="<?php echo $color->color; ?>">Применить</button>
                             </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<div class="rcon">
    <div class="container">
        <h3 class="logo" style="margin-top: 20px; margin-left: 70px; margin-bottom: 30px;"><i class="bi bi-terminal <?php echo $color->color; ?>" style="padding: 10px; padding-left: 15px; padding-right: 15px; border-radius: 15px;"></i>&nbsp;  Ркон</h3>
        <hr style="color: #FFF;">
        <div class="row">
             <div class="col">
                 <div class="block"> 
                     <form action="/admin/" method="POST">
                         <label for="host" style="margin-bottom: 10px;">Хост</label><br>
                        <input type="text" name="host"><br>
                        <label for="port" style="margin-bottom: 10px;">Ркон порт</label><br>
                        <input type="text" name="port"><br>
                        <label for="password" style="margin-bottom: 10px;">Пароль</label><br>
                        <input type="password" name="password"><br>
                        <button type="submit" name="add-rcon" class="<?php echo $color->color; ?>">Добавить сервер</button>
                     </form>
                 </div>
             </div>
             <div class="col">
                 <?php if($rcon): ?>
                    <iframe src="/admin/rcon" style="
    border-radius: 20px;
    margin-top: 10px;
    margin-right: auto;
    margin-left: auto;
    width: 80%;" height="420px"></iframe>
                 <?php endif; ?>
             </div>
        </div>
    </div>
</div>


<div class="promo">
    <div class="container">
        <h3 class="logo" style="margin-top: 20px; margin-left: 70px; margin-bottom: 30px;"><i class="bi bi-tags <?php echo $color->color; ?>" style="padding: 10px; padding-left: 15px; padding-right: 15px; border-radius: 15px;"></i>&nbsp;  Промокоды</h3>
        <hr style="color: #FFF;">
        <div class="row">
            <div class="col">
                 <div class="block">
                     <form action="/admin/" method="POST">
                          <label for="promo" style="margin-bottom: 10px;">Промокод</label><br>
                        <input type="text" name="promo" required><br>
                         <label for="sale" style="margin-bottom: 10px;">Скидка (в %)</label><br>
                        <input type="number" name="sale" required><br>
                        <label for="date" style="margin-bottom: 10px;">Действует до</label><br>
                        <input type="date" name="date" required><br>
                        <button type="submit" name="add_promo" class="<?php echo $color->color; ?>">Добавить промокод</button>
                     </form>
                 </div>
            </div>
            <div class="col">
                 <?php foreach($promo as $rbg): ?>
                    <div class="block">
                         <h3 class="logo"><?php echo $rbg->promo; ?></h3>
                         Скидка <?php echo $rbg->sale; ?>%<br>
                         Действует до <?php echo $rbg->date; ?>
                         <form action="/admin/" method="POST">
                             <?php if ($code->on == "on"): ?>
                                                        <br><label for="kod" style="margin-bottom: 10px;">Введите слово "Код", чтобы удалить этот блок.</label><br>
                                                    <script type="text/javascript">
                                                        $(function() {
                                                            document.getElementById("dnh53<?php echo $rbg->id; ?>").disabled = true;

                                                            $(".ada53<?php echo $rbg->id; ?>").keyup(function(e){
                                                                if (e.target.value == "Код") {
                                                                    document.getElementById("dnh53<?php echo $rbg->id; ?>").disabled = false;
                                                                }
                                                            });
                                                        });
                                                    </script>
                            <input type="text" name="kod" class="ada53<?php echo $thd->id; ?>" placeholder="Код"><br>
                        <?php endif; ?>
                            <input type="hidden" name="id" value="<?php echo $rbg->id; ?>">
                            <button type="submit" name="promo_del" id="dnh53<?php echo $rbg->id; ?>" class="del-btn">Удалить</button>
                         </form>
                    </div>
                 <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>



<div class="links">
    <div class="container">
        <h3 class="logo" style="margin-top: 20px; margin-left: 70px; margin-bottom: 30px;"><i class="bi bi-box-arrow-up-right <?php echo $color->color; ?>" style="padding: 10px; padding-left: 15px; padding-right: 15px; border-radius: 15px;"></i>&nbsp;  Ссылки</h3>
        <hr style="color: #FFF;">
        <div class="row">
            <div class="col">
                <div class="block">
                    <form action="/admin/" method="POST">
                        <label for="title" style="margin-bottom: 10px;">Текст</label><br>
                        <input type="text" name="title" required><br>
                        <label for="link" style="margin-bottom: 10px;">Адресс </label><br>
                        <input type="text" name="link" required><br>
                        <label for="color" style="margin-bottom: 10px;">Цвет </label><br>
                        <input type="color" name="color" required style="height: 50px;"><br>
                        <button type="submit" name="add-link" class="<?php echo $color->color; ?>">Добавить ссылку</button>
                    </form>
                </div>
            </div>
            <div class="col">
                <?php foreach($links as $libk): ?>
                    <div class="block">
                        <form action="/admin/" method="POST">
                            <input type="text" name="title" value="<?php echo $libk->title; ?>" required><br>
                            <input type="text" name="link" value="<?php echo $libk->link; ?>" required><br>
                            <input type="color" name="color" value="<?php echo $libk->color; ?>" required style="height: 50px;"><br>
                            <input type="hidden" name="id" value="<?php echo $libk->id; ?>">

                            <?php if ($code->on == "on"): ?>
                                                        <br><label for="kod" style="margin-bottom: 10px;">Введите слово "Код", чтобы удалить этот блок.</label><br>
                                                    <script type="text/javascript">
                                                        $(function() {
                                                            document.getElementById("wewnn<?php echo $libk->id; ?>").disabled = true;

                                                            $(".adann<?php echo $libk->id; ?>").keyup(function(e){
                                                                if (e.target.value == "Код") {
                                                                    document.getElementById("wewnn<?php echo $libk->id; ?>").disabled = false;
                                                                }
                                                            });
                                                        });
                                                    </script>
                            <input type="text" name="kod" class="adann<?php echo $libk->id; ?>" placeholder="Код"><br>
                        <?php endif; ?>



                            <button type="submit" name="set-link" class="<?php echo $color->color; ?>">Применить</button>
                            <button type="submit" name="del-link" id="wewnn<?php echo $libk->id; ?>" class="del-btn">Удалить</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>



<div class="paymants">
    <div class="container">
        <h3 class="logo" style="margin-top: 20px; margin-left: 70px; margin-bottom: 30px;"><i class="bi bi-credit-card <?php echo $color->color; ?>" style="padding: 10px; padding-left: 15px; padding-right: 15px; border-radius: 15px;"></i>&nbsp;  Платежные системы</h3>
        <hr style="color: #FFF;">
        
        <div class="row">
            <div class="col">
                <div align="center"><img src="img/free.jpg" style="border-top-left-radius: 20px; border-top-right-radius: 20px; margin-bottom: 0px; width: 500px; height: 150px; margin-left: auto; margin-right: auto;"></div>
                <div class="block" style="border-top-left-radius: 0px; border-top-right-radius: 0px; margin-top:0px; margin-bottom:20px;">
                    <form action="/admin/" method="POST">
                        <label for="shop_id" style="margin-bottom: 10px;">Айди магазина</label><br>
                        <input type="number" name="shop_id" required placeholder="12345"><br>
                        <label for="word" style="margin-bottom: 10px;">Секретное слово 1</label><br>
                        <input type="password" name="word" required placeholder="***********"><br>
                        <label for="word2" style="margin-bottom: 10px;">Секретное слово 2</label><br>
                        <input type="password" name="word2" required placeholder="***********"><br>
                        <button type="submit" name="set-freekassa" class="<?php echo $color->color; ?>">Применить</button>
                    </form>
                </div>
            </div>
            <div class="col">
                <?php if (isset($freekassa)): ?>
                    <div class="block">
                        <h3 class="logo" style="color: #b30048;">FREEKASSA</h3><br>
                        <form action="/admin/" method="POST">
                            <input type="number" name="shop_id" value="<?php echo $freekassa->shop_id; ?>"><br>
                        <input type="password" name="word" value="<?php echo $freekassa->word; ?>"><br>
                        <input type="password" name="word2" value="<?php echo $freekassa->word2; ?>"><br>

                                                        <br><label for="kod" style="margin-bottom: 10px;">Введите слово "FreeKassa", чтобы удалить этот способ оплаты.</label><br>
                                                    <script type="text/javascript">
                                                        $(function() {
                                                            document.getElementById("dfbbre").disabled = true;

                                                            $(".dzdnht6r").keyup(function(e){
                                                                if (e.target.value == "FreeKassa") {
                                                                    document.getElementById("dfbbre").disabled = false;
                                                                }
                                                            });
                                                        });
                                                    </script>
                            <input type="text" name="kod" class="dzdnht6r" placeholder="FreeKassa"><br>

                        <button type="submit" name="set-new-freekassa" class="<?php echo $color->color; ?>">Применить</button>
                        <button type="submit" name="del-freekassa" id="dfbbre" class="del-btn">Удалить</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
            
    </div>
</div>


<div class="statitic">
    <div class="container">
        <h3 class="logo" style="margin-top: 20px; margin-left: 70px; margin-bottom: 30px;"><i class="bi bi-display <?php echo $color->color; ?>" style="padding: 10px; padding-left: 15px; padding-right: 15px; border-radius: 15px;"></i>&nbsp;  Статические станицы</h3>
        <hr style="color: #FFF;">
        <div class="row">
            <div class="col">
                <div class="block">
                    <form action="/admin/" method="POST">
                        <label for="name" style="margin-bottom: 10px;">Ссылка на страницу (без /)</label><br>
                        <input type="text" name="name" required><br>
                        <label for="title" style="margin-bottom: 10px;">Название страницы (в меню)</label><br>
                        <input type="text" name="title" required><br>
                        <label for="page" style="margin-bottom: 10px;">Файл</label><br>
                        <select name="page" required>
                            <option value="1" <?php $page1 = R::findOne('static', 'page = ?', ['1']); $count = R::count('static');
                             if (isset($page1)) {
                                echo "disabled";
                            } ?>>static1.php</option>
                            <option value="2" <?php $page1 = R::findOne('static', 'page = ?', ['2']);
                             if (isset($page1)) {
                                echo "disabled";
                            } ?>>static2.php</option>
                            <option value="3" <?php $page1 = R::findOne('static', 'page = ?', ['3']);
                             if (isset($page1)) {
                                echo "disabled";
                            } ?>>static3.php</option>
                        </select>
                        <?php if ($count == 3): ?>
                        <br><br>
                        Все страницы уже созданы.
                    <?php else: ?>
                        
                        <button type="submit" name="add-page" class="<?php echo $color->color; ?>">Добавить страницу</button>
                    <?php endif; ?>
                    </form>
                </div>
                <div class="block">
                    <h5>Создано страниц: <span><?php echo $count; ?></span>/3</h5>
                </div>
            </div>
            <div class="col">
                <?php foreach($pages as $ofdn): ?>
                    <div class="block">
                        Путь: /<?php echo $ofdn->name; ?> (<a style="color:white; text-decoration: underline;" href="/<?php echo $ofdn->name; ?>" target="_blank">Перейти</a>)<br>
                        Файл: static<?php echo $ofdn->page; ?>.php
                        <form action="/admin/" method="POST">
                            <input type="hidden" name="id" value="<?php echo $ofdn->id; ?>">
                            <button type="submit" name="del-page" id="dfbbre" class="del-btn">Удалить</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>



</div>
    </div>
   </div>

</body>
</html>