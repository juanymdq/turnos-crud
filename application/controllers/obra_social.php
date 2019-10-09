<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * CONTROLADOR OBRA SOCIAL
 * CREACION 09/07/2018
 */
class Obra_social extends MY_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->load->library(array('session'));
       //  $this->load->library(array('resources'));
         $this->load->library('form_validation');
         $this->load->model('obra_social_model');
         $this->load->model('provincia_model');
         $this->load->model('ciudad_model');
         //llamo al helper url
         $this->load->helper(array('url','form'));
         
     }
     
     public function index()     {
         
         $data['titulo'] = 'ADMINISTRAR OBRA SOCIAL';
         $os['ver']=$this->obra_social_model->ver_os();         
         $this->load_layout('os/os_view',$os);
      /*   $config['js'] = array('jquery-1.7.1.min');
         $this->resources->initialize($config);*/
     }
     
   
     
      //CONTROLADOR QUE AGREGA UNA OS
    public function add()
    {
         //compruebo si se a enviado submit
        if($this->input->post("submit")){
            $this->form_validation->set_rules('os_nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('direccion', 'Direccion', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono', 'numeric');
            $this->form_validation->set_rules('portal', 'Portal', 'valid_url');
            if ($this->form_validation->run() == FALSE) {
                $os['ciudades'] = $this->ciudad_model->get_ciudades();
                $os['provincias'] = $this->provincia_model->get_provincias();
                $this->load_layout('os/add_view',$os);
            }else{
                //llamo al metodo add
                $add=$this->obra_social_model->add(
                        $this->input->post("os_nombre"),
                        $this->input->post("direccion"),
                        $this->input->post("telefono"),
                        $this->input->post("portal"),
                        $this->input->post("observaciones"),
                        $this->input->post("ciudad")
                        );

                if($add==true){
                //Sesion de una sola ejecuci�n
                    $this->session->set_flashdata('correcto', 'Obra Social a&ntilde;adida correctamente');
                }else{
                    $this->session->set_flashdata('incorrecto', 'Obra Social a&ntilde;adida correctamente');
                }

                //redirecciono la pagina a la url por defecto
                redirect(base_url().'obra_social');
            }
        }else{
           $os['ciudades'] = $this->ciudad_model->get_ciudades();
           $os['provincias'] = $this->provincia_model->get_provincias();
           $this->load_layout('os/add_view',$os);
        }        
    }
    //controlador para modificar 
    //le paso por la url un parametro
    public function mod($id){
          //obtiene la os por id
          $datos["mod"]=$this->obra_social_model->mod($id); 
          $datos['ciudades'] = $this->ciudad_model->get_ciudades();
          $datos['provincias'] = $this->provincia_model->get_provincias();          
          //pasa el id
          $datos['idmod'] = $id;
          //llama a la vista de modificacion con la variable $datos
          if($this->input->post("submit")){
              $this->form_validation->set_rules('os_nombre', 'Nombre Obra Social', 'required');
              $this->form_validation->set_rules('direccion', 'Direccion', 'required');
              $this->form_validation->set_rules('telefono', 'Telefono', 'required');
              if ($this->form_validation->run() == FALSE) {
                  $datos['ciudades'] = $this->ciudad_model->get_ciudades();
                  $datos['provincias'] = $this->provincia_model->get_provincias();
              }else{
                //llama al metodo en model para la modificacion
                $mod=$this->obra_social_model->mod(
                        $this->input->post("id_os"),
                        $this->input->post("submit"),
                        $this->input->post("os_nombre"),                    
                        $this->input->post("direccion"),
                        $this->input->post("telefono"),                    
                        $this->input->post("portal"),
                        $this->input->post("observaciones"),                        
                        $this->input->post("ciudad")                      
                        );
                if($mod==true){
                    //Sesion de una sola ejecuci�n
                    $this->session->set_flashdata('correcto', 'Obra Social modificada correctamente');
                }else{
                    $this->session->set_flashdata('incorrecto', 'Obra Social modificada correctamente');
                }
                redirect(base_url().'obra_social');
              }
          }
          $this->load_layout('os/modificar_view',$datos);
    }

     
    //Controlador para eliminar
    public function eliminar($id){
        if(is_numeric($id)){
          $eliminar=$this->obra_social_model->eliminar($id);
          if($eliminar==true){
              $this->session->set_flashdata('correcto', 'Obra Social eliminada correctamente');
          }else{
              $this->session->set_flashdata('incorrecto', 'Obra Social eliminada correctamente');
          }
          redirect(base_url().'obra_social');
        }else{
          redirect(base_url().'obra_social');
        }
    }     
     
     
}
?>