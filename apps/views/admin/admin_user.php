<div class="container">
     
Admin User
<br><br>
<?php if($action==null){?>
<a href="<?=base_url('admin/user/create')?>" class="btn btn-primary btn-sm">Create</a>
<br><br>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th width="50" class="text-center">#</th>
            <th>Name</th>
            <th width="150" class="text-center">Last Login</th>
            <th width="150" class="text-center">Manage</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i_num=0;
        $query = $this->db->query("SELECT * FROM tbl_admin");
        foreach ($query->result_array() as $row){
            $i_num++;
        ?>
        <tr>
            <td class="text-center"><?=$i_num?></td>
            <td><?=$row['admin_name']?></td>
            <td class="text-center"><?=$row['admin_adddate']?></td>
            <td class="text-center">
                <a href="<?=base_url('admin/user/edit/'.$row['admin_id'])?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                &nbsp;&nbsp;
                 <a href="<?=base_url('admin/user/delete/'.$row['admin_id'])?>" class="btn btn-danger btn-sm">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
                 
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>
 
<?php if($action=="create"){?>
<?php
if(isset($_POST['btn_add']) && $_POST['btn_add']!=""){
    $p_username = $this->input->post('username');
    $p_password = $this->input->post('password');
    $v_adddate = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tbl_admin (
        admin_id,
        admin_name,
        admin_pass,
        admin_adddate
    ) VALUES (
        NULL,
        ".$this->db->escape($p_username).",
        ".$this->db->escape($p_password).",
        ".$this->db->escape($v_adddate)."
    )";
    if($this->db->query($sql)){  // เมื่อเพิ่มข้อมูลแล้ว
        redirect('admin/user'); // ไปหน้า user
    }  
}
?>
<a href="<?=base_url('admin/user')?>" class="btn btn-warning btn-sm">< Back</a>
<br><br>
<form action="<?=base_url('admin/user/create')?>" method="post">
<table class="table table-bordered">
<thead>
    <tr class="active">
        <th colspan="2">Create User</th>
    </tr>
</thead>
<tbody>
    <tr >
        <th width="120">Username:</th>
        <td>
            <input type="text" name="username">
        </td>
    </tr>
    <tr>
        <th width="120">Password:</th>
        <td>
        <input type="password" name="password" >
        </td>
    </tr>    
    <tr>
        <th></th>
        <td>
            <input type="submit" class="btn btn-success btn-sm" name="btn_add" value="Add User">
        </td>
    </tr>
</tbody>
</table>    
     
 
         
</form>
<?php } ?>
 
 
<?php if($action=="edit"){?>
<?php
// เมื่อส่งข้อมูลฟอร์มเพื่อแก้ไขข้อมูล
if(isset($_POST['btn_edit']) && $_POST['btn_edit']!=""){
    $p_username = $this->input->post('username');
    $p_password = $this->input->post('password');
    $sql = "UPDATE tbl_admin SET
    admin_name = ".$this->db->escape($p_username).",
    admin_pass = ".$this->db->escape($p_password)."
    WHERE admin_id=".$this->db->escape($id);
    if($this->db->query($sql)){  // เมื่อเพิ่มข้อมูลแล้ว
        redirect('admin/user'); // ไปหน้า user
    }  
}
// แสดงข้อมูลของสมาชิกนั้นๆ ก่อนแก้ไข อ้างอิงจากตัวแปร $id 
$query = $this->db->query("SELECT * FROM tbl_admin WHERE admin_id=".$this->db->escape($id));
$row = $query->row_array();
?>
<a href="<?=base_url('admin/user')?>" class="btn btn-warning btn-sm">< Back</a>
<br><br>
<form action="<?=base_url('admin/user/edit/'.$id)?>" method="post">
<table class="table table-bordered">
<thead>
    <tr class="active">
        <th colspan="2">Edit User</th>
    </tr>
</thead>
<tbody>
    <tr >
        <th width="120">Username:</th>
        <td>
            <input type="text" name="username" value="<?=$row['admin_name']?>">
        </td>
    </tr>
    <tr>
        <th width="120">Password:</th>
        <td>
        <input type="password" name="password" value="<?=$row['admin_pass']?>">
        </td>
    </tr>    
    <tr>
        <th></th>
        <td>
            <input type="submit" class="btn btn-success btn-sm" name="btn_edit" value="Edit User">
        </td>
    </tr>
</tbody>
</table>    
     
 
         
</form>
<?php } ?>
 
<?php if($action=="delete"){?>
 
 <a href="<?=base_url('admin/user')?>" class="btn btn-warning btn-sm">< Back</a>
 <br><br>
 <?php
 if($id){
     $sql = "DELETE FROM tbl_admin WHERE admin_id='".$this->db->escape($id)."' ";
     if($this->db->query($sql)){
 }
 ?>
 <div class="bg-success text-center" style="padding:10px;">
     <p class="text-success">Delete data completed</p>
     <a href="<?=base_url('admin/user')?>" class="text-success">< Back > </a>
 </div>
     <?php } ?>
 <?php } ?>
  
 </div>