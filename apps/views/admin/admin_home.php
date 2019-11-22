<div class="container">
     
<strong>AdminID:</strong>  <?=$_SESSION['ses_admin_id']?> <br>
<strong>Admin Name:</strong> <?=$_SESSION['ses_admin_name']?> <br>
 <br>
<?php
$query = $this->db->get("tbl_customer");
 
$total = $query->num_rows();  // จำนวนข้อมูลจากการคิวรี่ทั้งหมด
if($total>0){ // เช็คว่ามีค่ามากว่า 0 หรือไม่
    foreach ($query->result_array() as $row)  // วนลูปแสดงข้อมูล
    {
            echo $row['cus_id'];
            echo $row['cus_name'];
            echo "<br>";
    }
}
?>


</div>
