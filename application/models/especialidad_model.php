<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Especialidad_model extends CI_Model {
 
     public function __construct() {
        parent::__construct();
        //cargamos la base de datos
        $this->load->database();
     }
     
      //VISUALIZAR TODAS LAS ESPECIALIDADES
     public function ver_especialidad(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM especialidad");         
        //Devolvemos el resultado de la consulta
        return $consulta->result();       
     }
     
     //obtiene todas las especialidades para colocarlas en un dropdown
     function get_especialidades(){ 
        // armamos la consulta        
         $query = $this->db->query("SELECT * FROM especialidad ORDER BY desc_especialidad");
        // si hay resultados 
        if ($query->num_rows() > 0) { 
            // almacenamos en una matriz bidimensional 
            $arrDatos[0] = '- Seleccionar Especialidad -';
            foreach($query->result() as $row) 
            
            $arrDatos[htmlspecialchars($row->id_especialidad, ENT_QUOTES)] = htmlspecialchars($row->desc_especialidad, ENT_QUOTES);
            
            $query->free_result(); 
            return $arrDatos; 
        }
     }
    
    //devuelve la descripcion de la especialidad segun id
    function get_especialidad($id){
        
        // armamos la consulta        
         $query = $this->db->query("SELECT * FROM especialidad WHERE id_especialidad=$id"); 
        // si hay resultados 
        if ($query->num_rows() > 0) { 
            
            return $query->result();            
            $query->free_result();                
        }        
    }
     
     
     
     //AGREGAR UNA ESPECIALIDAD
    public function add($especialidad){
        $consulta=$this->db->query("SELECT id_especialidad FROM especialidad WHERE id_especialidad='$especialidad'");
        if($consulta->num_rows()==0){
            $consulta=$this->db->query("INSERT INTO especialidad VALUES(NULL,'$especialidad');");
            if($consulta==true){
              return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
     //MODIFICAR UNA ESPECIALIDAD
    public function mod($id,$modificar="NULL",$descripcion="NULL"){
        if($modificar=="NULL"){
            $consulta=$this->db->query("SELECT * FROM especialidad WHERE id_especialidad=$id");
            return $consulta->result();
        }else{
          $consulta=$this->db->query("
              UPDATE especialidad SET desc_especialidad='$descripcion' WHERE id_especialidad=$id;");
          if($consulta==true){
              return true;
          }else{
              return false;
          }
        }
    }
    
     //ELIMINA UNA ESPECIALIDAD
     public function eliminar($id){
       $consulta=$this->db->query("DELETE FROM especialidad WHERE id_especialidad=$id");
       if($consulta==true){
           return true;
       }else{
           return false;
       }
    }
     
     
 }//fin clase
?>