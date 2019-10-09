<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**CONTROLADOR TURNOS
 * CREADO EL 11/09/2018
 */
class Turnos extends MY_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->load->library(array('session'));
         $this->load->library('form_validation');
         $this->load->helper('url');
         $this->load->helper('form');
         $this->load->model('turnos_model');
         $this->load->model('especialidad_model');
         $this->load->model('profesionales_model');
         $this->load->model('socios_model');

     }
     
     public function index()
     {   
         $data['titulo'] = 'ADMINISTRACION DE TURNOS';
         $data['turnos'] = $this->turnos_model->ver_turnos();
         $this->load_layout('turnos/turnos_view',$data);
     }
     
       //CONTROLADOR QUE AGREGA UN TURNO
    public function add()
    {        
         //compruebo si se a enviado submit
        if($this->input->post("submit")){
            $this->form_validation->set_rules('socio', 'DNI', 'required');
            if ($this->form_validation->run() == FALSE) {
                //CONSULTA TODAS LAS ESPECIALIDADES PARA MANDARLAS A UN DROPDOWN
                $data['especialidades'] = $this->especialidad_model->get_especialidades();
                $data['profesionales'] = $this->profesionales_model->get_profesionales();
                $data['horarios']=$this->profesionales_model->obtiene_horarios();
                $data['socios']=$this->socios_model->get_socios();
                $this->load_layout('turnos/add_view',$data);
            }else{
                $add=$this->turnos_model->add(
                        $this->input->post("socio"),//dni
                        $this->input->post("id_p"),//profesional
                        $this->input->post("turno"),//turno
                        $this->input->post("observaciones")
                        );
                if($add==true){
                //Sesion de una sola ejecucion
                    //mail de confirmacion de turno
                    ini_set( 'display_errors', 1 );
                    error_reporting( E_ALL );
                    $from = "jifernandez04@hotmail.com.com";
                    //mail del socio que viene de turnos/addview
                    $tomail = $this->input->post("mail");
                    $to = $tomail;
                    $subject = "Solicitud de turno medico";
                    $message = "Este turno esta sujeto a revision. Se el informara cuando el mismo este aprobado. Muchas Gracias";
                    $headers = "From:" . $from;
                    mail($to,$subject,$message, $headers);
                    //echo "El correo ha sido enviado.";
                    $this->session->set_flashdata('correcto', 'Turno a&ntilde;adido correctamente - Mail enviado con &eacute;xito');
                }else{
                    $this->session->set_flashdata('incorrecto', 'Turno a&ntilde;adido correctamente');
                }
                //redirecciono la pagina a la url por defecto
                redirect(base_url().'turnos');
            }
        }else{
            //CONSULTA TODAS LAS ESPECIALIDADES PARA MANDARLAS A UN DROPDOWN
            $data['especialidades'] = $this->especialidad_model->get_especialidades();
            $data['profesionales'] = $this->profesionales_model->get_profesionales();
            $data['horarios']=$this->profesionales_model->obtiene_horarios();//trae todos los datos de la tabla horarios_de_profesionales
            $data['socios']=$this->socios_model->get_socios();
            $this->load_layout('turnos/add_view',$data);
        }
        
    }
     
}
