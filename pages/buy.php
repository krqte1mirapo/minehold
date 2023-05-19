<?php

require 'db.php';

$shopsettings = R::findOne('shopsettings', ' id = ? ', [ '1' ]);
$color = R::findOne('color', ' id = ? ', [ '1' ]);

$donate = R::findOne('donate', ' id = ? ', [$_GET['id']]);

$obj = R::findOne('obj', ' id = ? ', [ '1' ]);

$promo = R::findAll('promo');

?>
<!DOCTYPE html>
<html>
<head>

<!-- Менять тут -->
  <title>Донат</title>

  <link href="css/style.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/18d0e7723d.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <link rel="shortcut icon" href="img/favicon.png" type="image/png">

</head>
<body class="bg" style="color: white;">

<div style="margin: 30px;">
  <div class="buy1 <?php  echo $color->color; ?>">
            <div class="row">
              <?php if ($donate->img != NULL): ?>
              <div class="col">
                <div style="margin:auto; height: 95%; width: 95%;">
                  
                    <div align="center">
                      <img src="img/<?php echo $donate->img; ?>" style="height: 90px; margin: auto;">
                    </div>
                  
                </div>
              </div>
              <?php endif; ?>
              <div class="col-md-10">
                <h1><strong class="donate-name"><?php echo $donate->name; ?></strong></h1>
                <p class="donate-price"><?php echo $donate->price; ?> <?php
                if ($donate->curr == "USD") {
                  echo '<i class="fa-solid fa-dollar-sign"></i>';
                } if ($donate->curr == "EUR") {
                  echo '<i class="fa-solid fa-euro-sign"></i>';
                } if ($donate->curr == "UAH") {
                  echo '<i class="fa-solid fa-hryvnia-sign"></i>';
                } if ($donate->curr == "KZT") {
                  echo '<i class="fa-solid fa-tenge-sign"></i>';
                } if ($donate->curr == "RUB") {
                  echo '<i class="fa-solid fa-ruble-sign"></i>';
                }

              ?></p>
              </div> 
            </div>
          </div>
<!-- Менять тут -->
          <div class="buy">
            <?php if ($obj): ?>
              <div class="pass" role="alert">
  <i class="fa-sharp fa-solid fa-circle-exclamation"></i> <?php echo $obj->text; ?>
</div>
            <?php endif; ?>
            <p class="donate-text" ><?php echo nl2br($donate->text); ?></p>
            <!-- <button class="go">Описание доната</button> -->
            <h3>Введите данные</h3>
            <form method="POST" action="/pay">
              <label style="margin-top: 0px;"><i class="fa-solid fa-user"></i> Ник</label><br>
              <input type="text" name="nick" placeholder="Введите ваш ник" required><br>
              <label><i class="fa-solid fa-tag"></i> Промокод</label><br>
              <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
              <input type="text" id="promo" name="promo" placeholder="Введите промокод (если есть)"><br>
              <span id="text-result"></span><br>
              <span style="cursor: pointer; transition: 0.35s;" id="paycheck"><i class="fa-solid fa-receipt"></i> Нажмите, если нужен чек</span><br>

              <div class="email">
                <br>
                <label style="margin-top: 0px;"><i class="fa-solid fa-envelopes-bulk"></i> Почта</label><br>
                <input type="email" name="mail" placeholder="Введите вашу почту" ><br>
              </div>


              <style type="text/css">
                #paycheck:hover {
                  color: #ccc;
                }
              </style>
              <script type="text/javascript">
                $(function() {
                  let numOfClicks = 0;
                  $(".email").hide();
                  $("#paycheck").click(function(){
                      $(".email").show();
                      ++numOfClicks;
                      if(numOfClicks % 2 !== 0) $(".email").show();
                      else $(".email").hide();
                  });


                  $("#promo").keyup(function () {
                    var val =$(this).val();
                      
                    <?php 
                    $d = false;
                    foreach ($promo as $key) {
                      
                      if ($key->date >= date("Y-m-d")) {
                        echo 'if (val == "'.$key->promo.'") {
                        $("#text-result").html("<br>Промокод активирован. Скидка '.$key->sale.'%<br>");
                        $("#text-result").css("color", "green");
                        document.getElementById("buyg").disabled = false; 
                      }';
                      $d = true;
                      } 
                    }

                    ?><?php if($d == true): ?> 
                        else 
                        <?php else: ?>
                          if (val != "")
                          <?php endif; ?>{
                        $("#text-result").html("<br>Промокод не найден<br>");
                        $("#text-result").css('color', 'red');
                        document.getElementById("buyg").disabled = true; 
                      }



                        if (val == "") {
document.getElementById("buyg").disabled = false; 
$("#text-result").html("");
                      } 
 
                  });
                });
              </script>
              <button type="submit" id="buyg" formtarget="_parent">Купить</button>
            </form>
          </div>
</div>

</body>
</html>