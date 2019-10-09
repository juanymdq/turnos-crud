<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class MY_Controller extends CI_Controller {
 
    function MY_Layout() {
        parent::__construct();
        $this->load->helper('url');
    }
 
    public function load_layout($view, $params = null)
    {
        // Paso por par�metro la vista $view al layout y la muestro
        $data = array();
        $data['content'] = $this->load->view($view, $params, true);
        $this->load->view('layout_view',$data, false);
 
    }
 
}