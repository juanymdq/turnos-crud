<?php

/*
*ACCESO AL SISTEMA ******  http://localhost:8080/roles_usuarios/index.php/menu  *******
*
*
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Menu extends CI_Controller
{
    public function __construct()
    {
         parent::__construct();        
         $this->load->library(array('session','form_validation'));
         $this->load->helper(array('url','form'));
         $this->load->database('default');
    }
 
    public function index()
    {
        $this->load->view("menu_view");
    }
 }