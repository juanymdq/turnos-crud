<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CREADO EL 11/09/2018
 */
class Turnos_model extends CI_Model {
 
     public function __construct() {
        parent::__construct();
        //cargamos la base de datos
        $this->load->database();
     }
     
     
      //VISUALIZAR TODOS LOS TURNOS
     public function ver_turnos(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT t.id_turno,t.turno,concat(p.apellido,', ',p.nombre) as profesional,e.desc_especialidad as especialidad,concat(s.apellido,', ',s.nombre) as socio,t.observaciones
FROM turnos as t,profesional as p,socio as s,especialidad as e
WHERE p.id_especialidad = e.id_especialidad and t.id_profesional = p.matricula and t.id_usuario = s.dni");
        //Devolvemos el resultado de la consulta
        return $consulta->result();       
     }
     
     
     
      //AGREGAR UN TURNO
    public function add($iduser,$idpro,$turno,$obser){
            $consulta=$this->db->query("INSERT INTO turnos VALUES('','$iduser','$idpro','$turno','$obser');");
            if($consulta==true){
              return true;
            }else{
              return false;
            }        
    }
     
}