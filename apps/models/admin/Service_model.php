<?php
class Service_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="bg-danger" style="padding:3px 10px;">', '</div>');
        $this->load->library('upload');
        $this->load->helper('path');
        $this->load->library('pagination');
    }
     
    public function getlist($id,$query_str=null){
         
        $config['base_url'] = base_url('admin/service/page/'); // url  เพจข้อมูลของเรา      
        $config['per_page'] = 5;  // จำนวนแสดงต่อหน้า
        $config['num_links'] = 2; // จำนวนเลขซ้ายขวา เช่น 1 2 3 4 5 คือหน้า 2 หลัง 2
        $config['use_page_numbers'] = TRUE;  // แสดงเลขหน้าตามจริง เช่นหน้า 1 ก็เป็นเลข 1
        // ส่วนของการกำหนดหน้าตาของ การแบ่งหน้า เนื่องจากเราใช้ bootstrap css จึงสามารถนำมาใช้ได้เลย
        $config['full_tag_open'] = '<nav><ul class="pagination">'; // เปิดแท็กทั้งหมด
        $config['full_tag_close'] = '</ul><nav>'; // ปิดแท็กทั้งหมดด้วย
        $config['first_link'] = 'First'; // ข้อความแสดงหน้าแรก
        $config['first_tag_open'] = '<li>'; // แท็กเปิดข้อความหน้าแรก
        $config['first_tag_close'] = '</li>'; // แท็กปิดข้อความหน้าแรก
        $config['first_url'] = '';  //url หน้าแรก
        $config['last_link'] = 'Last'; // ข้อความสแดงหน้าสุดท้าย
        $config['last_tag_open'] = '<li>';  // แท็กเปิดข้อความหน้าสุดท้าย
        $config['last_tag_close'] = '</li>'; // แท็กปิดข้อความหน้าสุดท้าย
        $config['next_link'] = '&gt;';  // ข้อความหน้าก่อนหน้า ในที่นี้ใช้สัญลักษณ์ <
        $config['next_tag_open'] = '<li>';  // แท็กเปิดข้อความแสดงหน้าก่อนหน้า
        $config['next_tag_close'] = '</li>'; // แท็กปิดข้อความแสดงหน้าก่อนหน้า
        $config['prev_link'] = '&lt;';  // ข้อความหน้าถัดไป ในที่นี้ใช้สัญลักษณ์ >
        $config['prev_tag_open'] = '<li>'; // แท็กเปิดข้อความหน้าถัดไป
        $config['prev_tag_close'] = '</li>';  // แท็กปิดข้อความหน้าถัดไป
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void();">'; // แท็กหน้าเลขเพจปัจจุบัน
        $config['cur_tag_close'] = '</a></li>'; // แท้กปิดหน้าเพจปัจจุบัน
        $config['num_tag_open'] = '<li>'; // แท็กเปิดหน้าเพจเลขต่างๆ
        $config['num_tag_close'] = '</li>';  // แท็ปิดหน้าเพจเลขต่างๆ
        $config['reuse_query_string'] = TRUE;
         
        if(isset($query_str['keyword']) && $query_str['keyword']!=""){
            $this->db->like('service_title',$query_str['keyword'] );
        }
        $config['total_rows'] =  $this->db->count_all_results('tbl_service',FALSE);
        $this->pagination->initialize($config);  // ตั้งค่าการกำหนด การแบ่งหน้า        
         
        $begin=(isset($id) && $id>1)?($id-1)*$config['per_page']:0;
        $this->db->limit($config['per_page'], $begin);
        $query = $this->db->get();
        return $query->result_array();
    }     
     
    public function create(){
        $config['upload_path'] = './upload/';  // โฟลเดอร์ ตำแหน่งเดียวกับ root ของโปรเจ็ค
        $config['allowed_types'] = 'gif|jpg|png'; // ปรเเภทไฟล์ 
        $config['max_size']     = '0';  // ขนาดไฟล์ (kb)  0 คือไม่จำกัด ขึ้นกับกำหนดใน php.ini ปกติไม่เกิน 2MB
        $config['max_width'] = '1024';  // ความกว้างรูปไม่เกิน
        $config['max_height'] = '768'; // ความสูงรูปไม่เกิน
        $config['file_name'] = 'mypicture';  // ชื่อไฟล์ ถ้าไม่กำหนดจะเป็นตามชื่อเพิม
 
        $this->upload->initialize($config);    // เรียกใช้การตั้งค่า  
        $this->upload->do_upload('service_image'); // ทำการอัพโหลดไฟล์จาก input file ชื่อ service_image
         
        $file_upload="";  // กำหนดชื่อไฟล์เป็นค่าว่าง 
        if(!$this->upload->display_errors()){ // ถ้าไม่มี error อัพไฟล์ได้ ให้เอาใช้ไฟล์ใส่ตัวแปร ไว้บันทึกลงฐานข้อมูล
            $file_upload=$this->upload->data('file_name');
        }
        $newdata = array(
            'service_id' => NULL,
            'service_title' => $this->input->post('service_title'),
            'service_detail' => $this->input->post('service_detail'),
            'service_img' => $file_upload,
            'service_update' => date("Y-m-d H:i:s")
        );
        return $this->db->insert('tbl_service', $newdata);                
    }
     
    public function view($id){  // มี $id เป็น parameter ไว้กำหนดเงื่อนไข
        $query = $this->db->get_where('tbl_service',array('service_id'=>$id));
        return $query->row_array(); // ส่งข้อมูลผลัพธ์กลับเป็น array แถวข้อมูล
    }    
     
    public function edit($id){
        $config['upload_path'] = './upload/';  // โฟลเดอร์ ตำแหน่งเดียวกับ root ของโปรเจ็ค
        $config['allowed_types'] = 'gif|jpg|png'; // ปรเเภทไฟล์ 
        $config['max_size']     = '0';  // ขนาดไฟล์ (kb)  0 คือไม่จำกัด ขึ้นกับกำหนดใน php.ini ปกติไม่เกิน 2MB
        $config['max_width'] = '1024';  // ความกว้างรูปไม่เกิน
        $config['max_height'] = '768'; // ความสูงรูปไม่เกิน
        $config['file_name'] = 'mypicture';  // ชื่อไฟล์ ถ้าไม่กำหนดจะเป็นตามชื่อเพิม
 
        $this->upload->initialize($config);    // เรียกใช้การตั้งค่า  
         
        $fileExist=$this->input->post('d_service_image');
        if(file_exists($fileExist) && is_file($fileExist)){
            unlink($fileExist);  
            $file_upload="";
        }else{
            $file_upload=$this->input->post('h_service_image');  // เก็บชื่อไฟล์เพิมถ้ามี
            $fileCheck = './upload/'.$file_upload;   
            $full_fileCheck = set_realpath($fileCheck);
            if(!file_exists($full_fileCheck) || !is_file($full_fileCheck)){
                $file_upload="";
            }
        }
                 
        $this->upload->do_upload('service_image'); // ทำการอัพโหลดไฟล์จาก input file ชื่อ service_image        
        if(!$this->upload->display_errors()){ // ถ้าไม่มี error อัพไฟล์ได้ ให้เอาใช้ไฟล์ใส่ตัวแปร ไว้บันทึกลงฐานข้อมูล
            $file_upload=$this->upload->data('file_name');  // เก็บชื่อไฟล์ใหม่           
        }else{
            // ถ้า error ในกรณีเลือกไฟล์แล้วไม่ผ่าน
            if($this->upload->data('file_type')){ // เช่น ประเภทไม่ถูกต้อง
                return; // ต้อง return เพื่อให้แสดง error
            }
        }        
        $newdata = array(
            'service_title' => $this->input->post('service_title'),
            'service_detail' => $this->input->post('service_detail'),
            'service_img' => $file_upload,
            'service_update' => date("Y-m-d H:i:s")
        );
        return $this->db->update('tbl_service', $newdata,array('service_id'=>$id));
    }  
     
    public function delete($id){
        return $this->db->delete('tbl_service', array('service_id' =>$id)); 
        // คืนค่าผลการคิวรี่
    }        
 
}