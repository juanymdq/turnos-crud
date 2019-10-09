<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * 
 */
class Especialidad extends MY_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->load->library(array('session'));
         $this->load->helper(array('url'));
         $this->load->model('especialidad_model');
         //llamo al helper url
         $this->load->helper(array('url','form'));
     }
     
     public function index()     {
         
         $data['titulo'] = 'ADMINISTRAR ESPECIALIDADES';
         $especialidad['ver']=$this->especialidad_model->ver_especialidad();
         $this->load_layout('especialidad/especialidad_view',$especialidad);
     }
     
      //CONTROLADOR QUE AGREGA UNA ESPECIALIDAD
    public function add()
    {
         //compruebo si se a enviado submit
        if($this->input->post("submit")){         
            //llamo al metodo add
            $add=$this->especialidad_model->add(
                    $this->input->post("especialidad")                    
                    );
            
            if($add==true){
            //Sesion de una sola ejecuci�n
            $this->session->set_flashdata('correcto', 'Especialidad a&ntilde;adida correctamente');
            }else{
                $this->session->set_flashdata('incorrecto', 'Especialidad a&ntilde;adida correctamente');
            }
             
            //redirecciono la pagina a la url por defecto
            redirect(base_url().'especialidad');
        }else{
           $this->load_layout('especialidad/add_view');
        }
        
    }
    //controlador para modificar al que 
    //le paso por la url un parametro
    public function mod($id){
        if(is_numeric($id)){
          $datos["mod"]=$this->especialidad_model->mod($id);
          $datos['idmod'] = $id;
          $this->load_layout("especialidad/modificar_view",$datos);
          if($this->input->post("submit")){
                $mod=$this->especialidad_model->mod(
                        $id,
                        $this->input->post("submit"),                        
                        $this->input->post("descripcion")                        
                        );
                if($mod==true){
                    //Sesion de una sola ejecuci�n
                    $this->session->set_flashdata('correcto', 'Especialidad modificada correctamente');
                }else{
                    $this->session->set_flashdata('incorrecto', 'Especialidad modificada correctamente');
                }
                redirect(base_url().'especialidad');
          }
        }else{
            redirect(base_url().'especialidad'); 
        }
    }
     
    //Controlador para eliminar
    public function eliminar($id){
        if(is_numeric($id)){
          $eliminar=$this->especialidad_model->eliminar($id);
          if($eliminar==true){
              $this->session->set_flashdata('correcto', 'Especialidad eliminada correctamente');
          }else{
              $this->session->set_flashdata('incorrecto', 'Especialidad eliminada correctamente');
          }
          redirect(base_url().'especialidad');
        }else{
          redirect(base_url().'especialidad');
        }
    }     
     
     
}
?>