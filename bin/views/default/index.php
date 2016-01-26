<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <script src="http://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="http://www.game.dev/bin/views/default/js/bootstrap.min.js"></script>

    
    <link rel="stylesheet" href="http://www.game.dev/bin/views/default/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://www.game.dev/bin/views/default/css/bootstrap-theme.min.css">
    
    <link rel="stylesheet" href="http://www.game.dev/bin/views/default/css/style.css">
    
    <script src="/bin/views/default/js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            relative_urls: false
        });
    </script>

</head>

<body>

<div class="body col-lg-12">   

</div>
    
<div class="container content col-lg-12">

    
<div class="col-lg-12" name="horizontal_menu">    
<br>     
<div class="col-md-12">       
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/main">MyBrand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/counter">Счетчик</a></li>
        <li><a href="/users">Пользователи</a></li>
        <li><a href="/main/logout">Выход</a></li>
      </ul>
      <?php echo render::get_content('search')?>
        <?php echo render::get_content('sort')?>
        <?php //echo render::get_val('reg')?>
        <?php echo render::get_content('reg')?>
        <?php echo render::get_content('auth')?>
        
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 </div>
    
    </div>
    <div class="navbar-margin"></div>
    
    <div class="col-md-12" name="messages"> 
         <?php echo messages::show_message()?>
    </div>
    
    <div class="col-md-12" name="content">
        
        <div class="col-md-9" name="center_col">  
            <?php echo render::get_content('content')?>
            <?php echo render::get_content('content1')?>
            <?php echo render::get_content('content2')?>
            
            <?php //var_dump(render::get_val('ref'))?>
        </div>
        
    </div>
    
    <div class="col-md-12 footer" name="footer">
        
    </div>

</div>
 



</body>
</html>