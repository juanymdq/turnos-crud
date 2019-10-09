<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * CONTROLADOR SOCIO
 * CREACION 06/07/2018
 */
class Socio extends MY_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->load->library(array('session'));
         $this->load->helper(array('url'));
         $this->load->library('form_validation');
         $this->load->model('socios_model');
         $this->load->model('obra_social_model');
         //llamo al helper url
         $this->load->helper(array('url','form'));
     }
     
     public function index(){
         $socios['titulo'] = 'ADMINISTRAR SOCIOS';
         $socios['ver']=$this->socios_model->ver_socios();         
         $this->load_layout('socios/socios_view',$socios);
     }
      //CONTROLADOR QUE AGREGA UN SOCIO
    public function add()
    {
        $var_dnu = $this->input->post("dni");
         //compruebo si se a enviado submit
        if($this->input->post("submit")){
            $this->form_validation->set_rules('dni', 'DNI', 'required');
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('apellido', 'Apellido', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono','numeric');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            if ($this->form_validation->run() == FALSE) {
                $socios['os'] = $this->obra_social_model->get_os();
                $this->load_layout('socios/add_view',$socios);
            }else{
                $verif_dnu = $this->socios_model->verifica_dni($var_dnu);
                if(!($verif_dnu)){
                    //llamo al metodo add
                    $add=$this->socios_model->add(
                            $this->input->post("dni"),
                            $this->input->post("nombre"),
                            $this->input->post("apellido"),
                            $this->input->post("id_os"),
                            $this->input->post("telefono"),
                            $this->input->post("email")
                            );

                    if($add==true){
                    //Sesion de una sola ejecuci�n
                    $this->session->set_flashdata('correcto', 'Socio a&ntilde;adido correctamente');
                    }else{
                        $this->session->set_flashdata('incorrecto', 'Socio a&ntilde;adido correctamente');
                    }
                }else{
                    $this->session->set_flashdata('incorrecto', 'IMPOSIBLE GUARDAR - YA EXISTE EL DNI INGRESADO');
                }
                //redirecciono la pagina a la url por defecto
                redirect(base_url().'socio');
            }
        }else{
            //CONSULTA TODAS LAS OBRAS SOCIALES PARA MANDARLAS A UN DROPDOWN
            $socios['os'] = $this->obra_social_model->get_os(); 
            $this->load_layout('socios/add_view',$socios);
        }
    }
    //controlador para modificar 
    //le paso por la url un parametro
    public function mod($id){
        if(is_numeric($id)){
          //obtiene el socio por id
          $datos["mod"]=$this->socios_model->mod($id);
          //obtiene las obras sociales
          $datos['os'] = $this->obra_social_model->get_os();
          //pasa la matricula
          $datos['idmod'] = $id;
          //llama a la vista de modificacion con la variable $datos
          $this->load_layout("socios/modificar_view",$datos);
          $var_dnu = $this->input->post("dni");
          if($this->input->post("submit")){
            $verif_dnu = $this->socios_model->verifica_dni($var_dnu);
            if(!($verif_dnu)){
                //llama al metodo en model para la modificacion
                $mod=$this->socios_model->mod(
                        $id,
                        $this->input->post("submit"),
                        $this->input->post("dni"),
                        $this->input->post("nombre"),
                        $this->input->post("apellido"),
                        $this->input->post("id_os"),
                        $this->input->post("telefono"),
                        $this->input->post("email")
                        );
                if($mod==true){
                    //Sesion de una sola ejecuci�n
                    $this->session->set_flashdata('correcto', 'Socio modificado correctamente');
                }else{
                    $this->session->set_flashdata('incorrecto', 'Socio modificado correctamente');
                }

            }else{
                $this->session->set_flashdata('incorrecto', 'IMPOSIBLE GUARDAR - YA EXISTE EL DNI INGRESADO');
            }

                redirect(base_url().'socio');

          }
        }else{
            redirect(base_url().'socio'); 
        }
    }
     
    //Controlador para eliminar
    public function eliminar($id){
        if(is_numeric($id)){
          $eliminar=$this->socios_model->eliminar($id);
          if($eliminar==true){
              $this->session->set_flashdata('correcto', 'Socio eliminado correctamente');
          }else{
              $this->session->set_flashdata('incorrecto', 'Socio eliminado correctamente');
          }
          redirect(base_url().'socio');
        }else{
          redirect(base_url().'socios');
        }
    }     
     
     
}
?>