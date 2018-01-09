<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap  Template</title>

    <!-- Bootstrap -->
    <link href="<?=URLROOT?>Media/css/bootstrap.css" rel="stylesheet">
    <link href="<?=URLROOT?>Media/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=URLROOT?>Media/css/style.css">
    <?=$style?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="navbar navbar-inverse navbar-static-top">
      <div class="container">
      
          <a href="<?=URLROOT?>" class="btn btn-success">
              Главная
          </a>
          <a href="<?=URLROOT?>videos" class="btn btn-primary">
              Все видео
          </a>
        <?php if(!$auth):?>
          <form action="<?=URLROOT?>api/login" method="post" class="navbar-form navbar-right">
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="login" name="login" value="">
              </div>
              <div class="form-group">
                  <input type="password" class="form-control"  placeholder="pass" name="pass" value="">
              </div>
              <button type="submit" class="btn btn-primary">
                  <i class="fa fa-sign-in"></i> ENTER
              </button>
          </form>

            <a href="<?=URLROOT?>main/register" class="btn btn-success">
                Регистарция
            </a>

          <?php else:?>


            <a href="<?=URLROOT?>videos/add" class="btn btn-success">
                Добавить видео
            </a>
            <span class="cls">
             <?php if($auth):?>
              <span style="color: #ffffff;">Привет, <?=strtoupper ($user["login"])?></span>
              <?php endif;?>&nbsp
            <a href="<?=URLROOT?>videos/myvideo" class="btn btn-primary">
                Мои видео
            </a>
                 <a href="<?=URLROOT?>api/logout" class="btn btn-danger">
                 <i class="fa fa-sign-in"></i> Выйти
            </a>
            </span>

          <?php endif;?>


      </div>
  </div>
  <div class="container">
    <?=$content?>
  </div>

                
    
    
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=URLROOT?>Media/js/bootstrap.js"></script>
    <script src="<?=URLROOT?>Media/js/salvattore.min.js"></script>

  </body>
   </html>