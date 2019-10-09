<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * CONTROLADOR PROFESIONALES
 * CREACION 05/07/2018
 */
class Profesionales extends MY_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->load->library(array('session'));
         $this->load->library('form_validation');
         //llamo al helper url
         $this->load->helper(array('url','form'));
         /*********************************/
         $this->load->model('profesionales_model');
         $this->load->model('especialidad_model');
     }
     
     public function index()     {
         
         $data['titulo'] = 'ADMINISTRAR PROFESIONALES';
         $profesionales['ver']=$this->profesionales_model->ver_profesionales();         
         $this->load_layout('profesionales/profesionales_view',$profesionales);
     }
     
     //ACCEDE A CARGAR LOS HORARIOS Y DIAS DE TRABAJO DEL PROFESIONAL
     public function modifica_horarios($mat){
        
        if($this->input->post("submit")){ 
            $arrd = $this->input->post("chkdia");//el dia lo toma del checkbox
            $arrhd = $this->input->post("horad");
            $arrhs = $this->input->post("horas");
            $matricula = $this->input->post("matricula");
            $year = $this->input->post("anio");
            $mes = $this->input->post("mes");
            $checkdia = $this->input->post("chkdia");
            for($x=0;$x < count($arrd);$x++){
                if(isset($checkdia[$x])){
                    $add=$this->profesionales_model->addhorarios(
                            $matricula,
                            $year,
                            $mes,
                            $arrd[$x],
                            $arrhd[$x],
                            $arrhs[$x]
                            );
                }
            }
            if($add==true){
                //Sesion de una sola ejecuci�n
                $this->session->set_flashdata('correcto', 'Horarios a&ntilde;adidos correctamente');
            }else{
                $this->session->set_flashdata('incorrecto', 'Horarios a&ntilde;adidos correctamente');
            }
             //redirecciono la pagina a la url por defecto
             redirect(base_url().'profesionales');
        }else{        
            $datos['profesional']=$this->profesionales_model->obtiene_profesional($mat);
            $datos['horarios'] = $this->profesionales_model->get_horarios($mat);
            $this->load_layout('profesionales/carga_horarios_prof',$datos);
        }
        
     }     
     
      //CONTROLADOR QUE AGREGA UN PROFESIONAL
    public function add(){
         //compruebo si se a enviado submit
        if($this->input->post("submit")){
            $this->form_validation->set_rules('matricula', 'Matricula', 'required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('apellido', 'Apellido', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono', 'numeric');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('especialidad', 'Especialidad', 'required');            
            if ($this->form_validation->run() == FALSE) {
                $profesionales['especialidad'] = $this->especialidad_model->get_especialidades(); 
                $profesionales['horarios'] = $this->profesionales_model->get_horarios();
                $this->load_layout('profesionales/add_view',$profesionales);
            } else {
                $var_mat = $this->input->post("matricula");
                $verif_matricula = $this->profesionales_model->verifica_matricula($var_mat);
                if(!($verif_matricula)){                
                    $add=$this->profesionales_model->add(
                            $this->input->post("matricula"),
                            $this->input->post("nombre"),
                            $this->input->post("apellido"),
                            $this->input->post("especialidad"),
                            $this->input->post("telefono"),
                            $this->input->post("email")
                            );
                    for($x=1;$x <= 7;$x++){
                    
                    $add=$this->profesionales_model->addhorarios(
                            $this->input->post("matricula"),                        
                            $x,
                            '00:00:00',
                            '00:00:00'                    
                            );
                    }
                    if($add==true){
                    //Sesion de una sola ejecuci�n
                    $this->session->set_flashdata('correcto', 'Profesional a&ntilde;adido correctamente');
                    }else{
                        $this->session->set_flashdata('incorrecto', 'Profesional a&ntilde;adido correctamente');
                    }
                    
                
                }else{
                    $this->session->set_flashdata('incorrecto', 'IMPOSIBLE GUARDAR - YA EXISTE LA MATRICULA INGRESADA');               
                }
                 //redirecciono la pagina a la url por defecto
                 redirect(base_url().'profesionales');
            }
            
        }else{
            //CONSULTA TODAS LAS ESPECIALIDADES PARA MANDARLAS A UN DROPDOWN
            $profesionales['especialidad'] = $this->especialidad_model->get_especialidades();
            $this->load_layout('profesionales/add_view',$profesionales);
        }
        
    }
    
    //controlador para modificar 
    //le paso por la url un parametro
    public function mod($id){
        //if(is_numeric($id)){
          //obtiene el profesional por matricula
          $datos["mod"]=$this->profesionales_model->mod($id);
          //obtiene las especialidades
          $datos['especialidad'] = $this->especialidad_model->get_especialidades(); 
          //pasa la matricula
          $datos['idmod'] = $id;
          //llama a la vista de modificacion con la variable $datos
          //$this->load_layout("profesionales/modificar_view",$datos);
          if($this->input->post("submit")){
              $this->form_validation->set_rules('matricula', 'Matricula', 'required|min_length[5]|max_length[12]');
              $this->form_validation->set_rules('nombre', 'Nombre', 'required');
              $this->form_validation->set_rules('apellido', 'Apellido', 'required');
              $this->form_validation->set_rules('especialidad', 'Especialidad', 'required');
              if ($this->form_validation->run() == FALSE) {
                  //obtiene el profesional por matricula
                  $datos["mod"]=$this->profesionales_model->mod($id);
                  //obtiene las especialidades
                  $datos['especialidad'] = $this->especialidad_model->get_especialidades();
                  //pasa la matricula
                  $datos['idmod'] = $id;
                  //llama a la vista de modificacion con la variable $datos
                 // $this->load_layout("profesionales/modificar_view",$datos);
              } else {
                //llama al metodo en model para la modificacion
                $mod=$this->profesionales_model->mod(
                        $this->input->post("matricula"),
                        $this->input->post("submit"),
                        $this->input->post("nombre"),
                        $this->input->post("apellido"),                    
                        $this->input->post("especialidad"),
                        $this->input->post("telefono"),
                        $this->input->post("email")                        
                        );
                if($mod==true){
                    //Sesion de una sola ejecuci�n
                    $this->session->set_flashdata('correcto', 'Profesional modificado correctamente');
                }else{
                    $this->session->set_flashdata('incorrecto', 'Profesional modificado correctamente');
                }
                redirect(base_url().'profesionales');
              }
          }
        $this->load_layout("profesionales/modificar_view",$datos);
    }
     
    //Controlador para eliminar
    public function eliminar($id){
        if(is_numeric($id)){
          $eliminar=$this->profesionales_model->eliminar($id);
          if($eliminar==true){
              $this->session->set_flashdata('correcto', 'Profesional eliminado correctamente');
          }else{
              $this->session->set_flashdata('incorrecto', 'Profesional eliminado correctamente');
          }
          redirect(base_url().'profesionales');
        }else{
          redirect(base_url().'profesionales');
        }
    }     
     
     
}
?>