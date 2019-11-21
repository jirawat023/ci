<div class="container">
    <br>
    <br>
    <br>
<form action="<?=base_url('admin/login')?>" method="post">
<?php
    $ck_username=get_cookie('ck_username');    
    $ck_password=get_cookie('ck_password');
    $ck_remember=get_cookie('ck_remember');
// หรือถ้าเรียกใช้งานแบบทั่วไปก็จะประมาณนี้
//    $ck_username=(isset($_COOKIE['ck_username']))?$_COOKIE['ck_username']:null;
//    $ck_password=(isset($_COOKIE['ck_password']))?$_COOKIE['ck_password']:null;
//    $ck_remember=(isset($_COOKIE['ck_remember']))?$_COOKIE['ck_remember']:null;
?>    
<div class="bg-warning" style="padding:10px;max-width:400px;margin:auto;">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" class="form-control" placeholder="Username"  value="<?=$ck_username?>">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" value="<?=$ck_password?>">
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="remember_check" <?=(isset($ck_remember))?" checked":""?> > Remember?
    </label>
  </div>  
  <button type="submit" name="btn_login" class="btn btn-primary">Login</button>
</div>
         
</form>
 
</div>