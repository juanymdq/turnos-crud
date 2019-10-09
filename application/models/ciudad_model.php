<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**MODELO CIUDAD
 * CREADO EL 10/07/2018
 */
class Ciudad_model extends CI_Model {
 
     public function __construct() {
        parent::__construct();
        //cargamos la base de datos
        $this->load->database();
     }
     
      //VISUALIZAR TODAS LAS CIUDADES
     public function ver_ciudad(){
        //Hacemos una consulta
        $consulta=$this->db->query("SELECT * FROM distrito as c, provincia as p WHERE c.id_prov=p.id_prov");         
        //Devolvemos el resultado de la consulta
        return $consulta->result();      
     }
     
     //obtiene todas las provincias para colocarlas en un dropdown
     function get_ciudades(){ 
        // armamos la consulta        
         $query = $this->db->query("SELECT * FROM distrito"); 
        // si hay resultados 
        if ($query->num_rows() > 0) { 
            // almacenamos en una matriz bidimensional 
            //$arrDatos[0] = '- Seleccionar Ciudad-';
            foreach($query->result() as $row) 
            $arrDatos[htmlspecialchars($row->id_ciudad, ENT_QUOTES)] = htmlspecialchars($row->id_prov, ENT_QUOTES).'-'.htmlspecialchars($row->c_nombre, ENT_QUOTES);
            
            $query->free_result(); 
            return $arrDatos; 
        }
     }
      
     public function obtiene_ciudades($idp){
        $sql = "SELECT * FROM distrito WHERE id_prov=$idp";
        $query = $this->db->query($sql);        
        foreach($query->result() as $row) 
            $arrDatos[htmlspecialchars($row->id_ciudad, ENT_QUOTES)] = htmlspecialchars($row->c_nombre, ENT_QUOTES);            
            $query->free_result(); 
            return $arrDatos; 
     } 
          
     //AGREGAR UNA CIUDAD
    public function add($id_prov,$nombre){       
            $consulta=$this->db->query("INSERT INTO distrito VALUES('','$id_prov','$nombre');");
            if($consulta==true){
              return true;
            }else{
                return false;
            }       
    }
     //MODIFICAR UNA CIUDAD
    public function mod($id,$modificar="NULL",$id_prov="NULL",$nombre="NULL"){
        if($modificar=="NULL"){
            $consulta=$this->db->query("SELECT * FROM distrito WHERE id_ciudad=$id");
            return $consulta->result();
        }else{
          $consulta=$this->db->query("UPDATE distrito SET id_prov=$id_prov,c_nombre='$nombre' WHERE id_ciudad=$id;");
          if($consulta==true){
              return true;
          }else{
              return false;
          }
        }
    }
    
     //ELIMINA UNA CIUDAD
     public function eliminar($id){
       $consulta=$this->db->query("DELETE FROM distrito WHERE id_ciudad=$id");
       if($consulta==true){
           return true;
       }else{
           return false;
       }
    }
     
     
 }//fin clase
?>