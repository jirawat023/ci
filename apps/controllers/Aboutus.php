<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Aboutus extends CI_Controller {
 
public function index()
{
        $data['title']="Home Title";
        $data['title_h1']="Page Home";
        $this->load->view('templates/header', $data);
        $this->load->view('pages/home',$data);
        $this->load->view('templates/footer');
}
}