<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
   
class Admin extends CI_Controller {  
     
    public function __construct()
    {
            parent::__construct();
            $this->load->helper('cookie');
//            $this->load->library('session');  // เรียกใช้งาน session
    }  
     
    public function index($admin_pages="home",$action=null,$id=null)  
    {  
        // ตรวจสอบตัวแปร session ที่เราจะสร้างและใช้เป็นเงื่อนไข
        if(!isset($_SESSION['ses_admin_id']) || $_SESSION['ses_admin_id']==""){ // ยังไม่ล็อกอิน
//        if(!$this->session->has_userdata('ses_admin_id') || $this->session->ses_admin_id==""){       
            // แสดงหน้าล็อกอินอย่างง่าย 
            $data['title']="Admin Login";  
            $data['title_h1']="Page Admin Login";  
            $this->load->view('admin/admin_header', $data);  
            $this->load->view('admin/admin_login',$data);  
            $this->load->view('admin/admin_footer');  
        }else{
            // แสดงหน้า admin อย่างง่ายเมื่อมีการล็อกอิน และสร้าง session
            $data['title']="Admin Home";  
            $data['title_h1']="Page Admin Home";  
            $data['action']=$action;
            $data['id']=$id;
            $file_model=APPPATH.'/models/admin/'.ucfirst($admin_pages).'_model.php';  
            if(file_exists($file_model))  
            {  
                $this->load->model('admin/'.$admin_pages.'_model');  
            }               
            $this->load->view('admin/admin_header', $data);  
            $this->load->view('admin/admin_'.$admin_pages,$data);  
            $this->load->view('admin/admin_footer');  
        }
    }  
     
    // เมื่อทำการล็อกอิน 
    public function login(){
         
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $remember_check=$this->input->post('remember_check');
        if(isset($remember_check)){
            set_cookie('ck_username',$username,time()+60);
            set_cookie('ck_password',$password,time()+60);
            set_cookie('ck_remember',$remember_check,time()+60);
        }else{
            delete_cookie('ck_username');
            delete_cookie('ck_password');
            delete_cookie('ck_remember');
        }
 
        // สมมติการล็อกอินสร้างตัวแปร session อย่างง่าย
//        $_SESSION['ses_admin_id']=1;
//        $_SESSION['ses_admin_name']="Admin";
        $newdata = array(
                'ses_admin_id'  =>1,
                'ses_admin_name' => "Admin"
        );
        $this->session->set_userdata($newdata);        
        redirect('admin'); // ไปหน้า admin
    }
     
    // เมื่อทำการล็อกเอาท์
    public function logout(){
        // สมมติล็อกเอาท์ ลบค่า session
//        unset(
//            $_SESSION['ses_admin_id'],
//            $_SESSION['ses_admin_name']
//        );
        $array_items = array(
            'ses_admin_id',
            'ses_admin_name'
        );
        $this->session->unset_userdata($array_items);        
        redirect('admin'); // ไปหน้า admin      
    }
     
}