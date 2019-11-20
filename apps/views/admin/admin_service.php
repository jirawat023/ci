<div class="container">
     
Service  
<br><br>
<?php if($action==null){?>
<?php
$result = $this->service_model->getlist();
?>
<a href="<?=base_url('admin/service/create')?>" class="btn btn-primary btn-sm">Create</a>
<br><br>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th width="50" class="text-center">#</th>
            <th>Title</th>
            <th width="150" class="text-center">Modify Date</th>
            <th width="150" class="text-center">Manage</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i_num=0;
        if(count($result)>0){
            foreach($result as $row){
                $i_num++;
        ?>
        <tr>
            <td class="text-center"><?=$i_num?></td>
            <td><?=$row['service_title']?></td>
            <td class="text-center"><?=$row['service_update']?></td>
            <td class="text-center">
                <a href="<?=base_url('admin/service/edit/'.$row['service_id'])?>" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                &nbsp;&nbsp;
                 <a href="<?=base_url('admin/service/delete/'.$row['service_id'])?>" class="btn btn-danger btn-sm">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
                 
            </td>
        </tr>
        <?php } ?>
        <?php } ?>
    </tbody>
</table>
<?php } ?>
 
<?php if($action=="create"){?>
<a href="<?=base_url('admin/service')?>" class="btn btn-warning btn-sm">< Back</a>
<br><br>
<?php
$this->form_validation->set_rules('service_title', 'Title', 'required');
$this->form_validation->set_rules('service_detail', 'Detail', 'required');
 
if($this->form_validation->run() === FALSE){ // ถ้าตรวจสอบไม่ผ่าน ให้ทำงาน
//    echo "Error";
}else{  // กรณีตรวจสอบผ่าน
    $query = $this->service_model->create();
    if($query){ // เมื่อเพิ่มข้อมูลเรียบร้อยแล้ว
        redirect('admin/service'); // ไปหน้า service  
    }
}
                             
if(validation_errors()){ // ถ้ามีเงื่อนไขหนึ่งใดไม่ผ่าน ให้แสดง ข้อความ error ตำแหน่งนี้
    echo   validation_errors();
    echo "<br>";
}                           
if($this->upload->display_errors()){
    echo $this->upload->display_errors('<div class="bg-danger" style="padding:3px 10px;">', '</div>');
    echo "<br>";    
}
?>
<form action="<?=base_url('admin/service/create')?>" method="post" enctype="multipart/form-data">
<table class="table table-bordered">
<thead>
    <tr class="active">
        <th colspan="2">Add New Service</th>
    </tr>
</thead>
<tbody>
    <tr >
        <th width="120">Title:</th>
        <td>
            <input type="text" name="service_title" value="<?=set_value('service_title')?>" style="width:500px;">
        </td>
    </tr>
    <tr>
        <th width="120">Detail:</th>
        <td>
        <textarea name="service_detail" cols="85" rows="10"><?=set_value('service_detail')?></textarea>
        </td>
    </tr>    
    <tr>
        <th width="120">Images:</th>
        <td>
        <input type="file" name="service_image" >
        </td>
    </tr>    
    <tr>
        <th></th>
        <td>
            <input type="submit" class="btn btn-success btn-sm" name="btn_add" value="Add Service">
        </td>
    </tr>
</tbody>
</table>    
     
 
</form>
<?php } ?>
 
<?php if($action=="edit"){?>
<a href="<?=base_url('admin/service')?>" class="btn btn-warning btn-sm">< Back</a>
<br><br>
<?php
$this->form_validation->set_rules('service_title', 'Title', 'required');
$this->form_validation->set_rules('service_detail', 'Detail', 'required');
 
if($this->form_validation->run() === FALSE){ // ถ้าตรวจสอบไม่ผ่าน ให้ทำงาน
//    echo "Error";
}else{  // กรณีตรวจสอบผ่าน
    $query = $this->service_model->edit($id);
    if($query){ // เมื่อแก้ไขข้อมูลเรียบร้อยแล้ว
        redirect('admin/service'); // ไปหน้า service  
    }
}
                             
if(validation_errors()){ // ถ้ามีเงื่อนไขหนึ่งใดไม่ผ่าน ให้แสดง ข้อความ error ตำแหน่งนี้
    echo   validation_errors();
    echo "<br>";
}
if($this->upload->display_errors()){
    echo $this->upload->display_errors('<div class="bg-danger" style="padding:3px 10px;">', '</div>');
    echo "<br>";    
}
// เรียกใช้ฟังก์ชั่น view() ดึงข้อมูลมาแสดงก่อนแก้ไข    
$row = $this->service_model->view($id);             
?>
<form action="<?=base_url('admin/service/edit/'.$id)?>" method="post" enctype="multipart/form-data">
<table class="table table-bordered">
<thead>
    <tr class="active">
        <th colspan="2">Edit Service</th>
    </tr>
</thead>
<tbody>
    <tr >
        <th width="120">Title:</th>
        <td>
            <input type="text" name="service_title" value="<?=$row['service_title']?>" style="width:500px;">
        </td>
    </tr>
    <tr>
        <th width="120">Detail:</th>
        <td>
        <textarea name="service_detail" cols="85" rows="10"><?=$row['service_detail']?></textarea>
        </td>
    </tr>    
    <tr>
        <th width="120">Images:</th>
        <td>
        <input type="file" name="service_image" >
        <input type="hidden" name="h_service_image" value="<?=$row['service_img']?>">
        </td>
    </tr>    
    <tr>
        <th></th>
        <td>
            <input type="submit" class="btn btn-success btn-sm" name="btn_add" value="Edit Service">
        </td>
    </tr>
</tbody>
</table>   
 
         
</form>
<?php } ?>
 
<?php if($action=="delete"){?>
<?php
$query = $this->service_model->delete($id);                                  
?>
<a href="<?=base_url('admin/service')?>" class="btn btn-warning btn-sm">< Back</a>
<br><br>
<?php if($query){?>
<div class="bg-success text-center" style="padding:10px;">
    <p class="text-success">Delete data complete</p>
    <a href="<?=base_url('admin/service')?>" class="text-success">< Back > </a>
</div>
<?php } ?>
<?php } ?>
 
</div>