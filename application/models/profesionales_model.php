<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODELO DE PROFESIONALES
 * CREADO 05/07/2018
 */
class Profesionales_model extends CI_Model {
 
     public function __construct() {
        parent::__construct();
        //cargamos la base de datos
        $this->load->database();
     }
     
      //VISUALIZAR TODOS LOS PROFESIONALES
     public function ver_profesionales(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM profesional as p,especialidad as e WHERE p.id_especialidad=e.id_especialidad");         
        //Devolvemos el resultado de la consulta
        return $consulta->result();       
     }
     
     //DEVUELVE LOS DATOS DE UN PROFESIONAL SEGUN LA MATRICULA
     public function obtiene_profesional($mat){
        
        $consulta=$this->db->query("SELECT * FROM profesional as p,especialidad as e WHERE p.id_especialidad=e.id_especialidad and p.matricula=$mat");
        return $consulta->result();  
     }
     
     //verifica que no existan matriculas repetidas
     public function verifica_matricula($mat){        
        $consulta=$this->db->query("SELECT * FROM profesional WHERE matricula=$mat");
        if($consulta->num_rows()==0){
            return false;//SI NO EXISTE LA MATRICULA
        }else{
            return true;//SI EXISTE LA MATRICULA
        }
     }
     
      //obtiene todos los profesionales para colocarlos en un dropdown
     function get_profesionales(){ 
        // armamos la consulta        
         $query = $this->db->query("SELECT * FROM profesional"); 
        // si hay resultados 
        if ($query->num_rows() > 0) { 
            // almacenamos en una matriz bidimensional 
            foreach($query->result() as $row){
            $nombre = $row->apellido.', '.$row->nombre;
            $arrDatos[htmlspecialchars($row->matricula, ENT_QUOTES)] = htmlspecialchars($row->id_especialidad, ENT_QUOTES).'-'.htmlspecialchars($nombre, ENT_QUOTES);
            }
            $query->free_result(); 
            return $arrDatos; 
        }
     }

    //VISUALIZAR LOS HORARIOS DE UN PROFESIONAL SEGUN MATRICULA
     function get_horarios($mat){
        // armamos la consulta        
         $query = $this->db->query("SELECT * FROM horarios_de_profesionales WHERE id_profesional=$mat");
        // si hay resultados
        if ($query->num_rows() > 0) {
            foreach($query->result() as $row){ 
                $horario = $row->id_profesional.'-'.$row->prof_anio.'-'.$row->prof_mes.'-'.$row->id_dia.'-'.$row->hora_desde.'-'.$row->hora_hasta;
                $arrDatos[$row->id_horario] = htmlspecialchars($horario, ENT_QUOTES);
            }
            $query->free_result();
        return $arrDatos;
        }
     }
      //VISUALIZAR LOS HORARIOS DE TODOS LOS PROFESIONALES
     public function obtiene_horarios(){
        //Hacemos una consulta
        $query=$this->db->query("SELECT * FROM horarios_de_profesionales");
        //Devolvemos el resultado de la consulta
         if ($query->num_rows() > 0) {
             foreach($query->result() as $row){
                 $horario = $row->id_profesional.'-'.$row->prof_anio.'-'.$row->prof_mes.'-'.$row->id_dia.'-'.$row->hora_desde.'-'.$row->hora_hasta;
                 $arrDatos[$row->id_horario] = htmlspecialchars($horario, ENT_QUOTES);
             }
             $query->free_result();
             return $arrDatos;
         }
     }
     
     //AGREGAR UN PROFESIONAL
    public function add($mat,$nom,$apel,$id_es,$tel,$email){
        $consulta=$this->db->query("SELECT matricula FROM profesional WHERE matricula='$mat'");
        if($consulta->num_rows()==0){
            $consulta=$this->db->query("INSERT INTO profesional VALUES('$mat','$nom','$apel','$id_es','$tel','$email');");
            if($consulta==true){
              return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    //*********************************************************************************************************************
    //AGREGA HORARIOS DE PROFESIONALES
    public function addhorarios($mat,$anio,$mes,$dia,$horad,$horas){
        $consulta=$this->db->query("INSERT INTO horarios_de_profesionales VALUES('','$mat','$anio','$mes','$dia','$horad','$horas');");
        if($consulta==true){
          return true;
        }else{
            return false;
        }        
    }
    
     //MODIFICAR HORARIOS
    public function modhorarios($mat,$dia,$horad="NULL",$horas="NULL"){        
          $consulta=$this->db->query("
              UPDATE horarios_de_profesionales SET id_profesional=$mat,id_dia='$dia',hora_desde='$horad',hora_hasta='$horas' WHERE id_profesional=$mat and id_dia='$dia';");
          if($consulta==true){
              return true;
          }else{
              return false;
          }        
    }
    //*********************************************************************************************************************
     //MODIFICAR UN PROFESIONAL
    public function mod($mat,$modificar="NULL",$nom="NULL",$apel="NULL",$id_es="NULL",$tel="NULL",$email="NULL"){
        if($modificar=="NULL"){
            $consulta=$this->db->query("SELECT * FROM profesional as p,especialidad as e WHERE p.matricula like '$mat' and p.id_especialidad=e.id_especialidad");
            return $consulta->result();
        }else{
          $consulta=$this->db->query("
              UPDATE profesional SET matricula=$mat,nombre='$nom',apellido='$apel',id_especialidad='$id_es',telefono='$tel',email='$email' WHERE matricula=$mat;");
          if($consulta==true){
              return true;
          }else{
              return false;
          }
        }
    }
    
     //ELIMINA UN PROFESIOAL
     public function eliminar($mat){
       $consulta=$this->db->query("DELETE FROM profesional WHERE matricula=$mat");
       $consulta=$this->db->query("DELETE FROM profesional WHERE matricula=$mat");
       if($consulta==true){
           return true;
       }else{
           return false;
       }
    }
     
     
 }//fin clase
