<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**CONTROLADOR CIUDAD
 * CREADO EL 10/07/2018
 */
class Ciudad extends MY_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->load->library(array('session'));
         $this->load->library('form_validation');
         $this->load->helper(array('url'));
         $this->load->model('ciudad_model');
         $this->load->model('provincia_model');
         //llamo al helper url
         $this->load->helper(array('url','form'));
     }
     
     public function index()     {
         
         $data['titulo'] = 'ADMINISTRAR CIUDADES';
         $ciudad['ver']=$this->ciudad_model->ver_ciudad();
         $this->load_layout('ciudad/ciudad_view',$ciudad);
     }
       
       
     public function consulta_datos()
     {
         $idp = $_POST['idp'];
         return $this->ciudad_model->obtiene_ciudades($idp);
    
     }
      //CONTROLADOR QUE AGREGA UNA ciudad
    public function add()
    {
         //compruebo si se a enviado submit
        if($this->input->post("submit")){
            $this->form_validation->set_rules('c_nombre', 'Nombre de ciudad', 'required');
            if ($this->form_validation->run() == FALSE) {
                //CONSULTA TODAS LAS PPROVINCIAS PARA MANDARLAS A UN DROPDOWN
                $ciudad['provincias'] = $this->provincia_model->get_provincias();
                $this->load_layout('ciudad/add_view',$ciudad);
            }else{
                //llamo al metodo add
                $add=$this->ciudad_model->add(
                        $this->input->post("id_prov"),
                        $this->input->post("c_nombre")
                        );

                if($add==true){
                //Sesion de una sola ejecuci�n
                    $this->session->set_flashdata('correcto', 'ciudad a&ntilde;adida correctamente');
                }else{
                    $this->session->set_flashdata('incorrecto', 'ciudad a&ntilde;adida correctamente');
                }
                //redirecciono la pagina a la url por defecto
                redirect(base_url().'ciudad');
            }
        }else{
             //CONSULTA TODAS LAS PPROVINCIAS PARA MANDARLAS A UN DROPDOWN
            $ciudad['provincias'] = $this->provincia_model->get_provincias(); 
            $this->load_layout('ciudad/add_view',$ciudad);
        }
        
    }
    //controlador para modificar al que 
    //le paso por la url un parametro
    public function mod($id){
        if(is_numeric($id)){
          $datos["mod"]=$this->ciudad_model->mod($id);
          //obtiene las provincias
          $datos['provincias'] = $this->provincia_model->get_provincias();          
          $datos['idmod'] = $id;
          $this->load_layout("ciudad/modificar_view",$datos);
          if($this->input->post("submit")){
                $mod=$this->ciudad_model->mod(
                        $id,
                        $this->input->post("submit"),                        
                        $this->input->post("id_prov"),
                        $this->input->post("c_nombre")
                        );
                if($mod==true){
                    //Sesion de una sola ejecuci�n
                    $this->session->set_flashdata('correcto', 'ciudad modificada correctamente');
                }else{
                    $this->session->set_flashdata('incorrecto', 'ciudad modificada correctamente');
                }
                redirect(base_url().'ciudad');
          }
        }else{
            redirect(base_url().'ciudad'); 
        }
    }
     
    //Controlador para eliminar
    public function eliminar($id){
        if(is_numeric($id)){
          $eliminar=$this->ciudad_model->eliminar($id);
          if($eliminar==true){
              $this->session->set_flashdata('correcto', 'ciudad eliminada correctamente');
          }else{
              $this->session->set_flashdata('incorrecto', 'ciudad eliminada correctamente');
          }
          redirect(base_url().'ciudad');
        }else{
          redirect(base_url().'ciudad');
        }
    }     
     
     
}
?>