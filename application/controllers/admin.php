<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * 
 */
class Admin extends CI_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->load->library(array('session'));
         $this->load->helper(array('url'));
         $this->load->model('usuarios_model');
     }
     
     public function index()
     {
         if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'administrador')
         {
            redirect(base_url().'login');
         }         
         $data['us'] = $this->usuarios_model->verxuser($this->session->userdata('username'));
         $data['titulo'] = 'Bienvenido Administrador';
         $this->load->view('admin_view',$data);
     }
}
?>