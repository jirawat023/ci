<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
   
class Admin extends CI_Controller {  
     
    public function __construct()
    {
            parent::__construct();
            $this->load->library('session');  // เรียกใช้งาน session
    }  
     
    public function index()  
    {  
        // ตรวจสอบตัวแปร session ที่เราจะสร้างและใช้เป็นเงื่อนไข
        if(!isset($_SESSION['ses_admin_id']) || $_SESSION['ses_admin_id']==""){ // ยังไม่ล็อกอิน
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
            $this->load->view('admin/admin_header', $data);  
            $this->load->view('admin/admin_home',$data);  
            $this->load->view('admin/admin_footer');  
        }
    }  
     
    // เมื่อทำการล็อกอิน 
    public function login(){
        // สมมติการล็อกอินสร้างตัวแปร session อย่างง่าย
        $_SESSION['ses_admin_id']=1;
        $_SESSION['ses_admin_name']="Admin";
        redirect('admin'); // ไปหน้า admin
    }
     
    // เมื่อทำการล็อกเอาท์
    public function logout(){
        // สมมติล็อกเอาท์ ลบค่า session
        unset($_SESSION['ses_admin_id']);
        unset($_SESSION['ses_admin_name']);
        redirect('admin'); // ไปหน้า admin      
    }
     
}