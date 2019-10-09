<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**CONTROLADOR PROVINCIA
 * CREADO EL 10/07/2018
 */
class Provincia extends MY_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->load->library(array('session'));
         $this->load->library('form_validation');
         $this->load->helper(array('url'));
         $this->load->model('provincia_model');
         //llamo al helper url
         $this->load->helper(array('url','form'));
     }
     
     public function index()     {
         
         $data['titulo'] = 'ADMINISTRAR PROVINCIAS';
         $provincia['ver']=$this->provincia_model->ver_provincia();
         $this->load_layout('provincia/provincia_view',$provincia);
     }
     
      //CONTROLADOR QUE AGREGA UNA PROVINCIA
    public function add()
    {
         //compruebo si se a enviado submit
        if($this->input->post("submit")){
            $this->form_validation->set_rules('prov_nombre', 'Nombre de provincia', 'required');
            if ($this->form_validation->run() != FALSE) {
                //llamo al metodo add
                $add=$this->provincia_model->add(
                    $this->input->post("prov_nombre")
                );
                if($add==true){
                    //Sesion de una sola ejecuci�n
                    $this->session->set_flashdata('correcto', 'provincia a&ntilde;adida correctamente');
                }else{
                    $this->session->set_flashdata('incorrecto', 'provincia a&ntilde;adida correctamente');
                }
                //redirecciono la pagina a la url por defecto
                redirect(base_url().'provincia');
            }
        }
        $this->load_layout('provincia/add_view');
    }

    //controlador para modificar al que 
    //le paso por la url un parametro
    public function mod($id){
        if(is_numeric($id)){
          $datos["mod"]=$this->provincia_model->mod($id);
          $datos['idmod'] = $id;
          $this->load_layout("provincia/modificar_view",$datos);
          if($this->input->post("submit")){
                $mod=$this->provincia_model->mod(
                        $id,
                        $this->input->post("submit"),                        
                        $this->input->post("prov_nombre")                        
                        );
                if($mod==true){
                    //Sesion de una sola ejecuci�n
                    $this->session->set_flashdata('correcto', 'provincia modificada correctamente');
                }else{
                    $this->session->set_flashdata('incorrecto', 'provincia modificada correctamente');
                }
                redirect(base_url().'provincia');
          }
        }else{
            redirect(base_url().'provincia'); 
        }
    }
     
    //Controlador para eliminar
    public function eliminar($id){
        if(is_numeric($id)){
          $eliminar=$this->provincia_model->eliminar($id);
          if($eliminar==true){
              $this->session->set_flashdata('correcto', 'provincia eliminada correctamente');
          }else{
              $this->session->set_flashdata('incorrecto', 'provincia eliminada correctamente');
          }
          redirect(base_url().'provincia');
        }else{
          redirect(base_url().'provincia');
        }
    }     
     
     
}
?>