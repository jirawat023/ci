<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1">      
    <title><?=$title?></title>  
    <link rel="stylesheet" href="<?=base_url('css/bootstrap/css/bootstrap.min.css')?>">  
    <script src="<?=base_url('js/jquery-1.11.3.min.js')?>"></script>      
    <script src="<?=base_url('css/bootstrap/js/bootstrap.min.js')?>"></script>  
</head>  
<body>  
<nav class="navbar navbar-inverse">  
  <div class="container-fluid">  
    <!-- Brand and toggle get grouped for better mobile display -->  
    <div class="navbar-header">  
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">  
        <span class="sr-only">Toggle navigation</span>  
        <span class="icon-bar"></span>  
        <span class="icon-bar"></span>  
        <span class="icon-bar"></span>  
      </button>  
      <a class="navbar-brand" href="<?=base_url('admin')?>">Admin</a>  
    </div>  
   
   
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
      <ul class="nav navbar-nav">  
        <li><a href="<?=base_url('admin')?>">Home</a></li>  
        <?php if(isset($_SESSION['ses_admin_id']) && $_SESSION['ses_admin_id']!=""){?>
         <li><a href="<?=base_url('admin/logout')?>">Logout</a></li>  
         <?php } ?>
      </ul>  
       
    </div>  
  </div>  
</nav>